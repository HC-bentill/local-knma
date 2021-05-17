<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body onetime_transactions">
            <div class="toolbar">
                <a href="<?=base_url()?>onetime_invoice/create" class="tool-icon" title="Create onetime invoice" data-toggle="tooltip">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th class="text-center">INVOICE ID</th>
                  <th class="text-center">OWNERSHIP TYPE</th>
                  <th class="text-center">TYPE OF INVOICE</th>
                  <th class="text-center">FIRST NAME</th>
                  <th class="text-center">LAST NAME</th>
                  <th class="text-center">COMPANY NAME</th>
                  <th class="text-center">HOUSE NO</th>
                  <th class="text-center">AREA COUNCIL</th>
                  <th class="text-center">TOWN</th>
                  <th class="text-center">INVOICE AMOUNT</th>
                  <th class="text-center">AMOUNT PAID</th>
                  <th class="text-center">OUTSTANDING AMOUNT</th>
                  <th class="text-center">CREATED ON</th>
                </tr>
               </thead>
              <tbody>
                <?php foreach($onetime_transactions as $ott):?>
                  <tr>
                    <td class="text-center"><a href="<?=base_url()?>onetime_invoice/view/<?= $ott->invoice_id ?>"><?= $ott->invoice_id ?></a></td>
                    <td class="text-center"><?= $ott->ownership_type ?></td>
                    <td class="text-center"><?= $ott->revenue_product_name ?></td>
                    <td class="text-center"><?= $ott->firstname ?></td>
                    <td class="text-center"><?= $ott->lastname ?></td>
                    <td class="text-center"><?= $ott->company_name ?></td>
                    <td class="text-center"><?= $ott->house_number ?></td>
                    <td class="text-center"><?= $ott->area_council ?></td>
                    <td class="text-center"><?= $ott->town ?></td>
                    <td class="text-center"><?= 'GHS '.number_format((float)$ott->amount, 2, '.', ','); ?></td>
                    <td class="text-center"><a href="<?=base_url()?>onetime_invoice_transaction/<?= $ott->invoice_id ?>"><?= 'GHS '.number_format((float)$ott->amount_paid, 2, '.', ','); ?></a></td>
                    <td class="text-center"><?= 'GHS '.number_format((float)($ott->amount - $ott->amount_paid), 2, '.', ','); ?></td>
                    <td class="text-center"><?= $ott->timestamp ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
