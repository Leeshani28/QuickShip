<?php

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/user_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$moduleObj = new Module();

$moduleResult = $moduleObj->getAllModules();

$userObj = new User();
$activeResult = $userObj->getActiveUserCount();
$active_row = $activeResult->fetch_assoc();
$deactiveResult = $userObj->getDeActiveUserCount();
$deactive_row = $deactiveResult->fetch_assoc();
$userResult = $userObj->getAllUserCount();
$user_row = $userResult->fetch_assoc();




?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="USER MANAGEMENT" ?>
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
                            <li class="breadcrumb-item active" aria-current="page">
                                User Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_user.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Add User</button></a>
                    <a href="view_users.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Users</button></a>
                    <a href="users_report.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate User Reports</button></a>
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
            <div class="panel panel-default">
        <div class="panel-body"style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div class="col-md-4">
            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Active Users</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $active_row["user_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Inactive Users</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                         <?php echo $deactive_row["user_count"]; ?> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">All Users</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $user_row["user_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        

        
        </div>
    </div>
</div>
</div>


<div class="row">
    <div class="col-md-12 text-center">
        <div id="tester" style="width:600px;height:250px; margin:0 auto;"></div>
    </div>
</div>
            

            
            
        </div>
        </body>
   
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script>
        var data = [{
  values: [<?php echo $active_row["user_count"]; ?>,<?php echo $deactive_row["user_count"]; ?>],
  labels: ['Active user count', 'De-active user count'],
  type: 'pie'
}];

var layout = {
  height: 400,
  width: 500
};

Plotly.newPlot('tester', data, layout);

    </script>

     
</html>