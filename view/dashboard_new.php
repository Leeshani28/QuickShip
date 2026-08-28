<?php

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/order_model.php';
include_once '../model/finance_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$moduleObj = new Module();
$orderObj = new Order();
$financeObj = new Finance();

$order_location = $userrow["user_location"];


// Monthly Income
$totalincomeResult = $financeObj->getTotalMonthlyIncome();
$totalincomeRow = $totalincomeResult->fetch_assoc();
$totalIncome = $totalincomeRow["total_income"];

// Monthly Expense
$totalexpenseResult = $financeObj->getTotalMonthlyExpenses();
$totalexpenseRow = $totalexpenseResult->fetch_assoc();
$totalExpense = $totalexpenseRow["total_expense"];

// Profit
$totalProfit = $totalIncome - $totalExpense;

//order summary
$orderTotalCountResult = $orderObj->getPendingOrderCount($order_location);
$orderTotalCountRow = $orderTotalCountResult->fetch_assoc();

$ofdTotalCountResult = $orderObj->getOutforDeliveryOrderCount($order_location);
$ofdTotalCountRow = $ofdTotalCountResult->fetch_assoc();

$deliveredTotalCountResult = $orderObj->getDeliveredOrderCount($order_location);
$deliveredTotalCountRow = $deliveredTotalCountResult->fetch_assoc();

$canceledTotalCountResult = $orderObj->getCanceledOrderCount($order_location);
$canceledTotalCountRow = $canceledTotalCountResult->fetch_assoc();


$role_id = $userrow["user_role"];

$moduleResult = $moduleObj->getRoleModules($role_id);


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
    </head>
    <body>
        
        <div class="container">
            

            <?php $pageName="DASHBOARD" ?>
            
            <?php 
            if($userrow["user_role"]==1){
            include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>

            
    <?php 
    if($userrow["user_role"]==1){
        ?>



<!--  QUICK ACCESS  -->
        <div class="page-header">
            <h3> <b>Quick Access</b> </h3>
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="add_order.php" class="btn btn-success btn-block btn-lg">
                    <span class="glyphicon glyphicon-plus"></span>
                    <br>
                    New Order
                </a>
            </div>
            <div class="col-md-3">
                <a href="view_packages.php" class="btn btn-info btn-block btn-lg">
                    <span class="glyphicon glyphicon-barcode"></span>
                    <br>
                    Packages
                </a>
            </div>
            <div class="col-md-3">
                <a href="view_customers.php" class="btn btn-warning btn-block btn-lg">
                    <span class="glyphicon glyphicon-user"></span>
                    <br>
                    Customers
                </a>
            </div>
            <div class="col-md-3">
                <a href="reports.php" class="btn btn-danger btn-block btn-lg">
                    <span class="glyphicon glyphicon-stats"></span>
                    <br>
                    Reports
                </a>
            </div>
        </div>

        <!-- finance summary -->

        <div class="page-header">
            <h3><b>Finance Summary</b></h3>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:20px;">

        <div class="col-md-4">
            <div style="background:#fff;border-radius:12px;padding:20px;text-align:center;
                        box-shadow:0 8px 10px rgba(151, 197, 228, 0.67);">
                <div>
                    <i class="bi bi-cash-coin" style="font-size: 30px;"></i>
                </div>
                <h4>Total Income</h4>
                <h2>
                    Rs. <?php echo number_format($totalIncome, 2); ?>
                </h2>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background:#fff;border-radius:12px;padding:20px;text-align:center;
                        box-shadow:0 8px 10px rgba(202, 167, 28, 0.36);">
                <div>
                    <i class="bi bi-wallet2" style="font-size: 30px;"></i>
                </div>
                <h4>Total Expenses</h4>
                <h2>
                     Rs. <?php echo number_format($totalExpense, 2); ?>
                </h2>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background:#fff;border-radius:12px;padding:20px;text-align:center;
                        box-shadow:0 8px 10px rgba(104, 208, 109, 0.63);">
                <div>
                    <i class="bi bi-graph-up-arrow" style="font-size: 30px;"></i>
                </div>
                <h4>Total Profit</h4>
                <h2>
                     Rs. <?php echo number_format($totalProfit, 2); ?>
                </h2>
            </div>
        </div>

        

    </div>

    <!-- Order summary -->


        <div class="page-header">
            <h3><b>Order Summary</b></h3>
        </div>
        <div class="row" style="margin-top:20px;margin-bottom:20px;">

        <div class="col-md-3">
            <a href="view_pending_orders.php" style="text-decoration:none; color:inherit; display:block;">
                <div style="background:#fff;
                            border-radius:12px;
                            padding:20px;
                            text-align:center;
                            box-shadow:0 8px 10px rgba(202, 167, 28, 0.36);
                            transition:0.3s;
                            cursor:pointer;">
                    <div>
                        <i class="bi bi-hourglass-split" style="font-size:30px;"></i>
                    </div>
                    <h4>Pending Orders</h4>
                    <h2>
                        <?php echo $orderTotalCountRow["order_count"]; ?>
                    </h2>
                </div>
            </a>
        </div>

         <!-- <div class="col-md-3">
            <div style="background:#fff;border-radius:12px;padding:20px;text-align:center;
            box-shadow:0 8px 10px rgba(202, 167, 28, 0.36);">
                <div>
                    <i class="bi bi-hourglass-split" style="font-size: 30px;"></i>
                </div>
                <h4>Pending Orders</h4>
                <h2>
                    <?php echo $orderTotalCountRow["order_count"]; ?>
                </h2>
            </div>
        </div> -->
        <div class="col-md-3">
            <a href="view_ofd.php" style="text-decoration:none; color:inherit; display:block;">
                <div style="background:#fff;
                            border-radius:12px;
                            padding:20px;
                            text-align:center;
                            box-shadow:0 8px 10px rgba(151, 197, 228, 0.67);
                            transition:0.3s;
                            cursor:pointer;">
                    <div>
                        <i class="bi bi-truck" style="font-size:30px;"></i>
                    </div>
                    <h4>Out for Delivery</h4>
                    <h2>
                        <?php echo $ofdTotalCountRow["ofd_count"]; ?> 
                    </h2>
                </div>
            </a>
        </div>

        

        <div class="col-md-3">
            <a href="view_delivered_orders.php" style="text-decoration:none; color:inherit; display:block;">
            <div style="background:#fff;
                        border-radius:12px;
                        padding:20px;
                        text-align:center;
                        box-shadow:0 8px 10px rgba(104, 208, 109, 0.63);
                        transition:0.3s;
                        cursor:pointer;">
                <div>
                    <i class="bi bi-box-seam-fill" style="font-size: 30px;"></i>
                </div>
                <h4>Delivered</h4>
                <h2>
                     <?php echo $deliveredTotalCountRow["delivered_count"]; ?>
                </h2>
            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="view_canceled_orders.php" style="text-decoration:none; color:inherit; display:block;">
            <div style="background:#fff;
                        border-radius:12px;
                        padding:20px;
                        text-align:center;
                        box-shadow:0 8px 10px rgba(203, 92, 134, 0.63);
                        transition:0.3s;
                        cursor:pointer;">

                <div>
                    <i class="bi bi-slash-circle-fill" style="font-size: 30px;"></i>
                </div>
                <h4>Canceled</h4>
                <h2>
                     <?php echo $canceledTotalCountRow["canceled_count"]; ?>
                </h2>
            </div>
            </a>
        </div>

        

    </div>
<?php
    }
    ?>

    
    <div class="row">
                &nbsp
            </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body"style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 12px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="col-md-12">
                        <h3 style="margin-bottom: 30px;"><b>MAIN MENU</b></h3>
                    </div>

                    <?php
                        while ($module_row=$moduleResult->fetch_assoc())
                            {
                    ?> 
            
            <div class="col-md-4">
                <a href="<?php echo $module_row["module_url"]?>" style="text-decoration:none;color:000000;">
                    <div class="panel" style="height: 120px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1); background-image: url('../images/mod_bg4.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        

                    <div class="media">
                        <div class="media-left media-middle">
                            <img src="../images/icons/<?php echo $module_row["module_icon"] ?>" height="90px" width="90px" style="padding: 10px;margin-top:10px;"/>
                        </div>
                        <div class="media-body"style="vertical-align:middle;">
                            <h4 style="font-size:25px; font-weight:500; margin-top:30px;margin-right:45px;"><?php echo $module_row["module_name"];?></h4>
                            
                        </div>

                    </div>
                        

                    </div>
                </a>
            </div>
            
            <?php
                }
            ?> 
            
            
                    </div>
                </div>
            </div>
            </div>   
        </div>
    </body>
    <script src="../js/jquery-3.7.1.js"></script>
</html>