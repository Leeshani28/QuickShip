<?php
include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/delivery_model.php';

$userrow = $_SESSION["user"];

$orderObj = new Order();
$order_id = $_GET["order_id"];
$order_id = base64_decode($_GET["order_id"]);

$orderResult = $orderObj->getOrder($order_id);
$orderrow = $orderResult->fetch_assoc();

$deliveryObj = new Delivery();
$districtResult = $deliveryObj->getAllBranchDistrict();
$provinceResult = $deliveryObj->getAllProvince();

?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php $pageName = "ORDER MANAGEMENT" ?>
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
                        Edit Order
                    </li>
                </ol>
            </nav>

            <div class="col-md-10">
                <a href="add_order.php"><button type="button" class="btn btn-info btn-lg"><span
                            class="glyphicon glyphicon-plus"></span> Add Order</button></a>
                <a href="view_orders.php"><button type="button" class="btn btn-success btn-lg"><span
                            class="glyphicon glyphicon-search"></span> View Orders</button></a>
                <a href=""><button type="button" class="btn btn-warning btn-lg"><span
                            class="glyphicon glyphicon-book"></span> Generate Order Reports</button></a>
            </div>


        </div>

        <div class="row">
            &nbsp
        </div>

        <form class="form-horizontal" action="../controller/order_controller.php?status=update_order" method="post">

    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
    <input type="hidden" name="sender_id" value="<?php echo $orderrow['sender_id']; ?>">
    <input type="hidden" name="receiver_id" value="<?php echo $orderrow['receiver_id']; ?>">
    <input type="hidden" name="package_id" value="<?php echo $orderrow['package_id']; ?>">

    <div class="panel panel-info" style="height:450px;border-radius: 10px;border: 1px solid #8ac8eb;">
        <div class="panel-heading" style="display: flex; justify-content: left; align-items: center; gap: 5px;">
            <i class="bi bi-person-circle" style="font-size: 25px; margin-right: 5px;color:blue;"></i><h4 class="text-left">Customer Details</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <div class="panel panel-light" style="height:350px;border-radius: 10px;border: 1px solid #8ac8eb;">
                    <div class="panel-heading">
                        <h4 class="text-center">Sender Information</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Name</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="sname" id="sname"
                                    value="<?php echo $orderrow['customer_name']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Email</label>
                            </div>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="semail" id="semail"
                                    value="<?php echo $orderrow['customer_email']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Address</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="saddress" id="saddress"
                                    value="<?php echo $orderrow['customer_address']; ?>" readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">NIC</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="snic" id="snic"
                                    value="<?php echo $orderrow['customer_nic']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Mobile Number</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="scno1" id="scno1"
                                    value="<?php echo $orderrow['customer_mobile']; ?>" readonly/>
                            </div>
                            <div class="col-md-2 text-right">
                                <label class="control-label">Fixed Number</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="scno2" id="scno2"
                                    value="<?php echo $orderrow['customer_fixed']; ?>" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-light" style="height:350px;border-radius: 10px;border: 1px solid #8ac8eb;">
                    <div class="panel-heading">
                        <h4 class="text-center">Receiver Information</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Name</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="rname" id="rname"
                                    value="<?php echo $orderrow['receiver_name']; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Email</label>
                            </div>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="remail" id="remail"
                                    value="<?php echo $orderrow['receiver_email']; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Address</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="raddress" id="raddress"
                                    value="<?php echo $orderrow['receiver_address']; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">NIC</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="rnic" id="rnic"
                                    value="<?php echo $orderrow['receiver_nic']; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-right">
                                <label class="control-label">Mobile Number</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="rcno1" id="rcno1"
                                    value="<?php echo $orderrow['receiver_mobile']; ?>" />
                            </div>
                            <div class="col-md-2 text-right">
                                <label class="control-label">Fixed Number</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="rcno2" id="rcno2"
                                    value="<?php echo $orderrow['receiver_fixed']; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">&nbsp</div>

    <div class="panel panel-warning" style="height:400px;border-radius: 10px;border: 1px solid #ebcb8a;">
        <div class="panel-heading" style="display: flex; justify-content: left; align-items: center; gap: 5px;">
            <i class="bi bi-box-fill" style="font-size: 25px; margin-right: 5px;color:orange;"></i><h4 class="text-left">Package Details</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <label class="control-label" style="text-align: right;">Package Type</label>
                </div>
                <div class="col-md-4 dropdown">
                    <div class="form-group">
                        <select name="pkg_type" id="pkg_type" class="form-control custom-dropdown">
                            <option disabled>Select Package Type</option>
                            <option value="Documents" <?php if ($orderrow['pkg_type'] == "Documents") echo "selected"; ?>>Documents</option>
                            <option value="Electronics" <?php if ($orderrow['pkg_type'] == "Electronics") echo "selected"; ?>>Electronics</option>
                            <option value="Clothing" <?php if ($orderrow['pkg_type'] == "Clothing") echo "selected"; ?>>Clothing</option>
                            <option value="Fragile Items" <?php if ($orderrow['pkg_type'] == "Fragile Items") echo "selected"; ?>>Fragile Items</option>
                            <option value="Food Items" <?php if ($orderrow['pkg_type'] == "Food Items") echo "selected"; ?>>Food Items</option>
                            <option value="Industrial Goods" <?php if ($orderrow['pkg_type'] == "Industrial Goods") echo "selected"; ?>>Industrial Goods</option>
                            <option value="Books" <?php if ($orderrow['pkg_type'] == "Books") echo "selected"; ?>>Books</option>
                            <option value="Others" <?php if ($orderrow['pkg_type'] == "Others") echo "selected"; ?>>Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 text-right">
                    <label class="control-label">Quantity</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="quantity" id="quantity"
                        value="<?php echo $orderrow['quantity']; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-md-2 text-right">
                    <label class="control-label">Declared value(Rs.)</label>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="pkg_value" id="pkg_value"
                        value="<?php echo $orderrow['pkg_value']; ?>" />
                </div>
                <div class="col-md-2 text-right">
                    <label class="control-label">Packaging Type</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="packaging_type" id="packaging_type" class="form-control custom-dropdown">
                            <option disabled>Select Packaging Type</option>
                            <option value="Envelope" <?php if ($orderrow['packaging_type'] == "Envelope") echo "selected"; ?>>Envelope</option>
                            <option value="Cardboard Box" <?php if ($orderrow['packaging_type'] == "Cardboard Box") echo "selected"; ?>>Cardboard Box</option>
                            <option value="Wooden Crate" <?php if ($orderrow['packaging_type'] == "Wooden Crate") echo "selected"; ?>>Wooden Crate</option>
                            <option value="Plastic Wrap" <?php if ($orderrow['packaging_type'] == "Plastic Wrap") echo "selected"; ?>>Plastic Wrap</option>
                            <option value="Padded Bag" <?php if ($orderrow['packaging_type'] == "Padded Bag") echo "selected"; ?>>Padded Bag</option>
                            <option value="Tube Packaging" <?php if ($orderrow['packaging_type'] == "Tube Packaging") echo "selected"; ?>>Tube Packaging</option>
                            <option value="Metal Container" <?php if ($orderrow['packaging_type'] == "Metal Container") echo "selected"; ?>>Metal Container</option>
                            <option value="Others" <?php if ($orderrow['packaging_type'] == "Others") echo "selected"; ?>>Others</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-1 text-right">
                    <label class="control-label">Weight(kg)</label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="pkg_weight" name="pkg_weight" step="0.01"
                        value="<?php echo $orderrow['pkg_weight']; ?>">
                </div>
                <div class="col-md-1 text-right">
                    <label class="control-label">Length(cm)</label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="pkg_length" id="pkg_length"
                        value="<?php echo $orderrow['pkg_length']; ?>" />
                </div>
                <div class="col-md-1 text-right">
                    <label class="control-label">Width(cm)</label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="pkg_width" id="pkg_width"
                        value="<?php echo $orderrow['pkg_width']; ?>" />
                </div>
                <div class="col-md-1 text-right">
                    <label class="control-label">Height(cm)</label>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="height" id="height"
                        value="<?php echo $orderrow['height']; ?>" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php
                $fragile = ($orderrow['fragile_item'] == 1) ? "checked" : "";
                $insure  = ($orderrow['insurance'] == 1) ? "checked" : "";
            ?>
            <div class="row">
                <div class="col-md-3" style="padding-left:50px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="checkDefault"
                            name="fragile_item" <?php echo $fragile; ?>>
                        <label class="form-check-label" for="checkDefault">
                            Fragile Item
                        </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-check" style="padding-left:50px;">
                        <input type="checkbox" id="insurance" name="insurance" value="1" <?php echo $insure; ?>>
                        <label class="form-check-label" for="insurance">
                            Add Insurance
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>

            <div class="row">
                <div class="col-md-2 text-right">
                    <label class="control-label">Special Instructions</label>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="instructions" id="instructions"
                        value="<?php echo $orderrow['instructions']; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
        </div>
    </div>

    <div class="row">&nbsp</div>

    <div class="panel panel-success" style="height:750px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
        <div class="panel-heading" style="display: flex; justify-content: left; align-items: center; gap: 5px;">
            <i class="bi bi-truck" style="font-size: 25px; margin-right: 5px;color:green;"></i><h4 class="text-left">Delivery Details</h4>
        </div>
        <div class="row">&nbsp</div>

        <div class="col-md-12">
            <div class="panel panel-light" style="height:375px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                <div class="panel-heading">
                    <h4 class="text-center">Address Details</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label" style="text-align: right;">Premises No.</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="premises_no" id="premises_no"
                                value="<?php echo $orderrow['premises_no']; ?>" />
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="control-label">Premises Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="premises_name" id="premises_name"
                                value="<?php echo $orderrow['premises_name']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label">Street</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="street" id="street"
                                value="<?php echo $orderrow['street']; ?>" />
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="control-label">Town/City</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="town" id="town"
                                value="<?php echo $orderrow['town']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <!-- Province select intentionally left disabled, matching the original Add Order form.
                             If you need Province back, uncomment and mirror the District pattern below. -->

                        <div class="col-md-2 text-right">
                            <label class="control-label">District</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="district_id" id="district_id" class="form-control custom-dropdown">
                                    <option value="">Select District</option>
                                    <?php
                                    mysqli_data_seek($districtResult, 0);
                                    while ($districtrow = $districtResult->fetch_assoc()) { ?>
                                        <option value="<?php echo $districtrow["district_id"]; ?>"
                                            <?php if ($districtrow["district_id"] == $orderrow["district_id"]) echo "selected"; ?>>
                                            <?php echo $districtrow["district_name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label">Postal Code</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="postal_code" id="postal_code"
                                value="<?php echo $orderrow['postal_code']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label">Return Address</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="return_address" id="return_address"
                                value="<?php echo $orderrow['return_address']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">&nbsp</div>

        <div class="col-md-12">
            <div class="panel panel-light" style="height:260px;border-radius: 10px;border: 1px solid #8aeb8cd6;">
                <div class="panel-heading">
                    <h4 class="text-center">Delivery Options</h4>
                </div>
                <div class="panel-body">
                    <?php $pod = ($orderrow['pod'] == 1) ? "checked" : ""; ?>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="col-md-3" style="padding-left:50px;">
                        <div class="form-check">
                            <label class="form-check-label" for="checkPod">
                                Proofs of Delivery
                            </label>
                            <span></span> <input class="form-check-input" type="checkbox" value="1"
                                id="checkPod" name="pod" <?php echo $pod; ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label">Delivery Type</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="delivery_type" id="delivery_type" class="form-control custom-dropdown">
                                    <option disabled>Select Delivery Type</option>
                                    <option value="Standard" <?php if ($orderrow['delivery_type'] == "Standard") echo "selected"; ?>>Standard</option>
                                    <option value="Express" <?php if ($orderrow['delivery_type'] == "Express") echo "selected"; ?>>Express</option>
                                    <option value="Same_day" <?php if ($orderrow['delivery_type'] == "Same_day") echo "selected"; ?>>Same day</option>
                                    <option value="Next_day" <?php if ($orderrow['delivery_type'] == "Next_day") echo "selected"; ?>>Next day</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="control-label">Preferred Delivery Date</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="preferred_del_date" id="preferred_del_date"
                                value="<?php echo $orderrow['preferred_del_date']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <label class="control-label">Delivery Instructions</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="deli_instruction" id="deli_instruction"
                                value="<?php echo $orderrow['deli_instruction']; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

    <div class="panel panel-danger" style="border-radius:10px;border:1px solid #db64b7d9;">
        <div class="panel-heading" style="display:flex;justify-content:left;align-items:center;gap:5px;">
            <i class="bi bi-credit-card-2-front-fill" style="font-size:25px;margin-right:5px;color:#d63384;"></i>
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
                                    <select name="payment_type" id="payment_type" class="form-control custom-dropdown">
                                        <option disabled>Select Payment Type</option>
                                        <option value="COD" <?php if ($orderrow['payment_type'] == "COD") echo "selected"; ?>>Cash On Delivery (COD)</option>
                                        <option value="Prepaid" <?php if ($orderrow['payment_type'] == "Prepaid") echo "selected"; ?>>Pre-paid</option>
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
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>

    <div class="panel panel-danger" style="border-radius:10px;border:1px solid #f5a3a3;">
        <div class="panel-heading" style="display:flex;align-items:center;gap:5px;">
            <i class="bi bi-receipt-cutoff" style="font-size:25px;color:#d9534f;"></i>
            <h4 class="text-left">Amount Summary</h4>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <table class="table table-bordered table-hover text-center" style="font-size:16px;">
                        <tr style="background:#f9f9f9;">
                            <th class="text-center">Item</th>
                            <th class="text-center">Amount (Rs.)</th>
                        </tr>
                        <tr>
                            <td>Delivery Charge</td>
                            <td>
                                <input type="text" class="form-control text-center" id="delivery_charge"
                                    name="delivery_charge"
                                    value=""
                                    readonly
                                    style="border:none; background:transparent; box-shadow:none; text-align: right;">
                            </td>
                        </tr>
                        <tr>
                            <td>Package Charge</td>
                            <td>
                                <input type="text" class="form-control text-center" id="fragile_charge"
                                    name="fragile_charge"
                                    value=""
                                    readonly
                                    style="border:none; background:transparent; box-shadow:none;text-align: right">
                            </td>
                        </tr>
                        <tr>
                            <td>Insurance Charge</td>
                            <td>
                                <input type="text" class="form-control text-center" id="insurance_charge"
                                    name="insurance_charge"
                                    value=""
                                    readonly
                                    style="border:none; background:transparent; box-shadow:none; text-align: right">
                            </td>
                        </tr>
                        <tr style="background:#fff3cd;">
                            <th class="text-center" style="font-size:18px;">
                                Total Amount
                            </th>
                            <th>
                                <input type="text" class="form-control text-center" id="amount" name="amount"
                                    value=""
                                    readonly
                                    style="font-weight:bold; font-size:22px; color:#d9534f; border:none;
                                           background:transparent; box-shadow:none; text-align: right">
                            </th>
                        </tr>
                        <!--
                            NOTE: delivery_charge / fragile_charge / insurance_charge / amount are NOT
                            stored columns — they're computed by calculateAmount() in JS from pkg_weight
                            and the insurance checkbox (see add_order.php). On the Edit page, include the
                            same jQuery + script block as add_order.php and call calculateAmount() once on
                            $(document).ready() so it initializes correctly from the pre-filled pkg_weight
                            and insurance values below.
                        -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-left">
            <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
        </div>
        <div class="col-md-6 text-right">
            <button type="submit" name="action" value="update_order" class="btn btn-primary btn-lg">
                Update Order
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">&nbsp;</div>
    </div>

</form>

        <div class="row">
            &nbsp
        </div>
    </div>
</body>

<script src="../js/ordervalidation.js"></script>

<!--
    Add this near the bottom of edit_order.php, in the same place add_order.php
    loads jQuery + its calculation script. This is the SAME logic as add_order.php,
    just triggered once on page load so it recalculates from the pre-filled
    pkg_weight / insurance values that came from $orderrow.
-->
<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/ordervalidation.js"></script>
<script>
    $(document).ready(function () {

        // Run once immediately so the summary reflects the saved order's
        // weight/insurance instead of showing blank fields.
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

</html>