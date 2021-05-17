<div class="row">
    <div class="col-md-6">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <div class="col-md-12">
            <form autocomplete="off" method="post" action="<?=base_url()?>Users/process_change_password">
            <div class="form-group row">
              <div class="col-sm-12 hidden">
                <label class="control-label text-sm-right pt-2"><strong>Real password:</strong></label>
                <input type="password" class="form-control" value="<?= $this->encryption->decrypt($this->session->userdata('user_info')['password'])?>" id="real_password" name="real_password" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="control-label text-sm-right pt-2"><strong>Old Password:</strong></label>
                <input class="form-control" onkeyup="old()" type="password" id="old_password" name="old_password" required>
                <span class="badge badge-danger" id="unmatch"></span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="control-label text-sm-right pt-2"><strong>New Password:</strong></label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="control-label text-sm-right pt-2"><strong>Confirm New Password:</strong></label>
                <input class="form-control" onkeyup="confirm()" type="password" id="confirm_new_password" name="confirm_new_password" required>
                <span class="badge badge-danger" id="error"></span>
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                <div class="col-sm-4 pull-right">
                    <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Change Password" id="submit" type="submit">
                </div>
            </div>
          </div>
        </form>
        </div>
      </section>
    </div>
  </div>
  <script>
    function confirm(){
        var newpass = document.getElementById('new_password').value;
        var cnewpass = document.getElementById('confirm_new_password').value;
        
        if(newpass !== cnewpass){
            document.getElementById('error').innerHTML = "Sorry the passwords dont match";
            document.getElementById('submit').disabled = true;
        }else{
            document.getElementById('error').innerHTML = "";
            document.getElementById('submit').disabled = false;
        }
    }
    
    function old(){
        var realpass = document.getElementById('real_password').value;
        var oldpass = document.getElementById('old_password').value;
        
        if(realpass !== oldpass){
            document.getElementById('unmatch').innerHTML = "Sorry old password is wrong.";
            document.getElementById('submit').disabled = true;
        }else{
            document.getElementById('unmatch').innerHTML = "";
            document.getElementById('submit').disabled = false;
        }
    }
</script>