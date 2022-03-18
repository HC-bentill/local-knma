
  <!-- End Page -->

  <div class="row">
  <div class="col">
    <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
      <?= $this->session->flashdata('message');?>
      <div class="card-body">
        <div class="wizard-progress wizard-progress-lg">
          <div class="steps-progress">
            <div class="progress-indicator"></div>
          </div>
          <ul class="nav wizard-steps">
            <li class="nav-item active">
              <a class="nav-link" href="#w4-account" data-toggle="tab"><span>1</span>User details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>User Roles</a>
            </li>
          </ul>
        </div>

        <form class="form-horizontal p-3" autocomplete="off" novalidate="novalidate" method="POST" action="<?= base_url()?>Users/add_user" id="submitForm">
          <div class="tab-content">
            <div id="w4-account" class="tab-pane active">
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
                  <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
                  <input type="date" class="form-control calender" id="dob" name="dob" autocomplete="off"/>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Mobile No:</strong></label>
                  <input type="text" class="form-control" id="mobileno" name="mobileno" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
                  <input type="email" class="form-control" id="email" name="email" autocomplete="off" required/>
                </div>
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Username:</strong></label>
                  <input type="text" class="form-control" id="username" name="username" onKeyUp="check_username();" autocomplete="off" required/>
                  <p id="status" class="privacy text-left" style="display:none">Available</p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label class="control-label text-sm-right pt-2"><strong>Department:</strong></label>
                  <select id="#" name="position" class="form-control" autocomplete="off" required>
					<option value=""></option>
					<?php foreach($position as $pos){?>
						<option value="<?=$pos->position?>"><?=$pos->position?></option>
					<?php } ?>
				  </select>
                </div>
              </div>
            </div>
            <div id="w4-profile" class="tab-pane">
             <div class="row">
                <div class="col-sm-12">
	              	<table  id="tbl" class="table table-hover width-full table-responsive">
		              <thead>
			              <tr>
			                <th><input type="checkbox" id = "chckHead" /></th>
			       			<th>Role</th>
			       			<th>Description</th>
			              </tr>
					  </thead>
					  <tbody>
					  	<tr>
					  		<td><input type="checkbox" class="chcktbl"  id="inputUnchecked" name="role[]" value="create user"/></td>
					  		<td>Create User</td>
					  		<td>This gives user the ability to create system users</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class="chcktbl" id="inputUnchecked" name="role[]" value="view user"/></td>
					  		<td>View User</td>
					  		<td>This gives user the ability to view system users</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl"  id="inputUnchecked" name="role[]" value="manage user"/></td>
					  		<td>Manage User</td>
					  		<td>This gives user the ability to edit and view system users</td>
					  	</tr>
							<tr>
					  		<td><input type="checkbox" class = "chcktbl"  id="inputUnchecked" name="role[]" value="manage user status"/></td>
					  		<td>Manage User Status</td>
					  		<td>This gives user the ability to change system users account status</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create residence"/></td>
					  		<td>Create Residence</td>
					  		<td>This gives user the ability to create residence</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view residence"/></td>
					  		<td>View Residence</td>
					  		<td>This gives user the ability to acess all residence data</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage residence"/></td>
					  		<td>Manage Residence</td>
					  		<td>This gives user the ability to edit and view residence</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create buis prop"/></td>
					  		<td>Create Property</td>
					  		<td>This gives user the ability to create properties</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view buis prop"/></td>
					  		<td>View Property</td>
					  		<td>This gives user the ability to view all properties data</td>
					  	</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage buis prop" <?=has_permission($id,'manage buis prop')?'checked':''?>/></td>
							<td>Access Property Module</td>
							<td>This gives user the ability to access the property module</td> 
						</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create buis occ"/></td>
					  		<td>Create Business Occupants</td>
					  		<td>This gives user the ability to create business occupant</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view buis occ"/></td>
					  		<td>View Business Occupants</td>
					  		<td>This gives user the ability to acess all business occupant data</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage buis occ"/></td>
					  		<td>Access Business Occupant Module</td>
					  		<td>This gives user the ability to access the business occupant module</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="edit busocc cat"/></td>
					  		<td>Edit Business Occupants Category</td>
					  		<td>This gives user the ability to edit business occupants categories</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="del busocc cat"/></td>
					  		<td>Delete Business Occupants Category</td>
					  		<td>This gives user the ability to delete business occupants categories</td>
					  	</tr>
							<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="property_owner"/></td>
					  		<td>View Property Owners</td>
					  		<td>This gives user the ability to acess all property owners data</td>
					  	</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage_message"/></td>
							<td>Access Messages Module</td>
							<td>This gives user the ability to access message module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create_message"/></td>
							<td>Create Messages</td>
							<td>This gives user the ability to create a message to be broadcast</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_message"/></td>
							<td>View Messages</td>
							<td>This gives user the ability to view all broadcasted messages</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_map" <?=has_permission($id,'view_map')?'checked':''?>/></td>
							<td>View Map</td>
							<td>This gives user the ability to access map module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage_product" <?=has_permission($id,'manage_product')?'checked':''?>/></td>
							<td>Access Product Module</td>
							<td>This gives user the ability to access product module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_product" <?=has_permission($id,'view_product')?'checked':''?>/></td>
							<td>View Product</td>
							<td>This gives user the ability to view product data</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create_product" <?=has_permission($id,'create_product')?'checked':''?>/></td>
							<td>Create Product</td>
							<td>This gives user the ability to create product data</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="access property"/></td>
					  		<td>Access Property</td>
					  		<td>This gives user the ability to Access properties</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_penalty" <?=has_permission($id,'view_penalty')?'checked':''?>/></td>
					  		<td>View Penalty</td>
					  		<td>This gives user the ability to view penalty module</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="tax assignment"/></td>
					  		<td>Tax assignment</td>
					  		<td>This gives user the ability to access all tax assignment data</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="transaction"/></td>
					  		<td>View Transactions</td>
					  		<td>This gives user the ability to access all transactions</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="transaction reversal"/></td>
					  		<td>Transaction Reversal</td>
					  		<td>This gives user the ability to reverse a transaction</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_invoices" <?=has_permission($id,'view_invoices')?'checked':''?>/></td>
							<td>View Invoices</td>
							<td>This gives user the ability to access all invoices</td>
						</tr>>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="generate_invoices"/></td>
					  		<td>Generate Invoices</td>
					  		<td>This gives user the ability to generate invoices</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="make payment"/></td>
					  		<td>Make Payment</td>
					  		<td>This gives user the ability to make payment</td>
						</tr>	
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="print invoice"/></td>
					  		<td>Print Invoice</td>
					  		<td>This gives user the ability to print invoices</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="invoice adjustment"/></td>
							<td>Add Invoice Adjustments</td>
							<td>This gives user the ability to adjustment invoice amounts</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view adjustment"/></td>
							<td>View Adjustments</td>
							<td>This gives user the ability to view all invoice adjustments</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="audit approval"/></td>
							<td>Audit Approval</td>
							<td>This gives user the ability to audit and approve adjustment</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="approve adjustment"/></td>
							<td>Approve Adjustments</td>
							<td>This gives user the ability to approve adjustments</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_print_invoice"/></td>
					  		<td>Batch Print Invoice</td>
					  		<td>This gives user the ability to print invoices in batches</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_delete_records"/></td>
					  		<td>Batch Delete Records</td>
					  		<td>This gives user the ability to delete records from a csv file</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="invoice_distribution"/></td>
							<td>View Invoice Distribution</td>
							<td>This gives user the ability to view invoice distributed</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_bill_generation"/></td>
							<td>Batch Bill Generation</td>
							<td>This gives user the ability to generate batch bills</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="single_bill_generation"/></td>
							<td>Single Bill Generation</td>
							<td>This gives user the ability to generate a bill for a record(properties, businesses, signages, etc)</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_data_report"/></td>
							<td>View Data report and sub-categories</td>
							<td>This gives user the ability to view data report and its sub categories</td>
						</tr>	
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="data report"/></td>
					  		<td>View Data report</td>
					  		<td>This gives user the ability to view data report</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="finance report"/></td>
					  		<td>View Finance report</td>
					  		<td>This gives user the ability to view finance report</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage channels"/></td>
							<td>Manage Channel</td>
							<td>This gives user the ability to disable and enable a channel</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="system_audit"/></td>
							<td>System Audit</td>
							<td>This gives user the ability to view all system audit</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="fixed_amount"/></td>
							<td>Bill Generation Using Fixed Amount Module</td>
							<td>This gives user the ability to generate bills using the fixed amount module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="consolidated_invoice"/></td>
							<td>View Consolidated Invoice</td>
							<td>This gives user the ability to view consolidated invoice</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="delete_property_business"/></td>
							<td>Delete Property Or Business Record</td>
							<td>This gives user the ability to delete property and business records</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="upload_property"/></td>
							<td>Upload Property Records</td>
							<td>This gives user the ability to bulk upload property records from a file</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="upload_business"/></td>
							<td>Upload Business Records</td>
							<td>This gives user the ability to bulk upload business records from a file</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'user_management')?'checked':''?> value="user_management"/></td>
							<td>View User Management</td>
							<td>This gives user the ability to view user management module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'manage_signage')?'checked':''?> value="manage_signage"/></td>
							<td>Access Signage Module</td>
							<td>This gives user the ability to manage Signage module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'create_signage')?'checked':''?> value="create_signage"/></td>
							<td>Create Signage</td>
							<td>This gives user the ability to view Signage module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'view_signage')?'checked':''?> value="view_signage"/></td>
							<td>View Signage</td>
							<td>This gives user the ability to create Signage module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'view_telecom')?'checked':''?> value="view_telecom"/></td>
							<td>View Telecom</td>
							<td>This gives user the ability to view Telecom module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage_telecom"/></td>
							<td>Access Telecom Module</td>
							<td>This gives user the ability to access Telecom module</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create_telecom"/></td>
							<td>Create Telecom</td>
							<td>This gives user the ability to create Telecom data</td>
						</tr>
						<tr>
							<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view_telecom"/></td>
							<td>View Telecom</td>
							<td>This gives user the ability to view Telecom data</td>
							</tr>
		              </tbody>
		          	</table>
		        </div>
		      </div>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <ul class="pager">
          <li class="previous disabled">
            <a><i class="fa fa-angle-left"></i> Previous</a>
          </li>
          <li class="finish hidden float-right">
            <a>Finish</a>
          </li>
          <li class="next">
            <a id="save">Next <i class="fa fa-angle-right"></i></a>
          </li>
        </ul>
      </div>
    </section>
  </div>
</div>

