    

  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th>RESIDENCE CODE</th>
                  <th>HOUSE NO</th>
                  <th>TOWN</th>
                  <th>AREA COUNCIL</th>
                  <th>OWNER</th>
                  <th>PRIMARY CONTACT</th>
                  <th>SECONDARY CONTACT</th>
                </tr>
              </thead>     
              <tbody>
                <?php foreach($result as $value):?>
                <?php $owner = owner_details($value->id); ?>
                  <tr>
                    <td>
                        <a style="text-decoration: none;" href='<?= base_url().'Residence/edit_residence_form/'.$value->id.'/'.$value->res_code?>'><?= $value->res_code ?></a>    
                    </td>
                    <td><?= $value->houseno ?></td>
                    <td><?= $value->tt ?></td>
                    <td><?= $value->area ?></td>
                    <td><?= $owner['firstname'].' '.$owner['lastname']?></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $owner['primary_contact'] ?>"><?= $owner['primary_contact'] ?></a></td>
                    <td><a style="text-decoration: none;" href="tel:<?php echo $owner['secondary_contact'] ?>"><?= $owner['secondary_contact'] ?></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody> 
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  


 