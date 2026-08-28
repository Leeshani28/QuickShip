<?php

include_once '../commons/session.php';
include_once '../model/user_model.php';
include '../model/delivery_model.php';
include '../model/branch_model.php';

//get user information from session
$userrow = $_SESSION["user"];

$userObj = new User();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$roleResult = $userObj->getAllRoles();
$branches = $branchObj->getAllBranches();

?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>


</head>

<body>
    <div class="container">
        <div class="row">
            <?php $pageName = "USER MANAGEMENT" ?>
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
                            <a href="user.php">User Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add User
                        </li>
                    </ol>
                </nav>

                <div class="col-md-10">
                    <a href="add_user.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-plus"></span> Add User</button></a>
                    <a href="view_users.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Users</button></a>
                    <a href="users_report.php"><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate User Reports</button></a>
                </div>


            </div>
            <div class="row">
                &nbsp
            </div>

            <div class="container">

                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body"
                                style="background-image: url('../images/mb.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

                                <form class="form-horizontal" action="../controller/user_controller.php?status=add_user"
                                    method="post" enctype="multipart/form-data" id="userform">
                                    <div class="col-md-12">

                                        <!-- erorr start -->
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
                                        <!-- erorr end -->


                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">First
                                                    Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="fname" id="fname" />
                                            </div>

                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Last Name</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="lname" id="lname" />
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
                                                <input type="email" class="form-control" name="email" id="email" />
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
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="nic" id="nic" />
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Date of Birth</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" class="form-control" name="dob" id="dob">
                                                
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
                                                <input type="number" class="form-control" name="cno1" id="cno1" />
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Fixed Number</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" class="form-control" name="cno2" id="cno2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">User Role</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="user_role" id="user_role" class="form-control"
                                                    required="required">
                                                    <option value="">--------</option>
                                                    <?php
                                                    while ($roleRow = $roleResult->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $roleRow["role_id"]; ?>">
                                                            <?php echo $roleRow["role_name"]; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label ">Profile Picture</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" class="form-control" name="user_image"
                                                    id="user_image" onchange="displayImage(this);" />
                                                <br />
                                                <img id="img_prev" style="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>

                                        <div class="col-md-2 text-right">
                                            <label class="control-label">User Location</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <select name="user_location" id="user_location"
                                                    class="form-control custom-dropdown">
                                                    <option value="" selected>Select Branch</option>
                                                    <?php
                                                    while ($branchrow = $branches->fetch_assoc()) { ?>
                                                        <option value="<?php echo $branchrow["branch_id"]; ?>">
                                                            <?php echo $branchrow["branch_name"]; ?>
                                                        </option>
                                                    <?php } ?>


                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12"> &nbsp; </div>
                                        </div>
                                        <div class="row">
                                            <div id="display_functions">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">&nbsp;</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <input type="reset" class="btn btn-danger btn-lg"
                                                            value="Reset" />
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <input type="submit" class="btn btn-success btn-lg"
                                                            value="Submit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </div>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/uservalidation.js"></script>
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

</body>

</html>