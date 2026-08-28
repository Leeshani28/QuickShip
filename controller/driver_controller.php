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

 include '../model/delivery_model.php';
 include '../model/driver_model.php';
 
 $deliveryObj = new Delivery();
 $driverObj = new Driver();

 switch($status){

 case "add_driver":
        
        $driver_categary = $_POST["driver_categary"];
        $driver_name = $_POST["driver_name"];
        $driver_nic = $_POST["driver_nic"];
        $driver_date_of_birth = $_POST["driver_date_of_birth"];
        $license_number = $_POST["license_number"];
        $license_expiry_date = $_POST["license_expiry_date"];
        $driver_phone_number  = $_POST["driver_phone_number"];
        $driver_address  = $_POST["driver_address"];
        $driver_district  = $_POST["driver_district"];
        $driver_profile_picture= $_FILES["driver_profile_picture"];
try{
    
    ///  uploading image
    $file_name="";
    if (isset($_FILES["driver_profile_picture"])) {
                if ($driver_profile_picture["name"] != "") {
                    $file_name = time() . "_" . $driver_profile_picture["name"];
                    $path = "../images/courier_images/$file_name";
                    move_uploaded_file($driver_profile_picture["tmp_name"], $path);
                }
            }
       $driver_id = $driverObj->addDriver($driver_categary,$driver_name,$driver_nic,$driver_date_of_birth,$license_number,$license_expiry_date,$driver_phone_number,$driver_address,$driver_district,$file_name);
    
     ///  creating a login account
    //  if($user_id>0)
    //  {
    //      $loginObj->addUserLogin($user_id, $email, $nic);

         $msg= "Driver $driver_name Successfully Added!!";
        $msg= base64_encode($msg);

     ?>

    <script>
        window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
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


case "set_available":
        $driver_id=$_GET["driver_id"];
        $driver_id=base64_decode($driver_id);
        $driverObj->setDriverAvailable($driver_id);
        $msg= "Driver Availabled!";
        $msg= base64_encode($msg);

        ?>
      <script>
        window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
    </script>
    <?php



        break;

case "set_unavailable":
        $driver_id=$_GET["driver_id"];
        $driver_id=base64_decode($driver_id);
        $driverObj->setDriverUnavailable($driver_id);
        $msg= "Driver Unavailabled!";
        $msg= base64_encode($msg);

        ?>
      <script>
        window.location="../view/view_drivers.php?msg=<?php echo $msg; ?>";
    </script>
    <?php



        break;


case "update_driver":
        $driver_id = $_POST["driver_id"];
        $driver_categary = $_POST["driver_categary"];
        $driver_name = $_POST["driver_name"];
        $driver_nic = $_POST["driver_nic"];
        $driver_date_of_birth = $_POST["driver_date_of_birth"];
        $license_number = $_POST["license_number"];
        $license_expiry_date = $_POST["license_expiry_date"];
        $driver_phone_number  = $_POST["driver_phone_number"];
        $driver_address  = $_POST["driver_address"];
        $driver_district  = $_POST["driver_district"];
        $driver_location  = $_POST["driver_location"];
        $driver_profile_picture= $_FILES["driver_profile_picture"];

                try{
                    
                    $driverResult = $driverObj->getDriver($driver_id);
                    $driverrow = $driverResult->fetch_assoc();
                    $prev_image=$driverrow["driver_profile_picture"];

                    if(isset($_FILES["driver_profile_picture"]))
                    {
                        if($_FILES["driver_profile_picture"]["name"]!="")
                        {
                            // upload new image

                            $img=time()."_".$_FILES["driver_profile_picture"]["name"];
                            $path="../images/courier_images/";
                            move_uploaded_file($_FILES["driver_profile_picture"]["tmp_name"],$path."$img");

                            ///remove previous image
                        if(file_exists($path.$prev_image) && $prev_image!=""){
                            unlink($path.$prev_image);

                        }
                    }
                        else{
                            $img=$prev_image;
                        }

                        }  
                    $driverObj->updateDriver($driver_id,$driver_categary,$driver_name,$driver_nic,$driver_date_of_birth,$license_number,$license_expiry_date,$driver_phone_number,$driver_address,$driver_district,$driver_location,$img);

                    $msg = "$driver_name Successfully Updated!";
                    $msg = base64_encode($msg);
                ?>
                    <script>
                        window.location = "../view/view_drivers.php?msg=<?php echo $msg; ?>";
                    </script>
                <?php
                }
                    catch(Exception $ex)
                {
                    $msg= $ex->getMessage();
                    $msg= base64_encode($msg);
                    ?>
                      <!-- <script>
                        window.location="../view/edit_driver.php?msg=<?php echo $msg; ?>";
                    </script> -->
                    <?php
                    
                }

            break;


 }