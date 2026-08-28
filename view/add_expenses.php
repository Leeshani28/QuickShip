<?php

include_once '../commons/session.php';

include_once '../model/finance_model.php';

$userrow = $_SESSION["user"];
$financeObj = new Finance();

?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>


</head>

<body>
    <div class="container">
        <div class="row">


            <?php $pageName = "FINANCE MANAGEMENT" ?>
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
                        <li class="breadcrumb-item">
                            <a href="finance.php">Finance Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Expenses
                        </li>
                    </ol>
                </nav>


            </div>

            <div class="col-md-10">
                    <a href="add_expenses.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-usd"></span> Add Expenses</button></a>
                    <a href="view_expenses.php"><button type="button" class="btn btn-danger btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Expenses</button></a>
                    <a href="view_incomings.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Incomings</button></a>
                    <a href="generate_finance_reports.php"><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate Reports</button></a>
                </div>

        </div>

        <div class="row">
            &nbsp

        </div>
        <div class="row">
            &nbsp

        </div>

        <div class="row">

            <div class="row">
                <div class="col-md-11">
                    <div class="panel panel-info" style="height:480px;border-radius: 10px;border: 1px solid #82bcf2d6;">
                        <div class="panel-heading"
                            style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                            <i class="bi bi-cash-stack" style="font-size: 25px; margin-right: 5px;color:blue;"></i><b>
                                <h4 class="text-left"><b>Add Expenses</b></h4>
                            </b>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal"
                                action="../controller/finance_controller.php?status=add_finance" method="post">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3" id="msg">

                                        </div>
                                        <?php
                                        if (isset($_GET["msg"])) {
                                            ?>
                                            <div class="col-md-6 col-md-offset-3 alert alert-success">
                                                <?php echo base64_decode($_GET["msg"]); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label" style="text-align: right;">Category</label>
                                        </div>
                                        <div class="col-md-8 dropdown">
                                            <div class="form-group">

                                                <select name="expense_category" id="expense_category"
                                                    class="form-control custom-dropdown">
                                                    <option selected disabled>Select Category</option>
                                                    <option value="Fuel">Fuel</option>
                                                    <option value="Salary">Salary</option>
                                                    <option value="Vehicle Maintenace">Maintenace</option>
                                                    <option value="Office Bills">Bills</option>
                                                    <option value="Transport">Transport</option>
                                                    <option value="refund">refund</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label" style="text-align: right;">Expense Amount
                                                (Rs.)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" name="expense_amount"
                                                id="expense_amount" />
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Expense Date</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" name="expense_date"
                                                id="expense_date" />
                                            <script>
                                                document.getElementById("expense_date").min = new Date().toISOString().split("T")[0];
                                            </script>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <label class="control-label">Description</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="expense_description" id="expense_description"
                                                class="form-control" required></textarea>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="row">

                                    </div>



                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
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

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../js/expensevalidation.js"></script>
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