<?php

	 $value = strtolower($searchValue);
	 $val = urldecode($value); 

	 if($val == ''){
			$result =  $this->db->query( "select * from users WHERE delete_status='Active' order by user_id asc LIMIT 0")->result();
    }else{
    	$result = $this->db->query("SELECT * FROM users WHERE  (lower(username) LIKE '%$val%' or  lower(role) LIKE '%$val%' or lower(fullname) LIKE '%$val%') And delete_status = 'Active'")->result();
    }
     
?>

 <table id="tt" class="table table-striped table-hover table-responsive" style="cursor: pointer;">
            
                    <thead>
              <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Fullname</th>
              </tr>
			  </thead>     
            	
             	<?php 
					$c=1;
						foreach ($result as $row){
							$username = $row->username;		
							$role = $row->role;
							$fullname = $row->fullname;
							$userid = $row->user_id;
							
							
							
							echo '<tr id="' . $c . '" onClick="clicktbl(this)" data-type="element" data-value="' . $userid . '">';
							echo '<td>'. $username . '</td>';
							echo '<td>'. $role . '</td>';
							echo '<td>'. $fullname . '</td>';

						  echo '</tr>';
							$c++;
							
						}
				?>
                                    
                                    
              
             
             
            
          </table>