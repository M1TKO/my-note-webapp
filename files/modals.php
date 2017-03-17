<!-- Modal change username-->
    <div class="modal fade" id="myModalName" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change your username</h4>
        </div>
        <div class="modal-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <!-- <div class="form-group">
                    <input type="text" name="old_username" placeholder="Old username" class="form-control">
                </div> -->
                <div class="form-group">
                    <input type="text" name="new_username" placeholder="New username" class="form-control">
                </div>
                <input type="submit" name="change_username" value="Change" class="btn btn-info">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!-- Modal change password -->
    <div class="modal fade" id="myModalPass" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change your password</h4>
        </div>
        <div class="modal-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group">
                    <input type="text" name="new_pass" placeholder="New password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="new_pass_conf" placeholder="Confirm new password" class="form-control">
                </div>
                <input type="submit" name="change_password" value="Change" class="btn btn-info">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

