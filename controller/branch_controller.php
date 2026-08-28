<?php
include '../commons/session.php';

 if(!isset($_GET["status"])){
    ?>
    <script>
        window.location="../view/login.php";
    </script>
    <?php
 }

 $status = $_GET["status"];

 include '../model/branch_model.php';
 
 
 $branchObj = new Branch();

 switch($status){

 case "add_branch":
        
        $branch_name = $_POST["branch_name"];
        $branch_district = $_POST["branch_district"];
        $branch_address = $_POST["branch_address"];
        $contact_no = $_POST["contact_no"];
        $email = $_POST["email"];
try{
    
       $branch_id = $branchObj->addBranch($branch_name,$branch_district,$branch_address,$contact_no,$email);

         $msg= "Branch $branch_name Successfully Added!!";
        $msg= base64_encode($msg);

     ?>

    <script>
        window.location="../view/view_branches.php?msg=<?php echo $msg; ?>";
    </script>
     <?php
         
    //  }
        
    
    
    
}
catch(Exception $ex)
{
    $msg= $ex->getMessage();
    $msg= base64_encode($msg);
    ?>
      <script>
        window.location="../view/view_branches.php?msg=<?php echo $msg; ?>";
    </script>
    <?php
    
}
        
        
    break;


case "activate_branch":
        $branch_id=$_GET["branch_id"];
        $branch_id=base64_decode($branch_id);
        $branchObj->activateBranch($branch_id);
        $msg= "Successfully Activated!!";
        $msg= base64_encode($msg);

        ?>
      <script>
        window.location="../view/view_branches.php?msg=<?php echo $msg; ?>";
    </script>
    <?php



        break;

        case "deactivate_branch":
            $branch_id=$_GET["branch_id"];
            $branch_id=base64_decode($branch_id);
            $branchObj->deactivateBranch($branch_id);
            $msg= "Successfully Deactivated!!";
            $msg= base64_encode($msg);

        ?>
        <script>
        window.location="../view/view_branches.php?msg=<?php echo $msg; ?>";
        </script>
    <?php

            break;

            


case "update_branch":
        $branch_id = $_POST["branch_id"];
        $branch_name = $_POST["branch_name"];
        $branch_district = $_POST["branch_district"];
        $branch_address = $_POST["branch_address"];
        $contact_no = $_POST["contact_no"];
        $email = $_POST["email"];

                try{
                    
                    $branchResult = $branchObj->getBranch($branch_id);
                    $branchrow = $branchResult->fetch_assoc();
                    
                    
                    $branchObj->updateBranch($branch_id,$branch_name,$branch_district,$branch_address,$contact_no,$email);

                    $msg = "$branch_name Successfully Updated!";
                    $msg = base64_encode($msg);
                ?>
                    <script>
                        window.location = "../view/view_branches.php?msg=<?php echo $msg; ?>";
                    </script>
                <?php
                }
                    catch(Exception $ex)
                {
                    $msg= $ex->getMessage();
                    $msg= base64_encode($msg);
                    ?>
                      <script>
                        window.location="../view/view_branches.php?msg=<?php echo $msg; ?>";
                    </script>
                    <?php
                    
                }

            break;


 }