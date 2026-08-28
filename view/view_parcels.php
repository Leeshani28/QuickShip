<?php

include_once '../commons/session.php';
include_once '../model/customer_model.php';
include_once '../model/warehouse_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$user_location = $userrow["user_location"];
$customerObj = new Customer();
$warehouseObj = new Warehouse();


$warehouseResult = $warehouseObj->getAllOrders($user_location);


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php $pageName="WAREHOUSE MANAGEMENT" ?>
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
                            View Parcels
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="row">
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
                        <a class="nav-link bg-primary" aria-current="page" href="view_parcels.php">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_parcels_confirmed.php">Confirmed</a>
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
                        <table class="table table-info table-striped" id="orderstable">
                            <thead>
                                <tr>
                                    <th style="display: none;">Created Date</th>
                                    <th width="5%">#</th>
                                    <th width="10%">Delivery Type</th>
                                    <th width="12%">Package Type</th>
                                    <th width="10%">Weight(Kg)</th>
                                    <th width="13%">Town</th>
                                    <th width="10%">Status</th>
                                    <th width="40%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($orderrow=$warehouseResult->fetch_assoc()){

                                    $order_id=$orderrow["order_id"];
                                    $order_id=base64_encode($order_id);


                                    $status="";
                                    if($orderrow["order_status"]==1){
                                        $status="Pending";

                                    }
                                
                                
                                
                                ?>
                                
                                <tr>
                                    <td style="display: none;">
                                        <?php
                                        echo $orderrow["order_date"];

                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $orderrow["order_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["delivery_type"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["pkg_type"];
                                        
                                        ?>
                                    </td>
                                    
                                    <td>
                                    <?php 
                                        echo $orderrow["pkg_weight"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["town"];
                                        
                                        ?>
                                    </td>
                                    <td style="background-color: <?php echo $orderrow["color_code"];?>">
                                        <?php 
                                        echo $orderrow["status_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <a href="view_order.php?order_id=<?php echo $order_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;
                                        <!-- <a href = "#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" onclick="loaduser('<?php echo $order_id; ?>');"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a> -->

                                        

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

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4>Are you sure</h4>
        </div>
        <div class="modal-body">
        
            
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../controller/order_controller.php?status=delete&order_id=<?php echo $order_id; ?>" class="btn btn-danger">
                                            
                        &nbsp;
                        Delete
                    </a>
                </div>
            </div>
           
           
        

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

    let table = $("#orderstable").DataTable({
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
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>
</html>