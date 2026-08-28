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

 include '../model/finance_model.php';
 
 $userrow=$_SESSION["user"];
 $financeObj = new Finance();

 switch($status){

 case "add_finance":
        
        $expense_category = $_POST["expense_category"];
        $expense_amount = $_POST["expense_amount"];
        $expense_date = $_POST["expense_date"];
        $expense_description = $_POST["expense_description"];
        $user_location = $userrow["user_location"];
        // echo $expense_category;
        // echo $expense_amount;
        // echo $expense_date;
        // echo $expense_description;
try{
    
       $financeObj->addFinance($expense_category,$expense_amount,$expense_date,$expense_description,$user_location);
    

        $msg= "Expense Successfully Added!!";
        $msg= base64_encode($msg);

     ?>

    <script>
        window.location="../view/add_expenses.php?msg=<?php echo $msg; ?>";
    </script>
     <?php
         
    //  }
           
}
catch(Exception $ex)
{
    $msg= $ex->getMessage();
    $msg= base64_encode($msg);
    ?>
      <!-- <script>
        window.location="../view/add_driver.php?msg=<?php echo $msg; ?>";
    </script> -->
    <?php
    
}
                
    break;


case "confirm_expense":
        $expense_id = $_POST["expense_id"];
        try{
            //   echo $expense_id;
        
        $financeObj->confirmExpense($expense_id);
        
        $msg = "Successfully Approved!!";
        $msg = base64_encode($msg);



        ?>
        <script>
            window.location = "../view/view_expenses.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        }
        catch(Exception $ex)
{
    $msg= $ex->getMessage();
    $msg= base64_encode($msg);
    ?>
      <script>
        window.location="../view/view_expenses.php?msg=<?php echo $msg; ?>";
    </script>
    <?php
    
}

        break;



case "reject_expense":
        $expense_id = $_POST["expense_id"];
        try{
            //   echo $expense_id;
        
        $financeObj->rejectExpense($expense_id);
        
        $msg = "Expense Rejected!!";
        $msg = base64_encode($msg);



        ?>
        <script>
            window.location = "../view/view_expenses.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        }
        catch(Exception $ex)
{
    $msg= $ex->getMessage();
    $msg= base64_encode($msg);
    ?>
      <script>
        window.location="../view/view_expenses.php?msg=<?php echo $msg; ?>";
    </script>
    <?php
    
}

        break;
 }