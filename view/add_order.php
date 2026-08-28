<?php

include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/delivery_model.php';
include_once '../model/user_model.php';

//get user information from session
$userrow = $_SESSION["user"];

$orderObj = new Order();
$deliveryObj = new Delivery();
$userObj = new User();
$districtResult = $deliveryObj->getAllBranchDistrict();
$provinceResult = $deliveryObj->getAllProvince();



?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>


</head>

<body>
    <div class="container">
        <div class="row">
            <?php $pageName = "ORDER MANAGEMENT" ?>
            <?php
            if ($userrow["user_role"] == 1) {
                include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>


            <!-- Breadcrumb -->

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
                            Add Order
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
                &nbsp;
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3" id="msg">

                </div>
                <?php
                if (isset($_GET["msg"])) {
                    ?>
                    <div class="col-md-6 col-md-offset-3 alert alert-danger">
                        <?php echo base64_decode($_GET["msg"]); ?>
                    </div>
                    <?php
                }
                ?>

            </div>



            <div class="container">
                <div class="row text-center">
                    <h2>Order Details</h2>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" action="../controller/order_controller.php?status=add_order"
                            method="post" id="addorder">


                            <div class="panel panel-info"
                                style="height:500px;border-radius: 10px;border: 1px solid #8ac8eb;">
                                <div class="panel-heading"
                                    style="display: flex; justify-content: left; align-items: center; gap: 5px;">
                                    <i class="bi bi-person-circle"
                                        style="font-size: 25px; margin-right: 5px;color:blue;"></i>
                                    <h4 class="text-left">Customer Details</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="panel panel-light"
                                            style="height:400px;border-radius: 10px;border: 1px solid #8ac8eb;">
                                            <div class="panel-heading">
                                                <h4 class="text-center">Sender Information</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">NIC</label>
                                                    </div>

                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" name="snic" id="snic">
                                                        <input type="hidden" name="sender_customer_id"
                                                            id="sender_customer_id">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-primary" id="searchSender">
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    &nbsp;
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Name</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="sname"
                                                            id="sname" />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Email</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="semail"
                                                            id="semail" />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Address</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="saddress"
                                                            id="saddress" />
                                                    </div>


                                                </div>

                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Mobile Number</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" name="scno1"
                                                            id="scno1" />
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Fixed Number</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" name="scno2"
                                                            id="scno2" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="panel panel-light"
                                            style="height:400px;border-radius: 10px;border: 1px solid #8ac8eb;">
                                            <div class="panel-heading">
                                                <h4 class="text-center">Receiver Information</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Name</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="rname"
                                                            id="rname" />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Email</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="remail"
                                                            id="remail" />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Address</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="raddress"
                                                            id="raddress" />
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">NIC</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="rnic" id="rnic" />
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Mobile Number</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" name="rcno1"
                                                            id="rcno1" />
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Fixed Number</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" name="rcno2"
                                                            id="rcno2" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp
                            </div>

                            <div class="panel panel-warning"
                                style="height:400px;border-radius: 10px;border: 1px solid #ebcb8a;">
                                <div class="panel-heading"
                                    style="display: flex; justify-content: left; align-items: center; gap: 5px;">
                                    <i class="bi bi-box-fill"
                                        style="font-size: 25px; margin-right: 5px;color:orange;"></i>
                                    <h4 class="text-left">Package Details</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label" style="text-align: right;">Package Type</label>
                                        </div>
                                        <div class="col-md-4 dropdown">
                                            <div class="form-group">

                                                <select name="pkg_type" id="pkg_type"
                                                    class="form-control custom-dropdown">
                                                    <option selected disabled>Select Package Type</option>
                                                    <option value="Documents">Documents</option>
                                                    <option value="Electronics">Electronics</option>
                                                    <option value="Clothing">Clothing</option>
                                                    <option value="Fragile Items">Fragile Items</option>
                                                    <option value="Food Items">Food Items</option>
                                                    <option value="Industrial Goods">Industrial Goods</option>
                                                    <option value="Books">Books</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>


                                        </div>

                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Quantity</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="quantity" id="quantity" min="1" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Declared value(Rs.)</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="pkg_value" id="pkg_value" />
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Packaging Type</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <select name="packaging_type" id="packaging_type"
                                                    class="form-control custom-dropdown">
                                                    <option selected disabled>Select Packaging Type</option>
                                                    <option value="Envelope">Envelope</option>
                                                    <option value="Cardboard Box">Cardboard Box</option>
                                                    <option value="Wooden Crate">Wooden Crate</option>
                                                    <option value="Plastic Wrap">Plastic Wrap</option>
                                                    <option value="Padded Bag">Padded Bag</option>
                                                    <option value="Tube Packaging">Tube Packaging</option>
                                                    <option value="Metal Container">Metal Container</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 text-right">
                                            <label class="control-label">Weight(kg)</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" id="pkg_weight" name="pkg_weight"
                                                step="0.01">
                                        </div>
                                        <div class="col-md-1 text-right">
                                            <label class="control-label">Length(cm)</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="pkg_length"
                                                id="pkg_length" />
                                        </div>
                                        <div class="col-md-1 text-right">
                                            <label class="control-label">Width(cm)</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="pkg_width" id="pkg_width" />
                                        </div>
                                        <div class="col-md-1 text-right">
                                            <label class="control-label">Height(cm)</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="height" id="height" />
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="padding-left:50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="checkDefault" name="fragile_item">
                                                <label class="form-check-label" for="checkDefault">
                                                    Fragile Item
                                                </label>
                                            </div>




                                        </div>
                                        <div class="col-md-9">

                                            <div class="form-check" style="padding-left:50px;">
                                                <input type="checkbox" id="insurance" name="insurance" value="1">
                                                <label class="form-check-label" for="checkChecked">
                                                    Add Insurance
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Special Instructions</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="instructions"
                                                id="instructions" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                &nbsp
                            </div>

                            <div class="panel panel-success"
                                style="height:750px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                                <div class="panel-heading"
                                    style="display: flex; justify-content: left; align-items: center; gap: 5px;">
                                    <i class="bi bi-truck" style="font-size: 25px; margin-right: 5px;color:green;"></i>
                                    <h4 class="text-left">Delivery Details</h4>
                                </div>
                                <div class="row">
                                    &nbsp
                                </div>

                                <div class="col-md-12">
                                    <div class="panel panel-light"
                                        style="height:375px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                                        <div class="panel-heading">
                                            <h4 class="text-center">Address Details</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label" style="text-align: right;">Premises
                                                        No.</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="premises_no"
                                                        id="premises_no" />
                                                </div>

                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Premises Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="premises_name"
                                                        id="premises_name" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Street</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="street" id="street" />
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Town/City</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="town" id="town" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- <div class="col-md-2 text-right">
                                                <label class="control-label">Province</label>
                                            </div> -->
                                                <!-- <div class="col-md-4">
                                                <div class="form-group">
    
                                                    <select name="province_id" id="province_id" class="form-control custom-dropdown">
                                                        <option value="">Select Province</option>
                                                        <?php
                                                        while ($provincerow = $provinceResult->fetch_assoc()) { ?>
                                                            <option value="<?php echo $provincerow["province_id"]; ?>">
                                                                <?php echo $provincerow["province_name"]; ?>
                                                            </option>
                                                            <?php } ?>

            
                                                    </select>
                                                </div>

                                            </div> -->

                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">District</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <select name="district_id" id="district_id"
                                                            class="form-control custom-dropdown" required>
                                                            <option value="">Select District</option>
                                                            <?php
                                                            mysqli_data_seek($districtResult, 0);
                                                            while ($districtrow = $districtResult->fetch_assoc()) { ?>
                                                                <option value="<?php echo $districtrow["district_id"]; ?>">
                                                                    <?php echo $districtrow["district_name"]; ?>
                                                                </option>
                                                            <?php } ?>


                                                        </select>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Postal Code</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="postal_code"
                                                        id="postal_code" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Return Address</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="return_address"
                                                        id="return_address" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    &nbsp
                                </div>

                                <div class="col-md-12">
                                    <div class="panel panel-light"
                                        style="height:260px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                                        <div class="panel-heading">
                                            <h4 class="text-center">Delivery Options</h4>
                                        </div>
                                        <div class="panel-body">


                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="padding-left:50px;">

                                                <div class="form-check">
                                                    <label class="form-check-label" for="checkDefault">
                                                        Proofs of Delivery
                                                    </label>
                                                    <span></span> <input class="form-check-input" type="checkbox"
                                                        value="1" id="checkDefault" name="pod">

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Delivery Type</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <select name="delivery_type" id="delivery_type"
                                                            class="form-control custom-dropdown">
                                                            <option selected disabled>Select Delivery Type</option>
                                                            <option value="Standard">Standard</option>
                                                            <option value="Express">Express</option>
                                                            <option value="Same_day">Same day</option>
                                                            <option value="Next_day">Next day</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Preferred Delivery Date</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control" name="preferred_del_date"
                                                        id="preferred_del_date" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right">
                                                    <label class="control-label">Delivery Instructions</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="deli_instruction"
                                                        id="deli_instruction" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="panel panel-danger" style="border-radius:10px;border:1px solid #db64b7d9;">
                                <div class="panel-heading"
                                    style="display:flex;justify-content:left;align-items:center;gap:5px;">
                                    <i class="bi bi-credit-card-2-front-fill"
                                        style="font-size:25px;margin-right:5px;color:#d63384;"></i>
                                    <h4 class="text-left">Payment Details</h4>
                                </div>

                                <div class="panel-body">

                                    <div class="col-md-12">
                                        <div class="panel panel-light">

                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-md-2 text-right">
                                                        <label class="control-label">Payment Type</label>
                                                    </div>

                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <select name="payment_type" id="payment_type"
                                                                class="form-control custom-dropdown">
                                                                <option selected disabled>Select Payment Type</option>
                                                                <option value="COD">Cash On Delivery (COD)</option>
                                                                <option value="Prepaid">Pre-paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>


                            <div class="row">
                                &nbsp;
                            </div>

                            <div class="row">
                                &nbsp;
                            </div>

                            <div class="panel panel-danger" style="border-radius:10px;border:1px solid #f5a3a3;">
                                <div class="panel-heading" style="display:flex;align-items:center;gap:5px;">
                                    <i class="bi bi-receipt-cutoff" style="font-size:25px;color:#d9534f;"></i>
                                    <h4 class="text-left">Amount Summary</h4>
                                </div>

                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">

                                            <table class="table table-bordered table-hover text-center"
                                                style="font-size:16px;">

                                                <tr style="background:#f9f9f9;">
                                                    <th class="text-center">Item</th>
                                                    <th class="text-center">Amount (Rs.)</th>
                                                </tr>

                                                <tr>
                                                    <td>Delivery Charge</td>
                                                    <td>
                                                        <input type="text" class="form-control text-center"
                                                            id="delivery_charge" name="delivery_charge" value="650.00"
                                                            readonly
                                                            style="border:none; background:transparent; box-shadow:none; text-align: right;">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Package Charge</td>
                                                    <td>
                                                        <input type="text" class="form-control text-center"
                                                            id="fragile_charge" name="fragile_charge" value="250.00"
                                                            readonly
                                                            style="border:none; background:transparent; box-shadow:none;text-align: right">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Insurance Charge</td>
                                                    <td>
                                                        <input type="text" class="form-control text-center"
                                                            id="insurance_charge" name="insurance_charge" value="500.00"
                                                            readonly
                                                            style="border:none; background:transparent; box-shadow:none; text-align: right">
                                                    </td>
                                                </tr>

                                                <tr style="background:#fff3cd;">
                                                    <th class="text-center" style="font-size:18px;">
                                                        Total Amount
                                                    </th>

                                                    <th>
                                                        <input type="text" class="form-control text-center" id="amount"
                                                            name="amount" value="1400.00" readonly style="font-weight:bold;
                                          font-size:22px;
                                          color:#d9534f;
                                          border:none;
                                          background:transparent;
                                          box-shadow:none;
                                          text-align: right">
                                                    </th>
                                                </tr>

                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Save Order
                                    </button>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>



                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>




    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/ordervalidation.js"></script>
    <script>
        function displayImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img_prev").attr('src', e.target.result).width(80).height(60);

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function () {

            calculateAmount();

            $("#pkg_weight").on("keyup change", function () {
                calculateAmount();
            });

            $("#insurance").change(function () {
                calculateAmount();
            });

            function calculateAmount() {

                var deliveryCharge = 250;

                var weight = parseFloat($("#pkg_weight").val());

                if (isNaN(weight)) {
                    weight = 0;
                }

                var packageCharge = weight * 100;

                // Minimum package charge is Rs. 100
                if (weight > 0 && packageCharge < 100) {
                    packageCharge = 100;
                }
                var insuranceCharge = 0;

                if ($("#insurance").is(":checked")) {
                    insuranceCharge = 500;
                }

                var total = deliveryCharge + packageCharge + insuranceCharge;

                $("#delivery_charge").val(deliveryCharge.toFixed(2));
                $("#fragile_charge").val(packageCharge.toFixed(2));
                $("#insurance_charge").val(insuranceCharge.toFixed(2));
                $("#amount").val(total.toFixed(2));

            }

        });
    </script>

    <script>
        $("#searchSender").click(function () {

    var nic = $("#snic").val();

    if (nic == "") {
        alert("Enter NIC");
        return;
    }

    $.ajax({

        url: "../ajax/search_customer.php",
        type: "POST",
        data: {
            nic: nic
        },

        success: function (response) {

            var data = JSON.parse(response);

            if (data.status == "found") {

                $("#sender_customer_id").val(data.customer.customer_id);

                $("#sname").val(data.customer.customer_name);
                $("#semail").val(data.customer.customer_email);
                $("#saddress").val(data.customer.customer_address);
                $("#scno1").val(data.customer.customer_mobile);
                $("#scno2").val(data.customer.customer_fixed);

                 $("#return_address").val(data.customer.customer_address);

                alert("Customer found.");

            } else {

                $("#sender_customer_id").val("");

                $("#sname").val("");
                $("#semail").val("");
                $("#saddress").val("");
                $("#scno1").val("");
                $("#scno2").val("");

                alert("Customer not found. Please enter customer details.");

            }

        }

    });

});
    </script>

</body>

</html>