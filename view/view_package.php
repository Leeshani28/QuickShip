<?php
include_once '../commons/session.php';
include_once '../model/package_model.php';
include_once '../model/order_model.php';

$userrow = $_SESSION["user"];

$packageObj = new Package();
$orderObj = new Order();

$package_id = $_GET["package_id"];
$package_id = base64_decode($_GET["package_id"]);

$packageResult = $packageObj->getPackage($package_id);
$packagerow = $packageResult->fetch_assoc();

$order_id=base64_decode($_GET["order_id"]);

$orderResult=$orderObj->getOrder($order_id);
$orderrow=$orderResult->fetch_assoc();

$OrderStatusLogResult=$orderObj->getOrderLogs($order_id);




?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php $pageName = "PACKAGE MANAGEMENT" ?>
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
                        <a href="package.php">Package Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="view_packages.php">View Packages</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Package
                    </li>
                </ol>
            </nav>

            <div class="col-md-10">
            
                <a href="view_Packages.php"><button type="button" class="btn btn-success btn-lg"><span
                            class="glyphicon glyphicon-search"></span> View Packages</button></a>
                <a href=""><button type="button" class="btn btn-warning btn-lg"><span
                            class="glyphicon glyphicon-book"></span> Generate Package Reports</button></a>
            </div>


        </div>

        <div class="row">
            &nbsp
        </div>


        <div class="row">
            <div class="col-md-11 col-md-offset-1">

                <div class="panel panel-warning" style="width: 90%;">
                    <div class="panel-heading">
                        <h2>Package #<?php echo $packagerow["package_id"]; ?> Details
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-2">
                                <table class="table table-striped">
                                    <tbody>

                                   



                                        <tr>
                                            <th style="width:40%">Type</th>
                                            <td><?php echo $packagerow["pkg_type"]; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Quantity</th>
                                            <td><?php echo $packagerow["quantity"]; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Packaging Type</th>
                                            <td><?php echo $packagerow["packaging_type"]; ?></td>
                                        </tr>

                                        <tr>
                                            <th>Weight(kg)</th>
                                            <td><?php echo $packagerow["pkg_weight"]; ?></td>
                                        </tr>
                                       

                                        <tr>
                                            <th>Dimensions</th>
                                            <td><?php echo $packagerow["pkg_length"]; ?> x
                                                <?php echo $packagerow["pkg_width"]; ?> x
                                                <?php echo $packagerow["height"]; ?> cm
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Fragile</th>
                                            <td><?php echo $packagerow["fragile_item"] ? "Yes" : "No"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Insurance</th>
                                            <td><?php echo $packagerow["insurance"] ? "Yes" : "No"; ?></td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Declared Value (Rs.)</th>
                                            <td><?php echo $packagerow["pkg_value"]; ?></td>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Special Instructions</th>
                                            <td><?php echo $packagerow["instructions"]; ?></td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            &nbsp;
                        </div>

                        <div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">

            <div class="panel-body">

                <!-- ORDER INFO -->
                <h4><span class="glyphicon glyphicon-list-alt"></span><b> Order Information</b></h4>
                <hr style="border-top:2px solid #ddd; margin:10px 0;" />

                <?php

                $deliveryCharge = 250;



                $totalAmount = $orderrow["amount"];
                if($orderrow["insurance"] == 1){
                    $insuranceCharge = 500;
                }else{
                $insuranceCharge = 0;
                }

                $orderAmount = $orderrow["amount"] - ($deliveryCharge + $insuranceCharge);

                ?>

<div class="row">
    <div class="col-md-6">
        <p><strong>Order Date:</strong> <?php echo $orderrow["order_date"]; ?></p>
        <p><strong>Payment Type:</strong> <?php echo $orderrow["payment_type"]; ?></p>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered" style="margin-bottom:0;">
            <tr>
                <th>Order Amount</th>
                <td class="text-right">Rs. <?php echo number_format($orderAmount, 2); ?></td>
            </tr>
            <tr>
                <th>Delivery Charge</th>
                <td class="text-right">Rs. <?php echo number_format($deliveryCharge, 2); ?></td>
            </tr>
            <tr>
                <th>Insurance Charge</th>
                <td class="text-right">Rs. <?php echo number_format($insuranceCharge, 2); ?></td>
            </tr>
            <tr style="background-color:#f5f5f5;font-weight:bold;">
                <th>Total Amount</th>
                <td class="text-right">Rs. <?php echo number_format($totalAmount, 2); ?></td>
            </tr>
        </table>
    </div>
</div>

                <div>
                    &nbsp;
                </div>

                <!-- DELIVERY DETAILS -->
                <h4><span class="glyphicon glyphicon-road"></span> <b>Delivery Details</b></h4>
                <hr style="border-top:2px solid #ddd; margin:10px 0;" />

                <p>
                    <?php echo $orderrow["premises_no"] . ", " . $orderrow["street"] . ", " . $orderrow["town"]; ?>
                </p>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>District:</strong> <?php echo $orderrow["district_name"]; ?></p>
                        <!-- <p><strong>Province:</strong> <?php echo $orderrow["province_name"]; ?></p> -->
                    </div>
                    <div class="col-md-6">
                        <p><strong>Postal Code:</strong> <?php echo $orderrow["postal_code"]; ?></p>
                        <p><strong>Delivery Type:</strong> <?php echo $orderrow["delivery_type"]; ?></p>
                    </div>
                </div>

                 <div>
                    &nbsp;
                </div>

                <!-- SENDER + RECEIVER -->
                <div class="row">
                    <div class="col-md-6">
                        <h4><b>Sender Details</b></h4>
                        <hr style="border-top:2px solid #ddd; margin:10px 0;" />
                        <p><strong>Name:</strong> <?php echo $orderrow["customer_name"]; ?></p>
                        <p><strong>Mobile:</strong> <?php echo $orderrow["customer_mobile"]; ?></p>
                        <p><strong>Address:</strong> <?php echo $orderrow["customer_address"]; ?></p>
                    </div>

                    <div class="col-md-6">
                        <h4><b>Receiver Details</b></h4>
                        <hr style="border-top:2px solid #ddd; margin:10px 0;" />
                        <p><strong>Name:</strong> <?php echo $orderrow["receiver_name"]; ?></p>
                        <p><strong>Mobile:</strong> <?php echo $orderrow["receiver_mobile"]; ?></p>
                        <p><strong>Address:</strong> <?php echo $orderrow["receiver_address"]; ?></p>
                    </div>
                </div>

                 <div>
                    &nbsp;
                </div>

                <!-- ORDER HISTORY -->
                <h4><span class="glyphicon glyphicon-map-marker"></span> <b>Track Order</b></h4>
                <hr style="border-top:2px solid #ddd; margin:10px 0;" />


                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-info table-striped" id="orderstable">
                            <thead>
                                <tr>
                                    
                                    <th width="30%">Date & Time</th>
                                    <th width="30%">Status</th>
                                    <th width="40%">Order Remark</th>
            
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($logrow=$OrderStatusLogResult->fetch_assoc()){

                                    
                                ?>
                                
                                <tr>
                                    <td>
                                        <?php 
                                        echo $logrow["log_time"];
                                        
                                        ?>
                                    </td>
                                    <td style="background-color: <?php echo $logrow["color_code"];?>">
                                        <?php 
                                        echo $logrow["status_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $logrow["log_remarks"];
                                        
                                        ?>
                                    </td>

                                </tr>
                                <?php 
                                }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- FOOTER ACTIONS

            <div class="panel-footer text-center">
                
                <?php $order_id=base64_encode("$order_id");
                if($orderrow["order_status"]==1){
                    ?>
                        <a href="edit_order.php?order_id=<?php echo $order_id; ?>" 
                   class="btn btn-primary btn-lg">
                   <span class="glyphicon glyphicon-pencil"></span> Edit
                </a>
                    <?php
                }
                ?>
                
            </div> -->

        </div>

    </div>
</div>












                    </div>

                    <div class="row">
                        &nbsp
                    </div>

                    

                    <div class="row">
                        &nbsp
                    </div>

                </div>
            </div>
        </div>
        </div>
        </body>
        </html>