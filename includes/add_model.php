<style>
  /*To clear the arrow sign that comes with the number type in Chrome, Safari, Edge, Opera */ 
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
  }

  /*For those using Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>

<!--To check the length of the numbers inputted
<script>
  if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);
</script>-->
<!-- Add -->
<div class="modal" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Add New User</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="add.php" enctype="multipart/form-data">
                
                    <div class = "form-group row">
                        <label for="username" class="col-sm-3 control-label">User Name</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" placeholder = "Enter full name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 control-label">E-Mail</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder = "Someone@gmail.com" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-sm-3 control-label">Position</label>

                        <div class="col-sm-9">
                        <select class="form-control" id="position" name="position">
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
