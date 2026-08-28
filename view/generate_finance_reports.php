<?php

include_once '../commons/session.php';

include_once '../model/delivery_model.php';
include_once '../model/branch_model.php';

$userrow = $_SESSION["user"];
$deliveryObj = new Delivery();
$branchObj = new Branch();
// $districtResult = $deliveryObj->getAllDistrict();
$branch = $branchObj->getAllBranches();
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

                        <li class="breadcrumb-item active">
                            <a href="finance.php">Finance Management</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Generate Finance Reports
                        </li>
                    </ol>
                </nav>

            </div>

            <div class="row">
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
            <!-- Title -->
            <h2 style="margin-top:20px;margin-bottom:25px;text-align:center;">
                <span class="glyphicon glyphicon-usd"></span>
                Finance Reports
            </h2>

            <!-- Simple Reports -->
            <div class="row">

                <div class="col-md-6">
                    <button class="btn btn-block btn-lg"
                        style="background:#FFE082;color:#5D4037;border-radius:8px;margin-bottom:15px;"
                        onclick="window.open('pending_cod_report.php','_blank')">

                        <span class="glyphicon glyphicon-time"></span>
                        Pending Payments Report

                    </button>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-block btn-lg"
                        style="background:#A5D6A7;color:#1B5E20;border-radius:8px;margin-bottom:15px;"
                        onclick="window.open('monthly_profit_report.php','_blank')">

                        <span class="glyphicon glyphicon-stats"></span>
                        Monthly Profit Report

                    </button>
                </div>

            </div>

            <!-- Date Range Section -->
            <div style="border:1px solid #90CAF9;
                    border-radius:10px;
                    padding:20px;
                    margin-top:20px;">

                <h4 style="margin-top:0;color:#0D47A1;">
                    <span class="glyphicon glyphicon-calendar"></span>
                    Reports by Date Range
                </h4>

                <hr>

                <div class="row">

                    <div class="col-md-4">
                        <label>From Date</label>
                        <input type="date" class="form-control" id="from_date">
                    </div>

                    <div class="col-md-4">
                        <label>To Date</label>
                        <input type="date" class="form-control" id="to_date">
                    </div>

                    <script>
                        var today = new Date().toISOString().split('T')[0];

                        document.getElementById("from_date").max = today;
                        document.getElementById("to_date").max = today;
                    </script>

                    <div class="col-md-4">
                        <label>Branch</label>

                        <select class="form-control" id="district_id_report">

                            <option value="">All Branches</option>


                            <?php
                            // mysqli_data_seek($districtResult, 0);
                            while ($row = $branch->fetch_assoc()) { ?>
                                <option value="<?php echo $row['branch_id']; ?>">
                                    <?php echo $row['branch_name']; ?>
                                </option>
                            <?php } ?>

                        </select>

                    </div>

                </div>

                <br>

                <div class="row">

                    <div class="col-md-6">
                        <button class="btn btn-block btn-lg"
                            style="background:#BBDEFB;color:#0D47A1;border-radius:8px;margin-bottom:15px;"
                            onclick="generateReport('income_report.php')">

                            <span class="glyphicon glyphicon-arrow-up"></span>
                            Income Report

                        </button>
                    </div>

                    <div class="col-md-6">
                        <button class="btn btn-block btn-lg"
                            style="background:#FFCDD2;color:#B71C1C;border-radius:8px;margin-bottom:15px;"
                            onclick="generateReport('expense_report.php')">

                            <span class="glyphicon glyphicon-arrow-down"></span>
                            Expense Report

                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

    <script>
        function generateReport(report) {
            var from = document.getElementById("from_date").value;
            var to = document.getElementById("to_date").value;
            var branch = document.getElementById("district_id_report").value;


            if (from == "") {
                alert("Please select From Date.");
                return;
            }

            if (to == "") {
                alert("Please select To Date.");
                return;
            }

            if (from > to) {
                alert("From Date cannot be greater than To Date.");
                return;
            }

            window.open(
                report +
                "?from_date=" + encodeURIComponent(from) +
                "&to_date=" + encodeURIComponent(to) +
                "&district_id=" + encodeURIComponent(branch),
                "_blank"
            );
        }
    </script>

</body>

</html>