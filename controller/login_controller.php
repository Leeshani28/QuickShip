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

include '../model/login_model.php';
$loginObj = new Login();

switch ($status) {
    case "login";
        $login_username = $_POST["loginusername"];
        $login_password = $_POST["loginpassword"];

        try {
            if ($login_username == "") {
                throw new Exception("User Name Cannot Be Empty");
            }
            if ($login_password == "") {
                throw new Exception("Password Cannot Be Empty");
            }
            //calls validateUser() function
            $loginResult = $loginObj->validateUser($login_username, $login_password);

            //if matching records are found
            if ($loginResult->num_rows > 0) {

                //converting $loginResult to an array
                $userrow = $loginResult->fetch_assoc();

                if ($userrow["user_status"] == 0 && $userrow["user_status"] == -1 ) {
                    throw new Exception("Your account has been deactivated. Please contact the administrator.");
                }



                $branch = $userrow["user_location"];
                $branchStatusResult = $loginObj-> checkBranchStatus($branch);
                $branchrow = $branchStatusResult->fetch_assoc();

                if ($branchrow["branch_status"] == "De-active") {
                    throw new Exception("Your branch has been deactivated. Please contact the administrator.");
                }

                $_SESSION["user"] = $userrow;

                //redirect to dashboard
                ?>

                <script>
                    window.location = "../view/dashboard_new.php";
                </script>
                <?php

            } else {
                throw new Exception("Invalid Credentials");
            }

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/login.php?msg=<?php echo $msg ?>";
            </script>
            <?php
        }

        break;



    case "driver_login";
        $login_username = $_POST["loginusername"];
        $login_password = $_POST["loginpassword"];

        try {
            if ($login_username == "") {
                throw new Exception("User Name Cannot Be Empty");
            }
            if ($login_password == "") {
                throw new Exception("Password Cannot Be Empty");
            }

            $driverloginResult = $loginObj->validateDriver($login_username, $login_password);

            //if matching records are found
            if ($driverloginResult->num_rows > 0) {

                //converting $loginResult to an array
                $driverrow = $driverloginResult->fetch_assoc();

                $_SESSION["driver"] = $driverrow;

                ?>
                <script>
                    window.location = "../view/driver_dashboard.php";
                </script>
                <?php

            } else {
                throw new Exception("Invalid Credentials");
            }

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/login_driver.php?msg=<?php echo $msg ?>";
            </script>
            <?php
        }

        break;

    case "logout";
        session_destroy();
        ?>
        <script>
            window.location = "../view/login.php";
        </script>
        <?php
        break;

    case "switch_login":

        $user_id = $_POST["user_id"];
        $district_id = $_POST["district_id"];

        try {

            $loginObj->switchBranch($district_id, $user_id);

            // Get updated user details
            $result = $loginObj->getUserById($user_id);
            $userrow = $result->fetch_assoc();


            // Refresh session
            $_SESSION["user"] = $userrow;

            ?>
            <script>
                window.location = document.referrer;
            </script>
            <?php

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
            <script>
                 window.location = document.referrer;
            </script>
            <?php
        }


        break;
}