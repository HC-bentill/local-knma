
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <div class="col-md-12">
              <div id="container7" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
              <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                    <thead>
                      <tr>
                        <th>TOWN</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($town as $row){ ?>
                      <tr>
                        <td><a href="<?=base_url()?>Report/get_com_towns/<?=$row->id?>" style="text-decoration: none;"><?= $row->town; ?></a></td>
                      </tr>
                    <?php } ?>
                    </tbody>                     
              </table>
            </div>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  


 
  
  