<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('')?>" autocomplete="off">
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
                  <div class="col-lg-3" id="search_box" style="display:none;">
                    <input type="text" class="form-control" id="search_item" placeholder="Search by business property code" name="keyword" value="<?=$keyword?>">
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
                  <th class="text-center">TELECOM CODE</th>
                  <th class="text-center">VENDOR NAME</th>
                  <th class="text-center">NETWORK NAME</th>
                  <th class="text-center">SITE STATUS</th>
                  <th class="text-center">AREA COUNCIL</th>
                  <th class="text-center">TOWN</th>
                  <th class="text-center">CREATED BY</th>
                  <th class="text-center" colspan="3">ACTION</th>
                  <th class="text-center" style="display: none"></th> 
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td class="text-center">
                      <a style="text-decoration: none;" href='<?= base_url().'Telecom/edit_telecom_form/'.$value->id?>'><?= $value->code ?></a>
                    </td>
                    <td class="text-center"><?= $value->vendor ?></td>
                    <td class="text-center"><?= $value->network ?></td>
                    <td class="text-center"><?= $value->site_status ?></td>
                    <td class="text-center"><?= $value->area_council ?></td>
                    <td class="text-center"><?= $value->town?></td>
                    <td class="text-center"><?= $value->created_by ?></td>
                    <td>
                      <button class="btn btn-primary" data-container="body" data-toggle="modal" data-target="#m_modal_1" onclick=""><span class="fa fa-envelope"></span></button>
                    </td>
                    <td>
                      <button class="btn btn-primary" data-container="body" data-toggle="modal" data-target="#m_modal_3" onclick=""><span class="fa fa-file"></span></button>
                    </td>
                    <td>
                      <button class="btn btn-danger" data-container="body" data-toggle="modal" data-target="#delete_telecom_record" onclick="delete_modal('<?=$value->id?>','<?=$value->code?>')"><span class="fa fa-trash"></span></button>
                    </td>
                    <td style="display: none"></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->

 <!-- DELTE SIGNAGE RECORD -->
<!--begin::Modal-->
<div class="modal fade" id="delete_telecom_record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicFormm" action="<?=base_url('Telecom/delete_telecom_records')?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      <b>Delete Confirmation</b>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                          &times;
                      </span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="col-sm-12" style="font-size:150%">
                    Confirm you want to delete telecom record with code: <span id="code">  </span>
                    <input type="hidden" name="telecom_id" id="telecom_id" value="">
                    <input type="hidden" name="telecom_code" id="telecom_code" value="">
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

<!-- GENERATE BILL -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicFormm" action="<?=base_url("BillGeneration/generate_single_bill")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      Generate Bill
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                          &times;
                      </span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Year:</strong></label>
                      <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="year" required>
                        <option value="">Select Year</option> 
                        <?php $current_year = date("Y");?>
                        <?php for($i=2017; $i<=$current_year; $i++): ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor; ?>     
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Bill Type:</strong></label>
                      <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="product" name="product" required>
                        <option value="">All Bill Types</option> 
                        <?php foreach($products as $p){ ?>
                            <option value="<?= $p->id?>"><?=$p->name?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Generation Type:</strong></label>
                      <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="runtime_type" name="runtime_type" required>
                        <option value="generation">Generate Invoice</option>
                        <option value="update">Update Already Existing Invoice</option>
                      </select>
                      <input type="hidden" class="form-control" id="property_id" name="property_id" readonly>
                      <input type="hidden" class="form-control" id="property_code" name="property_code" readonly>
                    </div>
                </div>
                <div class="form-group row">
                  <?php if(has_permission($this->session->userdata('user_info')['id'],'fixed_amount')){ ?>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Amount Type:</strong></label>
                      <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="amount_type" name="amount_type" class="form-control" autocomplete="off" required>  
                        <option value="fee_fixing">Fee Fixing</option>
                        <option value="fixed_amount">Fixed Amount</option>
                      </select>
                    </div>
                  <?php  } ?>
                  <div class="col-sm-4"  id="amount" style="display: none;">
                    <label class="control-label text-sm-right pt-2"><strong>Amount:</strong></label>
                    <input type="number" value="0" class="form-control" name="amount" autocomplete="off"/>
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

<!-- MESSAGE MODAL -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicFormm" action="<?=base_url("Business/send_message")?>" method="Post">
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

              <div id="tab-alert-container">
                  <div id='tab-alert' class="alert alert-dismissible fade hidden" role='alert'>
                    <strong id='alert-msg-container'>Test</strong>
                    <button type="button" id='close-sms-alert' class='close' aria-label='Close'>
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="control-label text-sm-right pt-2"><strong>Phone Number:</strong></label>
                        <input type="text" value="<?= $value->contact ?>" class="form-control" id="primary_contact" name="primary_contact" readonly>
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
                    <div class="col-sm-6">
                        <label class="control-label text-sm-right pt-2"><strong>Email:</strong></label>
                        <input type="text" value="<?= $value->email ?>" class="form-control" id="email" name="email" readonly>
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
                  <button type="button" class="btn btn-success" id="btnn">
                      Submit
                    </button>
              </div>
          </div>
        </form>
    </div>
</div> 
<!--end::Modal-->


