<?php
include_once '../commons/session.php';
include_once '../model/order_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/driver_model.php';
include_once '../model/vehicle_model.php';
include_once '../model/delivery_model.php';
include_once '../model/branch_model.php';

$userrow=$_SESSION["user"];

$orderObj = new Order();
$warehouseObj = new Warehouse();
$driverObj = new Driver();
$vehicleObj = new vehicle();
$deliveryObj = new Delivery();
$branchObj = new Branch();

$location = $userrow["user_location"];
$deliveryResult = $deliveryObj->getAllDeliveries($location);


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
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
                            <li class="breadcrumb-item">
                                <a href="delivery.php">Delivery Management</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">
                                View Delivery 
                            </li>
                        </ol>
                    </nav>


                   </div>
                   <div class="row">
                    <div class="col-md-7">
                    <a href="add_delivery.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Delivery</button></a>
                    <a href="view_delivery.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Deliveries</button></a>
                    <a href="generate_delivery_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Delivery Reports</button></a>
                    </div>

                    <div class="col-md-5">
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

                    
       
            </div>

            <div class="row">
                &nbsp

            </div>
            <div class="row">
                &nbsp

            </div>

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
                        <table class="table table-info table-striped" id="deliverytable">
                            <thead>
                                <tr>
                                    <th style="display: none;" width="0%">Created Date</th>
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


                                    if ($deliveryrow["delivery_status"] == "Pending") {
                                    $color = "bg-warning";

                                } elseif ($deliveryrow["delivery_status"] == "Approved") {
                                    $color = "bg-Info";

                                }elseif ($deliveryrow["delivery_status"] == "Started") {
                                    $color = "bg-success";

                                }else {
                                    $color = "bg-danger";
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
                                            if($deliveryrow["delivery_status"]=="Pending")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-info"
                                                onclick="approveDelivery('<?php echo $delivery_id; ?>');"><span
                                                    class="glyphicon glyphicon-ok"></span>&nbsp;Approve</a>

                                        &nbsp;

                                        <a href="#" data-toggle="modal" data-target="#myModal1" class="btn btn-danger"
                                                onclick="rejectDelivery('<?php echo $deliveryrow['delivery_id']; ?>',
                                                                        '<?php echo $deliveryrow['shipment_id']; ?>',
                                                                        '<?php echo $deliveryrow['driver_id']; ?>',
                                                                        '<?php echo $deliveryrow['vehicle_id']; ?>');"><span
                                                    class="glyphicon glyphicon-remove"></span>&nbsp;Reject</a>
                                        <?php 
                                            }
                                        
                                        ?>
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
   


     </body>

     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to Approve</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/delivery_controller.php?status=approve_delivery" method="post">
                <input type="hidden" name="delivery_id" id="delivery_id">

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

<!-- start delivery -->
     <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to Start</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/delivery_controller.php?status=start_delivery" method="post">
                <input type="hidden" name="delivery_id" id="start_delivery_id">

                <div class="row">
                    <div class="col-md-12" style="text-align:right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">

                            &nbsp;
                            Start
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to reject this delivery <?php
                $id = base64_decode($delivery_id);
                echo $id; ?> ?</h4>
            </div>
            <form action="../controller/delivery_controller.php?status=reject_delivery" method="post">
                <div class="modal-body">
                    <label class="form-lable">Remark</label>
                    
                    <input type="hidden" name="delivery_id" id="reject_delivery_id">
                    <input type="hidden" name="shipment_id" id="reject_shipment_id">
                    <input type="hidden" name="driver_id" id="reject_driver_id">
                    <input type="hidden" name="vehicle_id" id="reject_vehicle_id">
                    <textarea name="remarks" id="remarks" class="form-control" required></textarea>
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

    let table = $("#deliverytable").DataTable({
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

<script>
    function approveDelivery(delivery_id ) {

        document.getElementById("delivery_id").value = delivery_id;

    }

</script>
<script>
    function startDelivery(delivery_id ) {

        document.getElementById("start_delivery_id").value = delivery_id;

    }

</script>

<script>
    function rejectDelivery(delivery_id, shipment_id, driver_id,vehicle_id) {

    // Read the selected vehicle and driver from that row's dropdowns

        document.getElementById("reject_delivery_id").value = delivery_id;
        document.getElementById("reject_shipment_id").value = shipment_id;
        document.getElementById("reject_driver_id").value = driver_id;
        document.getElementById("reject_vehicle_id").value = vehicle_id;
        

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