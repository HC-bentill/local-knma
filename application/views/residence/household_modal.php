<div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
              </button>
              <h4 class="modal-title" id="exampleOptionalLarge">Household Registration</h4>
            </div>
            <div class="modal-body">
            	<div class="panel panel-primary">
				    <div class="panel-body">
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Residence/add_household">
				        
				        <div id="sf1" class="frm">
				            <legend>Personnal Data (Step 1 of 3)</legend>
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
								   		<option>Ghanaian</option>
										<option>Non-Ghanaian</option>
									</select>
								   <label class="floating-label">Nationality</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="idt">
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
								<div class="col-sm-12 col-xs-12 col-md-6" id="idn">
								   <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off"/>
								   <label class="floating-label">ID Number</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="nat">
								   <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" autocomplete="off"/>
								   <label class="floating-label">National ID</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="head_of_household" name="head_of_household" autocomplete="off"/>
								   <label class="floating-label">Head Of Household</label>
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
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="res_prop_code" onKeyUp="check_res_code();" name="res_prop_code" autocomplete="off" required="" />
								   <label class="floating-label">Residence Code</label>
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
				            <legend>Education & Profession Data (Step 2 of 3)</legend>
					            
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="highest_edu" name="highest_edu" class="form-control" autocomplete="off" required>
								   		<option></option>
										<?php foreach($education as $e){ ?>
											<option value="<?= $e->id?>"><?=$e->level?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Highest Education</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="profession" name="profession" class="form-control" autocomplete="off" required>
								   		<option></option>
										<?php foreach($profession as $p){ ?>
											<option value="<?= $p->id?>"><?=$p->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Profession</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="employment_status" name="employment_status" class="form-control" autocomplete="off" required>
								   		<option>Employed</option>
										<option>Self-Employed</option>
										<option>Unemployed</option>
									</select>
								   <label class="floating-label">Employment Status</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control calender" id="date_of_last_emp" name="date_of_last_emp" autocomplete="off"/>
								   <label class="floating-label">Date Of last Employment</label>
								</div>	
							</div>
							<div class="form-group form-material floating row" id="employed">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="employer_name" name="employer_name" autocomplete="off"/>
								   <label class="floating-label">Employer Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="current_occupation" name="current_occupation" autocomplete="off"/>
								   <label class="floating-label">Current Occcupation</label>
								</div>	
							</div>
							<div class="form-group form-material floating row" id="selfemployed" style="display: none;">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buisness_name" name="buisness_name" autocomplete="off"/>
								   <label class="floating-label">Business Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="type_of_buisness" name="type_of_buisness" autocomplete="off"/>
								   <label class="floating-label">Type Of Business</label>
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
				            <legend>Family Data (Step 3 of 3)</legend>
				            	
				            <div class="form-group form-material floating row">
				            	<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="marital_status" name="marital_status" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>Single</option>
										<option>Married</option>
										<option>Divorced</option>
										<option>Seperated</option>
									</select>
								   <label class="floating-label">Marital Status</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="number" min="0" class="form-control" onKeyUp="birth()" id="no_of_kids" name="no_of_kids" autocomplete="off"/>
								   <label class="floating-label">No Of Kids</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6" id="first_birth" style="display: none;">
								   <input type="text" class="form-control calender" id="firstborn_dob" name="firstborn_dob" autocomplete="off"/>
								   <label class="floating-label">First Born DOB</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="last_birth" style="display: none;">
								   <input type="text" class="form-control calender" id="lastborn_dob" name="lastborn_dob" autocomplete="off"/>
								   <label class="floating-label">Last Born DOB</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="hometown" name="hometown" autocomplete="off" required/>
								   <label class="floating-label">Hometown</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="home_district" name="home_district" autocomplete="off" required/>
								   <label class="floating-label">Home District</label>
								</div>
									
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="region" name="region" class="form-control" autocomplete="off" required>
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
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="ethnicity" name="ethnicity" autocomplete="off" required/>
								   <label class="floating-label">Ethnicity</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="native_lan" name="native_lan" autocomplete="off" required/>
								   <label class="floating-label">Native Language</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_firstname" name="father_firstname" autocomplete="off" required/>
								   <label class="floating-label">Father's Firstname</label>
								</div>
									
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_lastname" name="father_lastname" autocomplete="off" required/>
								   <label class="floating-label">Father's Lastname</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="father_clan" name="father_clan" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>EZOHILE</option>
										<option>ASAMANGAMA</option>
										<option>AZANWUNLE</option>
										<option>NVAVILE</option>
										<option>NDWEAFO)</option>
										<option>ADANHONLE</option>
										<option>ALLONROBA</option>
										<option>None</option>
									</select>
								   <label class="floating-label">Abusua/Clan</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_firstname" name="mother_firstname" autocomplete="off" required/>
								   <label class="floating-label">Mother's Firstname</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_lastname" name="mother_lastname" autocomplete="off" required/>
								   <label class="floating-label">Mother's Lastname</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="mother_clan" name="mother_clan" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option>EZOHILE</option>
										<option>ASAMANGAMA</option>
										<option>AZANWUNLE</option>
										<option>NVAVILE</option>
										<option>NDWEAFO)</option>
										<option>ADANHONLE</option>
										<option>ALLONROBA</option>
										<option>None</option>
									</select>
								   <label class="floating-label">Abusua/Clan</label>
								</div>	
							</div>
							<legend>Community Needs</legend>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-12">
								   <select id="com_needs" name="com_needs[]" class="form-control chosen" autocomplete="off" multiple required style="border-top: none;" placeholder="Select Community needs">
								   		<option></option>
								   		<?php foreach($com as $co){ ?>
								   		<option value="<?=$co->id?>"><?=$co->need?></option>
								   		<?php } ?>
									</select>
								</div>	
							</div>
				            <div class="form-group">
				              <div class="col-lg-10 col-lg-offset-2">
				                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
				                <button class="btn btn-success" id="save" type="submit">Submit</button> 
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