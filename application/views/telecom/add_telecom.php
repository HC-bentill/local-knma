
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
              <a class="nav-link" href="#w4-account" data-toggle="tab"><span>1</span>Owner Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>Location Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-billing" data-toggle="tab"><span>3</span>Technical Info</a>
            </li>
          </ul>
        </div>

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" method="POST" action="<?=base_url()?>Telecom/save_telecom_record" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Contact:</strong></label>
                  <input type="text" class="form-control" id="contact" name="contact" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Vendor Name :</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="vendor_name" name="vendor_name" required>
                        <option value="">SELECT OPTION</option>
                        <?php foreach($telecomv as $a){ ?>
                          <option value="<?= $a->id?>"><?=$a->name?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Network Name:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="network_name" name="network_name" required>
                        <option value="">SELECT OPTION</option>
                        <?php foreach($telecomn as $a){ ?>
                          <option value="<?= $a->id?>"><?=$a->name?></option>
                        <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Site Name:</strong></label>
                  <input type="text" class="form-control" id="site_name" name="site_name"/>
                </div>
              <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Site ID/Property Code:</strong></label>
                  <input type="text" class="form-control" id="site_id" name="site_id" />
              </div>
              </div>
            </div>
            <div id="w4-profile" class="tab-pane">
              <div class="form-group row">
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
                  <label class="control-label text-sm-right pt-2"><strong>Location/GhanaPost GPS:</strong></label>
                  <input type="text" class="form-control" name="ghanapost" id="ghanapost" required>
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
                  <label class="control-label text-sm-right pt-2"><strong>Site Status:</strong></label>
                  <select class="form-control" id="site_status" name="site_status" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="on air">On Air</option>
                        <option value="decommissioned">Off Air/Decommissioned</option>
                        <option value="uncompleted">Uncompleted/Under Construction</option>
                  </select>
                </div>
                <div class="col-sm-4">
                    <label class="control-label text-sm-right pt-2"><strong>Rating Mode :</strong></label>
                    <select class="form-control" id="rating_mode" name="rating_mode" required="">
                          <option value="">SELECT OPTION</option>
                          <option value="manual">Manual</option>
                          <option value="fee_fixing">Fee Fixing</option>
                    </select>
                  </div>
                  <div class="col-sm-4" id="manuall" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Manual Rating Mode:</strong></label>
                  <input type="text" class="form-control" name="manual" id="manual" required>
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
              <div class="col-sm-4" id="photo">
                  <label class="control-label text-sm-right pt-2"><strong>Upload Photo:</strong></label>
                  <input class="form-control" type="file" name="userfile"/>
             </div>
              <div class="col-sm-4">
                <div class="row">
                  <div class="col">
                    <label class="control-label text-sm-right pt-2"><strong>GPS latitude:</strong></label>
                    <input type="text" placeholder="eg.5.66428" class="form-control" id="gps_lat" name="gps_lat" autocomplete="off" required/>
                  </div>
                  <div class="col">
                    <label class="control-label text-sm-right pt-2"><strong>GPS longitude:</strong></label>
                    <input type="text" placeholder="eg.-0.-291675"  class="form-control" id="gps_long" name="gps_long" autocomplete="off" required/>
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