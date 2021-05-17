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
          			<?php if(has_permission($this->session->userdata('user_info')['id'],'edit buis prop')){ ?>
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick='do_checks()' data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;">
                    <i class="icon wb-edit" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Business Property</span>
                  </button>
                <?php }else{ ?>
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick='has_permission()' style="margin-right: 2px; margin-top : 15px;">
                    <i class="icon wb-user-add" aria-hidden="true"></i>
                    <span class="hidden-sm hidden-xs">Edit Business Property</span>
                  </button>
                <?php } ?>
                <a href="<?=base_url()?>business_prop">
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
                <h3>Business Property Details</h3>
              </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4 col-xs-4">
                    <?php $owner = business_owner_details($residence['id']); ?> 
                    </div>
                    <div align="center" class="col-md-4 col-xs-4">
                      <h3 class="ccdet"><?php echo $residence['buis_prop_code'];?></h3>
                    </div>
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Owner Name</h6>
                          <h6><?php echo $owner['firstname'].' '.$owner['lastname']; $owner['primary_contact'].' / '.$owner['secondary_contact']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Owner Contact</h6>
                          <h6><a href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a> / <a href="tel:<?php echo $owner['secondary_contact'] ?>"><?= $owner['secondary_contact'] ?></a></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Area Council</h6>
                          <h6><?php echo  $residence['area']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Town</h6>
                          <h6><?php echo $residence['tt']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>
                      
                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Street Name</h6>
                          <h6><?php echo $residence['streetname']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Landmark</h6>
                          <h6><?php echo $residence['landmark']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">House No</h6>
                          <h6><?php echo $residence['houseno']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Ghana Post GPS</h6>
                          <h6><?php echo $residence['ghpost_gps']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Locality Code</h6>
                          <h6><?php echo $residence['locality_code']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Street Code</h6>
                          <h6><?php echo $residence['street_code']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">New Property No</h6>
                          <h6><?php echo $residence['new_property_no']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Old Property No</h6>
                          <h6><?php echo $residence['old_property_no']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Zone Code</h6>
                          <h6><?php echo $residence['zone_code']; ?></h6>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Construction Material</h6>
                          <h6><?php echo $residence['material']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Roofing Type</h6>
                          <h6><?php echo $residence['roof']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Grade</h6>
                          <h6><?php echo $residence['grade_type']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Propert Type</h6>
                          <h6><?php echo $residence['property_type']; ?></h6>
                        </div>
                  
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">No Of Floors</h6>
                          <?php if($residence['property_type'] == 'Storey'){?>
                          <h6><?php echo $residence['no_of_floors']; ?></h6>
                          <?php }else{} ?>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">No Of Rooms</h6>
                          <h6><?php echo $residence['no_of_rooms']; ?></h6>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Toilet Facility</h6>
                          <h6><?php echo $residence['toilet_facility']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Toilet Facility Types</h6>
                          <?php if($residence['toilet_facility'] == 'Yes'){?>
                            <h6><?php echo $residence['t_facility_yes']; ?></h6>
                          <?php }else{ ?>
                            <h6><?php echo $residence['t_facility_no']; ?></h6>
                          <?php } ?>
                        </div>
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Availability Of Water</h6>
                          <h6><?php echo $residence['avai_of_water']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Source Of Water</h6>
                          <?php if($residence['avai_of_water'] == 'Yes'){?>
                            <h6><?php echo $residence['source_water_yes']; ?></h6>
                          <?php }else{ ?>
                            <h6><?php echo $residence['source_water_no']; ?></h6>
                          <?php } ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Availability Of Refuse Dump</h6>
                          <h6><?php echo $residence['avai_of_refuse']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                      
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Dumping Site</h6>
                          <?php if($residence['avai_of_refuse'] == 'Yes'){?>
                            <h6><?php echo $residence['dumping_site_yes']; ?></h6>
                          <?php }else{ ?>
                            <h6><?php echo $residence['dumping_site_no']; ?></h6>
                          <?php } ?>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Building Permit</h6>
                          <h6><?php echo $residence['building_permit']; ?></h6>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Building Certificate No</h6>
                          <?php if($residence['building_permit'] == 'Yes'){?>
                          <h6><?php echo $residence['building_cert_no']; ?></h6>
                          <?php }else{} ?>
                        </div>

                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Planning Permit</h6>
                          <h6><?php echo $residence['planning_permit']; ?></h6>
                        </div>
                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                        <div class="col-md-3 col-xs-3">
                          <h6 class="ccdet">Planning Permit No</h6>
                          <?php if($residence['planning_permit'] == 'Yes'){?>
                          <h6><?php echo $residence['planning_permit_no']; ?></h6>
                          <?php }else{} ?>
                        </div>

                        
                      </div>
                      
                      <div class="row">
                        &nbsp;
                      </div>
                      <h4>Business Occupants</h4>
                      <div class="row">
                        <div class="col-md-12">
                          <table id="maintable" class="table table-hover width-full table-responsive">
                              <thead>
                                <tr>
                                  <th>BUSINESS CODE</th>
                                  <th>BUSINESS NAME</th>
                                  <th>BUSINESS PRIMARY CONTACT</th>
                                  <th>E-MAIL</th>
                                  <th>OWNER</th>
                                  <th>Primary CONTACT</th>
                                </tr>
                              </thead>     
                              <tbody>
                                <?php foreach($result as $value):?>
                                  <tr>
                                    <td>
                                      <?php if(has_permission($this->session->userdata('user_info')['id'],'view buis occ')){ ?>
                                      <a style="text-decoration: none;" href='<?= base_url().'view_business_occ/'.$value->id?>'><?= $value->buis_occ_code ?></a>
                                      <?php }else{ ?>
                                      <a style="text-decoration: none;" onClick="has_permission()" href='#'><?= $value->buis_occ_code ?></a> 
                                      <?php } ?>  
                                    </td>
                                    <td><?= $value->buis_name ?></td>
                                    <td><a style="text-decoration: none;" href="tel:<?php echo $value->buis_primary_phone ?>"><?= $value->buis_primary_phone ?></a></td>
                                    <td><a style="text-decoration: none;" href="mailto:<?php echo $value->buis_email ?>"><?= $value->buis_email ?></a></td>
                                    <td><?= $value->buis_owner_name ?></td>
                                    <td><a style="text-decoration: none;" href="tel:<?php echo $value->owner_primary_phone ?>"><?= $value->owner_primary_phone ?></a></td>
                                  </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                          </table>
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
  <!-- End Page -->
  <?php $this->load->view("business/edit_business_modal.php");?>


 