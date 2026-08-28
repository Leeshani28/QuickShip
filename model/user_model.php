<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class User{

    public function getAllRoles(){

        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM role";

        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function getRoleModules($roleId){
        
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM role_module r, module m WHERE r.module_id = m.module_id AND r.role_id='$roleId'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
    
    public function getModuleFunctions($moduleId){
        
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM function WHERE module_id='$moduleId'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

    public function checkEmailExist($email)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS total FROM user WHERE user_email='$email'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function checkNICExist($nic)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(*) AS total FROM user WHERE user_nic='$nic'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function addUser($fname,$lname,$email,$dob,$nic,$user_role,$district_id,$user_image){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO user(user_fname,user_lname,user_email,user_dob,user_nic,user_role,user_location,user_image)VALUES('$fname','$lname','$email','$dob','$nic','$user_role','$district_id','$user_image')";
        $con->query($sql) or die($con->error);
        $user_id=$con->insert_id;
        return $user_id;
    }

    public function addUserFunctions($user_id,$fun_id){
       
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO function_user(user_id,fun_id)VALUES('$user_id','$fun_id')";
        $con->query($sql) or die($con->error);
        
    }


    public function removeUserFunctions($user_id)
    {
        $con = $GLOBALS["con"];
        $sql = "DELETE FROM function_user WHERE user_id = '$user_id'";
        $result = $con->query($sql) or die($con->error);
    }


    public function getAllUsers(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM user WHERE user_status !=-1";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
    public function getBranchUsers($user_location){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM user WHERE user_status !=-1 AND user_location = '$user_location'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }

    public function getAllUsersForReports(){
       
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM user u
        LEFT JOIN role r ON u.user_role = r.role_id 
        WHERE user_status !=-1";
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }


    public function activateUser($user_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE user SET user_status='1' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function deactivateUser($user_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE user SET user_status='0' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


    public function deleteUser($user_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE user SET user_status='-1' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        
    }
    

    // for view_user
    public function getUser($user_id){
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM user u,role r,branch b WHERE u.user_role=r.role_id AND u.user_location=b.branch_id AND user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;

        
    }


    // public function getUserForReport($user_id){
    //     $con=$GLOBALS["con"];
    //     $sql = "SELECT * FROM user u,role r,district d,user_contact uc WHERE u.user_role=r.role_id AND u.user_location=d.district_id AND u.user_id=uc.user_id AND user_id='$user_id'";
    //     $result = $con->query($sql) or die($con->error);
    //     return $result;

        
    // }
    
    

    public function getUserFunctions($user_id){
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM function_user WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;

        
    }
    
    

    public function addUserContact($user_id,$contact_no){
        $con=$GLOBALS["con"];
        $sql = "INSERT INTO user_contact(contact_number,user_id)VALUES('$contact_no','$user_id')";
        $result = $con->query($sql) or die($con->error);
        
        

        
    }



    public function getUserContact($user_id){
        $con=$GLOBALS["con"];
        $sql = "SELECT * FROM user_contact WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
        

        
    }


    public function updateUser($fname,$lname,$email,$dob,$nic,$user_role,$district_id,$user_image,$user_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE user SET user_fname='$fname',user_lname='$lname',user_email='$email',user_dob='$dob',user_nic='$nic',user_image='$user_image',user_location='$district_id',user_role='$user_role' WHERE user_id='$user_id'";
        $con->query($sql) or die($con->error);
    }

    public function updateLogin($email,$nic,$user_id){
       
        $con=$GLOBALS["con"];
        $pw = sha1($nic);
        $sql = "UPDATE login SET login_username='$email',login_password='$pw' WHERE user_id='$user_id'";
        $con->query($sql) or die($con->error);
    }

    public function removeUserContacts($user_id){
        $con=$GLOBALS["con"];
        $sql = "DELETE FROM user_contact WHERE user_id='$user_id'";
        $result = $con->query($sql) or die($con->error);
        
    }


     public function getActiveUserCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(user_id)as user_count FROM user WHERE user_status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }

    public function getDeActiveUserCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(user_id)as user_count FROM user WHERE user_status=0;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }
    public function getAllUserCount()
    {
        $con=$GLOBALS["con"];
        $sql = "SELECT COUNT(user_id)as user_count FROM user;";
        $result = $con->query($sql) or die($con->error);
        return $result;


    }


    

}       
    


    


