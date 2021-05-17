  <style>
    .ccdet {
      font-weight: bold;
    }
    .ccdetinfo {
      
    }
  </style>
  <!-- Page -->
  <div class="page animsition" id="content">
    <div class="page-content container-fluid">
        <!-- search gproject nav bar starts here -->
      		<div id="gp_nav_bar" class="panel no_print" style="min-height: 70px;" >
          	<div class="col-sm-6" >
          			<?php if(has_permission($this->session->userdata('user_info')['id'],'edit household')){ ?>
                  <button type="button" onClick="edit()" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;">
                    <i class="icon wb-edit" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Household</span>
                  </button>
                <?php }else{ ?>
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick='has_permission()' style="margin-right: 2px; margin-top : 15px;">
                    <i class="icon wb-user-add" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Household</span>
                  </button>
                <?php } ?>
                <a href="<?=base_url()?>household">
                <button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;">
                  <i class="icon wb-reply" aria-hidden="true"></i>
                  <span class="hidden-sm hidden-xs">Back</span>
                </button>
                </a>
                <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;">
                  <i class="icon wb-print" aria-hidden="true"></i>
                  <span class="hidden-sm hidden-xs">Print</span>
                </button>
                
				    </div>
	  		</div>
      		<!-- search gproject nav bar ends here -->
        <div class="row ">
          <div class="col-md-12">
            <?php echo $this->session->flashdata('message'); ?>
           <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
              <div class="panel-body container-fluid" id="#">
              <div>
                <h3>Household Details</h3>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4 col-xs-4">
                    </div>
                    <div align="center" class="col-md-4 col-xs-4">
                      <h3 class="ccdet"><?php echo $household['firstname'].' '.$household['lastname'];?></h3>
                    </div>
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Date Of Birth</h6>
                          <h6>
                            <?php 
                              if($household['dob'] == ""){

                              }else{
                                echo date('d M Y',strtotime($household['dob'])); 
                              }
                            ?>
                          </h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Place Of Birth</h6>
                          <h6><?php echo $household['place_of_birth'] ?></h6>
                        </div>
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Gender</h6>
                          <h6><?php echo  $household['gender']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Primary Contact</h6>
                          <h6><?php echo $household['primary_contact']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>
                      
                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Secondary Contact</h6>
                          <h6><?php echo $household['secondary_contact']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Nationality</h6>
                          <h6><?php echo $household['nationality']; ?></h6>
                        </div>
                        <?php if($household['nationality'] == "Ghanaian"){?>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Id Type</h6>
                          <h6><?php echo $household['id_type']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Id Number</h6>
                          <h6><?php echo $household['id_number']; ?></h6>
                        </div>
                        <?php }else{ ?> 
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Country</h6>
                          <h6><?php echo $household['country']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Id Number</h6>
                          <h6><?php echo $household['nat_id_no']; ?></h6>
                        </div>
                        <?php } ?> 
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Residence Code</h6>
                          <h6><?php echo $household['res_prop_code']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Education</h6>
                          <h6><?php echo $household['level']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Profession</h6>
                          <h6><?php echo $household['prof']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Employment Status</h6>
                          <h6><?php echo $household['employment_status']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        <?php if($household['employment_status'] == "Employed"){?>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Employer Name</h6>
                          <h6><?php echo $household['employer_name']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Current Occupation</h6>
                          <h6><?php echo $household['current_occupation']; ?></h6>
                        </div>
                        <?php }elseif($household['employment_status'] == "Self-Employed"){ ?> 
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business Name</h6>
                          <h6><?php echo $household['buisness_name']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Type Of Business</h6>
                          <h6><?php echo $household['type_of_buisness']; ?></h6>
                        </div>
                        <?php } ?> 
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Marital Status</h6>
                          <h6><?php echo $household['marital_status']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">No Of Kids</h6>
                          <h6><?php echo $household['no_of_kids']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                        <?php if($household['no_of_kids'] == 1){?>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">First Born DOb</h6>
                          <h6>
                            <?php if($household['firstborn_dob'] != '0000-00-00'){?>
                            <?php echo date('d M Y',strtotime($household['firstborn_dob'])); ?>
                            <?php }else{?>
                            <?php }?>   
                          </h6>
                        </div>
                        <?php }elseif($household['no_of_kids'] > 1){ ?>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">First Born DOb</h6>
                          <h6>
                            <?php if($household['firstborn_dob'] != '0000-00-00'){?>
                            <?php echo date('d M Y',strtotime($household['firstborn_dob'])); ?>
                            <?php }else{?>
                            <?php }?>   
                          </h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Last Born DOB</h6>
                          <h6>
                            <?php if($household['lastborn_dob'] != '0000-00-00'){?>
                            <?php echo date('d M Y',strtotime($household['lastborn_dob'])); ?>
                            <?php }else{?>
                            <?php }?>   
                          </h6>
                        </div>
                        <?php } ?>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Hometown</h6>
                          <h6><?php echo $household['hometown']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Home District</h6>
                          <h6><?php echo $household['home_district']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Religion</h6>
                          <h6>
                            <?php
                              if($household['religion'] !== "Others"){
                                echo $household['religion'];
                              }else{
                                echo $household['other_religion'];
                              }
                            ?>
                          </h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Region</h6>
                          <h6><?php echo $household['region']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Ethnicity</h6>
                          <h6><?php echo $household['ethnicity']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Native Language</h6>
                          <h6><?php echo $household['native_lan']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Father Name</h6>
                          <h6><?php echo $household['father_firstname'].' '.$household['father_lastname']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Father Clan</h6>
                          <h6><?php echo $household['father_clan']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Mother Name</h6>
                          <h6><?php echo $household['mother_firstname'].' '.$household['mother_lastname']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Mother Clan</h6>
                          <h6><?php echo $household['mother_clan']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>
                  </div>
                </div>


            </div>
         </div>
       </div>
    </div>
  </div>
  </div>				 
  <!-- End Page -->
  <?php $this->load->view("residence/edit_household_modal.php");?>


 