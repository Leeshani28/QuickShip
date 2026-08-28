<?php 
include_once '../commons/db_connection.php';

$dbcon = new DbConnection();

class vehicle{

public function addVehicle($vehicle_number,$vehicle_type,$vehicle_capacity,$vehicle_district)
    {

        $con = $GLOBALS["con"];
        $sql = "INSERT INTO vehicle (vehicle_number,vehicle_type,vehicle_capacity,vehicle_district,vehicle_location) VALUES ('$vehicle_number','$vehicle_type','$vehicle_capacity','$vehicle_district','$vehicle_district')";
        $con->query($sql) or die($con->error);
        $vehicle_id  = $con->insert_id;
        return $vehicle_id ;

    }

    public function checkVehicleNumberExist($vehicle_number)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS total FROM vehicle WHERE vehicle_number='$vehicle_number'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


public function getAllVehicles($vehicle_location){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM vehicle v
         LEFT JOIN branch b ON v.vehicle_district = b.branch_id WHERE vehicle_district = '$vehicle_location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

public function setVehicleAvailable($vehicle_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE vehicle SET vehicle_status = 'Available' WHERE vehicle_id ='$vehicle_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

public function setVehicleMaintenance($vehicle_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE vehicle SET vehicle_status = 'Maintenance' WHERE vehicle_id ='$vehicle_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


public function getVehicle($vehicle_id){
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM vehicle WHERE vehicle_id='$vehicle_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}



public function updatevehicle($vehicle_id,$vehicle_number,$vehicle_type, $vehicle_capacity, $vehicle_district, $vehicle_location){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE vehicle SET vehicle_number='$vehicle_number',vehicle_type='$vehicle_type',vehicle_capacity='$vehicle_capacity',vehicle_district='$vehicle_district',vehicle_location='$vehicle_location' WHERE vehicle_id='$vehicle_id'";
        $con->query($sql) or die($con->error);
    }

    public function getAllAvailableVehicles($location){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM vehicle v
         LEFT JOIN branch b ON v.vehicle_district = b.branch_id WHERE vehicle_status = 'Available' AND vehicle_location = '$location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

    //for reports

    public function getVehicleStatusSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT vehicle_status,
                   
                   COUNT(vehicle_id) AS total_vehicles
            FROM vehicle
            GROUP BY vehicle_status
            ORDER BY vehicle_status";

    return $con->query($sql);
}

public function getVehiclesByDistrictReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                b.branch_name,
                COUNT(v.vehicle_id) AS total_vehicles
            FROM vehicle v
            INNER JOIN branch b
                ON v.vehicle_district = b.branch_id
            GROUP BY v.vehicle_district
            ORDER BY b.branch_name ASC";

    return $con->query($sql);
}

public function getVehicleType()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT vehicle_type,
                   
                   COUNT(vehicle_id) AS total_vehicles
            FROM vehicle
            GROUP BY vehicle_type
            ORDER BY vehicle_type";

    return $con->query($sql);
}

public function getMaintenanceVehicles()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                vehicle_number,
                vehicle_type,
                vehicle_capacity,
                branch_name
            FROM vehicle v
            INNER JOIN branch b
                ON v.vehicle_district = b.branch_id
            WHERE v.vehicle_status='Maintenance'
            ORDER BY b.branch_name, v.vehicle_number";

    return $con->query($sql);
}

//landing page summary cards

public function getTotalVehicles($vehicle_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(vehicle_id )as total_count FROM vehicle WHERE vehicle_district = '$vehicle_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getAvailableVehicles($vehicle_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(vehicle_id )as available_count FROM vehicle WHERE  vehicle_status = 'Available' AND vehicle_district = '$vehicle_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getUnderMaintenanceVehicles($vehicle_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(vehicle_id )as maintenance_count FROM vehicle WHERE  vehicle_status = 'Maintenance' AND vehicle_district = '$vehicle_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    //for charts

    public function getVehicleStatusSummaryChart($vehicle_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                vehicle_status,
                COUNT(vehicle_id) AS total_vehicles_chart
            FROM vehicle
            WHERE vehicle_district = '$vehicle_location'
            GROUP BY vehicle_status
            ORDER BY total_vehicles_chart DESC";

    return $con->query($sql);
}



}
?>