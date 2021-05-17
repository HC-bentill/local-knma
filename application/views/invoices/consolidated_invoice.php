<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-invoices">
              <thead>
                <tr>
                  <th class="text-center">PRIMARY CONTACT</th>
                  <th class="text-center">PROPERTY OWNER</th>
                  <th class="text-center">INVOICE COUNT</th>
                  <th class="text-center">INVOICE AMOUNT</th>
                  <th class="text-center">DISCOUNT</th>
                  <th class="text-center">AMOUNT PAID</th>
                  <th class="text-center">OUTSTANDING AMOUNT</th>
                  <th class="text-center">SECONDARY CONTACT</th>
                </tr>
               </thead>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
