
  <!-- Page -->
  <div class="page animsition" id="content">
    <div class="page-content container-fluid">
        <!-- search gproject nav bar starts here -->
      		<div id="gp_nav_bar" class="panel no_print" style="min-height: 70px;" >
          		<div class="col-sm-6" >
          			<a href="<?php echo base_url()?>add_user">
	          			<button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;">
	          				<i class="icon wb-user-add" aria-hidden="true"></i>
	          				<span class="hidden-sm hidden-xs">Add New</span>
	          			</button>
          			</a>
					<button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteUser" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span></button>	
				</div>
	  		</div>
      		<!-- search gproject nav bar ends here -->
        <div class="panel">  
         <?php echo $this->session->flashdata('message'); ?>
        <div class="panel-body">
         <div id="loadusers">
          <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
              <thead>
	              <tr>
	                <th>Username</th>
	                <th>Fullname</th>
	                <th>Mobile No</th>
	                <th>E-mail</th>
	                <th>Edit</th>
	                <th>Delete</th>
	              </tr>
			  </thead>     
              <!-- <?php 
				$c=1;
				foreach ($result as $row){
					$username = $row->username;		
					$fullname = $row->firstname.' '.$row->lastname;
					$mobileno = $row->mobileno;
					$email = $row->email;
					$userid = $row->id;
					$url = base_url().'edit_user/'.$userid;
					echo '<tr>';
					echo '<td>'. $username . '</td>';
					echo '<td>'. $fullname . '</td>';
					echo '<td>'. $mobileno . '</td>';
					echo '<td>'. $email . '</td>';
					echo "<td><a href='$url'><i class='icon wb-edit' aria-hidden='true' ></i></a></td>";
					if(has_permission($this->session->userdata('user_info')['id'],'delete user')){
						echo "<td><i onclick='initiate_delete($userid)' class='icon wb-trash' aria-hidden='true' ></i></td>";
					}else{
						echo "<td><i onclick='has_permission()' class='icon wb-trash' aria-hidden='true' ></i></td>";
					}

				  echo '</tr>';
					$c++;
					
				}
			   ?>     -->                  
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>					 
  <!-- End Page -->


 