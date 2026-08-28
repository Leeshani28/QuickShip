<?php
include_once '../commons/session.php';
include_once '../model/driver_model.php';
include_once '../model/delivery_model.php';
include_once '../model/branch_model.php';

$userrow = $_SESSION["user"];
$driverObj = new Driver();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$driver_id = $_GET["driver_id"];
$driver_id = base64_decode($_GET["driver_id"]);

$branchResult = $branchObj->getAllBranches();
$driverResult = $driverObj->getDriver($driver_id);
$driverrow = $driverResult->fetch_assoc();
?>

<html>

<head>

    <?php include_once "../includes/bootstrap_css_includes.php" ?>

</head>

<body>

    <div class="container">

        <div class="row">

            <?php $pageName = "DRIVER MANAGEMENT" ?>
            <?php
            if ($userrow["user_role"] == 1) {
                include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>

        </div>


        <div class="row">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <button type="button" class="btn btn-primary" onclick="history.back()">
                        ← Back
                    </button>

                    <li class="breadcrumb-item">
                        <a href="dashboard_new.php">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="driver.php">Driver Management</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="view_drivers.php">View Drivers</a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        View Driver
                    </li>

                </ol>

            </nav>

        </div>


        <div class="row">

            <div class="col-md-10">
                <a href="add_driver.php"><button type="button" class="btn btn-info btn-lg"><span
                            class="glyphicon glyphicon-plus"></span>Add Driver</button></a>
                <a href="view_drivers.php"><button type="button" class="btn btn-success btn-lg"><span
                            class="glyphicon glyphicon-search"></span> View Drivers</button></a>
                <a href="generate_driver_reports.php"><button type="button" class="btn btn-warning btn-lg"><span
                            class="glyphicon glyphicon-book"></span> Generate Driver Reports</button></a>
            </div>

        </div>

        <div class="row" style="height:30px;"></div>

        <?php
        $img = $driverrow["driver_profile_picture"];

        if ($img == "") {
            $img = "default_user.jpg";
        }
        ?>


        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div
                    style="border:1px solid #d9edf7;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);background:#fff;">

                    <div
                        style="background:#d9edf7;padding:18px;text-align:center;font-size:24px;font-weight:bold;color:#31708f;">
                        <span class="glyphicon glyphicon-user"></span>
                        Driver Details

                    </div>


                    <div style="text-align:center; padding-top:30px;">

                        <img src="../images/courier_images/<?php echo $img; ?>"
                            style="width:160px;height:160px;border-radius:50%;object-fit:cover;border:4px solid #f1f1f1;">

                        <div style="margin-top:15px;font-size:30px;font-weight:bold;">

                            <?php echo $driverrow["driver_name"]; ?>

                        </div>

                    </div>

                    <div class="row" style="height:20px;"></div>


                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">

                            <table class="table table-striped table-hover">

                                <tbody>

                                    <tr>
                                        <th style="width:35%; background:#f9f9f9;">NIC</th>
                                        <td><?php echo $driverrow["driver_nic"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th style="background:#f9f9f9;">Date of Birth</th>
                                        <td><?php echo $driverrow["driver_date_of_birth"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th style="background:#f9f9f9;">License Number</th>
                                        <td><?php echo $driverrow["license_number"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th style="background:#f9f9f9;">License Expiry Date</th>
                                        <td><?php echo $driverrow["license_expiry_date"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#f9f9f9;">Mobile Number</th>
                                        <td><?php echo $driverrow["driver_phone_number"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th style="background:#f9f9f9;">Address</th>
                                        <td><?php echo $driverrow["driver_address"]; ?></td>
                                    </tr>

                                    <tr>
                                        <th style="background:#f9f9f9;">Branch</th>
                                        <td><?php echo $driverrow["branch_name"]; ?></td>
                                    </tr>

                                    <tr>

                                        <th style="background:#f9f9f9;">Status</th>

                                        <td <?php

                                        $status = $driverrow["driver_status"];

                                        if ($status == "Available") {
                                            ?>
                    class="success" <?php
                                        } elseif ($status == "Unavailable") {
                                            ?> class="danger"
            <?php
                                        } elseif ($status == "Assigned") {
                                            ?> class="info" <?php
                                        }
                                        ?>>

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

            <?php $driver_id = base64_encode("$driver_id"); ?>

            <div class="col-md-4 col-md-offset-2">

                <a href="edit_driver.php?driver_id=<?php echo $driver_id; ?>" class="btn btn-warning btn-lg"
                    style="width:180px;">

                    <span class="glyphicon glyphicon-pencil"></span>
                    Edit Driver

                </a>

            </div>

            <div class="col-md-4 text-right">

                <a href="view_drivers.php" class="btn btn-default btn-lg" style="width:180px;">

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