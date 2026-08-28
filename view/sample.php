<a href = "#" data-toggle="modal" data-target="#myModal" class="btn btn-success" onclick="loaduser('<?php echo $shipment_id; ?>');"><span class="glyphicon glyphicon-ok"></span>&nbsp;Confirm</a>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4>Are you sure</h4>
        </div>
        <div class="modal-body">
        
            
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="../controller/user_controller.php?status=delete&user_id=<?php echo $user_id; ?>" class="btn btn-danger">
                                            
                                            &nbsp;
                                            Delete
                                        </a>
                </div>
            </div>
           
           
        

        </div>
        

      </div>
      
    </div>
  </div>


  <script src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/datatable/datatables.js"></script>

  <script>
        $(document).ready(function(){
            $("#usertable").DataTable();

            




        });

        function loaduser(user_id)
            {
                // alert(user_id);

                var role_id=$("#user_role").val();
                var url ="../controller/user_controller.php?status=load_users";
        
                $.post(url,{user_id:user_id},function(data){
                    $("#display_data").html(data).show();
                });




            }
    </script>