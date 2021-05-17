<style type="text/css">
	/*@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');*/
	@import url('<?php echo base_url(); ?>assets/fonts/font-awesome/font-awesome.css');

	*, *:before, *:after {
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	}

	h1 {
	  padding: 50px 0;
	  font-weight: 400;
	  text-align: center;
	}

	p {
	  margin: 0 0 20px;
	  line-height: 1.5;
	}

	main {
	  margin: 0 auto;
	  background: #fff;
	}

	.section {
	  display: none;
	  padding: 20px 0 0;
	  border-top: 1px solid #ddd;
	}

	input[type=radio] {
	  display: none;
	}

	.label {
	  display: inline-block;
	  margin: 0 0 -1px;
	  padding: 15px 25px;
	  font-weight: 600;
	  text-align: center;
	  color: #bbb;
	  border: 1px solid transparent;
	}

	.label:before {
	  font-family: fontawesome;
	  font-weight: normal;
	  margin-right: 10px;
	}

	.label[for*='1']:before { content: '\f1cb'; }
	.label[for*='2']:before { content: '\f17d'; }
	.label[for*='3']:before { content: '\f16b'; }
	.label[for*='4']:before { content: '\f1a9'; }
	.label[for*='5']:before { content: '\f1a9'; }
	.label[for*='6']:before { content: '\f1a9'; }

	.label:hover {
	  color: #888;
	  cursor: pointer;
	}

	#tab1,#tab2:checked + label {
	  color: #555;
	  border: 1px solid #ddd;
	  border-top: 2px solid #319fbb;
	  border-right: 2px solid #319fbb;
	  border-left: 2px solid #319fbb;
	  border-bottom: 1px solid #fff;
	}

	#tab1:checked + label {
	  color: #555;
	  border: 1px solid #ddd;
	  border-top: 2px solid #319fbb;
	  border-right: 2px solid #319fbb;
	  border-left: 2px solid #319fbb;
	  border-bottom: 1px solid #fff;
	}

	#tab1:checked ~ #content1,
	#tab2:checked ~ #content2,
	#tab3:checked ~ #content3,
	#tab4:checked ~ #content4,
	#tab5:checked ~ #content5,
	#tab6:checked ~ #content6 {
	  display: block;
	}

	@media screen and (max-width: 650px) {
	  .label {
	    font-size: 0;
	  }
	  .label:before {
	    margin: 0;
	    font-size: 18px;
	  }
	}

	@media screen and (max-width: 400px) {
	  .label {
	    padding: 15px;
		}
	}
</style>
<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
          	<main>

			  <input id="tab1" type="radio" name="tabs" checked>
			  <label class="label" for="tab1">User Details</label>

			  <input id="tab2" type="radio" name="tabs">
			  <label class="label" for="tab2">User roles</label>

			  <section class="section" id="content1">
			  	<form autocomplete="off" id="form1" method="post" action="<?=base_url()?>Users/edit_user_details">
			  		<div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>First Name:</strong></label>
		                  <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" value="<?=$result->firstname?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Last Name:</strong></label>
		                  <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" value="<?=$result->lastname?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Date Of Birth:</strong></label>
		                  <input type="text" class="form-control" id="mobileno" name="mobileno" autocomplete="off" value="<?=$result->mobileno?>"/>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Mobile No:</strong></label>
		                  <input type="text" class="form-control" id="mobileno" name="mobileno" autocomplete="off" value="<?=$result->mobileno?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>E-mail:</strong></label>
		                  <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?=$result->email?>" required/>
		                </div>
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Username:</strong></label>
		                  <input type="text" class="form-control" id="username" name="username" onKeyUp="check_username();" autocomplete="off" value="<?=$result->username?>" readonly required/>
		                  <p id="status" class="privacy text-left" style="display:none">Available</p>
		                </div>
		              </div>
		              <div class="form-group row">
		                <div class="col-sm-4">
		                  <label class="control-label text-sm-right pt-2"><strong>Department:</strong></label>
		                  <select id="#" name="position" class="form-control" autocomplete="off" required>
								<option value="">SELECT OPTION</option>
								<?php foreach($position as $pos){?>
									<option value="<?=$pos->position?>" <?=$result->position == $pos->position?'selected == selected':''; ?>><?=$pos->position?></option>
								<?php } ?>
							</select>
		                </div>
		              </div>
		              <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                        	<input type="text" class="form-control hidden" id="id" name="id" autocomplete="off" value="<?=$result->id?>" required/>
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update User Details" id="btnet1" type="button">
                        </div>
                     </div>
          		</form>
			  </section>

			  <section class="section" id="content2">
			  	<form autocomplete="off" id="form2" method="post" action="<?=base_url()?>Users/edit_user_roles">
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
								<td><input type="checkbox" class="chcktbl"  id="inputUnchecked" name="role[]" value="create user" <?=has_permission($id,'create user')?'checked':''?>/></td>
								<td>Create User</td>
								<td>This gives user the ability to create system users</td>
							</tr>
							<tr>
								<td><input type="checkbox" class="chcktbl" id="inputUnchecked" name="role[]" value="view user" <?=has_permission($id,'view user')?'checked':''?>/></td>
								<td>View User</td>
								<td>This gives user the ability to view system users</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl"  id="inputUnchecked" name="role[]" value="manage user" <?=has_permission($id,'manage user')?'checked':''?> /></td>
								<td>Manage User</td>
								<td>This gives user the ability to edit and view system users</td>
							</tr>
								<tr>
								<td><input type="checkbox" class = "chcktbl"  id="inputUnchecked" name="role[]" <?=has_permission($id,'manage user status')?'checked':''?> value="manage user status"/></td>
								<td>Manage User Status</td>
								<td>This gives user the ability to change system users account status</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create residence" <?=has_permission($id,'create residence')?'checked':''?>/></td>
								<td>Create Residence</td>
								<td>This gives user the ability to create residence</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view residence" <?=has_permission($id,'view residence')?'checked':''?>/></td>
								<td>View Residence</td>
								<td>This gives user the ability to acess all residence data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage residence" <?=has_permission($id,'manage residence')?'checked':''?>/></td>
								<td>Manage Residence</td>
								<td>This gives user the ability to edit and view residence</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create buis prop" <?=has_permission($id,'create buis prop')?'checked':''?>/></td>
								<td>Create Property</td>
								<td>This gives user the ability to create business and residential properties</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view buis prop" <?=has_permission($id,'view buis prop')?'checked':''?>/></td>
								<td>View Property</td>
								<td>This gives user the ability to acess all business and residential properties data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage buis prop" <?=has_permission($id,'manage buis prop')?'checked':''?>/></td>
								<td>Manage Property</td>
								<td>This gives user the ability to edit and view business and residential properties</td> 
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create buis occ" <?=has_permission($id,'create buis occ')?'checked':''?>/></td>
								<td>Create Business Occupants</td>
								<td>This gives user the ability to create business occupant</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view buis occ" <?=has_permission($id,'view buis occ')?'checked':''?>/></td>
								<td>View Business Occupants</td>
								<td>This gives user the ability to acess all business occupant data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage buis occ" <?=has_permission($id,'manage buis occ')?'checked':''?>/></td>
								<td>Manage Business Occupants</td>
								<td>This gives user the ability to edit and view business occupants</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="edit busocc cat" <?=has_permission($id,'edit busocc cat')?'checked':''?>/></td>
								<td>Edit Business Occupants Category</td>
								<td>This gives user the ability to edit business occupants categories</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="del busocc cat" <?=has_permission($id,'del busocc cat')?'checked':''?>/></td>
								<td>Delete Business Occupants Category</td>
								<td>This gives user the ability to delete business occupants categories</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="property owner" <?=has_permission($id,'property owner')?'checked':''?>/></td>
								<td>View Property Owners</td>
								<td>This gives user the ability to acess all property owners data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage prop owner" <?=has_permission($id,'manage prop owner')?'checked':''?>/></td>
								<td>Manage Property Owner</td>
								<td>This gives user the ability to edit and view property owner data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create message" <?=has_permission($id,'create message')?'checked':''?>/></td>
								<td>Create Messages</td>
								<td>This gives user the ability to create a message to be broadcast</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view message" <?=has_permission($id,'view message')?'checked':''?>/></td>
								<td>View Messages</td>
								<td>This gives user the ability to view all broadcasted messages</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view residence map" <?=has_permission($id,'view residence map')?'checked':''?>/></td>
								<td>Residence Map</td>
								<td>This gives user the ability to view residence property on a map</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view business map" <?=has_permission($id,'view business map')?'checked':''?>/></td>
								<td>Business Map</td>
								<td>This gives user the ability to view business property on a map</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="create product" <?=has_permission($id,'create product')?'checked':''?>/></td>
								<td>Create Product</td>
								<td>This gives user the ability to add product and sub-categories</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view product" <?=has_permission($id,'view product')?'checked':''?>/></td>
								<td>View Product</td>
								<td>This gives user the ability to view products and sub-categories</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="manage product" <?=has_permission($id,'manage product')?'checked':''?>/></td>
								<td>Manage Product</td>
								<td>This gives user the ability to edit and view product</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="access property" <?=has_permission($id,'access property')?'checked':''?>/></td>
								<td>Access Property</td>
								<td>This gives user the ability to Access properties</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="add penalty" <?=has_permission($id,'add penalty')?'checked':''?>/></td>
								<td>Add Penalty</td>
								<td>This gives user the ability to add penalty</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view penalty" <?=has_permission($id,'view penalty')?'checked':''?>/></td>
								<td>View Penalty</td>
								<td>This gives user the ability to access all penalty data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="tax assignment" <?=has_permission($id,'tax assignment')?'checked':''?>/></td>
								<td>Tax assignment</td>
								<td>This gives user the ability to access all tax assignment data</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="transaction" <?=has_permission($id,'transaction')?'checked':''?>/></td>
								<td>View Transactions</td>
								<td>This gives user the ability to access all transactions</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="transaction reversal" <?=has_permission($id,'transaction reversal')?'checked':''?>/></td>
								<td>Transaction Reversal</td>
								<td>This gives user the ability to reverse a transaction</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="view invoices" <?=has_permission($id,'view invoices')?'checked':''?>/></td>
								<td>View Invoices</td>
								<td>This gives user the ability to access all invoices generated</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="generate invoices" <?=has_permission($id,'generate invoices')?'checked':''?>/></td>
								<td>Generate Invoices</td>
								<td>This gives user the ability to access all invoices generated</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="make payment" <?=has_permission($id,'make payment')?'checked':''?>/></td>
								<td>Make Payment</td>
								<td>This gives user the ability to make payment</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="print invoice" <?=has_permission($id,'print invoice')?'checked':''?>/></td>
								<td>Print Invoice</td>
								<td>This gives user the ability to make payment</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'invoice adjustment')?'checked':''?> value="invoice adjustment"/></td>
								<td>Add Invoice Adjustments</td>
								<td>This gives user the ability to adjustment invoice amounts</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'view adjustment')?'checked':''?> value="view adjustment"/></td>
								<td>View Adjustments</td>
								<td>This gives user the ability to view all invoice adjustments</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'audit approval')?'checked':''?> value="audit approval"/></td>
								<td>Audit Approval</td>
								<td>This gives user the ability to audit and approve adjustment</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'approve adjustment')?'checked':''?> value="approve adjustment"/></td>
								<td>Approve Adjustments</td>
								<td>This gives user the ability to approve adjustments</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_print_invoice" <?=has_permission($id,'batch_print_invoice')?'checked':''?>/></td>
								<td>Batch Print Invoice</td>
								<td>This gives user the ability to print invoices in batches</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_delete_record" <?=has_permission($id,'batch_delete_record')?'checked':''?>/></td>
								<td>Batch Delete Records</td>
								<td>This gives user the ability to delete records from a csv file</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="invoice_distribution" <?=has_permission($id,'invoice_distribution')?'checked':''?>/></td>
								<td>View Invoice Distribution</td>
								<td>This gives user the ability to view invoice distributed</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="batch_bill_generation" <?=has_permission($id,'batch_bill_generation')?'checked':''?>/></td>
								<td>Batch Bill Generation</td>
								<td>This gives user the ability to generate batch bills</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="single_bill_generation" <?=has_permission($id,'single_bill_generation')?'checked':''?>/></td>
								<td>Single Bill Generation</td>
								<td>This gives user the ability to generate a bill for a record(properties, businesses, signages, etc)</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="data report" <?=has_permission($id,'data report')?'checked':''?>/></td>
								<td>View Data report</td>
								<td>This gives user the ability to view data report</td>
							</tr>	
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" value="finance report" <?=has_permission($id,'finance report')?'checked':''?>/></td>
								<td>View Finance report</td>
								<td>This gives user the ability to view finance report</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'manage channels')?'checked':''?> value="manage channels"/></td>
								<td>Manage Channel</td>
								<td>This gives user the ability to disable and enable a channel</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'system_audit')?'checked':''?> value="system_audit"/></td>
								<td>System Audit</td>
								<td>This gives user the ability to view all system audit</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'fixed_amount')?'checked':''?> value="fixed_amount"/></td>
								<td>Bill Generation Using Fixed Amount Module</td>
								<td>This gives user the ability to generate bills using the fixed amount module</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'consolidated_invoice')?'checked':''?> value="consolidated_invoice"/></td>
								<td>View Consolidated Invoice</td>
								<td>This gives user the ability to view consolidated invoice</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'delete_property_business')?'checked':''?> value="delete_property_business"/></td>
								<td>Delete Property Or Business Record</td>
								<td>This gives user the ability to delete property and business records</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'upload_property')?'checked':''?> value="upload_property"/></td>
								<td>Upload Property Records</td>
								<td>This gives user the ability to bulk upload property records from a file</td>
							</tr>
							<tr>
								<td><input type="checkbox" class = "chcktbl" id="inputUnchecked" name="role[]" <?=has_permission($id,'upload_business')?'checked':''?> value="upload_business"/></td>
								<td>Upload Business Records</td>
								<td>This gives user the ability to bulk upload business records from a file</td>
							</tr>
						</tbody>
		          	</table>
		        </div>
		      </div>
		      <div class="form-group row">
                <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
					<div class="col-sm-4 pull-right">
						<input type="text" class="form-control hidden" id="id" name="id" autocomplete="off" value="<?=$result->id?>" required/>
						<input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update User Roles" id="btnet2" type="button">
					</div>
				</div>
                </form>
			  </section>
			</main>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->

