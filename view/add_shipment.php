<?php 
include_once '../commons/session.php';
include_once '../model/customer_model.php';
include_once '../model/order_model.php';
include_once '../model/delivery_model.php';
include_once '../model/user_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/branch_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$user_location = $userrow["user_location"];
$customerObj = new Customer();
$orderObj = new Order();
$deliveryObj = new Delivery();
$userObj = new User();
$warehouseObj = new Warehouse();
$branchObj = new Branch();

$branch = $branchObj->getAllBranches();
$branchDetination = $branchObj->getAllBranches();
// $districtResultDetination = $deliveryObj->getAllDistrict();
// $provinceResult = $deliveryObj->getAllProvince();


$status = 3;
$warehouseResult = $warehouseObj->getAllOrdersByStatus($user_location,$status);

?> 

<!DOCTYPE html>
<html>
<head>
    <?php include_once "../includes/bootstrap_css_includes.php"?>
    <title>Add shipment</title>
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
                    <a href="add_shipment.php">Shipments</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add Shipments
                </li>
            </ol>
        </nav>
    </div>

    <!-- Top Buttons -->
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
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link bg-primary" aria-current="page" href="add_shipment.php">Add Shipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_shipments.php">View Shipments</a>
                    </li>
                    
                </ul>
            </div>



    <div class="row"><br></div>
    <?php 
                if(isset($_GET["msg"])){
                    $msg= base64_decode($_GET["msg"]);

                
                
                ?>
                <div class="row" id="msg">
                    <div class="alert alert-danger">
                        <?php echo $msg ?>

                    </div>

                </div>

                <?php 
                }
                ?>

                <div class="row">
                    &nbsp;
                </div>

 
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="../controller/warehouse_controller.php?status=create_shipment" method="post">

            

            <div class="panel panel-info" style="border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                <div class="panel-heading text-center" 
                     style="font-size:20px; font-weight:bold; border-top-left-radius:10px; border-top-right-radius:10px;">
                   <span><i class="bi bi-truck"></i></span> Add Shipment
                </div>

                <div class="panel-body" style="padding:25px;">
                    <div class="row">
                        <div class="col-md-2 text-right">
                                    <label class="control-label" style="text-align: right;">Start</label>
                                </div>
                                <div class="col-md-4">
                                    <!-- <input type="text" class="form-control" name="user_location" id="user_location" value="<?php echo ($userrow["district_name"]); ?>" disabled /> -->
                                
                                <div class="form-group">
                                    <input type="hidden" name="start_location" value="<?php echo $userrow["user_location"]; ?>">
                                    <select name="start_location" id="user_location" class="form-control custom-dropdown" disabled>
                                        
                                    <?php 
                                    while($branchRow=$branch->fetch_assoc())
                                    {
                                ?>
                                <option value="<?php echo $branchRow["branch_id"]; ?>"
                                   <?php
                                   if($branchRow["branch_id"]==$userrow["user_location"]){
                                    ?>
                                    selected
                                    <?php
                                   }
                                   ?>
                                   >
                                   <?php echo $branchRow["branch_name"]; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                    
                                </select>
                                </div>
                
                                </div>

                                <div class="col-md-2 text-right">
                                                <label class="control-label">Branch</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
    
                                                    <select name="distination_location" id="district_id" class="form-control custom-dropdown">
                                                        <option value="">Select Branch</option>
                                                        <?php 
                                                        while($branchRow = $branchDetination->fetch_assoc()){?>
                                                            <option value="<?php echo $branchRow["branch_id"];?>">
                                                                <?php echo $branchRow["branch_name"];?>
                                                            </option>
                                                            <?php }?>

            
                                                    </select>
                                                </div>
                    </div>


                    <div>
                        &nbsp;
                    </div>




                    <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-info table-striped" id="shipmenttable">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th width="10%">Order Id</th>
                                    <th width="15%">Location</th>
                                    <th width="15%">Total Weight(Kg)</th>
                                    <th width="15%">Status</th>
                                    <th width="40%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($orderrow=$warehouseResult->fetch_assoc()){

                                    $order_id=$orderrow["order_id"];
                                    $order_id=base64_encode($order_id);


                                    $status="";
                                    if($orderrow["order_status"]==3){
                                        $status="At Warehouse";

                                    }
                                ?>
                                
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_orders[]" value="<?php echo $orderrow["order_id"];?>">
                                    </td>
                                    <td>
                                        <?php 
                                        echo $orderrow["order_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["district_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["pkg_weight"];
                                        
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
                                        
                                        <!-- <?php 
                                            if($orderrow["order_status"]==3)
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/warehouse_controller.php?status=intransit_order&order_id=<?php echo $order_id; ?>" class="btn btn-info" style="background-color: #64b577;">
                                            <span class="glyphicon glyphicon-home"></span>
                                            &nbsp;
                                           In Transit
                                        </a>
                                        <?php 
                                            }

                                
                                        
                                        ?>
                                        &nbsp; -->
                                    </td>
                                </tr>
                                <?php 
                                }
                                
                                ?>
                            </tbody>
                        </table>

                        <div>
                            &nbsp;
                        </div>

                        <div class="row">
                            <div class="col-md-10 text-right">
                            <button type="submit" class="btn btn-info btn-lg" style="background-color: #2ece5b;">
                                <span class="glyphicon glyphicon-send"></span>
                                Create Shipment
                            </button>
                        </div>
                            
                        </div>
                        
                    </div>
                </div>


            </div>
                </div>
            </div>

        </div>

        <div>
            &nbsp;
        </div>
    
    
            </form>
        </div>

    <div>
        &nbsp;
    </div>

    <div class="row"><br></div>

</div>

<script src="../js/jquery-3.7.1.js"></script>
<script src="../js/uservalidation.js"></script>
<!-- <script>
    $(document).ready(function () {
        $("#shipmenttable").DataTable();

    });


</script> -->

<script>
    const msg = document.getElementById('msg');

    const delayTime = 3000;

    setTimeout(() => {
        msg.style.display = 'none';
    }, delayTime);
</script>

</body>
</html>