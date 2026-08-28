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
include '../model/package_model.php';
$packageObj = new Package();
switch ($status) {
    
    case "activate":
        $customer_id = $_GET["customer_id"];
        $customer_id = base64_decode($customer_id);
        $customerObj->activatecustomer($customer_id);
        $msg = "Successfully Activated!!";
        $msg = base64_encode($msg);
        ?>
        <script>
            window.location = "../view/view_customers.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;
    case "deactivate":
        $customer_id = $_GET["customer_id"];
        $customer_id = base64_decode($customer_id);
        $customerObj->deactivatecustomer($customer_id);
        $msg = "Successfully Deactivated!!";
        $msg = base64_encode($msg);
        ?>
        <script>
            window.location = "../view/view_customers.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;
    case "delete":
        $customer_id = $_GET["customer_id"];
        $customer_id = base64_decode($customer_id);
        $customerObj->deletecustomer($customer_id);
        $msg = "Successfully Deleted!!";
        $msg = base64_encode($msg);
        ?>
        <script>
            window.location = "../view/view_customers.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;
    
}