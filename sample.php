<?php

// ^\s*$\n



//SELECT * FROM order WHERE order_id = $order_id


// public function checkPOD($order_id){

//         $con=$GLOBALS["con"];
//         $sql = "SELECT * FROM order WHERE order_id = '$order_id'";
//         $result = $con->query($sql) or die($con->error);
//         return $result;

//     }


//     $POD = $orderObj->checkPOD($order_id);

// echo $POD;

// if($POD == 1 && $filename == ""){

//     throw new Execption..... Proof of delivery required


// } else {

// }

// /////for district dropdown displaying

// mysqli_data_seek($districtResult, 0);



// $x = 0;


// while ($x <= 5) {

//     $x++;
// }


// echo $x;


$p = "";
$amount = 5000;

if ($amount >= 50000) {
    $p = "P1";
    $color = "bg-warning";

} else if ($amount <= 50000 && $amount >= 10000) {
    $p = "P2";
    $color = "bg-success";
} else {
    $p = "P3";
    $color = "bg-info";
}

echo $p;





?>

<table border="1">
    <thead>
        <th>no.</th>
        <th>Amount</th>
        <th>Priority</th>
    </thead>
    <tbody>
        <td>1</td>
        <td>
            <?php
            echo $amount;
            ?>
        </td>
        <td>
            <?php
            echo $p;
            ?>
        </td>
    </tbody>
</table>


<?php

include_once '../model/permission_model.php';
$permissionObj = new Permission();
if (!$permissionObj->hasPermission($userrow["user_id"], 15)) {
    header("Location: access_denied.php");
    exit();
}


public function hasPermission($user_id, $fun_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT 1 FROM function_user WHERE user_id = '$user_id' AND fun_id = '$fun_id'";
        $result = $con->query($sql);
        return ($result->num_rows > 0);
    }








$totalAmount = $row["total_amount"] + $row["delivery_charge"];

if ($totalAmount >= 50000) {

    $priority = "Priority 1";
    $priorityColor = "bg-danger";

} else if ($totalAmount < 50000 && $totalAmount >= 10000) {

    $priority = "Priority 2";
    $priorityColor = "bg-warning";

} else if ($totalAmount < 10000) {

    $priority = "Priority 3";
    $priorityColor = "bg-info";
}





$totalAmount = $orderrow["amount"];

if ($orderrow["amount"] < 1000) {
    $color = "bg-success";
    
} else if ($orderrow["amount"] >= 1000 && $orderrow["amount"] < 5000) {
    $color = "bg-danger";


} else if ($orderrow["amount"] >= 5000) {
    $color = "bg-info";


}
?>

<td class="<?php echo $color; ?>">
    <?php

    echo number_format($totalAmount, 2);
    
    ?>



 <?php 

        // $weight = $packagerow["pkg_weight"];
        if($packagerow["pkg_weight"]<1){
            $weightCategory = "Light Weight";

        }elseif($packagerow["pkg_weight"]<=1 && $packagerow["pkg_weight"]<5){
            $weightCategory = "Medium Weight";
        
        }elseif($packagerow["pkg_weight"]>=5){
            $weightCategory = "Heavy Weight";
        
        }
        
        
        
    ?>
     <tr>
        <th>Weight Category</th>
        <td><?php echo $weightCategory; ?></td>
    </tr>


</td>

<?php
$catcolor = $driverrow["driver_categary"] =='Driver'? "bg-success": "bg-warning";



public function getAllDrivers(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM driver dr
         LEFT JOIN branch b ON dr.driver_district = b.branch_id WHERE driver_category = 'Driver' AND driver_status = 'Unavailable'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

    
?>

<a href="print_label.php?order_id=<?php echo $_GET["order_id"]; ?>"><button type="button" class="btn btn-danger btn-lg"><span
                                class="glyphicon glyphicon-book"></span> Print Label</button></a>



<?php

function($branch){
$sql = "SELECT COUNT(user_id) AS total
        FROM user
        WHERE user_location = '$branch'";
}

$branchUserCountResult = $branchObj->getBranchUserCount($branch_id);
$branchUserCountResultRow = $branchUserCountResult->fetch_assoc();

<tr>
<th style="background:#f9f9f9;">No. of Users</th>
<td><?php echo $branchUserCountResultRow["total"]; ?></td>
</tr>


<?php
$today = new DateTime();
$expiry = new DateTime($driverrow["license_expiry_date"]);

$days_left = $today->diff($expiry)->days;

if ($days_left < 0) {
    $msg = "License has expired";
    $bg_color = "bg-danger";

} elseif ($days_left <= 30) {
    $msg = "License will expire soon";
    $bg_color = "bg-warning";

} else {
    $msg = "License is valid";
    $bg_color = "bg-success";
}


?>

<tr>
    <th style="background:#f9f9f9;">License Expire in</th>
    <td class="<?php echo  $bg_color; ?>"><?php echo $msg; ?></td>
</tr>
