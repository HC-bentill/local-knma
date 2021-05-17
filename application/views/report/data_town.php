

  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
            <thead>
              <tr>
                <th>TOWN</th>
                <th>RESIDENCE</th>
                <th>HOUSEHOLD</th>
                <th>BUSINESS PROPERTY</th>
                <th>BUSINESS OCCUPANTS</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($town as $row){ ?>
              <tr>
                <td><?= $row->town; ?></td>
                <td><a href="<?=base_url()?>Report/data_town_data/Residence/<?=$row->id?>" style="text-decoration: none;"><?= data_town("Residence",$row->id); ?></a></td>
                <td><a href="<?=base_url()?>Report/data_town_data/Household/<?=$row->id?>" style="text-decoration: none;"><?= data_town("Household",$row->id); ?></a></td>
                <td><a href="<?=base_url()?>Report/data_town_data/Business Property/<?=$row->id?>" style="text-decoration: none;"><?= data_town("Business Property",$row->id); ?></a></td>
                <td><a href="<?=base_url()?>Report/data_town_data/Business Occupants/<?=$row->id?>" style="text-decoration: none;"><?= data_town("Business Occupants",$row->id); ?></a></td>
              </tr>
            <?php } ?>
            </tbody>  
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  


 
  