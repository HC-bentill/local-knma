<div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <h4 class="modal-title" id="exampleOptionalLarge">Agent Registration</h4>
            </div>
            <div class="modal-body">
            	<div class="panel panel-primary">
				    <div class="panel-body">
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Residence/add_residence">
				        
				        <div id="sf1" class="frm">
				            <legend>Personnal Data (Step 1 of 6)</legend>
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" required/>
								   <label class="floating-label">First Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" required/>
								   <label class="floating-label">Last name</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control calender" id="dob" name="dob" autocomplete="off" required/>
								   <label class="floating-label">Date Of Birth</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" autocomplete="off" required/>
								   <label class="floating-label">Place Of Birth</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="gender" name="gender" class="form-control" autocomplete="off" required>
								   		<option></option>
								   		<option>Male</option>
										<option>Female</option>
									</select>
								   <label class="floating-label">Gender</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="primary_contact" name="primary_contact" autocomplete="off" required/>
								   <label class="floating-label">Primary Contact</label>
								</div>
							</div>				
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="secondary_contact" name="secondary_contact" autocomplete="off"/>
								   <label class="floating-label">Secondary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="email" name="email" autocomplete="off"/>
								   <label class="floating-label">Email</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="nationality" name="nationality" class="form-control" autocomplete="off" required>
								   		<option></option>
								   		<option>Ghanaian</option>
										<option>Non-Ghanaian</option>
									</select>
								   <label class="floating-label">Nationality</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="idt" style="display: none;">
								   <select id="id_type" name="id_type" class="form-control" autocomplete="off">
								   		<option></option>
								   		<option>National ID</option>
										<option>Voters ID</option>
										<option>NHIS</option>
										<option>Drivers License</option>
										<option>Passport</option>
									</select>
								   <label class="floating-label">ID Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="count">
								   <input type="text" class="form-control" id="country" name="country" autocomplete="off"/>
								   <label class="floating-label">Country</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="idn">
								   <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off"/>
								   <label class="floating-label">ID Number</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="nat">
								   <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" autocomplete="off"/>
								   <label class="floating-label">National ID</label>
								</div>
							</div>
							<div class="form-group">
				              <div class="col-lg-10 col-lg-offset-10">
				                <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>
				        </div>
				        <div id="sf2" class="frm" style="display: none;">
				            <legend>Location Data (Step 2 of 6)</legend>
				           <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="has_res_code" name="has_res_code" class="form-control" onChange="res_div()" autocomplete="off" required>
								   		<option></option>
								   		<option>Yes</option>
										<option>No</option>
									</select>
								   <label class="floating-label">Agent Has Residence Code </label>
								</div>
								
								<div class="col-sm-12 col-xs-12 col-md-6" id="code" style="display:none">
								   <input type="text" class="form-control" id="res_prop_code" name="res_prop_code" onKeyUp="check_res_code();" autocomplete="off" required/>
								   <label class="floating-label">Residencial Code</label>
								   <span id="status" class="label label-danger" style="display:none">Invalid</span>
								   <span id="statuss" class="label label-success" style="display:none">Valid</span>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="location2" style="display:none">
								   <select id="area_council" name="area_council" onChange="get_street()" class="form-control" autocomplete="off" required>
								   		<option></option>
										<?php foreach($area as $a){ ?>
											<option value="<?= $a->id?>"><?=$a->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Area Coucil</label>
								</div>
							</div>
							
					        <div id="location" style="display:none">  
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="town" name="town" class="form-control" autocomplete="off" required>
										<option></option>
									</select>
								   <label class="floating-label">Locality/Town</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="streetname" name="streetname" autocomplete="off" required/>
								   <label class="floating-label">Surburb/Street Name</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="landmark" name="landmark" autocomplete="off" required/>
								   <label class="floating-label">Landmark(if any)</label>
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
				            <legend>Educational Data (Step 3 of 6)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="name_of_inst" name="name_of_inst" autocomplete="off" required/>
								   <label class="floating-label">Name Of Institution</label>
								</div>

								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="highest_edu" name="highest_edu" class="form-control" autocomplete="off" required>
								   		<option></option>
								   		<?php foreach($education as $e){ ?>
											<option value="<?= $e->id?>"><?=$e->level?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Highest Education Level</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="class_of_honor" name="class_of_honor" autocomplete="off"/>
								   <label class="floating-label">Aggregate/Class Of Honor</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="previous_employer" name="previous_employer" autocomplete="off" required/>
								   <label class="floating-label">Previous Employer</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="tax_iden_no" name="tax_iden_no" autocomplete="off" required/>
								   <label class="floating-label">Tax Identification Number</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="ssnit_no" name="ssnit_no" autocomplete="off" required/>
								   <label class="floating-label">SSNIT No</label>
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
				            <legend>Family Data (Step 4 of 6)</legend>

				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="spouse_name" name="spouse_name" autocomplete="off"/>
								   <label class="floating-label">Spouse Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="spouse_contact" name="spouse_contact" autocomplete="off"/>
								   <label class="floating-label">Spouse Contact</label>
								</div>
							</div>
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="no_of_children" name="no_of_children" autocomplete="off" required/>
								   <label class="floating-label">No Of Children</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="no_of_dependants" name="no_of_dependants" autocomplete="off" required/>
								   <label class="floating-label">No Of dependants</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_name" name="father_name" autocomplete="off" required/>
								   <label class="floating-label">Fathers Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_contact" name="father_contact" autocomplete="off" required/>
								   <label class="floating-label">Fathers Contact</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_name" name="mother_name" autocomplete="off" required/>
								   <label class="floating-label">Mothers Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_contact" name="mother_contact" autocomplete="off" required/>
								   <label class="floating-label">Mothers Contact</label>
								</div>
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back4" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open4" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>

				          </fieldset>
				        </div>

				        <div id="sf5" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Emergency Contact Data (Step 5 of 6)</legend>

				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="contact_name" name="contact_name" autocomplete="off" required/>
								   <label class="floating-label">Emergency Contact Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="contact_no" name="contact_no" autocomplete="off" required/>
								   <label class="floating-label">Emergency Contact No</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="relationship" name="relationship" autocomplete="off" required/>
								   <label class="floating-label">Relationship</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="next_kin_name" name="next_kin_name" autocomplete="off" required/>
								   <label class="floating-label">Next Of Kin Name</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="next_kin_contact" name="next_kin_contact" autocomplete="off" required/>
								   <label class="floating-label">Next Of Kin Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="relationship_next_kin" name="relationship_next_kin" autocomplete="off" required/>
								   <label class="floating-label">Relationship To Next Of Kin</label>
								</div>
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back5" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-primary open5" type="button">Next <span class="fa fa-arrow-right"></span></button> 
				              </div>
				            </div>

				          </fieldset>
				        </div>

				        <div id="sf6" class="frm" style="display: none;">
				          <fieldset>
				            <legend>Access And Reward (Step 6 of 6)</legend>

							<div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="profile" name="profile " class="form-control" autocomplete="off" required>
								   		<option></option>
								   		<option value="1">Profile 1</option>
										<option value="2">Profile 2</option>
									</select>
								   <label class="floating-label">Profile</label>
								</div>
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back6" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
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