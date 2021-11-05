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
                  <form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Food/edit_signage_personnal_data">
                  <div class="form-group row">
                        <div class="col-sm-4">
                           <label class="control-label text-sm-right pt-2"><strong>Category of Outdoor/signage:</strong></label>
                            <select class="form-control" id="outdoor_category" name="outdoor_category" required>
                                    <option value="<?=$result['outdoor_category']?>"><?=$result['outdoor_category']?></option>
                                    <option value="commercial">Commercial</option>
                                    <option value="private">Private</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Outdoor Owner Name:</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="outdoor_owner_name" name="outdoor_owner_name" required>
                                <option value="<?=$result['contact_name']?>"><?=$result['outdoor_name']?></option>
                                <?php foreach($outdoor as $a){ ?>
                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                             </select>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="business_n">
                            <label class="control-label text-sm-right pt-2"><strong>Enter Business Name:</strong></label>
                            
                            <input type="text" class="form-control" id="business_name" name="business_name" value="<?=$result['outdoor_others']?>"/>
                        </div>
                        <div class="col-sm-4" style="display:none;" id="outdoor_other">
                            <label class="control-label text-sm-right pt-2"><strong>Enter Name:</strong></label>
                            <input type="text" class="form-control" id="outdoor_others" name="outdoor_others" value="<?=$result['outdoor_others']?>"/>
                         </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Outdoor Owner Contact:</strong></label>         
                            <input type="text" class="form-control" id="contact" value="<?=$result['contact']?>" name="contact"/>
                        </div>
                        <div class="col-sm-4">
                         <label class="control-label text-sm-right pt-2"><strong>Advert on Display:</strong></label>
                            <input type="text" value="<?=$result['signage_message']?>" class="form-control" id="adv_on_display" name="adv_on_display" />
                        </div>
                        <div class="col-sm-4">
                          <label class="control-label text-sm-right pt-2"><strong>Advert on Contact:</strong></label>
                          <input type="text" value="<?=$result['adv_contact']?>" class="form-control" id="adv_contact" name="adv_contact" required/>
                        </div>
                    </div>
                    
                        <!-- button -->
                        <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                            <div class="col-sm-4 pull-right">
                                <input name="id" value="<?= $result['id']?>" type="hidden">
                                <input name="code" value="<?= $result['code']?>" type="hidden">
                                <!-- <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button" type="submit"> -->
                                <button style="font-size:1.0rem;width:100%" class="btn btn-primary" type="submit">Update Personal Info</button> 
                            </div>
                        </div>
                  </form>
                </section>

                <section class="section" id="content2">
                    <form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Food/edit_signage_location_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required>
                                    <option value="<?= $result['area_council']?>"><?= $result['area_council_name']?></option>
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
                              <label class="control-label text-sm-right pt-2"><strong>Outdoor type:</strong></label>
                              <select class="form-control" id="outdoor_type" name="outdoor_type" required="">
                                    <option value="<?= $result['outdoor_type']?>"><?= $result['outdoor_type']?></option>
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
                                <option value="<?= $result['no_of_face']?>"><?= $result['no_of_face']?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            </div>
                            <div class="col-sm-4">
                             <label class="control-label text-sm-right pt-2"><strong>Shape :</strong></label>
                                 <select class="form-control" id="shape" name="shape" required="">
                                <option value="<?= $result['shape']?>"><?= $result['shape']?></option>
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
                    <form autocomplete="off" id="propform" method="post" action="<?=base_url()?>Food/edit_signage_tech_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Rating Mode :</strong></label>
                            <select class="form-control" id="rating_mode" name="rating_mode" required="">
                                    <option value="<?= $result['rating_mode']?>"><?= $result['rating_mode']?></option>
                                    <option value="dimensions">Dimensions</option>
                                    <option value="fee_fixing">Fee Fixing</option>
                            </select>
                            </div>
                            <div class="col-sm-4" style="display:none;" id="metrics">
                            <label class="control-label text-sm-right pt-2"><strong>Unit of Measure:</strong></label>
                            <select type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" required="">
                                <option value="<?= $result['unit_of_measure']?>"><?= $result['unit_of_measure']?></option>
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
                            <input type="text" class="form-control" placeholder="Length" id="length" name="length" value="<?= $result['length']?>" required="">
                                </div>
                                <div class="col">
                                <label class="control-label text-sm-right pt-2"><strong>Height:</strong></label>
                                <input type="text" class="form-control" placeholder="height" id="height" name="height" value="<?= $result['height']?>" required="">
                                </div>
                            </div>
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
                        <div class="col-sm-4">
                            <div class="row">
                            <div class="col">
                                <label class="control-label text-sm-right pt-2"><strong>GPS latitude:</strong></label>
                                <input type="text" class="form-control" id="gps_latitude" name="gps_latitude" autocomplete="off" value="<?= $result['gps_lat']?>" required/>
                            </div>
                            <div class="col">
                                <label class="control-label text-sm-right pt-2"><strong>GPS longitude:</strong></label>
                                <input type="text" class="form-control" id="gps_longitude" name="gps_longitude" autocomplete="off" value="<?= $result['gps_long']?>" required/>
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
