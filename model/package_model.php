<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Package{
    public function addPackage($order_id,$quantity,$pvalue,$pkg_type,$ptype,$pkg_weight,$length,$width,$height,$fragile,$insurance,$instructions){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO package(order_id,quantity,pkg_value,pkg_type,packaging_type,pkg_weight,pkg_length,pkg_width,height,fragile_item,insurance,instructions)VALUES('$order_id','$quantity','$pvalue','$pkg_type','$ptype','$pkg_weight','$length','$width','$height','$fragile','$insurance','$instructions')";
        $con->query($sql) or die($con->error);
        $package_id=$con->insert_id;
        return $package_id;

        
        
    }


    public function getAllPackages(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM package WHERE pkg_status !=-1";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }


    public function activateCustomer($customer_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='1' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function deactivateCustomer($customer_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE customer SET customer_status='0' WHERE customer_id='$customer_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function deletePackage($package_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE package SET pkg_status='-1' WHERE package_id='$package_id'";
        $result = $con->query($sql) or die($con->error);
        
    }



    public function updatePackage($package_id, $quantity, $pvalue, $pkg_type,$ptype,$pkg_weight,$length,$width,$height,$fragile_item,$insurance,$instructions){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE package SET quantity='$quantity',pkg_value='$pvalue',pkg_type='$pkg_type',packaging_type='$ptype',pkg_weight='$pkg_weight',pkg_length='$length',height='$height',pkg_width='$width',fragile_item='$fragile_item',insurance='$insurance',instructions='$instructions' WHERE package_id='$package_id'";
        $con->query($sql) or die($con->error);
    }



     public function getActivecustomerCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer WHERE customer_status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getDeActivecustomerCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer WHERE customer_status=0;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    public function getAllcustomerCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(customer_id)as customer_count FROM customer;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getPackage($package_id){
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM package WHERE package_id='$package_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

//for reports

public function getPackageTypeSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                pkg_type,
                COUNT(package_id) AS total_packages
            FROM package
            GROUP BY pkg_type
            ORDER BY total_packages DESC";

    return $con->query($sql);
}

public function getPackageWeightDistribution()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                CASE
                    WHEN pkg_weight <= 1 THEN '0 - 1 kg'
                    WHEN pkg_weight <= 5 THEN '1 - 5 kg'
                    WHEN pkg_weight <= 10 THEN '5 - 10 kg'
                    ELSE 'Above 10 kg'
                END AS weight_range,
                COUNT(package_id) AS total_packages
            FROM package
            GROUP BY weight_range
            ORDER BY
                CASE
                    WHEN weight_range='0 - 1 kg' THEN 1
                    WHEN weight_range='1 - 5 kg' THEN 2
                    WHEN weight_range='5 - 10 kg' THEN 3
                    ELSE 4
                END";

    return $con->query($sql);
}

public function getFragilePackageReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                package_id,
                pkg_type,
                pkg_weight,
                fragile_item
            FROM package
            ORDER BY fragile_item DESC, package_id ASC";

    return $con->query($sql);
}

public function getPackageList()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT package_id,
                   order_id,
                   pkg_type,
                   pkg_weight,
                   fragile_item,
                   quantity
            FROM package
            ORDER BY package_id ASC";

    return $con->query($sql);
}

//for landing page summary cards

public function getpendingPackageCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as pending_count FROM orders WHERE order_status = 1 AND order_location = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

public function getDeliveredPackageCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as delivered_count FROM orders WHERE order_status = 8 AND order_location = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

public function getCancelledPackageCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as cancelled_count FROM orders WHERE order_status = 11 AND order_location = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    //for bar chart

    public function getPackageWeightDistributionChart()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                CASE
                    WHEN pkg_weight <= 1 THEN '0 - 1 kg'
                    WHEN pkg_weight <= 5 THEN '1 - 5 kg'
                    WHEN pkg_weight <= 10 THEN '5 - 10 kg'
                    ELSE 'Above 10 kg'
                END AS weight_range,
                COUNT(package_id) AS total_packages
            FROM package
            GROUP BY weight_range
            ORDER BY
                CASE
                    WHEN weight_range='0 - 1 kg' THEN 1
                    WHEN weight_range='1 - 5 kg' THEN 2
                    WHEN weight_range='5 - 10 kg' THEN 3
                    ELSE 4
                END";

    return $con->query($sql);
}

}


 ?>