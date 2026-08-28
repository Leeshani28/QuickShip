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

    </div>

   
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
                    View Branch
                </li>
            </ol>
        </nav>

    </div>

   
    <div class="row">

        <div class="col-md-10">
        <a href="add_branch.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Branch</button></a>
        <a href="view_branches.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Branches</button></a>
        <a href="branch_report.php?branch_id=<?php echo base64_encode($branchrow["branch_id"]); ?>" target="_blank"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Branch Reports</button></a>
        </div>

    </div>

    <div class="row" style="height:30px;"></div>

    
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div style="border:1px solid #d9edf7;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);background:#fff;">

                <div style="background:#d9edf7;padding:18px;text-align:center;font-size:24px;font-weight:bold;color:#31708f;">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    Branch Details

                </div>

                
                <div style="text-align:center; padding-top:30px;">

                    <div style="margin-top:15px;font-size:30px;font-weight:bold;">

                        <?php echo $branchrow["branch_name"]; ?>

                    </div>

                </div>

                <div class="row" style="height:20px;"></div>

                
                <div class="row">

                    <div class="col-md-10 col-md-offset-1">

                        <table class="table table-striped table-hover">

                            <tbody>

                            <tr>
                                <th style="width:35%; background:#f9f9f9;">Branch Address</th>
                                <td><?php echo $branchrow["branch_address"]; ?></td>
                            </tr>

                            <tr>
                                <th style="background:#f9f9f9;">District</th>
                                <td><?php echo $branchrow["district_name"]; ?></td>
                            </tr>
                            

                            <tr>
                                <th style="background:#f9f9f9;">Contact Number</th>
                                <td><?php echo $branchrow["contact_no"]; ?></td>
                            </tr>

                            <tr>
                                <th style="background:#f9f9f9;">Branch Email</th>
                                <td><?php echo $branchrow["email"]; ?></td>
                            </tr>


                            <tr>

                                <th style="background:#f9f9f9;">Status</th>

                                <td

                                <?php

                                $status = $branchrow["branch_status"];

                                if ($status == "Active") {
                                ?>
                                    class="success"

                                <?php
                                }
                                elseif ($status == "De-active") {
                                ?>
                                    class="danger"

                                <?php
                                }
                                
                                ?>


                                >

                                <?php echo $status; ?>

                                </td>

                            </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="row" style="height:20px;"></div>

            </div>

        </div>

    </div>

   
    <div class="row" style="margin-top:25px;">

        <?php $branch_id  = base64_encode("$branch_id");?>

        <div class="col-md-4 col-md-offset-2">

            <a href="edit_branch.php?branch_id=<?php echo $branch_id; ?>"
               class="btn btn-warning btn-lg"
               style="width:180px;">

                <span class="glyphicon glyphicon-pencil"></span>
                Edit Branch

            </a>

        </div>

        <div class="col-md-4 text-right">

            <a href="view_branches.php"
               class="btn btn-default btn-lg"
               style="width:180px;">

                <span class="glyphicon glyphicon-arrow-left"></span>
                Back to List

            </a>

        </div>

    </div>

</div>
            <div class="row">
                &nbsp

            </div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>

</body>
</html>