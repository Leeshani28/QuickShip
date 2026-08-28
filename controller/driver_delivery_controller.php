<?php
include '../commons/session.php';
if (!isset($_GET["status"])) {
    ?>
    <script>
        window.location = "../view/login.php";
    </script>
    <?php
}
$status = $_GET["status"];
include '../model/customer_model.php';
include '../model/package_model.php';
include '../model/order_model.php';
include '../model/delivery_model.php';
include_once '../model/user_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';

// $userrow = $_SESSION["user"];

$customerObj = new Customer();
$packageObj = new Package();
$orderObj = new Order();
$deliveryObj = new Delivery();
$warehouseObj = new Warehouse();
$driverObj = new Driver();


switch ($status) {

    case "driver_order_details":

        $order_id = $_POST["order_id"];
        $orderResult = $orderObj->getOrder($order_id);
        $orderrow = $orderResult->fetch_assoc();

        ?>
        <div class="modal-header">
            <div class="panel-heading" style="background:#caeff9;color:black;">
                <h3>
                    <b>
                        Order #<?php echo $orderrow["order_id"]; ?>

                    </b>
                </h3>
                <h4><b><?php echo $orderrow["customer_name"]; ?></b></h4>
            </div>
        </div>


        <div class="modal-body">

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


                            <h4><span class="glyphicon glyphicon-road"></span> <b>Delivery Details</b></h4>
                            <hr style="border-top:2px solid #ddd; margin:10px 0;" />

                            <p>
                                <?php echo $orderrow["premises_no"] . ", " . $orderrow["street"] . ", " . $orderrow["town"]; ?>
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>District:</strong> <?php echo $orderrow["district_name"]; ?></p>
                                    <p><strong>Province:</strong> <?php echo $orderrow["province_name"]; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Postal Code:</strong> <?php echo $orderrow["postal_code"]; ?></p>
                                    <p><strong>Delivery Type:</strong> <?php echo $orderrow["delivery_type"]; ?></p>
                                </div>
                            </div>

                            <div>
                                &nbsp;
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <h4><span class="glyphicon glyphicon-person"></span><b>Sender Details</b></h4>
                                    <hr style="border-top:2px solid #ddd; margin:10px 0;" />
                                    <p><strong>Name:</strong> <?php echo $orderrow["customer_name"]; ?></p>
                                    <p><strong>Mobile:</strong> <?php echo $orderrow["customer_mobile"]; ?></p>
                                    <p><strong>Address:</strong> <?php echo $orderrow["customer_address"]; ?></p>
                                </div>

                                <div class="col-md-6">
                                    <h4><span class="glyphicon glyphicon-person"></span><b>Receiver Details</b></h4>
                                    <hr style="border-top:2px solid #ddd; margin:10px 0;" />
                                    <p><strong>Name:</strong> <?php echo $orderrow["receiver_name"]; ?></p>
                                    <p><strong>Mobile:</strong> <?php echo $orderrow["receiver_mobile"]; ?></p>
                                    <p><strong>Address:</strong> <?php echo $orderrow["receiver_address"]; ?></p>
                                </div>
                            </div>

                            <div>
                                &nbsp;
                            </div>


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


                        </div>



                    </div>

                </div>
            </div>

        </div>


        <?php
        break;


    case "return_order":

        $ofd_id = $_POST["ofd_id"];
        $order_id = $_POST["order_id"];
        $log_remarks = "Returned";
        $status_id = 3;
        // $remarks = $_POST["$remarks"] ;          


        try {
            $warehouseObj->returnedOrder($ofd_id);

            $warehouseObj->setStatusCancelShipmentOrders($order_id, $status_id);
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);


            $msg = "Order Returned";
            $msg = base64_encode($msg);

            // echo $remarks;

            ?>
            <script>
                window.location = "../view/driver_dashboard.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/driver_dashboard.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }



        break;



    case "deliverd_order":

        $ofd_id = $_POST["ofd_id"];
        $order_id = $_POST["order_id"];
        $delivery_proof = $_FILES["delivery_proof"] ?? null;
        $pod = $_POST["pod"];
        $payment_type = $_POST["payment_type"];
        $payment_status = $_POST["payment_status"] ?? '';
        $log_remarks = "Delivered";
        $status_id = 8;
        // $remarks = $_POST["$remarks"] ;          


        try {


            if ($pod == 1 && empty($delivery_proof['name'])) {
                throw new Exception("Proof of Delivery (POD) is required.");
            }

            if ($payment_type == "COD" && $payment_status != "Paid") {
                throw new Exception("Please collect the payment before delivering the order.");
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($_FILES['delivery_proof']['type'], $allowedTypes)) {
                 throw new Exception("Only image files are allowed.");
            }

            if ($payment_type == "COD" && $payment_status == "Paid") {
                $orderObj->setPaymentStatus($order_id);
            }


            $file_name = "";

            if (isset($_FILES["delivery_proof"])) {
                if ($delivery_proof["name"] != "") {
                    $file_name = time() . "_" . $delivery_proof["name"];
                    $path = "../images/delivery_proof/$file_name";
                    move_uploaded_file($delivery_proof["tmp_name"], $path);
                }
            }


            $warehouseObj->deliveredOrder($ofd_id, $file_name);

            $warehouseObj->setStatusCancelShipmentOrders($order_id, $status_id);
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);
            // $orderObj->setPaymentStatus($order_id);



            $msg = "Order Delivered";
            $msg = base64_encode($msg);

            // echo $remarks;

            ?>
            <script>
                window.location = "../view/driver_dashboard.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {

            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/driver_dashboard.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }



        break;






}
