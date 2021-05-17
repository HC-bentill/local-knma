
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
            <thead>
              <tr>
                <th>TOWN</th>
                <th>EMPLOYED</th>
                <th>UNEMPLOYED</th>
                <th>SELF-EMPLOYED</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($town as $row){ ?>
              <tr>
                <td><?= $row->town; ?></td>
                <td><a href="<?=base_url()?>Report/employment_town_data/Employed/<?=$row->id?>" style="text-decoration: none;"><?= employment_town("Employed",$row->id); ?></a></td>
                <td><a href="<?=base_url()?>Report/employment_town_data/Unemployed/<?=$row->id?>" style="text-decoration: none;"><?= employment_town("Unemployed",$row->id); ?></a></td>
                <td><a href="<?=base_url()?>Report/employment_town_data/Self-Employed/<?=$row->id?>" style="text-decoration: none;"><?= employment_town("Self-Employed",$row->id); ?></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  