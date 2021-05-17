<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
          	<main>
  
			  <input id="tab1" type="radio" name="tabs" checked>
			  <label class="label" for="tab1">Personnal Info</label>
			    
			  <input id="tab2" type="radio" name="tabs">
			  <label class="label" for="tab2">Education & Profession Info</label>
			    
			  <input id="tab3" type="radio" name="tabs">
			  <label class="label" for="tab3">Family Info</label>
			  
			  <section class="section" id="content1">
			  	<form autocomplete="off" id="form1" method="post" action="<?=base_url()?>Residence/edit_household_personnal_data">
			  		<div class="form-group row">
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['firstname']?>" id="firstname" name="firstname" required>
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
	                  <input type="text" class="form-control" id="lastname" value="<?=$household['lastname']?>" name="lastname" required>
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
	                  <input type="text" class="form-control" data-plugin-datepicker id="dob" value="<?=$household['dob']?>" name="dob" autocomplete="off" required/>
	                </div>
	              </div>
	              <div class="form-group row">
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Place Of Birth:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['place_of_birth']?>" id="place_of_birth" name="place_of_birth" autocomplete="off" required/>
	                </div>
	                
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Gender:</strong></label>
	                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="gender" name="gender" class="form-control" autocomplete="off" required>
	                      <option value="">SELECT OPTION</option>
	                      <option <?=$household['gender'] == "Male"?'selected==selected':''?> value="Male">Male</option>
	                      <option <?=$household['gender'] == "Female"?'selected==selected':''?> value="Female">Female</option>
	                  </select>
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
	                  <input type="text" class="form-control" id="primary_contact" value="<?=$household['primary_contact']?>" name="primary_contact" required>
	                </div>
	              </div>
	              <div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Contact Relationship:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="contact_relationship" name="contact_relationship" class="form-control" autocomplete="off" required>
												<option value="">SELECT OPTION</option>
												<option <?=$household['type_of_relationship'] == "Owner"?'selected==selected':''?> value="Owner">Owner</option>
												<option <?=$household['type_of_relationship'] == "Grandmother"?'selected==selected':''?> value="Grandmother">Grandmother</option>
												<option <?=$household['type_of_relationship'] == "Grandfather"?'selected==selected':''?> value="Grandfather">Grandfather</option>
												<option <?=$household['type_of_relationship'] == "Mother"?'selected==selected':''?> value="Mother">Mother</option>
												<option <?=$household['type_of_relationship'] == "Father"?'selected==selected':''?> value="Father">Father</option>
												<option <?=$household['type_of_relationship'] == "Son"?'selected==selected':''?> value="Son">Son</option>
												<option <?=$household['type_of_relationship'] == "Sister"?'selected==selected':''?> value="Sister">Sister</option>
												<option <?=$household['type_of_relationship'] == "Brother"?'selected==selected':''?> value="Brother">Brother</option>
												<option <?=$household['type_of_relationship'] == "Wife"?'selected==selected':''?> value="Wife">Wife</option>
												<option <?=$household['type_of_relationship'] == "Husband"?'selected==selected':''?> value="Husband">Husband</option>
												<option <?=$household['type_of_relationship'] == "Daughter"?'selected==selected':''?> value="Daughter">Daughter</option>
												<option <?=$household['type_of_relationship'] == "Niece"?'selected==selected':''?> value="Niece">Niece</option>
												<option <?=$household['type_of_relationship'] == "Nephew"?'selected==selected':''?> value="Nephew">Nephew</option>
												<option <?=$household['type_of_relationship'] == "Cousin"?'selected==selected':''?> value="Cousin">Cousin</option>
												<option <?=$household['type_of_relationship'] == "Great grandchild"?'selected==selected':''?> value="Great grandchild">Great grandchild</option>
										</select>
									</div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Secondary Contact:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['secondary_contact']?>" id="secondary_contact" name="secondary_contact">
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['email']?>" id="email" name="email" autocomplete="off"/>
	                </div>
	              </div>
	              <div class="form-group row">
									<div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Nationality:</strong></label>
	                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="nationality" name="nationality" class="form-control" autocomplete="off" required>
	                    <option value="">SELECT OPTION</option>
	                    <option <?=$household['nationality'] == "Ghanaian"?'selected==selected':''?> value="Ghanaian">Ghanaian</option>
	                    <option <?=$household['nationality'] == "Non-Ghanaian"?'selected==selected':''?>value="Non-Ghanaian">Non-Ghanaian</option>
	                  </select>
	                </div>
	                <div class="col-sm-4" id="idt" style="display: none;">
	                  <label class="control-label text-sm-right pt-2"><strong>ID Type:</strong></label>
	                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="id_type" name="id_type" class="form-control" autocomplete="off" required>
	                    <option value="">SELECT OPTION</option>
	                    <option <?=$household['id_type'] == "National ID"?'selected==selected':''?> value="National ID">National ID</option>
	                    <option <?=$household['id_type'] == "Voters ID"?'selected==selected':''?> value="Voters ID">Voters ID</option>
	                    <option <?=$household['id_type'] == "NHIS"?'selected==selected':''?> value="NHIS">NHIS</option>
	                    <option <?=$household['id_type'] == "Drivers License"?'selected==selected':''?> value="Drivers License">Drivers License</option>
	                    <option <?=$household['id_type'] == "Passport"?'selected==selected':''?> value="Passport">Passport</option>
	                  </select>
	                </div>
	                <div class="col-sm-4" id="count" style="display: none;">
	                  <label class="control-label text-sm-right pt-2"><strong>Country:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['country']?>" id="country" name="country" autocomplete="off" required/>
	                </div>
	                <div class="col-sm-4" id="idn" style="display: none;">
	                  <label class="control-label text-sm-right pt-2"><strong>ID Number:</strong></label>
	                  <input type="text" class="form-control" id="id_number" value="<?=$household['id_number']?>" name="id_number" autocomplete="off" required/>
	                </div>
	                <div class="col-sm-4" id="nat" style="display: none;">
	                  <label class="control-label text-sm-right pt-2"><strong>National ID No:</strong></label>
	                  <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" value="<?=$household['nat_id_no']?>"  autocomplete="off" required/>
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Religion:</strong></label>
	                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" onChange="check_religion()" class="form-control"  id="religion" name="religion" required="">
	                        <option value="">SELECT OPTION</option>
	                        <option <?=$household['religion'] == "Christianity"?'selected==selected':''?> value="Christianity">Christianity</option>
	                        <option <?=$household['religion'] == "Islamic"?'selected==selected':''?> value="Islamic">Islamic</option>
	                        <option <?=$household['religion'] == "Traditional"?'selected==selected':''?> value="Traditional">Traditional</option>
	                        <option <?=$household['religion'] == "Buddhism"?'selected==selected':''?> value="Buddhism">Buddhism</option>
	                        <option <?=$household['religion'] == "Atheism"?'selected==selected':''?> value="Atheism">Atheism</option>
	                        <option <?=$household['religion'] == "Others"?'selected==selected':''?> value="Others">Others</option>
	                  </select>
	                </div>
	                <div class="col-sm-4" style="display: none;" id="others">
	                  <label class="control-label text-sm-right pt-2"><strong>Specify Religion name:</strong></label>
	                  <input type="text" class="form-control" value="<?=$household['other_religion']?>" id="other_religion" name="other_religion" required>
	                </div>
	                <div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Residence Code:</strong></label>
	                  <input type="text" value="<?=$household['res_prop_code']?>" class="form-control" id="res_prop_code" onKeyUp="check_res_code();" name="res_prop_code" autocomplete="off" required="" />
	                  <span id="status" class="badge badge-danger" style="display:none">Invalid</span>
                  	  <span id="statuss" class="badge badge-success" style="display:none">Valid</span>
	                </div>
	              </div>
	              <div class="form-group row">
								<div class="col-sm-4">
	                  <label class="control-label text-sm-right pt-2"><strong>Head Of Household:</strong></label>
	                  <input type="text" class="form-control" id="head_of_household" name="head_of_household" value="<?=$household['head_of_household']?>" autocomplete="off" required/> 
	              </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Tax Identification Number(TIN):</strong></label>
                  <input type="text" class="form-control" value="<?=$household['tin']?>" id="tin" name="tin">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Disability:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="disability" name="disability" class="form-control" autocomplete="off" onChange="b_disability()" required>
                    <option value="">SELECT OPTION</option>
                    <option <?=$household['disability'] == "Yes"?'selected==selected':''?> value="Yes">Yes</option>
                    <option <?=$household['disability'] == "No"?'selected==selected':''?> value="No">No</option>
                  </select>
                </div>
                <div class="col-sm-4" id="s_disability" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Specify Disability:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="specify_disability" name="specify_disability[]" class="form-control" autocomplete="off" multiple="multiple" required>
                    <optgroup label="Physical">
                      <option value="Traumatic brain injury">Traumatic brain injury</option>
                      <option value="Epilepsy">Epilepsy</option>
                      <option value="Cerebral palsy">Cerebral palsy</option>
                      <option value="Cystic fibrosis">Cystic fibrosis</option>
                      <option value="Spinal cord injury">Spinal cord injury</option>
                      <option value="Multiple sclerosis">Multiple sclerosis</option>
                      <option value="Spina bifida">Spina bifida</option>
                      <option value="Prader-Willi syndrome">Prader-Willi syndrome</option>
                    </optgroup>
                    <optgroup label="Visual">
                      <option value="Refractive error">Refractive error</option>
                      <option value="Epilepsy">Epilepsy</option>
                      <option value="Cataract">Cataract</option>
                      <option value="Glaucoma">Glaucoma</option>
                      <option value="Age Related Macular Degeneration">Age Related Macular Degeneration</option>
                      <option value="Corneal Opacification">Corneal Opacification</option>
                      <option value="Diabetic Retinopathy">Diabetic Retinopathy</option>
                      <option value="Childhood Blindness">Childhood Blindness</option>
                      <option value="Trachoma">Trachoma</option>
                    </optgroup>
                    <optgroup label="Hearing">
                      <option value="Acoustic Neuroma">Acoustic Neuroma.</option>
                      <option value="Autoimmune Inner Ear Disease">Autoimmune Inner Ear Disease</option>
                      <option value="Barotrauma">Barotrauma</option>
                      <option value="Cogan's Patient Story">Cogan's Patient Story</option>
                      <option value="Cogan's Syndrome">Cogan's Syndrome</option>
                      <option value="Congenital Deafness">Congenital Deafness</option>
                      <option value="Ear Wax">Ear Wax</option>
                      <option value="Gentamicin Toxicity">Gentamicin Toxicity</option>
                    </optgroup>
                    <optgroup label="Mental Health">
                      <option value="Alcohol/Substance abuse">Alcohol/Substance abuse</option>
                      <option value="Alcohol/Substance Dependence">Alcohol/Substance Dependence.</option>
                      <option value="Anxiety Disorders">Anxiety Disorders</option>
                      <option value="Adult Attention Deficit Hyperactive Disorder">Adult Attention Deficit Hyperactive Disorder</option>
                      <option value="Bipolar Disorder-Drepression, Hypomanic, Manic">Bipolar Disorder-Drepression, Hypomanic, Manic</option>
                      <option value="Depression">Depression</option>
                      <option value="Eating Disorders">Eating Disorders</option>
                      <option value="Generalized Anxiety Disorder">Generalized Anxiety Disorder</option>
                    </optgroup>
                    <optgroup label="Intellectual">
                      <option value="Fragile X syndrome">Fragile X syndrome</option>
                      <option value="Down syndrome">Down syndrome</option>
                      <option value="Developmental delay">Developmental delay</option>
                      <option value="Prader-Willi Syndrome (PWS)">Prader-Willi Syndrome (PWS)</option>
                      <option value="Fetal alcohol spectrum disorder (FASD)">Fetal alcohol spectrum disorder (FASD)</option>
                    </optgroup>
                    <optgroup label="Learning">
                      <option value="Auditory Processing Disorder">Auditory Processing Disorder</option>
                      <option value="Dyscalculia">Dyscalculia</option>
                      <option value="Dysgraphia">Dysgraphia</option>
                      <option value="Dyslexia">Dyslexia</option>
                      <option value="Language Processing Disorder">Language Processing Disorder</option>
                      <option value="Non-Verbal Learning Disabilities">Non-Verbal Learning Disabilities</option>
                      <option value="Visual Perceptual/Visual motor Defect">Visual Perceptual/Visual motor Defect</option>
                      <option value="ADHD">ADHD</option>
                    </optgroup>
                  </select>
                </div>
              </div>
	              <div class="form-group row">
	                    <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
	                    <div class="col-sm-4 pull-right">
	                        <input name="id" value="<?= $household['id']?>" type="hidden">
	                        <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button">
	                    </div>
	                </div>
          		</form>
			  </section>
			  
			  <section class="section" id="content2">
			  	<form autocomplete="off" id="form2" method="post" action="<?=base_url()?>Residence/edit_household_edu_data">
			  		  <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Highest Education:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="highest_edu" name="highest_edu" class="form-control" autocomplete="off" required>
		                      <option value="">SELECT OPTION</option>
		                      <?php foreach($education as $e){ ?>
		                        <option <?=$e->id == $household['highest_edu']?"selected==selected":'' ?> value="<?= $e->id?>"><?=$e->level?></option>
		                      <?php } ?>
		                  </select>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Profession:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="profession" name="profession" class="form-control" autocomplete="off" required>
		                      <option value="">SELECT OPTION</option>
		                      <?php foreach($profession as $p){ ?>
		                        <option <?= $p->id == $household['profession']?"selected==selected":''?>  value="<?= $p->id?>"><?=$p->name?></option>
		                      <?php } ?>
		                  </select>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Employment Status:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="employment_status" name="employment_status" class="form-control" autocomplete="off" required>
		                      <option value="">SELECT OPTION</option>
		                      <option <?=$household['employment_status'] == "Employed"?"selected==selected":''?> value="Employed">Employed</option>
		                      <option <?=$household['employment_status'] == "Self-Employed"?"selected==selected":''?> value="Self-Employed" >Self-Employed</option>
		                      <option <?=$household['employment_status'] == "Unemployed"?"selected==selected":''?> value="Unemployed">Unemployed</option>
		                  </select>
		                </div>
		              </div>
		              <div class="form-group row"> 
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Date Of Last Employment:</strong></label>
		                  <input type="text " class="form-control" data-plugin-datepicker id="date_of_last_emp" name="date_of_last_emp" value="<?=$household['date_of_last_emp']?>" autocomplete="off"/>
		                </div>
		                <div class="col-sm-4" id="employed" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>Employer Name:</strong></label>
		                  <input type="text" class="form-control" id="employer_name" name="employer_name" value="<?=$household['employer_name']?>" autocomplete="off" required/>
		                </div>

		                <div class="col-sm-4" id="employed1" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>Current Occupation:</strong></label>
		                  <input type="text" class="form-control" id="current_occupation" name="current_occupation" value="<?=$household['current_occupation']?>" autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4" id="selfemployed" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>Business Name:</strong></label>
		                  <input type="text" class="form-control" id="buisness_name" name="buisness_name" value="<?=$household['buisness_name']?>" autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4" id="selfemployed1" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>Type Of Business:</strong></label>
		                  <input type="text" class="form-control" id="type_of_buisness" name="type_of_buisness" value="<?=$household['type_of_buisness']?>"  autocomplete="off" required/>
		                </div>
		               </div>

		               <div class="form-group row">
	                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
	                        <div class="col-sm-4 pull-right">
	                            <input name="id" value="<?= $household['id']?>" type="hidden">
	                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Education & Profession Info" id="btn2" type="button">
	                        </div>
	                    </div>
                </form>
			  </section>

			  <section class="section" id="content3">
			  	<form autocomplete="off" id="form3" method="post" action="<?=base_url()?>Residence/edit_household_family_data">
			  		<div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Marital Status:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="marital_status" name="marital_status" class="form-control" autocomplete="off" required>
		                    <option value="">SELECT OPTION</option>
		                    <option <?=$household['marital_status'] == "Single"?"selected==selected":''?> value="Single">Single</option>
		                    <option <?=$household['marital_status'] == "Married"?"selected==selected":''?> value="Married">Married</option>
		                    <option <?=$household['marital_status'] == "Divorced"?"selected==selected":''?> value="Divorced">Divorced</option>
		                    <option <?=$household['marital_status'] == "Seperated"?"selected==selected":''?> value="Seperated">Seperated</option>
		                  </select>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>No Of Kids:</strong></label>
		                  <input type="number" min="0" class="form-control" onKeyUp="birth()" id="no_of_kids" value="<?=$household['no_of_kids']?>" name="no_of_kids" autocomplete="off"/>
		                </div>
		                <div class="col-sm-4" id="first_birth" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>First Born DOB:</strong></label>
		                  <input type="text" class="form-control" data-plugin-datepicker id="firstborn_dob" name="firstborn_dob" value="<?=$household['firstborn_dob']?>" autocomplete="off"/>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4"  id="last_birth" style="display: none;">
		                  <label class="control-label text-sm-right pt-2"><strong>Last Born DOB:</strong></label>
		                  <input type="text" class="form-control" data-plugin-datepicker id="lastborn_dob" name="lastborn_dob" value="<?=$household['lastborn_dob']?>" autocomplete="off"/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Hometown:</strong></label>
		                  <input type="text" class="form-control" id="hometown" name="hometown" autocomplete="off" value="<?=$household['hometown']?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Hometown District:</strong></label>
		                  <input type="text" class="form-control" id="home_district" name="home_district" autocomplete="off" value="<?=$household['home_district']?>" required/>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="region" name="region" required>
		                        <option value="">SELECT OPTION</option>
		                        <option <?=$household['region'] == "Greater Accra"?"selected==selected":''?> value="Greater Accra">Greater Accra</option>
		                        <option <?=$household['region'] == "Western"?"selected==selected":''?> value="Western">Western</option>
		                        <option <?=$household['region'] == "Central"?"selected==selected":''?> value="Central">Central</option>
		                        <option <?=$household['region'] == "Eastern"?"selected==selected":''?> value="Eastern">Eastern</option>
		                        <option <?=$household['region'] == "Nothern"?"selected==selected":''?> value="Nothern">Nothern</option>
		                        <option <?=$household['region'] == "Upper East"?"selected==selected":''?> value="Upper East">Upper East</option>
		                        <option <?=$household['region'] == "Upper West"?"selected==selected":''?> value="Upper West">Upper West</option>
		                        <option <?=$household['region'] == "Volta"?"selected==selected":''?> value="Volta">Volta</option>
		                        <option <?=$household['region'] == "Ashanti"?"selected==selected":''?> value="Ashanti">Ashanti</option>
		                        <option <?=$household['region'] == "Brong Ahafo"?"selected==selected":''?> value="Brong Ahafo">Brong Ahafo</option>
		                  </select>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Ethnicity:</strong></label>
		                  <input type="text" class="form-control" id="ethnicity" name="ethnicity" value="<?=$household['ethnicity']?>" autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Native Language:</strong></label>
		                  <input type="text" class="form-control" id="native_lan" name="native_lan" autocomplete="off" value="<?=$household['native_lan']?>" required/>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Father's Firstname:</strong></label>
		                  <input type="text" class="form-control" id="father_firstname" name="father_firstname" autocomplete="off" value="<?=$household['father_firstname']?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Father's Lastname:</strong></label>
		                  <input type="text" class="form-control" id="father_lastname" name="father_lastname" value="<?=$household['father_lastname']?>"  autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Abusua/Clan:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="father_clan" name="father_clan" class="form-control" autocomplete="off" required>
		                    <option value="">SELECT OPTION</option>
		                    <option <?=$household['father_clan'] == "EZOHILE"?"selected==selected":''?> value="EZOHILE">EZOHILE</option>
		                    <option <?=$household['father_clan'] == "ASAMANGAMA"?"selected==selected":''?> value="ASAMANGAMA">ASAMANGAMA</option>
		                    <option <?=$household['father_clan'] == "AZANWUNLE"?"selected==selected":''?> value="AZANWUNLE">AZANWUNLE</option>
		                    <option <?=$household['father_clan'] == "NVAVILE"?"selected==selected":''?> value="NVAVILE">NVAVILE</option>
		                    <option <?=$household['father_clan'] == "NDWEAFO"?"selected==selected":''?> value="NDWEAFO)">NDWEAFO)</option>
		                    <option <?=$household['father_clan'] == "ADANHONLE"?"selected==selected":''?> value="ADANHONLE">ADANHONLE</option>
		                    <option <?=$household['father_clan'] == "ALLONROBA"?"selected==selected":''?> value="ALLONROBA">ALLONROBA</option>
		                    <option <?=$household['father_clan'] == "None"?"selected==selected":''?> value="None">None</option>
		                  </select>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Mother's Firstname:</strong></label>
		                  <input type="text" class="form-control" value="<?=$household['mother_firstname']?>" id="mother_firstname" name="mother_firstname" autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Mother's Lastname:</strong></label>
		                  <input type="text" class="form-control" id="mother_lastname" name="mother_lastname" value="<?=$household['mother_lastname']?>"  autocomplete="off" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Abusua/Clan:</strong></label>
		                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="mother_clan" name="mother_clan" class="form-control" autocomplete="off" required>
		                    <option value="">SELECT OPTION</option>
		                    <option <?=$household['mother_clan'] == "EZOHILE"?"selected==selected":''?> value="EZOHILE">EZOHILE</option>
		                    <option <?=$household['mother_clan'] == "ASAMANGAMA"?"selected==selected":''?> value="ASAMANGAMA">ASAMANGAMA</option>
		                    <option <?=$household['mother_clan'] == "AZANWUNLE"?"selected==selected":''?> value="AZANWUNLE">AZANWUNLE</option>
		                    <option <?=$household['mother_clan'] == "NVAVILE"?"selected==selected":''?> value="NVAVILE">NVAVILE</option>
		                    <option <?=$household['mother_clan'] == "NDWEAFO"?"selected==selected":''?> value="NDWEAFO)">NDWEAFO)</option>
		                    <option <?=$household['mother_clan'] == "ADANHONLE"?"selected==selected":''?> value="ADANHONLE">ADANHONLE</option>
		                    <option <?=$household['mother_clan'] == "ALLONROBA"?"selected==selected":''?> value="ALLONROBA">ALLONROBA</option>
		                    <option <?=$household['mother_clan'] == "None"?"selected==selected":''?> value="None">None</option>
		                  </select>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  	<label class="control-label text-sm-right pt-2"><strong>Community Needs:</strong></label>
							<select id="tags" name="com_needs[]" class="form-control chosen" autocomplete="off" multiple required style="border-top: none;" placeholder="Select Community needs">
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
		              <div class="form-group row">
	                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
	                        <div class="col-sm-4 pull-right">
	                            <input name="id" value="<?= $household['id']?>" type="hidden">
	                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Family Info" id="btn3" type="button">
	                        </div>
	                    </div>
                </form>
			  </section> 

			</main>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page --> 