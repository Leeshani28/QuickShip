<?php

include_once '../commons/db_connection.php';

$dbcon = new DbConnection();

class Warehouse
{

    public function getAllOrders($user_location)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
        LEFT JOIN order_status s ON o.order_status = s.status_id
        WHERE o.order_status != 11 AND o.order_location = '$user_location' AND o.order_status = 3 ";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getOrder($order_id)
    {

        $con = $GLOBALS["con"];
        $sql = $sql = "SELECT * FROM orders o
    LEFT JOIN customer c ON o.sender_id = c.customer_id
    LEFT JOIN receiver r ON o.receiver_id =r.receiver_id
    LEFT JOIN package p ON o.order_id = p.order_id
    LEFT JOIN district d ON o.district_id = d.district_id
    LEFT JOIN province pr ON o.province_id = pr.province_id
    -- LEFT JOIN user u ON o.order_location = u.district_id
    WHERE o.order_id = '$order_id'";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getAllOrdersByStatus($user_location,$status)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
        LEFT JOIN order_status s ON o.order_status = s.status_id
        LEFT JOIN district d ON o.district_id = d.district_id
        LEFT JOIN branch b ON o.order_location = b.branch_id
        WHERE o.order_status != -1 AND o.order_location = '$user_location' AND o.order_status = '$status' AND o.district_id != b.branch_district";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getOfdOrders($user_location,$status)
    {

        $con = $GLOBALS["con"];

        $sql = "SELECT *
        FROM orders o
        LEFT JOIN customer c ON o.sender_id = c.customer_id
        LEFT JOIN package p ON o.order_id = p.order_id
        LEFT JOIN order_status s ON o.order_status = s.status_id
        LEFT JOIN district d ON o.district_id = d.district_id
        LEFT JOIN branch b ON o.order_location = b.branch_id
        WHERE o.order_status != -1 AND o.order_location = '$user_location' AND o.order_status = '$status' AND o.district_id = b.branch_district";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function atWarehouseOrder($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = 3 WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }
   
   
    public function updateAssignedShipments($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = 5 WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }



    public function updateOfdOrders($order_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = 7 WHERE order_id='$order_id'";
        $con->query($sql) or die($con->error);
    }
   
    
    // public function inTransitOrder($order_id)
    // {
       
    //     $con=$GLOBALS["con"];
    //     $sql = "UPDATE orders SET order_status = 4 WHERE order_id='$order_id'";
    //     $con->query($sql) or die($con->error);
    // }


    public function createShipment($start_location,$distination_location)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO shipment(shipment_start_location,shipment_destination_location) VALUES ('$start_location','$distination_location')";
        $con->query($sql) or die($con->error);
        $shipment_id = $con->insert_id;
        return $shipment_id;

    }
    
    
    
    public function outForDelivery($driver_id,$order_id,$ofd_branch)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO ofd(driver_id,order_id,ofd_branch) VALUES ('$driver_id','$order_id','$ofd_branch')";
        $con->query($sql) or die($con->error);
        

    }




    public function addShipmentOrders($shipment_id,$order_id)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO shipment_orders (shipment_id,order_id) VALUES ('$shipment_id','$order_id')";
        $con->query($sql) or die($con->error);
        

    }

    //  public function getAllShipments()
    // {

    //     $con = $GLOBALS["con"];

    //     $sql = "SELECT * FROM shipment";
    //     $result = $con->query($sql) or die($con->error);
    //     return $result;
    // }

    public function getAllShipments($user_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT 
                h.*, 
                b1.branch_name AS start_branch_name,
                b2.branch_name AS destination_branch_name
            FROM shipment h
            JOIN branch b1 ON h.shipment_start_location = b1.branch_id
            JOIN branch b2 ON h.shipment_destination_location = b2.branch_id WHERE h.shipment_start_location = '$user_location' ORDER BY shipment_date DESC";

    $result = $con->query($sql) or die($con->error);
    return $result;
}



    public function getAllOfd($user_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT * FROM ofd of
        LEFT JOIN orders o ON of.order_id = o.order_id 
        LEFT JOIN driver dr ON of.driver_id = dr.driver_id WHERE of.ofd_branch = '$user_location'";
        $result =$con->query($sql) or die($con->error);
        return $result;
}

    


public function getOfd($ofd_id)
    {

        $con = $GLOBALS["con"];
        $sql = $sql = "SELECT * FROM ofd ou
                LEFT JOIN orders o ON ou.order_id = o.order_id 
                LEFT JOIN driver dr ON ou.driver_id = dr.driver_id WHERE ou.ofd_id = '$ofd_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getPendingOfd($driver_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT * FROM ofd of
        LEFT JOIN orders o ON of.order_id = o.order_id 
        LEFT JOIN receiver re ON o.receiver_id = re.receiver_id 
        LEFT JOIN driver dr ON of.driver_id = dr.driver_id WHERE of.ofd_status = 'Pending' AND dr.driver_id='$driver_id'";
        $result =$con->query($sql) or die($con->error);
        return $result;
}


    public function getCompletedOfd($driver_id)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT * FROM ofd of
        LEFT JOIN orders o ON of.order_id = o.order_id 
        LEFT JOIN receiver re ON o.receiver_id = re.receiver_id 
        LEFT JOIN driver dr ON of.driver_id = dr.driver_id WHERE of.ofd_status != 'Pending' AND dr.driver_id='$driver_id'";
        $result =$con->query($sql) or die($con->error);
        return $result;
}




public function confirmShipment($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment SET shipment_status='Confirm' WHERE shipment_id='$shipment_id'";
        $result = $con->query($sql) or die($con->error);
        
    }
public function completeShipment($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment SET shipment_status='Complete' WHERE shipment_id='$shipment_id'";
        $result = $con->query($sql) or die($con->error);
        
    }
public function confirmShipmentOrders($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment_orders SET shipment_order_status='Confirm' WHERE shipment_id='$shipment_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

public function cancelShipment($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment SET shipment_status='Cancel' WHERE shipment_id='$shipment_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


public function reassignRider($ofd_id,$driver_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE ofd SET driver_id='$driver_id' WHERE ofd_id='$ofd_id'";
        $result = $con->query($sql) or die($con->error);
        
    }



public function returnedOrder($ofd_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE ofd SET ofd_status='Returned' WHERE ofd_id='$ofd_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


public function deliveredOrder($ofd_id,$file_name){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE ofd SET ofd_status='Delivered',delivery_proof='$file_name'  WHERE ofd_id='$ofd_id'";
        $result = $con->query($sql) or die($con->error);
        
    }



public function cancelShipmentOrders($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment_orders SET shipment_order_status = 'Cancel' WHERE shipment_id = '$shipment_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


public function getShipmentOrders($shipment_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM shipment_orders so
        LEFT JOIN orders o ON so.order_id = o.order_id 
        LEFT JOIN package p ON o.order_id = p.order_id 
        WHERE so.shipment_id = '$shipment_id'";
        $result =$con->query($sql) or die($con->error);
        return $result;
    }
public function getShipment($shipment_id)
    {
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM shipment WHERE shipment_id = '$shipment_id'";
        $result =$con->query($sql) or die($con->error);
        return $result;
    }

public function setStatusCancelShipmentOrders($order_id,$status_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE orders SET order_status = '$status_id' WHERE order_id = '$order_id'";
        $con->query($sql) or die($con->error);
        
    }


public FUnction getConfirmShipments()
{
        $con=$GLOBALS["con"];
        $sql = "SELECT 
                h.*, 
                b1.branch_name AS start_branch_name,
                b2.branch_name AS destination_branch_name,
                b1.branch_id AS start_branch_id,
                b2.branch_id AS destination_branch_id
            FROM shipment h
            JOIN branch b1 ON h.shipment_start_location = b1.branch_id
            JOIN branch b2 ON h.shipment_destination_location = b2.branch_id WHERE shipment_status = 'Confirm'";
        $result =$con->query($sql) or die($con->error);
        return $result; 
}


public function deliveryAssignedShipment($shipment_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE shipment SET shipment_status = 'Delivery Assigned' WHERE shipment_id = '$shipment_id'";
        $con->query($sql) or die($con->error);
        
    }



public function getDeliveries($warehouse_location)
    {
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM delivery del WHERE del.destination_location = '$warehouse_location'";
        $result =$con->query($sql) or die($con->error);
        
    }

    //for reports


    public function getWarehouseStatusSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                os.status_name,
                COUNT(o.order_id) AS total_parcels
            FROM orders o
            INNER JOIN order_status os
                ON os.status_id = o.order_status
            WHERE o.order_status IN (2,3,4,5)
            GROUP BY o.order_status
            ORDER BY os.status_id";

    return $con->query($sql);
}

public function getDestinationDistrictSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                b.branch_name,
                COUNT(o.order_id) AS total_parcels
            FROM orders o
            INNER JOIN branch b
                ON b.branch_id = o.order_location
            WHERE o.order_status IN (2,3,4,5)
            GROUP BY o.order_location
            ORDER BY total_parcels DESC";

    return $con->query($sql);
}

public function getDeliveryTypeSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                delivery_type,
                COUNT(order_id) AS total_parcels
            FROM orders
            WHERE order_status IN (2,3,4,5)
            GROUP BY delivery_type
            ORDER BY total_parcels DESC";

    return $con->query($sql);
}

public function getIncomingDeliveriesReport($from_date, $to_date)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                o.order_id,
                o.order_date,
                pk.pkg_type,
                o.delivery_type,
                b.branch_name,
                os.status_name
            FROM orders o
            INNER JOIN package pk
                ON pk.order_id = o.order_id
            INNER JOIN branch b
                ON b.branch_id = o.order_location
            INNER JOIN order_status os
                ON os.status_id = o.order_status
            WHERE o.order_status IN (2,3)
            AND DATE(o.order_date) BETWEEN '$from_date' AND '$to_date'
            ORDER BY o.order_date ASC";

    return $con->query($sql);
}

public function getOutForDeliveryReport($from_date, $to_date)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                o.order_id,
                of.ofd_date,
                p.pkg_type,
                o.delivery_type,
                b.branch_name,
                dr.driver_name
            FROM orders o
            INNER JOIN package p
                ON p.order_id = o.order_id
            INNER JOIN branch b
                ON b.branch_id = o.order_location
            INNER JOIN ofd of
                ON of.order_id = o.order_id
            INNER JOIN driver dr
                ON dr.driver_id = of.driver_id
            WHERE DATE(of.ofd_date) BETWEEN '$from_date' AND '$to_date'
            ORDER BY of.ofd_date ASC";

    return $con->query($sql);
}

public function getShipmentSummaryReport($from_date, $to_date)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                s.shipment_id,
                s.shipment_date,
                b.branch_name,
                COUNT(so.order_id) AS total_parcels
            FROM shipment s
            INNER JOIN shipment_orders so
                ON so.shipment_id = s.shipment_id
            INNER JOIN branch b
                ON b.branch_id = s.shipment_destination_location
            WHERE DATE(s.shipment_date) BETWEEN '$from_date' AND '$to_date'
            GROUP BY s.shipment_id
            ORDER BY s.shipment_date ASC";

    return $con->query($sql);
}

//for landing page summary counts

public function getConfirmedOrderCount($order_location)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(order_id)as confirmed_count FROM orders WHERE order_status = 3 AND order_location = '$order_location';";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

public function getIncomingDeliveriesCount($warehouse_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT COUNT(del.delivery_id) AS incoming_count
            FROM delivery del
            WHERE del.delivery_status = 'Started'
            AND del.destination_location = '$warehouse_location'";

    $result = $con->query($sql) or die($con->error);

    return $result;
}


public function getOfdOrdersCount($user_location, $status)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT COUNT(o.order_id) AS ofd_count
            FROM orders o
            WHERE o.order_status = '$status'
            AND o.order_location = '$user_location'
            AND o.district_id = o.order_location";

    $result = $con->query($sql) or die($con->error);

    return $result;
}

//for charts

public function getWarehouseStatusChart($user_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                os.status_name,
                COUNT(o.order_id) AS total_parcels
            FROM orders o
            INNER JOIN order_status os
                ON os.status_id = o.order_status
            WHERE o.order_location = '$user_location'
            AND o.order_status IN (2,3,4,5)
            GROUP BY o.order_status
            ORDER BY os.status_id";

    return $con->query($sql);
}

public function getDestinationDistrictChart($user_location)
{
    $con = $GLOBALS["con"];
    $sql = "SELECT
                d.district_name,
                COUNT(o.order_id) AS total_parcels
            FROM orders o
            INNER JOIN district d
                ON d.district_id = o.district_id
            WHERE o.order_location = '$user_location'
            AND o.order_status IN (2,3,4,5)
            GROUP BY o.district_id
            ORDER BY total_parcels DESC";

    return $con->query($sql);
}










}




?>