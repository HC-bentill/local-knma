<style type="text/css">
  .owner_reside{
    display:none;
  }
  .owner_reside_not{
    display:none;
  }

</style>
<div class="row">
  <div class="col">
    <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
      <?= $this->session->flashdata('message');?>
      <div class="card-body">
        <div class="wizard-progress wizard-progress-lg">
          <div class="steps-progress">
            <div class="progress-indicator"></div>
          </div>
          <ul class="nav wizard-steps">
            <li class="nav-item active">
              <a class="nav-link" href="#w4-account" data-toggle="tab"><span>1</span>Personnal Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>Education & Profession Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-billing" data-toggle="tab"><span>3</span>Family Info</a>
            </li>
          </ul>
        </div>

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" method="POST" action="<?=base_url()?>Residence/add_household" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
                  <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
                  <input type="text" class="form-control calender" data-plugin-datepicker id="dob" name="dob" autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Place Of Birth:</strong></label>
                  <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" autocomplete="off" required/>
                </div>
                
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Gender:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="gender" name="gender" class="form-control" autocomplete="off" required>
                      <option value="">SELECT OPTION</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
                  <input type="text" class="form-control" id="primary_contact" name="primary_contact" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Contact Relationship:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="contact_relationship" name="contact_relationship" class="form-control" autocomplete="off" required>
                      <option value="">SELECT OPTION</option>
                      <option value="Owner">Owner</option>
                      <option value="Grandmother">Grandmother</option>
                      <option value="Grandfather">Grandfather</option>
                      <option value="Mother">Mother</option>
                      <option value="Father">Father</option>
                      <option value="Son">Son</option>
                      <option value="Sister">Sister</option>
                      <option value="Brother">Brother</option>
                      <option value="Wife">Wife</option>
                      <option value="Husband">Husband</option>
                      <option value="Daughter">Daughter</option>
                      <option value="Niece">Niece</option>
                      <option value="Nephew">Nephew</option>
                      <option value="Cousin">Cousin</option>
                      <option value="Great grandchild">Great grandchild</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Secondary Contact:</strong></label>
                  <input type="text" class="form-control" id="secondary_contact" name="secondary_contact">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
                  <input type="text" class="form-control" id="email" name="email" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Nationality:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="nationality" name="nationality" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Ghanaian">Ghanaian</option>
                    <option value="Non-Ghanaian">Non-Ghanaian</option>
                  </select>
                </div>
                <div class="col-sm-4" id="idt" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>ID Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="id_type" name="id_type" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="National ID">National ID</option>
                    <option value="Voters ID">Voters ID</option>
                    <option value="NHIS">NHIS</option>
                    <option value="Drivers License">Drivers License</option>
                    <option value="Passport">Passport</option>
                  </select>
                </div>
                <div class="col-sm-4" id="count" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Country:</strong></label>
                  <input type="text" class="form-control" id="country" name="country" autocomplete="off" required/>
                </div>
                <div class="col-sm-4" id="idn" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>ID Number:</strong></label>
                  <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off" required/>
                </div>
                <div class="col-sm-4" id="nat" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>National ID No:</strong></label>
                  <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Religion:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" onChange="check_religion()" class="form-control"  id="religion" name="religion" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="Christianity">Christianity</option>
                        <option value="Islamic">Islamic</option>
                        <option value="Traditional">Traditional</option>
                        <option value="Buddhism">Buddhism</option>
                        <option value="Atheism">Atheism</option>
                        <option value="Others">Others</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;" id="others">
                  <label class="control-label text-sm-right pt-2"><strong>Specify Religion name:</strong></label>
                  <input type="text" class="form-control"  id="other_religion" name="other_religion" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Residence Code:</strong></label>
                  <input type="text" class="form-control" id="res_prop_code" onKeyUp="check_res_code();" name="res_prop_code" autocomplete="off" required="" />
                  <span id="status" class="badge badge-danger" style="display:none">Invalid</span>
                  <span id="statuss" class="badge badge-success" style="display:none">Valid</span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Head Of Household:</strong></label>
                  <input type="text" class="form-control" id="head_of_household" name="head_of_household" autocomplete="off" required/> 
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Tax Identification Number(TIN):</strong></label>
                  <input type="text" class="form-control" id="tin" name="tin">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Disability:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="disability" name="disability" class="form-control" autocomplete="off" onChange="b_disability()" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
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
            </div>
            <div id="w4-profile" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Highest Education:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="highest_edu" name="highest_edu" class="form-control" autocomplete="off" required>
                      <option value="">SELECT OPTION</option>
                      <?php foreach($education as $e){ ?>
                        <option value="<?= $e->id?>"><?=$e->level?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Profession:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="profession" name="profession" class="form-control" autocomplete="off" required>
                      <option value="">SELECT OPTION</option>
                      <?php foreach($profession as $p){ ?>
                        <option value="<?= $p->id?>"><?=$p->name?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Employment Status:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="employment_status" name="employment_status" class="form-control" autocomplete="off" required>
                      <option value="">SELECT OPTION</option>
                      <option>Employed</option>
                      <option>Self-Employed</option>
                      <option>Unemployed</option>
                  </select>
                </div>
              </div>
              <div class="form-group row"> 
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Date Of Last Employment:</strong></label>
                  <input type="text" class="form-control calender" data-plugin-datepicker id="date_of_last_emp" name="date_of_last_emp" autocomplete="off"/>
                </div>
                <div class="col-sm-4" id="employed" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Employer Name:</strong></label>
                  <input type="text" class="form-control" id="employer_name" name="employer_name" autocomplete="off" required/>
                </div>

                <div class="col-sm-4" id="employed1" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Current Occupation:</strong></label>
                  <input type="text" class="form-control" id="current_occupation" name="current_occupation" autocomplete="off" required/>
                </div>
                <div class="col-sm-4" id="selfemployed" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Business Name:</strong></label>
                  <input type="text" class="form-control" id="buisness_name" name="buisness_name" autocomplete="off" required/>
                </div>
                <div class="col-sm-4" id="selfemployed1" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Type Of Business:</strong></label>
                  <input type="text" class="form-control" id="type_of_buisness" name="type_of_buisness" autocomplete="off"required />
                </div>
              </div>
            </div>
            <div id="w4-billing" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Marital Status:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="marital_status" name="marital_status" class="form-control" autocomplete="off" required>
                    <option></option>
                    <option>Single</option>
                    <option>Married</option>
                    <option>Divorced</option>
                    <option>Seperated</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Kids:</strong></label>
                  <input type="number" min="0" class="form-control" onKeyUp="birth()" id="no_of_kids" name="no_of_kids" autocomplete="off"/>
                </div>
                <div class="col-sm-4" id="first_birth" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>First Born DOB:</strong></label>
                  <input type="text" class="form-control"  data-plugin-datepicker id="firstborn_dob" name="firstborn_dob" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4"  id="last_birth" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Last Born DOB:</strong></label>
                  <input type="text" class="form-control" data-plugin-datepicker id="lastborn_dob" name="lastborn_dob" autocomplete="off"/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Hometown:</strong></label>
                  <input type="text" class="form-control" id="hometown" name="hometown" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Hometown District:</strong></label>
                  <input type="text" class="form-control" id="home_district" name="home_district" autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="region" name="region" required>
                        <option value="">SELECT OPTION</option>
                        <option value="Greater Accra">Greater Accra</option>
                        <option value="Western">Western</option>
                        <option value="Central">Central</option>
                        <option value="Eastern">Eastern</option>
                        <option value="Nothern">Nothern</option>
                        <option value="Upper East">Upper East</option>
                        <option value="Upper West">Upper West</option>
                        <option value="Volta">Volta</option>
                        <option value="Ashanti">Ashanti</option>
                        <option value="Brong Ahafo">Brong Ahafo</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Ethnicity:</strong></label>
                  <input type="text" class="form-control" id="ethnicity" name="ethnicity" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Native Language:</strong></label>
                  <input type="text" class="form-control" id="native_lan" name="native_lan" autocomplete="off" required/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Father's Firstname:</strong></label>
                  <input type="text" class="form-control" id="father_firstname" name="father_firstname" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Father's Lastname:</strong></label>
                  <input type="text" class="form-control" id="father_lastname" name="father_lastname" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Abusua/Clan:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="father_clan" name="father_clan" class="form-control" autocomplete="off" required>
                    <option value=""></option>
                    <option value="EZOHILE">EZOHILE</option>
                    <option value="ASAMANGAMA">ASAMANGAMA</option>
                    <option value="AZANWUNLE">AZANWUNLE</option>
                    <option value="NVAVILE">NVAVILE</option>
                    <option value="NDWEAFO)">NDWEAFO)</option>
                    <option value="ADANHONLE">ADANHONLE</option>
                    <option value="ALLONROBA">ALLONROBA</option>
                    <option value="None">None</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Mother's Firstname:</strong></label>
                  <input type="text" class="form-control" id="mother_firstname" name="mother_firstname" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Mother's Lastname:</strong></label>
                  <input type="text" class="form-control" id="mother_lastname" name="mother_lastname" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Abusua/Clan:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="mother_clan" name="mother_clan" class="form-control" autocomplete="off" required>
                    <option value=""></option>
                    <option value="EZOHILE">EZOHILE</option>
                    <option value="ASAMANGAMA">ASAMANGAMA</option>
                    <option value="AZANWUNLE">AZANWUNLE</option>
                    <option value="NVAVILE">NVAVILE</option>
                    <option value="NDWEAFO)">NDWEAFO)</option>
                    <option value="ADANHONLE">ADANHONLE</option>
                    <option value="ALLONROBA">ALLONROBA</option>
                    <option value="None">None</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Community Needs:</strong></label>
                  <select id="tags" name="com_needs[]" class="form-control chosen" autocomplete="off" multiple required style="border-top: none;" placeholder="Select Community needs">
                      <option></option>
                      <?php foreach($com as $co){ ?>
                      <option value="<?=$co->id?>"><?=$co->need?></option>
                      <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
          </div>
        </form>
      </div>
      <div class="card-footer">
        <ul class="pager">
          <li class="previous disabled">
            <a><i class="fa fa-angle-left"></i> Previous</a>
          </li>
          <li class="finish hidden float-right">
            <a>Finish</a>
          </li>
          <li class="next">
            <a>Next <i class="fa fa-angle-right"></i></a>
          </li>
        </ul>
      </div>
    </section>
  </div>
</div>