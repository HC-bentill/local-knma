
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
					  		<td>This gives user the ability to create business and residential properties</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view buis prop"/></td>
					  		<td>View Property</td>
					  		<td>This gives user the ability to acess all business and residential properties data</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage buis prop"/></td>
					  		<td>Manage Property</td>
					  		<td>This gives user the ability to edit and view business and residential properties</td>
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
					  		<td>Manage Business Occupants</td>
					  		<td>This gives user the ability to edit and view business occupants</td>
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
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="property owner"/></td>
					  		<td>View Property Owners</td>
					  		<td>This gives user the ability to acess all property owners data</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage prop owner"/></td>
					  		<td>Manage Property Owner</td>
					  		<td>This gives user the ability to edit and view property owner data</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create message"/></td>
					  		<td>Create Messages</td>
					  		<td>This gives user the ability to create a message to be broadcast</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view message"/></td>
					  		<td>View Messages</td>
					  		<td>This gives user the ability to view all broadcasted messages</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view residence map"/></td>
					  		<td>Residence Map</td>
					  		<td>This gives user the ability to view residence property on a map</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view business map"/></td>
					  		<td>Business Map</td>
					  		<td>This gives user the ability to view business property on a map</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create product"/></td>
					  		<td>Create Product</td>
					  		<td>This gives user the ability to create product</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view product"/></td>
					  		<td>View Product</td>
					  		<td>This gives user the ability to acess all product data</td>
					  	</tr>
					  	<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage product"/></td>
					  		<td>Manage Product</td>
					  		<td>This gives user the ability to edit and view product</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="access property"/></td>
					  		<td>Access Property</td>
					  		<td>This gives user the ability to Access properties</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="add penalty"/></td>
					  		<td>Add Penalty</td>
					  		<td>This gives user the ability to add penalty</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view penalty"/></td>
					  		<td>View Penalty</td>
					  		<td>This gives user the ability to access all penalty data</td>
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
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view invoices"/></td>
					  		<td>View Invoices</td>
					  		<td>This gives user the ability to access all invoices generated</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="	"/></td>
					  		<td>Generate Invoices</td>
					  		<td>This gives user the ability to generated invoices</td>
						</tr>
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="make payment"/></td>
					  		<td>Make Payment</td>
					  		<td>This gives user the ability to make payment</td>
						</tr>	
						<tr>
					  		<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="print invoice"/></td>
					  		<td>Print Invoice</td>
					  		<td>This gives user the ability to make payment</td>
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

