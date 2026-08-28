<?php

include_once "../model/customer_model.php";

$nic = $_POST["nic"];

$customerObj = new Customer();

$result = $customerObj->searchCustomerByNIC($nic);

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    echo json_encode([
        "status"=>"found",
        "customer"=>$row
    ]);

}else{

    echo json_encode([
        "status"=>"not_found"
    ]);

}