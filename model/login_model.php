<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Login{

public function validateUser($login_username,$login_password){

    $con=$GLOBALS["con"];
    $login_password=sha1($login_password);
    $sql = "SELECT u.user_id, u.user_role, r.role_name, u.user_fname, u.user_lname, u.user_location, u.user_status, b.branch_name FROM user u, login l, role r, branch b
            WHERE u.user_id=l.user_id AND  r.role_id =u.user_role AND u.user_location = b.branch_id
            AND l.login_username='$login_username' AND l.login_password='$login_password'";

    $result = $con->query($sql) or die($con->error);
    return $result;
}
public function validateDriver($login_username,$login_password){

    $con=$GLOBALS["con"];
    $sql = "SELECT * FROM driver d , branch b
            WHERE d.driver_district=b.branch_id AND d.license_number='$login_username' AND d.driver_nic='$login_password'";

    $result = $con->query($sql) or die($con->error);
    return $result;
}

public function addUserLogin($user_id, $user_email,$nic) {
    $con=$GLOBALS["con"];
    $pw = sha1($nic);
    $sql="INSERT INTO login(login_username,login_password,user_id)"
            . "VALUES('$user_email','$pw','$user_id')";
     $result = $con->query($sql) or die($con->error);
}

public function getAllBranchAdmin(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM branch WHERE branch_status = 'Active'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

    public function switchBranch($district_id, $user_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE user SET user_location = '$district_id' WHERE user_id = '$user_id'";
        $con->query($sql) or die($con->error);
               
    }
    
    public function getUserById($user_id){
       
         $con=$GLOBALS["con"];
    $sql = "SELECT * FROM user u, login l, role r, district d
            WHERE u.user_id=l.user_id AND  r.role_id =u.user_role AND u.user_location = d.district_id
            AND u.user_id = '$user_id'";

    $result = $con->query($sql) or die($con->error);
    return $result;
        
        
    }

    public function checkBranchStatus($branch){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT branch_status FROM branch WHERE branch_id = '$branch'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }






}