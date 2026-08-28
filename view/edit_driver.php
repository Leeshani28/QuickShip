<?php

include_once '../commons/session.php';
include_once '../model/driver_model.php';
include '../model/delivery_model.php';
include '../model/branch_model.php';

$userrow=$_SESSION["user"];

$driverObj = new Driver();
$deliveryObj = new Delivery();
$branchObj = new Branch();

// $branchResult = $branchObj->getAllBranches();
$locationBranchResult = $branchObj->getAllBranches();

$driver_id=base64_decode($_GET["driver_id"]);

$driverResult = $driverObj->getDriver($driver_id);
$driverrow = $driverResult->fetch_assoc();

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
                            <li class="breadcrumb-item">
                                <a href="view_drivers.php">View Drivers</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Driver 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_driver.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Driver</button></a>
                    <a href="view_drivers.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Drivers</button></a>
                    <a href="driver_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Driver Reports</button></a>
                    </div>
       
            </div>

            <div class="row">
                &nbsp

            </div>
            <div class="row">
                &nbsp

            </div>

            <div class="row">

            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-body"
                                style="background: #d2e5e5;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <form action="../controller/driver_controller.php?status=update_driver" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg">
                            
                        </div>
                        <input type="hidden" name="driver_id" value="<?php echo $driver_id?>">

                        <?php
                        if(isset($_GET["msg"]))
                        {
                        ?>
                         <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                            <?php  echo base64_decode($_GET["msg"]);    ?>
                        </div>
                        <?php 
                        }
                        ?>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label" style="text-align: right;">Category</label>
                        </div>
                        <div class="col-md-4 dropdown">
                            <div class="form-group">

                                <select name="driver_categary" id="driver_categary" class="form-control custom-dropdown">
                                    <option selected disabled>Select Driver Categery</option>
                                    <option value="Driver" <?php if ($driverrow['driver_categary'] == "Driver")
                                        echo "selected"; ?>>Driver</option>
                                    <option value="Rider" <?php if ($driverrow['driver_categary'] == "Rider")
                                        echo "selected"; ?>>Rider</option>
                                </select>
                            </div>

                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label"> Name</label>
                        </div>
                        <div class="col-md-4">
                            
                            <input type="text" class="form-control" name="driver_name" id="driver_name" value="<?php echo $driverrow["driver_name"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">NIC</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="driver_nic" id="driver_nic" value="<?php echo $driverrow["driver_nic"] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Date of Birth</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="driver_date_of_birth" id="driver_date_of_birth" value="<?php echo $driverrow["driver_date_of_birth"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Mobile Number</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="driver_phone_number" id="driver_phone_number" value="<?php echo $driverrow["driver_phone_number"] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">License No.</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="license_number" id="license_number" placeholder="Ex: B1234567" value="<?php echo $driverrow["license_number"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">License Expiry Date</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="license_expiry_date" id="license_expiry_date" value="<?php echo $driverrow["license_expiry_date"] ?>"/>
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
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Address</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="driver_address" id="driver_address" value="<?php echo $driverrow["driver_address"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Branch</label>
                        </div>
                            

                        <div class="col-md-4">
                            <select name="driver_district" id="driver_district" class="form-control custom-dropdown">
                                    <?php
                                     
                                    mysqli_data_seek($locationBranchResult, 0);
                                    while($branchRow=$locationBranchResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"] == $driverrow["driver_district"]){
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
                    <div class="row">
                        <div class="col-md-12"> &nbsp; </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Profile Picture</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" class="form-control" name="driver_profile_picture" id="driver_profile_picture" onchange="displayImage(this);"/>
                            <br/>


                            <?php 
                            if($driverrow["driver_profile_picture"] !=""){
                              $image= $driverrow["driver_profile_picture"];
                            ?>
                            <img id="img_prev" style="" src="../images/courier_images/<?php echo $image; ?>" width="60px" height="80px"/>
                            <?php 
                            }
                            ?>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Driver Location</label>
                        </div>
                            

                        <div class="col-md-4">
                            <select name="driver_location" id="driver_location" class="form-control custom-dropdown">
                                    <?php
                                     
                                     mysqli_data_seek($locationBranchResult, 0);
                                    while($branchRow=$locationBranchResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"] == $driverrow["driver_location"]){
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

                    <div class="row">
                        <div class="col-md-12"> &nbsp; </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Save Changes
                            </button>
                        </div>

                    </div>
                </div>
            </form>
            </div>
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