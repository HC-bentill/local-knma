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
          			<button type="button" class="btn btn-outline btn-responsive btn-primary"  data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-user-add" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Add New</span>
          			</button>					 
					<button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteAgencytype" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span>
					</button>
					
				</div>
	  	</div>
 
      <div class="panel">
        <div class="panel-body">
         <?=$this->session->flashdata('message'); ?>
          <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>E-mail</th>
        				<th>Contact</th>
        				<th>Location</th>
        				<th>View</th>
              </tr>
			</thead>     
             	<?php 
					$c=1;
						foreach ($result as $row){
						
							$code = $row->agencycode;
							$name = $row->agencyname;
							$email = $row->email;
							$contact = $row->contact;
							$location =  $row->location;
							$agencyid =  $row->agencyid;
                                                        $encryption = base64_encode($agencyid);
							$url = base_url().'view_agency/'.$encryption;
							echo '<tr>';
							echo '<td>'. $code . '</td>';
							echo '<td>'. $name . '</td>';
							echo "<td>". $email."</td>";
							echo "<td>". $contact."</td>";
							echo "<td>". $location."</td>";
							echo "<td><a href=\"$url\"><i class='icon wb-eye' aria-hidden='true' ></i></a></td>";
						  	echo '</tr>';
							$c++;			
						}
				?>   
          </table>
        </div>
      </div>           
      
      
        					 <!--  Add user modal-->
                   <!-- modal        -->
   <div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge"
                  role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="exampleOptionalLarge">Agency Form</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="Agency/add_agency" autocomplete="off" enctype="multipart/form-data">
                                  <div class="row">
                                      <div class="col col-md-6">

                                          <script type="text/javascript">
                                              function userImg(input) {
                                                  if (input.files && input.files[0]) {
                                                      var reader = new FileReader();
                                                      reader.onload = function(e) {
                                                          $('#user_img')
                                                              .attr('src', e.target.result);
                                                      };
                                                      reader.readAsDataURL(input.files[0]);
                                                  }
                                              }
                                          </script>
                                          <div class="">
                                              <div class="">
                                                  <img src="<?php echo base_url();?>upload/user-avatar.png" id="user_img" class="thumbnail" width="120" height="100">
                                                  <div style="margin-top: -1em;">
                                                      <input name="userfile" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                              <div class="col-sm-12">
                                                <label class="control-label">Agency Type</label>
                                                <select class="form-control" name="agencytype">
                                                    <?php foreach ($type as $t): ?>
                                                  		<option value="<?=$t->agency_typeid?>"><?=$t->agency_typename?></option>
                                                	<?php endforeach ?>  
                                                </select>
                                             </div>
                                          </div>
                                      </div>
                                      <div class="col col-md-6">
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" id="agencycode" name="agencycode" type="text" onKeyUp="check_username();" required/>
                                                <label class="floating-label">Agency Code</label>
                                                <p id="status" class="privacy text-left" style="display:none">Available</p>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="agencyname" type="text"  required/>
                                                <label class="floating-label">Agency Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col col-md-12">
                                                <input class="form-control" name="contact" type="text">
                                                <label class="floating-label">Phone Number</label>
                                            </div>
                                          </div>
                                      </div>
                               </div>
                                <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <input class="form-control" name="email" type="text"/>
                                                <label class="floating-label">E-mail</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="location" type="text"/>
                                                <label class="floating-label">Location</label>
                                        </div>
                                        
                                    </div>
                                </div>
              					<div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-12">
                                                <input class="form-control" name="weburl" type="text"/>
                                                <label class="floating-label">Website Url</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-12">
                  											<textarea class="form-control" id="#" name="description" rows="3"></textarea>
                  											<label class="floating-label">Description</label>
                  									</div>
                                        
                                    </div>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" id="savenew_a" class="btn btn-success">Save</button>
                      </div>
                  </div>
                </form>
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
	
	function check_username(){
			
			var vfing = "This agent code is available to use"
			document.getElementById("status").innerHTML= vfing ;
			//document.getElementById("sbt").disabled  = true ;
			
			var baseurl = "<?php echo base_url(); ?>";
			var username = document.getElementById("agencycode").value;
		
			document.getElementById("status").style.display = 'inline-block';
			document.getElementById("status").innerHTML = "This agent code is available to use";
			document.getElementById("savenew_a").disabled  = false ;
			
			
			var n = username.length;
		
			if (n == "0") {
				document.getElementById("status").innerHTML= "" ;
			}
		
				var url = baseurl + "Agency/search_agencycode/" + username;
				
				var xmlhttp = new XMLHttpRequest();
		
				xmlhttp.onreadystatechange=function() {
					if (this.readyState == 4 && this.status == 200) {
						myFunction(this.responseText);
					}
				}
				xmlhttp.open("GET", url, true);
				xmlhttp.send();
				
				function myFunction(response) {
					
					
					var arr = JSON.parse(response);
			
					for (var i = 0; i < arr.length; i++) {
				
					
					var userid = arr[i].user_id;
					
					if (userid != "") {
						
						document.getElementById("status").style.display = 'inline-block';
						document.getElementById("status").innerHTML = "This agent code is already taken";
						document.getElementById("savenew_a").disabled  = true ;
							
					}	
					}	
				}
	
	}
</script>


 