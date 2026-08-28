<?php

include_once '../commons/session.php';
include_once '../model/branch_model.php';


$userrow=$_SESSION["user"];

$branchObj = new Branch();

$branch = $branchObj->getBranches();


?>

<html>
    <head>
        <?php include_once "../includes/bootstrap_css_includes.php"?>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                
                    <?php $pageName="BRANCH MANAGEMENT" ?>
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
                                <a href="branch.php">Branch Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                View Branches
                            </li>
                        </ol>
                    </nav>


                   </div>

                    <div class="col-md-10">
                    <a href="add_branch.php"><button type="button" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Add Branch</button></a>
                    <a href="view_branches.php"><button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-search"></span> View Branches</button></a>
                    <a href="branch_list_report.php"><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-book"></span> Generate Branch Reports</button></a>
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
                        <table class="table table-info table-striped" id="branchtable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>District</th>
                                    <th>Contact No.</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($branchrow=$branch->fetch_assoc()){

                                    $branch_id =$branchrow["branch_id"];
                                    $branch_id=base64_encode("$branch_id");

                                    if ($branchrow["branch_status"] == "Active") {
                                    $color = "bg-success";

                                }elseif ($branchrow["branch_status"] == "De-active") {
                                    $color = "bg-danger";

                                } 

                
                                ?>
                                <tr>
                                    <td>
                                        <?php 
                                        echo $branchrow["branch_id"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $branchrow["branch_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $branchrow["district_name"];
                                        
                                        ?>
                                    </td>
                                    <td>
                                    <?php 
                                        echo $branchrow["contact_no"];
                                        
                                        ?>
                                    </td>
                                    <td class="<?php echo $color; ?>">
                                        <?php
                                        echo $branchrow["branch_status"];

                                        ?>
                                    </td>
                                    <td>
                                        <a href="view_branch.php?branch_id=<?php echo $branch_id; ?>" class="btn btn-info">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp;
                                            View
                                        </a>
                                        &nbsp;

                                        <a href="edit_branch.php?branch_id=<?php echo $branch_id; ?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            &nbsp;
                                            Edit
                                        </a>
                                        &nbsp;
                                        <?php 
                                            if($branchrow["branch_status"] == "Active")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/branch_controller.php?status=deactivate_branch&branch_id=<?php echo $branch_id; ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            &nbsp;
                                            De-activate
                                        </a>

                                        <?php 
                                            }   
                                        
                                        
                                        ?>
                                        &nbsp;
                                        <?php 
                                            if($branchrow["branch_status"] == "De-active")
                                            {  
                                        
                                        
                                        ?>

                                        <a href="../controller/branch_controller.php?status=activate_branch&branch_id=<?php echo $branch_id; ?>" class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp;
                                            Activate
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
        $(document).ready(function(){
            $("#branchtable").DataTable();

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