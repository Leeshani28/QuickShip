<?php 
include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/user_model.php';

if(!isset($_GET["user_id"])){
    ?>
    <script>
        window.location="login.php";
    </script>
    <?php
}

$userObj=new User();
$user_id=$_GET["user_id"];
$user_id=base64_decode($_GET["user_id"]);
$userResult=$userObj->getUser($user_id);
$userdetailrow=$userResult->fetch_assoc();

$userContactResult=$userObj->getUserContact($user_id);
$contactrow1=$userContactResult->fetch_assoc();
$contactrow2=$userContactResult->fetch_assoc();


/// to get the information from the session

$userrow=$_SESSION["user"];
$moduleObj= new Module();
$userObj=new User();

$moduleResult= $moduleObj->getAllModules();
$userResult=$userObj->getAllUsers();

$functionArray=array();
$userfunctionResult=$userObj->getUserFunctions($user_id);
while($fun_row=$userfunctionResult->fetch_assoc())
{
    array_push($functionArray,$fun_row["fun_id"]);
}

//print_r($moduleResult);
// print_r($userrow);


?>



<html>
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
                            View User
                        </li>
                    </ol>
                </nav>

                <div class="col-md-10">
                    <a href="add_user.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-plus"></span> Add User</button></a>
                    <a href="view_users.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Users</button></a>
                    <a href=""><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate User Reports</button></a>
                </div>


            </div>

            <div class="row">
                &nbsp
            </div>
            <div class="row">
                &nbsp
            </div>
            
            <div class="col-md-12">

                <div class="col-md-5" style="height:450px">
                    
                
                <?php
                    $img=$userdetailrow["user_image"];
                    if($img==""){
                        $img="default_user.jpg";
                    }

                    ?>

                  <div style="text-align: center; padding-left:0;">
                    <img src="../images/courier_images/<?php echo $img;?>" width="160px" height="150px">
                  </div>

                  <div class="row" style="height: 10px;"></div>
                  <div class="row" >
                        
                        <div class="col-md-12 text-center"> 
                            <h2><?php echo $userdetailrow["user_fname"]; ?> <?php echo $userdetailrow["user_lname"]; ?> </h2>
                            
                        </div>
                        
                    </div>
                  <div class="row" style="height: 30px;"></div>


                  <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
            <tbody>
                

            
                <tr>
                    <th style="width:40%">Date of Birth</th>
                    <td><?php echo $userdetailrow["user_dob"]; ?></td>
                </tr>

                <tr>
                    <th>NIC</th>
                    <td><?php echo $userdetailrow["user_nic"]; ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?php echo $userdetailrow["user_email"]; ?></td>
                </tr>

                <tr>
                    <th>Mobile Number</th>
                    <td><?php echo $contactrow1["contact_number"]; ?></td>
                </tr>

                <tr>
                    <th>Fixed Number</th>
                    <td><?php echo $contactrow2["contact_number"]; ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo $userdetailrow["role_name"]; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td
                        <?php 
                        $status = "Active";
                        if ($userdetailrow["user_status"] == 0){
                            $status = "Deactive";
                        } 
                        
                        
                        ?>
                        <?php
                        if ($userdetailrow["user_status"] == 1) {
                            ?>
                            class = "success"
                            <?php
                        } elseif ($userdetailrow["user_status"] == 0){
                            ?>
                            class="danger"
                            <?php

                        }

                        ?>> <?php echo $status ?>
                    </td>
                </tr>
                
                

            </tbody>
        </table>
    </div>

</div>
<div class="row">
                &nbsp
            </div>
            
        
        <div class="row">
                &nbsp
            </div>

                    
                </div>






                <div class="col-md-7">
                    
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-12 text-center">
                            <h3><?php echo $userdetailrow["role_name"]; ?> </h3>
                        </div>
                    </div>

                


                <div class="row">
                        <div class="col-md-12">
                        </div>
                </div>
                    

                <div class="row">
                    <div class="panel panel-default">
                            <div class="panel-body"
                                style="background: #d2f6f6;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

                    

                        <div id="display_functions">
                           <?php 
                           $role_id = $userrow["user_role"];
        
                           $moduleResult=$userObj->getRoleModules($role_id);
                           
                           while ($module_row=$moduleResult->fetch_assoc())
                           {
                               $module_id = $module_row["module_id"];
                               $functionResult = $userObj->getModuleFunctions($module_id);
                               ?>
                                   <div class="col-md-4" style="margin-bottom: 10px;">
                                       <h6>
                                           <?php
                                               echo $module_row["module_name"];
                                               echo "</br>";
                                           ?>
                                       </h6>
                                           <?php
                                               while($fun_row=$functionResult->fetch_assoc()){
                                                   ?>
                                       <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"];?>" onclick="return false;" readonly="readonly"
                                       <?php 
                                       
                                       if(in_array($fun_row["function_id"],$functionArray)){
                                       
                                       ?>
                                       
                                       checked

                                       <?php 
                                       }
                                       
                                       ?>
                                       
                                       />
                                                   <span style="font-size: 12px;"><?php echo $fun_row["function_name"];?></span>
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
                        </div>
                        </div>
                </div>
                </div>

                


        </div>
    </div>
</body>
<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/uservalidation.js"></script>

</html>