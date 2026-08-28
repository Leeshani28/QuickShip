<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/finance_model.php';

$userrow = $_SESSION["user"];
$user_location = $userrow["user_location"];
$orderObj = new Order();
$financeObj = new Finance();

$financeResult = $financeObj->getAllExpenses($user_location);


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
                            View Expenses
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
            <div class="col-md-5"></div>
            <div class="col-md-7">
                <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="minDate">From Date</label>
                                <input type="date" id="minDate" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label" for="maxDate">To Date</label>
                                <input type="date" id="maxDate" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <!-- Blank label keeps button aligned with input fields -->
                                <label class="control-label">&nbsp;</label>
                                <button type="button" class="btn btn-secondary btn-block" id="clearDate">
                                    Clear
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

        </div>



        <div class="row">
            &nbsp

        </div>

        <div class="row">
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
                        <table class="table table-info table-striped" id="financetable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="17%"> Expense Category</th>
                                    <th width="20%">Expense Amount(Rs.)</th>
                                    <th width="15%">Expense Date</th>
                                    <th width="13%">Description</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                while ($financerow = $financeResult->fetch_assoc()) {

                                

                                    $expense_id = $financerow["expense_id"];
                                    // $expense_id =base64_encode($expense_id);
                                

                                    if ($financerow["expense_status"] == "Pending") {
                                        $color = "bg-warning";

                                    } elseif ($financerow["expense_status"] == "Approved") {
                                        $color = "bg-success";

                                    } else {
                                        $color = "bg-danger";
                                    }
                                    

                                    ?>

                                    <tr>
                                        <td>
                                            <?php
                                            echo $financerow["expense_id"];

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $financerow["expense_category"];

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $financerow["expense_amount"];

                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $financerow["expense_date"];

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $financerow["expense_description"];

                                            ?>
                                        </td>
                                        <td class="<?php echo $color; ?>">
                                            <?php
                                            echo $financerow["expense_status"];

                                            ?>
                                        </td>
                                        <td>

                                            <?php
                                            if ($financerow["expense_status"] == "Pending") {


                                                ?>

                                                &nbsp;



                                                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-info"
                                                    onclick="approveExpences('<?php echo $expense_id; ?>');"><span
                                                        class="glyphicon glyphicon-ok"></span>&nbsp;Approve</a>

                                                &nbsp;


                                                <a href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-danger"
                                                    onclick="rejectexpenses('<?php echo $expense_id; ?>');">
                                                    <span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</a>
                                                <?php
                                            }



                                            ?>




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

    </div>
</body>

<!-- approve modal -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to Approve</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/finance_controller.php?status=confirm_expense" method="post">
                    <input type="hidden" name="expense_id" id="expense_id">

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">

                                &nbsp;
                                Approve
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to Reject</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/finance_controller.php?status=reject_expense" method="post">
                    <input type="hidden" name="expense_id" id="rejected_expense_id">

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">

                                &nbsp;
                                Reject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>






<script src="../js/datatable/jquery-3.5.1.js"></script>
<script src="../js/datatable/dataTables.bootstrap.min.js"></script>
<script src="../js/datatable/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/datatable/datatables.js"></script>

<script>//script
 $(document).ready(function () {

    // Custom filter
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {

        let min = $("#minDate").val();
        let max = $("#maxDate").val();

        // Date column (second column = index 1)
        let paymentDate = data[3].substring(0,10);

        if (paymentDate.includes("/")) {
            let parts = paymentDate.split("/");
            paymentDate = parts[2] + "-" + parts[1] + "-" + parts[0];
        }

        if (min === "" && max === "")
            return true;

        if (min === "" && paymentDate <= max)
            return true;

        if (max === "" && paymentDate >= min)
            return true;

        if (paymentDate >= min && paymentDate <= max)
            return true;

        return false;
    });

    let table = $("#financetable").DataTable({
        order: []   // Keep the order from the database
    });

    $("#minDate,#maxDate").change(function () {
        table.draw();
    });

    $("#clearDate").click(function () {
        $("#minDate").val("");
        $("#maxDate").val("");
        table.draw();
    });

});
</script>

<script>
    function approveExpences(expense_id) {

        document.getElementById("expense_id").value = expense_id;

    }

</script>

<script>
    function rejectexpenses(expense_id) {

        document.getElementById("rejected_expense_id").value = expense_id;

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