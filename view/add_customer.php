<?php

include_once '../commons/session.php';
include_once '../model/customer_model.php';

//get user information from session
$userrow=$_SESSION["user"];

$customerObj = new Customer();



?>

<html>

<head>
    <?php include_once "../includes/bootstrap_css_includes.php" ?>


</head>

<body>
    <div class="container">
        <div class="row">
            <?php $pageName = "CUSTOMER MANAGEMENT" ?>
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
                            <a href="customer.php">Customer Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Customer
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

            <div class="container">

                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body"
                                style="background-image: url('../images/Premium Vector.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;padding: 15px;padding-bottom: 15px;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

                                <form class="form-horizontal" action="../controller/customer_controller.php?status=add_customer"
                                    method="post">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3" id="msg">

                                            </div>
                                            <?php
                                            if (isset($_GET["msg"])) {
                                                ?>
                                                <div class="col-md-6 col-md-offset-3 alert alert-danger">
                                                    <?php echo base64_decode($_GET["msg"]); ?>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;">Name</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="name" id="name" required />
                                            </div>

                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label" style="text-align: right;"> Customer Category</label>
                                            </div>
                                            <div class="col-md-4 dropdown">
                                                <div class="form-group">
    
                                                    <select name="customer_category" id="customer_category"
                                                        class="form-control custom-dropdown">
                                                        <option selected disabled>Select Category</option>
                                                        <option value="Persenal">Persenal</option>
                                                        <option value="Business">Business</option>
                                                    </select>
                                                </div>

                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Address</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="address" id="address" required/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Email</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="email" class="form-control" name="email" id="email" required />
                                            </div>
                                            
                                            <div class="col-md-1 text-right">
                                                <label class="control-label">NIC</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="nic" id="nic" required/>
                                            </div>
                                            
                                            

                                        

                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Mobile Number</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="cno1" id="cno1" required/>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <label class="control-label">Fixed Number</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="cno2" id="cno2" />
                                            </div>
                                        </div>
                                        
                                        
                                            
                                        
                                        <div class="row">
                                            <div class="col-md-12"> &nbsp; </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    <input type="reset" class="btn btn-danger btn-lg" value="Reset" />
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <input type="submit" class="btn btn-success btn-lg" value="Submit" />
                                                </div>
                                            </div>
                                        </div>
</div>


                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </div>

    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/customervalidation.js"></script>
    

</body>

</html>