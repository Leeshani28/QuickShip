<?php

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/user_model.php';

//get user information from session
$userrow = $_SESSION["user"];

$moduleObj = new Module();

$userObj = new User();

$moduleResult = $moduleObj->getAllModules();

if ($userrow["user_role"] == 1) {
    $userResult = $userObj->getAllUsers();
} else {
    $userResult = $userObj->getBranchUsers($userrow["user_location"]);
}


?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php $pageName = "USER MANAGEMENT" ?>
        <?php
        if ($userrow["user_role"] == 1) {
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
                        <a href="user.php">User Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View Users
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

        <div class="col-md-12">
            <?php
            if (isset($_GET["msg"])) {
                $msg = base64_decode($_GET["msg"]);



                ?>
                <div class="row" id="msg">
                    <div class="alert alert-success">
                        <?php echo $msg ?>

                    </div>

                </div>

            <?php
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-info table-striped" id="usertable">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



                            while ($userrow = $userResult->fetch_assoc()) {



                                $user_id = $userrow["user_id"];
                                $user_id = base64_encode($user_id);

                                $img_path = "../images/courier_images/";

                                if ($userrow["user_image"] == "") {

                                    $img_path = "../images/courier_images/default_user.jpg";
                                } else {
                                    $img_path = "../images/courier_images/" . $userrow["user_image"];
                                }


                                $status = "Active";
                                if ($userrow["user_status"] == 0) {
                                    $status = "De-Active";


                                }



                                ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $img_path ?>" width="60px" height="60px"
                                            style="border-radius:50%; object-fit:cover;" />
                                    </td>
                                    <td>
                                        <?php
                                        echo $userrow["user_fname"] . " " . $userrow["user_lname"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $userrow["user_email"];

                                        ?>
                                    </td>
                                    <td <?php
                                    if ($userrow["user_status"] == 1) {

                                        ?> class="success" <?php
                                    } else if ($userrow["user_status"] == 0) {
                                        ?> class="danger" <?php
                                    }
                                    ?>>
                                        <?php
                                        echo $status;

                                        ?>
                                    </td>
                                    <td>
                                        <a href="view_user.php?user_id=<?php echo $user_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;

                                        <a href="edit_user.php?user_id=<?php echo $user_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>
                                        &nbsp;
                                        <?php
                                        if ($userrow["user_status"] == 0) {


                                            ?>

                                            <a href="../controller/user_controller.php?status=activate&user_id=<?php echo $user_id; ?>"
                                                class="btn btn-success">
                                                <span class="glyphicon glyphicon-ok"></span>
                                                &nbsp;
                                                Activate
                                            </a>
                                        <?php
                                        }


                                        ?>
                                        &nbsp;
                                        <?php
                                        if ($userrow["user_status"] == 1) {


                                            ?>

                                            <a href="../controller/user_controller.php?status=deactivate&user_id=<?php echo $user_id; ?>"
                                                class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>
                                                &nbsp;
                                                De-Activate
                                            </a>
                                        <?php
                                        }



                                        ?>
                                        &nbsp;


                                        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger"
                                            onclick="deleteuser('<?php echo $user_id; ?>');">
                                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

    



                                    </td>
                                </tr>
                            <?php
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</body>

<script>
    function deleteuser(user_id) {

        document.getElementById("user_id").value = user_id;

    }

</script>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Delete Confirmation</h4>
            </div>

             <form action="../controller/user_controller.php?status=delete_user" method="POST">
            <div class="modal-body">
                <p>Are you sure, you want to delete?</p>


                <div class="row">
                   
                        <input type="hidden" name="user_id" id="user_id">
                   
                </div>




            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
               <button class="btn btn-danger" type="submit">Delete</button>
            </div>

             </form>


        </div>

    </div>
</div>




<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/datatable/datatables.js"></script>



<script>
    $(document).ready(function () {
        $("#usertable").DataTable();






    });

    function loaduser(user_id) {
        // alert(user_id);

        var role_id = $("#user_role").val();
        var url = "../controller/user_controller.php?status=load_users";

        $.post(url, { user_id: user_id }, function (data) {
            $("#display_data").html(data).show();
        });




    }
</script>


<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>

</html>