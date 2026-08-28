<?php

include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/package_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$packageObj = new Package();

$order_location = $userrow["user_location"];

$pendingPackageCountResult = $packageObj->getpendingPackageCount($order_location);
$pendingPackageCountRow = $pendingPackageCountResult->fetch_assoc();

$deliveredPackageCountResult = $packageObj->getDeliveredPackageCount($order_location);
$deliveredPackageCountRow = $deliveredPackageCountResult->fetch_assoc();

$cancelledPackageCountResult = $packageObj->getCancelledPackageCount($order_location);
$cancelledPackageCountRow = $cancelledPackageCountResult->fetch_assoc();


$weightRange = array();
$totalPackages = array();

$result = $packageObj->getPackageWeightDistributionChart();

while($row = $result->fetch_assoc())
{
    $weightRange[] = $row["weight_range"];
    $totalPackages[] = $row["total_packages"];
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
                
                
                    <?php $pageName="PACKAGE MANAGEMENT" ?>
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
                                Package Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="view_packages.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Packages</button></a>
                    <a href="generate_package_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Package Reports</button></a>
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
            <div class="panel panel-warning" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Pending Packages</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $pendingPackageCountRow["pending_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-success" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Delivered</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $deliveredPackageCountRow["delivered_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Canceled</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $cancelledPackageCountRow["cancelled_count"]; ?>
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

<div class="col-md-6 text-center">

    <div id="packageWeightChart"
         style="width:500px;height:450px;margin:0 auto;">
    </div>

</div>
            
            
        </div>

     </body>

     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script>

var data = [{

    x: <?php echo json_encode($weightRange); ?>,
    y: <?php echo json_encode($totalPackages); ?>,
    type: 'bar',
    marker: {
        color: [
            '#42A5F5',
            '#66BB6A',
            '#FFA726',
            '#AB47BC'
        ]
    },

    text: <?php echo json_encode($totalPackages); ?>,
    textposition: 'outside'

}];

var layout = {
    title: {
        text: 'Package Weight Distribution',
        font: {
            size: 22
        }
    },
    xaxis: {
        title: {
            text: 'Weight Range (kg)'
        }
    },

    yaxis: {
        title: {
            text: 'Number of Packages'
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

Plotly.newPlot('packageWeightChart', data, layout);

</script>
</html>