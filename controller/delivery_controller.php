<?php
include '../commons/session.php';
if (!isset($_GET["status"])) {
    ?>
    <script>
        window.location = "../view/login.php";
    </script>
    <?php
}
$status = $_GET["status"];
include '../model/package_model.php';
include '../model/order_model.php';
include '../model/delivery_model.php';
include_once '../model/user_model.php';
include_once '../model/warehouse_model.php';

$userrow = $_SESSION["user"];

$packageObj = new Package();
$orderObj = new Order();
$deliveryObj = new Delivery();
$warehouseObj = new Warehouse();


switch ($status) {

    case "assign_delivery":
        $shipment_id = $_POST["shipment_id"];
        $start_location = $_POST["start_branch_id"];
        $destination_location = $_POST["destination_branch_id"];
        $driver_id = $_POST["driver_id"];
        $vehicle_id = $_POST["vehicle_id"];
        $log_remarks = "Order assigned to the delivery!";
        $status_id = 6;

        try {

            $deliveryObj->addDelivery($shipment_id, $start_location, $destination_location, $driver_id, $vehicle_id);
            $shipmentorders = $warehouseObj->getShipmentOrders($shipment_id);

            while ($row = $shipmentorders->fetch_assoc()) {
                $order_id = $row['order_id'];

                $deliveryObj->setStatusAssignedDeliveryOrders($order_id, $status_id);
                $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
            }

            $driver_status = "Assigned";
            $deliveryObj->updateDriverStatus($driver_id, $driver_status);

            $vehicle_status = "Assigned";
            $deliveryObj->updateVehicleStatus($vehicle_id, $vehicle_status);

            $warehouseObj->deliveryAssignedShipment($shipment_id);


            $msg = "Delivery Assigned!";
            $msg = base64_encode($msg);

            // echo $remarks;

            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                 window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }

        break;


    case "approve_delivery":
        $delivery_id = $_POST["delivery_id"];
        $delivery_id = base64_decode($delivery_id);
        // echo $delivery_id;

        try {



            $deliveryObj->approveDelivery($delivery_id );


            $msg = "Delivey Approved!";
            $msg = base64_encode($msg);



            ?>
            <script>
        window.location="../view/view_delivery.php?msg=<?php echo $msg; ?>";
        </script>
            <?php

        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }

        break;


    case "start_delivery":
        $delivery_id = $_POST["delivery_id"];
        $delivery_id = base64_decode($delivery_id);
        // echo $delivery_id;

        try {



            $deliveryObj->startDelivery($delivery_id );


            $msg = "Delivey Started!";
            $msg = base64_encode($msg);



            ?>
            <script>
        window.location="../view/view_delivery.php?msg=<?php echo $msg; ?>";
        </script>
            <?php

        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }

        break;



    case "receive_delivery":
        $delivery_id = $_GET["delivery_id"];
        $delivery_id = base64_decode($delivery_id);
        $log_remarks = "Delivery Received!";
        $status_id = 3;
        $location_id = $userrow["user_location"];
        
        try {

            $deliveryObj->receiveDelivery($delivery_id);
            
            $deliveryResult = $deliveryObj->getDeliveryDetails($delivery_id);
            $deliveryrow = $deliveryResult->fetch_assoc();
            

            $shipment_id = $deliveryrow["shipment_id"];
            $driver_id = $deliveryrow["driver_id"];
            $vehicle_id = $deliveryrow["vehicle_id"];

            // echo $shipment_id;
            // echo $driver_id;
            // echo $vehicle_id;

        //     foreach($selected_orders as $order_id){

        //      $warehouseObj-> addShipmentOrders($shipment_id,$order_id);
             
        //     $warehouseObj->updateAssignedShipments($order_id);
        //     //add log record
        //     $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
        // }

            $shipmentorders = $warehouseObj->getShipmentOrders($shipment_id);

                while($row = $shipmentorders->fetch_assoc()){
                    $order_id = $row['order_id'];
             


            $deliveryObj->setStatusReceivedDeliveryOrders($order_id,$status_id);
            $orderObj->addOrderLog($order_id,$status_id,$log_remarks);
            $deliveryObj->updateOrderLocation($order_id, $location_id);


                }

            $driver_status = "Available";
            $deliveryObj->updateDriverStatus($driver_id, $driver_status);
            $deliveryObj->updatedriverLocation($driver_id, $location_id);

            $vehicle_status = "Available";
            $deliveryObj->updateVehicleStatus($vehicle_id, $vehicle_status);
            $deliveryObj->updateVehicleLocation($vehicle_id, $location_id);

            $warehouseObj->completeShipment($shipment_id);


            $msg = "Delivey Received!";
            $msg = base64_encode($msg);



            ?>
            <script>
        window.location="../view/incoming_deliveries.php?msg=<?php echo $msg; ?>";
        </script>
            <?php

        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }

        break;



        case "reject_delivery":

        $delivery_id=$_POST["delivery_id"];
        $shipment_id=$_POST["shipment_id"];
        $log_remarks=$_POST["remarks"];
        $status_id = 5;           
 
        $driver_id = $_POST["driver_id"];
        $vehicle_id = $_POST["vehicle_id"];

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        

        try {

            $deliveryObj->rejectDelivery($delivery_id);
            // $warehouseObj->getShipmentOrders($shipment_id);
            $shipmentorders = $warehouseObj->getShipmentOrders($shipment_id);

                while($row = $shipmentorders->fetch_assoc()){
                    $order_id = $row['order_id'];
             


            $deliveryObj->setStatusRejectedDeliveryOrders($order_id,$status_id);
            $orderObj->addOrderLog($order_id,$status_id,$log_remarks);


                }

            $driver_status = "Available";
            $deliveryObj->updateDriverStatus($driver_id, $driver_status);

            $vehicle_status = "Available";
            $deliveryObj->updateVehicleStatus($vehicle_id, $vehicle_status);

            $warehouseObj->confirmShipment($shipment_id);


            $msg = "Delivery Rejected!";
            $msg = base64_encode($msg);

            

            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_delivery.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }

        break;






}