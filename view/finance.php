<?php

include_once '../commons/session.php';

include_once '../model/finance_model.php';

$userrow = $_SESSION["user"];
$branch_id = $userrow["user_location"];
$financeObj = new Finance();

// Monthly Income
$incomeResult = $financeObj->getMonthlyIncome($branch_id);
$incomeRow = $incomeResult->fetch_assoc();
$totalIncome = $incomeRow["total_income"];

// Monthly Expense
$expenseResult = $financeObj->getMonthlyExpenses($branch_id);
$expenseRow = $expenseResult->fetch_assoc();
$totalExpense = $expenseRow["total_expense"];

// Profit
$totalProfit = $totalIncome - $totalExpense;


//charts
$result = $financeObj->getMonthlyExpenseCategoryReport($userrow["user_location"]);

$category = array();
$total = array();

while($row = $result->fetch_assoc())
{
    $category[] = $row["expense_category"];
    $total[] = $row["total_amount"];
}


$result = $financeObj->getLastFiveMonthIncome($userrow["user_location"]);

$month = array();
$income = array();

while($row = $result->fetch_assoc())
{
    $month[] = $row["month_name"];
    $income[] = $row["total_income"];
}


?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
    <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>

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
                        <li class="breadcrumb-item active" aria-current="page">
                            Finance Management
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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body"
                        style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <div class="col-md-4">
                            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                                <div class="panel-heading">
                                    <h4 class="text-center">Total Monthly Income</h4>
                                </div>
                                <div class="panel-body">
                                    <h1 class="text-center">
                                        Rs. <?php echo number_format($totalIncome, 2); ?>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                                <div class="panel-heading">
                                    <h4 class="text-center">Total Monthly Expenses</h4>
                                </div>
                                <div class="panel-body">
                                    <h1 class="text-center">
                                        Rs. <?php echo number_format($totalExpense, 2); ?>
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                                <div class="panel-heading">
                                    <h4 class="text-center">Total Monthly Profit</h4>
                                </div>
                                <div class="panel-body">
                                    <h1 class="text-center">
                                        Rs. <?php echo number_format($totalProfit, 2); ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="expenseCategoryChart" style="width:100%;height:500px;"></div>
            </div>
            <div class="col-md-6">
                <div id="incomeTrendChart" style="width:100%; height:500px;"></div>
            </div>
            
        </div>

    </div>

    

</body>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    

<script>

var data = [{
    labels: <?php echo json_encode($category); ?>,
    values: <?php echo json_encode($total); ?>,
    type: 'pie',
    textinfo: 'label+percent',
    hovertemplate:
        '<b>%{label}</b><br>' +
        'Amount: Rs. %{value:,.2f}<br>' +
        'Percentage: %{percent}<extra></extra>'
}];

var layout = {
    title: {
        text: 'Monthly Expense by Category',
        font: {
            size: 22
        }
    },
    showlegend: true,
    legend: {
        orientation: "v",
        x: 1,
        y: 0.5
    },
    margin: {
        t: 60,
        l: 20,
        r: 20,
        b: 20
    }
};

Plotly.newPlot('expenseCategoryChart', data, layout, {responsive:true});

</script>

<script>

var data = [{

    x: <?php echo json_encode($month); ?>,
    y: <?php echo json_encode($income); ?>,

    type: 'scatter',
    mode: 'lines+markers',

    line: {
        color: '#4CAF50',
        width: 3
    },

    marker: {
        size: 8,
        color: '#2E7D32'
    }

}];

var layout = {

    title: {
        text: 'Last Five Months Income',
        font: {
            size: 22
        }
    },

    xaxis: {
        title: 'Month'
    },

    yaxis: {
        title: 'Income (Rs.)'
    },

    hovermode: 'x unified'

};

Plotly.newPlot('incomeTrendChart', data, layout, {responsive:true});

</script>

</html>