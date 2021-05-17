<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->

  <!-- <div class="row">
	<div class="offset-10 col-md-2">
		<button class="btn btn-dangder">Back</button>
	</div>
  </div> -->

<div class="col-md-12">

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
						<label class="label" for="tab3">Property Info</label>

						<input id="tab4" type="radio" name="tabs">
						<label class="label" for="tab4">Facility Info</label>

						<!-- <input id="tab5" type="radio" name="tabs">
						<label class="label" for="tab5">Household</label> -->
							
						<input id="tab6" type="radio" name="tabs">
						<label class="label" for="tab6">Map</label>

						<input id="tab7" type="radio" name="tabs">
						<label class="label" for="tab7">Invoice(s)</label>

						<?php $owner = owner_details($residence['id']); ?>
						<?php $ap = accessed_property(1,$residence['id']); ?>

						<section class="section" id="content1">
							<form autocomplete="off" id="basicformm" method="post" action="<?=base_url()?>Residence/edit_personnal_data">

								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
										<input type="text" class="form-control" value="<?=$owner['primary_contact']?>" minlength=10 id="primary_contact" name="primary_contact" required>
										<input type="hidden" class="form-control" value="<?=$owner['primary_contact']?>" minlength=10 name="original_primary_contact" required>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Personal Category:</strong></label>
										<select class="form-control" id="personal_category" name="personal_category" required="">
											<option value="">SELECT OPTION</option>
											<option <?=$owner['person_category']=='Owner'?'selected == selected':''; ?> value="Owner">Owner</option>
											<option <?=$owner['person_category']=='Caretaker'?'selected == selected':''; ?>value="Caretaker">Caretaker</option>
										</select>
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
										<input type="text" class="form-control" value="<?= $owner['firstname']?>" id="firstname" name="firstname" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
										<input type="text" class="form-control" value="<?=$owner['lastname']?>" id="lastname" name="lastname" required>
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
										<input type="text" class="form-control"  id="email" value="<?=$owner['email']?>" name="email">
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Postal Address:</strong></label>
										<input type="text" class="form-control"  id="postal_address" value="<?=$owner['postal_address']?>" name="postal_address">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Ghanapost GPS code:</strong></label>
										<input type="text" class="form-control"  id="owner_ghpost_gps" value="<?=$owner['ghpostgps_code']?>" name="owner_ghpost_gps">
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Secondary Contact:</strong></label>
										<input type="text" class="form-control" value="<?=$owner['secondary_contact']?>" id="secondary_contact" name="secondary_contact">
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Owner Resides In Municipality:</strong></label>
										<select class="form-control" id="owner_native" name="owner_native" required="">
											<option value="">SELECT OPTION</option>
											<option <?= $owner['owner_native'] == "Yes"?'selected==selected':''?> value="Yes">Yes</option>
											<option <?= $owner['owner_native'] == "No"?'selected==selected':''?> value="No">No</option>
											<option <?= $owner['owner_native'] == "Yes, Resides In Property"?'selected==selected':''?> value="Yes, Resides In Property">Yes, Resides In Property</option>   
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Religion:</strong></label>
										<select onChange="check_religion()" class="form-control"  id="religion" name="religion" required="">
											<option value="">SELECT OPTION</option>
											<option value="Christianity" <?= $owner['religion'] == "Christianity"?'selected==selected':''?>>Christianity</option>
											<option value="Islamic" <?= $owner['religion'] == "Islamic"?'selected==selected':''?>>Islamic</option>
											<option value="Traditional" <?= $owner['religion'] == "Traditional"?'selected==selected':''?>>Traditional</option>
											<option value="Buddhism" <?= $owner['religion'] == "Buddhism"?'selected==selected':''?>>Buddhism</option>
											<option value="Atheism" <?= $owner['religion'] == "Atheism"?'selected==selected':''?>>Atheism</option>
											<option value="Others" <?= $owner['religion'] == "Others"?'selected==selected':''?>>Others</option>
										</select>
									</div>
									<div class="col-sm-4" style="display: none;" id="others">
										<label class="control-label text-sm-right pt-2"><strong>Specify Religion name:</strong></label>
										<input type="text" class="form-control"  id="other_religion" value="<?=$owner['other_religion']?>" name="other_religion" required="">
									</div>
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Update Type:</strong></label>
										<select class="form-control"  id="update_type" name="update_type" required="">
											<option value="">SELECT OPTION</option>
											<option value="update">Update Info</option>
											<option value="detach">Detach Owner</option>
										</select>
									</div>
								</div>
								<div class="form-group row" style="display:none;">
									<div class="col-sm-4 owner_others">
										<label class="control-label text-sm-right pt-2"><strong>Religion:</strong></label>
										<select onChange="check_religion()" class="form-control"  id="religion" name="religion" required="">
											<option value="">SELECT OPTION</option>
											<option value="Christianity" <?= $owner['religion'] == "Christianity"?'selected==selected':''?>>Christianity</option>
											<option value="Islamic" <?= $owner['religion'] == "Islamic"?'selected==selected':''?>>Islamic</option>
											<option value="Traditional" <?= $owner['religion'] == "Traditional"?'selected==selected':''?>>Traditional</option>
											<option value="Buddhism" <?= $owner['religion'] == "Buddhism"?'selected==selected':''?>>Buddhism</option>
											<option value="Atheism" <?= $owner['religion'] == "Atheism"?'selected==selected':''?>>Atheism</option>
											<option value="Others" <?= $owner['religion'] == "Others"?'selected==selected':''?>>Others</option>
										</select>
									</div>
									<div class="col-sm-4" style="display: none;" id="others">
										<label class="control-label text-sm-right pt-2"><strong>Specify Religion name:</strong></label>
										<input type="text" class="form-control"  id="other_religion" value="<?=$owner['other_religion']?>" name="other_religion" required="">
									</div>
									<div class="col-sm-4 owner_reside">
										<label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
										<select class="form-control" id="owner_area_council" name="owner_area_council" required>
											<option value="">SELECT OPTION</option>
											<?php foreach($area as $a){ ?>
												<option value="<?= $a->id?>" <?= $owner['area_council'] == $a->id?'selected==selected':''?>><?=$a->name?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-4 owner_reside">
										<input type="text" class="form-control hidden" id="owner_townn" name="owner_townn" value="<?= $owner['town']?>" autocomplete="off"/>
										<label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="owner_town" name="owner_town">
											<option value="">SELECT OPTION</option>
										</select>
									</div>
								</div>
								<div class="form-group row" style="display:none;">
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Location:</strong></label>
										<input type="text" class="form-control" id="owner_location" value="<?=$owner['location']?>"  name="owner_location" required>
									</div>
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Hometown:</strong></label>
										<input type="text" class="form-control" id="owner_hometown" value="<?=$owner['hometown']?>" name="owner_hometown">
									</div>
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Hometown District:</strong></label>
										<input type="text" class="form-control" id="owner_home_district" value="<?=$owner['home_district']?>" name="owner_home_district">
									</div>
								</div>
								<div class="form-group row" style="display:none;">
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
										<select class="form-control"  id="owner_region" name="owner_region">
											<option value="">SELECT OPTION</option>
											<option value="Greater Accra" <?= $owner['region'] == "Greater Accra"?'selected==selected':''?>>Greater Accra</option>
											<option value="Western" <?= $owner['region'] == "Western"?'selected==selected':''?>>Western</option>
											<option value="Central" <?= $owner['region'] == "Central"?'selected==selected':''?>>Central</option>
											<option value="Eastern" <?= $owner['region'] == "Eastern"?'selected==selected':''?>>Eastern</option>
											<option value="Nothern" <?= $owner['region'] == "Nothern"?'selected==selected':''?>>Nothern</option>
											<option value="Upper East" <?= $owner['region'] == "Upper East"?'selected==selected':''?>>Upper East</option>
											<option value="Upper West" <?= $owner['region'] == "Upper West"?'selected==selected':''?>>Upper West</option>
											<option value="Volta" <?= $owner['region'] == "Volta"?'selected==selected':''?>>Volta</option>
											<option value="Ashanti" <?= $owner['region'] == "Ashanti"?'selected==selected':''?>>Ashanti</option>
											<option value="Brong Ahafo" <?= $owner['region'] == "Brong Ahafo"?'selected==selected':''?>>Brong Ahafo</option>
										</select>
									</div>
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Ethnicity:</strong></label>
										<input type="text" class="form-control" id="owner_ethnicity" value="<?=$owner['ethnicity']?>" name="owner_ethnicity">
									</div>
									<div class="col-sm-4 owner_reside_not">
										<label class="control-label text-sm-right pt-2"><strong>Native Language:</strong></label>
										<input type="text" class="form-control" id="owner_native_language" value="<?=$owner['native_language']?>" name="owner_native_language">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
									<div class="col-sm-4 pull-right">
										<input name="ownid" value="<?= $owner['id']?>" type="hidden">
										<input type="text" class="form-control hidden" id="rescode" value="<?=$residence['res_code']?>" name="rescode"/>
										<input name="resid" value="<?= $residence['id']?>" type="hidden">
										<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btnn" type="button">
									</div>
								</div>

							</form>
						</section>

						<section class="section" id="content2">
							<form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Residence/edit_location_data">

								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
											<option value="">SELECT OPTION</option>
											<?php foreach($area as $a){ ?>
											<option value="<?= $a->id?>" <?=$residence['area_council']== $a->id?'selected == selected':''; ?>><?=$a->name?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
										<input type="text" class="form-control hidden" id="townn" value="<?= $residence['town']?>" autocomplete="off"/>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
											<option value="">SELECT OPTION</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Sectorial Code:</strong></label>
										<input type="text" class="form-control" id="sectorial_code" value="<?= $residence['sectorial_code']?>" name="sectorial_code" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Surburb/Street Name:</strong></label>
										<input type="text" class="form-control" id="streetname" value="<?= $residence['streetname']?>" name="streetname">
									</div>  
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Landmark(if any):</strong></label>
										<input type="text" class="form-control" id="landmark" value="<?= $residence['landmark']?>" name="landmark">
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Street Code:</strong></label>
										<input type="text" class="form-control" id="street_code" value="<?= $residence['street_code']?>" name="street_code">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Locality Code:</strong></label>
										<input type="text" class="form-control" id="locality_code" value="<?= $residence['locality_code']?>" name="locality_code" disabled>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>New Property No:</strong></label>
										<input type="text" class="form-control" id="new_property_no" value="<?=$residence['new_property_no']?>" name="new_property_no" disabled>
									</div>
									<div class="col-sm-4 hidden">
										<label class="control-label text-sm-right pt-2"><strong>New Property No:</strong></label>
										<input type="text" class="form-control" id="new_property_noo" value="<?=$residence['new_property_no']?>" name="new_property_noo">
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Old Property No:</strong></label>
										<input type="text" class="form-control" id="old_property_no" value="<?=$residence['old_property_no']?>" name="old_property_no">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Zone Code:</strong></label>
										<input type="text" class="form-control" id="zone_code" value="<?= $residence['zone_code']?>" name="zone_code" disabled>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>House No:</strong></label>
										<input type="text" class="form-control" id="houseno" value="<?= $residence['houseno']?>" name="houseno" disabled>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Ghanapost GPS code (optional):</strong></label>
										<input type="text" class="form-control" id="ghpost_gps" value="<?= $residence['ghpost_gps']?>" name="ghpost_gps">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
									<div class="col-sm-4 pull-right">
										<input type="text" class="form-control hidden" id="rescode" value="<?=$residence['res_code']?>" name="rescode"/>
										<input name="resid" value="<?= $residence['id']?>" type="hidden">
										<input name="resid" value="<?= $residence['id']?>" type="hidden">
										<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Location Info" id="locbtn" type="button">
									</div>
								</div>
							</form>
						</section>

						<section class="section" id="content3">
							<form autocomplete="off" id="propform" method="post" action="<?=base_url()?>Residence/edit_prop_data">
								<div class="form-group row" style="display:none;">
									<input type="text" class="form-control" id="category1" value="<?= $residence['category1']?>" readonly>
									<input type="text" class="form-control" id="category2" value="<?= $residence['category2']?>" readonly>
									<input type="text" class="form-control" id="category3" value="<?= $residence['category3']?>" readonly>
									<input type="text" class="form-control" id="category4" value="<?= $residence['category4']?>" readonly>
									<input type="text" class="form-control" id="category5" value="<?= $residence['category5']?>" readonly>
									<input type="text" class="form-control" id="category6" value="<?= $residence['category6']?>" readonly>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Building Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat1" name="cat1" required>
											<option value="">N/A</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>No Of Rooms:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat2" name="cat2" required>
											<option value="">N/A</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Property Class:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat3" name="cat3" required>
											<option value="">N/A</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Property Cat Type 1:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat4" name="cat4" required>
											<option value="">N/A</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Property Cat Type 2:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat5" name="cat5" required>
											<option value="">N/A</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Property Cat Type 3:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat6" name="cat6" required>
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
												<option value="<?=$con->id?>" <?=$residence['construction_material']==$con->id?'selected == selected':''; ?>><?=$con->material?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Roofing Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="roofing_type" name="roofing_type" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<?php foreach($roof as $rof){?>
												<option value="<?=$rof->id?>" <?=$residence['roofing_type']==$rof->id?'selected == selected':''; ?>><?=$rof->roof?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Type Of Business Building:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="type_of_building" name="type_of_building" class="form-control" required="">
											<option value="">SELECT OPTION</option>
											<option value="Permanent" <?=$residence['building_type']== "Permanent"?'selected == selected':''; ?>>Permanent</option>
									<option value="Temporary" <?=$residence['building_type']== "Temporary"?'selected == selected':''; ?>>Temporary</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4" id="part2" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Property Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="property_type2" name="property_type2" onChange="property()" class="form-control">
											<option value="">SELECT OPTION</option>
											<option value="Detached" <?=$residence['property_type']=='Detached'?'selected == selected':''; ?>>Detached</option>
											<option value="Semi-Detached" <?=$residence['property_type']=='Semi-Detached'?'selected == selected':''; ?>>Semi-Detached</option>
											<option value="Terrace" <?=$residence['property_type']=='Terrace'?'selected == selected':''; ?>>Terrace</option>
											<option value="Flat_Apartment" <?=$residence['property_type']=='Flat_Apartment'?'selected == selected':''; ?>>Flat Apartment</option>
											<option value="Compound" <?=$residence['property_type']=='Compound'?'selected == selected':''; ?>>Compound</option>			
										</select>
									</div>
									<div class="col-sm-4" id="floor" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>No Of Storeys / Floors:</strong></label>
										<input type="text" class="form-control" id="no_of_floors" value="<?=$residence['no_of_floors']?>" name="no_of_floors" autocomplete="off"/>
									</div>
									<div class="col-sm-4" id="part1" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Temporary Building Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="detail_for_temp" name="detail_for_temp" class="form-control" autocomplete="off" required="" >
											<option value="">SELECT OPTION</option>
											<option <?=$residence['temporary_building']=='Wooden Kiosk'?'selected == selected':''; ?> value="Wooden Kiosk">Wooden Kisok</option>
											<option <?=$residence['temporary_building']=='Metal Container'?'selected == selected':''; ?> value="Metal Container">Metal Container</option>
											<option <?=$residence['temporary_building']=='Mobile Van/Car'?'selected == selected':''; ?> value="Mobile Van/Car">Mobile Van/Car</option>
											<option <?=$residence['temporary_building']=='Table Top'?'selected == selected':''; ?> value="Table Top">Table Top</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Year Of Construction:</strong></label>
										<input type="text" class="form-control" id="year_of_construction" value="<?=$residence['year_of_construction']?>" name="year_of_construction" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
									<div class="col-sm-4 pull-right">
										<input type="text" class="form-control hidden" id="rescode" value="<?=$residence['res_code']?>" name="rescode"/>
										<input name="resid" value="<?= $residence['id']?>" type="hidden">
										<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Property Info" id="propbtn" type="button">
									</div>
								</div>
							</form>
						</section>

						<section class="section" id="content4">
							<form autocomplete="off" id="facform" method="post" enctype="multipart/form-data" action="<?=base_url()?>Residence/edit_facility_data">
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Toilet Facility:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="toilet_facility" name="toilet_facility" class="form-control" required="">
											<option value="">SELECT OPTION</option>
											<option value="Yes" <?=$residence['toilet_facility']=='Yes'?'selected == selected':''; ?>>Yes</option>
											<option value="No" <?=$residence['toilet_facility']=='No'?'selected == selected':''; ?>>No</option>
										</select>
									</div>
									<div class="col-sm-4" id="t_yes" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Toilet Facility Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="t_facility_yes" name="t_facility_yes" class="form-control" required="">
											<option value="">SELECT OPTION</option>
											<option value="WC" <?=$residence['t_facility_yes']=='WC'?'selected == selected':''; ?>>WC</option>
											<option value="VIP" <?=$residence['t_facility_yes']=='VIP'?'selected == selected':''; ?>>VIP</option>
											<option value="Aqua Privy" <?=$residence['t_facility_yes']=='Aqua Privy'?'selected == selected':''; ?>>Aqua Privy</option>
										</select>
									</div>
									<div class="col-sm-4" class="form-control" style="display: none;" id="t_no">
										<label class="control-label text-sm-right pt-2"><strong>Toilet Facility Type:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="t_facility_no" name="t_facility_no" required="">
											<option value="">SELECT OPTION</option>
											<option value="KVIP" <?=$residence['t_facility_no']=='KVIP'?'selected == selected':''; ?>>KVIP</option>
											<option value="Unapproved Location(Seashore,bush)" <?=$residence['t_facility_no']=='Unapproved Location(Seashore,bush)'?'selected == selected':''; ?>>Unapproved Location(Seashore,bush)</option>
										</select>
									</div>
									<div class="col-sm-4" style="display: none;" id="t_yes1">
										<label class="control-label text-sm-right pt-2"><strong>No Of Toilet Facility:</strong></label>
										<input type="text" class="form-control" id="no_of_toilet_facility" value="<?=$residence['no_of_toilet_facility']?>" name="no_of_toilet_facility" required="">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Availability Of Water:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="avai_of_water" name="avai_of_water" class="form-control" required="">
											<option value="">SELECT OPTION</option>
											<option value="Yes" <?=$residence['avai_of_water']=='Yes'?'selected == selected':''; ?>>Yes</option>
											<option value="No" <?=$residence['avai_of_water']=='No'?'selected == selected':''; ?>>No</option>
										</select>
									</div>
									<div class="col-sm-4" id="water_yes" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_yes" name="source_water_yes" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option value="GWC" <?=$residence['source_water_yes']=='GWC'?'selected == selected':''; ?>>GWC</option>
											<option value="Borehole" <?=$residence['source_water_yes']=='Borehole'?'selected == selected':''; ?>>Borehole</option>
											<option value="Hand Dug Well" <?=$residence['source_water_yes']=='Hand Dug Well'?'selected == selected':''; ?>>Hand Dug Well</option>
											<option value="Small Town Water System" <?=$residence['source_water_yes']=='Small Town Water System'?'selected == selected':''; ?>>Small Town Water System</option>
										</select>
									</div>
									<div class="col-sm-4" style="display: none;" id="water_no">
										<label class="control-label text-sm-right pt-2"><strong>Source Of Water:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="source_water_no" name="source_water_no" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option value="River" <?=$residence['source_water_no']=='River'?'selected == selected':''; ?>>River</option>
											<option value="Stream" <?=$residence['source_water_no']=='Stream'?'selected == selected':''; ?>>Stream</option>
											<option value="Brookes" <?=$residence['source_water_no']=='Brookes'?'selected == selected':''; ?>>Brookes</option>
											<option value="Others" <?=$residence['source_water_no']=='Others'?'selected == selected':''; ?>>Others</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Means of Waste Disposal:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="avai_of_refuse" name="avai_of_refuse" class="form-control" autocomplete="off" required>
											<option value="">SELECT OPTION</option>
											<option value="Yes" <?=$residence['avai_of_refuse']=='Yes'?'selected == selected':''; ?>>Yes</option>
											<option value="No" <?=$residence['avai_of_refuse']=='No'?'selected == selected':''; ?>>No</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4" id="refuse_yes" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Mode of Disposal:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="dumping_site_yes" name="dumping_site_yes" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option value="Waste Company" <?=$residence['dumping_site_yes']=='Waste Company'?'selected == selected':''; ?>>Waste Company</option>
											<option value="Public Waste Management Site" <?=$residence['dumping_site_yes']=='Public Waste Management Site'?'selected == selected':''; ?>>Public Waste Management Site</option>
										</select>
									</div>
									<div class="col-sm-4" style="display: none;" id="refuse_no">
										<label class="control-label text-sm-right pt-2"><strong>Mode of Disposal:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="dumping_site_no" name="dumping_site_no" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option value="Skip Container" <?=$residence['dumping_site_no']=='Skip Container'?'selected == selected':''; ?>>Skip Container</option>
											<option value="Unengineered sites" <?=$residence['dumping_site_no']=='Unengineered sites'?'selected == selected':''; ?>>Unengineered Sites</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Building Permit:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="building_permit" name="building_permit" onchange="b_permit()" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option value="Yes" <?=$residence['building_permit']=='Yes'?'selected == selected':''; ?>>Yes</option>
											<option value="No" <?=$residence['building_permit']=='No'?'selected == selected':''; ?>>No</option>
										</select>
									</div>
									<div class="col-sm-4" id="b_permit" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Building Permit No:</strong></label>
										<input type="text" class="form-control" id="building_cert_no" value="<?=$residence['building_cert_no']?>" name="building_cert_no" autocomplete="off" required=""/>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Planning Permit:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="planning_permit" name="planning_permit" onchange="p_permit()" class="form-control" autocomplete="off" required>
											<option value="">SELECT OPTION</option>
											<option value="Yes" <?=$residence['planning_permit']=='Yes'?'selected == selected':''; ?>>Yes</option>
											<option value="No" <?=$residence['planning_permit']=='No'?'selected == selected':''; ?>>No</option>
										</select>
									</div>
									<div class="col-sm-4"  id="p_permit" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Planning Permit No:</strong></label>
										<input type="text" class="form-control" value="<?=$residence['planning_permit_no']?>" id="planning_permit_no" name="planning_permit_no" autocomplete="off" required=""/>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>No Of Residents:</strong></label>
										<input type="text" class="form-control" id="no_of_residents" name="no_of_residents" value="<?=$residence['noOfResidents']?>" autocomplete="off" required="" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>No Of Residents Greater 18:</strong></label>
										<input type="text" class="form-control" value="<?=$residence['resident_greater_18']?>" name="resident_greater_18" required=""/>
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Building Status:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="building_status" onchange="inhabitant()" name="building_status" class="form-control" autocomplete="off" required>
											<option value="">SELECT OPTION</option>
											<option <?=$residence['building_status']=='1'?'selected == selected':''; ?> value="1">Completed</option>
											<option <?=$residence['building_status']=='0'?'selected == selected':''; ?> value="0">Uncompleted</option>
										</select>
									</div>
									<div class="col-sm-4" id="uncompleted_yes" style="display: none;">
										<label class="control-label text-sm-right pt-2"><strong>Inhabitant Status:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="inhabitant_status" name="inhabitant_status" class="form-control" required>
											<option value="">SELECT OPTION</option>
											<option <?=$residence['inhabitant_status']=='Inhabited'?'selected == selected':''; ?> value="Inhabited">Inhabited</option>
											<option <?=$residence['inhabitant_status']=='Uninhabited'?'selected == selected':''; ?> value="Uninhabited">Uninhabited</option>
										</select>
									</div>
								</div>
								<div class="form-group row"> 
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>Valuation Status:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="accessed_status" id="accessed_status" onchange="accessed()" class="form-control" autocomplete="off" required>
											<option value="">SELECT OPTION</option>
											<option <?=$residence['accessed']=='0'?'selected == selected':''; ?> value="0">Unaccessed</option>
											<option <?=$residence['accessed']=='1'?'selected == selected':''; ?> value="1">Accessed</option>
										</select>
									</div>
									<div class="col-sm-4" id="rateable" style="display:none">
										<label class="control-label text-sm-right pt-2"><strong>Rateable Amount:</strong></label>
										<input type="number" value='<?= ($ap["rateable_value"] == "")?"":number_format((float)$ap["rateable_value"], 2, ".", ""); ?>' step=".01" class="form-control" name="rateable_amount" required />
									</div>
									<div class="col-sm-4" id="rate" style="display:none">
										<label class="control-label text-sm-right pt-2"><strong>Rate:</strong></label>
										<input type="number" value='<?=($ap["rate"]== "")?"":$ap["rate"]?>' step=".001" class="form-control" name="rate" required />
									</div>
									<div class="col-sm-4" id="valuation" style="display:none">
										<label class="control-label text-sm-right pt-2"><strong>Valuation Number:</strong></label>
										<input type="text" value='<?=($ap["valuation_number"]== "")?"":$ap["valuation_number"]?>' class="form-control" name="valuation_number" required />
									</div>
									<div class="col-sm-4">
										<label class="control-label text-sm-right pt-2"><strong>UPN Number:</strong></label>
										<input type="text" value="<?=$residence['upn_number']?>" class="form-control" name="upn_number"/>
									</div>
									<div class="col-sm-4 assessed" style="display:none">
										<label class="control-label text-sm-right pt-2"><strong>Property Assessment:</strong></label>
										<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="property_assessment" id="property_assessment" onchange="propertyAssessment()" class="form-control" autocomplete="off" required>
											<option value="">SELECT OPTION</option>
											<option <?=$residence['assessable_status']=='0'?'selected == selected':''; ?> value="0">Unrateable</option>
											<option <?=$residence['assessable_status']=='1'?'selected == selected':''; ?> value="1">Rateable</option>
										</select>
									</div>
									<div class="col-sm-4 assessed" id="photo" style="display:none">
										<label class="control-label text-sm-right pt-2"><strong>Photo:</strong></label>
										<input class="form-control hidden" type="text" value="<?=$residence['property_image']?>" name="old_image"/>
										<input class="form-control hidden" type="text" value="<?=$residence['image_path']?>" name="image_path"/>
										<input class="form-control" type="file" name="userfile"/>

										<a class="example-image-link" href="<?= ($residence['property_image'] == '')? base_url().'upload/property/residence/no-image.png': base_url().$residence['image_path'].$residence['property_image']?>" data-lightbox="example-1">
											<img class="example-image" src="<?= ($residence['property_image'] == '')? base_url().'upload/property/residence/no-image.png': base_url().$residence['image_path'].$residence['property_image']?>" style="max-width:20em;max-height:20em;margin-top:0.5em;" alt="">
										</a>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
									<div class="col-sm-4 pull-right">
										<input type="text" class="form-control hidden" id="rescode" value="<?=$residence['res_code']?>" name="rescode">
										<input name="resid" value="<?= $residence['id']?>" type="hidden">
										<input name="apid" value='<?=($ap['id'] == "")?"":$ap['id']?>' type="hidden">
										<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Facility Info" id="facbtn" type="button">
									</div>
								</div>
							</form>
						</section>

						<!-- <section class="section" id="content5">
							<table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
								<thead>
									<tr>
									<th>RESIDENCE CODE</th>
									<th>NAME</th>
									<th>GENDER</th>
									<th>PRIMARY CONTACT</th>
									<th>SECONDARY CONTACT</th>
									<th>E-MAIL</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($result as $value):?>
									<tr>
									<td>
										<a style="text-decoration: none;" href='<?= base_url().'Residence/edit_household_form/'.$value->id?>'><?=$value->res_prop_code?></a>
									</td>
									<td><?= $value->firstname .' '. $value->lastname ?></td>
									<td><?= $value->gender ?></td>
									<td><a style="text-decoration: none;" href="tel:<?php echo $value->primary_contact ?>"><?= $value->primary_contact ?></a></td>
									<td><a style="text-decoration: none;" href="tel:<?php echo $value->secondary_contact ?>"><?= $value->secondary_contact ?></a></td>
									<td><?= $value->email ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</section> -->
							
						<section class="section" id="content6">
							<div id="map" style="width:100%;height: 30em;"></div>
						</section>

						<section class="section" id="content7">
							<table class="table table-responsive-md mb-0" id="datatable-default">
								<thead>
									<tr>
										<th>INVOICE NO</th>
										<th>PRODUCT</th>
										<th>INVOICE AMOUNT</th>
										<th>DISCOUNT</th>
										<th>AMOUNT PAID</th>
										<th>OUTSTANDING AMOUNT</th>
										<th>ASSESSED</th>
										<th>CATEGORY 1</th>
										<th>CATEGORY 2</th>
										<th>CATEGORY 3</th>
										<th>CATEGORY 4</th>
										<th>CATEGORY 5</th>
										<th>CATEGORY 6</th>
										<th>DATE GENERATED</th>
										<th>PAYMENT DUE DATE</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($invoices as $inv):?>
										<tr>
											<?php 
												$url_invoice = base_url() . "view_invoice/" . $inv->id;
												$url = base_url() . "invoice_transaction/" . $inv->id;
											?>
											<td><?php echo "<a href='$url_invoice'>" . $inv->invoice_no . "</a>"; ?></td>
											<td><?=$inv->name?></td>
											<td><?=number_format((float) $inv->invoice_amount + $inv->adjustment_amount, 2, '.', ',')?></td>
											<td><?=number_format((float) $inv->adjustment_amount, 2, '.', ',')?></td>
											<td><?php echo "<a href='$url'>" . number_format((float) $inv->amount_paid, 2, '.', ',') . "</a>"?></td>
											<td><?=number_format((float) $inv->invoice_amount - $inv->amount_paid, 2, '.', ',')?></td>
											<?php if ($inv->accessed == 1) { ?>
												<td><span class="badge badge-success">Assessed</span></td>
											<?php } else { ?>
												<td><span class="badge badge-danger">Unassessed</span></td>
											<?php } ?>
											<td><?=$inv->category1?></td>
											<td><?=$inv->category2?></td>
											<td><?=$inv->category3?></td>
											<td><?=$inv->category4?></td>
											<td><?=$inv->category5?></td>
											<td><?=$inv->category6?></td>
											<td><?=date("Y-m-d H:i:s", strtotime($inv->date_created))?></td>
											<td><?=date("Y-m-d", $inv->payment_due_date)?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<td><b>TOTAL:</b></td>
										<td></td>
										<td><b><?=number_format((float) $invoices_sum['invoice_amount'] + $invoices_sum['discount'], 2, '.', ',')?></b></td>
										<td><b><?=number_format((float) $invoices_sum['discount'], 2, '.', ',')?></b></td>
										<td><b><?=number_format((float) $invoices_sum['amount_paid'], 2, '.', ',')?></b></td>
										<td><b><?=number_format((float) $invoices_sum['invoice_amount'] - $invoices_sum['amount_paid'], 2, '.', ',')?></b></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</section>

					</main>
				</div>
			</section>
		</div>
    </div>
</div>

<!-- end: page -->

<script>

	function initMap() {
		var myLatLng = {lat: <?=$residence['gps_lat']?>, lng: <?=$residence['gps_long']?>};

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
