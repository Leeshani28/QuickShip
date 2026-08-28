<?php

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/customer_model.php';

//get user information from session
$userrow=$_SESSION["user"];
$customerObj = new Customer();
$customerResult = $customerObj->getAllCustomers();

?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php $pageName="CUSTOMER MANAGEMENT" ?>
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
                            <a href="customer.php">Customer Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            View Customers
                        </li>
                    </ol>
                </nav>

                <div class="col-md-10">
                    <a href="add_customer.php"><button type="button" class="btn btn-info btn-lg"><span
                                class="glyphicon glyphicon-plus"></span> Add Customer</button></a>
                    <a href="view_customers.php"><button type="button" class="btn btn-success btn-lg"><span
                                class="glyphicon glyphicon-search"></span> View Customers</button></a>
                    <a href="customer_list_report.php"><button type="button" class="btn btn-warning btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Generate Customer Reports</button></a>
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
                        <table class="table table-info table-striped" id="customertable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($customerrow=$customerResult->fetch_assoc()){

                                    $customer_id=$customerrow["customer_id"];
                                    $customer_id=base64_encode("$customer_id");

                                ?>
                                <tr>
                                    <td>
                                        <?php 
                                        echo $customerrow["customer_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $customerrow["customer_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $customerrow["customer_email"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $customerrow["customer_mobile"];
                                        
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="view_customer.php?customer_id=<?php echo $customer_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;

                                        <a href="edit_customer.php?customer_id=<?php echo $customer_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>
                                        &nbsp;
                                        
                                        <a href = "#" data-toggle="modal" data-target="#myModal" class="btn btn-danger" onclick="loaduser('<?php echo $customer_id; ?>');"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

                                        

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
                    <a href="../controller/user_controller.php?status=delete&user_id=<?php echo $user_id; ?>" class="btn btn-danger">
                                            
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
        $(document).ready(function(){
            $("#customertable").DataTable();

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