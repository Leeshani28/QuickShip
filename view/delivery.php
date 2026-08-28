<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/delivery_model.php';

$userrow=$_SESSION["user"];
$deliveryObj = new Delivery();

$delivery_location = $userrow["user_location"];
$start_location = $userrow["user_location"];
$user_location = $userrow["user_location"];

$pendingDeliveryCountResult = $deliveryObj->getPendingDeliveries($delivery_location);
$pendingDeliveryCountRow = $pendingDeliveryCountResult->fetch_assoc();

$approvedDeliveryCountResult = $deliveryObj->getApprovedDeliveries($delivery_location);
$approvedDeliveryCountRow = $approvedDeliveryCountResult->fetch_assoc();

$rejectedDeliveryCountResult = $deliveryObj->getRejectedDeliveries($delivery_location);
$rejectedDeliveryCountRow = $rejectedDeliveryCountResult->fetch_assoc();

$status = array();
$totalSummary = array();

$pieChartResult = $deliveryObj->getDeliveryStatusSummaryChart($start_location);

while($pieCharthartRow = $pieChartResult->fetch_assoc())
{
    $status[] = $pieCharthartRow["delivery_status"];
    $totalSummary[] = $pieCharthartRow["total_deliveries"];
}

$month = array();
$totalDeliveries = array();

$chartResult = $deliveryObj->getMonthlyDeliveriesChart($user_location);

while($chartRow = $chartResult->fetch_assoc())
{
    $month[] = $chartRow["month_name"];
    $totalDeliveries[] = $chartRow["total_deliveries"];
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
                
                
                    <?php $pageName="DELIVERY MANAGEMENT" ?>
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
                                Delivery Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_delivery.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Delivery</button></a>
                    <a href="view_delivery.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Deliveries</button></a>
                    <a href="generate_delivery_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Delivery Reports</button></a>
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
        <div class="col-md-4">
            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">New Deliveries</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $pendingDeliveryCountRow["pending_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Approved Deliveries</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                         <?php echo $approvedDeliveryCountRow["approved_count"]; ?> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Rejected Deliveries</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $rejectedDeliveryCountRow["rejected_count"]; ?>
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

                    <div id="deliveryStatusChart"
                        style="width:500px;height:450px;margin:0 auto;">
                    </div>

                </div>
                <div class="col-md-6 text-center">

                    <div id="monthlyDeliveryChart"
                        style="width:600px;height:400px;margin:0 auto;">

                    </div>

                </div>
            </div>
               
        </div>
     </body>

     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

    <script>
var data = [{
    labels: <?php echo json_encode($status); ?>,
    values: <?php echo json_encode($totalSummary); ?>,

    type: 'pie',
    textinfo: 'label+percent',
    textposition: 'inside',
    hoverinfo: 'label+value+percent',

    marker: {
        colors: [
            '#42A5F5',   // Pending
            '#66BB6A',   // In Progress
            '#FFA726',   // Completed
            '#EF5350',   // Rejected
            '#AB47BC',   // Cancelled
            '#26A69A',   // Returned
            '#8D6E63',
            '#78909C'
        ]
    }
}];

var layout = {
    title: {
        text: 'Delivery Status Summary',
        font: {
            size: 22
        }
    },
    width: 500,
    height: 500,
    showlegend: true,

    legend: {
        orientation: "v",
        x: 1.02,
        y: 0.9
    },

    margin: {
        l: 40,
        r: 120,
        t: 80,
        b: 40
    }

};

Plotly.newPlot('deliveryStatusChart', data, layout);

</script>

<script>

var data = [{
    x: <?php echo json_encode($month); ?>,
    y: <?php echo json_encode($totalDeliveries); ?>,
    type: 'bar',
    marker: {
        color: [
            '#90CAF9',
            '#A5D6A7',
            '#FFE082'
        ]
    },
    text: <?php echo json_encode($totalDeliveries); ?>,
    textposition: 'outside'

}];


var layout = {
    title: {
        text: 'Monthly Deliveries (Last Three Months)',
        font: {
            size: 22
        }

    },

    xaxis: {
        title: {
            text: 'Month'
        }
    },
    yaxis: {
        title: {
            text: 'Number of Deliveries'
        }

    },

    width: 700,
    height: 500,
    margin: {
        l: 70,
        r: 20,
        b: 80,
        t: 80

    }
};

Plotly.newPlot('monthlyDeliveryChart', data, layout);

</script>
</html>