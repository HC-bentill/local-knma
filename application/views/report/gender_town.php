
<!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th>TOWN</th>
                  <th>MALE</th>
                  <th>FEMALE</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($town as $row){ ?>
                <tr>
                  <td><?= $row->town; ?></td>
                  <td><a href="<?=base_url()?>Report/gender_town_data/Male/<?=$row->id?>" style="text-decoration: none;"><?= gender_town("Male",$row->id); ?></a></td>
                  <td><a href="<?=base_url()?>Report/gender_town_data/Female/<?=$row->id?>" style="text-decoration: none;"><?= gender_town("Female",$row->id); ?></a></td>
                </tr>
              <?php } ?>
              </tbody> 
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 
  