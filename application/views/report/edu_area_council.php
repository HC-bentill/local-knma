
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
                  <td><a href="<?=base_url()?>Report/educational_town/<?=$row->id?>/<?=$edu_id?>" style="text-decoration: none;"><?= $row->name; ?></a></td>
                  <td><a href="<?=base_url()?>Report/educational_area_council_data/<?=$row->id?>/<?=$edu_id?>" style="text-decoration: none;"><?=educational_area_council($row->id,$edu_id); ?></a></td>
                </tr>
              <?php } ?>
              </tbody>  
          </table>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->    

  