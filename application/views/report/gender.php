
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th>RESIDENCE CODE</th>
                  <th>NAME</th>
                  <th>GENDER</th>
                  <th>PRIMARY CONTACT</th>
                  <th>SECONDARY CONTACT</th>
                  <th>E-MAIL</th>
                </tr>
               </thead>     
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td>
                      <a style="text-decoration: none;" href='<?= base_url().'Residence/edit_household_form/'.$value->id?>'><?=$value->res_prop_code?></a> 
                    </td>
                    <td><?= $value->firstname .' '. $value->lastname ?></td>
                    <td><?= $value->gender ?></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $value->primary_contact ?>"><?= $value->primary_contact ?></a></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $value->secondary_contact ?>"><?= $value->secondary_contact ?></a></td>
                    <td><?= $value->email ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      


 