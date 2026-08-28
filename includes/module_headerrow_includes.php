<div class="row" style="margin: 10px; background-color: #353535; height: 80px; border-radius: 10px;">
  
  <!-- Left side -->
  <div class="col-md-10" style="display: table; height: 80px;">
    <label style="display: table-cell; vertical-align: middle; font-size: 35px; color:white;">
      USER MANAGEMENT
    </label>
  </div>

  <!-- Right side -->
  <div class="col-md-2" style="display: table; height: 80px; text-align: right;">
    <div style="display: table-cell; vertical-align: middle;">
      <i class="bi bi-person-circle" style="font-size: 25px; margin-right: 5px;"></i>
      <?php echo ucwords($userrow["user_fname"] . " " . $userrow["user_lname"]); ?>
    </div>
  </div>

</div>
