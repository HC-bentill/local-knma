
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <div class="col-md-12">
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">  
              <thead>
                <tr>
                  <th><b>Channel</b></th>
                  <th><b>Status</b></th>
                </tr>
              </thead>      
              <?php foreach($result as $row): ?>
                <tr>
                  <td><?=$row->channelname ?></td>
                  <?php if($row->active == "1"){  ?>
                
                     <td><label class="switch"><input id = "<?=$row->channelid;?>" type="checkbox" checked onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                      
                  <?php }else{ ?>
                      
                     <td><label class="switch"><input id = "<?=$row->channelid;?>" type="checkbox" onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                      
                  <?php } ?>
                </tr>
              <?php endforeach;?>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->                      
  


 

  


 
  