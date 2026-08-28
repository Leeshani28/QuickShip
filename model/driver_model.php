<?php 

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Driver{

 public function addDriver($driver_categary,$driver_name,$driver_nic,$driver_date_of_birth,$license_number,$license_expiry_date,$driver_phone_number,$driver_address,$driver_district,$driver_profile_picture){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO driver(driver_categary,driver_name,driver_nic,driver_date_of_birth,license_number,license_expiry_date,driver_phone_number,driver_address,driver_district,driver_location,driver_profile_picture)VALUES('$driver_categary','$driver_name','$driver_nic','$driver_date_of_birth','$license_number','$license_expiry_date','$driver_phone_number','$driver_address','$driver_district','$driver_district','$driver_profile_picture')";
        $con->query($sql) or die($con->error);
        $driver_id=$con->insert_id;
        return $driver_id;
    }

public function getAllDrivers(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM driver dr
         LEFT JOIN branch b ON dr.driver_district = b.branch_id ";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
public function getAllRiders(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM driver dr
         LEFT JOIN branch b ON dr.driver_district = b.branch_id WHERE driver_categary = 'Rider'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
public function getAllAvailableDrivers($location){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM driver dr
         LEFT JOIN branch b ON dr.driver_district = b.branch_id WHERE driver_status = 'Available' AND driver_categary = 'Driver' AND driver_location = '$location' ";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

public function setDriverAvailable($driver_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE driver SET driver_status = 'Available' WHERE driver_id ='$driver_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

public function setDriverUnavailable($driver_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE driver SET driver_status = 'Unavailable' WHERE driver_id ='$driver_id'";
        $result = $con->query($sql) or die($con->error);
        
    }

public function getDriver($driver_id){
    $con = $GLOBALS["con"];
    $sql = "SELECT * FROM driver dr
         LEFT JOIN branch b ON dr.driver_district = b.branch_id WHERE driver_id='$driver_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

public function updateDriver($driver_id,$driver_categary,$driver_name,$driver_nic,$driver_date_of_birth,$license_number,$license_expiry_date,$driver_phone_number,$driver_address,$driver_district,$driver_location,$driver_profile_picture){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE driver SET driver_categary='$driver_categary',driver_name='$driver_name',driver_nic='$driver_nic',driver_date_of_birth='$driver_date_of_birth',license_number='$license_number',license_expiry_date='$license_expiry_date',driver_phone_number='$driver_phone_number',driver_address='$driver_address',driver_district='$driver_district',driver_location='$driver_location',driver_profile_picture='$driver_profile_picture' WHERE driver_id='$driver_id'";
        $con->query($sql) or die($con->error);
    }


//for reports

public function getDriverStatusSummary()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT driver_status,
                   
                   COUNT(driver_id  ) AS total_drivers
            FROM driver
            GROUP BY driver_status
            ORDER BY driver_status";

    return $con->query($sql);
}

public function getDriversByDistrictReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                b.branch_name,
                COUNT(dr.driver_id) AS total_drivers
            FROM driver dr
            INNER JOIN branch b
                ON dr.driver_district = b.branch_id
            GROUP BY dr.driver_district
            ORDER BY b.branch_name ASC";

    return $con->query($sql);
}

public function getDriverCategory()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT driver_categary,
                   
                   COUNT(driver_id) AS total_drivers
            FROM driver
            GROUP BY driver_categary
            ORDER BY driver_categary";

    return $con->query($sql);
}

public function getDriverContactReport()
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                dr.driver_id,
                dr.driver_name,
                dr.driver_phone_number,
                dr.driver_categary,
                dr.driver_status,
                b.branch_name
            FROM driver dr
            INNER JOIN branch b
                ON dr.driver_district = b.branch_id
            GROUP BY dr.driver_id
            ORDER BY dr.driver_id ASC";

    return $con->query($sql);
}


public function getDriverContact($driver_id){
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM driver dr,district d WHERE dr.driver_district = d.district_id AND driver_id='$driver_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;

        
    }

    //for landing page summary cards

    public function getTotalDrivers($driver_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(driver_id )as total_count FROM driver WHERE driver_district = '$driver_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getAvailableDrivers($driver_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(driver_id )as available_count FROM driver WHERE  driver_status = 'Available' AND driver_district = '$driver_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getUnavailableDrivers($driver_district)
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(driver_id )as unavailable_count FROM driver WHERE  driver_status = 'Unavailable' AND driver_district = '$driver_district'";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    //for driver charts

    public function getDriverStatusSummaryChart($driver_location)
{
    $con = $GLOBALS["con"];

    $sql = "SELECT
                driver_status,
                COUNT(driver_id) AS total_drivers_chart
            FROM driver
            WHERE driver_district = '$driver_location'
            GROUP BY driver_status
            ORDER BY total_drivers_chart DESC";

    return $con->query($sql);
}



}
?>