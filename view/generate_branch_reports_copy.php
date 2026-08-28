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
            
        <?php $pageName = "BRANCH MANAGEMENT"; ?>

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

            <button type="button" class="btn btn-primary" onclick="history.back()">
                ← Back
            </button>

            <li class="breadcrumb-item">
                <a href="dashboard_new.php">Dashboard</a>
            </li>

            <li class="breadcrumb-item">
                <a href="branch.php">Branch Management</a>
            </li>

            <li class="breadcrumb-item active">
                Generate Branch Reports
            </li>

        </ol>
    </nav>

</div>

<!-- Navigation Buttons -->
<div class="row">

    <div class="col-md-10">

        <a href="add_branch.php">
            <button type="button" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-plus"></span>
                Add Branch
            </button>
        </a>

        <a href="view_branches.php">
            <button type="button" class="btn btn-success btn-lg">
                <span class="glyphicon glyphicon-search"></span>
                View Branches
            </button>
        </a>

        <a href="generate_branch_reports.php">
            <button type="button" class="btn btn-warning btn-lg">
                <span class="glyphicon glyphicon-book"></span>
                Generate Reports
            </button>
        </a>

    </div>

</div>

<!-- Page Title -->
<h2 style="margin-top:20px;margin-bottom:25px;text-align:center;">
    <span class="glyphicon glyphicon-book"></span>
    Branch Reports
</h2>

<!-- General Reports -->
<div class="row">

    <div class="col-md-6">

        <button class="btn btn-block btn-lg"
            style="background:#81D4FA;color:#01579B;border-radius:8px;margin-bottom:15px;"
            onclick="window.open('branch_list_report.php','_blank')">

            <span class="glyphicon glyphicon-list-alt"></span>
            Branch List Report

        </button>

    </div>

    <div class="col-md-6">

        <button class="btn btn-block btn-lg"
            style="background:#A5D6A7;color:#1B5E20;border-radius:8px;margin-bottom:15px;"
            onclick="window.open('branch_status_list.php','_blank')">

            <span class="glyphicon glyphicon-ok-circle"></span>
            Branch Summary Report

        </button>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <button class="btn btn-block btn-lg"
            style="background:#FFE082;color:#5D4037;border-radius:8px;margin-bottom:15px;"
            onclick="window.open('branch_district_report.php','_blank')">

            <span class="glyphicon glyphicon-map-marker"></span>
            Branch Distribution by District Report

        </button>

    </div>

</div>

<!-- Reports with Filters -->
<div style="border:1px solid #90CAF9;
            border-radius:10px;
            padding:20px;
            margin-top:20px;">

    <h4 style="margin-top:0;color:#0D47A1;">

        <span class="glyphicon glyphicon-filter"></span>
        Reports with Filters

    </h4>

    <hr>

    <div class="row">

        <div class="col-md-6">

            <label>From Date</label>

            <input type="date"
                   class="form-control"
                   id="from_date">

        </div>

        <div class="col-md-6">

            <label>To Date</label>

            <input type="date"
                   class="form-control"
                   id="to_date">

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12">

            <label>Branch</label>

            <select class="form-control" id="branch_id">

                <option value="">All Branches</option>

                <?php
                while($row = $branch->fetch_assoc()){
                ?>

                <option value="<?php echo $row["branch_id"]; ?>">
                    <?php echo $row["branch_name"]; ?>
                </option>

                <?php
                }
                ?>

            </select>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-12">

            <button class="btn btn-block btn-lg"
                style="background:#C8E6C9;color:#1B5E20;border-radius:8px;margin-bottom:15px;"
                onclick="generateReport('branch_revenue_report.php')">

                <span class="glyphicon glyphicon-usd"></span>
                Branch Revenue Report

            </button>

        </div>

    </div>

</div>

<div class="row">
    &nbsp;
</div>

</div>
    </div>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

    <script>

function generateReport(report) {

    var from = document.getElementById("from_date").value;
    var to = document.getElementById("to_date").value;
    var branch = document.getElementById("branch_id").value;


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
        "&branch_id=" + encodeURIComponent(branch),
        "_blank"
    );

}

</script>

</body>

</html>