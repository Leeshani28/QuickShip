<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';
include '../model/branch_model.php';


$userrow=$_SESSION["user"];
$vehicle_location = $userrow["user_location"];
$warehouseObj = new Warehouse();
$vehicleObj = new vehicle();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$vehiclebranchResult = $branchObj->getAllBranches();
// $districtResult = $deliveryObj->getAllDistrict();
$vehicleResult = $vehicleObj->getAllVehicles($vehicle_location);

?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="VEHICLE MANAGEMENT" ?>
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
                                <a href="vehicle.php">Vehicle Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                View Vehicles 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_vehicle.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Vehicle</button></a>
                    <a href="view_vehicles.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Vehicles</button></a>
                    <a href="generate_vehicle_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Vehicle Reports</button></a>
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
            if (isset($_GET["msg"])) {
                $msg = base64_decode($_GET["msg"]);



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
                    <table class="table table-info table-striped" id="vehicletable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Vehicle No</th>
                                <th width="15%">Vehicle Type</th>
                                <th width="10%">Capacity(kg)</th>
                                <th width="20%">Branch</th>
                                <th width="10%">Status</th>
                                <th width="30%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($vehiclerow = $vehicleResult->fetch_assoc()) {

                                $vehicle_id  = $vehiclerow["vehicle_id"];
                                $vehicle_id = base64_encode($vehicle_id);

                                if ($vehiclerow["vehicle_status"] == "Available") {
                                    $color = "bg-success";

                                }elseif ($vehiclerow["vehicle_status"] == "Assigned") {
                                    $color = "bg-info";

                                } elseif ($vehiclerow["vehicle_status"] == "Maintenance"){
                                    $color = "bg-danger";
                                } 

                                ?>

                                <tr>
                                    <td>
                                        <?php
                                        echo $vehiclerow["vehicle_id"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $vehiclerow["vehicle_number"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $vehiclerow["vehicle_type"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $vehiclerow["vehicle_capacity"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $vehiclerow["branch_name"];

                                        ?>
                                    </td>

                                    <td class="<?php echo $color; ?>">
                                        <?php
                                        echo $vehiclerow["vehicle_status"];

                                        ?>
                                    </td>
                                    <td>
                                        <a href="edit_vehicle.php?vehicle_id=<?php echo $vehicle_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>

                                        &nbsp;

                                        <?php 
                                            if($vehiclerow["vehicle_status"]=="Maintenance")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/vehicle_controller.php?status=set_available&vehicle_id=<?php echo $vehicle_id; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp;
                                            Set Available
                                        </a>
                                        <?php 
                                            }   
                                        
                                        
                                        ?>
                                        &nbsp;
                                        <?php 
                                            if($vehiclerow["vehicle_status"]=="Available")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/vehicle_controller.php?status=set_maintenance&vehicle_id=<?php echo $vehicle_id; ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-wrench"></span>
                                            &nbsp;
                                            Set Maintenance
                                        </a>
                                        <?php 
                                            }

                                
                                        
                                        ?>
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
   
            <script src="../js/datatable/jquery-3.5.1.js"></script>
            <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
            <script src="../js/datatable/jquery.dataTables.min.js"></script>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../js/datatable/datatables.js"></script>
            <script>
                $(document).ready(function () {
        $("#vehicletable").DataTable();






    });
            </script>

            <script>
                const msg = document.getElementById('msg');

                const delayTime = 3000;

                setTimeout(() => {
                    msg.style.display = 'none';
                }, delayTime);
            </script>

     </body>
</html>