<div class="row" style="height:50px;"></div>

<div class="row" style="height:100px; display:flex; align-items:center;">

    <!-- Logo -->
    <div class="col-md-3" style="display:flex; align-items:center;">
        <a href="dashboard_new.php">
            <img src="../images/logo2new.png" style="width:180px; height:auto;" />
        </a>
    </div>

    <!-- Page Title -->
    <!-- <div class="col-md-6" style="display:flex; justify-content:center; align-items:center;">
        <div class="row">
            <h1 style="margin:0; font-size:32px; font-weight:600; color:#333;">
            <?php echo $pageName; ?>
            </h1>
        </div>
        <div>
            &nbsp;
        </div>
        <div class="row">
           <h2><?php echo ucwords($userrow["role_name"]); ?></h2> 

        </div>
        
    </div> -->

    <div class="col-md-6">
    <div class="col-md-12 text-center">

        <h1 style="margin-bottom:5px; font-weight:bold;">
            <?php echo $pageName; ?>
        </h1>

        <p style="margin:0; font-size:18px; color:#666;">
            <?php echo $userrow["role_name"]; ?>
        </p>

    </div>
</div>

    <!-- User Info + Logout -->
    <div class="col-md-3" style="display:flex; justify-content:flex-end; align-items:center; gap:15px;">

        <!-- User Icon -->
        <div style="font-size:28px; color:#000;">
            <i class="bi bi-person-circle"></i>
        </div>

        <!-- User Name -->
        <div style="font-weight:500; font-size:16px; color:#333;">
            <?php echo ucwords($userrow["user_fname"] . " " . $userrow["user_lname"]); ?>
            <form action="../controller/login_controller.php?status=switch_login" method="post">
                <input type="hidden" name="user_id" value="<?php echo $userrow["user_id"]; ?>">
                <select name="district_id" id="district_id" class="form-control custom-dropdown">
                    <?php
                    include_once '../model/login_model.php';
                    $loginObj = new Login();
                    $branchResult = $loginObj->getAllBranchAdmin();
                    while ($branchRow = $branchResult->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $branchRow["branch_id"]; ?>" <?php

                           if ($branchRow["branch_id"] == $userrow["user_location"]) {
                               ?> selected <?php
                           }
                           ?>>
                            <?php echo $branchRow["branch_name"]; ?>
                        </option>
                        <?php
                    }
                    ?>

                </select>

               <input type="submit" class="btn btn-success" value="Switch" />
            </form>
        </div>

        <!-- Logout Button -->
        <a href="../controller/login_controller.php?status=logout" class="btn btn-danger"
            style="padding:6px 16px; font-size:14px;">
            Logout
        </a>

    </div>

</div>

<hr style="border-top:2px solid #ddd; margin:10px 0;" />