<?php

include_once '../commons/session.php';
include_once '../model/user_model.php';
include '../model/delivery_model.php';
include '../model/branch_model.php';


//get user information from session
$userrow=$_SESSION["user"];

$userObj = new User();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$branches = $branchObj->getAllBranches();

$roleResult = $userObj->getAllRoles();

$user_id=base64_decode($_GET["user_id"]);

///
$userResult = $userObj->getUser($user_id);
$contactResult = $userObj->getUserContact($user_id);

$contactrow1 = $contactResult->fetch_assoc();
$contactrow2 = $contactResult->fetch_assoc();



$edituser = $userResult->fetch_assoc();

/////
$functionArray=array();
$userfunctionResult=$userObj->getUserFunctions($user_id);
while($fun_row=$userfunctionResult->fetch_assoc())
{
    array_push($functionArray,$fun_row["fun_id"]);
}

// print_r($functionArray);
?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
    </head>
    <body>
        <div class="container">
            <?php $pageName="USER MANAGEMENT" ?>
            <?php 
            if($userrow["user_role"]==1){
            include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>
            
            <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php $pageName="USER MANAGEMENT" ?>
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="user.php">User Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="view_users.php">View Users</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit User
                        </li>
                    </ol>
                </nav>

                <div class="col-md-10">
                    <a href="add_user.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-plus"></span> Add User</button></a>
                    <a href="view_users.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Users</button></a>
                    <a href="user_report.php?user_id=<?php echo $_GET["user_id"]; ?>"><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate User Reports</button></a>
                </div>


            </div>

            <div class="row">
                &nbsp
            </div>
            <div class="row">
                &nbsp
            </div>
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-body"
                                style="background: #d2e5e5;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <form action="../controller/user_controller.php?status=update_user" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg">
                            
                        </div>
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
                            <label class="control-label">First Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $edituser["user_fname"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Last Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $edituser["user_lname"] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $edituser["user_email"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Date of Birth</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $edituser["user_dob"] ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">NIC</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $edituser["user_nic"] ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Image</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" class="form-control" name="user_image" id="user_image" onchange="displayImage(this);"/>
                            <br/>


                            <?php 
                            if($edituser["user_image"] !=""){
                              $image= $edituser["user_image"];
                            ?>
                            <img id="img_prev" style="" src="../images/courier_images/<?php echo $image; ?>" width="60px" height="80px"/>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Mobile Number</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="cno1" id="cno1" 
                            <?php 
                            if ($contactrow1!=null)
                            {
                            
                            ?>
                            value="<?php echo $contactrow1["contact_number"] ?>"
                            <?php
                            }
                            ?>
                            
                            />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Fixed Number</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="cno2" id="cno2" 
                            
                            <?php 
                            if ($contactrow2!=null)
                            {
                            
                            ?>
                            value="<?php echo $contactrow2["contact_number"] ?>"
                            <?php
                            }
                            ?>
                            
                            
                            
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">User Role</label>
                        </div>
                        <div class="col-md-4">
                            <select  name="user_role" id="user_role" class="form-control" required="required">
                                <option value="">--------</option>
                                <?php 
                                    while($roleRow=$roleResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $roleRow["role_id"]; ?>"
                                    <?php 
                                    if ($roleRow["role_id"]==$edituser["user_role"]){
                                        ?>
                                        selected
                                        <?php


                                    }
                                    ?>

                                    >
                                    <?php  echo $roleRow["role_name"];?>

                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">User Location</label>
                        </div>
                            

                        <div class="col-md-4">
                            <select name="district_id" id="user_location" class="form-control custom-dropdown">
                                    <?php 
                                    while($branchRow=$branches->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"]==$edituser["user_location"]){
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
                        <div id="display_functions">
                           <?php 
                           $role_id = $edituser["user_role"];
        
                           $moduleResult=$userObj->getRoleModules($role_id);
                           
                           while ($module_row=$moduleResult->fetch_assoc())
                           {
                               $module_id = $module_row["module_id"];
                               $userfunctionResult = $userObj->getModuleFunctions($module_id);
                               ?>
                                   <div class="col-md-4" style="margin-bottom: 10px; min-height: 170px;">
                                       <h5 style="font-weight: bold;">
                                           <?php
                                               echo $module_row["module_name"];
                                               echo "</br>";
                                           ?>
                                       </h5>
                                           <?php
                                               while($fun_row=$userfunctionResult->fetch_assoc()){
                                                   ?>
                                       <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"];?>"
                                       <?php 
                                       
                                       if(in_array($fun_row["function_id"],$functionArray)){
                                       
                                       ?>
                                       
                                       checked

                                       <?php 
                                       }
                                       
                                       ?>
                                       
                                       />
                                                   <?php echo $fun_row["function_name"];?>
                                                   <br/>
                                                   <?php
                                               }
                                           ?>
                                   </div>
                               <?php
                           }
                           
                           
                           
                           
                           
                           
                           
                           ?> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
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
    </body>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/uservalidation.js"></script>
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
</html>