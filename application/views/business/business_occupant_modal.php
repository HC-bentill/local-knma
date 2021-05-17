<div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <h4 class="modal-title" id="exampleOptionalLarge">Business Occupant Registration</h4>
            </div>
            <div class="modal-body">
            	<div class="panel panel-primary">
				    <div class="panel-body">
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Business/add_business_occupant">
				        
				        <div id="sf1" class="frm">
				            <legend>Business Data (Step 1 of 3)</legend>
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
								   <label class="floating-label">Business Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
								   <label class="floating-label">Business Primary Contact</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" autocomplete="off"/>
								   <label class="floating-label">Business Secondary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buis_website" name="buis_website" autocomplete="off"/>
								   <label class="floating-label">Business Website</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="email" class="form-control" id="buis_email" name="buis_email" autocomplete="off"/>
								   <label class="floating-label">Business E-mail</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" onKeyUp="check_busprop_code();" id="buis_property_code" name="buis_property_code" autocomplete="off" required/>
								   <label class="floating-label">Business property Code</label>
								   <span id="status" class="label label-danger" style="display:none">Invalid</span>
								   <span id="statuss" class="label label-success" style="display:none">Valid</span>
								</div>	
							</div>		            
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-10">
				                <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf2" class="frm" style="display: none;">
				            <legend>Buisness Owner Data (Step 2 of 3)</legend>
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
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf3" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Business Category (Step 3 of 3)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								    <select id="property_category" name="property_category" class="form-control" autocomplete="off" required>
								    	<option></option>
								    	<?php foreach($prop_cat as $prop):?>
										<option value="<?=$prop->id?>"><?=$prop->cat_name?></option>
										<?php endforeach; ?>
									</select>
								   <label class="floating-label">Property Category</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								    <select id="buis_sector" name="buis_sector" class="form-control" autocomplete="off" required>
								    	<option></option>
									</select>
								   <label class="floating-label">Business Sector</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								    <select id="property_type" name="property_type" class="form-control" autocomplete="off" required>
								    	<option></option>
									</select>
								   <label class="floating-label">Property Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="class" name="class" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Class A</option>
										<option>Class B</option>
										<option>Class C</option>
										<option>Class D</option>
										<option>Class E</option>
									</select>
								   <label class="floating-label">Property Class</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="number" class="form-control" id="year_of_est" name="year_of_est" autocomplete="off" required/>
								   <label class="floating-label">Year Of Establishment</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buis_reg_cert_no" name="buis_reg_cert_no" autocomplete="off" required/>
								   <label class="floating-label">Business Registration Cert No<label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="nature_of_buisness" name="nature_of_buisness" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Head Office</option>
										<option>Regional Office</option>
										<option>Branch/District Office</option>
										<option>Agency</option>
										<option>Sole Proprietorship office</option>
									</select>
								   <label class="floating-label">Nature of Business operation</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="number" class="form-control" id="no_of_employees" name="no_of_employees" autocomplete="off" required/>
								   <label class="floating-label">No of Employees<label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="no_of_rooms" name="no_of_rooms" autocomplete="off" required/>
								   <label class="floating-label">No of Rooms/Office space</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="type_of_building" name="type_of_building" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Permanent</option>
										<option>Temporary</option>
									</select>
								   <label class="floating-label">Type of Business Building</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6" id="temp" style="display: none;">
								    <select id="detail_for_temp" name="detail_for_temp" class="form-control" autocomplete="off">
								    	<option></option>
										<option>Wooden Kisok</option>
										<option>Metal Container</option>
										<option>Mobile Van/Car</option>
										<option>Table Top</option>
									</select>
								   <label class="floating-label">Temporary Building Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								    <select id="ownership" name="ownership" class="form-control" autocomplete="off" required>
								    	<option></option>
										<option>Owner</option>
										<option>Rented</option>
										<option>BoTTe</option>
									</select>
								   <label class="floating-label">Ownership</label>
								</div>
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-success open" id="save" type="submit">Submit</button>
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