<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
              <div class="tabs">
                  <ul class="nav nav-tabs">
                      <li class="nav-item active">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice/view/<?=$result->invoice_id ?>"><i class="fa fa-btc"></i>Invoices</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_payment/<?=$result->invoice_id ?>"><i class="fa fa-usd"></i>Payment</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_transaction/<?=$result->invoice_id ?>"><i class="fa fa-money"></i>Transactions</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>onetime_invoice_adjustment/<?=$result->invoice_id ?>"><i class="fa fa-adjust"></i>Adjustment</a>
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
  											<h4 class="h4 m-0 text-dark font-weight-bold">#<?=$result->invoice_id ?></h4>
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
  								<div class="bill-info">
  									<div class="row">
  										<div class="col-md-6">
  											<div class="bill-to">
  												<p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
  												<address>
                                                    <?= $result->firstname . ' ' . $result->lastname. ' ' ?><?= $result->company_name !== Null?'('.$result->company_name.')':""?>
                                                    <br/>
                                                    <?= $result->house_number ?>
                                                    <br/>
                                                    <?= $result->town ?>
  												</address>
  											</div>
  										</div>
  										<div class="col-md-6">
                                            <div class="bill-data text-right">
  												<p class="mb-0">
  													<span class="text-dark">Invoice Date:</span>
  													<span class="value"><?=date("Y-m-d",strtotime($result->timestamp))?></span>
  												</p>
												<p class="mb-0">
  													<span class="text-dark">Due Date:</span>
  													<span class="value"><?= date("Y-m-d",strtotime("+21 days", strtotime($result->timestamp)));?></span>
  												</p>
  											</div>
  										</div>
  									</div>
  								</div>

  								<table class="table table-responsive-md invoice-items" style="white-space:normal;">
  									<thead>
  										<tr class="text-dark">
                                            <th id="cell-id" class="font-weight-semibold">Invoice Type</th>
  											<th id="cell-id"     class="font-weight-semibold">Main Category</th>
  											<th id="cell-item"   class="font-weight-semibold">Service Type</th>
  											<th id="cell-desc"   class="font-weight-semibold">Business Type</th>
  											<th id="cell-price"  class="text-center font-weight-semibold">Category</th>
  											<th id="cell-total"  class="text-center font-weight-semibold">Amount</th>
  										</tr>
  									</thead>
  									<tbody>
  										<tr>
                                            <td><?=$result->revenue_product_name ?></td>
  											<td><?=$result->category1_name ?></td>
  											<td class="font-weight-semibold text-dark"><?=$result->category2_name ?></td>
  											<td><?=$result->category3_name ?></td>
  											<td class="text-center"><?=$result->category4_name ?></td>
                                            <td class="text-center"><?= 'GHS '.number_format((float)$result->amount , 2, '.', ',');?></td>
  										</tr>
  									</tbody>
  								</table>
								    <?php
										$arrears_paid = get_onetime_invoice_arrears($result->firstname,$result->invoice_year);
										$actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
										$invoice_amount = $result->amount;
										$total_amount = $invoice_amount + $actual_arrears;
                                    ?>
  								<div class="invoice-summary">
  									<div class="row justify-content-end">
  										<div class="col-sm-6">
  											<table class="table h6 text-dark">
  												<tbody>
  													<tr>
  														<td width="60%" class="text-right">Subtotal</td>
  														<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->amount , 2, '.', ',');?></td>
  													</tr>
  													<tr>
  														<td width="60%" class="text-right">Arrears</td>
  														<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$actual_arrears , 2, '.', ',');?></td>
  													</tr>
  													<tr>
  														<td width="60%" class="text-right">Total</td>
  														<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$total_amount , 2, '.', ',');?></td>
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
                                                        <td class="text-right" bal="<?=number_format((float)$total_amount, 2, '.', '') ?>"></td>
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
  								</div>
  							</div>

  							<div class="text-right mr-4">
  								<a href="<?=base_url()?>onetime_invoice/print/<?=$result->invoice_id ?>" target="_blank" class="btn btn-primary ml-3"><i class="fa fa-print"></i> Save to PDF/Print</a>
  							</div>
  						</div>
                        <div id="watermark"><img src="<?=base_url()?>assets/img/Coat_of_arms_of_Ghana.png" alt="Watermark"/></div>
  					</section>
                  </div>
              </div>
            </div>
        </section>
    </div>
</div>
