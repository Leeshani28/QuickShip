<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';
include_once '../model/branch_model.php';

$userrow=$_SESSION["user"];

$orderObj = new Order();
$warehouseObj = new Warehouse();
$driverObj = new Driver();
$vehicleObj = new vehicle();
$deliveryObj = new Delivery();
$branchObj = new Branch();

//$districtResult = $deliveryObj->getAllDistrict();
$branch = $branchObj->getAllBranches();

$orderResult = $orderObj->getAllOrderCount();
$warehouseResult = $warehouseObj->getConfirmShipments();
$location = $userrow["user_location"];
$driverResult = $driverObj->getAllAvailableDrivers($location);
$vehicleResult = $vehicleObj->getAllAvailableVehicles($location);

$orderrow = $orderResult->fetch_assoc();


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="DELIVERY MANAGEMENT" ?>
                   <?php 
            if($userrow["user_role"]==1){
            include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>


                <!-- Breadcrumb -->

                   <div class="row">
                    

                    <nav aria-label="breadcrumb">
                        
                        <ol class="breadcrumb">
                            <button type="button" class="btn btn-primary" onclick="history.back()"> ← Back </button>
                            
                            <li class="breadcrumb-item">
                                <a href="dashboard_new.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="delivery.php">Delivery Management</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Delivery 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_delivery.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Delivery</button></a>
                    <a href="view_delivery.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Deliveries</button></a>
                    <a href="generate_delivery_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Delivery Reports</button></a>
                    </div>
       
            </div>

            <div class="row">
                &nbsp

            </div>
            <div class="row">
                &nbsp

            </div>

            <div class="row">

            <div class="col-md-12">
                <?php 
                if(isset($_GET["msg"])){
                    $msg= base64_decode($_GET["msg"]);

                
                
                ?>
                <div class="row" id="msg">
                    <div class="alert alert-success">
                        <?php echo $msg ?>

                    </div>

                </div>

                <?php 
                }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-info table-striped" id="deliverytable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Start Location</th>
                                    <th width="10%">Destination Location</th>
                                    <th width="20%">Assign Driver</th>
                                    <th width="20%">Assign Vehicle</th>
                                    <th width="15%">Shipment Status</th>
                                    <th width="20%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                
                                while($shipmentrow = $warehouseResult->fetch_assoc()){

                                    $shipment_id = $shipmentrow["shipment_id"];


                                    $status="Confirm";
                                    if($shipmentrow["shipment_status"]=="Confirm"){
                                        $status="Confirm";

                                    }

                                     if ($shipmentrow["shipment_status"] == "Confirm") {
                                    $color = "bg-success";

                                }
                                
                                
                                
                                ?>
                                
                                <tr>
                                    <td>
                                        <?php 
                                        echo $shipmentrow["shipment_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $shipmentrow["start_branch_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $shipmentrow["destination_branch_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
    
                                                    <select name="select_driver" id="select_driver_<?php echo $shipment_id;?>" class="form-control custom-dropdown">
                                                        <option value="">Select Driver</option>
                                                        <?php 
                                                        mysqli_data_seek($driverResult, 0);
                                                        while($driverrow = $driverResult->fetch_assoc()){?>
                                                            <option value="<?php echo $driverrow["driver_id"];?>">
                                                                <?php echo $driverrow["driver_id"]." - ".$driverrow["driver_name"]." - ".$driverrow["branch_name"]." - ".$driverrow["driver_phone_number"];?>
                                                            </option>
                                                            <?php }?>

            
                                                    </select>
                                                </div>

                                            </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-md-12 dropdown">
                                    <div class="form-group">

                                        <select name="select_vehicle" id="select_vehicle_<?php echo $shipment_id;?>" class="form-control custom-dropdown">
                                            <option value="">Select Vehicle</option>
                                            <?php 
                                            mysqli_data_seek($vehicleResult, 0);
                                            while($vehiclerow = $vehicleResult->fetch_assoc()){?>
                                                <option value="<?php echo $vehiclerow["vehicle_id"];?>">
                                                    <?php echo $vehiclerow["vehicle_number"]." - ".$vehiclerow["vehicle_type"]." - ".$vehiclerow["vehicle_capacity"]."kg"." - ".$vehiclerow["branch_name"] ;?>
                                                </option>
                                                <?php }?>


                                        </select>
                                        </div>
                                    </div>
                                    </div>
                                    </td>
                                    
                                    <td class="<?php echo $color; ?>">
                                    <?php 
                                        echo $shipmentrow["shipment_status"];
                                        
                                        ?>
                                    </td>
                                    
                                    
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-info"
                                            onclick="loadshipmentorders('<?php echo $shipmentrow['shipment_id']; ?>');"><span
                                                class="glyphicon glyphicon-search"></span>&nbsp;View</a>
                                        &nbsp;

                                        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success"
                                                onclick="assigndelivery('<?php echo $shipmentrow['shipment_id']; ?>',
                                                                       '<?php echo $shipmentrow['start_branch_id']; ?>',
                                                                       '<?php echo $shipmentrow['destination_branch_id']; ?>');"><span
                                                                        class="glyphicon glyphicon-share"></span>&nbsp;Assign</a>
                                    
                                    </td>
                                </tr>
                                <?php 
                                }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

            </div>
               
        </div>

     </body>


     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you assign this shipment?</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/delivery_controller.php?status=assign_delivery" method="post">
                <input type="hidden" name="shipment_id" id="assign_shipment_id">
                <input type="hidden" name="start_branch_id" id="assign_start_branch_id">
                <input type="hidden" name="destination_branch_id" id="assign_destination_branch_id">
                <input type="hidden" name="vehicle_id" id="assign_vehicle_id">
                <input type="hidden" name="driver_id" id="assign_driver_id">
                

                <div class="row">
                    <div class="col-md-12" style="text-align:right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">

                            &nbsp;
                            Assign
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div id="display_data">
                
            </div>

        </div>

    </div>
</div>

<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/datatable/datatables.js"></script>
<script>
    $(document).ready(function () {
        $("#deliverytable").DataTable();

    });


</script>
    
    <script>
    function loadshipmentorders(shipment_id) {

        var url = "../controller/warehouse_controller.php?status=load_shipment_orders";

        $.post(url, { shipment_id: shipment_id }, function (data) {
            $("#display_data").html(data).show();
        });

    }

</script>

<script>
    function assigndelivery(shipment_id, start_district_id, destination_district_id) {

    // Read the selected vehicle and driver from that row's dropdowns
    var vehicle_id = document.getElementById("select_vehicle_" + shipment_id).value;
    var driver_id  = document.getElementById("select_driver_"  + shipment_id).value;

        document.getElementById("assign_shipment_id").value = shipment_id;
        document.getElementById("assign_start_branch_id").value = start_district_id;
        document.getElementById("assign_destination_branch_id").value = destination_district_id;
        document.getElementById("assign_vehicle_id").value = vehicle_id;
        document.getElementById("assign_driver_id").value = driver_id;

    }

</script>


</html>