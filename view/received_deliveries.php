<?php

include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';

$userrow=$_SESSION["user"];
$warehouse_location = $userrow["user_location"];

$orderObj = new Order();
$warehouseObj = new Warehouse();
$driverObj = new Driver();
$vehicleObj = new vehicle();
$deliveryObj = new Delivery();

$deliveryResult = $deliveryObj->getReceivedDeliveries($warehouse_location);
// $result = $warehouseObj->getDeliveries($warehouse_location);
// $deliveryrow = $deliveryResult->fetch_assoc();

?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
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
                            <li class="breadcrumb-item">
                                <a href="warehouse.php">Warehouse Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Incoming Deliveries
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
            <div class="col-md-5">
                <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="incoming_deliveries.php">Incoming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-primary" aria-current="page" href="received_deliveries.php">Received</a>
                </li>


            </ul>

            </div>

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

            <div class="row">
                <div class="col-md-12">
                <?php 
                if(isset($_GET["msg"])){
                    $msg= base64_decode($_GET["msg"]);

                
                
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
                        <table class="table table-info table-striped" id="incomingtable">
                            <thead>
                                <tr>
                                     <th style="display: none;">Created Date</th>
                                    <th width="5%">#</th>
                                    <th width="10%">Start Location</th>
                                    <th width="12%">Destination Location</th>
                                    <th width="10%">Assigned Driver</th>
                                    <th width="13%">Assigned Vehicle</th>
                                    <th width="10%">Status</th>
                                    <th width="40%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($deliveryrow=$deliveryResult->fetch_assoc()){

                                    $delivery_id =$deliveryrow["delivery_id"];
                                    $delivery_id=base64_encode($delivery_id);


                                    if ($deliveryrow["delivery_status"] == "Started") {
                                    $color = "bg-success";

                                    }else {
                                        $color = "bg-info";
                                    }
                                
                                
                                
                                ?>
                                
                                <tr>
                                    <td style="display: none;">
                                        <?php
                                        echo $deliveryrow["delivery_date"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $deliveryrow["delivery_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $deliveryrow["start_branch_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $deliveryrow["destination_branch_name"];
                                        
                                        ?>
                                    </td>
                                    
                                    <td>
                                    <?php 
                                        echo $deliveryrow["driver_id"]." - ".$deliveryrow["driver_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $deliveryrow["vehicle_number"]." - ".$deliveryrow["vehicle_type"];
                                        
                                        ?>
                                    </td>
                                    <td class="<?php echo $color; ?>">
                                        <?php
                                        echo $deliveryrow["delivery_status"];

                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-success"
                                            onclick="loadshipmentorders('<?php echo $deliveryrow['shipment_id']; ?>');"><span
                                                class="glyphicon glyphicon-search"></span>&nbsp;View</a>
                                    
                                        &nbsp;


                                        <?php 
                                            if($deliveryrow["delivery_status"]=="Approved")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-info"
                                                onclick="startDelivery('<?php echo $delivery_id; ?>');"><span
                                                    class="glyphicon glyphicon-road"></span>&nbsp;Start</a>
                                        <?php 
                                            }
                                        
                                        ?>
                                        &nbsp;
    

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
</div>
               
        </div>
     </body>

     <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div id="display_data">
                
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
        let paymentDate = data[0].substring(0,10);

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

    let table = $("#incomingtable").DataTable({
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
    function loadshipmentorders(shipment_id) {

        var url = "../controller/warehouse_controller.php?status=load_shipment_orders";

        $.post(url, { shipment_id: shipment_id }, function (data) {
            $("#display_data").html(data).show();
        });

    }

</script>
</html>