<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';
include_once '../model/user_model.php';
include '../model/branch_model.php';

$userrow=$_SESSION["user"];
$user_location = $userrow["user_location"];
$userObj = new User();
$orderObj = new Order();
$warehouseObj = new Warehouse();
$vehicleObj = new vehicle();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$vehiclebranchResult = $branchObj->getAllBranches();

// $districtResult = $deliveryObj->getAllDistrict();
$orderResult = $orderObj->getAllOrderCount();
$orderrow = $orderResult->fetch_assoc();

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
                                Add Vehicle 
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
                <div class="col-md-11">
                    <div class="panel panel-success" style="height:400px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                        <div class="panel-heading" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                    <i class="bi bi-truck" style="font-size: 25px; margin-right: 5px;color:green;"></i><b><h4 class="text-left">Vehicle Informations</h4></b>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="../controller/vehicle_controller.php?status=add_vehicle"
                                    method="post" id="vehicleform">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3" id="msg">

                                            </div>
                                            <?php
                                            if (isset($_GET["msg"])) {
                                                ?>
                                                <div class="col-md-6 col-md-offset-3 alert alert-danger">
                                                    <?php echo base64_decode($_GET["msg"]); ?>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Vehicle Number</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="vehicle_number" id="vehicle_number">
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Vehicle Type</label>
                                            </div>
                                            <div class="col-md-4 dropdown">
                                                <div class="form-group">
    
                                                    <select name="vehicle_type" id="vehicle_type"
                                                        class="form-control custom-dropdown">
                                                        <option selected disabled>Select Vehicle Type</option>
                                                        <option value="Lorry">Lorry</option>
                                                        <option value="Three-wheeler">Three-wheeler</option>
                                                        <option value="Motor bike">Motor bike</option>
                                                        <option value="Van">Van</option>
                                                        <option value="Truck">Truck</option>
                                                    </select>
                                                </div>

                                                
                                            </div>

                                        </div>
                    
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>

                                        <div class="row">

                                        
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Vehicle Capacity(kg)</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="vehicle_capacity" id="vehicle_capacity">
                                            </div>

                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Branch</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
    
                                                    <select name="vehicle_district" id="vehicle_district" class="form-control custom-dropdown">
                                                        <option>Select Branch</option>
                                                        <?php 
                                                        while($branchrow = $vehiclebranchResult->fetch_assoc()){?>
                                                            <option value="<?php echo $branchrow["branch_id"];?>">
                                                                <?php echo $branchrow["branch_name"];?>
                                                            </option>
                                                            <?php }?>

            
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                     
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <input type="reset" class="btn btn-danger btn-lg" value="Reset">
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="submit" class="btn btn-success btn-lg" value="Submit">
                        </div>
                    </div>
                    </form>


                </div>
                    
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>


            </div>
               
        </div>
        </body>
   
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../js/vehiclevalidation.js"></script>

    <!-- <script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script> -->

     
</html>