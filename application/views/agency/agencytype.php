<!-- Page -->
  <div class="page animsition">
    <div class="page-content container-fluid">
            
               <div style="display: none" class="col-sm-4 margin-bottom-10">
					<a class="btn btn-block btn-success" id="exampleTopRight" data-plugin="toastr"
					data-message="Bank file saved sucesfully"
					data-container-id="toast-top-right" data-position-class="toast-top-right"
					href="javascript:void(0)" role="button"></a>
			  </div>
			  <div style="display: none" class="toast-example" id="exampleToastrError" aria-live="polite" data-plugin="toastr"
                  data-message="Please select a bank"
                  data-container-id="toast-top-right" data-position-class="toast-top-right"
                  data-icon-class="btn btn-block btn-danger toast-danger" role="alert">
                    <div class="toast toast-just-text toast-danger">
                      <button type="button" class="toast-close-button" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      
                   </div>
            </div>         
      
      
       
       <!-- search gproject nav bar starts here -->
      		<div id="gp_nav_bar" class="panel" style="min-height: 70px;" >

          		<div class="col-sm-6" >
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target="#myAgent" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-user-add" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Add New</span>
          			</button>					 
					<button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteAgencytype" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span>
					</button>
					
				</div>
	  	</div>
 
      <div class="panel">
        <div class="panel-body">
        	<div id="loadbank">
         
          <table id="tt" class="table table-striped table-hover table-responsive" style="cursor: pointer;">
            <thead>
              <tr>
                <th>Type</th>
                <th style="width:30em;">Description</th>
                <th>Edit</th>
				<th>Delete</th>
				<th>View</th>
              </tr>
			</thead>     
            	
             	<?php 
					$c=1;
						foreach ($result as $row){
						
							$type = $row->agency_typename;
							$description = $row->description;
							$agency_typeid =  $row->agency_typeid;
							$url = base_url().'view_agencies/'.$agency_typeid;
							echo '<tr>';
							echo '<td>'. $type . '</td>';
							echo '<td>'. $description . '</td>';
							echo "<td><i onclick='lef($agency_typeid)' class='icon wb-edit' aria-hidden='true' ></i></td>";
							echo "<td><i onclick='initiate_delete($agency_typeid)' class='icon wb-trash' aria-hidden='true' ></i></td>";
							echo "<td><a href=\"$url\"><i class='icon wb-eye' aria-hidden='true' ></i></a></td>";
						  	echo '</tr>';
							$c++;			
						}
				?>   
          </table>
          </div>
        </div>
      </div>           
      
      
        					 <!--  Add user modal-->
                  <div id="myAgent" class="modal fade modal-info" id="exampleModalInfo" aria-hidden="true" aria-labelledby="exampleModalInfo"
                  role="dialog" tabindex="-1">
                        
                        
                        
<!--                         <div id="myAgent" class="modal fade" role="dialog">-->
						  <div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header panel-heading">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add Agency Type</h4>
							  </div>
            							
							  <div class="modal-body">
							  

<!--							   <?php //echo form_open_multipart('upload/do_upload');?>-->
								
								<form method="post" action="<?=base_url()?>Agency/add_agencytype" autocomplete="off"/>
								<div class="col-xs-12">
									    <div class="form-group form-material floating row">
										   <div class="col-sm-12">
											<input type="text" class="form-control" id="#" name="agency_typename" required/>
											<label class="floating-label">Agency Type Name</label>
										  </div>
										</div>  
										<div class="form-group form-material floating row">
										 
										  <div class="col-sm-12">
											<textarea class="form-control" id="#" name="description" rows="3"></textarea>
											<label class="floating-label">Description</label>
										  </div>
										  
										</div>
                 
							  </div>
							   <div class="modal-footer">
                                	<button id='savenew_a' type="submit" class="btn btn-success">Save</button>
                                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
							</div>

						  </div>
						</div>
					</div>
					 </form>
  
  
      
      
      				  <!--  edit agent modal-->
                         <div id="myModal" class="modal fade  modal-info" role="dialog">
						  <div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Agency Type Data</h4>
							  </div>
							  <div class="modal-body">
							  
							   <form id="updatedevice" method="post" action="<?=base_url()?>Agency/update_agencytype" autocomplete="off">
                                
                     				<div class="col-xs-12">
									    <div class="form-group form-material floating row">
										   <div class="col-sm-12">
										   	<label class="control-label">Agency Type Name</label>
											<input type="text" class="form-control" id="agency_typename" name="agency_typename" required/>
										  </div>
										</div>  
										<div class="form-group form-material floating row">
										  <div class="col-sm-12">
										  	<label class="control-label">Description</label>
											<textarea class="form-control" id="description" name="description" rows="3"></textarea>
											
										  </div>
										</div>
										<div class="form-group form-material floating row hidden">
										  <div class="col-sm-12">
										  	<label class="control-label">agency type id</label>
											<input type="text" class="form-control" id="agency_typeid" name="agency_typeid"/>
											
										  </div>
										</div>
							  		</div>
									
							  </div>
							   <div class="modal-footer">
                                	<button id="savenew_as" type="submit" class="btn btn-success">Submit</button>
                                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
							</div>

						  </div>
						</div>
					 </form>
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
	
	
	function lef(a){
		
		$('#myModal').modal({backdrop: 'static', keyboard: false})  
		$('#myModal').modal('show');
		  
		document.getElementById("agency_typeid").value = a;
		
		var baseurl = "<?php echo base_url(); ?>";
		var xmlhttp = new XMLHttpRequest();
		var url = baseurl + "Agency/get_agencytype/" + a;
		
		xmlhttp.onreadystatechange=function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        		myFunction(xmlhttp.responseText);
    		}
		}

		xmlhttp.open("GET", url, true);
		xmlhttp.send();

		function myFunction(response) {
			
			var arr = JSON.parse(response);
			
			for (var i = 0; i < arr.length; i++) {
				
				document.getElementById("agency_typename").value = arr[i].agency_typename;
				document.getElementById("description").value = arr[i].description;
					
			}
		
		};

	
}
	
</script>


 