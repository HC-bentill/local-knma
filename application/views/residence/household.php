
  <!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('Residence/search_household')?>" autocomplete="off">
            <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
              <div class="col-lg-12">
                <div class="form-group m-form__group row">
                  <div class="col-lg-3">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_by" name="search_by">
                        <option value="">Select Option</option>
                        <option <?=$search_by =='Date'?'selected == selected':''; ?> value="Date">Search By Date</option>
                        <option <?=$search_by =='Keyword'?'selected == selected':''; ?> value="Keyword">Search By Keyboard</option>
                    </select>
                  </div>
                  <div class="col-lg-3" id="date1">
                    <input type="date" class=" form-control" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                  </div>
                  <div class="col-lg-3" id="date2">
                    <input type="date" class="form-control" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
                  </div>
                  <div class="col-lg-3" id="search_box1" style="display:none;" required>
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_option" name="search_option">
                        <option value="">Select Search Option</option>
                        <option <?=$search_option =='residence_code'?'selected == selected':''; ?> value="residence_code">Residence Code</option>
                        <option <?=$search_option =='firstname'?'selected == selected':''; ?> value="firstname">Firstname</option>
                        <option <?=$search_option =='lastname'?'selected == selected':''; ?> value="lastname">Lastname</option>
                        <option <?=$search_option =='fullname'?'selected == selected':''; ?> value="fullname">Full Name</option>
                        <option <?=$search_option =='pc'?'selected == selected':''; ?> value="pc">Primary Contact</option>
                        <option <?=$search_option =='sc'?'selected == selected':''; ?> value="sc">Secondary Contact</option>
                        <option <?=$search_option =='email'?'selected == selected':''; ?> value="email">Email</option>
                    </select>
                  </div>
                  <div class="col-lg-3" id="search_box" style="display:none;">
                    <input type="text" class="form-control" id="search_item" placeholder="Enter Search Word" name="keyword" value="<?=$keyword?>">
                  </div>
                  <div class="col-lg-3">
                    <button type="submit" id="save" class="btn btn-success">
                      Search
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th class="text-center">RESIDENCE CODE</th>
                  <th class="text-center">NAME</th>
                  <th class="text-center">GENDER</th>
                  <th class="text-center">PRIMARY CONTACT</th>
                  <th class="text-center">E-MAIL</th>
                  <th class="text-center">RESEND CODE</th>
                  <th class="text-center">MESSAGE</th>
                </tr>
               </thead>
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td class="text-center">
                      <a style="text-decoration: none;" href='<?= base_url().'Residence/edit_household_form/'.$value->id?>'><?=$value->res_prop_code?></a>
                    </td>
                    <td class="text-center"><?= $value->firstname .' '. $value->lastname ?></td>
                    <td class="text-center"><?= $value->gender ?></td>
                    <td class="text-center"><a style="text-decoration: none;" href="tel:<?php echo $value->primary_contact ?>"><?= $value->primary_contact ?></a></td>
                    <td class="text-center"><?= $value->email ?></td>
                    <td class="text-center">
                      <form method="post" action="<?=base_url()?>Residence/resend_household_sms">
                        <input type="hidden" name="number" value="<?= $value->primary_contact ?>">
                        <input type="hidden" name="rescode" value="<?= $value->res_prop_code ?>">
                        <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span></button>
                      </form>
                    </td>
                    <td>                        
                        <a class="btn btn-info" onclick="confirm_modall('<?php echo $value->primary_contact ?>')">Message</a>        
                    </td>
                  </tr>

                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->

<!-- Modal Form -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicForm" action="<?=base_url("Residence/send_household_message")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      Message Form
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                          &times;
                      </span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="control-label text-sm-right pt-2"><strong>Phone Number:</strong></label>
                        <input type="text" class="form-control" id="primary_contact" name="primary_contact" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label text-sm-right pt-2"><strong>Message Type:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="message_type" name="message_type" class="form-control" autocomplete="off" required>
                            <option value="SMS">SMS</option>
                            <option value="EMAIL">E-MAIL</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="control-label text-sm-right pt-2" id="reason_text"><strong>Message:</strong></label>
                        <textarea class="form-control" name="message" id="message" rows="3" required=""></textarea>
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
