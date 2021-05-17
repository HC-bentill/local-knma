  
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
            <thead>
              <tr>
                <th>TOWN</th>
                <th>NO</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($town as $row){ ?>
              <tr>
                <td><?= $row->town; ?></td>
                <td><a href="<?=base_url()?>Report/edu_town_data/<?=$row->id?>/<?=$edu_id?>" style="text-decoration: none;"><?=educational_town($row->id,$edu_id); ?></a></td>
              </tr>
            <?php } ?>
            </tbody> 
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  