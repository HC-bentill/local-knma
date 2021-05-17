
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
            <thead>
              <tr>
                <th>AREA COUNCIL</th>
                <th>NO</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach (area_council() as $row){ ?>
              <tr>
                <td><a href="<?=base_url()?>Report/profession_town/<?=$row->id?>/<?=$prof_id?>" style="text-decoration: none;"><?= $row->name; ?></a></td>
                <td><a href="<?=base_url()?>Report/profession_area_council_data/<?=$row->id?>/<?=$prof_id?>" style="text-decoration: none;"><?=profession_area_council($row->id,$prof_id); ?></a></td>
              </tr>
            <?php } ?>
            </tbody> 
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  