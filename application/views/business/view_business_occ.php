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
          			<?php if(has_permission($this->session->userdata('user_info')['id'],'edit buis occ')){ ?>
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;" onclick="check_busprop_code()">
                    <i class="icon wb-edit" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Business</span>
                  </button>
                <?php }else{ ?>
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick='has_permission()' style="margin-right: 2px; margin-top : 15px;">
                    <i class="icon wb-user-add" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Business</span>
                  </button>
                <?php } ?>
                <a href="<?=base_url()?>business_occ">
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
                <h3>Business Details</h3>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    
                    <div align="center" class="col-md-12 col-xs-12">
                      <?php $owner = business_occ_owner_details($bus['id']); ?> 
                      <h3 class="ccdet"><?php echo $bus['buis_name'].' ('.$bus['buis_occ_code'].')';?></h3>
                    </div>
                  
                  </div>
                </div>
                <div class="row">
                  &nbsp;
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business Contacts</h6>
                          <h6><a href="tel:<?php echo $bus['buis_primary_phone']  ?>"><?= $bus['buis_primary_phone'] ?></a> / <a href="tel:<?php echo $bus['buis_secondary_phone']?>"><?= $bus['buis_secondary_phone']?></a></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business E-mail / Website</h6>
                          <h6><a href="mailto:<?php echo $bus['buis_email'] ?>"><?= $bus['buis_email'] ?></a> / <?= $bus['buis_website'] ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Area Council</h6>
                          <h6><?php echo  $bus['area']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Town</h6>
                          <h6><?php echo $bus['tt']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>
                      
                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Owner Name</h6>
                          <h6><?php echo $owner['firstname'].' '.$owner['lastname']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Owner Contacts</h6>
                          <h6><a href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a> / <a href="tel:<?php echo $owner['secondary_contact'] ?>"><?= $owner['secondary_contact']  ?></a></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business Industry Type</h6>
                          <h6><?php echo $bus['buis_industry_type']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business Sector</h6>
                          <h6><?php echo $bus['sector']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Year Of Establishment</h6>
                          <h6><?php echo $bus['year_of_est']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Business Registration Cert No</h6>
                          <h6><?php echo $bus['buis_reg_cert_no']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Nature Of Business</h6>
                          <h6><?php echo $bus['nature_of_buisness']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">No Of Rooms</h6>
                          <h6><?php echo $bus['no_of_rooms']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">No Of Employees</h6>
                          <h6><?php echo $bus['no_of_employees']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Type Of Building</h6>
                          <h6><?php echo $bus['type_of_building']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Detail For Temp</h6>
                          <?php if($bus['type_of_building'] == 'Temporary'){?>
                            <h6><?php echo $bus['detail_for_temp']; ?></h6>
                          <?php }else{ ?>
                            
                          <?php } ?>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Ownership</h6>
                          <h6><?php echo $bus['ownership']; ?></h6>
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
  <?php $this->load->view("business/edit_business_occ_modal.php");?>


 