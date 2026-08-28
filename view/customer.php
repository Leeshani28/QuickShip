<?php

include_once '../commons/session.php';
include_once '../model/customer_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$customerObj = new Customer();

$customerResult = $customerObj->getAllcustomerCount();
$customer_row = $customerResult->fetch_assoc();

$customerNames = [];
$totalOrders = [];
$pieChartResult = $customerObj->getTopFiveCustomers();
while($pieCharthartRow = $pieChartResult->fetch_assoc()){
    $customerNames[] = $pieCharthartRow["customer_name"];
    $totalOrders[] = $pieCharthartRow["total_orders"];
}


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <script src="../js/plotly-3.0.1.min.js" charset="utf-8"></script>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="CUSTOMER MANAGEMENT" ?>
                   <?php 
            if($userrow["user_role"]==1){
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
                                Customer Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_customer.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Customer</button></a>
                    <a href="view_customers.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Customers</button></a>
                    <!-- <a href="generate_customer_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Customer Reports</button></a> -->
                    </div>                
                   
            </div>

            <div class="row">
                &nbsp

            </div>
            <div class="row">
                &nbsp

            </div>

            <div class="row">
            <div class="col-md-5">
            <div class="panel panel-default">
        <div class="panel-body"style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div class="col-md-12">
            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Total Customers</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $customer_row["customer_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>
    
        </div>
    </div>
</div>
<div class="col-md-7 text-center">

    <div id="topCustomerChart"
         style="width:600px;height:450px;margin:0 auto;">
    </div>

</div>

</div>
<!-- <div class="row">
    <div class="col-md-6 text-center">

    <div id="topCustomerChart"
         style="width:500px;height:450px;margin:0 auto;">
    </div>

</div>
</div> -->
                
        </div>
     </body>

     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script>

var data = [{

    x: <?php echo json_encode($customerNames); ?>,
    y: <?php echo json_encode($totalOrders); ?>,
    type: 'bar',
    marker: {
        color: [
            '#42A5F5',
            '#66BB6A',
            '#FFA726',
            '#AB47BC',
            '#EF5350'
        ]
    },

    text: <?php echo json_encode($totalOrders); ?>,
    textposition: 'outside'

}];


var layout = {
    title: {
        text: 'Top 5 Customers by Number of Orders',
        font: {
            size: 22
        }

    },

    xaxis: {
        title: {
            text: 'Customer Name'
        }
    },

    yaxis: {
        title: {
            text: 'Number of Orders'
        }

    },
    width: 500,
    height: 500,
    margin: {
        l: 70,
        r: 20,
        t: 80,
        b: 120
    }
};

Plotly.newPlot('topCustomerChart', data, layout);

</script>
</html>