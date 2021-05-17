
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <div class="col-md-12">
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th>USERNAME</th>
                  <th>NAME</th>
                  <th>MOBILE NO</th>
                  <th>E-MAIL</th>
                  <?php if(has_permission($this->session->userdata('user_info')['id'],'manage user status')){?>
                  <th class="text-center">STATUS</th>
                  <?php }else{} ?>
                  <th class="text-center">RESET PASSWORD</th>
                </tr>
              </thead>     
              <?php 
              
              foreach ($result as $row){
                $username = $row->username;   
                $fullname = $row->firstname.' '.$row->lastname;
                $mobileno = $row->mobileno;
                $email = $row->email;
                $userid = $row->id;
                $url = base_url().'edit_user/'.$userid;
              ?>
                <tr>
                  <td><a href='<?=$url?>'><i class='icon wb-edit' aria-hidden='true' ><?=$username?></a></td>
                  <td><?=$fullname?></td>
                  <td><?=$mobileno?></td>
                  <td><?=$email?></a></td>
                  <?php if(has_permission($this->session->userdata('user_info')['id'],'manage user status')){?>
                    <?php if($row->account_status == "1"){  ?>
                
                        <td><label class="switch"><input id = "<?=$row->id;?>" type="checkbox" checked onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                        
                    <?php }else{ ?>
                        
                        <td><label class="switch"><input id = "<?=$row->id;?>" type="checkbox" onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                        
                    <?php } ?>
                    <?php }else{} ?>
                    <td class="text-center">
                      <form method="post" action="<?=base_url()?>Users/resend_user_sms">
                        <input type="hidden" name="number" value="<?= $row->mobileno ?>">
                        <input type="hidden" name="username" value="<?=  $row->username?>">
                        <input type="hidden" name="id" value="<?=  $row->id?>">
                        <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                      </form>
                    </td>
                </tr>
              <?php } ?>
                                     
          </table>
        </div>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  


 
  