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
                <?php if($this->session->userdata('user_info')['role'] =='Super-Administrator'){ ?>
                <th>Agency Code</th>
                <?php }else{} ?>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
        	<th>Date</th>
                <th>Time</th>
                <th>Status</th>
        	<th>View</th>
              </tr>
            </thead>     
            <?php 
            $c=1;
        foreach ($result as $row){

                $code = $row->agencycode;
                $name = $row->eventname;
                $cat = $row->category_name;
                $location = $row->location;
                $date =  $row->date;
                $enddate =  $row->enddate;
                $time =  $row->time;
                $eventid =  $row->eventid;
                $encryption = base64_encode($eventid);
                $url = base_url().'view_event/'.$encryption;
                echo '<tr>';
                if($this->session->userdata('user_info')['role'] =='Super-Administrator'){
                   echo '<td>'. $code . '</td>';
                 }else{} 
                echo '<td>'. $name . '</td>';
                echo "<td>". $cat."</td>";
                echo "<td>". $location."</td>";
              echo "<td>". $time."</td>";
              if($enddate == ""){
                echo "<td>". date('d M Y',strtotime($date))."</td>";
              }
              else{
                echo "<td>".date('d M Y', strtotime($date)).' To '.date('d M Y', strtotime($enddate))."</td>";
              }
              if($date < date("Y-m-d")){
                echo '<td><span class="label label-warning">Upcoming</span></td>';
              }elseif($date == date("Y-m-d")){
                echo '<td><span class="label label-success">Live today</span></td>';
              }elseif($date > date("Y-m-d")){
                echo '<td><span class="label label-danger">Past</span></td>';
              }
              else{
                '<td></td>';
              }
              
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
                          <h4 class="modal-title" id="exampleOptionalLarge">Event Form</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="Event/add_event" autocomplete="off" enctype="multipart/form-data">
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
                                                      <input name="userfile1[]" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file" multiple="">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                              <div class="col-sm-12">
                                                <label class="control-label">Time</label>
                                                <input class="form-control" name="time" type="text" required/>
                                             </div>
                                          </div>
                                      </div>
                                      <div class="col col-md-6">
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="eventname" type="text" required/>
                                                <label class="floating-label">Event Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control calender" name="date" type="text"  required/>
                                                <label class="floating-label">Date</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col col-md-12">
                                                <input class="form-control calender" name="enddate" type="text">
                                                <label class="floating-label">End Date</label>
                                            </div>
                                          </div>
                                      </div>
                               </div>
                               <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <select class="form-control" id="eventcat" name="eventcategory">
                                                    <?php foreach ($event as $e): ?>
                                                      <option value="<?=$e->categoryid?>"><?=$e->category_name?></option>
                                                    <?php endforeach ?>  
                                                </select>
                                                 <label class="floating-label">Event Category</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="venue" type="text"/>
                                                <label class="floating-label">Venue</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <input class="form-control" name="location" type="text"/>
                                                <label class="floating-label">Event Location</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="gpostgps" type="text"/>
                                                <label class="floating-label">Ghana Post GPS Adress</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div id="transport" style="display: none;">
                					        <div class="row"> 
                                      <div class="form-group form-material floating row">
                                          <div class="col-sm-6">
                                                  <input class="form-control" name="departure_from" type="text"/>
                                                  <label class="floating-label">Depature From</label>
                                          </div>

                                          <div class="col-sm-6">
                                                  <input class="form-control" name="arrival_at" type="text"/>
                                                  <label class="floating-label">Arrival At</label>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row"> 
                                      <div class="form-group form-material floating row">
                                          <div class="col-sm-6">
                                                  <input class="form-control" name="departure_time" type="text"/>
                                                  <label class="floating-label">Depature Time</label>
                                          </div>

                                          <div class="col-sm-6">
                                                  <input class="form-control" name="posarrival_time" type="text"/>
                                                  <label class="floating-label">Possible Arrival Time</label>
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                                  <div id="movie"  style="display: none;">
                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="title" type="text"/>
                                                      <label class="floating-label">Title</label>
                                              </div>
                                              <div class="col-sm-6">
                                                      <label class="floating-label">Origin</label>
                                                      <select class="form-control" name="origin">
                                                         <option>Ghallywood</option>
                                                         <option>Nollywood</option>
                                                         <option>Hollywood</option>
                                                         <option>Bollywood</option>
                                                      </select>
                                              </div>
                                          </div>
                                      </div>

                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="director" type="text"/>
                                                      <label class="floating-label">Director</label>
                                              </div>
                                              <div class="col-sm-6">
                                                    <input class="form-control" name="thumbnail" type="text"/>
                                                    <label class="floating-label">Thumbnail</label> 
                                              </div>
                                          </div>
                                      </div>

                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="pg" type="text"/>
                                                      <label class="floating-label">PG</label>
                                              </div>
                                              <div class="col-sm-6">
                                                    <input class="form-control calender" name="releasedate" type="text"/>
                                                    <label class="floating-label">Realease Date</label> 
                                              </div>
                                          </div>
                                      </div>
                                    
                                    <div class="row"> 
                                        <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="#" name="cast" rows="2"></textarea>
                                            <label class="floating-label">Cast</label>
                                        </div>
                                            
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row"> 
                                        <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="#" name="description" rows="2"></textarea>
                                            <label class="floating-label">Description</label>
                                        </div>
                                            
                                        </div>
                                  </div>
                                  <h3>Tickets And Cost</h3>
                                  <div class="row">
                                    <div class="col-md-12">
                                        <table id="quotaTbl" class="table table-striped" style="border:none;">
                                            <thead style="border:none;">
                                            <tr style="border:none;">
                                                <th>Ticket</th>
                                                <th>Cost</th>
                                            </tr>
                                            </thead>


                                            <tbody style="border:none;">

                                            <tr style="border:none;">
                                                <td>
                                                  <input class="form-control" name="ticket[]" type="text" placeholder="Eg: Premuim, vip, etc" />
                                                <td>
                                                  <input class="form-control" name="cost[]" type="number" placeholder="Eg: 50 , 20 ,30"/>
                                                </td>

                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm clone_tbl_row"><i class="fa fa-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm del"><i class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
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


 