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
          			<a href="<?=base_url()?>agencytype">
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-reply" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Back</span>
                   </button>
                </a>			 
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
							$url = base_url().'view_agency/'.$agencyid;
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


 