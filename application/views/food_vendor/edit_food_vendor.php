<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
          	<main>

                <input id="tab1" type="radio" name="tabs" checked>
                <label class="label" for="tab1">Personal Info</label>

                <input id="tab2" type="radio" name="tabs">
                <label class="label" for="tab2">Location Info</label>

                <input id="tab3" type="radio" name="tabs">
                <label class="label" for="tab3">Technical Info</label>

                <input id="tab4" type="radio" name="tabs">
				<label class="label" for="tab4">Map</label>


                <section class="section" id="content1">
                    <form autocomplete="off" id="basicformm" method="post" action="<?=base_url()?>Food/edit_personnal_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['firstname']?>" id="firstname" name="firstname" autocomplete="off" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['lastname']?>" id="lastname" name="lastname" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
                            <input type="text" class="form-control calender" value="<?= $result['dob']?>" id="dob" name="dob"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Phone Number:</strong></label>
                            <input type="text" class="form-control" id="phoneno" value="<?= $result['phoneno']?>" name="phoneno"/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Area Coucil:</strong></label>
                            <select class="form-control" id="area_council" name="area_council" required>
                                <option value="">SELECT OPTION</option>
                                <?php foreach($area as $a){ ?>
                                    <option value="<?= $a->id?>" <?=$result['area_council'] == $a->id?'selected == selected':''; ?>><?=$a->name?></option>
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
                                <option <?=$result['nationality'] == "Ghanaian"?'selected == selected':''; ?> value="Ghanaian">Ghanaian</option>
                                <option <?=$result['nationality'] == "Non-Ghanaian"?'selected == selected':''; ?> value="Non-Ghanaian">Non-Ghanaian</option>
                            </select>
                        </div>
                        <div class="col-sm-4" id="idt" style="display: none;">
                            <label class="control-label text-sm-right pt-2"><strong>ID Type:</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="id_type" name="id_type" class="form-control" autocomplete="off">
                                <option value="">SELECT OPTION</option>
                                <option <?=$result['id_type'] == "National ID"?'selected == selected':''; ?> value="National ID">National ID</option>
                                <option <?=$result['id_type'] == "Voters ID"?'selected == selected':''; ?> value="Voters ID">Voters ID</option>
                                <option <?=$result['id_type'] == "NHIS"?'selected == selected':''; ?> value="NHIS">NHIS</option>
                                <option <?=$result['id_type'] == "Drivers License"?'selected == selected':''; ?>value="Drivers License">Drivers License</option>
                                <option <?=$result['id_type'] == "Passport"?'selected == selected':''; ?>value="Passport">Passport</option>
                            </select>
                        </div>
                        <div class="col-sm-4" id="count" style="display: none;">
                            <label class="control-label text-sm-right pt-2"><strong>Country:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['country']?>" id="country" name="country" autocomplete="off" required/>
                        </div>
                        <div class="col-sm-4" id="idn" style="display: none;">
                            <label class="control-label text-sm-right pt-2"><strong>ID Number:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['id_number']?>" id="id_number" name="id_number" autocomplete="off" />
                        </div>
                        <div class="col-sm-4" id="nat" style="display: none;">
                            <label class="control-label text-sm-right pt-2"><strong>National ID No:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['nat_id_no']?>" id="nat_id_no" name="nat_id_no" autocomplete="off"/>
                        </div>
                        <div class="col-sm-4" style="display: none;">
                            <label class="control-label text-sm-right pt-2"><strong>National ID No:</strong></label>
                            <input type="text" class="form-control" value="<?= $result['town']?>" id="townn" name="townn" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['fv_code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button">
                        </div>
                    </div>
                    </form>
                </section>

                <section class="section" id="content2">
                    <form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Food/edit_location_data">
                     <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Vending Point:</strong></label>
                        <input type="text" class="form-control" id="vending_point" value="<?= $result['vending_point']?>" name="vending_point" required>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Service Time:</strong></label>
                        <select class="form-control" id="service_time" name="service_time" required="">
                                <option value="">SELECT OPTION</option>
                                <option <?=$result['service_time'] == "Day"?'selected == selected':''; ?> value="Day">Day</option>
                                <option <?=$result['service_time'] == "Night"?'selected == selected':''; ?> value="Night">Night</option>
                                <option <?=$result['service_time'] == "Both"?'selected == selected':''; ?> value="Both">Both</option>
                        </select>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Source Of Cooking:</strong></label>
                        <input type="text" class="form-control" value="<?= $result['cooking_source']?>" id="cooking_source" name="cooking_source" required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Availability Of Water:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="avai_of_water" name="avai_of_water" class="form-control" required="">
                            <option value="">SELECT OPTION</option>
                            <option <?=$result['water_availability'] == "Yes"?'selected == selected':''; ?> value="Yes">Yes</option>
                            <option <?=$result['water_availability'] == "No"?'selected == selected':''; ?> value="No">No</option>
                        </select>
                        </div>
                        <div class="col-sm-4" id="water_yes" style="display: none;">
                        <label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_yes" name="source_water_yes" class="form-control" required>
                            <option value="">SELECT OPTION</option>
                            <option <?=$result['source_water'] == "GWC"?'selected == selected':''; ?> value="GWC">GWC</option>
                            <option <?=$result['source_water'] == "Borehole"?'selected == selected':''; ?> value="Borehole">Borehole</option>
                            <option <?=$result['source_water'] == "Hand Dug Well"?'selected == selected':''; ?> value="Hand Dug Well">Hand Dug Well</option>
                            <option <?=$result['source_water'] == "Small Town Water System"?'selected == selected':''; ?> value="Small Town Water System">Small Town Water System</option>
                        </select>
                        </div>
                        <div class="col-sm-4" style="display: none;" id="water_no">
                        <label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_no" name="source_water_no" class="form-control" required>
                            <option value="">SELECT OPTION</option>
                            <option <?=$result['source_water'] == "River"?'selected == selected':''; ?> value="River">River</option>
                            <option <?=$result['source_water'] == "Stream"?'selected == selected':''; ?> value="Stream">Stream</option>
                            <option <?=$result['source_water'] == "Brookes"?'selected == selected':''; ?> value="Brookes">Brookes</option>
                            <option <?=$result['source_water'] == "Others"?'selected == selected':''; ?> value="Others">Others</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['fv_code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Location Info" id="btn2" type="button">
                        </div>
                    </div>
                    </form>
                </section>

                <section class="section" id="content3">
                    <form autocomplete="off" id="propform" method="post" action="<?=base_url()?>Food/edit_tech_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Type Of Food:</strong></label>
                        <select class="form-control" id="food_type" name="food_type" required="">
                            <option value="">SELECT OPTION</option>
                            <option <?=$result['food_type'] == "Boiled Yam"?'selected == selected':''; ?> value="Boiled Yam">Boiled Yam</option>
                            <option <?=$result['food_type'] == "Fried Yam"?'selected == selected':''; ?> value="Fried Yam">Fried Yam</option>
                            <option <?=$result['food_type'] == "Akyeke"?'selected == selected':''; ?> value="Akyeke">Akyeke</option>
                            <option <?=$result['food_type'] == "Indomie"?'selected == selected':''; ?> value="Indomie">Indomie</option>
                            <option <?=$result['food_type'] == "Banku & Fish/Tilapia"?'selected == selected':''; ?> value="Banku & Fish/Tilapia">Banku & Fish/Tilapia</option>
                            <option <?=$result['food_type'] == "Fante Kenkey"?'selected == selected':''; ?> value="Fante Kenkey">Fante Kenkey</option>
                            <option <?=$result['food_type'] == "Ga Kenkey"?'selected == selected':''; ?> value="Ga Kenkey">Ga Kenkey</option>
                            <option <?=$result['food_type'] == "Waakye"?'selected == selected':''; ?> value="Waakye">Waakye</option>
                            <option <?=$result['food_type'] == "Others"?'selected == selected':''; ?> value="Others">Others</option>
                        </select>
                        </div>
                        <div class="col-sm-4" id="food_others" style="display:none;">
                        <label class="control-label text-sm-right pt-2"><strong>Others(specify):</strong></label>
                        <input type="text" value="<?= $result['others']?>" class="form-control" id="others" name="others" required>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Medically Certified:</strong></label>
                        <select class="form-control" id="medically_certified" name="medically_certified" required="">
                            <option value="">SELECT OPTION</option>
                            <option <?=$result['medically_certified'] == "Yes"?'selected == selected':''; ?> value="Yes">Yes</option>
                            <option <?=$result['medically_certified'] == "No"?'selected == selected':''; ?> value="No">No</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row" id="medical_yes" style="display:none">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Certificate No:</strong></label>
                        <input type="text" value="<?= $result['cert_no']?>" class="form-control" id="cert_no" name="cert_no" required>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Issuer:</strong></label>
                        <input type="text" value="<?= $result['issuer']?>" class="form-control" id="issuer" name="issuer" required>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Year:</strong></label>
                        <input type="number" value="<?= $result['year']?>" class="form-control" id="year" name="year" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>No Of Staff:</strong></label>
                        <input type="number" value="<?= $result['staff_no']?>" class="form-control" id="staff_no" name="staff_no">
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>No Of Medically Certified Staff:</strong></label>
                        <input type="number" value="<?= $result['certified_staff_no']?>" class="form-control" id="certified_staff_no" name="certified_staff_no">
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>No Of Handlers:</strong></label>
                        <input type="number" value="<?= $result['handler_no']?>" class="form-control" id="handlers_no" name="handlers_no">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['fv_code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Technical Info" id="btn3" type="button">
                        </div>
                    </div>
                    </form>
                </section>
                <section class="section" id="content4">
                        <div id="map" style="width:100%;height: 30em;"></div>
                </section>
			</main>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
<script>

	function initMap() {
		var myLatLng = {lat: <?=$result['gps_lat']?>, lng: <?=$result['gps_long']?>};

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: myLatLng,
			gestureHandling: 'cooperative'
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map
		});
	}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEMcP8mSrlPeI8jMLVh9PU7RBrQZVJ6I&callback=initMap">
</script>
