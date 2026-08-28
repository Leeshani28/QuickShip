<?php

include_once '../commons/db_connection.php';

$dbcon = new DbConnection();

class Customer
{
    public function addCustomer($name,$customer_category, $address, $email, $nic,$cno1,$cno2)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO customer(customer_name,customer_category,customer_address,customer_email,customer_nic,customer_mobile,customer_fixed)VALUES('$name','$customer_category','$address','$email','$nic','$cno1','$cno2')";
        $con->query($sql) or die($con->error);
        $customer_id = $con->insert_id;
        return $customer_id;
    }


    public function addReceiver($name, $address, $email, $nic, $cno1, $cno2)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO receiver(receiver_name,receiver_address,receiver_email,receiver_nic,receiver_mobile,receiver_fixed)VALUES('$name','$address','$email','$nic','$cno1','$cno2')";
        $con->query($sql) or die($con->error);
        $customer_id = $con->insert_id;
        return $customer_id;
    }


    public function getAllCustomers()
    {

        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM customer WHERE customer_status !=-1";
        $result = $con->query($sql) or die($con->error);
        return $result;

    }


    public function activateCustomer($customer_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='1' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);

    }


    public function deactivateCustomer($customer_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='0' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);

    }


    public function deleteCustomer($customer_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='-1' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);

    }


    public function updatecustomer($name, $address, $email, $nic, $cno1, $cno2, $customer_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE customer SET customer_name='$name',customer_address='$address',customer_email='$email',customer_nic='$nic',customer_mobile='$cno1',customer_fixed='$cno2' WHERE customer_id='$customer_id'";
        $con->query($sql) or die($con->error);
    }


    public function updatereceiver($name, $address, $email, $nic, $cno1, $cno2, $receiver_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE receiver SET receiver_name='$name',receiver_address='$address',receiver_email='$email',receiver_nic='$nic',receiver_mobile='$cno1',receiver_fixed='$cno2' WHERE receiver_id='$receiver_id'";
        $con->query($sql) or die($con->error);
    }


    public function getActivecustomerCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer WHERE customer_status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getDeActivecustomerCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer WHERE customer_status=0;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    public function getAllcustomerCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getCustomer($customer_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM customer WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getCustomerList()
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT customer_id,
                   customer_name,
                   customer_nic,
                   customer_mobile,
                   customer_email
            FROM customer
            ORDER BY customer_id ASC";

        return $con->query($sql);
    }

    public function getCustomerStatusSummary()
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT customer_status,
                   
                   COUNT(customer_id) AS total_customers
            FROM customer
            GROUP BY customer_status
            ORDER BY customer_status";

        return $con->query($sql);
    }

    public function getTopFiveCustomers()
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                c.customer_name,
                COUNT(o.order_id) AS total_orders
            FROM customer c
            INNER JOIN orders o
                ON c.customer_id = o.sender_id
            GROUP BY c.customer_id
            ORDER BY total_orders DESC
            LIMIT 5";

        return $con->query($sql);
    }

    //customer search function
    public function searchCustomerByNIC($nic)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT * FROM customer WHERE customer_nic='$nic'";

        return $con->query($sql);
    }





}




?>