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
include '../model/customer_model.php';
include '../model/package_model.php';
include '../model/order_model.php';
include '../model/delivery_model.php';
include_once '../model/user_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';

$userrow = $_SESSION["user"];

$customerObj = new Customer();
$packageObj = new Package();
$orderObj = new Order();
$deliveryObj = new Delivery();
$warehouseObj = new Warehouse();
$driverObj = new Driver();


switch ($status) {



    case "atwarehouse_order":
        $order_id = $_GET["order_id"];
        $status_id = 3;
        $log_remarks = "Order is Added to Warehouse!";
        $order_id = base64_decode($order_id);






        try {
            $warehouseObj->atWarehouseOrder($order_id);
            //add log record
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);

            $msg = "Order #$order_id Added to Warehouse Successfully!";
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_parcels_confirmed.php?msg=<?php echo $msg; ?>";
            </script>

            <?php


        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_parcels_confirmed.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        }

        break;



    case "create_shipment":

        $start_location = $_POST["start_location"];
        $distination_location = $_POST["distination_location"];

        $selected_orders = $_POST["selected_orders"];
        $status_id = 5;
        $log_remarks = "Assigned Shipment";

        try {

        if($distination_location == ""){
            throw new Exception ("Please select a destination location!");

        }
        if(empty($selected_orders)){
            throw new Exception ("Please select at least one order!");

        }

            $shipment_id = $warehouseObj->createShipment($start_location, $distination_location);

            foreach ($selected_orders as $order_id) {

                $warehouseObj->addShipmentOrders($shipment_id, $order_id);

                $warehouseObj->updateAssignedShipments($order_id);
                //add log record
                $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
            }


            // $msg = "Order $order_id Successfully Added!!";
            $msg = base64_encode("Shipment Created Successfully");

            ?>
            <script>
                window.location = "../view/view_shipments.php?msg=<?php echo $msg; ?>";
            </script>


            <?php

        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/add_shipment.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;




    case "outfor_delivery":

        $driver_id = $_POST["driver_id"];
        $ofd_branch = $userrow["user_location"];
        $selected_orders = $_POST["selected_orders"] ?? "";

        $status_id = 7;
        $log_remarks = "Out for delivery!";

        try {

        if($driver_id == ""){
            throw new Exception ("Please select a rider!");

        }
        if(empty($selected_orders)){
            throw new Exception ("Please select at least one order!");

        }
        

            foreach ($selected_orders as $order_id) {
                $warehouseObj->outForDelivery($driver_id,$order_id,$ofd_branch);

               
                $warehouseObj->updateOfdOrders($order_id);
                //add log record
                $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
            }

            $msg = base64_encode("Successfully Assigned to Delivery!");

            ?>
            <script>
                window.location = "../view/outfor_deliveries.php?msg=<?php echo $msg; ?>";
            </script>
            <?php


        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/outfor_deliveries.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;


    case "confirm_shipment":
        $shipment_id = $_POST["shipment_id"];
        $shipment_id = base64_decode($shipment_id);
        $warehouseObj->confirmShipment($shipment_id);
        $warehouseObj->confirmShipmentOrders($shipment_id);
        $msg = "Successfully Confirmed!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_shipments.php?msg=<?php echo $msg; ?>";
        </script>
        <?php

        break;

    case "cancel_shipment":

        $shipment_id = $_POST["shipment_id"];
        $log_remarks = $_POST["remarks"];
        $status_id = 3;
        // $remarks = $_POST["$remarks"] ;          
        $shipment_id = base64_decode($shipment_id);

        try {
            $warehouseObj->cancelShipment($shipment_id);
            $warehouseObj->cancelShipmentOrders($shipment_id);
            // $warehouseObj->getShipmentOrders($shipment_id);
            $shipmentorders = $warehouseObj->getShipmentOrders($shipment_id);

            while ($row = $shipmentorders->fetch_assoc()) {
                $order_id = $row['order_id'];

                $warehouseObj->setStatusCancelShipmentOrders($order_id, $status_id);
                $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
            }

            $msg = "Shipment Canceled";
            $msg = base64_encode($msg);

            // echo $remarks;

            ?>
            <script>
                window.location = "../view/view_shipments.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_shipments.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;



    case "reassign_rider":

        $ofd_id = $_POST["ofd_id"];         
        $driver_id = $_POST["driver_id"];         
        $ofd_id = base64_decode($ofd_id);
        $warehouseObj->reassignRider($ofd_id,$driver_id);
        $msg = "Rider Re-assigned!";
        $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_ofd.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        break;




        case "cancel_order":

        $ofd_id = $_POST["ofd_id"];
        $order_id = $_POST["order_id"];
        $log_remarks = "Returned";
        $status_id = 3;
        // $remarks = $_POST["$remarks"] ;          


        try {
            $warehouseObj->returnedOrder($ofd_id);

            $warehouseObj->setStatusCancelShipmentOrders($order_id, $status_id);
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);


            $msg = "Order Returned";
            $msg = base64_encode($msg);

            // echo $remarks;

            ?>
            <script>
                window.location = "../view/view_ofd.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/view_ofd.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }



        break;


    // to getting unique shipment id
    case "load_shipment_orders":

        $shipment_id = $_POST["shipment_id"];

        ?>
        <div class="modal-header">
            <h4>Orders in Shipment No.<?php

            echo $shipment_id; ?> </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-info table-striped" id="shipmentordertable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Package Type</th>
                                <th width="12%">Fragile Item</th>
                                <th width="10%">Insurance</th>
                                <th width="13%">Weight (kg)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $shipment = $warehouseObj->getShipment($shipment_id);
                            $shipmentorders = $warehouseObj->getShipmentOrders($shipment_id);

                            while ($orderrow = $shipmentorders->fetch_assoc()) {

                                $order_id = $orderrow['order_id']

                                    ?>

                                <tr>
                                    <td>
                                        <?php
                                        echo $orderrow["order_id"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["pkg_type"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["fragile_item"] ? "Yes" : "No";
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $orderrow["insurance"] ? "Yes" : "No";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["pkg_weight"];

                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-md-11" style="text-align:right;">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Back to List</button>
                    </div>
                </div>
            </div>

        </div>
        <script>
            $(document).ready(function () {
                $("#shipmentordertable").DataTable();

            });


        </script>

        <?php
        break;



        case "ofd_order_details":

        $ofd_id = $_POST["ofd_id"];
        $ofdrResult = $warehouseObj->getOfd($ofd_id);
        $ofdrow = $ofdrResult->fetch_assoc();

        ?>
        <div class="modal-header">
            <div class="panel-heading" style="background:#caeff9;color:black;">
                <h3>
                    <b>
                        Order #<?php echo $ofdrow["order_id"]; ?>

                    </b>
                </h3>
                
            </div>
        </div>


        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">


                        <div class="panel-body">

                            
                            <h4><span class="glyphicon glyphicon-list-alt"></span><b> Order Information</b></h4>
                            <hr style="border-top:2px solid #ddd; margin:10px 0;" />

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Driver Name</strong> <?php echo $ofdrow["driver_name"]; ?></p>
                                    
                                </div>
                                
                            </div>

                            <div>
                                &nbsp;
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Delivery Proof</strong></p>
                                    
                                </div>
                                <div class="col-md-4">
                                    <?php
                                        $img=$ofdrow["delivery_proof"];

                                        if($img != ""){
                                        
                                        ?>

                                    <div style="text-align: center; padding-left:0;">
                                        <img src="../images/delivery_proof/<?php echo $img;?>" width="290px" height="170px">
                                    </div>

                                    <?php 
                                    }
                                    ?>

                                    
                                </div>

                            </div>
                           

                        </div>
                        <div>
                            
                        </div>

                        <div class="row">
                    <div class="col-md-11" style="text-align:right;">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Back to List</button>
                    </div>
                </div>
                    </div>

                </div>
            </div>

        </div>
        

        <?php
        break;


    

}