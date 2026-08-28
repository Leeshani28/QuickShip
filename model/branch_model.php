<?php 

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Branch{


public function addBranch($branch_name,$branch_district,$branch_address,$contact_no,$email){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO branch(branch_name,branch_district,branch_address,contact_no,email)VALUES('$branch_name','$branch_district','$branch_address','$contact_no','$email')";
        $con->query($sql) or die($con->error);
        $branch_id =$con->insert_id;
        return $branch_id ;
    }

    public function getBranches(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM branch br
         LEFT JOIN district d ON br.branch_district = d.district_id";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
    public function getAllBranches(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM branch br
         LEFT JOIN district d ON br.branch_district = d.district_id WHERE br.branch_status = 'Active'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }


    public function activateBranch($branch_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE branch SET branch_status='Active' WHERE branch_id='$branch_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function deactivateBranch($branch_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE branch SET branch_status='De-active' WHERE branch_id='$branch_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function getBranch($branch_id){
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM branch br
         LEFT JOIN district d ON br.branch_district = d.district_id WHERE branch_id='$branch_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

public function updateBranch($branch_id,$branch_name,$branch_district,$branch_address,$contact_no,$email){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE branch SET branch_name='$branch_name',branch_district='$branch_district',branch_address='$branch_address',contact_no='$contact_no',email='$email' WHERE branch_id='$branch_id'";
        $con->query($sql) or die($con->error);
    }


    //for charts

    public function getBranchStatusSummaryChart()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                branch_status,
                COUNT(branch_id ) AS total_branches_chart
            FROM branch
           
            GROUP BY branch_status
            ORDER BY total_branches_chart DESC";

    return $con->query($sql);
}


//     public function getBranchUserCount($branch_id)
// {
//     $con = $GLOBALS["con"];

//     $sql = "SELECT
//                 user_location,
//                 COUNT(user_id ) AS total
//             FROM user WHERE user_location = '$branch_id'";

//     return $con->query($sql);
// }



    //for reports
    public function getBranchList()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT b.branch_name,
                   d.district_name,
                   b.contact_no,
                   b.email,
                   b.branch_status
            FROM branch b
            INNER JOIN district d
            ON b.branch_district = d.district_id
            ORDER BY b.branch_name";

    return $con->query($sql);
}


public function getBranchStatusReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                branch_id,
                branch_name,
                branch_status
            FROM branch
            ORDER BY branch_status DESC, branch_id ASC";

    return $con->query($sql);
}


public function getBranchDistrictReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                b.branch_id,
                b.branch_name,
                d.district_name
            FROM branch b
            INNER JOIN district d
                ON b.branch_district = d.district_id
            ORDER BY d.district_name, b.branch_name";

    return $con->query($sql);
}


public function getBranchRevenueReport($from,$to,$branch)
{
    $con = $GLOBALS["con"];

    $branchFilter = "";

    if($branch!="")
    {
        $branchFilter = " AND o.origin_branch='$branch' ";
    }

    $sql = "SELECT
                o.order_id,
                b.branch_name,
                DATE(p.payment_datetime) AS payment_date,
                p.amount AS amount
            FROM order_payments p
            INNER JOIN orders o
                    ON p.order_id=o.order_id
            INNER JOIN branch b
                    ON o.origin_branch=b.branch_id
            WHERE p.payment_status='Paid'
            AND DATE(p.payment_datetime)
                BETWEEN '$from' AND '$to'
            $branchFilter
            ORDER BY p.payment_datetime";

    return $con->query($sql);
}

public function getBranchName($branch_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT branch_name
            FROM branch
            WHERE branch_id='$branch_id'";

    $result = $con->query($sql);

    $row = $result->fetch_assoc();

    return $row["branch_name"];
}

public function getBranchForReport($branch_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT b.*, d.district_name
            FROM branch b
            LEFT JOIN district d
            ON b.branch_district = d.district_id
            WHERE b.branch_id = '$branch_id'";

    return $con->query($sql);
}

public function getTotalBranchCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(branch_id )as total_branch_count FROM branch;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
public function getActiveBranchCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(branch_id )as active_branch_count FROM branch WHERE branch_status = 'Active';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
public function getDeactiveBranchCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(branch_id )as deactive_branch_count FROM branch WHERE branch_status = 'De-active';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
}

?>