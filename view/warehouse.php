<?php

include_once '../commons/session.php';

include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';

$userrow=$_SESSION["user"];
$orderObj = new Order();
$warehouseObj = new Warehouse();

// $orderResult = $orderObj->getAllOrderCount();
// $orderrow = $orderResult->fetch_assoc();
$order_location = $userrow["user_location"];
$warehouse_location = $userrow["user_location"];
$user_location = $userrow["user_location"];

$confirmedOrderCountResult = $warehouseObj->getConfirmedOrderCount($order_location);
$confirmedOrderCountRow = $confirmedOrderCountResult->fetch_assoc();

$countResult = $warehouseObj->getIncomingDeliveriesCount($warehouse_location);
$countRow = $countResult->fetch_assoc();

$ofdResult = $warehouseObj->getOfdOrdersCount($user_location, 5); // 5 = Out for Delivery status
$ofdRow = $ofdResult->fetch_assoc();

$districtResult = $warehouseObj->getDestinationDistrictChart($user_location);

$districtName = array();
$totalParcels = array();

while($row = $districtResult->fetch_assoc())
{
    $districtName[] = $row["district_name"];
    $totalParcels[] = $row["total_parcels"];
}


$statusResult = $warehouseObj->getWarehouseStatusChart($user_location);

$statusName = array();
$totalParcels = array();

while($row = $statusResult->fetch_assoc())
{
    $statusName[] = $row["status_name"];
    $totalParcels[] = $row["total_parcels"];
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
                
                
                    <?php $pageName="WAREHOUSE MANAGEMENT" ?>
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
                                Warehouse Management
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_shipment.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-briefcase"></span> Shipments</button></a>
                    <a href="view_parcels.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Parcels</button></a>
                    <a href="incoming_deliveries.php"><button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Incoming Deliveries</button></a>
                    <a href="outfor_deliveries.php"><button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-send"></span> Out for Deliveries</button></a>
                    <a href="generate_warehouse_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Reports</button></a>
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
                    <h4 class="text-center">Total Parcels</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $confirmedOrderCountRow["confirmed_count"]; ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-info" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Incoming Parcels</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                         <?php echo $countRow["incoming_count"]; ?> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-danger" style="height:200px;border-radius: 10px;">
                <div class="panel-heading">
                    <h4 class="text-center">Outgoing Parcels</h4>
                </div>
                <div class="panel-body">
                    <h1 class="text-center">
                        <?php echo $ofdRow["ofd_count"]; ?>
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

                        <div id="districtChart"
                            style="width:500px;height:450px;margin:0 auto;">
                        </div>

                    </div>
                
                    <div class="col-md-6 text-center">

                        <div id="warehouseStatusChart"
                            style="width:400px;height:450px;margin:0 auto;">
                        </div>

                    </div> 
            </div>
               
        </div>

    </body>
   
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>

    <script>

var data = [{

    y: <?php echo json_encode($districtName); ?>,
    x: <?php echo json_encode($totalParcels); ?>,
    type: 'bar',
    orientation: 'h',
    marker: {
        color: [

            '#90CAF9',
            '#A5D6A7',
            '#FFE082',
            '#FFCCBC',
            '#CE93D8',
            '#80CBC4',
            '#92CB80',
            '#9C80CB',
            '#FFAB91',
            '#B39DDB'

        ]
    },

    text: <?php echo json_encode($totalParcels); ?>,
    textposition: 'outside'

}];

var layout = {
    title: {
        text: 'Parcels by Destination District',
        font: {
            size: 22
        }

    },
    xaxis: {
        title: {
            text: 'Number of Parcels'
        }

    },
    yaxis: {
        title: {
            text: 'Destination District'
        },
        automargin: true

    },

    width: 700,
    height: 500,
    margin: {
        l: 40,
        r: 20,
        b: 70,
        t: 80
    }
};

Plotly.newPlot('districtChart', data, layout);

</script>
    <script>

var data = [{

    labels: <?php echo json_encode($statusName); ?>,
    values: <?php echo json_encode($totalParcels); ?>,
    type: 'pie',
    textinfo: 'label+percent',
    hoverinfo: 'label+value',
    marker: {
        colors: [
            '#42A5F5',   // Confirmed
            '#66BB6A',   // At Warehouse
            '#FFA726',   // In Transit
            '#EF5350'    // Out for Delivery
        ]
    }
}];
var layout = {

    title: {
        text: 'Warehouse Status Summary',
        font: {
            size: 22
        }
    },
    width: 600,
    height: 500,
    showlegend: true
};

Plotly.newPlot('warehouseStatusChart', data, layout);

</script>



     
</html>