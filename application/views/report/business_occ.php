
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
             <thead>
                <tr>
                  <th>BUSINESS CODE</th>
                  <th>BUSINESS NAME</th>
                  <th>BUSINESS PRIMARY CONTACT</th>
                  <th>E-MAIL</th>
                  <th>OWNER</th>
                  <th>Primary CONTACT</th>
                </tr>
              </thead>     
              <tbody>
                <?php foreach($result as $value):?>
                  <?php $owner = business_occ_owner_details($value->id); ?>
                  <tr>
                    <td>
                      <a style="text-decoration: none;" href='<?= base_url().'Business/edit_business_occupant_form/'.$value->id?>'><?= $value->buis_occ_code ?></a>
                    </td>
                    <td><?= $value->buis_name ?></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $value->buis_primary_phone ?>"><?= $value->buis_primary_phone ?></a></td>
                    <td><a style="text-decoration: none;" href="mailto:<?php echo $value->buis_email ?>"><?= $value->buis_email ?></a></td>
                    <td><?= $owner['firstname'].' '.$owner['lastname'] ?></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a></td>
                  </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      


 