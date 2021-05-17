<div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <h4 class="modal-title" id="exampleOptionalLarge">Business Property Registration</h4>
            </div>
            <div class="modal-body">
            	<div class="panel panel-primary">
				    <div class="panel-body">
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Business/add_business">
				        
				        <div id="sf1" class="frm">
				            <legend>Personnal Data (Step 1 of 4)</legend>
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
									<input type="text" class="form-control hidden" id="primary_contact" name="primary_contact" autocomplete="off" required/>
								   <input type="text" class="form-control" id="primary_contactt" name="primary_contactt" autocomplete="off" required/>
								   <label class="floating-label">Owner Primary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <button class="btn btn-info" onclick="search_owner()" type="button">Get Owner Details</button> 
								</div>	
							</div>
							<div style="display: none;" id="owner_others">
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" required/>
								   <label class="floating-label">Owner First Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" required/>
								   <label class="floating-label">Owner Last name</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="secondary_contact" name="secondary_contact" autocomplete="off" required/>
								   <label class="floating-label">Owner Secondary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_native" name="owner_native" class="form-control" autocomplete="off">
								   		<option></option>
								   		<option>Yes, Resides In Property</option>
										<option>Yes, Does not Reside In Property</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Is Owner A Native</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="religion" name="religion" class="form-control" onChange="check_religion()" autocomplete="off">
								   		<option></option>
								   		<option>Christianity</option>
										<option>Islamic</option>
										<option>Traditional</option>
										<option>Buddhism</option>
										<option>Atheism</option>
										<option>Others</option>
									</select>
								   <label class="floating-label">Religion</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="others">
								   <input type="text" class="form-control" id="other_religion" name="other_religion" autocomplete="off"/>
								   <label class="floating-label">Specify Name</label>
								</div>
							</div>
							</div>
							<div id="owner_reside" style="display: none;">
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_area_council" name="owner_area_council" class="form-control" autocomplete="off">
								   		<option></option>
										<?php foreach($area as $a){ ?>
											<option value="<?= $a->id?>"><?=$a->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Area Coucil</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_town" name="owner_town" class="form-control" autocomplete="off">
										<option></option>
									</select>
								   <label class="floating-label">Locality/Town</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_streetname" name="owner_streetname" autocomplete="off"/>
								   <label class="floating-label">Surburb/Street Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_landmark" name="owner_landmark" autocomplete="off"/>
								   <label class="floating-label">Landmark(if any)</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_locality_code" name="owner_locality_code" autocomplete="off"/>
								   <label class="floating-label">Locality Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_street_code" name="owner_street_code" autocomplete="off"/>
								   <label class="floating-label">Street Code</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_new_property_no" name="owner_new_property_no" autocomplete="off"/>
								   <label class="floating-label">New Property No</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_old_property_no" name="owner_old_property_no" autocomplete="off"/>
								   <label class="floating-label">Old Property No</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_zone_code" name="owner_zone_code" autocomplete="off"/>
								   <label class="floating-label">Zone Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_ghpost_gps" name="owner_ghpost_gps" autocomplete="off"/>
								   <label class="floating-label">Ghanapost GPS code (optional)</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_houseno" name="owner_houseno" autocomplete="off"/>
								   <label class="floating-label">House No</label>
								</div>	
							</div>
							</div>
							<div id="owner_reside_not" style="display:none;">
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_location" name="owner_location" autocomplete="off"/>
								   <label class="floating-label">Location</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_hometown" name="owner_hometown" autocomplete="off"/>
								   <label class="floating-label">Hometown</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_home_district" name="owner_home_district" autocomplete="off"/>
								   <label class="floating-label">Home District</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_region" name="owner_region" class="form-control" autocomplete="off">
								   		<option></option>
										<option>Greater Accra</option>
										<option>Western</option>
										<option>Central</option>
										<option>Eastern</option>
										<option>Nothern</option>
										<option>Upper East</option>
										<option>Upper West</option>
										<option>Volta</option>
										<option>Ashanti</option>
										<option>Brong Ahafo</option>
									</select>
								   <label class="floating-label">Region</label>
								</div>	
							</div>
							</div>					            
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-10">
				                <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf2" class="frm" style="display: none;">
				            <legend>Location Data (Step 2 of 4)</legend>
					            
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="area_council" name="area_council" class="form-control" autocomplete="off" required>
								   		<option></option>
										<?php foreach($area as $a){ ?>
											<option value="<?= $a->id?>"><?=$a->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Area Coucil</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="town" name="town" class="form-control" autocomplete="off" required>
										<option></option>
									</select>
								   <label class="floating-label">Locality/Town</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="streetname" name="streetname" autocomplete="off" required/>
								   <label class="floating-label">Surburb/Street Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="landmark" name="landmark" autocomplete="off" required/>
								   <label class="floating-label">Landmark(if any)</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="locality_code" name="locality_code" autocomplete="off" required/>
								   <label class="floating-label">Locality Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="street_code" name="street_code" autocomplete="off" required/>
								   <label class="floating-label">Street Code</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="new_property_no" name="new_property_no" autocomplete="off" required/>
								   <label class="floating-label">New Property No</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="old_property_no" name="old_property_no" autocomplete="off" required/>
								   <label class="floating-label">Old Property No</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="zone_code" name="zone_code" autocomplete="off" required/>
								   <label class="floating-label">Zone Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="ghpost_gps" name="ghpost_gps" autocomplete="off" required/>
								   <label class="floating-label">Ghanapost GPS code (optional)</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="houseno" name="houseno" autocomplete="off" required/>
								   <label class="floating-label">House No</label>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf3" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Property Data (Step 3 of 4)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="property_type" name="property_type" onChange="property()" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Detached</option>
										<option>Semi-Detached</option>
										<option>Compound</option>
										<option>Storey</option>
										<option>Terrace</option>
										<option>Flat</option>
									</select>
								   <label class="floating-label">Property Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="floor" style="display: none;">
								   <input type="text" class="form-control" id="no_of_floors" name="no_of_floors" autocomplete="off"/>
								   <label class="floating-label">No Of Storeys / Floors</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="grade_type" name="grade_type" class="form-control" autocomplete="off" required>
										<option>Grade 1</option>
										<option>Grade 2</option>
										<option>Grade 3</option>
										<option>Grade 4</option>
									</select>
								   <label class="floating-label">Grade</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="no_of_rooms" name="no_of_rooms" autocomplete="off" required/>
								   <label class="floating-label">No Of Rooms</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="construction_material" name="construction_material" class="form-control" autocomplete="off" required>
										<option></option>
										<?php foreach($construction as $con){?>
											<option value="<?=$con->id?>"><?=$con->material?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Construction Material</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="roofing_type" name="roofing_type" class="form-control" autocomplete="off" required>
										<option></option>
										<?php foreach($roof as $rof){?>
											<option value="<?=$rof->id?>"><?=$rof->roof?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Roofing Type</label>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open3" type="button">Next <span class="fa fa-arrow-right"></button> 
				              </div>
				            </div>

				          </fieldset>
				        </div>

				        <div id="sf4" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Facility Data (Step 4 of 4)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="toilet_facility" name="toilet_facility" class="form-control" autocomplete="off" required>
										<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Toilet Facility</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="t_yes">
								   <select id="t_facility_yes" name="t_facility_yes" class="form-control" autocomplete="off" required>
										<option>WC</option>
										<option>VIP</option>
										<option>Aqua Privy</option>
									</select>
								   <label class="floating-label">Toilet Facilty Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="t_no">
								   <select id="t_facility_no" name="t_facility_no" class="form-control" autocomplete="off" required>
										<option>KVIP</option>
										<option>Unapproved Location(Seashore,bush)</option>
									</select>
								   <label class="floating-label">Toilet Facilty Type</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="avai_of_water" name="avai_of_water" class="form-control" autocomplete="off" required>
										<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Availability Of Water</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="water_yes">
								   <select id="source_water_yes" name="source_water_yes" class="form-control" autocomplete="off" required>
										<option>GWC</option>
										<option>Borehole</option>
										<option>Hand Dug Well</option>
										<option>Small town water system</option>
									</select>
								   <label class="floating-label">Source Of water</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="water_no">
								   <select id="source_water_no" name="source_water_no" class="form-control" autocomplete="off" required>
										<option>River</option>
										<option>Stream</option>
										<option>Brookes</option>
										<option>Others</option>
									</select>
								   <label class="floating-label">Source Of water</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="avai_of_refuse" name="avai_of_refuse" class="form-control" autocomplete="off" required>
										<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Availability Of Refuse</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="refuse_yes">
								   <select id="dumping_site_yes" name="dumping_site_yes" class="form-control" autocomplete="off" required>
										<option>Waste Company</option>
										<option>Public Waste Management Site</option>
									</select>
								   <label class="floating-label">Dumping Site</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="refuse_no">
								   <select id="dumping_site_no" name="dumping_site_no" class="form-control" autocomplete="off" required>
										<option>Skip Container</option>
										<option>Unengeered sites</option>
									</select>
								   <label class="floating-label">Dumping Site</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="building_permit" name="building_permit" onchange="b_permit()" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Building Permit</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="b_permit" style="display: none;">
								   <input type="text" class="form-control" id="building_cert_no" name="building_cert_no" autocomplete="off"/>
								   <label class="floating-label">Building Permit No</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="planning_permit" name="planning_permit" onchange="p_permit()" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Planning Permit</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="p_permit" style="display: none;">
								   <input type="text" class="form-control" id="planning_permit_no" name="planning_permit_no" autocomplete="off"/>
								   <label class="floating-label">Planning Permit No</label>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back4" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-success open" type="submit">Submit</button> 
				              </div>
				            </div>

				          </fieldset>
				        </div>
				      </form>
				    </div>
				  </div>
        	</div>
        </div>
	</div>
</div>