<?php

include_once '../commons/session.php';
include_once '../model/driver_model.php';

$userrow=$_SESSION["user"];
$driverObj = new Driver();

$driver_district = $userrow["user_location"];
$driver_location = $userrow["user_location"];

$totalDriverCountResult = $driverObj->getTotalDrivers($driver_district);
$totalDriverCountRow = $totalDriverCountResult->fetch_assoc();

$availableDriverCountResult = $driverObj->getAvailableDrivers($driver_district);
$availableDriverCountRow = $availableDriverCountResult->fetch_assoc();

$unavailableDriverCountResult = $driverObj->getUnavailableDrivers($driver_district);
$unavailableDriverCountRow = $unavailableDriverCountResult->fetch_assoc();

$status = array();
$totalDrivers = array();

$pieChartResult = $driverObj->getDriverStatusSummaryChart($driver_location);

while($pieCharthartRow = $pieChartResult->fetch_assoc())
{
    $status[] = $pieCharthartRow["driver_status"];
    $totalDrivers[] = $pieCharthartRow["total_drivers_chart"];
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
                
            <?php $pageName="DRIVER MANAGEMENT" ?>
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
                                Driver Management
                            </li>
                        </ol>
                    </nav>
                   </div>

                    <div class="col-md-10">
                    <a href="add_driver.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Driver</button></a>
                    <a href="view_drivers.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Drivers</button></a>
                    <a href="generate_driver_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Driver Reports</button></a>
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
                    <h4 class="text-center">Total Drivers</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $totalDriverCountRow["total_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Available Drivers</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                         <?php echo $availableDriverCountRow["available_count"]; ?> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Unavailable Drivers</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $unavailableDriverCountRow["unavailable_count"]; ?>
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
                <div class="col-md-12 text-center">

                    <div id="driverStatusChart"
                        style="width:500px;height:450px;margin:0 auto;">
                    </div>

                </div>
                <!-- <div class="col-md-6 text-center">

                    <div id="monthlyDeliveryChart"
                        style="width:600px;height:400px;margin:0 auto;">

                    </div>

                </div> -->
            </div>
               
        </div>

     </body>

     <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

    <script>
var data = [{
    labels: <?php echo json_encode($status); ?>,
    values: <?php echo json_encode($totalDrivers); ?>,

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
            
        ]
    }
}];

var layout = {
    title: {
        text: 'Driver Status Summary',
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

Plotly.newPlot('driverStatusChart', data, layout);

</script>
</html>