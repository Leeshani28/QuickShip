<?php

include '../commons/db_connection.php';

$dbcon = new DbConnection();

class Module{

    function getAllModules(){
        $conn=$GLOBALS["con"];
        $sql="SELECT * FROM module";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
    }


    public function getRoleModules($role_id) {
        $conn=$GLOBALS["con"];
        $sql="SELECT * FROM role_module r,module m WHERE m.module_id=r.module_id AND r.role_id='$role_id'";
        $result = $conn->query($sql) or die($conn->error);
        return $result;
       
    }
}
