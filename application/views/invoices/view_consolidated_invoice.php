<div class="row">
  <div class="col">
    <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
      <?= $this->session->flashdata('message');?>
      <div class="card-body">
        <section class="card">
          <div class="card-body">
            <div class="invoice">
              <header class="clearfix">
                <div class="row">
                  <div class="col-sm-6 mt-3">
                    <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
                  </div>
                  <div class="col-sm-6 text-right mt-3 mb-3">
                    <address class="ib mr-2">
                      <?php echo SYSTEM_NAME; ?> 
                      <br/>
                      <?php echo SYSTEM_POST_BOX; ?> 
                      <br/>
                      <?php echo SYSTEM_ADDRESS; ?> 
                      <br/>
                      <?php echo SYSTEM_PHONE; ?> 
                      <br/>
                      <?php echo SYSTEM_GHPOSTGPS; ?> 
                    </address>
                    <div class="ib">
                      <img src="<?=base_url().SYSTEM_LOGO?>" alt="Ga-north logo" style="width:9em;height:9em;"/>
                    </div>
                  </div>
                </div>
              </header>
              <input type="hidden" id="filter_contact" name="filter_contact" value="<?=$this->uri->segment(2)?>">
              <div class="bill-info">
                <div class="row">
                  <div class="col-md-6">
                    <div class="bill-to">
                      <p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
                      <address>
                        <?=$result->contact->owner_name?>
                        <br/>
                        <?=$result->contact->business_code?>
                        <br/>
                        <?=$result->contact->town?><?php echo SYSTEM_TOWN; ?>
                      </address>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bill-data text-right">
                      <p class="mb-0">
                        <span class="text-dark">Invoice Date:</span>
                        <span class="value"></span>
                      </p>
                      <p class="mb-0">
                        <span class="text-dark">Due Date:</span>
                        <span class="value"></span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <table class="table table-responsive-md invoice-items" style="white-space:normal;">
                  <thead>
                    <tr class="text-dark">
                      <th class="font-weight-semibold">Invoice No</th>
                      <th class="font-weight-semibold">Business Code</th>
                      <th id="cell-id" class="font-weight-semibold">Invoice Type</th>
                      <th id="cell-id" class="font-weight-semibold">Main Category</th>
                      <th id="cell-item" class="font-weight-semibold">Service Type</th>
                      <th id="cell-desc" class="font-weight-semibold">Business Type</th>
                      <th id="cell-price" class="text-center font-weight-semibold">Category</th>
                      <th id="cell-total" class="text-center font-weight-semibold">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($result->records as $row) { ?>
                    <tr>
                      <td><?=$row->invoice_no ?></td>
                      <td><?=$row->buis_occ_code ?></td>
                      <td><?=$row->name ?></td>
                      <td><?=$row->category1 ?></td>
                      <td class="font-weight-semibold text-dark"><?=$row->category2 ?></td>
                      <td><?=$row->category3 ?></td>
                      <td class="text-center"><?=$row->category4 ?></td>
                      <td class="text-center">
                        <?= 'GHS '.number_format((float)$row->invoice_amount + $row->adjustment_amount, 2, '.', ',');?>
                        <?php if($row->accessed == 1){ ?>
                          <span class="badge badge-success">Assessed</span>
                        <?php }else{?>
                          <span class="badge badge-danger">Unassessed</span>
                        <?php }?>
                      </td>
                      <td class="hidden">
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              
              <div class="row">
                <div class="col offset-8 col-sm-4">
                  <table class="table h6 text-dark">
                    <tbody>
                      <?php
                        $subtotalAmount = 'GHS '.number_format((float)$result->summary->subtotal + $result->summary->discount , 2, '.', ',');
                        $discountAmount = 'GHS '.number_format((float)$result->summary->discount, 2, '.', ',');
                        $penaltyAmount = 'GHS '.number_format((float)$result->summary->penalty_amount, 2, '.', ',');
                        $arrearsAmount = 'GHS '.number_format((float)$result->summary->actual_arrears , 2, '.', ',');
                        $totalAmount = 'GHS '.number_format((float)$result->summary->subtotal, 2, '.', ',');
                      ?>
                      <tr>
                        <td width="60%" class="text-right">Subtotal</td>
                        <td width="40%" class="text-left"><?=$subtotalAmount?></td>
                      </tr>
                        <tr>
                            <td width="60%" class="text-right">Discount</td>
                            <input type="hidden" id="discount_amount_text" name="discount_amount_text" value="<?=$discountAmount?>"/>
                            <td width="40%" class="text-left"><?=$discountAmount?></td>
                        </tr>
                        <tr>
                          <td width="60%" class="text-right">Penalty</td>
                          <input type="hidden"  id="penalty_amount_text" name="penalty_amount_text" value="<?=$penaltyAmount?>" />
                          <td width="40%" class="text-left"><?=$penaltyAmount?></td>
                        </tr>
                      <tr>
                        <td width="60%" class="text-right">Arrears</td>
                        <input type="hidden" id="arrears_amount_text" name="arrears_amount_text" value="<?=$arrearsAmount?>"/>
                        <td width="40%" class="text-left"><?=$arrearsAmount?></td>
                      </tr>
                      <tr>
                        <td width="60%" class="text-right">Total</td>
                        <input type="hidden" id="total_amount_text" name="total_amount_text" value="<?=$totalAmount?>" />
                        <td width="40%" class="text-left"><?=$totalAmount?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-12">
                    <table class="table wordify h6 text-dark">
                        <tbody>
                            <tr class="b-top-0">
                              <td class="text-right" bal="<?=$totalAmount?>"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                      <img src="<?=base_url().MCE_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em"/>
                      <img src="<?=base_url().MCD_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;"/>
                    </div>
                    <div class="text-right">
                      <img src="<?=base_url().MCE_STAMP?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em"/>
                      <img src="<?=base_url().MCD_STAMP?>" alt="Signature" style="width:12em;height:8em;"/>
                    </div>
                </div>
            </div>
            <div class="text-right mr-4">
              <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-warning">Submit Invoice</button>
              <a href="<?=base_url()?>print_consolidated_invoice/<?=$result->contact->primary_contact?>" target="_blank" class="btn btn-primary ml-3"><i class="fa fa-print"></i> Save to PDF/Print</a>
            </div>
            <div id="watermark"><img src="<?=base_url()?>assets/img/Coat_of_arms_of_Ghana.png" alt="Watermark"/></div>
          </div>
        </section>
      </div>
    </section>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Invoice</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
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

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" id="sms-tab-btn" href="#sms-tab-content" role="tab" aria-controls="sms-tab-content" aria-selected="true">Sms</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" id="email-tab-btn" href="#email-tab-content" role="tab" aria-controls="email-tab-content" aria-selected="false">Email</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">

          <!-- SMS TAB -->
          <div class="tab-pane fade show active" id="sms-tab-content" role="tabpanel" aria-labelledby="sms-tab-btn">

            <form id="sms_form">
              <?php
                $primary_contact = "";
                $secondary_contact = "";
                // die(var_dump($result->contact));
                if (!is_null($result->contact->primary_contact) && !(strcmp(trim($result->contact->primary_contact), "") == 0)) {
                  $primary_contact = $result->contact->primary_contact;
                }
                if (!is_null($result->contact->secondary_contact) && !(strcmp(trim($result->contact->secondary_contact), "") == 0)) {
                  $secondary_contact = $result->contact->secondary_contact;
                }
              ?>
              <div class="form-group row">
                <label for="primary_contact" class="col-form-label col-sm-3">Primary Contact</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="primary_contact" id="primary_contact" value="<?=$primary_contact?>" />
                </div>
              </div>
              <div class="form-group row">
                <label for="secondary_contact"  class="col-form-label col-sm-3">Secondary Contact</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="secondary_contact" id="secondary_contact" value="<?=$secondary_contact?>" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-2 offset-10">
                  <button class="btn btn-md btn-primary" type="button" role="button" id="send-sms" name="send-sms">Send</button>
                </div>  
              </div>

            </form>
          </div>

          <!-- EMAIL TAB -->
          <div class="tab-pane fade" id="email-tab-content" role="tabpanel" aria-labelledby="email-tab-btn">
            <form id="email_form">
              <?php
                $email = "";
                if (!is_null($result->contact->email) && !(strcmp(trim($result->contact->email), "") == 0)) {
                  $email = $result->contact->email;
                }
              ?>
              <div class="form-group row">
                <label for="email" class="col-form-label col-sm-3">Email</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="email" id="email" value="<?=$email?>" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-2 offset-10">
                  <button class="btn btn-md btn-primary" type="button" id="send-email" name="send-email" role="button">Send</button>
                </div>  
              </div>

          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">

  .nav-tabs li .nav-link, .nav-tabs li .nav-link:hover {
    background: #F4F4F4;
    border-bottom: none;
    border-left: 1px solid #EEE;
    border-right: 1px solid #EEE;
    border-top: 3px solid #EEE;
    color: black;
  }

  .nav-link .active {
    color: red;
  }

  .nav-tabs li.active .nav-link, .nav-tabs li.active .nav-link:hover, .nav-tabs li.active .nav-link:focus {
    background: #FFF;
    border-left-color: #EEE;
    border-right-color: #EEE;
    border-top: 3px solid #CCC;
    color: rebeccapurple;
  }
</style>