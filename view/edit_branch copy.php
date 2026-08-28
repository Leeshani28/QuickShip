<?php

include_once '../commons/session.php';
include_once '../model/branch_model.php';
include_once '../model/delivery_model.php';

$userrow = $_SESSION["user"];
$branchObj = new Branch();
$deliveryObj = new Delivery();

$branch_id = $_GET["branch_id"];
$branch_id = base64_decode($_GET["branch_id"]);

$districtResult = $deliveryObj->getAllDistrict();
$branchResult = $branchObj->getBranch($branch_id);
$branchrow = $branchResult->fetch_assoc();

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
                <li class="breadcrumb-item">
                    <a href="view_branches.php">View Branches</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Branch
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

            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-body"
                                style="background: #d2e5e5;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <form action="../controller/branch_controller.php?status=update_branch" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg">
                            
                        </div>
                        <input type="hidden" name="branch_id" value="<?php echo $branch_id?>">

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
                        <div class="col-md-2">
                            <label class="control-label">Branch Name</label>
                        </div>
                        <div class="col-md-4">
                            
                            <input type="text" class="form-control" name="branch_name" id="branch_name" value="<?php echo $branchrow["branch_name"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Address</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="branch_address" id="branch_address" value="<?php echo $branchrow["branch_address"] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Contact Number</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $branchrow["contact_no"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $branchrow["email"] ?>"/>
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
                            <label class="control-label">District</label>
                        </div>
                            

                        <div class="col-md-4">
                            <select name="branch_district" id="branch_district" class="form-control custom-dropdown">
                                    <?php 
                                    mysqli_data_seek($districtResult, 0);
                                    while($districtRow=$districtResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $districtRow["district_id"]; ?>"
                                   <?php
                                   if($districtRow["district_id"]==$branchrow["branch_district"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $districtRow["district_name"]; ?>
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
    <script src="../js/branchvalidation.js"></script>
    

     </body>
</html>