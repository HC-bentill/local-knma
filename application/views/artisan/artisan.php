
  <!-- Page -->
  <div class="page animsition" id = "something">
       
    <div class="page-content container-fluid">
    
      <div class="row agent_form" style="display: none;">
        <div class="col-md-12">
          
          <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
            <div class="panel-heading">
              <h3 class="panel-title">
              		Client Details		
              </h3>
              
               <div class="page-header-actions">
				
      			</div>
            </div>
            
          </div>
          <!-- End Panel Standard Mode -->
        </div>

        
      </div>
      
      
      
      
      	<div class="panel" style="min-height: 70px;" >
          		<div class="col-sm-6" >
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-user-add" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Add New</span>
                </button>
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-print" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Print</span>
          			</button>
				</div>      			
	  	</div>    
      <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
           <div class="panel-body container-fluid" id="loaddata">
            <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
              
                <thead>
                  <tr>
                    <th><b>Name</b></th>
                    <th><b>Phone no</b></th>
                    <th><b>ID Type</b></th>
                    <th><b>ID Number</b></th>
                    <th><b>E-mail</b></th>
                    <th><b>Account Status</b></th>
            				<th><b>View</b></th>
                  </tr>
          			</thead>      
                <?php foreach($result as $row): ?>
                  <tr>
                    <td><?= $row->firstnames.' '.$row->lastname; ?></td>
                    <td><?= $row->phone;?></td>
                    <td><?= $row->id_type;?></td>
                    <td><?= $row->id_num?></td>
                    <td><?= $row->email; ?></td>
                    <?php if($row->accact == 'P'){?>
                      <td><span class="label label-warning" Onclick="edit(<?=$row->artid;?>)">Pending</span></td>
                    <?php }elseif($row->accact == 'A'){?>
                      <td><span class="label label-success" Onclick="edit(<?=$row->artid;?>)">Approved</span></td>
                    <?php }elseif($row->accact == 'R'){?>
                      <td><span class="label label-danger" Onclick="edit(<?=$row->artid;?>)">Rejected</span></td>
                    <?php };?>
                    <td><a href="<?=base_url()?>view_member/<?=$row->artid;?>"><i class='icon wb-eye' aria-hidden='true' ></i></a></td>
                  </tr>
                <?php endforeach;?>
            </table>
        </div>
        
     
	   </div>
	   </div>
		</div>
      </div>
    </div>
  </div>


         <!-- modal        -->
   <div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge"
                  role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="exampleOptionalLarge">Artisan Form</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="Artisan/add_artisan" autocomplete="off" enctype="multipart/form-data">
                                  <div class="row">
                                      <div class="col col-md-6">

                                          <script type="text/javascript">
                                              function userImg(input) {
                                                  if (input.files && input.files[0]) {
                                                      var reader = new FileReader();
                                                      reader.onload = function(e) {
                                                          $('#user_img')
                                                              .attr('src', e.target.result);
                                                      };
                                                      reader.readAsDataURL(input.files[0]);
                                                  }
                                              }
                                          </script>
                                          <div class="">
                                              <div class="">
                                                  <img src="<?php echo base_url();?>upload/user-avatar.png" id="user_img" class="thumbnail" width="120" height="100">
                                                  <div style="margin-top: -1em;">
                                                      <input name="userfile" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                              <div class="col-sm-12">
                                                <label class="control-label">Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                             </div>
                                          </div>
                                      </div>
                                      <div class="col col-md-6">
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="fn" type="text" required/>
                                                <label class="floating-label">First Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="ln" type="text"  required/>
                                                <label class="floating-label">Last Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col col-md-12">
                                                <input class="form-control calender" name="dob" type="text"  required/>
                                                <label class="floating-label">Date Of Birth</label>
                                            </div>
                                          </div>
                                      </div>
                               </div>
                                <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <input class="form-control" name="phone" type="text"/>
                                                <label class="floating-label">Phone</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="location" type="text"/>
                                                <label class="floating-label">Physical Location</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <input class="form-control" name="buisname" type="text"/>
                                                <label class="floating-label">Buisness Name</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="offloc" type="text"/>
                                                <label class="floating-label">Office Location</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <select class="form-control" name="idtype">
                                                <option value="VOTERS ID">VOTERS ID</option>
                                                <option value="NHIS">NHIS</option>
                                                <option value="NATIONAL ID">NATIONAL ID</option>
                                            </select>
                                             <label class="floating-label">ID Type</label>
                                        </div><!-- /.form-group -->
                                         <div class="col-sm-6">
                                                <input class="form-control" name="idnum" type="text"/>
                                                <label class="floating-label">ID Number</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <label class="control-label">E-mail</label>
                                                <input class="form-control" name="email" type="text"/>
                                                
                                        </div>
                                        <div class="col col-md-6">
                                          <label class="control-label">Payment Mode</label>
                                            <select class="form-control" id="payla" name="paymod">
                                                <option value="Mobilemoney">Mobilemoney</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                             
                                        </div>

                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group form-material floating row" id="momome">
                                        <div class="col col-md-12">
                                            <input class="form-control" name="momono" type="text" />
                                            <label class="floating-label">Mobilemoney Number</label>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row" id="bankme" style="display: none;">
                                         <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <select class="form-control" name="bank">
                                              <?php foreach ($bank as $b): ?>
                                                 <option value="<?=$b->bankid?>"><?=$b->bankname?></option>
                                              <?php endforeach ?>  
                                            </select>
                                             <label class="floating-label">Bank Branch</label>
                                        </div><!-- /.form-group -->
                                         <div class="col-sm-6">
                                                <input class="form-control" name="bankaccno" type="text"/>
                                                <label class="floating-label">Bank Account Number</label>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                         <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <select class="form-control" name="job">
                                                <?php foreach ($job as $j): ?>
                                                  <option value="<?=$j->jobid?>"><?=$j->job_title?></option>
                                                <?php endforeach ?>  
                                            </select>
                                             <label class="floating-label">Job Description</label>
                                        </div><!-- /.form-group -->
                                         <div class="col-sm-6">
                                              <select class="form-control" name="accstatus">
                                                <option value="A">Approve</option>
                                                <option value="P">Pending</option>
                                              </select>
                                             <label class="floating-label">Account Status </label>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                             
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Save</button>
                      </div>
                  </div>
                </form>
              </div>
          </div>


              <!-- modal        -->
        <div class="modal fade exampl-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge"
                  role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="exampleOptionalLarge">Confirmation Form</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="Artisan/confirm_artisan" autocomplete="off" enctype="multipart/form-data">
                                 <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-12">
                                            <select class="form-control" id="accart" name="accstatus">
                                                <option value="P">Pending</option>
                                                <option value="A">Approve</option>
                                                <option value="R">Reject</option>
                                            </select>
                                             <label class="floating-label">Account Status</label>
                                        </div><!-- /.form-group -->
                                        <div class="col-sm-6">
                                              <input class="hidden" id="artid" name="artid" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success">Save</button>
                      </div>
                  </div>
                </form>
              </div>
          </div>
<script>
   function edit(a){
    
       $('.exampl-modal-lg').modal({backdrop: 'static', keyboard: false})  
       $('.exampl-modal-lg').modal('show');
      
         document.getElementById("artid").value = a;
    
       var baseurl = "<?php echo base_url(); ?>";
       var xmlhttp = new XMLHttpRequest();
       var url = baseurl + "Artisan/get_artisan/" + a;
    
     xmlhttp.onreadystatechange=function() {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             myFunction(xmlhttp.responseText);
         }
     }

     xmlhttp.open("GET", url, true);
     xmlhttp.send();

     function myFunction(response) {
        //alert(a);
        var arr = JSON.parse(response);
      
        for (var i = 0; i < arr.length; i++) {
        
          document.getElementById("accart").value = arr[i].accact;
        }
      };

  
}
    
</script>



  
  