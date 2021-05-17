<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">

          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-property-owner">
              <thead>
                <tr>
                  <th class="text-center">CATEGORY</th>
                  <th class="text-center">NAME</th>
                  <th class="text-center">PRIMARY CONTACT</th>
                  <th class="text-center">SECONDARY CONTACT</th>
                  <th class="text-center">EMAIL</th>
                </tr>
              </thead>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
