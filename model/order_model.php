<?php

include_once '../commons/db_connection.php';

$dbcon = new DbConnection();

class Order
{
    public function addOrder($sender_id, $receiver_id, $province_id, $district_id,$order_location, $premises_no, $premises_name, $street, $town, $postal_code, $return_address,$pod, $delivery_type, $preferred_del_date, $deli_instruction, $payment_type, $amount)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO orders (sender_id,receiver_id,province_id,district_id,order_location,premises_no,premises_name,street,town,postal_code,return_address,pod,delivery_type,preferred_del_date,deli_instruction,payment_type,amount,origin_branch) VALUES ('$sender_id','$receiver_id','$province_id','$district_id','$order_location','$premises_no','$premises_name','$street','$town','$postal_code','$return_address','$pod','$delivery_type','$preferred_del_date','$deli_instruction','$payment_type','$amount','$order_location')";
        $con->query($sql) or die($con->error);
        $order_id = $con->insert_id;
        return $order_id;

    }

    public function deleteOrder($order_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status=11 WHERE order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

    public function getAllOrders($user_location)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
         LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.order_status != -1 AND o.origin_branch = '$user_location'
        ORDER BY o.order_date DESC";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getCustomerOrders($customer_id)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
         LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.order_status != -1 AND c.customer_id = '$customer_id'
        ORDER BY o.order_date DESC";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getPendingOrders($user_location)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
         LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.origin_branch = '$user_location' AND o.order_status = 1
        ORDER BY o.order_date DESC";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getDeliveredOrders($user_location)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
         LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.origin_branch = '$user_location' AND o.order_status = 8
        ORDER BY o.order_date DESC";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getCanceledOrders($user_location)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
         LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.origin_branch = '$user_location' AND o.order_status = 11
        ORDER BY o.order_date DESC";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }

//     public function getDeliveredOfd()
// {
//     $con = $GLOBALS["con"];

//     $sql = "SELECT * FROM ofd of
//         LEFT JOIN orders o ON of.order_id = o.order_id 
//         LEFT JOIN driver dr ON of.driver_id = dr.driver_id WHERE ofd_status = 'Delivered'";
//         $result =$con->query($sql) or die($con->error);
//         return $result;
// }


    public function getOrder($order_id)
    {

        $con = $GLOBALS["con"];
        $sql = $sql = "SELECT * FROM orders o
    LEFT JOIN customer c ON o.sender_id = c.customer_id
    LEFT JOIN receiver r ON o.receiver_id =r.receiver_id
    LEFT JOIN package p ON o.order_id = p.order_id
    LEFT JOIN district d ON o.district_id = d.district_id
    LEFT JOIN province pr ON o.province_id = pr.province_id
    LEFT JOIN order_status s ON o.order_status = s.status_id
    
    -- LEFT JOIN user u ON o.order_location = u.district_id
    WHERE o.order_id = '$order_id'";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getCustomerContact($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT o.*, 
       sender_cc.contact_number AS sender_cno,
       receiver_cc.contact_number AS receiver_cno

FROM orders o

LEFT JOIN customer sender 
       ON o.sender_id = sender.customer_id

LEFT JOIN customer receiver 
       ON o.receiver_id = receiver.customer_id

LEFT JOIN customer_contact sender_cc 
       ON sender.customer_id = sender_cc.customer_id

LEFT JOIN customer_contact receiver_cc 
       ON receiver.customer_id = receiver_cc.customer_id
 
WHERE o.order_id = '$order_id';";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function deactivateCustomer($customer_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='0' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);

    }


    public function deletePackage($package_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE package SET pkg_status='-1' WHERE package_id='$package_id'";
        $result = $con->query($sql) or die($con->error);

    }

    public function getAllcustomerCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getPackage($package_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM package WHERE package_id='$package_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function updateOrder($sender_id, $receiver_id, $province_id, $district_id,$order_location, $premises_no, $premises_name, $street, $town, $postal_code, $return_address,$pod, $delivery_type, $preferred_del_date, $deli_instruction, $payment_type, $amount,$order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET sender_id='$sender_id',receiver_id='$receiver_id',province_id='$province_id',district_id='$district_id',order_location='$order_location',premises_no='$premises_no',premises_name='$premises_name',street='$street',town='$town',postal_code='$postal_code',return_address='$return_address',pod='$pod',delivery_type='$delivery_type',preferred_del_date='$preferred_del_date',deli_instruction='$deli_instruction',payment_type='$payment_type',amount='$amount' WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }

    public function getAllOrderCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as order_count FROM orders;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getPendingOrderCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as order_count FROM orders WHERE order_status = 1 AND origin_branch = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    public function getOutforDeliveryOrderCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as ofd_count FROM orders WHERE order_status = 7 AND order_location = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    public function getDeliveredOrderCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as delivered_count FROM orders WHERE order_status = 8 AND origin_branch = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    public function getCanceledOrderCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as canceled_count FROM orders WHERE order_status = 11 AND origin_branch = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    public function confirmOrder($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = 2 WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }


    public function setPaymentStatus($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE order_payments SET payment_status = 'Paid' , payment_datetime = NOW() WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }


    public function addOrderLog($order_id, $status_id, $log_remarks)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO order_logs (order_id,status_id,log_remarks) VALUES ('$order_id','$status_id','$log_remarks')";
        $con->query($sql) or die($con->error);
        

    }


    public function orderPayment($order_id, $amount, $payment_type,$payment_status)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO order_payments (order_id,amount,payment_type,payment_status) VALUES ('$order_id','$amount','$payment_type','$payment_status')";
        $con->query($sql) or die($con->error);
        

    }


    public function getOrderLogs($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * 
        FROM order_logs ol
        LEFT JOIN order_status s ON ol.status_id = s.status_id 
        WHERE order_id = '$order_id' ORDER BY log_time ASC";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    //for reports

    public function getOrderStatusSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT os.status_name,
                   os.color_code,
                   COUNT(o.order_id) AS total_orders
            FROM order_status os
            LEFT JOIN orders o
            ON os.status_id  = o.order_status
            GROUP BY os.status_id
            ORDER BY os.status_id";

    return $con->query($sql);
}

public function getOrdersByPackageType()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                pkg_type,
                COUNT(order_id) AS total_orders
            FROM package
            GROUP BY pkg_type
            ORDER BY total_orders DESC";

    return $con->query($sql);
}

public function getOrdersByDestinationTown()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT b.branch_name,
                   
                   COUNT(o.order_id) AS total_orders
            FROM branch b
            LEFT JOIN orders o
            ON b.branch_id   = o.order_location
            GROUP BY o.order_location
            ORDER BY total_orders DESC, branch_name ASC";

    return $con->query($sql);
}


public function getDeliveredVsCancelledReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                status_name,
                COUNT(o.order_id) AS total_orders
            FROM order_status os
            LEFT JOIN orders o
                ON os.status_id = o.order_status
            WHERE os.status_name IN ('Delivered','Cancelled')
            GROUP BY os.status_id
            ORDER BY os.status_name ASC";

    return $con->query($sql);
}

public function getMonthlyOrderReport($from,$to)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                o.order_id,
                c.customer_name,
                pk.pkg_type,
                b.branch_name,
                o.preferred_del_date,
                s.status_name
            FROM orders o

            INNER JOIN customer c
                    ON c.customer_id=o.sender_id

            INNER JOIN package pk
                    ON pk.order_id=o.order_id

            INNER JOIN branch b
                    ON b.branch_id=o.order_location

            INNER JOIN order_status s
                    ON s.status_id=o.order_status

            WHERE o.order_date
            BETWEEN '$from'
            AND '$to'

            ORDER BY o.order_date ASC";

    return $con->query($sql);
}


public function getDailyOrderSummaryReport($from,$to)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                o.order_id,
                c.customer_name,
                pk.pkg_type,
                b.branch_name,
                o.preferred_del_date,
                s.status_name
            FROM orders o

            INNER JOIN customer c
                ON c.customer_id = o.sender_id

            INNER JOIN package pk
                    ON pk.order_id=o.order_id

            INNER JOIN branch b
                    ON b.branch_id=o.order_location

            INNER JOIN order_status s
                ON s.status_id = o.order_status

            WHERE DATE(o.order_date)
            BETWEEN '$from'
            AND '$to'

            ORDER BY o.order_date ASC";

    return $con->query($sql);
}

//for charts

public function getOrdersByPackageTypeChart($order_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                p.pkg_type,
                COUNT(p.package_id) AS total_orders
            FROM package p

            INNER JOIN orders o
                ON o.order_id = p.order_id

            WHERE o.order_location = '$order_location'

            GROUP BY p.pkg_type
            ORDER BY total_orders DESC";

    return $con->query($sql);
}

public function getOrdersByDestinationTownChart($order_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                di.district_name,
                COUNT(order_id) AS total_orders
            FROM orders o
            LEFT JOIN district di
                ON di.district_id=o.district_id
            WHERE o.order_location = '$order_location'


            GROUP BY o.district_id
            ORDER BY total_orders DESC";

    return $con->query($sql);
}

//for dashboard summary cards

public function getTotalPendingOrderCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as order_count FROM orders WHERE order_status = 1";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    public function getTotalOutforDeliveryOrderCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as ofd_count FROM orders WHERE order_status = 7;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    public function getTotalDeliveredOrderCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as delivered_count FROM orders WHERE order_status = 8;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    public function getTotalCanceledOrderCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as canceled_count FROM orders WHERE order_status = 11;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    


}




?>