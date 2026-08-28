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

include '../model/user_model.php';
include '../model/login_model.php';
include '../model/delivery_model.php';
$userObj = new User();
$loginObj = new Login();
$deliveryObj = new Delivery();

switch ($status) {
    case "load_functions":

        $role_id = $_POST["role"];

        $moduleResult = $userObj->getRoleModules($role_id);

        while ($module_row = $moduleResult->fetch_assoc()) {
            $module_id = $module_row["module_id"];
            $functionResult = $userObj->getModuleFunctions($module_id);
            ?>

            <div class="col-md-4" style="margin-bottom:20px;">
                <div class="panel panel-default" style="min-height:250px;">
                    <div class="panel-heading">
                        <strong><?php echo $module_row["module_name"]; ?></strong>
                    </div>

                    <div class="panel-body">

                        <?php
                        while ($fun_row = $functionResult->fetch_assoc()) {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"]; ?>" checked>
                                    <?php echo $fun_row["function_name"]; ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>

            <?php
        }

        break;
    case "add_user":

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $dob = $_POST["dob"];
        $nic = $_POST["nic"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        $user_role = $_POST["user_role"];
        $user_location = $_POST["user_location"];
        $user_image = $_FILES["user_image"];
        $user_functions = $_POST["fun"];



        try {
            if ($fname == "") {

                throw new Exception("First Name cannot be Empty!!!!");
            }

            $emailResult = $userObj->checkEmailExist($email);
            $emailRow = $emailResult->fetch_assoc();

            if ($emailRow["total"] > 0) {
                throw new Exception("Email Already Exists!!!!");
            }

            $nicResult = $userObj->checkNICExist($nic);
            $nicRow = $nicResult->fetch_assoc();

            if ($nicRow["total"] > 0) {
                throw new Exception("NIC Already Exists!!!!");
            }

            ///  uploading image
            $file_name = "";
            if (isset($_FILES["user_image"])) {
                if ($user_image["name"] != "") {
                    $file_name = time() . "_" . $user_image["name"];
                    $path = "../images/courier_images/$file_name";
                    move_uploaded_file($user_image["tmp_name"], $path);
                }
            }
            $user_id = $userObj->addUser($fname, $lname, $email, $dob, $nic, $user_role, $user_location, $file_name);

            ///  creating a login account
            if ($user_id > 0) {
                $loginObj->addUserLogin($user_id, $email, $nic);

                //add user contact
                $userObj->addUserContact($user_id, $cno1);

                $userObj->addUserContact($user_id, $cno2);



                //add user function

                foreach ($user_functions as $fun_id) {
                    $userObj->addUserFunctions($user_id, $fun_id);

                }

                $msg = "User $fname $lname Successfully Added!!";
                $msg = base64_encode($msg);



                ?>

                <script>
                    window.location = "../view/view_users.php?msg=<?php echo $msg; ?>";
                </script>
                <?php

            }




        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/add_user.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        }


        break;


    case "activate":
        $user_id = $_GET["user_id"];
        $user_id = base64_decode($user_id);
        $userObj->activateUser($user_id);
        $msg = "Successfully Activated!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_users.php?msg=<?php echo $msg; ?>";
        </script>
        <?php



        break;

    case "deactivate":
        $user_id = $_GET["user_id"];
        $user_id = base64_decode($user_id);
        $userObj->deactivateUser($user_id);
        $msg = "Successfully Deactivated!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_users.php?msg=<?php echo $msg; ?>";
        </script>
        <?php

        break;


    case "delete_user":
        $user_id = $_POST["user_id"];
        // echo $user_id;
        $user_id = base64_decode($user_id);
        $userObj->deleteUser($user_id);
        $msg = "Successfully Deleted!!";
        $msg = base64_encode($msg);

        ?>
        <script>
            window.location = "../view/view_users.php?msg=<?php echo $msg; ?>";
        </script>
        <?php

        break;

    case "update_user":
        $user_id = $_POST["user_id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $dob = $_POST["dob"];
        $nic = $_POST["nic"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        $user_role = $_POST["user_role"];
        $district_id = $_POST["district_id"];
        $user_image = $_FILES["user_image"];
        $user_functions = $_POST["fun"];

        try {
            if ($fname == "") {

                throw new Exception("First Name cannot be Empty!!!!");
            }
            $userResult = $userObj->getUser($user_id);
            $edituser = $userResult->fetch_assoc();
            $prev_image = $edituser["user_image"];

            if (isset($_FILES["user_image"])) {
                if ($_FILES["user_image"]["name"] != "") {


                    // upload new image

                    $img = time() . "_" . $_FILES["user_image"]["name"];
                    $path = "../images/courier_images/";
                    move_uploaded_file($_FILES["user_image"]["tmp_name"], $path . "$img");

                    ///remove previous image
                    if (file_exists($path . $prev_image) && $prev_image != "") {
                        unlink($path . $prev_image);

                    }
                } else {
                    $img = $prev_image;
                }

            }


            //Update User
            $userObj->UpdateUser($fname, $lname, $email, $dob, $nic, $user_role, $district_id, $img, $user_id);
            //Update login
            $userObj->updateLogin($email, $nic, $user_id);

            //delete existing contacts
            $userObj->removeUserContacts($user_id);

            //add new contact
            $userObj->addUserContact($user_id, $cno1);
            $userObj->addUserContact($user_id, $cno2);


            //add location


            // delete existing functions
            $userObj->removeUserFunctions($user_id);

            // add new functions
            foreach ($user_functions as $fun_id) {
                $userObj->addUserFunctions($user_id, $fun_id);
            }

            $msg = "$fname $lname Successfully Updated!";
            $msg = base64_encode($msg);
            $user_id = base64_encode($user_id);
            ?>
            <script>
                window.location = "../view/view_user.php?user_id=<?php echo $user_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php


        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/edit_user.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        }

        break;

    case "upload_files":
        echo $sid = $_POST["sid"];
        $sfile = $_FILES["stufile"];
        break;

    case "load_users":

        $user_id = $_POST["user_id"];
        ?>

        <div class="row">
            <div class="col-md-6">
                <label>User ID</label>
            </div>
            <div class="col-md-6">
                <label>
                    <input type="text" value="<?php echo base64_decode($user_id); ?>" name="fname" class="form-control" />
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Select File</label>
            </div>
            <div class="col-md-6">
                <label>
                    <input type="file" name="fname" class="form-control" />
                </label>
            </div>
        </div>
        <?php

        break;

    // case "send email":

    //     require_once '../commons/PHPMailer-master/src/PHPMailer.php';
    //     $html = "backup";


    // break;




}