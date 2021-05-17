
  <!-- Page -->
  <div class="page animsition" id = "something">
       
    <div class="page-content container-fluid">
    
      <div class="row agent_form" style="display: none;">
        <div class="col-md-12">
          
          <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
            <div class="panel-heading">
              <h3 class="panel-title">
                  Client Details    
              </h3>
              
               <div class="page-header-actions">
        
            </div>
            </div>
            
          </div>
          <!-- End Panel Standard Mode -->
        </div>

        
      </div>
      <div style="display: none" class="col-sm-4 margin-bottom-10">
          <a class="btn btn-block btn-success" id="exampleTopRight" data-plugin="toastr"
          data-message="Member Account was updated"
          data-container-id="toast-top-right" data-position-class="toast-top-right"
          href="javascript:void(0)" role="button"></a>
      </div>
      
      
      
      
        <div class="panel" style="min-height: 70px;" >
              <div class="col-sm-6" >
                <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;"   ><i class="icon wb-print" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Print</span>
                </button>
        </div>            
      </div>    
      <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
           <div class="panel-body container-fluid" id="loaddata">
           <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
            
              <thead>
                <tr>
                  <th><b>User Code</b></th>
                  <th><b>Name</b></th>
                  <th><b>E-mail</b></th>
                  <th><b>Contact</b></th>
                  <th><b>Account Activation</b></th>
                </tr>
              </thead>      
              <?php foreach($result as $row): ?>
                <tr>
                  <td><?=$row->user_code ?></td>
                  <td><?= $row->name;?></td>
                  <td><?= $row->email;?></td>
                  <td><?= $row->contact;?></td>
                  <?php if($row->acc_activation == "1"){  ?>
                
                     <td><label class="switch"><input id = "<?=$row->memberid;?>" type="checkbox" checked onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                      
                  <?php }else{ ?>
                      
                     <td><label class="switch"><input id = "<?=$row->memberid;?>" type="checkbox" onChange="checkAddress(this.id);"><span class="slider round"></span></label></td>
                      
                  <?php } ?>
                </tr>
              <?php endforeach;?>
          </table>
        </div>
        
     
     </div>
     </div>
    </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function checkAddress(checkbox){
    
        if (document.getElementById(checkbox).checked){
          var state = "1";
          //update to true
        }else{
          //update to false
          var state = "0";
        }

        var baseurl = "<?php echo base_url(); ?>";       
        var xmlhttp = new XMLHttpRequest();
        var url1 = baseurl + "Member/update_accactivation/" + checkbox  + "/" + state ;
        var url = url1;   
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            myFunction(xmlhttp.responseText);
          }
        }

        xmlhttp.open("GET",url, true);
        xmlhttp.send();
        
        
        function myFunction(response) {
          
          document.getElementById("exampleTopRight").click();
        }
    }
  </script>

