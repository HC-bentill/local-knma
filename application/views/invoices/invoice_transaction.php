<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
              <div class="tabs">
                  <ul class="nav nav-tabs">
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>view_invoice/<?=$this->uri->segment(2)?>"><i class="fa fa-btc"></i>Invoices</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>invoice_payment/<?=$this->uri->segment(2)?>"><i class="fa fa-usd"></i>Payment</a>
                      </li>
                      <li class="nav-item active">
                          <a class="nav-link" href="<?=base_url()?>invoice_transaction/<?=$this->uri->segment(2)?>"><i class="fa fa-money"></i>Transactions</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>invoice_adjustment/<?=$this->uri->segment(2)?>"><i class="fa fa-adjust"></i>Adjustment</a>
                      </li>
                  </ul>
                  <div class="tab-content">
                    <section class="card">
          				<div class="card-body">
                            <div class="alert alert-danger mt-4" id="error_notif" style="display:none"></div>
                        <!-- start: page -->
                        <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                            <thead>
                              <tr>
                                <th class="text-center">INVOICE ID</th>
                                <th class="text-center">TRANSACTION ID</th>
                                <th class="text-center">GCR NO</th>
                                <th class="text-center">TRANSACTION TYPE</th>
                                <th class="text-center">PAYMENT MODE</th>
                                <th class="text-center">AMOUNT</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">PAYER NAME</th>
                                <th class="text-center">PAYER PHONE</th>
                                <th class="text-center">CHANNEL</th>
                                <th class="text-center">COLLECTOR</th>
                                <th class="text-center">DATE/TIME</th>
                                <th class="text-center">RECEIPT</th>
                              </tr>
                             </thead>
                            <tbody>
                              <?php foreach($transaction as $value):?>
                                <?php $collected = collected_by_admin($value->created_by);?>
                                <?php 
                                  if ($value->transaction_type == "payment") {
                                    $transaction_type = '<span class="badge badge-success">Payment</span>';
                                  } else if($value->transaction_type == "reversal"){
                                    $transaction_type = '<span class="badge badge-danger">Reversal</span>';
                                  }else{
                                    $transaction_type = '';
                                  }
                                ?>
                                <tr>
                                  <td class="text-center">
                                    <a style="text-decoration: none;" href='#'><?= $value->invoice_no ?></a>
                                  </td>
                                  <td><?= $value->transaction_id ?></td>
                                  <td><?= $value->gcr_no ?></td>
                                  <td><?= $transaction_type ?></td>
                                  <td><?= $value->payment_mode ?></td>
                                  <td class="text-center"><?= number_format((float)$value->amount , 2, '.', ',');?></td>
                                  <td class="text-center">
                                    <?php if($value->status == 1){?>
                                      <span class="badge badge-success">Successful</span>
                                  <?php }else if($value->payment_mode == 'Cheque' && $value->status == 0){ ?>
                                      <select class="form-control" data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="update_cheque_status">
                                        <option value="0">Pending</option>
                                        <option value="1">Successful</option>
                                      </select>
                                  <?php } else {?>
                                      <span class="badge badge-danger">Pending</span>
                                    <?php }?>
                                  </td>
                                  <td><?=$value->payer_name?></td>
                                  <td><a style="text-decoration: none;" href="tel:<?php echo $value->payer_phone ?>"><?= $value->payer_phone ?></a></td>
                                  <td><?=$value->channel?></td>
                                  <td>
                                    <?php if($value->collected_by == "admin"){?>
                                      <?php $admin = collected_by_admin($value->created_by);?>
                                      <?= $admin['firstname'].' '.$admin['lastname']?>
                                    <?php }else if($value->collected_by == "agent"){?>
                                      <?php $agent = collected_by_agent($value->created_by);?>
                                      <?= $agent['firstname'].' '.$agent['lastname'].' ('.$agent['agent_code'].')'?>
                                    <?php }else{}?>
                                  </td>
                                  <td><?= date('Y-m-d H:i:s',strtotime($value->datetime_created))?></td>
                                  <td><a href="<?=base_url()?>invoice_transaction/receipt/<?= $value->transaction_id?>">View Receipt</a></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        <!-- end: page -->
          						</div>
          					</section>
                  </div>
              </div>
            </div>
        </section>
    </div>
</div>
