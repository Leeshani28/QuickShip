<?php

include_once '../commons/db_connection.php';

$dbcon = new DbConnection();

class Delivery
{
    public function getAllDistrict()
    {

        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM district";
        $result = $con->query($sql) or die($con->error);
        return $result;

    }


    public function getAllBranchDistrict()
    {

        $con = $GLOBALS["con"];
        $sql = "SELECT DISTINCT
                    d.district_id,
                    d.district_name
                FROM district d
                INNER JOIN branch b
                    ON d.district_id = b.branch_district
                WHERE b.branch_status = 'Active'
                ORDER BY d.district_name";
        $result = $con->query($sql) or die($con->error);
        return $result;

    }
    public function getAllProvince()
    {

        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM province";
        $result = $con->query($sql) or die($con->error);
        return $result;

    }


    // public function assignDelivery($delivery_id){

    //     $con=$GLOBALS["con"];
    //     $sql = "UPDATE delivery SET delivery_status='Assigned' WHERE delivery_id ='$delivery_id '";
    //     $result = $con->query($sql) or die($con->error);

    // }

    public function addDelivery($shipment_id, $start_location, $destination_location, $driver_id, $vehicle_id)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO delivery (shipment_id,start_location,destination_location,driver_id,vehicle_id) VALUES ('$shipment_id','$start_location','$destination_location','$driver_id','$vehicle_id')";
        $con->query($sql) or die($con->error);


    }


    public function addDeliveryOrder($order_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = 6 WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }

    public function updateDriverStatus($driver_id, $driver_status)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE driver SET driver_status = '$driver_status' WHERE driver_id='$driver_id'";
        $con->query($sql) or die($con->error);
    }

    public function updateVehicleStatus($vehicle_id, $vehicle_status)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE vehicle SET vehicle_status = '$vehicle_status' WHERE vehicle_id='$vehicle_id'";
        $con->query($sql) or die($con->error);
    }

    public function setStatusAssignedDeliveryOrders($order_id, $status_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = '$status_id' WHERE order_id = '$order_id'";
        $con->query($sql) or die($con->error);

    }
    public function setStatusRejectedDeliveryOrders($order_id, $status_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = '$status_id' WHERE order_id = '$order_id'";
        $con->query($sql) or die($con->error);

    }

    public function setStatusReceivedDeliveryOrders($order_id, $status_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = '$status_id' WHERE order_id = '$order_id'";
        $con->query($sql) or die($con->error);

    }

    public function getAllDeliveries($location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT 
                del.*, 
                b1.branch_name AS start_branch_name,
                b2.branch_name AS destination_branch_name,
                b1.branch_id AS start_branch_id,
                b2.branch_id AS destination_branch_id,

                dr.driver_name,

                v.vehicle_number,
                v.vehicle_type
                
            FROM delivery del
            JOIN branch b1 ON del.start_location = b1.branch_id
            JOIN branch b2 ON del.destination_location = b2.branch_id
            LEFT JOIN driver dr ON del.driver_id = dr.driver_id 
            LEFT JOIN vehicle v ON del.vehicle_id = v.vehicle_id WHERE del.start_location = '$location' ORDER BY delivery_date DESC";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getStartedDeliveries($warehouse_location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT 
                del.*, 
                b1.branch_name AS start_branch_name,
                b2.branch_name AS destination_branch_name,
                b1.branch_id AS start_branch_id,
                b2.branch_id AS destination_branch_id,

                dr.driver_name,

                v.vehicle_number,
                v.vehicle_type
                
            FROM delivery del
            JOIN branch b1 ON del.start_location = b1.branch_id
            JOIN branch b2 ON del.destination_location = b2.branch_id
            LEFT JOIN driver dr ON del.driver_id = dr.driver_id 
            LEFT JOIN vehicle v ON del.vehicle_id = v.vehicle_id WHERE del.delivery_status = 'Started' AND  del.destination_location = '$warehouse_location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }



    public function getReceivedDeliveries($warehouse_location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT 
                del.*, 
                b1.branch_name AS start_branch_name,
                b2.branch_name AS destination_branch_name,
                b1.branch_id AS start_branch_id,
                b2.branch_id AS destination_branch_id,

                dr.driver_name,

                v.vehicle_number,
                v.vehicle_type
                
            FROM delivery del
            JOIN branch b1 ON del.start_location = b1.branch_id
            JOIN branch b2 ON del.destination_location = b2.branch_id
            LEFT JOIN driver dr ON del.driver_id = dr.driver_id 
            LEFT JOIN vehicle v ON del.vehicle_id = v.vehicle_id WHERE del.delivery_status = 'Received' AND  del.destination_location = '$warehouse_location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }




    public function approveDelivery($delivery_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE delivery SET delivery_status = 'Approved' WHERE delivery_id='$delivery_id'";
        $con->query($sql) or die($con->error);
    }

    public function startDelivery($delivery_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE delivery SET delivery_status = 'Started' WHERE delivery_id='$delivery_id'";
        $con->query($sql) or die($con->error);
    }


    public function receiveDelivery($delivery_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE delivery SET delivery_status = 'Received' WHERE delivery_id='$delivery_id'";
        $con->query($sql) or die($con->error);
    }


    public function rejectDelivery($delivery_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE delivery SET delivery_status='Rejected' WHERE delivery_id='$delivery_id'";
        $result = $con->query($sql) or die($con->error);

    }


    public function getDeliveryDetails($delivery_id)
    {

        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM delivery WHERE delivery_id='$delivery_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function updateOrderLocation($order_id, $location_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_location = '$location_id' WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }
    public function updatedriverLocation($driver_id, $location_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE driver SET driver_location = '$location_id' WHERE driver_id='$driver_id'";
        $con->query($sql) or die($con->error);
    }
    public function updateVehicleLocation($vehicle_id, $location_id)
    {

        $con = $GLOBALS["con"];
        $sql = "UPDATE vehicle SET vehicle_location = '$location_id' WHERE vehicle_id='$vehicle_id'";
        $con->query($sql) or die($con->error);
    }

    //for Reports

    public function getDeliveryStatusSummary()
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT delivery_status,
                   
                   COUNT(delivery_id ) AS total_deliveries
            FROM delivery
            GROUP BY delivery_status
            ORDER BY delivery_status";

        return $con->query($sql);
    }

    public function getDeliveryRouteReport()
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                b.branch_name AS start_location,
                br.branch_name AS destination_location,
                COUNT(d.delivery_id) AS total_deliveries
            FROM delivery d
            INNER JOIN branch b
                ON d.start_location = b.branch_id
            INNER JOIN branch br
                ON d.destination_location = br.branch_id
            GROUP BY d.start_location, d.destination_location
            ORDER BY total_deliveries DESC";

        return $con->query($sql);
    }


    public function getDailyDeliveryReport($from_date, $to_date, $district_id)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                d.delivery_id,
                d.delivery_date,
                b.branch_name AS start_location,
                br.branch_name AS destination_location,
                dr.driver_name,
                v.vehicle_number,
                d.delivery_status
            FROM delivery d
            INNER JOIN branch b
                ON d.start_location = b.branch_id
            INNER JOIN branch br
                ON d.destination_location = br.branch_id
            INNER JOIN driver dr
                ON d.driver_id = dr.driver_id
            INNER JOIN vehicle v
                ON d.vehicle_id = v.vehicle_id
            WHERE d.delivery_date BETWEEN '$from_date' AND '$to_date'";

        if ($district_id != "") {
            $sql .= " AND d.start_location = '$district_id'";
        }

        $sql .= " ORDER BY d.delivery_date ASC";

        return $con->query($sql);
    }


    public function getMonthlyDeliveryReport($from_date, $to_date, $district_id)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                DATE_FORMAT(d.delivery_date,'%Y-%m') AS delivery_month,
                COUNT(d.delivery_id) AS total_deliveries
            FROM delivery d
            WHERE d.delivery_date BETWEEN '$from_date' AND '$to_date'";

        if ($district_id != "") {
            $sql .= " AND d.start_location = '$district_id'";
        }

        $sql .= " GROUP BY DATE_FORMAT(d.delivery_date,'%Y-%m')
              ORDER BY delivery_month ASC";

        return $con->query($sql);
    }

    public function getCompletedDeliveryReport($from_date, $to_date, $district_id)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                d.delivery_id,
                d.delivery_date,
                b.branch_name AS start_location,
                br.branch_name AS destination_location,
                dr.driver_name,
                v.vehicle_number,
                d.delivery_status
            FROM delivery d
            INNER JOIN branch b
                ON b.branch_id = d.start_location
            INNER JOIN branch br
                ON br.branch_id = d.destination_location
            INNER JOIN driver dr
                ON dr.driver_id = d.driver_id
            INNER JOIN vehicle v
                ON v.vehicle_id = d.vehicle_id
            WHERE d.delivery_date BETWEEN '$from_date' AND '$to_date'
            AND d.delivery_status = 'Completed'";

        if ($district_id != "") {
            $sql .= " AND d.start_location = '$district_id'";
        }

        $sql .= " ORDER BY d.delivery_date ASC";

        return $con->query($sql);
    }


    public function getRejectedDeliveryReport($from_date, $to_date, $district_id)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                d.delivery_id,
                d.delivery_date,
                b.branch_name AS start_location,
                br.branch_name AS destination_location,
                dr.driver_name,
                v.vehicle_number,
                d.delivery_status
            FROM delivery d
            INNER JOIN branch b
                ON b.branch_id = d.start_location
            INNER JOIN branch br
                ON br.branch_id = d.destination_location
            INNER JOIN driver dr
                ON dr.driver_id = d.driver_id
            INNER JOIN vehicle v
                ON v.vehicle_id = d.vehicle_id
            WHERE d.delivery_date BETWEEN '$from_date' AND '$to_date'
            AND d.delivery_status = 'Rejected'";

        if ($district_id != "") {
            $sql .= " AND d.start_location = '$district_id'";
        }

        $sql .= " ORDER BY d.delivery_date ASC";

        return $con->query($sql);
    }

    //For landing page summary cards

    public function getPendingDeliveries($delivery_location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(delivery_id )as pending_count FROM delivery WHERE delivery_status = 'Pending' AND start_location = '$delivery_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getApprovedDeliveries($delivery_location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(delivery_id )as approved_count FROM delivery WHERE delivery_status = 'Approved' AND start_location = '$delivery_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getRejectedDeliveries($delivery_location)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(delivery_id )as rejected_count FROM delivery WHERE delivery_status = 'Rejected' AND start_location = '$delivery_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    //for charts

    public function getDeliveryStatusSummaryChart($start_location)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                delivery_status,
                COUNT(delivery_id) AS total_deliveries
            FROM delivery
            WHERE start_location = '$start_location'
            GROUP BY delivery_status
            ORDER BY total_deliveries DESC";

        return $con->query($sql);
    }

    public function getMonthlyDeliveriesChart($start_location)
    {
        $con = $GLOBALS["con"];

        $sql = "SELECT
                DATE_FORMAT(delivery_date,'%b %Y') AS month_name,
                COUNT(delivery_id) AS total_deliveries
            FROM delivery
            WHERE start_location = '$start_location'
            AND delivery_date >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 2 MONTH),'%Y-%m-01')
            GROUP BY YEAR(delivery_date), MONTH(delivery_date)
            ORDER BY YEAR(delivery_date), MONTH(delivery_date)";

        return $con->query($sql);
    }










}




?>