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
$districtResult = $deliveryObj->getAllDistrict();
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

        <form action="../controller/order_controller.php?status=update_order" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            <input type="hidden" name="sender_id" value="<?php echo $orderrow['sender_id']; ?>">
            <input type="hidden" name="receiver_id" value="<?php echo $orderrow['receiver_id']; ?>">
            <input type="hidden" name="package_id" value="<?php echo $orderrow['package_id']; ?>">
            <div class="row">

                <!-- Sender -->
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4>Sender Details</h4>
                        </div>
                        <div class="panel-body">

                            <label>Name</label>
                            <input type="text" name="sname" class="form-control"
                                value="<?php echo $orderrow['customer_name']; ?>">

                            <label>Email</label>
                            <input type="email" name="semail" class="form-control"
                                value="<?php echo $orderrow['customer_email']; ?>">

                            <label>NIC</label>
                            <input type="text" name="snic" class="form-control"
                                value="<?php echo $orderrow['customer_nic']; ?>">

                            <label>Mobile NO</label>
                            <input type="text" name="scno1" class="form-control"
                                value="<?php echo $orderrow['customer_mobile']; ?>">

                            <label>Fixed No</label>
                            <input type="text" name="scno2" class="form-control"
                                value="<?php echo $orderrow['customer_fixed']; ?>">

                            <label>Address</label>
                            <input type="text" name="saddress" class="form-control"
                                value="<?php echo $orderrow['customer_address']; ?>">

                        </div>
                    </div>
                </div>

                <!-- Receiver -->
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4>Receiver Details</h4>
                        </div>
                        <div class="panel-body">

                            <label>Name</label>
                            <input type="text" name="rname" class="form-control"
                                value="<?php echo $orderrow['receiver_name']; ?>">

                            <label>Email</label>
                            <input type="email" name="remail" class="form-control"
                                value="<?php echo $orderrow['receiver_email']; ?>">

                            <label>NIC</label>
                            <input type="text" name="rnic" class="form-control"
                                value="<?php echo $orderrow['receiver_nic']; ?>">

                            <label>Mobile NO</label>
                            <input type="text" name="rcno1" class="form-control"
                                value="<?php echo $orderrow['receiver_mobile']; ?>">

                            <label>Fixed No</label>
                            <input type="text" name="rcno2" class="form-control"
                                value="<?php echo $orderrow['receiver_fixed']; ?>">

                            <label>Address</label>
                            <input type="text" name="raddress" class="form-control"
                                value="<?php echo $orderrow['receiver_address']; ?>">

                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="display: flex;">

                <!-- Package -->
                <div class="col-md-6" style="display: flex;">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h4>Package Details</h4>
                        </div>
                        <div class="panel-body">

                            <!-- Package Type -->
                            <div class="form-group">
                                <label>Package Type</label>
                                <div class="form-group">

                                    <select name="pkg_type" id="pkg_type" class="form-control custom-dropdown">
                                        <option>Select Package Type</option>
                                        <option value="Documents" <?php if ($orderrow['pkg_type'] == "Documents")
                                            echo "selected"; ?>>Documents</option>
                                        <option value="Electronics" <?php if ($orderrow['pkg_type'] == "Electronics")
                                            echo "selected"; ?>>Electronics</option>
                                        <option value="Clothing" <?php if ($orderrow['pkg_type'] == "Clothing")
                                            echo "selected"; ?>>Clothing</option>
                                        <option value="Fragile Items" <?php if ($orderrow['pkg_type'] == "Fragile Items")
                                            echo "selected"; ?>>Fragile Items</option>
                                        <option value="Food Items" <?php if ($orderrow['pkg_type'] == "Food Items")
                                            echo "selected"; ?>>Food Items</option>
                                        <option value="Industrial Goods" <?php if ($orderrow['pkg_type'] == "Industrial Goods")
                                            echo "selected"; ?>>Industrial Goods</option>
                                        <option value="Books" <?php if ($orderrow['pkg_type'] == "Books")
                                            echo "selected"; ?>>Books</option>
                                        <option value="Others" <?php if ($orderrow['pkg_type'] == "Others")
                                            echo "selected"; ?>>Others</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                    value="<?php echo $orderrow['quantity']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Declared Value(Rs.)</label>
                                <input type="number" name="pkg_value" class="form-control"
                                    value="<?php echo $orderrow['pkg_value']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Special Instructions</label>
                                <input type="text" name="instructions" class="form-control"
                                    value="<?php echo $orderrow['instructions']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Packaging Type</label>
                                <div class="form-group">

                                    <select name="packaging_type" id="packaging_type"
                                        class="form-control custom-dropdown">
                                        <option>Select Packaging Type</option>
                                        <option value="Envelope" <?php if ($orderrow['packaging_type'] == "Envelope")
                                            echo "selected"; ?>>Envelope</option>
                                        <option value="Cardboard Box" <?php if ($orderrow['packaging_type'] == "Cardboard Box")
                                            echo "selected"; ?>>Cardboard Box</option>
                                        <option value="Wooden Crate" <?php if ($orderrow['packaging_type'] == "Wooden Crate")
                                            echo "selected"; ?>>Wooden Crate</option>
                                        <option value="Plastic Wrap" <?php if ($orderrow['packaging_type'] == "Plastic Wrap")
                                            echo "selected"; ?>>Plastic Wrap</option>
                                        <option value="Padded Bag" <?php if ($orderrow['packaging_type'] == "Padded Bag")
                                            echo "selected"; ?>>Padded Bag</option>
                                        <option value="Tube Packaging" <?php if ($orderrow['packaging_type'] == "Tube Packaging")
                                            echo "selected"; ?>>Tube Packaging</option>
                                        <option value="Metal Container" <?php if ($orderrow['packaging_type'] == "Metal Container")
                                            echo "selected"; ?>>Metal Container</option>
                                        <option value="Others" <?php if ($orderrow['packaging_type'] == "Others")
                                            echo "selected"; ?>>Others</option>
                                    </select>
                                </div>
                            </div>



                            <!-- Dimensions in ONE LINE -->
                            <div class="row">

                                <div class="col-md-12">
                                    <label>Weight (kg)</label>
                                    <input type="text" name="pkg_weight" class="form-control"
                                        value="<?php echo $orderrow['pkg_weight']; ?>">
                                </div>



                            </div>
                            <div class="row">
                                &nbsp;
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label>Length (cm)</label>
                                    <input type="text" name="pkg_length" class="form-control"
                                        value="<?php echo $orderrow['pkg_length']; ?>">
                                </div>

                                <div class="col-md-4">
                                    <label>Width (cm)</label>
                                    <input type="text" name="pkg_width" class="form-control"
                                        value="<?php echo $orderrow['pkg_width']; ?>">
                                </div>

                                <div class="col-md-4">
                                    <label>Height (cm)</label>
                                    <input type="text" name="height" class="form-control"
                                        value="<?php echo $orderrow['height']; ?>">
                                </div>

                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <?php
                            if ($orderrow['fragile_item'] == 1) {
                                $fragile = "Checked";

                            } else {
                                $fragile = "";
                            }
                            if ($orderrow['insurance'] == 1) {
                                $insure = "Checked";

                            } else {
                                $insure = "";
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="checkDefault"
                                            name="fragile_item" <?php echo $fragile; ?>>
                                        <label class="form-check-label" for="checkDefault">
                                            Fragile Item
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check" style="padding-left:50px;">
                                        <input class="form-check-input" type="checkbox" value="1" id="checkChecked"
                                            name="insurance" <?php echo $insure; ?>>
                                        <label class="form-check-label" for="checkChecked">
                                            Add Insurance
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Delivery -->
                <div class="col-md-6" style="display: flex;">
                    <div class="panel panel-success" style="width: 100%;">
                        <div class="panel-heading">
                            <h4>Delivery Details</h4>
                        </div>
                        <div class="panel-body">

                            <label>Premises No</label>
                            <input type="text" name="premises_no" class="form-control"
                                value="<?php echo $orderrow['premises_no']; ?>">

                            <label>Premises Name</label>
                            <input type="text" name="premises_name" class="form-control"
                                value="<?php echo $orderrow['premises_name']; ?>">

                            <label>Province</label>
                            

                                <select name="province_id" id="province_id" class="form-control custom-dropdown">
                                    <?php 
                                    while($provinceRow=$provinceResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $provinceRow["province_id"]; ?>"
                                   <?php
                                   if($provinceRow["province_id"]==$orderrow["province_id"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $provinceRow["province_name"]; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                    
                                </select>

                            <label>District</label>
                            

                                <select name="district_id" id="district_id" class="form-control custom-dropdown">
                                    <?php 
                                    while($districtRow=$districtResult->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $districtRow["district_id"]; ?>"
                                   <?php
                                   if($districtRow["district_id"]==$orderrow["district_id"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $districtRow["district_name"]; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                    
                                </select>

                            <label>Town</label>
                            <input type="text" name="town" class="form-control"
                                value="<?php echo $orderrow['town']; ?>">

                            <label>Street</label>
                            <input type="text" name="street" class="form-control"
                                value="<?php echo $orderrow['street']; ?>">

                                <div class="row">
                                &nbsp;
                            </div>
                            <?php
                            if ($orderrow['pod'] == 1) {
                                $pod = "Checked";

                            } else {
                                $pod = "";
                            }
                            
                            ?>


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="checkDefault"
                                    name="pod" <?php echo $pod; ?>>
                                <label class="form-check-label" for="checkDefault">
                                    Proofs of delivery
                                </label>
                            </div>


                            <label>Delivery Type</label>
                            <div class="form-group">

                                <select name="delivery_type" id="delivery_type" class="form-control custom-dropdown">
                                    <option selected disabled>Select Delivery Type</option>
                                    <option value="Standard" <?php if ($orderrow['delivery_type'] == "Standard")
                                        echo "selected"; ?>>Standard</option>
                                    <option value="Express" <?php if ($orderrow['delivery_type'] == "Express")
                                        echo "selected"; ?>>Express</option>
                                    <option value="Same_day" <?php if ($orderrow['delivery_type'] == "Same day")
                                        echo "selected"; ?>>Same day</option>
                                    <option value="Next_day" <?php if ($orderrow['delivery_type'] == "Next day")
                                        echo "selected"; ?>>Next day</option>
                                </select>
                            </div>



                            <label>Preferred Date</label>
                            <input type="date" name="preferred_del_date" class="form-control"
                                value="<?php echo $orderrow['preferred_del_date']; ?>">
                            <label>Delivery Instructions</label>
                            <input type="text" name="deli_instruction" class="form-control"
                                value="<?php echo $orderrow['deli_instruction']; ?>">

                            <label>Postal Code</label>
                            <input type="text" name="postal_code" class="form-control"
                                value="<?php echo $orderrow['postal_code']; ?>">

                            <label>Return Address</label>
                            <input type="text" name="return_address" class="form-control"
                                value="<?php echo $orderrow['return_address']; ?>">

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4>Payment Details</h4>
                        </div>
                        <div class="panel-body">

                            <label>Payment Type</label>
                            <div class="form-group">

                                <select name="payment_type" id="payment_type" class="form-control custom-dropdown">
                                    <option selected disabled>Select Payment Type</option>
                                    <option value="COD" <?php if ($orderrow['payment_type'] = "COD")
                                        echo "selected"; ?>>Cash On Delivery(COD)</option>
                                    <option value="Prepaid" <?php if ($orderrow['payment_type'] = "Prepaid")
                                        echo "selected"; ?>>Pre-paid</option>
                                </select>
                            </div>

                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control"
                                value="<?php echo $orderrow['amount']; ?>">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="reset" class="btn btn-danger btn-lg" value="Reset">
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" name="action" value="update_order" class="btn btn-primary btn-lg">
                        Update Order
                    </button>
                </div>
            </div>

        </form>

        <div class="row">
            &nbsp
        </div>
    </div>
</body>

<script src="../js/ordervalidation.js"></script>

</html>