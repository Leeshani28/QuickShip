<?php
include '../commons/session.php';
if (!isset($_GET["status"])) {
    ?>
    <script>
        window.location = "../view/login.php";
    </script>
    <?php
}
$status = $_GET["status"];

include '../model/package_model.php';
include '../model/order_model.php';
include '../model/delivery_model.php';
include_once '../model/warehouse_model.php';
include_once '../model/vehicle_model.php';

$userrow = $_SESSION["user"];


$packageObj = new Package();
$orderObj = new Order();
$deliveryObj = new Delivery();
$warehouseObj = new Warehouse();
$vehicleObj = new vehicle();


switch ($status) {

case "add_vehicle":

        $vehicle_number =$_POST["vehicle_number"];
        $vehicle_type =$_POST["vehicle_type"];
        $vehicle_capacity =$_POST["vehicle_capacity"];
        $vehicle_district =$_POST["vehicle_district"];
        
    try{
        $vehiclenumberResult = $vehicleObj->checkVehicleNumberExist($vehicle_number);
            $vehicleRow = $vehiclenumberResult->fetch_assoc();

            if ($vehicleRow["total"] > 0) {
                throw new Exception("Vehicle Number Already Exists!!!!");
            }


        $vehicleObj->addVehicle($vehicle_number,$vehicle_type,$vehicle_capacity,$vehicle_district);

            $msg = "Vehicle $vehicle_number Successfully Added!";
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/view_vehicles.php?msg=<?php echo $msg; ?>";
            </script>

            <?php


        } catch (Exception $ex) {
             $msg = $ex->getMessage();
            $msg = base64_encode($msg);

            ?>
            <script>
                window.location = "../view/add_vehicle.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        }

        break;


         case "set_available":
        $vehicle_id=$_GET["vehicle_id"];
        $vehicle_id=base64_decode($vehicle_id);
        $vehicleObj->setVehicleAvailable($vehicle_id);
        $msg= "Vehicle Availabled!";
        $msg= base64_encode($msg);

        ?>
      <script>
        window.location="../view/view_vehicles.php?msg=<?php echo $msg; ?>";
    </script>
    <?php



        break;


         case "set_maintenance":
        $vehicle_id=$_GET["vehicle_id"];
        $vehicle_id=base64_decode($vehicle_id);
        $vehicleObj->setVehicleMaintenance($vehicle_id);
        $msg= "Vehicle set to maintenance!";
        $msg= base64_encode($msg);

        ?>
      <script>
        window.location="../view/view_vehicles.php?msg=<?php echo $msg; ?>";
    </script>
    <?php



        break;


        case "update_vehicle":

        $vehicle_id = $_POST["vehicle_id"];
        $vehicle_number =$_POST["vehicle_number"];
        $vehicle_type =$_POST["vehicle_type"];
        $vehicle_capacity =$_POST["vehicle_capacity"];
        $vehicle_district =$_POST["vehicle_district"];
        $vehicle_location =$_POST["vehicle_location"];
        
        
        try {

            $vehicleObj->updatevehicle($vehicle_id,$vehicle_number,$vehicle_type, $vehicle_capacity,$vehicle_district,$vehicle_location);
           
            $msg = "$vehicle_number  Successfully Updated!";
            $msg = base64_encode($msg);
            $vehicle_id = base64_encode($vehicle_id);
            ?>
            <script>
                window.location = "../view/view_vehicles.php?vehicle_id=<?php echo $vehicle_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            
            ?>
            <script>
                window.location = "../view/edit_vehicles.php?customer_id=<?php echo $vehicle_id; ?>&msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;

}