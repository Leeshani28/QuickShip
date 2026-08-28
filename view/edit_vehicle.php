<?php
include_once '../commons/session.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';
include '../model/branch_model.php';

$userrow = $_SESSION["user"];

$vehicleObj = new vehicle();
$deliveryObj = new Delivery();
$branchObj = new Branch();

// $districtResult = $deliveryObj->getAllDistrict();
$vehiclebranchResult = $branchObj->getAllBranches();


$vehicle_id = base64_decode($_GET["vehicle_id"]);
$vehicleResult = $vehicleObj->getVehicle($vehicle_id);
$vehiclerow = $vehicleResult->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once "../includes/bootstrap_css_includes.php"?>
    <title>Edit Vehicle</title>
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
                            <li class="breadcrumb-item">
                                <a href="view_vehicles.php"> View Vehicles</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Vehicles 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_vehicle.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Vehicle</button></a>
                    <a href="view_vehicles.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Vehicles</button></a>
                    <a href="vehicle_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Vehicle Reports</button></a>
                    </div>
       
            </div>


            <div class="row">
                &nbsp

            </div>
            <div class="row">
                &nbsp

            </div>

    <div class="row"><br></div>

   
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-info" style="border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.15);">

                
                <div class="panel-heading text-center" 
                     style="font-size:22px; font-weight:bold; border-top-left-radius:12px; border-top-right-radius:12px;">
                    <span class="glyphicon glyphicon-edit"></span> Edit Vehicle Details
                </div>

                
                <div class="panel-body" style="background:#f9f9f9; padding:30px; border-radius:0 0 12px 12px;">

                    <form action="../controller/vehicle_controller.php?status=update_vehicle" method="post">

                        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id?>">

                        
                        <?php if(isset($_GET["msg"])) { ?>
                            <div class="alert alert-danger text-center">
                                <?php echo base64_decode($_GET["msg"]); ?>
                            </div>
                        <?php } ?>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>Vehicle Number</strong></label>
                                <input type="text" class="form-control input-lg" name="vehicle_number"
                                    value="<?php echo $vehiclerow["vehicle_number"] ?>">
                            </div>                            
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>Vehicle Type</strong></label>
                                
                                    <div class="form-group">
    
                                                    <select name="vehicle_type" id="vehicle_type"
                                                        class="form-control custom-dropdown input-lg">
                                                        <option selected disabled>Select Vehicle Type</option>
                                                        <option value="Lorry" <?php if ($vehiclerow['vehicle_type'] == "Lorry") echo "selected"; ?>>Lorry</option>
                                                        <option value="Three-wheeler" <?php if ($vehiclerow['vehicle_type'] == "Three-wheeler") echo "selected"; ?>>Three-wheeler</option>
                                                        <option value="Motor bike" <?php if ($vehiclerow['vehicle_type'] == "Motor bike") echo "selected"; ?>>Motor bike</option>
                                                        <option value="Van" <?php if ($vehiclerow['vehicle_type'] == "Van") echo "selected"; ?>>Van</option>
                                                        <option value="Truck" <?php if ($vehiclerow['vehicle_type'] == "Truck") echo "selected"; ?>>Truck</option>
                                                    </select>
                                                </div>
                            </div>
                        </div>

                        <br>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <label><strong>Vehicle Capacity (Kg)</strong></label>
                                <input type="text" class="form-control input-lg" name="vehicle_capacity"
                                    value="<?php echo $vehiclerow["vehicle_capacity"] ?>">

                            </div>

                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>Branch</strong></label>
                                <select name="vehicle_district" id="vehicle_district" class="form-control custom-dropdown input-lg">
                                    <?php 
                                    while($branchRow=$vehiclebranchResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"]==$vehiclerow["vehicle_district"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $branchRow["branch_name"]; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                    
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label><strong>Vehicle Location</strong></label>
                                <select name="vehicle_location" id="vehicle_location" class="form-control custom-dropdown input-lg">
                                    <?php 
                                    mysqli_data_seek($vehiclebranchResult, 0);
                                    while($branchRow=$vehiclebranchResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"]==$vehiclerow["vehicle_location"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $branchRow["branch_name"]; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                    
                                </select>
                            </div>

                        </div>

                        <br><br>

                      
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <input type="reset" class="btn btn-danger btn-lg" 
                                       style="border-radius:8px;" value="Reset">
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary btn-lg"
                                        style="border-radius:8px;">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/uservalidation.js"></script>

</body>
</html>