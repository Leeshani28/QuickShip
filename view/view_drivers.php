<?php

include_once '../commons/session.php';
include_once '../model/driver_model.php';


$userrow=$_SESSION["user"];

$driverObj = new Driver();

$driverResult = $driverObj->getAllDrivers();


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
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
                            <li class="breadcrumb-item">
                                <a href="driver.php">Driver Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                View Drivers 
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_driver.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Driver</button></a>
                    <a href="view_drivers.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Drivers</button></a>
                    <a href="driver_reports.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Driver Reports</button></a>
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
                        <table class="table table-info table-striped" id="drivertable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Category</th>
                                    <th>Driver Name</th>
                                    <th>Branch</th>
                                    <th>Contact No.</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($driverrow=$driverResult->fetch_assoc()){

                                    $driver_id=$driverrow["driver_id"];
                                    $driver_id=base64_encode("$driver_id");

                                    $img_path = "../images/courier_images/";

                                    if($driverrow["driver_profile_picture"]==""){

                                        $img_path = "../images/courier_images/default_user.jpg";
                                    }
                                    else{
                                        $img_path = "../images/courier_images/" . $driverrow["driver_profile_picture"];
                                    }


                                    // $status="Active";
                                    // if($userrow["user_status"]==0){
                                    //     $status="De-Active";

                                    // }

                                    if ($driverrow["driver_status"] == "Available") {
                                    $color = "bg-success";

                                }elseif ($driverrow["driver_status"] == "Assigned") {
                                    $color = "bg-info";

                                } elseif ($driverrow["driver_status"] == "Unavailable"){
                                    $color = "bg-danger";
                                } 

                                
                               
                                
                                ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $img_path?>" width="60px" height="60px" style="border-radius:50%; object-fit:cover;" />
                                    </td>
                                    <td>
                                        <?php 
                                        echo $driverrow["driver_categary"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $driverrow["driver_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $driverrow["branch_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $driverrow["driver_phone_number"];
                                        
                                        ?>
                                    </td>
                                    <td class="<?php echo $color; ?>">
                                        <?php
                                        echo $driverrow["driver_status"];

                                        ?>
                                    </td>
                                    <td>
                                        <a href="view_driver.php?driver_id=<?php echo $driver_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;

                                        <a href="edit_driver.php?driver_id=<?php echo $driver_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>
                                        &nbsp;
                                        <?php 
                                            if($driverrow["driver_status"]=="Unavailable")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/driver_controller.php?status=set_available&driver_id=<?php echo $driver_id; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp;
                                            Available
                                        </a>
                                        <?php 
                                            }   
                                        
                                        
                                        ?>
                                        &nbsp;
                                        <?php 
                                            if($driverrow["driver_status"]=="Available")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/driver_controller.php?status=set_unavailable&driver_id=<?php echo $driver_id; ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            &nbsp;
                                            Unavailable
                                        </a>
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
   
            <script src="../js/datatable/jquery-3.5.1.js"></script>
            <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
            <script src="../js/datatable/jquery.dataTables.min.js"></script>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../js/datatable/datatables.js"></script>

            <script>
                $(document).ready(function () {
        $("#drivertable").DataTable();






    });
            </script>

            <script>
                const msg = document.getElementById('msg');

                const delayTime = 3000;

                setTimeout(() => {
                    msg.style.display = 'none';
                }, delayTime);
            </script>

     </body>
</html>