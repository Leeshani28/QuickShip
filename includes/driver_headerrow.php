
<div class="row" style="height:50px;"></div>

<div class="row" style="height:100px; display:flex; align-items:center;">

    <!-- Logo -->
    <div class="col-md-3" style="display:flex; align-items:center;">
        
            <img src="../images/logo2new.png" style="width:180px; height:auto;" />
        
    </div>

    <!-- Page Title -->
    <div class="col-md-6" style="display:flex; justify-content:center; align-items:center;">
        <h1 style="margin:0; font-size:32px; font-weight:600; color:#333;">
            <?php echo $pageName; ?>
        </h1>
    </div>

    <!-- User Info + Logout -->
    <div class="col-md-3" style="display:flex; justify-content:flex-end; align-items:center; gap:15px;">

        <!-- User Icon -->
        <div style="font-size:28px; color:#000;">
            <i class="bi bi-person-circle"></i>
        </div>

        <!-- User Name -->
        <div style="font-weight:500; font-size:16px; color:#333;">
            <?php echo ucwords($driverrow["driver_name"]); ?>
            <div class="bg-info"><b><?php echo ucwords($driverrow["branch_name"]); ?></b></div>
        </div>

        <!-- Logout Button -->
        <a href="../controller/login_controller.php?status=logout" 
           class="btn btn-danger" 
           style="padding:6px 16px; font-size:14px;">
            Logout
        </a>
    </div>

</div>

<hr style="border-top:2px solid #ddd; margin:10px 0;" />