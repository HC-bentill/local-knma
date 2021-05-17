<div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <h4 class="modal-title" id="exampleOptionalLarge">Residence Property Registration</h4>
            </div>
            <div class="modal-body">
            	<div class="panel panel-primary">
				    <div class="panel-body">
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Residence/edit_residence">
				        
				        <div id="sf1" class="frm">
				            <legend>Personnal Data (Step 1 of 4)</legend>
				            <?php $owner = owner_details($residence['id']); ?>
							<div id="owner_others">
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $owner['firstname']?>" autocomplete="off" required/>
								   <label class="floating-label">Owner First Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$owner['lastname']?>" autocomplete="off" required/>
								   <label class="floating-label">Owner Last name</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="primary_contact" value="<?=$owner['primary_contact']?>"  name="primary_contact" autocomplete="off" required/>
								   <label class="floating-label">Owner Primary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="secondary_contact" name="secondary_contact" value="<?=$owner['secondary_contact']?>" autocomplete="off" required/>
								   <label class="floating-label">Owner Secondary Contact</label>
								</div>
								
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_native" name="owner_native" class="form-control" autocomplete="off">
								   		<option></option>
											<option <?= $owner['owner_native'] == "Yes"?'selected==selected':''?>>Yes</option>
											<option <?= $owner['owner_native'] == "No"?'selected==selected':''?>>No</option>
								   		<option <?= $owner['owner_native'] == "Yes, Resides In Property"?'selected==selected':''?>>Yes, Resides In Property</option>
									</select>
								   <label class="floating-label">Is Owner A Native</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="religion" name="religion" class="form-control" onChange="check_religion()" autocomplete="off">
								   		<option></option>
								   		<option <?= $owner['religion'] == "Christianity"?'selected==selected':''?>>Christianity</option>
										<option <?= $owner['religion'] == "Islamic"?'selected==selected':''?>>Islamic</option>
										<option <?= $owner['religion'] == "Traditional"?'selected==selected':''?>>Traditional</option>
										<option <?= $owner['religion'] == "Buddhism"?'selected==selected':''?>>Buddhism</option>
										<option <?= $owner['religion'] == "Atheism"?'selected==selected':''?>>Atheism</option>
										<option <?= $owner['religion'] == "Others"?'selected==selected':''?>>Others</option>
									</select>
								   <label class="floating-label">Religion</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="others">
								   <input type="text" class="form-control" id="other_religion"  value="<?=$owner['other_religion']?>" name="other_religion" autocomplete="off"/>
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
											<option value="<?= $a->id?>" <?= $owner['area_council'] == $a->id?'selected==selected':''?>><?=$a->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Area Coucil</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
									<input type="text" class="form-control hidden" id="owner_townn" name="owner_townn" value="<?= $owner['town']?>" autocomplete="off"/>
								   <select id="owner_town" name="owner_town" class="form-control" autocomplete="off">
										<option></option>
									</select>
								   <label class="floating-label">Locality/Town</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_streetname" value="<?=$owner['street_name']?>" name="owner_streetname" autocomplete="off"/>
								   <label class="floating-label">Surburb/Street Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_landmark" value="<?=$owner['landmark']?>" name="owner_landmark" autocomplete="off"/>
								   <label class="floating-label">Landmark(if any)</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_locality_code" value="<?=$owner['locality_code']?>" name="owner_locality_code" autocomplete="off"/>
								   <label class="floating-label">Locality Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_street_code" value="<?=$owner['street_code']?>" name="owner_street_code" autocomplete="off"/>
								   <label class="floating-label">Street Code</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_new_property_no" value="<?=$owner['new_property_no']?>" name="owner_new_property_no" autocomplete="off"/>
								   <label class="floating-label">New Property No</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_old_property_no" value="<?=$owner['old_property_no']?>" name="owner_old_property_no" autocomplete="off"/>
								   <label class="floating-label">Old Property No</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_zone_code" name="owner_zone_code" value="<?=$owner['zone_code']?>" autocomplete="off"/>
								   <label class="floating-label">Zone Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_ghpost_gps" name="owner_ghpost_gps" value="<?=$owner['ghpostgps_code']?>" autocomplete="off"/>
								   <label class="floating-label">Ghanapost GPS code (optional)</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_houseno" name="owner_houseno" value="<?=$owner['houseno']?>" autocomplete="off"/>
								   <label class="floating-label">House No</label>
								</div>	
							</div>
							</div>
							<div id="owner_reside_not" style="display:none;">
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_location" value="<?=$owner['location']?>" name="owner_location" autocomplete="off"/>
								   <label class="floating-label">Location</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_hometown" value="<?=$owner['hometown']?>" name="owner_hometown" autocomplete="off"/>
								   <label class="floating-label">Hometown</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="owner_home_district" value="<?=$owner['home_district']?>"  name="owner_home_district" autocomplete="off"/>
								   <label class="floating-label">Home District</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="owner_region" name="owner_region" class="form-control" autocomplete="off">
								   		<option></option>
										<option <?= $owner['region'] == "Greater Accra"?'selected==selected':''?>>Greater Accra</option>
										<option <?= $owner['region'] == "Western"?'selected==selected':''?>>Western</option>
										<option <?= $owner['region'] == "Central"?'selected==selected':''?>>Central</option>
										<option <?= $owner['region'] == "Eastern"?'selected==selected':''?>>Eastern</option>
										<option <?= $owner['region'] == "Nothern"?'selected==selected':''?>>Nothern</option>
										<option <?= $owner['region'] == "Upper East"?'selected==selected':''?>>Upper East</option>
										<option <?= $owner['region'] == "Upper West"?'selected==selected':''?>>Upper West</option>
										<option <?= $owner['region'] == "Volta"?'selected==selected':''?>>Volta</option>
										<option <?= $owner['region'] == "Ashanti"?'selected==selected':''?>>Ashanti</option>
										<option <?= $owner['region'] == "Brong Ahafo"?'selected==selected':''?>>Brong Ahafo</option>
									</select>
								   <label class="floating-label">Region</label>
								</div>	
							</div>
							</div>			            
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-10">
				                <button class="btn btn-primary open1" id="next" type="button">Next <span class="fa fa-arrow-right"></span></button> 
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
											<option <?=$residence['area_council']== $a->id?'selected == selected':''; ?> value="<?= $a->id?>"><?=$a->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Area Coucil</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
									<input type="text" class="form-control hidden" id="rescode" value="<?=$residence['res_code']?>" name="rescode"/>
									<input type="text" class="form-control hidden" id="townn" value="<?= $residence['town']?>" autocomplete="off"/>
								   <select id="town" name="town" class="form-control" autocomplete="off" required>
										<option></option>
									</select>
								   <label class="floating-label">Locality/Town</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="streetname" value="<?= $residence['streetname']?>" name="streetname" autocomplete="off" required/>
								   <label class="floating-label">Surburb/Street Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="landmark" value="<?= $residence['landmark']?>" name="landmark" autocomplete="off" required/>
								   <label class="floating-label">Landmark(if any)</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="locality_code" name="locality_code" value="<?=$residence['locality_code']?>" autocomplete="off" required/>
								   <label class="floating-label">Locality Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="street_code" name="street_code" value="<?=$residence['street_code']?>" autocomplete="off" required/>
								   <label class="floating-label">Street Code</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="new_property_no" name="new_property_no" value="<?=$residence['new_property_no']?>" autocomplete="off" required/>
								   <label class="floating-label">New Property No</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="old_property_no" name="old_property_no" value="<?=$residence['old_property_no']?>" autocomplete="off" required/>
								   <label class="floating-label">Old Property No</label>
								</div>	
							</div>
							
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="zone_code" name="zone_code" value="<?= $residence['zone_code']?>" autocomplete="off" required/>
								   <label class="floating-label">Zone Code</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="ghpost_gps" value="<?= $residence['ghpost_gps']?>" name="ghpost_gps" autocomplete="off" required/>
								   <label class="floating-label">Ghanapost GPS code (optional)</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="houseno" name="houseno" autocomplete="off" value="<?= $residence['houseno']?>" required/>
								   <label class="floating-label">House No</label>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open2" onClick="property()" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf3" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Property Data (Step 3 of 4)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="property_type" name="property_type" onChange="property()" class="form-control" autocomplete="off" required>
										<option <?=$residence['property_type']=='Detached'?'selected == selected':''; ?>>Detached</option>
										<option <?=$residence['property_type']=='Semi-Detached'?'selected == selected':''; ?>>Semi-Detached</option>
										<option <?=$residence['property_type']=='Compound'?'selected == selected':''; ?>>Compound</option>
										<option <?=$residence['property_type']=='Storey'?'selected == selected':''; ?>>Storey</option>
										<option <?=$residence['property_type']=='Terrace'?'selected == selected':''; ?>>Terrace</option>
										<option <?=$residence['property_type']=='Flat'?'selected == selected':''; ?>>Flat</option>
									</select>
								   <label class="floating-label">Property Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="floor" style="display: none;">
								   <input type="text" class="form-control" id="no_of_floors" value="<?=$residence['no_of_floors']?>" name="no_of_floors" autocomplete="off"/>
								   <label class="floating-label">No Of Storeys / Floors</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="grade_type" name="grade_type" class="form-control" autocomplete="off" required>
										<option <?=$residence['grade_type']=='Grade 1'?'selected == selected':''; ?>>Grade 1</option>
										<option <?=$residence['grade_type']=='Grade 2'?'selected == selected':''; ?>>Grade 2</option>
										<option <?=$residence['grade_type']=='Grade 3'?'selected == selected':''; ?>>Grade 3</option>
										<option <?=$residence['grade_type']=='Grade 4'?'selected == selected':''; ?>>Grade 4</option>
									</select>
								   <label class="floating-label">Grade</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="no_of_rooms" value="<?= $residence['no_of_rooms']?>" name="no_of_rooms" autocomplete="off" required/>
								   <label class="floating-label">No Of Rooms</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="construction_material" name="construction_material" class="form-control" autocomplete="off" required>
										<option></option>
										<?php foreach($construction as $con){?>
											<option <?=$residence['construction_material']==$con->id?'selected == selected':''; ?> value="<?=$con->id?>"><?=$con->material?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Construction Material</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="roofing_type" name="roofing_type" class="form-control" autocomplete="off" required>
										<option></option>
										<?php foreach($roof as $rof){?>
											<option <?=$residence['roofing_type']==$rof->id?'selected == selected':''; ?> value="<?=$rof->id?>"><?=$rof->roof?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Roofing Type</label>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open3" onClick="check()" type="button">Next <span class="fa fa-arrow-right"></button> 
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
										<option <?=$residence['toilet_facility']=='Yes'?'selected == selected':''; ?>>Yes</option>
										<option <?=$residence['toilet_facility']=='No'?'selected == selected':''; ?>>No</option>
									</select>
								   <label class="floating-label">Toilet Facility</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="t_yes">
								   <select id="t_facility_yes" name="t_facility_yes" class="form-control" autocomplete="off" required>
										<option <?=$residence['t_facility_yes']=='WC'?'selected == selected':''; ?>>WC</option>
										<option <?=$residence['t_facility_yes']=='VIP'?'selected == selected':''; ?>>VIP</option>
										<option <?=$residence['t_facility_yes']=='Aqua Privy'?'selected == selected':''; ?>>Aqua Privy</option>
									</select>
								   <label class="floating-label">Toilet Facility Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="t_no">
								   <select id="t_facility_no" name="t_facility_no" class="form-control" autocomplete="off" required>
										<option <?=$residence['t_facility_no']=='KVIP'?'selected == selected':''; ?>>KVIP</option>
										<option <?=$residence['t_facility_no']=='Unapproved Location(Seashore,bush)'?'selected == selected':''; ?>>Unapproved Location(Seashore,bush)</option>
									</select>
								   <label class="floating-label">Toilet Facility Type</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="avai_of_water" name="avai_of_water" class="form-control" autocomplete="off" required>
										<option <?=$residence['avai_of_water']=='Yes'?'selected == selected':''; ?>>Yes</option>
										<option <?=$residence['avai_of_water']=='No'?'selected == selected':''; ?>>No</option>
									</select>
								   <label class="floating-label">Availability Of Water</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="water_yes">
								   <select id="source_water_yes" name="source_water_yes" class="form-control" autocomplete="off" required>
										<option <?=$residence['source_water_yes']=='GWC'?'selected == selected':''; ?>>GWC</option>
										<option <?=$residence['grade_type']=='Borehole'?'selected == selected':''; ?>>Borehole</option>
										<option <?=$residence['grade_type']=='Hand Dug Well'?'selected == selected':''; ?>>Hand Dug Well</option>
										<option <?=$residence['grade_type']=='Small town water system'?'selected == selected':''; ?>>Small town water system</option>
									</select>
								   <label class="floating-label">Source Of water</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="water_no">
								   <select id="source_water_no" name="source_water_no" class="form-control" autocomplete="off" required>
										<option <?=$residence['source_water_no']=='River'?'selected == selected':''; ?>>River</option>
										<option <?=$residence['source_water_no']=='Stream'?'selected == selected':''; ?>>Stream</option>
										<option <?=$residence['source_water_no']=='Brookes'?'selected == selected':''; ?>>Brookes</option>
										<option <?=$residence['source_water_no']=='Otherss'?'selected == selected':''; ?>>Others</option>
									</select>
								   <label class="floating-label">Source Of water</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="avai_of_refuse" name="avai_of_refuse" class="form-control" autocomplete="off" required>
										<option <?=$residence['avai_of_refuse']=='Yes'?'selected == selected':''; ?>>Yes</option>
										<option <?=$residence['avai_of_refuse']=='No'?'selected == selected':''; ?>>No</option>
									</select>
								   <label class="floating-label">Means of Waste Disposal</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="refuse_yes">
								   <select id="dumping_site_yes" name="dumping_site_yes" class="form-control" autocomplete="off" required>
										<option <?=$residence['dumping_site_yes']=='Waste Company'?'selected == selected':''; ?>>Waste Company</option>
										<option <?=$residence['dumping_site_yes']=='Public Waste Management Site'?'selected == selected':''; ?>>Public Waste Management Site</option>
									</select>
								   <label class="floating-label">Mode of Disposal</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="refuse_no">
								   <select id="dumping_site_no" name="dumping_site_no" class="form-control" autocomplete="off" required>
										<option <?=$residence['dumping_site_no']=='Skip Container'?'selected == selected':''; ?>>Skip Container</option>
										<option <?=$residence['dumping_site_no']=='Unengeered Sites'?'selected == selected':''; ?>>Unengeered sites</option>
									</select>
								   <label class="floating-label">Dumping Site</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="building_permit" name="building_permit" onchange="b_permit()" class="form-control" autocomplete="off" required>
										<option <?=$residence['building_permit']=='Yes'?'selected == selected':''; ?>>Yes</option>
										<option <?=$residence['building_permit']=='No'?'selected == selected':''; ?>>No</option>
									</select>
								   <label class="floating-label">Building Permit</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="b_permit" style="display: none;">
								   <input type="text" class="form-control" id="building_cert_no" value="<?=$residence['building_cert_no']?>" name="building_cert_no" autocomplete="off"/>
								   <label class="floating-label">Building Permit No</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6 hidden">
								   <input type="text" class="form-control" id="resid" value="<?= $residence['id']?>" name="resid" autocomplete="off" required/>
								   <label class="floating-label">No Of Rooms</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6 hidden">
								   <input type="text" class="form-control" id="ownid" value="<?= $owner['id']?>" name="ownid" autocomplete="off" required/>
								   <label class="floating-label">No Of Rooms</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   	<select id="planning_permit" name="planning_permit" onchange="p_permit()" class="form-control" autocomplete="off" required>
										<option <?=$residence['planning_permit']=='Yes'?'selected == selected':''; ?>>Yes</option>
										<option <?=$residence['planning_permit']=='No'?'selected == selected':''; ?>>No</option>
									</select>
								   <label class="floating-label">Planning Permit</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="p_permit" style="display: none;">
								   <input type="text" class="form-control" id="planning_permit_no" value="<?=$residence['planning_permit_no']?>" name="planning_permit_no" autocomplete="off"/>
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