<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
          	<main>

				<input id="tab1" type="radio" name="tabs" checked>
				<label class="label" for="tab1">Business Info</label>

				<input id="tab2" type="radio" name="tabs">
				<label class="label" for="tab2">Business Owner Info</label>

				<input id="tab3" type="radio" name="tabs">
				<label class="label" for="tab3">Business Category Info</label>

				<input id="tab5" type="radio" name="tabs">
				<label class="label" for="tab5">Business Categories</label>
		
				<input id="tab4" type="radio" name="tabs">
				<label class="label" for="tab4">Maps</label>

				<input id="tab6" type="radio" name="tabs">
				<label class="label" for="tab6">Invoice(s)</label>

				<?php $owner = business_occ_owner_details($bus['id']); ?>
				<?php $ap = accessed_property(3,$bus['id']); ?>

				<section class="section" id="content1">
				  	<form autocomplete="off" id="formm" method="post" action="<?=base_url()?>Business/edit_business_info_data">
                    	<div class="form-group row">
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business Name:</strong></label>
								<input type="text" class="form-control" id="buis_name" name="buis_name" value="<?=$bus['buis_name']?>" autocomplete="off" required/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business Primary Contact:</strong></label>
								<input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" value="<?=$bus['buis_primary_phone']?>"  autocomplete="off" required/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business Secondary Contact:</strong></label>
								<input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" value="<?=$bus['buis_secondary_phone']?>" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business Website:</strong></label>
								<input type="text" class="form-control" id="buis_website" name="buis_website" value="<?=$bus['buis_website']?>"  autocomplete="off"/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business E-mail:</strong></label>
								<input type="email" class="form-control" id="buis_email" name="buis_email" value="<?=$bus['buis_email']?>" autocomplete="off"/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Existing Temporary Business Code:</strong></label>
								<input type="text" class="form-control" id="old_bus_code" value="<?=$bus['old_bus_code']?>" name="old_bus_code" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business property Code:</strong></label>
								<input type="text" class="form-control" onKeyUp="check_busprop_code();" value="<?=$bus['buis_property_code']?>" id="buis_property_code" name="buis_property_code" autocomplete="off" required/>
								<span id="status" class="badge badge-danger" style="display:none">Invalid</span>
								<span id="statuss" class="badge badge-success" style="display:none">Valid</span>
							</div>	
		              	</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
							<div class="col-sm-4 pull-right">
								<input name="id" value="<?= $bus['id']?>" type="hidden">
							<input name="bus_code" value="<?= $bus['buis_occ_code']?>" type="hidden">
								<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Business Info" id="btnet" type="button">
							</div>
						</div>
                    </form>
				</section>
				<section class="section" id="content2">
				  	<form autocomplete="off" id="formm1" method="post" action="<?=base_url()?>Business/edit_owner_data">
					  	<div class="form-group row">
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
								<input type="text" class="form-control" value="<?=$owner['primary_contact']?>" minlength=10 id="primary_contact" name="primary_contact" required>
								<input type="hidden" class="form-control" value="<?=$owner['primary_contact']?>" minlength=10 name="original_primary_contact" required>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Respondent:</strong></label>
								<select class="form-control" id="personal_category" name="personal_category" required="">
									<option value="">SELECT OPTION</option>
									<option <?=$owner['person_category']=='Owner'?'selected == selected':''; ?> value="Owner">Owner</option>
									<option <?=$owner['person_category']=='Caretaker'?'selected == selected':''; ?>value="Caretaker">Caretaker</option>
								</select>
							</div>
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Other Names:</strong></label>
								<input type="text" class="form-control" value="<?= $owner['firstname']?>" id="firstname" name="firstname" required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Surname:</strong></label>
								<input type="text" class="form-control" value="<?=$owner['lastname']?>" id="lastname" name="lastname" required>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Gender:</strong></label>
								<select class="form-control" id="gender" name="gender" required="">
										<option value="">SELECT OPTION</option>
										<option <?= $owner['gender'] == "male"?'selected==selected':''?> value="male">Male</option>
										<option <?= $owner['gender'] == "female"?'selected==selected':''?> value="female">Female</option>
								</select>
							</div>
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
								<input type="text" class="form-control"  id="email" value="<?=$owner['email']?>" name="email">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Postal Address:</strong></label>
								<input type="text" class="form-control"  id="postal_address" value="<?=$owner['postal_address']?>" name="postal_address">
							</div>
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Ghanapost GPS code:</strong></label>
								<input type="text" class="form-control"  id="owner_ghpost_gps" value="<?=$owner['ghpostgps_code']?>" name="owner_ghpost_gps">
							</div>
							<div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Secondary Contact:</strong></label>
								<input type="text" class="form-control" value="<?=$owner['secondary_contact']?>" id="secondary_contact" name="secondary_contact">
							</div>
							<!-- <div class="col-sm-4 owner_others">
								<label class="control-label text-sm-right pt-2"><strong>Owner Resides In Municipality:</strong></label>
								<select class="form-control" id="owner_native" name="owner_native" required="">
									<option value="">SELECT OPTION</option>
									<option <?= $owner['owner_native'] == "Yes"?'selected==selected':''?> value="Yes">Yes</option>
									<option <?= $owner['owner_native'] == "No"?'selected==selected':''?> value="No">No</option>
								</select>
							</div> -->
						</div>
						<div class="form-group row">
							<!-- <div class="col-sm-4 owner_others">
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
							</div> -->
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Is Owner Person With Disability:</strong></label>
								<select class="form-control" id="owner_pwd" name="owner_pwd" required="">
										<option value="">SELECT OPTION</option>
										<option <?= $owner['owner_pwd'] == "no"?'selected==selected':''?> value="no">No</option>
										<option <?= $owner['owner_pwd'] == "yes"?'selected==selected':''?> value="yes">Yes</option>
								</select>
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
                    	<!-- <div class="form-group row" style="display:none;">
							<div class="col-sm-4 owner_reside">
								<label class="control-label text-sm-right pt-2"><strong>Electoral Area:</strong></label>
								<select class="form-control" id="owner_area_council" name="owner_area_council">
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
						</div>-->
		                <div class="form-group row">
                            <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                            <div class="col-sm-4 pull-right">
                                <input name="ownid" value="<?= $owner['id']?>" type="hidden">
                                <input name="bus_code" value="<?= $bus['buis_occ_code']?>" type="hidden">
                                <input name="id" value="<?= $bus['id']?>" type="hidden">
                                <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Business Owner Info" id="btnet1" type="button">
                            </div>
                        </div>
	                </form>
				</section>
				<section class="section" id="content3">
				  	<form autocomplete="off" id="formm2" method="post" action="<?=base_url()?>Business/edit_business_category_data">
                   
						<div class="form-group row">
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Year Of Establishment:</strong></label>
								<input type="number" class="form-control" id="year_of_est" name="year_of_est" value="<?=$bus['year_of_est']?>" utocomplete="off" required/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Business Registration Cert No:</strong></label>
								<input type="text" class="form-control" id="buis_reg_cert_no" name="buis_reg_cert_no" value="<?=$bus['buis_reg_cert_no']?>" autocomplete="off" required/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Nature of Business operation:</strong></label>
								<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="nature_of_buisness" name="nature_of_buisness" class="form-control" autocomplete="off" required>
									<option value="">SELECT OPTION</option>
									<option value="Head Office" <?=$bus['nature_of_buisness']== "Head Office"?'selected == selected':''; ?>>Head Office</option>
									<option value="Regional Office" <?=$bus['nature_of_buisness']== "Regional Office"?'selected == selected':''; ?>>Regional Office</option>
									<option value="Branch/District Office" <?=$bus['nature_of_buisness']== "Branch/District Office"?'selected == selected':''; ?>>Branch/District Office</option>
									<option value="Agency" <?=$bus['nature_of_buisness']== "Agency"?'selected == selected':''; ?>>Agency</option>
									<option value="Sole Proprietorship office" <?=$bus['nature_of_buisness']== "Sole Proprietorship office"?'selected == selected':''; ?>>Sole Proprietorship office</option>
								</select>
							</div>
						</div>
						<div class="form-group row">      
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>No of Employees:</strong></label>
								<input type="number" class="form-control" id="no_of_employees" name="no_of_employees" value="<?=$bus['no_of_employees']?>" autocomplete="off" required/>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>No of Rooms/Office space:</strong></label>
								<input type="text" class="form-control" id="no_of_rooms" name="no_of_rooms" autocomplete="off" value="<?=$bus['no_of_rooms']?>" required/>
							</div>
							<div class="col-sm-4" style="display:none">
								<label class="control-label text-sm-right pt-2"><strong>Type of Business Building:</strong></label>
								<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="type_of_building" name="type_of_building" class="form-control" autocomplete="off" required>
									<option value="">SELECT OPTION</option>
									<option value="Permanent" <?=$bus['type_of_building']== "Permanent"?'selected == selected':''; ?>>Permanent</option>
									<option value="Temporary" <?=$bus['type_of_building']== "Temporary"?'selected == selected':''; ?>>Temporary</option>
								</select>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Property Occupancy Type:</strong></label>
								<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="ownership" name="ownership" class="form-control" autocomplete="off" required>
									<option value="">SELECT OPTION</option>
									<option value="Owner" <?=$bus['ownership']== "Original Owner"?'selected == selected':''; ?>>Original Owner</option>
									<option value="Rented" <?=$bus['ownership']== "Rented"?'selected == selected':''; ?>>Rented</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4" id="temp" style="display: none;">
								<label class="control-label text-sm-right pt-2"><strong>Temporary Building Type:</strong></label>
								<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="detail_for_temp" name="detail_for_temp" class="form-control" autocomplete="off" required>
									<option value="">SELECT OPTION</option>
									<option value="Wooden Kiosk" <?=$bus['detail_for_temp']== "Wooden Kiosk"?'selected == selected':''; ?>>Wooden Kiosk</option>
									<option value="Metal Container" <?=$bus['detail_for_temp']== "Metal Container"?'selected == selected':''; ?>>Metal Container</option>
									<option value="Mobile Van/Car" <?=$bus['detail_for_temp']== "Mobile Van/Car"?'selected == selected':''; ?>>Mobile Van/Car</option>
									<option value="Table Top" <?=$bus['detail_for_temp']== "Table Top"?'selected == selected':''; ?>>Table Top</option>
								</select>
							</div>
							<div class="col-sm-4">
								<label class="control-label text-sm-right pt-2"><strong>Sub-UPN Number:</strong></label>
								<input type="text" class="form-control" name="subupn_number" value="<?=$bus['subupn_number']?>"/>
							</div>
							<div class="col-sm-4" style="display:none">
								<label class="control-label text-sm-right pt-2"><strong>Accessed Status:</strong></label>
								<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="accessed_status" id="accessed_status" onchange="accessed()" class="form-control" autocomplete="off" required>
									<option value="">SELECT OPTION</option>
									<option <?=$bus['accessed']=='0'?'selected == selected':''; ?> value="0">Unaccessed</option>
									<option <?=$bus['accessed']=='1'?'selected == selected':''; ?> value="1">Accessed</option>
								</select>
							</div>
						</div>
						<div class="form-group row">   
							<div class="col-sm-4" id="rateable" style="display:none">
								<label class="control-label text-sm-right pt-2"><strong>Rateable Amount:</strong></label>
								<input type="number" value='<?= ($ap["rateable_value"] == "")?"":number_format((float)$ap["rateable_value"], 2, ".", ""); ?>' step=".01" class="form-control" name="rateable_amount" required />
							</div>
							<div class="col-sm-4" id="rate" style="display:none">
								<label class="control-label text-sm-right pt-2"><strong>Rate:</strong></label>
								<input type="number" value='<?=($ap["rate"]== "")?"":$ap["rate"]?>' step=".001" class="form-control" name="rate" required />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
							<div class="col-sm-4 pull-right">
								<input name="id" value="<?= $bus['id']?>" type="hidden">
								<input name="bus_code" value="<?= $bus['buis_occ_code']?>" type="hidden">
								<input name="apid" value='<?=($ap['id'] == "")?"":$ap['id']?>' type="hidden">
								<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Business Category Info" id="btnet2" type="button">
							</div>
						</div>
                    </form>
          		</section>
				<section class="section" id="content5">
					<table class="table table-responsive-md mb-0">
							<thead>
								<tr>
									<th>CATEGORY 1</th>
									<th>CATEGORY 2</th>
									<th>CATEGORY 3</th>
									<th>CATEGORY 4</th>
									<th>CATEGORY 5</th>
									<th>CATEGORY 6</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($bus_categories as $busc):?>
									<tr>
										<td><?=$busc->category1?></td>
										<td><?=$busc->category2?></td>
										<td><?=$busc->category3?></td>
										<td><?=$busc->category4?></td>
										<td><?=$busc->category5?></td>
										<td><?=$busc->category6?></td>
										<td class="actions-hover actions-fade">
											<?php if(has_permission($this->session->userdata('user_info')['id'],'edit busocc cat')){?>
												<a onclick="busocc_modal('<?php echo $busc->cat1 ?>','<?php echo $busc->cat2 ?>','<?php echo $busc->cat3 ?>','<?php echo $busc->cat4 ?>','<?php echo $busc->cat5?>','<?php echo $busc->cat6?>','<?php echo $busc->id?>','<?php echo $bus['buis_occ_code']?>','<?php echo $bus['id']?>');" href="#"><i class="fa fa-pencil"></i></a>
											<?php }else{} ?>
											<?php if(has_permission($this->session->userdata('user_info')['id'],'del busocc cat')){?>
												<a onclick="busoccdel_modal('<?php echo $busc->id?>','<?php echo $bus['buis_occ_code']?>','<?php echo $bus['id']?>');" href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
											<?php }else{} ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
					</table>
				</section>
						
          		<section class="section" id="content4">
					<div id="map" style="width:100%;height: 30em;"></div>
				</section>

				<section class="section" id="content6">
					<table class="table table-responsive-md mb-0" id="datatable-default">
						<thead>
							<tr>
								<th>BILL NO</th>
								<th>PRODUCT</th>
								<th>BILL AMOUNT</th>
								<th>ADJUSTMENT</th>
								<th>AMOUNT PAID</th>
								<th>OUTSTANDING AMOUNT</th>
								<th>VALUATION STATUS</th>
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

<!-- end: page -->

<script>

	function initMap() {
		var myLatLng = {lat: <?=$bus['gps_lat']?>, lng: <?=$bus['gps_long']?>};

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

<!-- Modal Form -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicForm" action="<?=base_url("Business/edit_busocc_category")?>" method="Post">
          	<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<b>Business Category Form</b>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">
							&times;
						</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row" style="display:none;">
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Business Category ID:</strong></label>
							<input class="form-control" name="buscatid" id="buscatid" type="text" readonly>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
							<input class="form-control" name="busocccode" id="busocccode" type="text" readonly>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
							<input class="form-control" name="busid" id="busid" type="text" readonly>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
							<input name="id" id="buscatid" type="text">
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat1" name="cat1" required>
									<option value="">N/A</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 2:</strong></label>
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat2" name="cat2" required>
									<option value="">N/A</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 3:</strong></label>
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat3" name="cat3" required>
									<option value="">N/A</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 4:</strong></label>
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat4" name="cat4" required>
									<option value="">N/A</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 5:</strong></label>
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat5" name="cat5" required>
									<option value="0">N/A</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 6:</strong></label>
							<select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="cat6" name="cat6" required>
									<option value="0">N/A</option>
							</select>
						</div>
					</div>
              	</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-success">
						Submit
						</button>
				</div>
          	</div>
        </form>
    </div>
</div>
<!--end::Modal-->

<!-- Modal Form -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form id="basicForm" action="<?=base_url("Business/delete_busocc_category")?>" method="Post">
          <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						<b>Delete Alert !</b>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">
							&times;
						</span>
					</button>
				</div>
              	<div class="modal-body">
					<div class="form-group row" style="display:none;">
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Business Category ID:</strong></label>
							<input class="form-control" name="buscatid" id="buscatid1" type="text" readonly>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
							<input class="form-control" name="busocccode" id="busocccode1" type="text" readonly>
						</div>
						<div class="col-sm-4">
							<label class="control-label text-sm-right pt-2"><strong>Category 1:</strong></label>
							<input class="form-control" name="busid" id="busid1" type="text" readonly>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							Are you sure you want delete this business category.
						</div>		
					</div>
              	</div>
              <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-success">
						Yes Delete
					</button>
              </div>
          </div>
        </form>
    </div>
</div>
<!--end::Modal-->
