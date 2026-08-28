<?php

include_once '../commons/session.php';

$userrow = $_SESSION["user"];

?>

<html>

<head>

    <?php include_once "../includes/bootstrap_css_includes.php"; ?>

</head>

<body>

<div class="container">

    <div class="row">

        <?php $pageName = "REPORTS"; ?>

        <?php
        if($userrow["user_role"]==1){
            include_once "../includes/header_row_includes_admin.php";
        }else{
            include_once "../includes/header_row_includes2.php";
        }
        ?>

        <!-- Breadcrumb -->

        <div class="row">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <button type="button"
                            class="btn btn-primary"
                            onclick="history.back()">

                        ← Back

                    </button>

                    <li class="breadcrumb-item">
                        <a href="dashboard_new.php">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                         Reports
                    </li>

                </ol>

            </nav>

        </div>


    </div>

    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>

    <div class="container">

        <h2 style="margin-top:20px;
                   margin-bottom:25px;
                   text-align:center;">

            <span class="glyphicon glyphicon-list-alt"></span>

            Module Reports

        </h2>

        <!-- Vehicle Status Summary -->

        <div class="row">

            <div class="col-md-4">

                <a href="users_report.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-user"></span>
                    
                    User Reports
                </a>

            </div>

            <div class="col-md-4">

                <a href="generate_warehouse_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-home"></span>
                    
                    Warehouse Reports
                </a>

            </div>

            <div class="col-md-4">

                <a href="generate_vehicle_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-road"></span>
                    
                   Vehicle Reports
                </a>

            </div>

            

        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
        </div>
        <div class="row">
        </div>

        <div class="row">

            <div class="col-md-4">

                <a href="generate_driver_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-user"></span>
                    
                     Driver Reports
                </a>

            </div>
            <div class="col-md-4">

                <a href="customer_list_report.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-user"></span>
                    
                    Customer Reports
                </a>

            </div>
            <div class="col-md-4">

                <a href="generate_order_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-list-alt"></span>
                    
                    Order Reports
                </a>

            </div>

        </div>

        <div class="row">&nbsp;</div>
        <div class="row">

        
        </div>
        <div class="row">

        </div>
        <div class="row">

            <div class="col-md-4">

                <a href="generate_delivery_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-send"></span>
                    
                    Delivery Reports
                </a>

            </div>
            <div class="col-md-4">

                <a href="generate_package_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-gift"></span>
                    
                   Package Reports
                </a>

            </div>
            <div class="col-md-4">

                <a href="Generate_finance_reports.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-usd"></span>
                    
                    Finance Reports
                </a>

            </div>

        </div>
        <div class="row">&nbsp;</div>
        <div class="row">

        
        </div>
        <div class="row">

        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <a href="Generate_branch_reports_copy.php" class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;">

                    <span class="glyphicon glyphicon-map-marker"></span>
                    
                    Branch Reports
                </a>

            </div>
            
            

        </div>

        <div class="row">&nbsp;</div>

    </div>

</div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>

</body>

</html>