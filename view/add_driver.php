<?php

include_once '../commons/session.php';
include_once '../model/driver_model.php';
include '../model/delivery_model.php';
include '../model/branch_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$userObj = new Driver();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$driverbranchResult = $branchObj->getAllBranches();

?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="DRIVER MANAGEMENT" ?>
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
                                <a href="driver.php">Driver Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Driver 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_driver.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Driver</button></a>
                    <a href="view_drivers.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Drivers</button></a>
                    <a href="generate_driver_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Driver Reports</button></a>
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
                    <div class="panel panel-info" style="height:510px;border-radius: 10px;border: 1px solid #82f2f2d6;">
                        <div class="panel-heading" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                    <i class="bi bi-person" style="font-size: 25px; margin-right: 5px;color:blue;"></i><b><h4 class="text-left"><b>Driver Informations</b></h4></b>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="../controller/driver_controller.php?status=add_driver"
                                    method="post" enctype="multipart/form-data">
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
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Category</label>
                                            </div>
                                            <div class="col-md-4 dropdown">
                                                <div class="form-group">
    
                                                    <select name="driver_categary" id="driver_categary"
                                                        class="form-control custom-dropdown">
                                                        <option selected disabled>Select Category</option>
                                                        <option value="Driver">Driver</option>
                                                        <option value="Rider">Rider</option>
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
                                                <label class="control-label" style="text-align: right;">Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="driver_name" id="driver_name" />
                                            </div>

                                            <div class="col-md-2 text-right">
                                                <label class="control-label">NIC</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="driver_nic" id="driver_nic" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Date of Birth</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" class="form-control" name="driver_date_of_birth" id="driver_date_of_birth" />
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Mobile Number</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="driver_phone_number" id="driver_phone_number" />
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">License No.</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="license_number" id="license_number" placeholder="Ex: B1234567"/>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">License Expiry Date</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" class="form-control" name="license_expiry_date" id="license_expiry_date" />
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Address</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="driver_address" id="driver_address" />
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Branch</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
    
                                                    <select name="driver_district" id="driver_district" class="form-control custom-dropdown">
                                                        <option value="">Select Branch</option>
                                                        <?php 
                                                        // mysqli_data_seek($districtResult, 0);
                                                        while($branchrow = $driverbranchResult->fetch_assoc()){?>
                                                            <option value="<?php echo $branchrow["branch_id"];?>">
                                                                <?php echo $branchrow["branch_name"];?>
                                                            </option>
                                                            <?php }?>

            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                        </div>
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-2 text-right">
                                                <label class="control-label ">Profile Picture</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" class="form-control" name="driver_profile_picture"
                                                    id="driver_profile_picture" onchange="displayImage(this);" />
                                                <br />
                                                <img id="img_prev" style="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <input type="submit" class="btn btn-success btn-lg" value="Submit" />
                                                </div>
                                            </div>
                                        </div>
                                        </div>


                                    </div>
                                </form>


                </div>
                    
                </div>
                </div>
            </div>
               
        </div>
   
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../js/drivervalidation.js"></script>

    <script>
        function displayImage(input){
            if(input.files && input.files[0])
            {
               var reader = new FileReader();
               reader.onload = function (e){
               $("#img_prev").attr('src',e.target.result).width(80).height(60);
               
               };
               reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

     </body>
</html>