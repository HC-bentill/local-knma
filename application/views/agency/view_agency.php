<style>
  .ccdet {
    font-weight: bold;
  }
  
  .ccdetinfo {
    
  }
</style>
<!-- Page -->
  <div class="page animsition" id = "something">
       
    <div class="page-content container-fluid">
          
      	<div class="panel" style="min-height: 70px;" >
          		<div class="col-sm-6" >
          			<a href="<?=base_url()?>agency">
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-reply" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Back</span>
          			   </button>
                </a>
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-print" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Print</span>
          			</button>
				      </div>
              <div style="display: none" class="col-sm-4 margin-bottom-10">
                  <a class="btn btn-block btn-success" id="exampleTopRight" data-plugin="toastr"
                  data-message="Agency status was updated"
                  data-container-id="toast-top-right" data-position-class="toast-top-right"
                  href="javascript:void(0)" role="button"></a>
              </div>      			
	  	</div>    
      <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
            <div class="panel-body container-fluid" id="loaddata">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      
                    </div>
                    <div align="center" class="col-md-4" style="margin: 0 auto;">
                      <img src="<?php echo base_url().$agency['logo']?>" class="img-responsive img-circle" style="width:10em;height:10em;margin-bottom: 0.2em;">
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                    <div align="center" class="col-md-4 col-xs-4">
                      <h4 class="ccdet"><?php echo $agency['agencyname'].' ('.$agency['agencycode'].')' ?></h4>
                    </div>
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        <div class="col-md-4 col-xs-6">
                          <h5 class="ccdet">Location</h5>
                          <h5><?php echo $agency['location']; ?></h5>
                        </div>
                        <div class="col-md-4 col-xs-6">
                          <h5 class="ccdet">Contact</h5>
                          <h5><?php echo $agency['contact']; ?></h5>
                        </div>
                        <div class="col-md-4 col-xs-6">
                          <h5 class="ccdet">E-mail</h5>
                          <h5><?php echo $agency['email']; ?></h5>
                        </div> 
                        
                      </div>
                      
                      <div class="row">
                		    &nbsp;
                	    </div>
                        
                    <div class="row">
                            <div class="col-md-4 col-xs-6">
                              <h5 class="ccdet">Agency Type</h5>
                              <h5><?php echo $agency['agency_typename']; ?></h5>
                            </div>
                            <div class="col-md-4 col-xs-6">
                              <h5 class="ccdet">Website url</h5>
                              <h5><?php echo $agency['weburl']; ?></h5>
                            </div>
                      
                            <div class="col-md-4 col-xs-6">
                              <h5 class="ccdet">Description</h5>
                              <h5><?php echo $agency['description']; ?></h5>
                            </div>        
                    </div>

                     <div class="row no-print">
                            <div class="col-md-4 col-xs-6">
                              <h5 class="ccdet">Account Status</h5>  
                              <?php if($agency['active'] == "1"){  ?>
                                    <label style='margin-top: 0.5em' class="switch"><input id = "<?=$agency['agencyid']?>" type="checkbox" checked onChange="checkAddress(this.id);"><span class="slider round"></span></label>       
                              <?php }else{ ?>
                                    <label style='margin-top: 0.5em' class="switch"><input id = "<?=$agency['agencyid']?>" type="checkbox" onChange="checkAddress(this.id);"><span class="slider round"></span></label>
                              <?php } ?>
                            </div>
                    </div>
                        
                  </div>
                </div>

            </div>
	       </div>
	      </div>
		  </div>
    </div>
  </div>
  </div>

   <script>
            var selected_row_id;
            var selected_agent_id;
            var deleteid;
            
            function initiate_delete(x){
              deleteid = x;
              document.getElementById("dpop").click();
            }
            
            function draw_table(){
              
              $('#something').load('<?=base_url()?>Member/redraw');

            }
            
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
                var url1 = baseurl + "Agency/update_agency_status/" + checkbox  + "/" + state ;
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

            