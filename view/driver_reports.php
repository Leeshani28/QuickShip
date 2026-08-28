<?php

include_once '../commons/session.php';


$userrow=$_SESSION["user"];


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
                                Generate Driver Reports 
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



            
            </div>
               
        </div>
   
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

     </body>
</html>