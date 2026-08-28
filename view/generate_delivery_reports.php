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

<?php include_once "../includes/bootstrap_css_includes.php"; ?>

</head>

<body>

<div class="container">

<div class="row">

<?php $pageName="DELIVERY MANAGEMENT"; ?>

<?php
if($userrow["user_role"]==1){
    include_once "../includes/header_row_includes_admin.php";
}else{
    include_once "../includes/header_row_includes2.php";
}
?>

<div class="row">

<nav aria-label="breadcrumb">

<ol class="breadcrumb">

<button type="button" class="btn btn-primary" onclick="history.back()">← Back</button>

<li class="breadcrumb-item">
<a href="dashboard_new.php">Dashboard</a>
</li>

<li class="breadcrumb-item">
<a href="delivery.php">Delivery Management</a>
</li>

<li class="breadcrumb-item active">
Generate Delivery Reports
</li>

</ol>

</nav>

</div>

<div class="col-md-10">

<a href="add_delivery.php">
<button class="btn btn-info btn-lg">
<span class="glyphicon glyphicon-plus"></span>
Add Delivery
</button>
</a>

<a href="view_delivery.php">
<button class="btn btn-success btn-lg">
<span class="glyphicon glyphicon-search"></span>
View Deliveries
</button>
</a>

<a href="generate_delivery_reports.php">
<button class="btn btn-warning btn-lg">
<span class="glyphicon glyphicon-book"></span>
Generate Delivery Reports
</button>
</a>

</div>

</div>

<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>

<div class="container">

<h2 style="margin-top:20px;margin-bottom:25px;text-align:center;">
<span class="glyphicon glyphicon-list-alt"></span>
Delivery Management Reports
</h2>

<!-- SUMMARY REPORTS -->

<div class="row">

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#BBDEFB;
border-color:#90CAF9;
color:#0D47A1;
border-radius:8px;
margin-bottom:15px;"

onclick="window.open('delivery_summary_report.php','_blank')">

<span class="glyphicon glyphicon-stats"></span>

Delivery Status Summary

</button>

</div>

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#BBDEFB;
border-color:#90CAF9;
color:#0D47A1;
border-radius:8px;
margin-bottom:15px;"

onclick="window.open('delivery_route_report.php','_blank')">

<span class="glyphicon glyphicon-random"></span>

Delivery Route Report

</button>

</div>

</div>

<!-- DATE RANGE -->

<div style="border:1px solid #347d52d9;
border-radius:10px;
padding:20px;
margin-top:20px;">

<h4 style="margin-top:0;color:#134227d9;">

<span class="glyphicon glyphicon-calendar"></span>

Reports by Date Range

</h4>

<hr>

<div class="row">

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

</div>

<br>

<div class="row">

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#C8E6C9;
border-color:#A5D6A7;
color:#1B5E20;
border-radius:8px;
margin-bottom:15px;"

onclick="generateReport('daily_delivery_report.php')">

<span class="glyphicon glyphicon-road"></span>

Daily Delivery Report

</button>

</div>

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#C8E6C9;
border-color:#A5D6A7;
color:#1B5E20;
border-radius:8px;
margin-bottom:15px;"

onclick="generateReport('monthly_delivery_report.php')">

<span class="glyphicon glyphicon-calendar"></span>

Monthly Delivery Report

</button>

</div>

</div>

<div class="row">

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#FFE0B2;
border-color:#FFCC80;
color:#E65100;
border-radius:8px;
margin-bottom:15px;"

onclick="generateReport('completed_deliveries_report.php')">

<span class="glyphicon glyphicon-ok-circle"></span>

Completed Delivery Report

</button>

</div>

<div class="col-md-6">

<button class="btn btn-block btn-lg"

style="background:#FFCDD2;
border-color:#EF9A9A;
color:#B71C1C;
border-radius:8px;
margin-bottom:15px;"

onclick="generateReport('rejected_delivery_report.php')">

<span class="glyphicon glyphicon-remove-circle"></span>

Rejected Delivery Report

</button>

</div>

</div>

</div>

</div>

</div>
            <div class="row">
                &nbsp

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