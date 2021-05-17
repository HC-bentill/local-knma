  <div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
              <div class="tabs">
                  <ul class="nav nav-tabs">
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice/view/<?=$result['invoice_id']?>"><i class="fa fa-btc"></i>Invoices</a>
                      </li>
                      <li class="nav-item active">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_payment/<?=$result['invoice_id']?>"><i class="fa fa-usd"></i>Payment</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_transaction/<?=$result['invoice_id']?>"><i class="fa fa-money"></i>Transactions</a>
                      </li>
                      <li class="nav-item active">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_adjustment/<?=$result['invoice_id']?>"><i class="fa fa-adjust"></i>Adjustment</a>
                      </li>  
                  </ul>
                  <div class="tab-content">
                    <section class="card">
          				<div class="card-body">
                            <div class="alert alert-danger mt-4" id="error_notif" style="display:none"></div>
                        <form  autocomplete="off" id="basicform" method="POST" enctype="multipart/form-data" action="<?=base_url()?>Invoice/process_payment" id="submitForm">
                          <div class="form-group row">
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                              <input type="text" class="form-control" id="invoice_no" value="<?=$result['invoice_id']?>" name="invoice_no" disabled required>
                              <input type="text" class="form-control hidden" value="<?=$result['id']?>" name="invoice_id">
                              <input type="text" class="form-control hidden" value="<?=$result['invoice_id']?>" name="invoice_number">
                              <input type="text" class="form-control hidden" value="<?=$result['phonenumber']?>" name="phonenumber">
                              <input type="text" class="form-control hidden" value="<?=$result['amount_paid']?>" name="amount_paid_so_far">
                              <input type="text" class="form-control hidden" value="<?=$result['invoice_amount']?>" name="actual_invoice_amount">
                              <input type="text" class="form-control hidden" value="<?=$result['invoice_amount']?>" name="invoice_amount">
                              <input type="text" class="form-control hidden" value="<?=$result['fullname']?>" name="fullname">
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                              <input type="text" class="form-control" value="<?=number_format((float)$result['invoice_amount'] , 2, '.', '');?>" name="invoiceamount" disabled required>
                              <input type="text" class="form-control hidden" id="product" value="<?=$result['revenue_product_name'];?>" name="product" required>
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Outstanding Amount:</strong></label>
                              <?php $amount_left =  $result['invoice_amount'] - $result['amount_paid']?>
                              <input type="text" class="form-control <?php if($amount_left <= 0){echo 'no-outstanding';}else {echo 'outstanding';} ?>" id="invoice_amountt" value="<?=number_format((float)$amount_left , 2, '.', '');?>" name="invoice_amountt" disabled required>
                            </div>
                          </div>
                          <div class="form-group row pay-invoice">
                          <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Payment Mode:</strong></label>
                              <select class="form-control" data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="payment_mode" name="payment_mode" required="">
                                <option value="">SELECT OPTION</option>
                                <option value="Cash">Cash</option>
                                <option value="Mobile Money">MoMo</option>
                                <option value="Mobile Money Number">Mobile Money Number</option>
                                <option value="Cheque">Cheque</option>
                              </select>
                            </div>
                            <div class="col-sm-4 momo" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Mobile Operator:</strong></label>
                              <select class="form-control" data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="mobile_operator" name="mobile_operator" required="">
                                <option value="">SELECT OPTION</option>
                                <option value="MTN">MTN</option>
                                <option value="Vodafone">Vodafone</option>
                                <option value="AirtelTigo">AirtelTigo</option>
                              </select>
                            </div>
                            <div class="col-sm-4 momo" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Mobile Money Number:</strong></label>
                              <input type="text" class="form-control" minlength=10 id="momo_number" name="momo_number" required>
                              <input type="hidden" id="momo_transaction_id" name="momo_transaction_id" >
                            </div>
                            <div class="col-sm-4 momo_number" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Sender Mobile Money Number:</strong></label>
                              <input type="text" class="form-control" minlength=10 id="sender_momo_number" name="sender_momo_number" required>
                            </div>
                            <div class="col-sm-4 momo_number" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Mobile Money Transaction ID</strong></label>
                              <input type="text" class="form-control" minlength=10 id="sender_transaction_id" name="sender_transaction_id" required>
                            </div>
                            <div class="col-sm-4 cheque" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Bank Name:</strong></label>
                              <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                            </div>
                            <div class="col-sm-4 cheque" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Bank Branch:</strong></label>
                              <input type="text" class="form-control" id="bank_branch" name="bank_branch" required>
                            </div>
                            <div class="col-sm-4 cheque" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Name on Cheque:</strong></label>
                              <input type="text" class="form-control" id="cheque_name" name="cheque_name" required>
                            </div>
                            <div class="col-sm-4 cheque" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Cheque Number:</strong></label>
                              <input type="text" class="form-control" id="cheque_no" name="cheque_no" maxlength="6" required>
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>GCR Number:</strong></label>
                              <input type="number" class="form-control" id="gcr_no" name="gcr_no" required>
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Valuation Number:</strong></label>
                              <input type="text" class="form-control" id="valuation_no" name="valuation_no">
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Payment Type:</strong></label>
                              <select class="form-control" data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="payment_type" name="payment_type" required="">
                                <option value="">SELECT OPTION</option>
                                <option value="Full Payment">Full Amount</option>
                                <option value="Part Payment">Part Payment</option>
                              </select>
                            </div>
                            <div class="col-sm-4 pp" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Enter Amount Paid:</strong></label>
                              <input type="number" step=".01" max="<?=$amount_left?>" class="form-control" id="amount_paid" name="amount_paid" required>
                            </div>
                            <div class="col-sm-4">
                              <label class="control-label text-sm-right pt-2"><strong>Paid By:</strong></label>
                              <select class="form-control" data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" id="paid_by" name="paid_by" required="">
                                <option value="">SELECT OPTION</option>
                                <option value="registered">Registered Owner Or Caretaker</option>
                                <option value="others">Others</option>
                              </select>
                            </div>
                            <div class="col-sm-4 paid_by" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Enter Name:</strong></label>
                              <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-sm-4 paid_by" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Enter Phone Number:</strong></label>
                              <input type="text" class="form-control" id="phone_no" name="phone_no" required>
                            </div>
                            <div class="col-sm-4 otp" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Enter OTP:</strong></label>
                              <input type="text" class="form-control" id="otp" name="otp" required>
                            </div>
                            <div class="col-sm-4 cheque" style="display:none;">
                              <label class="control-label text-sm-right pt-2"><strong>Photo:</strong></label>
                              <input class="form-control" type="file" name="userfile"/>
                            </div>
                          </div>
                          <div class="form-group row">
                             <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                             <div class="col-sm-4 pull-right">
                                 <input style="font-size:1.0rem" class="btn btn-primary form-control inv-payment-btn" value="Process Payment" id="btn" type="button">
                             </div>
                           </div>
                        </form>
  						</div>
  					</section>
                  </div>
              </div>
            </div>
        </section>
    </div>
</div>
