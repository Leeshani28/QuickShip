<?php
include_once '../commons/session.php';
include_once '../model/customer_model.php';

$userrow = $_SESSION["user"];

$customerObj = new Customer();

$customer_id = base64_decode($_GET["customer_id"]);
$customerResult = $customerObj->getCustomer($customer_id);
$customerdetailrow = $customerResult->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <?php include_once "../includes/bootstrap_css_includes.php"?>
    <title>Edit Customer</title>
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

    <!-- Breadcrumb -->
    <div class="row">
        <nav>
            <ol class="breadcrumb">
                <button type="button" class="btn btn-primary" onclick="history.back()"> ← Back </button>

                <li><a href="dashboard_new.php">Dashboard</a></li>
                <li><a href="customer.php">Customer Management</a></li>
                <li><a href="view_customers.php">View Customers</a></li>
                <li class="active">Edit Customer</li>
            </ol>
        </nav>
    </div>

    <!-- Top Buttons -->
    <div class="row">
        <div class="col-md-12">
            <a href="add_customer.php" class="btn btn-info btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-plus"></span> Add Customer
            </a>

            <a href="view_customers.php" class="btn btn-success btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-search"></span> View Customers
            </a>

            <a href="#" class="btn btn-warning btn-lg" style="border-radius:8px;">
                <span class="glyphicon glyphicon-book"></span> Reports
            </a>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>

    <div class="row">
    <div class="col-md-6 col-md-offset-3" id="msg"></div>
</div>

    <div class="row"><br></div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-primary" style="border-radius:12px; box-shadow:0 6px 15px rgba(0,0,0,0.15);">

                <!-- Header -->
                <div class="panel-heading text-center" 
                     style="font-size:22px; font-weight:bold; border-top-left-radius:12px; border-top-right-radius:12px;">
                    <span class="glyphicon glyphicon-edit"></span> Edit Customer Details
                </div>

                <!-- Body -->
                <div class="panel-body" style="background:#f9f9f9; padding:30px; border-radius:0 0 12px 12px;">

                    <form action="../controller/customer_controller.php?status=update_customer" method="post">

                        <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">

                        <!-- Error Message -->
                        <?php if(isset($_GET["msg"])) { ?>
                            <div class="alert alert-danger text-center">
                                <?php echo base64_decode($_GET["msg"]); ?>
                            </div>
                        <?php } ?>

                        <!-- Name + Address -->
                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>Name</strong></label>
                                <input type="text"
                                        class="form-control input-lg"
                                        id="name"
                                        name="name"
                                        value="<?php echo $customerdetailrow["customer_name"] ?>">
                            </div>

                            <div class="col-md-6">
                                <label><strong>Address</strong></label>
                                <input type="text"
                                        class="form-control input-lg"
                                        id="address"
                                        name="address"
                                        value="<?php echo $customerdetailrow["customer_address"] ?>">
                            </div>
                        </div>

                        <br>

                        <!-- Email -->
                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>Email</strong></label>
                                <input type="email"
                                        class="form-control input-lg"
                                        id="email"
                                        name="email"
                                        value="<?php echo $customerdetailrow["customer_email"] ?>">
                            </div>

                            <div class="col-md-6">
                                <label><strong>NIC</strong></label>
                               <input type="text"
                                        class="form-control input-lg"
                                        id="nic"
                                        name="nic"
                                        value="<?php echo $customerdetailrow["customer_nic"] ?>">
                            </div>
                        </div>

                        <br>

                        <!-- Phone Numbers -->
                        <div class="row">
                            <div class="col-md-6">
                                <label><strong>Mobile Number</strong></label>
                                <input type="text"
                                        class="form-control input-lg"
                                        id="cno1"
                                        name="cno1"
                                        value="<?php echo $customerdetailrow["customer_mobile"] ?>">
                            </div>

                            <div class="col-md-6">
                                <label><strong>Fixed Number</strong></label>
                               <input type="text"
                                        class="form-control input-lg"
                                        id="cno2"
                                        name="cno2"
                                        value="<?php echo $customerdetailrow["customer_fixed"] ?>">
                            </div>
                        </div>

                        <br><br>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <input type="reset" class="btn btn-danger btn-lg" 
                                       style="border-radius:8px;" value="Reset">
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary btn-lg"
                                        style="border-radius:8px;">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/customervalidation.js"></script>

</body>
</html>