<style>
  .ccdet {
    font-weight: bold;
  }
  
  .ccdetinfo {
    
  }
</style>
<!-- Page -->
  <div class="page animsition" id = "something">
       
    <div class="page-content container-fluid">
          
      	<div class="panel" style="min-height: 70px;" >
          		<div class="col-sm-6" >
          			<a href="<?=base_url()?>member">
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-reply" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Back</span>
          			   </button>
                </a>
                <button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-edit" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Edit</span>
                </button>
                <button type="button" onclick='initiate_delete(<?=$member['memid']?>)' class="btn btn-outline btn-responsive btn-danger" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Delete</span>
                </button>
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-print" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Print</span>
          			</button>
                <button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteMember" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span>
                </button>
				</div>      			
	  	</div>    
      <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
            <div class="panel-body container-fluid" id="loaddata">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      
                    </div>
                    <div align="center" class="col-md-4" style="margin: 0 auto;">
                      <img src="<?php echo base_url().$member['image']?>" class="img-responsive img-circle" style="width:10em;height:10em;margin-bottom: 0.2em;">
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      
                    </div>
                    <div align="center" class="col-md-4">
                      <h3 class="ccdet"><?php echo $member['fn'].' '.$member['ln']; ?></h3>
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        <div class="col-md-4">
                          <h5 class="ccdet">Member No</h5>
                          <h5><?php echo sprintf('%04d',$member['memid']); ?></h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Marital status</h5>
                          <h5><?php echo $member['marital_status']; ?></h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Gender</h5>
                          <h5><?php echo $member['gender']; ?></h5>
                        </div> 
                        
                      </div>
                      
                      <div class="row">
                &nbsp;
                </div>
                        
                 <div class="row">
                        <div class="col-md-4">
                          <h5 class="ccdet">Date Of Birth (Age)</h5>
                          <?php 
                            if($member['dob'] != '' ){
                              echo '<h5>'. date('d M Y', strtotime($member['dob'])) .' <b>( '.date_diff(date_create(date('Y-m-d')),date_create($member['dob']))->format('%Y Years').' )</b></h5>';
                            }
                            else{
                              echo '';
                            }
                          ?>
                    
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Location</h5>
                          <h5><?php echo $member['location']; ?></h5>
                        </div>
                  
                        <div class="col-md-4">
                          <h5 class="ccdet">Phone</h5>
                          <h5><?php echo $member['phone']; ?></h5>
                        </div>
                  
                       
                        
                </div>

                 <div class="row">
                         <div class="col-md-4">
                          <h5 class="ccdet">Profession</h5>
                          <h5><?php echo $member['profname']; ?></h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Natinality</h5>
                          <h5><?php echo $member['nationality']; ?></h5>
                        </div>
                  
                        <div class="col-md-4">
                          <h5 class="ccdet">email</h5>
                          <h5><?php echo $member['email']; ?></h5>
                        </div>
                  
                        
                        
                </div>
                 <div class="row">
                        <div class="col-md-4">
                          <h5 class="ccdet">Ministry</h5>
                          <h5><?php echo $member['minname']; ?></h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Educational Level</h5>
                          <h5><?php echo $member['eduname']; ?></h5>
                        </div>
                  
                        <div class="col-md-4">
                          <h5 class="ccdet">Position</h5>
                          <h5><?php echo $member['posname']; ?></h5>
                        </div>
                  
                        
                        
                </div>
                <div class="row">
                        <div class="col-md-4">
                          <h5 class="ccdet">Cell</h5>
                          <h5><?php echo $member['cellname']; ?></h5>
                        </div>
                        <div class="col-md-4">
                          <h5 class="ccdet">Group</h5>
                          <h5><?php echo $member['grpname']; ?></h5>
                        </div>
                </div>
                      <div class="row">
                        
                        
                      </div>
                    
                  </div>
                </div>

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
                          <h4 class="modal-title" id="exampleOptionalLarge">EDIT MEMBER DETAILS</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="<?=base_url()?>Member/update_member_info" autocomplete="off" enctype="multipart/form-data">
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
                                                  <input type="hidden" name="img_path" value="<?=$member['image'];?>">
                                                  <input type="hidden" name="id" value="<?=$member['memid'];?>">
                                                  <img src="<?php echo base_url().$member['image'];?>" id="user_img" class="thumbnail" width="120" height="100">
                                                  <div style="margin-top: -1em;">
                                                      <input name="userfile" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                              <div class="col-sm-12">
                                                <label class="control-label">Marital Status</label>
                                                <select class="form-control" name="marital_status" value="<?=$member['marital_status']?>" required>
                                                    <option value="">--Select--</option>
                                                    <option value="Single" <?=$member['marital_status']=='Single'?'selected=selected':'';?>>Single</option>
                                                    <option value="Married" <?=$member['marital_status']=='Married'?'selected=selected':'';?>>Married</option>
                                                    <option value="Seperated" <?=$member['marital_status']=='Seperated'?'selected=selected':'';?>>Seperated</option>
                                                    <option value="Divorced" <?=$member['marital_status']=='Divorced'?'selected=selected':'';?>>Divorced</option>
                                                    <option value="Widow" <?=$member['marital_status']=='Widow'?'selected=selected':'';?>>Widow</option>
                                                    <option value="Widower"<?=$member['marital_status']=='Widower'?'selected=selected':'';?>>Widower</option>
                                                </select>
                                             </div>
                                          </div>
                                      </div>
                                      <div class="col col-md-6">
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="fn" id="fn" type="text" value="<?=$member['fn']?>" required/>
                                                <label class="floating-label">First Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" id="ln" name="ln" type="text" value="<?=$member['ln']?>" required/>
                                                <label class="floating-label">Last Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col col-md-12">
                                                <input class="form-control calender" name="dob" type="text" value="<?=$member['dob']?>" required/>
                                                <label class="floating-label">Date Of Birth</label>
                                            </div>
                                          </div>
                                      </div>
                               </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <label class="control-label">Gender</label>
                                            <select class="form-control" name="gender" value="<?=$member['gender']?>" required>
                                                <option value="Male" <?=$member['gender']=='Male'?'selected=selected':'';?>>Male</option>
                                                <option value="Female" <?=$member['gender']=='Female'?'selected=selected':'';?>>Female</option>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                        <div class="col col-md-6">
                                            <label class="control-label">Phone</label>
                                            <input class="form-control" name="phone" id="phone" value="<?=$member['phone']?>" type="text">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <label class="control-label">Profession</label>
                                            <select class="form-control" name="profession" value="<?=$member['profession']?>" required>
                                                <?php foreach($profession as $prof):?>
                                                  <option value="<?= $prof->id?>" <?=$member['profession']== $prof->id ?'selected=selected':'';?>><?php echo $prof->profname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                        <div class="col-sm-6">
                                                <label class="control-label">Date Joined</label>
                                                <input class="form-control calender" name="date_joined" value="<?=$member['date_joined']?>" type="text">
                                                
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                          <label class="control-label">Natinality</label>
                                            <select class="form-control" name="country" value="<?=$member['nationality']?>" required>
                                                <option value="Ghanaian" <?=$member['nationality']=='Ghanaian'?'selected=selected':'';?>>Ghanaian</option>
                                                <option value="Nigerian" <?=$member['nationality']=='Nigerian'?'selected=selected':'';?>>Nigerian</option>
                                                <option value="Togolaise" <?=$member['nationality']=='Togolaise'?'selected=selected':'';?>>Togolaise</option>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                        <div class="col col-md-6">
                                            <label class="control-label">Physical location</label>
                                            <input class="form-control" name="location" value="<?=$member['location']?>" type="text">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <label class="control-label">Ministry</label>
                                            <select class="form-control" name="ministry" value="<?=$member['ministry']?>" required>
                                                <?php foreach($ministry as $min):?>
                                                  <option value="<?= $min->id?>" <?=$member['ministry']== $min->id ?'selected=selected':'';?>><?php echo $min->minname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                         <div class="col col-md-6">
                                            <label class="control-label">E-mail</label>
                                            <input class="form-control" name="email" value="<?=$member['email']?>" type="text">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                 <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                        <div class="col col-md-6">
                                            <label class="control-label">Educational Level</label>
                                            <select class="form-control" name="edu_level" value="<?=$member['edu_level']?>">
                                                <?php foreach($educational as $edu):?>
                                                  <option value="<?= $edu->id?>" <?=$member['edu_level']== $edu->id ?'selected=selected':'';?>><?php echo $edu->eduname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                        <div class="col col-md-6">
                                            <label class="control-label">Position</label>
                                            <select class="form-control" name="position" value="<?=$member['position']?>">
                                                 <?php foreach($position as $pos):?>
                                                    <option value="<?= $pos->id?>" <?=$member['position']== $pos->id ?'selected=selected':'';?>><?php echo $pos->posname ?></option>
                                                 <?php endforeach; ?>
                                            </select>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="form-group form-material floating row">
                                         <div class="col col-md-6">
                                            <label class="control-label">Group</label>
                                            <select class="form-control" name="group" value="<?=$member['group']?>">
                                                 <?php foreach($grp as $g):?>
                                                  <option value="<?= $g->id?>" <?=$member['group']== $g->id ?'selected=selected':'';?>><?php echo $g->grpname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            
                                        </div><!-- /.form-group -->
                                        <div class="col col-md-6">
                                            <label class="control-label">Cell</label>
                                            <select class="form-control" name="cell" value="<?=$member['cell']?>">
                                                <?php foreach($cell as $cell):?>
                                                  <option value="<?= $cell->id?>" <?=$member['cell']== $cell->id ?'selected=selected':'';?>><?php echo $cell->cellname ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            
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
            var selected_row_id;
            var selected_agent_id;
            var deleteid;
            
            function initiate_delete(x){
              deleteid = x;
              document.getElementById("dpop").click();
            }
            
            function draw_table(){
              
              $('#something').load('<?=base_url()?>Member/redraw');

            }
            
            
          </script>

            