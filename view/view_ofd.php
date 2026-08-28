<?php

include_once '../commons/session.php';
include_once '../model/customer_model.php';
include_once '../model/order_model.php';
include_once '../model/delivery_model.php';
include_once '../model/user_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$user_location = $userrow["user_location"];
$customerObj = new Customer();
$orderObj = new Order();
$deliveryObj = new Delivery();
$userObj = new User();
$warehouseObj = new Warehouse();
$driverObj = new Driver();


$warehouseResult = $warehouseObj->getAllOfd($user_location);
$driverResult = $driverObj->getAllRiders();
// $warehouseResult = $warehouseObj->getShipment($shipment_id);


?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php $pageName = "WAREHOUSE MANAGEMENT" ?>
         <?php 
            if($userrow["user_role"]==1){
            include_once "../includes/header_row_includes_admin.php";
            } else {
                include_once "../includes/header_row_includes2.php";
            }
            ?>
        <div class="row">


            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">
                    <button type="button" class="btn btn-primary" onclick="history.back()"> ← Back </button>

                    <li class="breadcrumb-item">
                        <a href="dashboard_new.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="warehouse.php">Warehouse Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="outfor_deliveries.php">Out for Deliveries</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        View 
                    </li>
                </ol>
            </nav>

            <div class="col-md-10">
                    <a href="add_shipment.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-briefcase"></span> Shipments</button></a>
                    <a href="view_parcels.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Parcels</button></a>
                    <a href="incoming_deliveries.php"><button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Incoming Deliveries</button></a>
                    <a href="outfor_deliveries.php"><button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-send"></span> Out for Deliveries</button></a>
                    <a href="order_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Reports</button></a>
                    </div>


        </div>

        <div class="row">
            &nbsp
        </div>
        <div class="row">
            <div class="col-md-5">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="outfor_deliveries.php">Assign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-primary" href="view_ofd.php">View</a>
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
                    <table class="table table-info table-striped" id="ofdtable" style="text-align: left;">
                        <thead>
                            <tr>
                                <th style="display: none;">Created Date</th>
                                <th width="10%">#</th>
                                <th width="20%">Driver Name</th>
                                <th width="20%">Order ID</th>
                                <th width="20%">Status</th>
                                <th width="30%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ofdrow = $warehouseResult->fetch_assoc()) {

                                $ofd_id = $ofdrow["ofd_id"];
                                $ofd_id = base64_encode($ofd_id);

                                if ($ofdrow["ofd_status"] == "Pending") {
                                    $color = "bg-warning";

                                } elseif ($ofdrow["ofd_status"] == "Delivered") {
                                    $color = "bg-success";

                                } else {
                                    $color = "bg-danger";
                                }



                                ?>

                                <tr>
                                    <td style="display: none;">
                                        <?php
                                        echo $ofdrow["ofd_date"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $ofdrow["ofd_id"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $ofdrow["driver_name"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $ofdrow["order_id"];

                                        ?>
                                    </td>

                                    <td class="<?php echo $color; ?>">
                                        <?php
                                        echo $ofdrow["ofd_status"];

                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#myModal2" class="btn btn-info"
                                            onclick="loadorderdetails('<?php echo $ofdrow['ofd_id']; ?>');"><span
                                                class="glyphicon glyphicon-search"></span>&nbsp;View</a>

                                                &nbsp;

                                                <?php
                                                if($ofdrow["ofd_status"]=="Pending"){
                                                ?>

                                                <a href="#" data-toggle="modal" data-target="#myModal1"
                                                                class="btn btn-danger" onclick="returnorder('<?php echo $ofdrow['ofd_id']; ?>',
                                                                    '<?php echo $ofdrow['order_id']; ?>');"><span
                                                                    class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a>
                                                &nbsp;

                                                <a href="#" data-toggle="modal" data-target="#myModal3" class="btn btn-success"
                                                    onclick="reassigndriver('<?php echo $ofd_id; ?>');"><span
                                                        class="glyphicon glyphicon-transfer"></span>&nbsp;Re-assign</a>



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
</body>

<!-- View modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">

        
        <div class="modal-content">
            <div id="display_data">
                
            </div>

        </div>

    </div>
</div>


<!-- cancel modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to return order <?php
                $id = base64_decode($ofd_id);
                echo $id; ?> ?</h4>
            </div>
            <form action="../controller/warehouse_controller.php?status=cancel_order" method="post">
                <div class="modal-body">

                    <input type="hidden" name="ofd_id" id="return_ofd_id">
                    <input type="hidden" name="order_id" id="return_order_id">

                    <div>
                        &nbsp;
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Re-assign modal -->
<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to re-assign rider?</h4>
            </div>
            <form action="../controller/warehouse_controller.php?status=reassign_rider" method="post">
                <div class="modal-body">
                    <label class="form-lable">Select Rider</label>
                    <input type="hidden" name="ofd_id" id="reassign_ofd_id">
                    <div class="form-group">

                        <select name="driver_id" id="select_driver"
                            class="form-control custom-dropdown">
                            <option value="">Select Rider</option>
                            <?php
                            
                            while ($driverrow = $driverResult->fetch_assoc()) { ?>
                                <option value="<?php echo $driverrow["driver_id"]; ?>">
                                    <?php echo $driverrow["driver_id"] . " - " . $driverrow["driver_name"] . " - " . $driverrow["branch_name"] . " - " . $driverrow["driver_phone_number"]; ?>
                                </option>
                            <?php } ?>


                        </select>
                    </div>
                    <div>
                        &nbsp;
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="text-align:right;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>

                        </div>
                    </div>
                </div>
            </form>
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

    let table = $("#ofdtable").DataTable({
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
    function loadorderdetails(ofd_id) {

        var url = "../controller/warehouse_controller.php?status=ofd_order_details";

        $.post(url, { ofd_id: ofd_id }, function (data) {
            $("#display_data").html(data).show();
        });

    }

</script>

<script>
    function returnorder(ofd_id, order_id) {

        document.getElementById("return_ofd_id").value = ofd_id;
        document.getElementById("return_order_id").value = order_id;


    }

</script>

<script>
    function reassigndriver(ofd_id) {

        document.getElementById("reassign_ofd_id").value = ofd_id;


    }

</script>

<!-- <script>
    function loadshipmentorders(shipment_id) {

        var url = "../controller/warehouse_controller.php?status=load_shipment_orders";

        $.post(url, { shipment_id: shipment_id }, function (data) {
            $("#display_data").html(data).show();
        });

    }

</script> -->


<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>

</html>