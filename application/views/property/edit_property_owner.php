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
				  <label class="label" for="tab2">Residence</label>

				  <input id="tab3" type="radio" name="tabs">
				  <label class="label" for="tab3">Business Property</label>

				  <input id="tab4" type="radio" name="tabs">
				  <label class="label" for="tab4">Business Occupant</label>


				  <section class="section" id="content1">
				  	<form autocomplete="off" id="basicformm" method="post" action="<?=base_url()?>Property/edit_personnal_data">


		                  <div class="form-group row">
			                <div class="col-sm-4">
			                  <label class="control-label text-sm-right pt-2"><strong>Primary Contact:</strong></label>
			                  <input type="text" class="form-control" value="<?=$owner['primary_contact']?>" minlength=10 id="primary_contact" name="primary_contact" required>
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
			                  <label class="control-label text-sm-right pt-2"><strong>Is Owner A Native:</strong></label>
			                  <select class="form-control" id="owner_native" name="owner_native" required="">
			                        <option value="">SELECT OPTION</option>
			                        <option <?= $owner['owner_native'] == "Yes, Resides In Property"?'selected==selected':''?> value="Yes, Resides In Property">Yes, Resides In Property</option>
			                        <option <?= $owner['owner_native'] == "Yes, Does not Reside In Property"?'selected==selected':''?> value="Yes, Does not Reside In Property">Yes, Does not Reside In Property</option>
                              <option <?= $owner['owner_native'] == "Yes, Does not Reside In Property And In District"?'selected==selected':''?> value="Yes, Does not Reside In Property And In District">Yes, Does not Reside In Property And In District</option>
			                        <option <?= $owner['owner_native'] == "No"?'selected==selected':''?> value="No">No</option>
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
			                <div class="col-sm-4 owner_reside">
			                  <label class="control-label text-sm-right pt-2"><strong>Area Council:</strong></label>
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
			              <div class="form-group row">
			                <div class="col-sm-4 owner_reside_not">
			                  <label class="control-label text-sm-right pt-2"><strong>Location:</strong></label>
			                  <input type="text" class="form-control" id="owner_location" value="<?=$owner['location']?>"  name="owner_location" required>
			                </div>
			                <div class="col-sm-4 owner_reside_not">
			                  <label class="control-label text-sm-right pt-2"><strong>Hometown:</strong></label>
			                  <input type="text" class="form-control" id="owner_hometown" value="<?=$owner['hometown']?>" name="owner_hometown" required="">
			                </div>
			                <div class="col-sm-4 owner_reside_not">
			                  <label class="control-label text-sm-right pt-2"><strong>Hometown District:</strong></label>
			                  <input type="text" class="form-control" id="owner_home_district" value="<?=$owner['home_district']?>" name="owner_home_district" required="">
			                </div>
			              </div>
			              <div class="form-group row">
			                <div class="col-sm-4 owner_reside_not">
			                  <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
			                  <select class="form-control"  id="owner_region" name="owner_region" required="">
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
			                  <input type="text" class="form-control" id="owner_ethnicity" value="<?=$owner['ethnicity']?>" name="owner_ethnicity" required="">
			                </div>
			                <div class="col-sm-4 owner_reside_not">
			                  <label class="control-label text-sm-right pt-2"><strong>Native Language:</strong></label>
			                  <input type="text" class="form-control" id="owner_native_language" value="<?=$owner['native_language']?>" name="owner_native_language" required="">
			                </div>
			              </div>
			               <div class="form-group row">
                          <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                          <div class="col-sm-4 pull-right">
                              <input name="ownid" value="<?= $owner['id']?>" type="hidden">
                              <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btnn" type="button">
                          </div>
                      </div>
              </form>
              <div class="form-group row" id="edit_f">
                   <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                   <div class="col-sm-4 pull-right">
                       <input style="font-size:1.0rem;margin-top:0.5em;" class="btn btn-primary form-control" value="Edit" id="edit" type="button">
                   </div>
                   <div class="col-sm-4 pull-right">

                   </div>
               </div>
               <div class="form-group row" id="view_f" style="display:none">
                    <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                    <div class="col-sm-4 pull-right">
                        <input style="font-size:1.0rem;margin-top:0.5em;" class="btn btn-primary form-control" value="View" id="view" type="button">
                    </div>
                    <div class="col-sm-4 pull-right">

                    </div>
                </div>
				  </section>

					  <section class="section" id="content2">
              <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                <thead>
                    <tr>
                      <th class="text-center">RESIDENCE CODE</th>
                      <th class="text-center">AREA COUNCIL</th>
                      <th class="text-center">TOWN</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">OWNER</th>
                      <th class="text-center">PRIMARY CONTACT</th>
                      <th class="text-center">SECONDARY CONTACT</th>
                      <th class="text-center">RESEND CODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($residence as $value):?>
                    <?php $owner = owner_details($value->id); ?>
                      <tr>
                        <td class="text-center">
                            <a style="text-decoration: none;" href='<?= base_url().'Residence/edit_residence_form/'.$value->id.'/'.$value->res_code?>'><?= $value->res_code ?></a>
                        </td>
                        <td class="text-center"><?= $value->area ?></td>
                        <td class="text-center"><?= $value->tt ?></td>
                        <td>
                          <?php if($value->status == 1){?>
                            <span class="badge badge-success">Complete</span>
                          <?php }else{?>
                            <span class="badge badge-danger">Incomplete</span>
                          <?php }?>
                        </td>
                        <td class="text-center"><?= $owner['firstname'].' '.$owner['lastname']?></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $owner['secondary_contact'] ?>"><?= $owner['secondary_contact'] ?></a></td>
                        <td class="text-center">
                          <form method="post" action="<?=base_url()?>Residence/resend_residence_sms">
                            <input type="hidden" name="number" value="<?= $owner['primary_contact'] ?>">
                            <input type="hidden" name="rescode" value="<?= $value->res_code ?>">
                            <input type="hidden" name="houseno" value="<?= $value->houseno ?>">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
					  </section>

					  <section class="section" id="content3">
              <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                  <thead>
                    <tr>
                      <th class="text-center">BUSINESS CODE</th>
                      <th class="text-center">AREA COUNCIL</th>
                      <th class="text-center">TOWN</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">OWNER</th>
                      <th class="text-center">PRIMARY CONTACT</th>
                      <th class="text-center">SECONDARY CONTACT</th>
                      <th class="text-center">RESEND CODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($busprop as $value):?>
                    <?php $owner = business_owner_details($value->id); ?>
                      <tr>
                        <td class="text-center">
                          <a style="text-decoration: none;" href='<?= base_url().'Business/edit_business_property_form/'.$value->id.'/'.$value->buis_prop_code?>'><?= $value->buis_prop_code ?></a>
                        </td>
                        <td class="text-center"><?= $value->area ?></td>
                        <td class="text-center"><?= $value->tt ?></td>
                        <td class="text-center">
                          <?php if($value->status == 1){?>
                            <span class="badge badge-success">Complete</span>
                          <?php }else{?>
                            <span class="badge badge-danger">Incomplete</span>
                          <?php }?>
                        </td>
                        <td class="text-center"><?= $owner['firstname'].' '.$owner['lastname']?></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $owner['secondary_contact'] ?>"><?= $owner['secondary_contact'] ?></a></td>
                        <td class="text-center">
                          <form method="post" action="<?=base_url()?>Business/resend_business_sms">
                            <input type="hidden" name="number" value="<?= $owner['primary_contact'] ?>">
                            <input type="hidden" name="buscode" value="<?= $value->buis_prop_code ?>">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
					  </section>
					  <section class="section" id="content4">
              <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                 <thead>
                    <tr>
                      <th class="text-center">BUSINESS CODE</th>
                      <th class="text-center">BUSINESS NAME</th>
                      <th class="text-center">BUSINESS PRIMARY CONTACT</th>
                      <th class="text-center">E-MAIL</th>
                      <th class="text-center">OWNER</th>
                      <th class="text-center">Primary CONTACT</th>
                      <th class="text-center">RESEND CODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($busocc as $value):?>
                      <?php $owner = business_occ_owner_details($value->id); ?>
                      <tr>
                        <td class="text-center">
                          <a style="text-decoration: none;" href='<?= base_url().'Business/edit_business_occupant_form/'.$value->id?>'><?= $value->buis_occ_code ?></a>
                        </td>
                        <td class="text-center"><?= $value->buis_name ?></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $value->buis_primary_phone ?>"><?= $value->buis_primary_phone ?></a></td>
                        <td class="text-center"><a style="text-decoration: none;" href="mailto:<?php echo $value->buis_email ?>"><?= $value->buis_email ?></a></td>
                        <td class="text-center"><?= $owner['firstname'].' '.$owner['lastname'] ?></td>
                        <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a></td>
                        <td class="text-center">
                          <form method="post" action="<?=base_url()?>Business/resend_business_occ_sms">
                            <input type="hidden" name="number" value="<?= $owner['primary_contact'] ?>">
                            <input type="hidden" name="bus_occ_code" value="<?= $value->buis_occ_code ?>">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
					  </section>

				</main>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
