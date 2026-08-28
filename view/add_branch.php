<?php

include_once '../commons/session.php';
include_once '../model/branch_model.php';
include_once '../model/delivery_model.php';


//get user information from session
$userrow=$_SESSION["user"];

$branchObj = new Branch();
$deliveryObj = new Delivery();


$districtResult = $deliveryObj->getAllDistrict();

?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="BRANCH MANAGEMENT" ?>
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
                                <a href="branch.php">Branch Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Branch
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
        <a href="add_branch.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Branch</button></a>
        <a href="view_branches.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Branches</button></a>
        <a href="generate_delivery_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Branch Reports</button></a>
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
                    <div class="panel panel-info" style="height:400px;border-radius: 10px;border: 1px solid #82f2f2d6;">
                        <div class="panel-heading" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                    <i class="bi bi-geo-alt" style="font-size: 25px; margin-right: 5px;color:blue;"></i><b><h4 class="text-left"><b>Add Branch</b></h4></b>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal"
      action="../controller/branch_controller.php?status=add_branch"
      method="post">

<div class="col-md-12">

<div class="row">
        <div class="col-md-6 col-md-offset-3" id="msg"></div>
    </div>

    <?php
    if(isset($_GET["msg"])){
    ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 alert alert-danger">
            <?php echo base64_decode($_GET["msg"]); ?>
        </div>
    </div>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- Branch Name -->
    <div class="row">
        <div class="col-md-2 text-right">
            <label class="control-label">Branch Name</label>
        </div>

        <div class="col-md-4">
            <input type="text"
                   class="form-control"
                   name="branch_name"
                   id="branch_name">
        </div>

        <div class="col-md-2 text-right">
            <label class="control-label">District</label>
        </div>

        <div class="col-md-4">
            <select class="form-control"
                    name="branch_district"
                    id="branch_district">

                <option selected disabled>Select District</option>

                <?php
                mysqli_data_seek($districtResult,0);

                while($districtRow=$districtResult->fetch_assoc()){
                ?>

                <option value="<?php echo $districtRow["district_id"]; ?>">
                    <?php echo $districtRow["district_name"]; ?>
                </option>

                <?php } ?>

            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- Address -->
    <div class="row">
        <div class="col-md-2 text-right">
            <label class="control-label">Address</label>
        </div>

        <div class="col-md-4">
            <textarea class="form-control"
                      name="branch_address"
                      id="branch_address"
                      rows="3"></textarea>
        </div>

        <div class="col-md-2 text-right">
            <label class="control-label">Contact No</label>
        </div>

        <div class="col-md-4">
            <input type="text"
                   class="form-control"
                   name="contact_no"
                   id="contact_no">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- Email -->
    <div class="row">
        <div class="col-md-2 text-right">
            <label class="control-label">Email</label>
        </div>

        <div class="col-md-4">
            <input type="email"
                   class="form-control"
                   name="email"
                   id="email">
        </div>

        
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <!-- Buttons -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">

                <div class="col-md-6 text-left">
                    <input type="reset"
                           class="btn btn-danger btn-lg"
                           value="Reset">
                </div>

                <div class="col-md-6 text-right">
                    <input type="submit"
                           class="btn btn-success btn-lg"
                           value="Submit">
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
   
    

     </body>

     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../js/branchvalidation.js"></script>
</html>