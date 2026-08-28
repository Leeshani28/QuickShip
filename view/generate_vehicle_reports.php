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

        <?php $pageName = "VEHICLE MANAGEMENT"; ?>

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

                    <li class="breadcrumb-item">
                        <a href="vehicle.php">Vehicle Management</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Generate Vehicle Reports
                    </li>

                </ol>

            </nav>

        </div>

        <div class="col-md-10">

            <a href="add_vehicle.php">
                <button type="button" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add Vehicle
                </button>
            </a>

            <a href="view_vehicles.php">
                <button type="button" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-search"></span>
                    View Vehicles
                </button>
            </a>

            <a href="vehicle_reports.php">
                <button type="button" class="btn btn-warning btn-lg">
                    <span class="glyphicon glyphicon-book"></span>
                    Generate Reports
                </button>
            </a>

        </div>

    </div>

    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>

    <div class="container">

        <h2 style="margin-top:20px;
                   margin-bottom:25px;
                   text-align:center;">

            <span class="glyphicon glyphicon-list-alt"></span>

            Vehicle Management Reports

        </h2>

        <!-- Vehicle Status Summary -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('vehicle_summary_report.php','_blank')">

                    <span class="glyphicon glyphicon-stats"></span>

                    Vehicle Status Summary

                </button>

            </div>

        </div>

        <!-- Vehicles by District -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('vehicle_district_report.php','_blank')">

                    <span class="glyphicon glyphicon-map-marker"></span>

                    Vehicles by District

                </button>

            </div>

        </div>

        <!-- Vehicle Type Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('vehicle_type_report.php','_blank')">

                    <span class="glyphicon glyphicon-road"></span>

                    Vehicle Type Report

                </button>

            </div>

        </div>

        <!-- Maintenance Vehicles Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('maintenance_vehicle_report.php','_blank')">

                    <span class="glyphicon glyphicon-wrench"></span>

                    Maintenance Vehicles Report

                </button>

            </div>

        </div>

        <div class="row">&nbsp;</div>

    </div>

</div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>

</body>

</html>