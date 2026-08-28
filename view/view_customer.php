<?php 
include_once '../commons/session.php';
include_once '../model/customer_model.php';
include_once '../model/order_model.php';

$customerObj = new Customer();
$orderObj = new Order();

$customer_id = base64_decode($_GET["customer_id"]);
$customerResult = $customerObj->getCustomer($customer_id);
$customerdetailrow = $customerResult->fetch_assoc();

$orderResult = $orderObj->getCustomerOrders($customer_id);

$userrow = $_SESSION["user"];
?> 

<!DOCTYPE html>
<html>
<head>
    <?php include_once "../includes/bootstrap_css_includes.php"?>
    <title>View Customer</title>
</head>

<body>

<div class="container">

    <?php $pageName="CUSTOMER MANAGEMENT" ?>
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
                <li class="breadcrumb-item">
                    <a href="customer.php">Customer Management</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="view_customers.php">View Customers</a>
                </li>
                <li class="breadcrumb-item active">View Customer</li>
            </ol>
        </nav>
    </div>

   
    <div class="row">
        <div class="col-md-10">
            <a href="add_customer.php" class="btn btn-info btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-plus"></span> Add Customer
            </a>

            <a href="view_customers.php" class="btn btn-success btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-search"></span> View Customers
            </a>

            <a href="single_customer_report.php?customer_id=<?php echo base64_encode($customer_id); ?>" class="btn btn-warning btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-book"></span> Generate Customer Reports
            </a>

        </div>
    </div>

    <div class="row"><br></div>
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
 


    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <div class="panel panel-info" style="border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                <div class="panel-heading text-center" 
                     style="font-size:20px; font-weight:bold; border-top-left-radius:10px; border-top-right-radius:10px;">
                    <span class="glyphicon glyphicon-user"></span> Customer Details
                </div>

                <div class="panel-body" style="padding:25px;">

                    <div class="row" style="padding:10px 0; border-bottom:1px solid #eee;">
                        <div class="col-md-4"><strong>Name</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_name"]; ?>
                        </div>
                    </div>

                    <div class="row" style="padding:10px 0; border-bottom:1px solid #eee;">
                        <div class="col-md-4"><strong>Address</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_address"]; ?>
                        </div>
                    </div>

                    <div class="row" style="padding:10px 0; border-bottom:1px solid #eee;">
                        <div class="col-md-4"><strong>Email</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_email"]; ?>
                        </div>
                    </div>

                    <div class="row" style="padding:10px 0; border-bottom:1px solid #eee;">
                        <div class="col-md-4"><strong>NIC</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_nic"]; ?>
                        </div>
                    </div>

                    <div class="row" style="padding:10px 0; border-bottom:1px solid #eee;">
                        <div class="col-md-4"><strong>Mobile</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_mobile"]; ?>
                        </div>
                    </div>

                    <div class="row" style="padding:10px 0;">
                        <div class="col-md-4"><strong>Fixed</strong></div>
                        <div class="col-md-8">
                            <?php echo $customerdetailrow["customer_fixed"]; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        &nbsp;
                    </div>

                     <h4><span class="glyphicon glyphicon-list-alt"></span> <b>Order History</b></h4>
                <hr style="border-top:2px solid #ddd; margin:10px 0;" />


                    <div class="row">
                <div class="col-md-12">
                    <table class="table table-info table-striped" id="">
                        <thead>
                            <tr>
                                <th style="display: none;">Created Date</th>
                                <th>#</th>
                                <th>Package Type</th>
                                <th>Delivery Date</th>
                                <th>Town</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($orderrow = $orderResult->fetch_assoc()) {

                                $order_id = $orderrow["order_id"];
                                $order_id = base64_encode($order_id);



                                $status = "";
                                if ($orderrow["order_status"] == 1) {
                                    $status = "Pending";

                                }

                                ?>

                                <tr>
                                    <td style="display: none;">
                                        <?php
                                        echo $orderrow["order_date"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["order_id"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["pkg_type"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        echo $orderrow["preferred_del_date"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $orderrow["town"];

                                        ?>
                                    </td>

                                    <td style="background-color: <?php echo $orderrow["color_code"]; ?>">
                                        <?php
                                        echo $orderrow["status_name"];

                                        ?>
                                    </td>
                                    <td>
                                        <a href="view_order.php?order_id=<?php echo $order_id; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;


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
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="clearfix" style="margin-top:15px;">

                <a href="edit_customer.php?customer_id=<?php echo base64_encode($customer_id); ?>" 
                   class="btn btn-warning btn-lg"
                   style="border-radius:8px;">
                    <span class="glyphicon glyphicon-edit"></span> Edit Customer
                </a>

                <a href="view_customers.php" 
                   class="btn btn-default btn-lg pull-right"
                   style="border-radius:8px;">
                    <span class="glyphicon glyphicon-arrow-left"></span> Back to List
                </a>

            </div>

        </div>
    </div>

    <div class="row"><br></div>

</div>

<script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/datatable/datatables.js"></script>

<script>
        $(document).ready(function(){
            $("#ordertable").DataTable();

            




        });

        
    </script>

<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>

</body>
</html>