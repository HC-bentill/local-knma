<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=base_url()?>view_invoice/<?=$this->uri->segment(2)?>"><i
                                    class="fa fa-btc"></i>Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>invoice_payment/<?=$this->uri->segment(2)?>"><i
                                    class="fa fa-usd"></i>Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>invoice_transaction/<?=$this->uri->segment(2)?>"><i
                                    class="fa fa-money"></i>Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>invoice_adjustment/<?=$this->uri->segment(2)?>"><i
                                    class="fa fa-adjust"></i>Adjustment</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <section class="card">
                            <div class="card-body">
                                <div class="invoice">
                                    <header class="clearfix">
                                        <div class="row">
                                            <div class="col-sm-6 mt-3">
                                                <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
                                                <h6 class="h4 m-0 text-dark font-weight-bold" style="font-size:90%;">
                                                    #<?=$result->invoice_no ?></h6>
                                            </div>
                                            <div class="col-sm-6 text-right mt-3 mb-3">
                                                <address class="ib mr-2">
                                                    <?php echo SYSTEM_NAME; ?>
                                                    <br />
                                                    <?php echo SYSTEM_POST_BOX; ?>
                                                    <br />
                                                    <?php echo SYSTEM_ADDRESS; ?>
                                                    <br />
                                                    <?php echo SYSTEM_PHONE; ?>
                                                    <br />
                                                    <?php echo SYSTEM_MAIL; ?>
                                                </address>
                                                <div class="ib">
                                                    <img src="<?=base_url().SYSTEM_LOGO?>" alt="Ga-north logo"
                                                        style="width:9em;height:9em;" />
                                                </div>
                                            </div>
                                        </div>
                                    </header>
                                    <div class="bill-info">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bill-to">
                                                    <p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
                                                    <address>
                                                        <?php echo $result->customer_name;?>
                                                        <br />
                                                        <?php echo $result->property_code;?>
                                                        <br />
                                                        <?php echo ($result->busocc_property_code)? $result->busocc_property_code. '<br/>':""; ?>
                                                        <?php echo ($result->town)? $result->town. '<br/>':""; ?>
                                                        <?php echo ($result->streetname)? "<b>Streetname:</b> ".$result->streetname. '<br/>':""; ?>
                                                        <?php echo ($result->landmark)? "<b>Landmark:</b> ".$result->landmark. '<br/>':""; ?>
                                                        <?php echo ($result->sectorial_code)? "<b>Street Code:</b> ".$result->sectorial_code. '<br/>':""; ?>
                                                    </address>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bill-data text-right">
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Invoice Date:</b></span>
                                                        <span
                                                            class="value"><?=date("Y-m-d",strtotime($result->date_created))?></span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Due Date:</b></span>
                                                        <span
                                                            class="value"><?= date("Y-m-d",$result->payment_due_date ) ?></span>
                                                    </p>
                                                    <br>
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Office Contact:</b></span>
                                                        <span class="value">0551511511/0503038555</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Bank Name:</b></span>
                                                        <span class="value">GCB BANK</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Account No:</b></span>
                                                        <span class="value">5031130001417</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="text-dark"><b>Bank Branch:</b></span>
                                                        <span class="value">Dzodze</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped mb-0 invoice-items" style="white-space:normal;">
                                        <thead>
                                            <tr class="text-dark">
                                                <th id="cell-id" class="font-weight-semibold">Bill Type</th>
                                                <?php if($result->category1_id == 33 && $result->product_id == 12){ ?>
                                                <th id="cell-id" class="font-weight-semibold">Main Category</th>
                                                <th id="cell-item" class="font-weight-semibold">Structure Type</th>
                                                <th id="cell-desc" class="font-weight-semibold">Size</th>
                                                <?php }elseif($result->product_id == 12 || $result->product_id == 13){ ?>
                                                <th id="cell-item" class="font-weight-semibold">Property Type</th>
                                                <th id="cell-desc" class="font-weight-semibold">Building Type</th>
                                                <th id="cell-price" class="text-center font-weight-semibold">
                                                    Construction Material</th>
                                                <th id="cell-total" class="text-center font-weight-semibold">Floor/Size
                                                </th>
                                                <?php }else{ ?>
                                                <th id="cell-id" class="font-weight-semibold">Main Category</th>
                                                <th id="cell-item" class="font-weight-semibold">Service Type</th>
                                                <th id="cell-desc" class="font-weight-semibold">Business Type</th>
                                                <th id="cell-price" class="text-center font-weight-semibold">Category
                                                </th>
                                                <?php } ?>
                                                <th id="cell-total" class="text-center font-weight-semibold">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php if($result->category1_id == 33 && $result->product_id == 12){ ?>
                                                    <?="TEMPORARY STRUCTURE PERMIT RENEWAL"?>
                                                    <?php }else{ ?>
                                                    <?=$result->name ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?=$result->category1 ?></td>
                                                <td class="font-weight-semibold text-dark"><?=$result->category2 ?></td>
                                                <td><?=$result->category3 ?></td>
                                                <?php if($result->category1_id == 33 && $result->product_id == 12){ ?>

                                                <?php }else{ ?>
                                                <td class="text-center"><?=$result->category4 ?></td>
                                                <?php } ?>
                                                <td class="text-center">
                                                    <?= 'GHS '.number_format((float)$result->invoice_amount + $result->adjustment_amount, 2, '.', ',');?>
                                                    <?php if($result->target != 3){ ?>
                                                    <?php if($result->accessed == 1){ ?>
                                                    <span class="badge badge-success">Assessed</span>
                                                    <?php }else{?>
                                                    <span class="badge badge-danger">Unassessed</span>
                                                    <?php }?>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="invoice-summary">
                                        <div class="row justify-content-end">
                                            <div class="col-sm-6">
                                                <table class="table h6 text-dark">
                                                    <?php
                                  $arrears_paid = get_invoice_arrears($result->property_id,$result->product_id,$result->invoice_year);
                                  $actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
                                  $invoice_amount = $result->invoice_amount;
                                  $penalty_amount = $result->penalty_amount;
                                  $discount_amount = $result->adjustment_amount;
                                  $amount_paid = $result->amount_paid;
                                  $total_amount = $invoice_amount + $penalty_amount + $actual_arrears - $amount_paid;
                              ?>
                                                    <tbody>
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="<?=$this->uri->segment(2)?>">
                                                        <tr>
                                                            <td width="60%" class="text-right">Subtotal</td>
                                                            <td width="40%" class="text-left">
                                                                <?= 'GHS '.number_format((float)$result->invoice_amount + $discount_amount , 2, '.', ',');?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <?php $penalty_amount_text = 'GHS '.number_format((float)$penalty_amount, 2, '.', ','); ?>
                                                            <td width="60%" class="text-right">Penalty</td>
                                                            <td width="40%" class="text-left"><?=$penalty_amount_text?>
                                                            </td>
                                                            <input type="hidden" id="penalty_amount_text"
                                                                value="<?=$penalty_amount_text?>" />
                                                        </tr>
                                                        <tr>
                                                            <?php $arrears_amount_text = 'GHS '.number_format((float)$actual_arrears , 2, '.', ','); ?>
                                                            <td width="60%" class="text-right">Arrears</td>
                                                            <td width="40%" class="text-left"><?=$arrears_amount_text?>
                                                            </td>
                                                            <input type="hidden" id="arrears_amount_text"
                                                                value="<?=$arrears_amount_text?>" />
                                                        </tr>
                                                        <tr>
                                                            <?php $discount_amount_text = 'GHS '.number_format((float)$discount_amount, 2, '.', ','); ?>
                                                            <td width="60%" class="text-right">Discount</td>
                                                            <td width="40%" class="text-left"><?=$discount_amount_text?>
                                                            </td>
                                                            <input type="hidden" id="discount_amount_text"
                                                                value="<?=$discount_amount_text?>" />
                                                        </tr>
                                                        <tr>
                                                            <?php $amount_paid_text = 'GHS '.number_format((float)$amount_paid, 2, '.', ','); ?>
                                                            <td width="60%" class="text-right">Payment</td>
                                                            <td width="40%" class="text-left"><?=$amount_paid_text?>
                                                            </td>
                                                            <input type="hidden" id="penalty_amount_text"
                                                                value="<?=$amount_paid_text?>" />
                                                        </tr>
                                                        <tr>
                                                            <?php $total_amount_text = 'GHS '.number_format((float)$total_amount , 2, '.', ','); ?>
                                                            <td width="60%" class="text-right">Total</td>
                                                            <td width="40%" class="text-left">
                                                                <b><?=$total_amount_text?></b></td>
                                                            <input type="hidden" id="total_amount_text"
                                                                value="<?=$total_amount_text?>" />
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
                                                            <td class="text-right"
                                                                bal="<?=number_format((float)$total_amount, 2, '.', '') ?>">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-6 pt-3">
                                                        <input 
                                                            type="hidden"
                                                            spellcheck="false"
                                                            id="qrtext"
                                                            value="
                                                                Invoice# : <?=$result->invoice_no ?>
                                                                Property# :  <?=$result->property_code ?>
                                                                Business# : <?= $result->busocc_property_code ?>
                                                                Phone# : <?=$result->owner_phoneno ?>
                                                            "
                                                        />
                                                    <div id="qrcode"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="text-right">
                                                            <img src="<?=base_url().MFO_SIGNATURE?>" alt="Signature"
                                                                style="width:12em;height:8em;margin-right:0.5em" />
                                                            <img src="<?=base_url().MCD_SIGNATURE?>" alt="Signature"
                                                                style="width:12em;height:8em;" />
                                                        </div>
                                                        <div class="text-right">
                                                            <img src="<?=base_url().MCD_STAMP?>" alt="Signature"
                                                                style="width:12em;height:8em;margin-right:0.5em" />
                                                            <img src="<?=base_url().MFO_STAMP?>" alt="Signature"
                                                                style="width:12em;height:8em;" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mr-4">
                                    <button type="button" data-toggle="modal" data-target="#m_modal_1"
                                        class="btn btn-default btn-warning"><i class="fa fa-envelope-open"></i></button>
                                    <!-- <a href="<?=base_url()?>print_invoice2/<?=$result->id ?>/wtemplate" target="_blank" class="btn btn-primary ml-3"><i class="fa fa-print"></i> Save to PDF/Print without template</a>
                    <a href="<?=base_url()?>print_invoice2/<?=$result->id ?>/template" target="_blank" class="btn btn-primary ml-3"><i class="fa fa-print"></i> Save to PDF/Print with template</a> -->
                                    <a href="<?=base_url()?>print_invoice2/<?=$result->id ?>/wtemplate" target="_blank"
                                        class="btn btn-primary ml-2" data-container="body" data-trigger="hover"
                                        data-toggle="popover" data-placement="top"
                                        data-content="Save to PDF/Print without Template"><i
                                            class="fa fa-print"></i></a>
                                    <a href="<?=base_url()?>print_invoice2/<?=$result->id ?>/template" target="_blank"
                                        class="btn btn-success ml-2" data-container="body" data-trigger="hover"
                                        data-toggle="popover" data-placement="top"
                                        data-content="Save to PDF/Print with Template"><i class="fa fa-print"></i></a>
                                </div>
                                <div id="watermark"><img src="<?=base_url()?>assets/img/Coat_of_arms_of_Ghana.png"
                                        alt="Watermark" /></div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- MESSAGE MODAL -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicFormm" action="<?=base_url("Business/send_invoice_message")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      Invoice
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
                
                <?= $this->session->flashdata('message');?>
              
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="control-label text-sm-right pt-2"><strong>Message Type:</strong></label>
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="message_type" name="message_type" class="form-control" autocomplete="off" required>
                        <option value="">SELECT OPTION</option>
                            <option value="SMS">SMS</option>
                            <option value="EMAIL">E-MAIL</option>
                        </select>
                    </div>
                    <div class="col-sm-6" style="display:none;" id="primary_contact">
                        <label class="control-label text-sm-right pt-2"><strong>Phone Number:</strong></label>
                        <input type="text" value="" class="form-control" id="primary_contact" name="primary_contact"  >
                        <input type="hidden" value="<?=$result->id ?>" name="inv_id">
                    </div>
                </div>

                <div class="form-group row" style="display:none;" id="email">
                    <div class="col-sm-6" >
                        <label class="control-label text-sm-right pt-2"><strong>Email:</strong></label>
                        <input type="text" value="" class="form-control" id="email" name="email" >
                    </div>
                </div>
                
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                  </button>
                  <button type="btn" class="btn btn-success" id='btnn' name="btnn">
                      Submit
                    </button>
              </div>
          </div>
        </form>
    </div>
</div>
<!--end::Modal-->


<style type="text/css">
.nav-tabs li .nav-link,
.nav-tabs li .nav-link:hover {
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

.nav-tabs li.active .nav-link,
.nav-tabs li.active .nav-link:hover,
.nav-tabs li.active .nav-link:focus {
    background: #FFF;
    border-left-color: #EEE;
    border-right-color: #EEE;
    border-top: 3px solid #CCC;
    color: rebeccapurple;
}

#qrcode > img{
    width : 30%;
}

</style>