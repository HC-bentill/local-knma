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
              <a class="nav-link" href="#w4-account" data-toggle="tab"><span>1</span>Personal Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>Location Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-billing" data-toggle="tab"><span>3</span>Property Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-confirm" data-toggle="tab"><span>4</span>Facility Info</a>
            </li>
          </ul>
        </div>

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data" method="POST" action="<?=base_url()?>Residence/add_residence" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
                  <input type="text" class="form-control" onkeyup="search_owner()" minlength=10 id="primary_contactt" name="primary_contactt" required>
                  <input type="text" class="form-control hidden" id="primary_contact" name="primary_contact" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Personal Category:</strong></label>
                  <select class="form-control" id="personal_category" name="personal_category" required="">
                        <option value="">SELECT OPTION</option>
                        <option value="Owner">Owner</option>
                        <option value="Caretaker">Caretaker</option>
                  </select>
                </div>
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
                  <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>

                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
                  <input type="text" class="form-control"  id="email" name="email">
                </div>
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Postal Address:</strong></label>
                  <input type="text" class="form-control"  id="postal_address" name="postal_address">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Ghanapost GPS code:</strong></label>
                  <input type="text" class="form-control"  id="owner_ghpost_gps" name="owner_ghpost_gps">
                </div>
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Secondary Contact:</strong></label>
                  <input type="text" class="form-control"  id="secondary_contact" name="secondary_contact">
                </div>
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Owner Resides In Municipality:</strong></label>
                  <select class="form-control" id="owner_native" name="owner_native" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Yes, Resides In Property">Yes, Resides In Property</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4 owner_others">
                  <label class="control-label text-sm-right pt-2"><strong>Religion:</strong></label>
                  <select onChange="check_religion()" class="form-control"  id="religion" name="religion" required="">
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
                  <input type="text" class="form-control"  id="other_religion" name="other_religion" required="">
                </div>
              </div>
              <div class="form-group row" style="display:none;">
                <div class="col-sm-4 owner_reside">
                  <label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
                  <select class="form-control" id="owner_area_council" name="owner_area_council" required="">
                        <option value="">SELECT OPTION</option>
                        <?php foreach($area as $a){ ?>
                          <option value="<?= $a->id?>"><?=$a->name?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4 owner_reside">
                  <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="owner_town" name="owner_town" required="">
                        <option value="">SELECT OPTION</option>
                  </select>
                </div>
              </div>
              <div class="form-group row" style="display:none;">
                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Location:</strong></label>
                  <input type="text" class="form-control" id="owner_location" name="owner_location" required="">
                </div>
                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Hometown:</strong></label>
                  <input type="text" class="form-control" id="owner_hometown" name="owner_hometown">
                </div>
                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Hometown District:</strong></label>
                  <input type="text" class="form-control" id="owner_home_district" name="owner_home_district">
                </div>
              </div>
              <div class="form-group row" style="display:none;">

                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
                  <select class="form-control"  id="owner_region" name="owner_region">
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
                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Ethnicity:</strong></label>
                  <input type="text" class="form-control" id="owner_ethnicity" name="owner_ethnicity">
                </div>
                <div class="col-sm-4 owner_reside_not">
                  <label class="control-label text-sm-right pt-2"><strong>Native Language:</strong></label>
                  <input type="text" class="form-control" id="owner_native_language" name="owner_native_language">
                </div>
              </div>
            </div>
            <div id="w4-profile" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                        <option value="">SELECT OPTION</option>
                        <?php foreach($area as $a){ ?>
                          <option value="<?= $a->id?>"><?=$a->name?></option>
                        <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town" required="">
                        <option value="">SELECT OPTION</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Sectorial Code:</strong></label>
                  <input type="text" class="form-control" id="sectorial_code" name="sectorial_code" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Surburb/Street Name:</strong></label>
                  <input type="text" class="form-control" id="streetname" name="streetname">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Landmark(if any):</strong></label>
                  <input type="text" class="form-control" id="landmark" name="landmark">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Street Code:</strong></label>
                  <input type="text" class="form-control" id="street_code" name="street_code">
                </div>
                
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Old Property No:</strong></label>
                  <input type="text" class="form-control" id="old_property_no" name="old_property_no">
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Ghanapost GPS code (optional):</strong></label>
                  <input type="text" class="form-control" id="ghpost_gps" name="ghpost_gps">
                </div>
              </div>
              <div class="form-group row" style="display:none;">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Type Of Invoice:</strong></label>
                  <select class="form-control" name="type_of_invoice" required>
                        <option value="13">SELECT OPTION</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Form Category:</strong></label>
                  <input type="text" class="form-control" name="form_category" id="form_category" value="busocc" required>
                </div>
              </div>  
            </div>
            <div id="w4-billing" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Building Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat1" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Rooms:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat2" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Property Class:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat3" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Property Cat Type 1:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat4" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Property Cat Type 2:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat5" required>
                      <option value="">N/A</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Property Cat Type 3:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="cat6" required>
                      <option value="">N/A</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Construction Material:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="construction_material" name="construction_material" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <?php foreach($construction as $con){?>
                      <option value="<?=$con->id?>"><?=$con->material?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Roofing Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="roofing_type" name="roofing_type" class="form-control" required >
                    <option value="">SELECT OPTION</option>
                    <?php foreach($roof as $rof){?>
                      <option value="<?=$rof->id?>"><?=$rof->roof?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Type Of Business Building:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="type_of_building" name="type_of_building" class="form-control" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Permanent">Permanent</option>
                    <option value="Temporary">Temporary</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4" id="part1" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Temporary Building Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="detail_for_temp" name="detail_for_temp" class="form-control" autocomplete="off" required="" >
                    <option value="">SELECT OPTION</option>
                    <option value="Wooden Kiosk">Wooden Kisok</option>
                    <option value="Metal Container">Metal Container</option>
                    <option value="Mobile Van/Car">Mobile Van/Car</option>
                    <option value="Table Top">Table Top</option>
                  </select>
                </div>
                <div class="col-sm-4" id="part2" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Property Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="property_type2" name="property_type2" onChange="property()" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Detached">Detached</option>
                    <option value="Semi-Detached">Semi-Detached</option>
                    <option value="Terrace">Terrace</option>
                    <option value="Flat_Apartment">Flat Apartment</option>
                    <option value="Compound">Compound</option>  
                  </select>
                </div>
                <div class="col-sm-4" id="floor" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Storeys / Floors:</strong></label>
                  <input type="text" class="form-control" id="no_of_floors" name="no_of_floors" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Year Of Construction:</strong></label>
                  <input type="text" class="form-control" id="year_of_construction" name="year_of_construction" required>
                </div>
              </div>
            </div>
            <div id="w4-confirm" class="tab-pane">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Toilet Facility:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="toilet_facility" name="toilet_facility" class="form-control" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-sm-4" id="t_yes" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Toilet Facility Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="t_facility_yes" name="t_facility_yes" class="form-control" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="WC">WC</option>
                    <option value="VIP">VIP</option>
                    <option value="Aqua Privy">Aqua Privy</option>
                  </select>
                </div>
                <div class="col-sm-4" class="form-control" style="display: none;" id="t_no">
                  <label class="control-label text-sm-right pt-2"><strong>Toilet Facility Type:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="t_facility_no" name="t_facility_no" required="">
                    <option value="">SELECT OPTION</option>
                    <option value="KVIP">KVIP</option>
                    <option value="Unapproved Location(Seashore,bush)">Unapproved Location(Seashore,bush)</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;" id="t_yes1">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Toilet Facility:</strong></label>
                  <input type="text" class="form-control" id="no_of_toilet_facility" name="no_of_toilet_facility" required="">
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
                    <option value="Small Town Water system">Small Town Water System</option>
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
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Means of Waste Disposal:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="avai_of_refuse" name="avai_of_refuse" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4" id="refuse_yes" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Mode of Disposal:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="dumping_site_yes" name="dumping_site_yes" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Waste Company">Waste Company</option>
                    <option value="Public Waste Management Site">Public Waste Management Site</option>
                  </select>
                </div>
                <div class="col-sm-4" style="display: none;" id="refuse_no">
                  <label class="control-label text-sm-right pt-2"><strong>Mode of Disposal:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="dumping_site_no" name="dumping_site_no" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Skip Container">Skip Container</option>
                    <option value="Unengineered sites">Unengineered Sites</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Building Permit:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="building_permit" name="building_permit" onchange="b_permit()" class="form-control" required>
                      <option value="">SELECT OPTION</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                  </select>
                  </select>
                </div>
                <div class="col-sm-4" id="b_permit" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Building Permit No:</strong></label>
                  <input type="text" class="form-control" id="building_cert_no" name="building_cert_no" autocomplete="off" required="" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Planning Permit:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="planning_permit" name="planning_permit" onchange="p_permit()" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div class="col-sm-4"  id="p_permit" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Planning Permit No:</strong></label>
                  <input type="text" class="form-control" id="planning_permit_no" name="planning_permit_no" autocomplete="off" required="" />
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Residents:</strong></label>
                  <input type="text" class="form-control" id="no_of_residents" name="no_of_residents" autocomplete="off" required="" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>No Of Residents Greater 18:</strong></label>
                  <input type="text" class="form-control" name="resident_greater_18" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Building Status:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="building_status" name="building_status" onchange="inhabitant()" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="1">Completed</option>
                    <option value="0">Uncompleted</option>
                  </select>
                </div>
                <div class="col-sm-4" id="uncompleted_yes" style="display: none;">
                  <label class="control-label text-sm-right pt-2"><strong>Inhabitant Status:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="inhabitant_status" name="inhabitant_status" class="form-control" required>
                    <option value="">SELECT OPTION</option>
                    <option value="Inhabited">Inhabited</option>
                    <option value="Uninhabited">Uninhabited</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Valuation Status:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="accessed_status" id="accessed_status" onchange="accessed()" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="0">Unaccessed</option>
                    <option value="1">Accessed</option>
                  </select>
                </div>
                <div class="col-sm-4" id="rateable" style="display:none">
                  <label class="control-label text-sm-right pt-2"><strong>Rateable Amount:</strong></label>
                  <input type="number" step=".01" class="form-control" name="rateable_amount" required />
                </div>  
                <div class="col-sm-4" id="rate" style="display:none">
                  <label class="control-label text-sm-right pt-2"><strong>Rate:</strong></label>
                  <input type="number" step=".001" class="form-control" name="rate" required />
                </div>
                <div class="col-sm-4" id="valuation" style="display:none">
                  <label class="control-label text-sm-right pt-2"><strong>Valuation Number:</strong></label>
                  <input type="text" class="form-control" name="valuation_number" required />
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>UPN Number:</strong></label>
                  <input type="text" class="form-control" name="upn_number"/>
                </div>
                <div class="col-sm-4 assessed" style="display:none">
                  <label class="control-label text-sm-right pt-2" ><strong>Property Assessment:</strong></label>
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="property_assessment" id="property_assessment" onchange="propertyAssessment()" class="form-control" autocomplete="off" required>
                    <option value="">SELECT OPTION</option>
                    <option value="0">Unrateable</option>
                    <option value="1">Rateable</option>
                  </select>
                </div>
                <div class="col-sm-4 assessed" id="photo" style="display:none">
                  <label class="control-label text-sm-right pt-2"><strong>Photo:</strong></label>
                  <input class="form-control" type="file" name="userfile"/>
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
