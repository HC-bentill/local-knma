
<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
              <div class="tabs">
                  <ul class="nav nav-tabs">
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>accessed_property"><i class="fa fa-btc"></i>Invoices</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>accessed_business_occupant"><i class="fa fa-usd"></i>Payment</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?=base_url()?>accessed_residence"><i class="fa fa-university"></i>Transactions</a>
                      </li>
                  </ul>
                  <div class="tab-content">
                    <section class="card">
          						<div class="card-body">

          							<div class="text-right mr-4">
          								<a href="<?=base_url()?>print_invoice2/<?=$result->id ?>" target="_blank" class="btn btn-primary ml-3"><i class="fa fa-print"></i> Print</a>
          							</div>
          						</div>
          					</section>
                  </div>
              </div>
            </div>
        </section>
    </div>
</div>
