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
                    <form autocomplete="off" id="basicformm" method="post" action="<?=base_url()?>Telecom/edit_telecom_personnal_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Contact:</strong></label>
                         <input type="text" class="form-control" id="contact" name="contact" required value="<?= $result['contact']?>"/>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Vendor Name :</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="vendor_name" name="vendor_name" required>
                                    <option value="<?= $result['telecom_vendor_name']?>"><?= $result['vendor_name']?></option>
                                    <?php foreach($telecomv as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Network Name:</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="network_name" name="network_name" required>
                                    <option value="<?= $result['telecom_network_name']?>"><?= $result['network_name']?></option>
                                    <?php foreach($telecomn as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Site Name:</strong></label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="<?= $result['site_name']?>"/>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Site ID/Property Code:</strong></label>
                        <input type="text" class="form-control" id="site_id" name="site_id" value="<?= $result['site_id']?>" />
                    </div>
                    </div>
                    <!-- button -->
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <!-- <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button" type="submit"> -->
                            <button style="font-size:1.0rem;width:100%" class="btn btn-primary" type="submit">Update Personnal Info</button> 
                        </div>
                    </div>
                    </form>
                </section>

                <section class="section" id="content2">
                    <form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Telecom/edit_telecom_location_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required>
                                <option value="<?= $result['area_council']?>"><?= $result['area_name']?></option>
                                <?php foreach($area as $a){ ?>
                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                        </select>
                        </div>
                        <div class="col-sm-4">
                             <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town" required>
                                    <option value="<?= $result['town']?>"><?= $result['town_name']?></option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                             <label class="control-label text-sm-right pt-2"><strong>Location/GhanaPost GPS:</strong></label>
                            <input type="text" class="form-control" name="ghanapost" id="ghanapost" required value="<?=$result['ghanapost']?>">
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
                         <!-- button -->
                        <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <!-- <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button" type="submit"> -->
                            <button style="font-size:1.0rem;width:100%" class="btn btn-primary" type="submit">Update Location Info</button> 
                        </div>
                    </div>

                    </form>
                </section>

                <section class="section" id="content3">
                    <form autocomplete="off" id="propform" method="post" action="<?=base_url()?>Telecom/edit_telecom_technical_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                                <label class="control-label text-sm-right pt-2"><strong>Site Status:</strong></label>
                                <select class="form-control" id="site_status" name="site_status" required="">
                                        <option value="<?= $result['site_status']?>"><?= $result['site_status']?></option>
                                        <option value="on air">On Air</option>
                                        <option value="decommissioned">Off Air/Decommissioned</option>
                                        <option value="uncompleted">Uncompleted/Under Construction</option>
                                </select>
                        </div>
                        <div class="col-sm-4">
                        <label class="control-label text-sm-right pt-2"><strong>Rating Mode :</strong></label>
                            <select class="form-control" id="rating_mode" name="rating_mode" required="">
                                <option value="<?= $result['rating_mode']?>"><?= $result['rating_mode']?></option>
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
                            <select class="form-control" name="cat1" id="cat1" >
                                <option value="">N/A</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="cat2_col">
                            <label class="control-label text-sm-right pt-2"><strong>Category 2:</strong></label>
                            <select class="form-control" name="cat2" id="cat2" >
                                <option value="">N/A</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="cat3_col">
                            <label class="control-label text-sm-right pt-2"><strong>Category 3:</strong></label>
                            <select class="form-control" name="cat3" id="cat3" >
                                <option value="">N/A</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="cat4_col">
                            <label class="control-label text-sm-right pt-2"><strong>Category 4:</strong></label>
                            <select class="form-control" name="cat4" id="cat4" >
                                <option value="">N/A</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="cat5_col">
                            <label class="control-label text-sm-right pt-2"><strong>Category 5:</strong></label>
                            <select class="form-control" name="cat5" id="cat5" >
                                <option value="">N/A</option>
                            </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="cat6_col">
                            <label class="control-label text-sm-right pt-2"><strong>Category 6:</strong></label>
                            <select class="form-control" name="cat6" id="cat6" >
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
                                <input type="text" class="form-control" id="gps_latitude" name="gps_lat" autocomplete="off" value="<?= $result['gps_lat']?>" required/>
                            </div>
                            <div class="col">
                                <label class="control-label text-sm-right pt-2"><strong>GPS longitude:</strong></label>
                                <input type="text" class="form-control" id="gps_longitude" name="gps_long" autocomplete="off" value="<?= $result['gps_long']?>" required/>
                            </div>
                            </div>
                        </div>
                    </div>
                     <!-- button -->
                     <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <!-- <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button" type="submit"> -->
                            <button style="font-size:1.0rem;width:100%" class="btn btn-primary" type="submit">Update Technical Info</button> 
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
