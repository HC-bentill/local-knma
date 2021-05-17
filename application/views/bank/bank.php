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
					<button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteBank" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span>
					</button>
					
				</div>
	  	</div>
 
      <div class="panel">
        <div class="panel-body">
        	<div id="loadbank">
         
          <table id="tt" class="table table-striped table-hover table-responsive" style="cursor: pointer;">
            <thead>
              <tr>
                <th>Bank Name</th>
                <th>Description</th>
                <th>Edit</th>
				<th>Delete</th>
              </tr>
			</thead>     
            	
             	<?php 
					$c=1;
						foreach ($result as $row){
						
							$bankname = $row->bankname;
							$description = $row->description;
							$bankid =  $row->bankid;
							echo '<tr>';
							echo '<td>'. $bankname . '</td>';
							echo '<td>'. $description . '</td>';
							echo "<td><i onclick='lef($bankid)' class='icon wb-edit' aria-hidden='true' ></i></td>";
							echo "<td><i onclick='initiate_delete($bankid)' class='icon wb-trash' aria-hidden='true' ></i></td>";
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
								<h4 class="modal-title">Add New Bank</h4>
							  </div>
            							
							  <div class="modal-body">
							  

<!--							   <?php //echo form_open_multipart('upload/do_upload');?>-->
								
								<form id="myBank_f" method="post" action="<?=base_url()?>Bank/add_bank" autocomplete="off"/>
								<div class="col-xs-12">
									    <div class="form-group form-material floating row">
										   <div class="col-sm-12">
											<input type="text" class="form-control" id="bankname" name="bankname" required/>
											<label class="floating-label">Bank Name</label>
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
                                	<button id='savenew_a' type="submit" class="btn btn-success">Save Bank</button>
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
								<h4 class="modal-title">Edit Bank Data</h4>
							  </div>
							  <div class="modal-body">
							  
							   <form id="updatedevice" method="post" action="<?=base_url()?>Bank/update_bank" autocomplete="off">
                                
                     				<div class="col-xs-12">
									    <div class="form-group form-material floating row">
										   <div class="col-sm-12">
										   	<label class="control-label">Bank Name</label>
											<input type="text" class="form-control" id="bankname2" name="bankname" onKeyUp="check_bank2();"  required/>
											
											<p id="statuss" class="privacy text-left" style="display:none">Available</p>
										  </div>
										</div>  
										<div class="form-group form-material floating row">
										  <div class="col-sm-12">
										  	<label class="control-label">Description</label>
											<textarea class="form-control" id="descp" name="description" rows="3"></textarea>
											
										  </div>
										</div>
										<div class="form-group form-material floating row hidden">
										  <div class="col-sm-12">
										  	<label class="control-label">bank id</label>
											<input type="text" class="form-control" id="bankid" name="bankid"/>
											
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
	function call_ed_fxn(a){
		alert ("update : " + a);
		
		
	}
</script>
  
<script>
  	
	var loadFile = function(event) {
    var output = document.getElementById('agentpic');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
	  
</script>

<script>

	

	function SubForm (){
		
	var baseurl = "<?php echo base_url(); ?>" ; 
	var url = baseurl + "upload/do_upload"; 
		//var url = baseurl + "admin/save_agent"; 
		
	
    $.ajax({
        url:url,
        type:'post',
        data:$('#myForm').serialize(),
		enctype: 'multipart/form-data',
        success:function(){
			
			document.getElementById("exampleTopRight").click();
			reset_form();
			draw_table();
        }
    });
	}
	 
	function reset_form(){		
		document.getElementById("myForm").reset();
		document.getElementById("agentpic").src=""
		
	}
	  
	function draw_tablex(){
		
		var blank = "";
		document.getElementById("tt").innerHTML = blank;
		
		var baseurl = "<?php echo base_url(); ?>";
		var url = baseurl + "admin/load_aable/" ;
		
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
			var i;
			var cert;
			var out = "<table id='tt' class='table table-hover dataTable table-striped width-full' data-plugin='dataTable'>";
		
			for(i = 0; i < arr.length; i++) {
				var ic = i + 1;
				
				out += 
				"<tr> "+
					"<td >" + arr[i].agentcode + "</td>" +
					"<td >" + arr[i].agentname + "</td>" +
					"<td >" + arr[i].agentcat + "</td>" +
				"</tr>";
			}
			out += "</table>";
			
			document.getElementById("tt").innerHTML = out;
			
			
			
		}
		

	}
	  
</script>

<script>
	function check_bank(){
		var vfing = "This bank name is available to use"
			document.getElementById("status").innerHTML= vfing ;
			//document.getElementById("sbt").disabled  = true ;
			
			var baseurl = "<?php echo base_url(); ?>";
			var url = baseurl + "Bank/search_bank"; 
			var username = document.getElementById("bankname").value;
		
			document.getElementById("status").style.display = 'inline-block';
			document.getElementById("status").innerHTML = "This bank name is available to use";
			document.getElementById("savenew_a").disabled  = false ;
			
			
			var n = username.length;
		
			if (n == "0") {
				document.getElementById("status").innerHTML= "" ;
			}
		
		$.ajax({
        url:url,
        type:'post',
        data:{'username':username},
//		enctype : 'multipart/form-data',
//		processData: false,
//        contentType: false,
//        cache: false,
//		
        success:function(response){
				
					var arr = JSON.parse(response);
			
					for (var i = 0; i < arr.length; i++) {
				
					
					var userid = arr[i].categoryid;
					
					if (userid != "") {
						
						document.getElementById("status").style.display = 'inline-block';
						document.getElementById("status").innerHTML = "This bank name is already taken";
						document.getElementById("savenew_a").disabled  = true ;
						
						
					}
					
				}
			
			
        }
    });
	}


	function check_bank2(){
		var vfing = "This bank name is available to use"
			document.getElementById("statuss").innerHTML= vfing ;
			//document.getElementById("sbt").disabled  = true ;
			
			var baseurl = "<?php echo base_url(); ?>";
			var url = baseurl + "Bank/search_bank"; 
			var username = document.getElementById("bankname2").value;
		
			document.getElementById("statuss").style.display = 'inline-block';
			document.getElementById("statuss").innerHTML = "This bank name is available to use";
			document.getElementById("savenew_as").disabled  = false ;
			
			
			var n = username.length;
		
			if (n == "0") {
				document.getElementById("status").innerHTML= "" ;
			}
		
		$.ajax({
        url:url,
        type:'post',
        data:{'username':username},
//		enctype : 'multipart/form-data',
//		processData: false,
//        contentType: false,
//        cache: false,
//		
        success:function(response){
				
					var arr = JSON.parse(response);
			
					for (var i = 0; i < arr.length; i++) {
				
					
					var userid = arr[i].categoryid;
					
					if (userid != "") {
						
						document.getElementById("statuss").style.display = 'inline-block';
						document.getElementById("statuss").innerHTML = "This bank name is already taken";
						document.getElementById("savenew_as").disabled  = true ;
						
						
					}
					
				}
			
			
        }
    });
	}

</script>
	
<script>
function reset_form_f(){		
		document.getElementById("myBank_f").reset();
		
	}
</script>
<script>
	function sub_form_s (){
		
		
	var baseurl = "<?php echo base_url(); ?>" ; 
	var url = baseurl + "Bank/add_bank"; 
	
	document.getElementById("savenew_a").innerHTML = "Saving...."	
	
    $.ajax({
        url:url,
        type:'post',
        data:$('#myBank_f').serialize(),
        
		success:function(){
			
			document.getElementById("savenew_a").innerHTML = "Save Bank"
			document.getElementById("exampleTopRight").click();	
			
			reset_form_f();
			draw_table();
        }
    });
	}
</script>
<script>

	function draw_table(){
		
		var blank = "";
		document.getElementById("tt").innerHTML = blank;
		
		var baseurl = "<?php echo base_url(); ?>";
		var url = baseurl + "Bank/load_table/" ;
		
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
			var i,c;
			
			
			var out = "<table id='tt' class='table table-striped table-hover table-responsive' style='cursor: pointer;'>" ;
            out += "<thead>"+
              "<tr>" +
                "<th>Bank Name</th>" +
                "<th>Description</th>" +
              "</tr>" +
			  "</thead>" ; 
			
			c=0;
			for(i = 0; i < arr.length; i++) {
				
				c++;
				
				out += 
				"<tr id='" + c + "' onClick='clicktbl(this)' data-type='element' data-value='" + arr[i].bankid + "'>" + 				
					"<td >" + arr[i].bankname + "</td>" +
					"<td >" + arr[i].description + "</td>" +
				"</tr>";
			}
			out += "</table>";
			
			document.getElementById("tt").innerHTML = out;
			
			
			
		}
		

	}
	
</script>
<script>
	var selected_row_id;
	var selected_agent_id;
	var deleteid;
	
	function initiate_update(x){
		
		if(x > 0){
			var type = document.getElementById(x).getAttribute("data-value");
			lef(type);
		}else{
			document.getElementById('exampleToastrError').click();
			
		}
	}
	
	function clicktbl(x){
		
		
		var table = document.getElementById("tt");
		for (var i = 1, row; row = table.rows[i]; i++) {
			document.getElementById(i).style.backgroundColor= "#FFFFFF";
		}
		
		document.getElementById(x.rowIndex).style.backgroundColor="#ddd";
		var type = document.getElementById(x.rowIndex).getAttribute("data-value");
		
		selected_agent_id = type;
		selected_row_id = x.rowIndex;
		
		
	}
	
	function initiate_delete(x){
		deleteid = x;
		document.getElementById("dpop").click();
		
		
	}
	
	
	function lef(a){
		
		  	$('#myModal').modal({backdrop: 'static', keyboard: false})  
			$('#myModal').modal('show');
		  
		  	document.getElementById("bankid").value = a;
		
		  var baseurl = "<?php echo base_url(); ?>";
		var xmlhttp = new XMLHttpRequest();
		var url = baseurl + "Bank/get_bank/" + a;
		
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
				
				document.getElementById("bankname2").value = arr[i].bankname;
				document.getElementById("descp").value = arr[i].description;
				
				
				}
	
			
			};

	
}
	
</script>


 