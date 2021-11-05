
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

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" method="POST" action="<?=base_url()?>Food/save_signage_record" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Category of Outdoor/signage:</strong></label>
                  <select class="form-control" id="outdoor_category" name="outdoor_category" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="commercial">Commercial</option>
                        <option value="private">Private</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="outdoor_name">
                  <label class="control-label text-sm-right pt-2"><strong>Outdoor Owner Name:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="outdoor_owner_name" name="outdoor_owner_name" required>
                        <option value="">SELECT OPTION</option>
                        <?php foreach($outdoor as $a){ ?>
                          <option value="<?= $a->id?>"><?=$a->name?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="outdoor_other">
                  <label class="control-label text-sm-right pt-2"><strong>Enter Name:</strong></label>
                  <input type="text" class="form-control" id="outdoor_others" name="outdoor_others" required/>
                </div>
                <div class="col-sm-4" style="display:none;" id="signage_business_code">
                  <label class="control-label text-sm-right pt-2"><strong>Enter Buisness Occupant Code:</strong></label>
                  <input type="text" class="form-control" onKeyUp="check_busocc_code();" id="buis_occ_code" name="buis_occ_code" required/>
                  <span id="status" class="badge badge-danger" style="display:none">Invalid</span>
                  <span id="statuss" class="badge badge-success" style="display:none">Valid</span>
                </div>
                <div class="col-sm-4" style="display:none;" id="business_n">
                  <label class="control-label text-sm-right pt-2"><strong>Enter Business Name:</strong></label>
                  <input type="text" class="form-control" id="business_name" name="business_name" required/>
                </div>
              </div>
              <div class="form-group row">
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Outdoor Owner Contact:</strong></label>
                  <input type="text" class="form-control" id="outdoor_owner_contact" name="outdoor_owner_contact"/>
                </div>
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Advert on Display:</strong></label>
                  <input type="text" class="form-control" id="adv_on_display" name="adv_on_display" />
                </div>
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Advert on Contact:</strong></label>
                  <input type="text" class="form-control" id="adv_contact" name="adv_contact" required/>
                </div>
              </div>
            </div>
            <div id="w4-profile" class="tab-pane">
              <div class="form-group row">
                <!-- <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Area Council:</strong></label>
                  <input type="text" class="form-control" id="area_council" name="area_council" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                  <input type="text" class="form-control" id="town" name="town" autocomplete="off" required/>
                </div> -->
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required>
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

                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Outdoor type:</strong></label>
                  <select class="form-control" id="outdoor_type" name="outdoor_type" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="single">Single - 1</option>
                        <option value="double">Double - 2</option>
                        <option value="triangular">Triangular - 3</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No of faces:</strong></label>
                  <select class="form-control" id="no_of_face" name="no_of_face">
                    <option value="">SELECT OPTION</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Shape :</strong></label>
                  <select class="form-control" id="shape" name="shape" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="portrait">Portrait</option>
                        <option value="square">Square</option>
                        <option value="landscape">Landscape</option>
                  </select>
                </div>
              </div>
              <div class="form-group row" style="display:none;">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
                  <select class="form-control" name="type_of_invoice" required>
                        <option value="1">SELECT OPTION</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Specify Religion name:</strong></label>
                  <input type="text" class="form-control" name="form_category" id="form_category" value="busocc" required>
                </div>
              </div>  

            </div>
            <div id="w4-billing" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                    <label class="control-label text-sm-right pt-2"><strong>Rating Mode :</strong></label>
                    <select class="form-control" id="rating_mode" name="rating_mode" required="">
                          <option value="">SELECT OPTION</option>
                          <option value="dimensions">Dimensions</option>
                          <option value="fee_fixing">Fee Fixing</option>
                    </select>
                  </div>
                  <div class="col-sm-4" style="display:none;" id="metrics">
                    <label class="control-label text-sm-right pt-2"><strong>Unit of Measure:</strong></label>
                    <select type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" required>
                      <option value="">SELECT OPTION</option>
                      <option value="meters">Meters</option>
                      <option value="centimeters">Centimeters</option>
                      <option value="inches">Inches</option>
                      <option value="feet">Feet</option>
                    </select>
                </div>
                  <div class="col-sm-4" style="display:none;" id="size">
                    <div class="form-group row">
                      <div class="col">
                      <label class="control-label text-sm-right pt-2"><strong>Length:</strong></label>
                    <input type="text" class="form-control" placeholder="Length" id="length" name="length" required>
                      </div>
                      <div class="col">
                      <label class="control-label text-sm-right pt-2"><strong>Height:</strong></label>
                      <input type="text" class="form-control" placeholder="height" id="height" name="height" required>
                      </div>
                    </div>
                </div>
              </div>
              <div class="form-group row">

              <div class="col-sm-4" style="display:none;" id="cat1_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
                  <select class="form-control" name="cat1" id="cat1" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="cat2_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 2:</strong></label>
                  <select class="form-control" name="cat2" id="cat2" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="cat3_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 3:</strong></label>
                  <select class="form-control" name="cat3" id="cat3" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="cat4_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 4:</strong></label>
                  <select class="form-control" name="cat4" id="cat4" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="cat5_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 5:</strong></label>
                  <select class="form-control" name="cat5" id="cat5" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display:none;" id="cat6_col">
                  <label class="control-label text-sm-right pt-2"><strong>Category 6:</strong></label>
                  <select class="form-control" name="cat6" id="cat6" required>
                      <option value="">N/A</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
              <div class="col-sm-4">
                <div class="row">
                  <div class="col">
                    <label class="control-label text-sm-right pt-2"><strong>GPS latitude:</strong></label>
                    <input type="text" placeholder="eg.5.66428" class="form-control" id="gps_latitude" name="gps_latitude" autocomplete="off" required/>
                  </div>
                  <div class="col">
                    <label class="control-label text-sm-right pt-2"><strong>GPS longitude:</strong></label>
                    <input type="text" placeholder="eg.-0.-291675"  class="form-control" id="gps_longitude" name="gps_longitude" autocomplete="off" required/>
                  </div>
                </div>
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