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

$userrow = $_SESSION["user"];

$customerObj = new Customer();
$packageObj = new Package();
$orderObj = new Order();
$deliveryObj = new Delivery();

switch ($status) {
    case "add_order":
        $sname = $_POST["sname"];
        $saddress = $_POST["saddress"];
        $semail = $_POST["semail"];
        $snic = $_POST["snic"];
        $scno1 = $_POST["scno1"];
        $scno2 = $_POST["scno2"];

        $rname = $_POST["rname"];
        $raddress = $_POST["raddress"];
        $remail = $_POST["remail"] ?? "";
        $rnic = $_POST["rnic"] ?? "";
        $rcno1 = $_POST["rcno1"];
        $rcno2 = $_POST["rcno2"];

        $quantity = $_POST["quantity"];
        $pvalue = $_POST["pkg_value"];
        $pkg_type = $_POST["pkg_type"];
        $ptype = $_POST["packaging_type"];
        $pkg_weight = $_POST["pkg_weight"];
        $length = $_POST["pkg_length"];
        $width = $_POST["pkg_width"];
        $height = $_POST["height"];
        $fragile_item = isset($_POST["fragile_item"]) ? 1 : 0;
        $insurance = isset($_POST["insurance"]) ? 1 : 0;
        $instructions = $_POST["instructions"] ?? "";

        $premises_no = $_POST["premises_no"];
        $premises_name = $_POST["premises_name"] ?? "";
        $street = $_POST["street"] ?? "";
        $town = $_POST["town"];
        $province_id = 0;
        $district_id = $_POST["district_id"];
        $postal_code = $_POST["postal_code"];
        $return_address = $_POST["return_address"];

        $pod = isset($_POST["pod"]) ? 1 : 0;
        $delivery_type = $_POST["delivery_type"];
        $preferred_del_date = $_POST["preferred_del_date"];
        $deli_instruction = $_POST["deli_instruction"];

        $payment_type = $_POST["payment_type"];
        $amount = $_POST["amount"];
        $order_location = $userrow["user_location"];
        $status_id = 1;
        $log_remarks = "Order is placed!";

        // $payment_status == "";


        if ($payment_type == "Prepaid") {
            $payment_status = "Paid";


        } else {
            $payment_status = "Pending";

        }


        try {

            if (!empty($_POST["sender_customer_id"])) {

                // Existing customer
                $sender_id = $_POST["sender_customer_id"];

            } else {

                 //add sender
            $sender_id = $customerObj->addCustomer($sname, $saddress, $semail, $snic, $scno1, $scno2);

            }
           
            //add reciever
            $receiver_id = $customerObj->addReceiver($rname, $raddress, $remail, $rnic, $rcno1, $rcno2);

            //add order
            $order_id = $orderObj->addOrder($sender_id, $receiver_id, $province_id, $district_id, $order_location, $premises_no, $premises_name, $street, $town, $postal_code, $return_address, $pod, $delivery_type, $preferred_del_date, $deli_instruction, $payment_type, $amount);

            //add package
            $package_id = $packageObj->addPackage($order_id, $quantity, $pvalue, $pkg_type, $ptype, $pkg_weight, $length, $width, $height, $fragile_item, $insurance, $instructions);

            //add log record
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);

            //add order payment
            $orderObj->orderPayment($order_id, $amount, $payment_type, $payment_status);


            $msg = "Order $order_id Successfully Added!!";
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_orders.php?msg=<?php echo $msg; ?>";
            </script>

            <?php

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/add_order.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;

    case "update_order":

        $order_id = $_POST["order_id"];
        $sender_id = $_POST["sender_id"];
        $sname = $_POST["sname"];
        $saddress = $_POST["saddress"];
        $semail = $_POST["semail"];
        $snic = $_POST["snic"];
        $scno1 = $_POST["scno1"];
        $scno2 = $_POST["scno2"];

        $receiver_id = $_POST["receiver_id"];
        $rname = $_POST["rname"];
        $raddress = $_POST["raddress"];
        $remail = $_POST["remail"];
        $rnic = $_POST["rnic"];
        $rcno1 = $_POST["rcno1"];
        $rcno2 = $_POST["rcno2"];

        $package_id = $_POST["package_id"];
        $quantity = $_POST["quantity"];
        $pvalue = $_POST["pkg_value"];
        $pkg_type = $_POST["pkg_type"];
        $ptype = $_POST["packaging_type"];
        $pkg_weight = $_POST["pkg_weight"];
        $length = $_POST["pkg_length"];
        $width = $_POST["pkg_width"];
        $height = $_POST["height"];
        $fragile_item = isset($_POST["fragile_item"]) ? 1 : 0;
        $insurance = isset($_POST["insurance"]) ? 1 : 0;
        $instructions = $_POST["instructions"];

        $premises_no = $_POST["premises_no"];
        $premises_name = $_POST["premises_name"];
        $street = $_POST["street"];
        $town = $_POST["town"];
        $province_id = 0;
        $district_id = $_POST["district_id"];
        $postal_code = $_POST["postal_code"];
        $return_address = $_POST["return_address"];

        $pod = isset($_POST["pod"]) ? 1 : 0;
        $delivery_type = $_POST["delivery_type"];
        $preferred_del_date = $_POST["preferred_del_date"];
        $deli_instruction = $_POST["deli_instruction"];

        $payment_type = $_POST["payment_type"];
        $amount = $_POST["amount"];
        $order_location = $userrow["user_location"];


        try {

            $customerObj->Updatecustomer($sname, $saddress, $semail, $snic, $scno1, $scno2, $sender_id);
            $customerObj->updatereceiver($rname, $raddress, $remail, $rnic, $rcno1, $rcno2, $receiver_id);
            $packageObj->Updatepackage($package_id, $quantity, $pvalue, $pkg_type, $ptype, $pkg_weight, $length, $width, $height, $fragile_item, $insurance, $instructions);
            $orderObj->updateOrder($sender_id, $receiver_id, $province_id, $district_id, $order_location, $premises_no, $premises_name, $street, $town, $postal_code, $return_address, $pod, $delivery_type, $preferred_del_date, $deli_instruction, $payment_type, $amount, $order_id);


            $msg = "Order #$order_id  Successfully Updated!";
            $msg = base64_encode($msg);
            $order_id = base64_encode($order_id);

            ?>
            <script>
                window.location = "../view/view_order.php?order_id=<?php echo $order_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/edit_order.php?order_id=<?php echo $order_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;


    case "confirm_order":

        $order_id = $_GET["order_id"];
        $status_id = 2;
        $log_remarks = "Order is Confirmed!";
        $order_id = base64_decode($order_id);

        try {
            $orderObj->confirmOrder($order_id);
            //add log record
            $orderObj->addOrderLog($order_id, $status_id, $log_remarks);

            $msg = "Order #$order_id  Successfully Confirmed!";
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_orders.php?msg=<?php echo $msg; ?>";
            </script>

            <?php


        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_orders.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        }

        break;

    case "delete_order":
        $order_id = $_POST["order_id"];
        $order_id = base64_decode($order_id);
        $orderObj->deleteOrder($order_id);
        $msg = "Order Canceled!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_orders.php?msg=<?php echo $msg; ?>";
        </script>
        <?php

        break;




}