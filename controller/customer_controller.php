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
$customerObj = new Customer();
switch ($status) {
    case "add_customer":
        $name = $_POST["name"];
        $Customer_category = $_POST["customer_category"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        
        $nic = $_POST["nic"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        try {
            $customer_id = $customerObj->addCustomer($name,$Customer_category, $address, $email, $nic,$cno1,$cno2);
            if ($customer_id > 0) {
                
                $msg = "customer $name  Successfully Added!!";
                $msg = base64_encode($msg);
                ?>
                <script>
                     window.location = "../view/view_customers.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/add_customer.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;
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
    case "update_customer":
        $customer_id = $_POST["customer_id"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $nic = $_POST["nic"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        
        
        try {

            //Update customer
            $customerObj->updatecustomer($name,$address, $email, $nic,$cno1,$cno2, $customer_id);
           
            $msg = "$name  Successfully Updated!";
            $msg = base64_encode($msg);
            $customer_id = base64_encode($customer_id);
            ?>
            <script>
                window.location = "../view/view_customer.php?customer_id=<?php echo $customer_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            
            ?>
            <script>
                window.location = "../view/edit_customer.php?customer_id=<?php echo $customer_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;
}