<!-- start: page -->

<div class="row" style="margin:0em;">
  <div class="col-md-4">
    <section class="card card-featured-left card-featured-primary mb-3">
      <div class="card-body">
        <div class="widget-summary">
          <div class="widget-summary-col widget-summary-col-icon">
            <div class="summary-icon bg-primary">
              <i class="fa fa-money"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Total Transactions</h4>
              <div class="info">
                <strong class="amount"><?php echo number_format((float) $transaction_amount['total_amount'], 2, '.', ',') ." (".$transaction_amount['total_count'].")"?></strong>
                <!-- <span class="text-primary">(14 unread)</span> -->
              </div>
            </div>
            <!-- <div class="summary-footer">
              <a class="text-muted text-uppercase" href="#">(view all)</a>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="card card-featured-left card-featured-success mb-3">
      <div class="card-body">
        <div class="widget-summary">
          <div class="widget-summary-col widget-summary-col-icon">
            <div class="summary-icon bg-success">
              <i class="fa fa-money"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Successful Transactions</h4>
              <div class="info">
                <strong class="amount"><?php echo number_format((float) $transaction_amount['success_amount'], 2, '.', ',') ." (".$transaction_amount['success_count'].")"?></strong>
                <!-- <span class="text-primary">(14 unread)</span> -->
              </div>
            </div>
            <!-- <div class="summary-footer">
              <a class="text-muted text-uppercase" href="#">(view all)</a>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="card card-featured-left card-featured-danger mb-3">
      <div class="card-body">
        <div class="widget-summary">
          <div class="widget-summary-col widget-summary-col-icon">
            <div class="summary-icon bg-danger">
              <i class="fa fa-money"></i>
            </div>
          </div>
          <div class="widget-summary-col">
            <div class="summary">
              <h4 class="title">Failed/Pending Transactions</h4>
              <div class="info">
                <strong class="amount"><?php echo number_format((float) $transaction_amount['failed_amount'], 2, '.', ',') ." (".$transaction_amount['failed_count'].")"?></strong>
                <!-- <span class="text-primary">(14 unread)</span> -->
              </div>
            </div>
            <!-- <div class="summary-footer">
              <a class="text-muted text-uppercase" href="#">(view all)</a>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
</div> 
<div class="row" style="padding-top:0em">
  <div class="col-md-12">
    <section class="card card-featured-bottom card-featured-primary">
      <?= $this->session->flashdata('message');?>
      <div class="card-body">
        <form method="POST" action="<?= base_url('Invoice/search_transaction')?>" autocomplete="off">
          <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
            <div class="col-lg-12">
              <div class="form-group m-form__group row">
                <div class="col-lg-3" style="display:none;">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_by" name="search_by">
                      <option <?=$search_by =='Criteria'?'selected == selected':''; ?> value="Criteria">Search By Criteria</option>
                  </select>
                </div>
                <div class="col-lg-3 criteria" id="#">
                  <input type="date" class=" form-control" id="start_date" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                </div>
                <div class="col-lg-3 criteria" id="#">
                  <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
                </div>
                <div class="col-lg-3 criteria" id="payment_mode">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="payment_mode" name="payment_mode">
                      <option value="">Select Payment Mode</option>
                      <option <?=$payment_mode =='Cash'?'selected == selected':''; ?> value="Cash">Cash</option>
                      <option <?=$payment_mode =='Mobile Money'?'selected == selected':''; ?> value="Mobile Money">Mobile Money</option>
                      <option <?=$payment_mode =='Cheque'?'selected == selected':''; ?> value="Cheque">Cheque</option>
                  </select>
                </div>
                <div class="col-lg-3" id="search_box" style="display:none;">
                  <input type="text" class="form-control" id="search_item" placeholder="Search by invoice id or transaction id" name="keyword" value="<?=$keyword?>">
                </div>
                <div class="col-lg-3 criteria" id="#">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="transaction_type" name="transaction_type">
                      <option value="">All Transaction Types</option>
                      <option <?=$transaction_type == "payment"?'selected == selected':''; ?> value="payment">Payment</option>
                      <option <?=$transaction_type == "reversal" ?'selected == selected':''; ?> value="reversal">Reversal</option>
                  </select>
                </div>
              </div>
              <div class="form-group m-form__group row">
                <div class="col-lg-3 criteria" id="#">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category" name="category">
                      <option value="">Select Collector Category</option>
                      <option <?=$category =='agent'?'selected == selected':''; ?> value="agent">Agent</option>
                      <option <?=$category =='admin'?'selected == selected':''; ?> value="admin">Admin</option>
                  </select>
                </div>
                <div class="col-lg-3" id="agent" style="display:none;">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="agentid" name="agent">
                      <option value="">Select Agent</option>
                      <?php foreach($agent as $agent): ?>
                      <option <?=$agentid == $agent->id?'selected == selected':''; ?> value="<?=$agent->id?>"><?= $agent->firstname.' '.$agent->lastname.' ('.$agent->agent_code.')'?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-3" id="admin" style="display:none;">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="adminid" name="admin">
                      <option value="">Select Admin</option>
                      <?php foreach($user as $user): ?>
                      <option <?=$admin == $user->id?'selected == selected':''; ?> value="<?=$user->id?>"><?= $user->firstname.' '.$user->lastname.' ('.$user->username.')'?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-3 criteria" id="#">
                  <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="status" name="status">
                      <option value="">Select Status</option>
                      <option <?=$status == "1"?'selected == selected':''; ?> value="1">Successful</option>
                      <option <?=$status == "0" ?'selected == selected':''; ?> value="0">Failed</option>
                  </select>
                </div>
                <div class="col-lg-3">
                  <button type="submit" id="save" class="btn btn-success">
                    Search
                  </button>
                  <a href="<?=base_url()?>transaction" class="btn btn-danger">
                    Reset
                  </a>
                </div>
              </div>
            </div>
          </div>
        </form>
        <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-transactions">
          <thead>
            <tr>
              <th class="text-center">INVOICE ID</th>
              <th class="text-center">TRANSACTION ID</th>
              <th class="text-center">GCR NO</th>
              <th class="text-center">TRANSACTION TYPE</th>
              <th class="text-center">PAYMENT MODE</th>
              <th class="text-center">AMOUNT</th>
              <th class="text-center">STATUS</th>
              <th class="text-center">IDENTIFIER</th>
              <th class="text-center">PAYER NAME</th>
              <th class="text-center">PAYER PHONE</th>
              <th class="text-center">CHANNEL</th>
              <th class="text-center">COLLECTER</th>
              <th class="text-center">DATE/TIME</th>
              <th class="text-center">RECEIPT</th>
              <th class="text-center">PHOTO</th>
              <th class="text-center">REVERSAL</th>
            </tr>
          </thead>
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
        <form id="basicForm" action="<?=base_url("Invoice/process_reversal")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    <b>Reversal Form</b>
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
                      <label class="control-label text-sm-right pt-2"><strong>Transaction ID:</strong></label>
                      <input type="number" class="form-control" id="transaction_id" name="transaction_id" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                      <input type="text" class="form-control" id="invoiceno" name="invoiceno" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Transaction Amount:</strong></label>
                      <input type="number" class="form-control" id="transaction_amount" name="transaction_amount" readonly>
                    </div>
                    
                </div>
                <div class="form-group row" style="display:none">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="id" name="id">
                      <input type="text" class="form-control" id="fromio" name="fromio">                      
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2" id="reason_text"><strong>Reversal Reason:</strong></label>
                      <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
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
