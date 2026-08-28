<?php 
include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Finance{

public function addFinance($expense_category,$expense_amount,$expense_date,$expense_description,$user_location){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO expenses(expense_category,expense_amount,expense_date,expense_description,expense_location)VALUES('$expense_category','$expense_amount','$expense_date','$expense_description','$user_location')";
        $con->query($sql) or die($con->error);
    }

 public function getAllExpenses($user_location){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM expenses WHERE expense_location='$user_location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    } 
    
    
 public function getAllIncomings($branch_id){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM order_payments op
            LEFT JOIN orders o
                ON op.order_id = o.order_id
            WHERE o.origin_branch = '$branch_id'
            AND op.payment_status = 'Paid'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }   

public function confirmExpense($expense_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE expenses SET expense_status='Approved' WHERE expense_id='$expense_id'";
        $result = $con->query($sql) or die($con->error);
        
    }
public function rejectExpense($expense_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE expenses SET expense_status='Rejected' WHERE expense_id='$expense_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

    //for summary cards

    public function getMonthlyIncome($branch_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(op.amount),0) AS total_income
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            WHERE o.origin_branch = '$branch_id'
            AND op.payment_status = 'Paid'
            AND MONTH(op.payment_datetime) = MONTH(CURDATE())
            AND YEAR(op.payment_datetime) = YEAR(CURDATE())";

    return $con->query($sql);
}

public function getMonthlyExpenses($branch_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(expense_amount),0) AS total_expense
            FROM expenses
            WHERE expense_location = '$branch_id'
            AND expense_status='Approved'
            AND MONTH(expense_date)=MONTH(CURDATE())
            AND YEAR(expense_date)=YEAR(CURDATE())";

    return $con->query($sql);
}

//for charts

public function getMonthlyExpenseCategoryReport($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                expense_category,
                SUM(expense_amount) AS total_amount
            FROM expenses
            WHERE expense_location = '$district_id'
            AND expense_status = 'Approved'
            AND MONTH(expense_date) = MONTH(CURDATE())
            AND YEAR(expense_date) = YEAR(CURDATE())
            GROUP BY expense_category
            ORDER BY total_amount DESC";

    return $con->query($sql);
}

public function getLastFiveMonthIncome($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                DATE_FORMAT(op.payment_datetime,'%b %Y') AS month_name,
                SUM(op.amount) AS total_income
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            WHERE o.order_location = '$district_id'
            AND op.payment_status = 'Paid'
            AND op.payment_datetime >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH)
            GROUP BY YEAR(op.payment_datetime), MONTH(op.payment_datetime)
            ORDER BY YEAR(op.payment_datetime), MONTH(op.payment_datetime)";

    return $con->query($sql);
}

//for reports
public function getPendingCODPayments($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                op.order_id,
                CONCAT(c.customer_name) AS customer_name,
                op.amount,
                DATE(op.payment_datetime) AS payment_date
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            INNER JOIN customer c
                ON o.sender_id = c.customer_id
            WHERE op.payment_type='COD'
            AND op.payment_status='Pending'
            AND o.order_location='$district_id'
            ORDER BY op.payment_datetime";

    return $con->query($sql);
}

public function getPendingCODTotal($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                IFNULL(SUM(op.amount),0) AS total_pending
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id=o.order_id
            WHERE op.payment_type='COD'
            AND op.payment_status='Pending'
            AND o.order_location='$district_id'";

    return $con->query($sql);
}

public function getMonthlyIncomeReport($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(op.amount),0) AS total_income
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            WHERE o.order_location = '$district_id'
            AND op.payment_status = 'Paid'
            AND MONTH(op.payment_datetime)=MONTH(CURDATE())
            AND YEAR(op.payment_datetime)=YEAR(CURDATE())";

    return $con->query($sql);
}

public function getMonthlyExpense($district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(expense_amount),0) AS total_expense
            FROM expenses
            WHERE expense_location='$district_id'
            AND expense_status='Approved'
            AND MONTH(expense_date)=MONTH(CURDATE())
            AND YEAR(expense_date)=YEAR(CURDATE())";

    return $con->query($sql);
}


//for income report
public function getIncomeReport($from_date, $to_date, $district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                op.order_id,
                CONCAT(c.customer_name) AS customer_name,
                op.payment_type,
                op.amount,
                DATE(op.payment_datetime) AS payment_date
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            INNER JOIN customer c
                ON o.sender_id = c.customer_id
            WHERE op.payment_status='Paid'
            AND DATE(op.payment_datetime) BETWEEN '$from_date' AND '$to_date'";

    if($district_id != "")
    {
        $sql .= " AND o.order_location='$district_id'";
    }

    $sql .= " ORDER BY op.payment_datetime";

    return $con->query($sql);
}

public function getIncomeTotal($from_date, $to_date, $district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                IFNULL(SUM(op.amount),0) AS total_income
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id=o.order_id
            WHERE op.payment_status='Paid'
            AND DATE(op.payment_datetime)
                BETWEEN '$from_date' AND '$to_date'";

    if($district_id != "")
    {
        $sql .= " AND o.order_location='$district_id'";
    }

    return $con->query($sql);
}

//for expenses report

public function getExpenseReport($from_date, $to_date, $district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                expense_category,
                expense_description,
                expense_amount,
                expense_status,
                expense_date
            FROM expenses
            WHERE expense_date BETWEEN '$from_date' AND '$to_date' AND expense_status = 'Approved' ";

    if($district_id != "")
    {
        $sql .= " AND expense_location='$district_id'";
    }

    $sql .= " ORDER BY expense_date";

    return $con->query($sql);
}

public function getExpenseTotal($from_date, $to_date, $district_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                IFNULL(SUM(expense_amount),0) AS total_expense
            FROM expenses
            WHERE expense_date BETWEEN '$from_date' AND '$to_date' AND expense_status = 'Approved'";

    if($district_id != "")
    {
        $sql .= " AND expense_location='$district_id'";
    }

    return $con->query($sql);
}

//for dashboard summary cards

public function getTotalMonthlyIncome()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(op.amount),0) AS total_income
            FROM order_payments op
            INNER JOIN orders o
                ON op.order_id = o.order_id
            WHERE op.payment_status = 'Paid'
            AND MONTH(op.payment_datetime) = MONTH(CURDATE())
            AND YEAR(op.payment_datetime) = YEAR(CURDATE())";

    return $con->query($sql);
}

public function getTotalMonthlyExpenses()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT IFNULL(SUM(expense_amount),0) AS total_expense
            FROM expenses
            WHERE expense_status='Approved'
            AND MONTH(expense_date)=MONTH(CURDATE())
            AND YEAR(expense_date)=YEAR(CURDATE())";

    return $con->query($sql);
}



}

?>