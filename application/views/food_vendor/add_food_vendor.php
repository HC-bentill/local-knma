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
              <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>Location Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-billing" data-toggle="tab"><span>3</span>Technical Info</a>
            </li>
          </ul>
        </div>

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" method="POST" action="<?=base_url()?>Food/add_food_vendor_script" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
                  <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
                  <input type="text" class="form-control calender" id="dob" name="dob"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Phone Number:</strong></label>
                  <input type="text" class="form-control" id="phoneno" name="phoneno"/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Area Coucil:</strong></label>
                  <select class="form-control" id="area_council" name="area_council" required>
                    <option value="">SELECT OPTION</option>
                    <?php foreach($area as $a){ ?>
                        <option value="<?= $a->id?>"><?=$a->name?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town" required>
                        <option value="">SELECT OPTION</option>
                  </select>
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
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="id_type" name="id_type" class="form-control" autocomplete="off">
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
                  <input type="text" class="form-control" id="id_number" name="id_number" autocomplete="off" />
                </div>
                <div class="col-sm-4" id="nat" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>National ID No:</strong></label>
                  <input type="text" class="form-control" id="nat_id_no" name="nat_id_no" autocomplete="off"/>
                </div>
              </div>
            </div>
            <div id="w4-profile" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Vending Point:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="vending_point" name="vending_point" required>
                    <option value="">SELECT OPTION</option>
                    <?php foreach($towns as $t){ ?>
                        <option value="<?= $t->town?>"><?=$t->town?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Service Time:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="service_time" name="service_time" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="Day">Day</option>
                        <option value="Night">Night</option>
                        <option value="Both">Both</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Source Of Cooking:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cooking_source" name="cooking_source" required>
                    <option value="">SELECT OPTION</option>
                    <?php foreach($towns as $t){ ?>
                        <option value="<?= $t->town?>"><?=$t->town?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Availability Of Water:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="avai_of_water" name="avai_of_water" class="form-control" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-sm-4" id="water_yes" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_yes" name="source_water_yes" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="GWC">GWC</option>
                    <option value="Borehole">Borehole</option>
                    <option value="Hand Dug Well">Hand Dug Well</option>
                    <option value="Small Town Water System">Small Town Water System</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;" id="water_no">
                  <label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_no" name="source_water_no" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="River">River</option>
                    <option value="Stream">Stream</option>
                    <option value="Brookes">Brookes</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
              </div>
              
            </div>
            <div id="w4-billing" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Type Of Food:</strong></label>
                  <select class="form-control" id="food_type" name="food_type" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Boiled Yam">Boiled Yam</option>
                    <option value="Fried Yam">Fried Yam</option>
                    <option value="Akyeke">Akyeke</option>
                    <option value="Indomie">Indomie</option>
                    <option value="Banku & Fish/Tilapia">Banku & Fish/Tilapia</option>
                    <option value="Fante Kenkey">Fante Kenkey</option>
                    <option value="Ga Kenkey">Ga Kenkey</option>
                    <option value="Waakye">Waakye</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div class="col-sm-4" id="food_others" style="display:none;">
                  <label class="control-label text-sm-right pt-2"><strong>Others(specify):</strong></label>
                  <input type="text" class="form-control" id="others" name="others" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Medically Certified:</strong></label>
                  <select class="form-control" id="medically_certified" name="medically_certified" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>
              <div class="form-group row" id="medical_yes" style="display:none">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Certificate No:</strong></label>
                  <input type="text" class="form-control" id="cert_no" name="cert_no" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Issuer:</strong></label>
                  <input type="text" class="form-control" id="issuer" name="issuer" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Year:</strong></label>
                  <input type="number" class="form-control" id="year" name="year" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Staff:</strong></label>
                  <input type="number" class="form-control" id="staff_no" name="staff_no">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Medically Certified Staff:</strong></label>
                  <input type="number" class="form-control" id="certified_staff_no" name="certified_staff_no">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Handlers:</strong></label>
                  <input type="number" class="form-control" id="handlers_no" name="handlers_no">
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
          <li id="save" class="next">
            <a>Next <i class="fa fa-angle-right"></i></a>
          </li>
        </ul>
      </div>
    </section>
  </div>
</div>
