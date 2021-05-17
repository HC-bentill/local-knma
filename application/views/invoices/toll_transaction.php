<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('Invoice/search_toll_transaction')?>" autocomplete="off">
            <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
              <div class="col-lg-12">
                <div class="form-group m-form__group row">
                  <div class="col-lg-3">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_by" name="search_by">
                        <option <?=$search_by =='Criteria'?'selected == selected':''; ?> value="Criteria">Search By Criteria</option>
                        <option <?=$search_by =='Keyword'?'selected == selected':''; ?> value="Keyword">Search By Invoice ID Or Transaction ID</option>
                    </select>
                  </div>
                  <div class="col-lg-3 criteria" id="#">
                    <input type="date" class=" form-control" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                  </div>
                  <div class="col-lg-3 criteria" id="#">
                    <input type="date" class="form-control" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
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
                  </div>
                </div>
              </div>
            </div>
          </form>
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th class="text-center">TRANSACTION ID</th>
                  <th class="text-center">AMOUNT</th>
                  <th class="text-center">CATEGORY</th>
                  <th class="text-center">TOLL TYPE</th>
                  <th class="text-center">CHANNEL</th>
                  <th class="text-center">COLLECTER</th>
                  <th class="text-center">DATE/TIME</th>
                </tr>
               </thead>
              <tbody>
                <?php foreach($transaction as $value):?>
                
                  <tr>
                    <td><?= $value->transaction_id ?></td>
                    <td class="text-center"><?= number_format((float)$value->amount , 2, '.', ',');?></td>
                    <td><?= $value->cat ?></td>  
                    <td><?=$value->toll?></td>
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
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
