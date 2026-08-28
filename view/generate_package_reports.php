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

        <?php $pageName = "PACKAGE MANAGEMENT"; ?>

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
                        <a href="package.php">Package Management</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Generate Package Reports
                    </li>

                </ol>

            </nav>

        </div>

            <div class="col-md-10">
            <a href="view_packages.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Packages</button></a>
            <a href="generate_package_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Package Reports</button></a>
            </div>

    </div>

    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>

    <div class="container">

        <h2 style="margin-top:20px;
                   margin-bottom:25px;
                   text-align:center;">

            <span class="glyphicon glyphicon-list-alt"></span>

            Package Management Reports

        </h2>

        <!-- Packages by Package Type Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('package_type_report.php','_blank')">

                    <span class="glyphicon glyphicon-th-large"></span>

                    Packages by Package Type Report

                </button>

            </div>

        </div>

        <!-- Package Weight Distribution Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('package_weight_distribution_report.php','_blank')">

                    <span class="glyphicon glyphicon-stats"></span>

                    Package Weight Distribution Report

                </button>

            </div>

        </div>

        <!-- Fragile vs Non-Fragile Packages Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('fragile_report.php','_blank')">

                    <span class="glyphicon glyphicon-warning-sign"></span>

                    Fragile vs Non-Fragile Packages Report

                </button>

            </div>

        </div>

        <!-- Package Details Report -->

        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <button class="btn btn-block btn-lg"
                        style="background:#BBDEFB;
                               border-color:#90CAF9;
                               color:#0D47A1;
                               border-radius:8px;
                               margin-bottom:15px;"
                        onclick="window.open('package_list_report.php','_blank')">

                    <span class="glyphicon glyphicon-list"></span>

                    Package Details Report

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