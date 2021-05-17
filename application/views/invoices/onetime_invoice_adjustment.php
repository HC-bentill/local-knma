<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>onetime_invoice/view/<?=$result['invoice_id']?>"><i class="fa fa-btc"></i>Invoices</a>
                        </li>
                        <li class="nav-item">
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
                                <form  autocomplete="off" id="basicform" method="POST" enctype="multipart/form-data" action="<?=base_url()?>Invoice/adjustment" id="submitForm">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                                            <input type="text" class="form-control" value="<?=$result['invoice_id']?>" readonly>
                                            <input type="text" class="form-control hidden" value="1" name="invoice_type">
                                            <input type="text" class="form-control hidden" value="<?=$result['invoice_id']?>" name="invoice_no">
                                            <input type="text" class="form-control hidden" value="<?=$result['id']?>" name="invoice_id">
                                            <input type="text" class="form-control hidden" value="<?=$result['amount'];?>" name="invoice_amount">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                                            <input type="text" class="form-control" value="<?=number_format((float)$result['amount'] , 2, '.', ',');?>" name="invoiceamount" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="control-label text-sm-right pt-2"><strong>Adjustment Amount:</strong></label>
                                            <input type="number" class="form-control" value="" name="adjustment_amount" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="control-label text-sm-right pt-2"><strong>Adjustment Type:</strong></label>
                                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }"  id="adjustment_type" name="adjustment_type" class="form-control" autocomplete="off" required="" >
                                                <option value="">SELECT OPTION</option>
                                                <option value="-">Downward</option>
                                                <option value="+">Upward</option> 
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="photo">
                                            <label class="control-label text-sm-right pt-2"><strong>Document:</strong></label>
                                            <input class="form-control" type="file" name="userfile"/>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="control-label text-sm-right pt-2"><strong>Adjustment Reason:</strong></label>
                                            <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                    <div class="col-sm-4">
                                     
                                    </div>
                                    <div class="col-sm-4">
                                     <input class="btn btn-primary form-control" type="button" id="adj_btn" value="Submit" name="adj-submit"/>
                                    </div>
                                    <div class="col-sm-4">
                                     
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
