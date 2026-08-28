<?php
include_once '../commons/session.php';
include_once '../model/order_model.php';

$userrow = $_SESSION["user"];

$orderObj = new Order();

$order_id=base64_decode($_GET["order_id"]);

$orderResult=$orderObj->getOrder($order_id);
$orderrow=$orderResult->fetch_assoc();

$OrderStatusLogResult=$orderObj->getOrderLogs($order_id);
?>

<html>
<head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php $pageName="ORDER MANAGEMENT" ?>
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
                            <a href="order.php">Order Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="view_orders.php">View Orders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            View Order
                        </li>
                    </ol>
                </nav>

                <div class="col-md-10">
                    <a href="add_order.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-plus"></span> Add Order</button></a>
                    <a href="view_orders.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Orders</button></a>
                    <a href="generate_order_reports.php"><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate Order Reports</button></a>
                    
                </div>


            </div>

            <div class="row">
                &nbsp
            </div>
            <?php 
                if(isset($_GET["msg"])){
                    $msg= base64_decode($_GET["msg"]);

                
                
                ?>
                <div class="row" id="msg">
                    <div class="alert alert-success">
                        <?php echo $msg ?>

                    </div>

                </div>

                <?php 
                }
                ?>

    

<!-- ROW 1: Order Summary + Payment -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">

            <!-- HEADER -->
            <div class="panel-heading" style="background:#caeff9;color:black;">
                <h3>
                   <b>
                     Order #<?php echo $orderrow["order_id"]; ?>
                    <span class="label label-warning pull-right">
                        <?php echo $orderrow["status_name"]; ?>
                    </span>
                   </b>
                </h3>
                <h4><b><?php echo $orderrow["customer_name"]; ?></b></h4>
            </div>

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

                <!-- PACKAGE DETAILS -->
                <h4><span class="glyphicon glyphicon-inbox"></span> <b>Package Details</b></h4>
                <hr style="border-top:2px solid #ddd; margin:10px 0;" />

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Type:</strong> <?php echo $orderrow["pkg_type"]; ?></p>
                        <p><strong>Quantity:</strong> <?php echo $orderrow["quantity"]; ?></p>
                        <p><strong>Weight:</strong> <?php echo $orderrow["pkg_weight"]; ?> kg</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Dimensions:</strong>
                            <?php echo $orderrow["pkg_length"]; ?> x
                            <?php echo $orderrow["pkg_width"]; ?> x
                            <?php echo $orderrow["height"]; ?>
                        </p>
                        <p><strong>Fragile:</strong> <?php echo $orderrow["fragile_item"] ? "Yes" : "No"; ?></p>
                        <p><strong>Insurance:</strong> <?php echo $orderrow["insurance"] ? "Yes" : "No"; ?></p>
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

            <!-- FOOTER ACTIONS -->

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
                
            </div>

        </div>

    </div>
</div>
        <div class="row">
                &nbsp
            </div>

            

    

</div>
<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>
</body>
</html>