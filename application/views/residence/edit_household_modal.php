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
				      <form name="basicform" id="basicform" method="post" action="<?=base_url()?>Residence/edit_household">
				        
				        <div id="sf1" class="frm">
				            <legend>Personnal Data (Step 1 of 3)</legend>
				            <div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" value="<?=$household['firstname']?>" required/>
								   <label class="floating-label">First Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" value="<?=$household['lastname']?>" required/>
								   <label class="floating-label">Last name</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control calender" id="dob" name="dob" autocomplete="off" value="<?=$household['dob']?>" required/>
								   <label class="floating-label">Date Of Birth</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" autocomplete="off" value="<?=$household['place_of_birth']?>" required/>
								   <label class="floating-label">Place Of Birth</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="gender" name="gender" class="form-control" autocomplete="off" required>
								   		<option></option>
								   		<option <?=$household['gender'] == "Male"?'selected==selected':''?>>Male</option>
										<option <?=$household['gender'] == "Female"?'selected==selected':''?>>Female</option>
									</select>
								   <label class="floating-label">Gender</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="primary_contact" name="primary_contact" autocomplete="off" value="<?=$household['primary_contact']?>" required/>
								   <label class="floating-label">Primary Contact</label>
								</div>
							</div>				
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="secondary_contact" name="secondary_contact" value="<?=$household['secondary_contact']?>" autocomplete="off"/>
								   <label class="floating-label">Secondary Contact</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="email" name="email" value="<?=$household['email']?>" autocomplete="off"/>
								   <label class="floating-label">Email</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="nationality" name="nationality" class="form-control" autocomplete="off" required>
								   		<option <?=$household['nationality'] == "Ghanaian"?'selected==selected':''?>>Ghanaian</option>
										<option <?=$household['nationality'] == "Non-Ghanaian"?'selected==selected':''?>>Non-Ghanaian</option>
									</select>
								   <label class="floating-label">Nationality</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="idt">
								   <select id="id_type" name="id_type" class="form-control" autocomplete="off">
								   		<option></option>
								   		<option <?=$household['id_type'] == "National ID"?'selected==selected':''?>>National ID</option>
										<option <?=$household['id_type'] == "Voters ID"?'selected==selected':''?>>Voters ID</option>
										<option <?=$household['id_type'] == "NHIS"?'selected==selected':''?>>NHIS</option>
										<option <?=$household['id_type'] == "Drivers License"?'selected==selected':''?>>Drivers License</option>
										<option <?=$household['id_type'] == "Passport"?'selected==selected':''?>>Passport</option>
									</select>
								   <label class="floating-label">ID Type</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="count">
								   <input type="text" class="form-control" id="country" name="country" value="<?=$household['country']?>" autocomplete="off"/>
								   <label class="floating-label">Country</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6" id="idn">
								   <input type="text" class="form-control" id="id_number" name="id_number" value="<?=$household['id_number']?>" autocomplete="off"/>
								   <label class="floating-label">ID Number</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="nat">
								   <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" value="<?=$household['nat_id_no']?>" autocomplete="off"/>
								   <label class="floating-label">National ID</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="head_of_household" name="head_of_household" value="<?=$household['head_of_household']?>" autocomplete="off"/>
								   <label class="floating-label">Head Of Household</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="religion" name="religion" class="form-control" onChange="check_religion()" autocomplete="off">
								   		<option></option>
								   		<option <?=$household['religion'] == "Christianity"?'selected==selected':''?>>Christianity</option>
										<option <?=$household['religion'] == "Islamic"?'selected==selected':''?>>Islamic</option>
										<option <?=$household['religion'] == "Traditional"?'selected==selected':''?>>Traditional</option>
										<option <?=$household['religion'] == "Buddhism"?'selected==selected':''?>>Buddhism</option>
										<option <?=$household['religion'] == "Atheism"?'selected==selected':''?>>Atheism</option>
										<option <?=$household['religion'] == "Others"?'selected==selected':''?>>Others</option>
									</select>
								   <label class="floating-label">Religion</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" style="display: none;" id="others">
								   <input type="text" class="form-control" id="other_religion" name="other_religion" value="<?=$household['other_religion']?>" autocomplete="off"/>
								   <label class="floating-label">Specify Name</label>
								</div>
							</div>	
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="res_prop_code" onKeyUp="check_res_code();" name="res_prop_code" value="<?=$household['res_prop_code']?>" autocomplete="off" required/>
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
											<option <?=$e->id == $household['highest_edu']?"selected==selected":'' ?> value="<?= $e->id?>"><?=$e->level?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Highest Education</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="profession" name="profession" class="form-control" autocomplete="off" required>
								   		<option></option>
										<?php foreach($profession as $p){ ?>
											<option <?= $p->id == $household['profession']?"selected==selected":''?> value="<?= $p->id?>"><?=$p->name?></option>
										<?php } ?>
									</select>
								   <label class="floating-label">Profession</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="employment_status" name="employment_status" class="form-control" autocomplete="off" required>
								   		<option <?=$household['employment_status'] == "Employed"?"selected==selected":''?>>Employed</option>
										<option <?=$household['employment_status'] == "Self-Employed"?"selected==selected":''?>>Self-Employed</option>
										<option <?=$household['employment_status'] == "Unemployed"?"selected==selected":''?>>Unemployed</option>
									</select>
								   <label class="floating-label">Employment Status</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control calender" id="date_of_last_emp" name="date_of_last_emp" value="<?=$household['date_of_last_emp']?>" autocomplete="off"/>
								   <label class="floating-label">Date Of last Employment</label>
								</div>	
							</div>
							<div class="form-group form-material floating row" id="employed">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="employer_name" name="employer_name" value="<?=$household['employer_name']?>" autocomplete="off"/>
								   <label class="floating-label">Employer Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="current_occupation" name="current_occupation" value="<?=$household['current_occupation']?>" autocomplete="off"/>
								   <label class="floating-label">Current Occcupation</label>
								</div>	
							</div>
							<div class="form-group form-material floating row" id="selfemployed" style="display: none;">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="buisness_name" name="buisness_name" value="<?=$household['buisness_name']?>" autocomplete="off"/>
								   <label class="floating-label">Business Name</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="type_of_buisness" name="type_of_buisness" value="<?=$household['type_of_buisness']?>" autocomplete="off"/>
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
										<option <?=$household['marital_status'] == "Single"?"selected==selected":''?>>Single</option>
										<option <?=$household['marital_status'] == "Married"?"selected==selected":''?>>Married</option>
										<option <?=$household['marital_status'] == "Divorced"?"selected==selected":''?>>Divorced</option>
										<option <?=$household['marital_status'] == "Seperated"?"selected==selected":''?>>Seperated</option>
									</select>
								   <label class="floating-label">Marital Status</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="number" min="0" class="form-control" onKeyUp="birth()" id="no_of_kids" name="no_of_kids" value="<?=$household['no_of_kids']?>" autocomplete="off"/>
								   <label class="floating-label">No Of Kids</label>
								</div>	
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6" id="first_birth" style="display: none;">
								   <input type="text" class="form-control calender" id="firstborn_dob" name="firstborn_dob" value="<?=$household['firstborn_dob']?>" autocomplete="off"/>
								   <label class="floating-label">First Born DOB</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6" id="last_birth" style="display: none;">
								   <input type="text" class="form-control calender" id="lastborn_dob" name="lastborn_dob" value="<?=$household['lastborn_dob']?>" autocomplete="off"/>
								   <label class="floating-label">Last Born DOB</label>
								</div>
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="hometown" name="hometown" autocomplete="off" value="<?=$household['hometown']?>" required/>
								   <label class="floating-label">Hometown</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="home_district" name="home_district" autocomplete="off" value="<?=$household['home_district']?>" required/>
								   <label class="floating-label">Home District</label>
								</div>
									
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="region" name="region" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option <?=$household['region'] == "Greater Accra"?"selected==selected":''?>>Greater Accra</option>
										<option <?=$household['region'] == "Western"?"selected==selected":''?>>Western</option>
										<option <?=$household['region'] == "Central"?"selected==selected":''?>>Central</option>
										<option <?=$household['region'] == "Eastern"?"selected==selected":''?>>Eastern</option>
										<option <?=$household['region'] == "Nothern"?"selected==selected":''?>>Nothern</option>
										<option <?=$household['region'] == "Upper East"?"selected==selected":''?>>Upper East</option>
										<option <?=$household['region'] == "Upper West"?"selected==selected":''?>>Upper West</option>
										<option <?=$household['region'] == "Volta"?"selected==selected":''?>>Volta</option>
										<option <?=$household['region'] == "Ashanti"?"selected==selected":''?>>Ashanti</option>
										<option <?=$household['region'] == "Brong Ahafo"?"selected==selected":''?>>Brong Ahafo</option>
									</select>
								   <label class="floating-label">Region</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="ethnicity" name="ethnicity" autocomplete="off" value="<?=$household['ethnicity']?>" required/>
								   <label class="floating-label">Ethnicity</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="native_lan" name="native_lan" autocomplete="off" value="<?=$household['native_lan']?>" required/>
								   <label class="floating-label">Native Language</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_firstname" name="father_firstname" autocomplete="off" value="<?=$household['father_firstname']?>" required/>
								   <label class="floating-label">Father's Firstname</label>
								</div>
									
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="father_lastname" name="father_lastname" autocomplete="off" value="<?=$household['father_lastname']?>" required/>
								   <label class="floating-label">Father's Lastname</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="father_clan" name="father_clan" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option <?=$household['father_clan'] == "EZOHILE"?"selected==selected":''?>>EZOHILE</option>
										<option <?=$household['father_clan'] == "ASAMANGAMA"?"selected==selected":''?>>ASAMANGAMA</option>
										<option <?=$household['father_clan'] == "AZANWUNLE"?"selected==selected":''?>>AZANWUNLE</option>
										<option <?=$household['father_clan'] == "NVAVILE"?"selected==selected":''?>>NVAVILE</option>
										<option <?=$household['father_clan'] == "NDWEAFO)"?"selected==selected":''?>>NDWEAFO)</option>
										<option <?=$household['father_clan'] == "ADANHONLE"?"selected==selected":''?>>ADANHONLE</option>
										<option <?=$household['father_clan'] == "ALLONROBA"?"selected==selected":''?>>ALLONROBA</option>
										<option <?=$household['father_clan'] == "None"?"selected==selected":''?>>None</option>
									</select>
								   <label class="floating-label">Abusua/Clan</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_firstname" name="mother_firstname" autocomplete="off" value="<?=$household['mother_firstname']?>" required/>
								   <label class="floating-label">Mother's Firstname</label>
								</div>	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <input type="text" class="form-control" id="mother_lastname" name="mother_lastname" autocomplete="off" value="<?=$household['mother_lastname']?>" required/>
								   <label class="floating-label">Mother's Lastname</label>
								</div>
								
							</div>
							<div class="form-group form-material floating row">
	
								<div class="col-sm-12 col-xs-12 col-md-6">
								   <select id="mother_clan" name="mother_clan" class="form-control" autocomplete="off" required>
								   		<option></option>
										<option <?=$household['mother_clan'] == "EZOHILE"?"selected==selected":''?>>EZOHILE</option>
										<option <?=$household['mother_clan'] == "ASAMANGAMA"?"selected==selected":''?>>ASAMANGAMA</option>
										<option <?=$household['mother_clan'] == "AZANWUNLE"?"selected==selected":''?>>AZANWUNLE</option>
										<option <?=$household['mother_clan'] == "NVAVILE"?"selected==selected":''?>>NVAVILE</option>
										<option <?=$household['mother_clan'] == "NDWEAFO)"?"selected==selected":''?>>NDWEAFO)</option>
										<option <?=$household['mother_clan'] == "ADANHONLE"?"selected==selected":''?>>ADANHONLE</option>
										<option <?=$household['mother_clan'] == "ALLONROBA"?"selected==selected":''?>>ALLONROBA</option>
										<option <?=$household['mother_clan'] == "None"?"selected==selected":''?>>None</option>
									</select>
								   <label class="floating-label">Abusua/Clan</label>
								</div>
								<div class="col-sm-12 col-xs-12 col-md-6 hidden">
								   <input type="text" class="form-control" id="id" name="id" autocomplete="off" value="<?=$household['id']?>" required/>
								   <label class="floating-label">id</label>
								</div>	
							</div>
							<legend>Community Needs</legend>
							<div class="form-group form-material floating row">
								<div class="col-sm-12 col-xs-12 col-md-12">
								   <select id="com_needs" name="com_needs[]" class="form-control chosen" autocomplete="off" multiple required style="border-top: none;" placeholder="Select Community needs">
								   		<?php
			                              $need = explode(',', $needs);
			                              foreach($com as $co){
			                                  $name = $co->need;
			                                  $id = $co->id;
			                                  $sel = '';
			                                  if (in_array($id,$need)) {
			                                   $sel = ' selected="selected" '; echo '<option ' . $sel . ' value="' . $id . '">' . $name . '</option>'; 
			                                 }else{ echo '<option value="' . $id . '">' . $name . '</option>'; }
			                                        
			                            }   
			                            ?>
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