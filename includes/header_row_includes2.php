
<div class="row" style="height:50px;"></div>

<div class="row" style="height:100px; display:flex; align-items:center;">

    <!-- Logo -->
    <div class="col-md-3" style="display:flex; align-items:center;">
        <a href="dashboard_new.php">
            <img src="../images/logo2new.png" style="width:180px; height:auto;" />
        </a>
    </div>

    <!-- Page Title -->
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
            <div class="bg-info"><b><?php echo ucwords($userrow["branch_name"]); ?></b></div>
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