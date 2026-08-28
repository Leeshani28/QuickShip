<?php

include_once '../commons/session.php';
include_once '../model/customer_model.php';
include_once '../model/order_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$customerObj = new Customer();
$orderObj = new Order();


$orderResult = $orderObj->getDeliveredOrders($userrow["user_location"]);


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php $pageName="ORDER MANAGEMENT" ?>
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
                            Delivered Orders
                        </li>
                    </ol>
                </nav>

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
                                    <th width="5%">#</th>
                                    <th width="10%">Sender</th>
                                    <th width="12%">Package Type</th>
                                    <th width="10%">Delivery Date</th>
                                    <th width="13%">Town</th>
                                    <th width="10%">Status</th>
                                    <th width="40%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($orderrow=$orderResult->fetch_assoc()){

                                    $order_id=$orderrow["order_id"];
                                    $order_id=base64_encode($order_id);


                                    $status="";
                                    if($orderrow["order_status"]==1){
                                        $status="Pending";

                                    }
                                
                                
                                
                                ?>
                                
                                <tr>
                                    <td>
                                        <?php 
                                        echo $orderrow["order_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["customer_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $orderrow["pkg_type"];
                                        
                                        ?>
                                    </td>
                                    
                                    <td>
                                    <?php 
                                        echo $orderrow["preferred_del_date"];
                                        
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
                                        <a href="view_order.php?order_id=<?php echo $order_id; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;

                                        
                                        
                                        <?php 
                                            if($orderrow["order_status"]==1)
                                            {  
                                        
                                        
                                        ?>
                                        <a href="edit_order.php?order_id=<?php echo $order_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>
                                        &nbsp;

                                        <a href="../controller/order_controller.php?status=confirm_order&order_id=<?php echo $order_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp;
                                            Confirm
                                        </a>

                                        <a href = "#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" onclick="loaduser('<?php echo $order_id; ?>');"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a>
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

    <script>
$(document).ready(function () {
    $("#orderstable").DataTable({
        order: []
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