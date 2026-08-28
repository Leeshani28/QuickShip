<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$orderObj = new Order();

$order_location = $userrow["user_location"];

$orderCountResult = $orderObj->getPendingOrderCount($order_location);
$orderCountRow = $orderCountResult->fetch_assoc();

$ofdCountResult = $orderObj->getOutforDeliveryOrderCount($order_location);
$ofdCountRow = $ofdCountResult->fetch_assoc();

$deliveredCountResult = $orderObj->getDeliveredOrderCount($order_location);
$deliveredCountRow = $deliveredCountResult->fetch_assoc();

$canceledCountResult = $orderObj->getCanceledOrderCount($order_location);
$canceledCountRow = $canceledCountResult->fetch_assoc();

//for chart
$result = $orderObj->getOrdersByPackageTypeChart($order_location);

$packageType = array();
$totalOrders = array();

while($row = $result->fetch_assoc())
{
    $packageType[] = $row["pkg_type"];
    $totalOrders[] = $row["total_orders"];
}

$result = $orderObj->getOrdersByDestinationTownChart($order_location);

$district_name = array();
$totalOrders = array();

while($row = $result->fetch_assoc())
{
    $district_name[] = $row["district_name"];
    $totalOrders[] = $row["total_orders"];
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
                
                
                    <?php $pageName="ORDER MANAGEMENT" ?>
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
                                Order Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_order.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Order</button></a>
                    <a href="view_orders.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Orders</button></a>
                    <a href="generate_order_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Order Reports</button></a>
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
        <div class="panel-body"style="background: #ffffff;padding: 15px;padding-bottom: 5px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div class="col-md-3">
            <div class="panel panel-warning" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Pending Orders</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $orderCountRow["order_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Out for Delivery</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                         <?php echo $ofdCountRow["ofd_count"]; ?> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Delivered</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $deliveredCountRow["delivered_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Canceled</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $canceledCountRow["canceled_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        

        
        </div>
    </div>
</div>
</div>

            <div class="row">
                &nbsp

            </div>

<div class="row">
    <div class="col-md-6 text-center">
        <div id="packageChart"
             style="width:600px;height:400px;margin:0 auto;">
        </div>
    </div>
    
    <div class="col-md-6 text-center">

        <div id="destinationTownChart"
             style="width:850px;height:450px;margin:0 auto;">
        </div>

    </div>

</div>     
            
        </div>
     </body>



     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
     <script>
var data = [{

    x: <?php echo json_encode($packageType); ?>,

    y: <?php echo json_encode($totalOrders); ?>,

    type: 'bar',

    marker: {
        color: [
            '#90CAF9',
            '#A5D6A7',
            '#FFE082',
            '#FFCCBC',
            '#CE93D8',
            '#80CBC4',
            '#92cb80',
            '#9c80cb'
        ]
    },

    text: <?php echo json_encode($totalOrders); ?>,

    textposition: 'outside'

}];

var layout = {

    title: {
        text: 'Orders by Package Type',
        font: {
            size: 22
        }
    },

    xaxis: {
        title: {
            text: 'Package Type'
        }
    },

    yaxis: {
        title: {
            text: 'Number of Orders'
        }
    },

    width: 700,
    height: 500,

    margin: {
        l: 70,
        r: 20,
        b: 100,
        t: 80
    }
};

Plotly.newPlot('packageChart', data, layout);
</script>

<script>

var data = [{

    x: <?php echo json_encode($district_name); ?>,

    y: <?php echo json_encode($totalOrders); ?>,

    type: 'bar',

    text: <?php echo json_encode($totalOrders); ?>,

    textposition: 'outside',

    marker: {
        color: '#5DADE2'
    }

}];


var layout = {

    title: {
        text: 'Orders by Destination Town',
        font: {
            size: 22
        }
    },

    xaxis: {
        title: {
            text: 'Destination Town'
        }
    },

    yaxis: {
        title: {
            text: 'Number of Orders'
        }
    },

    width: 700,
    height: 500,

    margin: {
        l: 70,
        r: 20,
        b: 100,
        t: 80
    }
};

Plotly.newPlot(
    'destinationTownChart',
    data,
    layout
);

</script>
</html>