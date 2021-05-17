<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?=base_url("search_system_audit")?>" autocomplete="off">
            <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
              <div class="col-lg-12">
                <div class="form-group m-form__group row" style="margin-bottom:1em;">
                  
                  <div class="col-lg-3" id="date1">
                    <input type="date" class=" form-control" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                  </div>
                  <div class="col-lg-3" id="date2">
                    <input type="date" class="form-control" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
                  </div>
                  <div class="col-lg-3">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="role" name="role">
                        <option value="">Select Option</option>
                        <option <?=$role =='Logged In'?'selected == selected':''; ?> value="Logged In">Log In</option>
                        <option <?=$role =='Logged Out'?'selected == selected':''; ?> value="Logged Out">Log Out</option>
                        <option <?=$role =='Changed password'?'selected == selected':''; ?> value="Changed password">Changed password</option>
                        <option <?=$role =='Added a user'?'selected == selected':''; ?> value="Added a user">Added a user</option>
                        <option <?=$role =='Edited user data'?'selected == selected':''; ?> value="Edited user data">Edited user data</option>
                        <option <?=$role =='Edited user roles'?'selected == selected':''; ?> value="Edited user roles">Edited user roles</option>
                        <option <?=$role =='Added a residence property'?'selected == selected':''; ?> value="Added a residence property">Added a residence property</option>
                        <option <?=$role =='Added a household'?'selected == selected':''; ?> value="Added a household">Added a household</option>
                        <option <?=$role =='Edited a household personnal data'?'selected == selected':''; ?> value="Edited a household personnal data">Edited a household personnal data</option>
                        <option <?=$role =='Edited a household education data'?'selected == selected':''; ?> value="Edited a household education data">Edited a household education data</option>
                        <option <?=$role =='Edited a household family data'?'selected == selected':''; ?> value="Edited a household family data">Edited a household family data</option>
                        <option <?=$role =='Edited a residence property owner\'s data'?'selected == selected':''; ?> value="Edited a residence property owner's data">Edited a residence property owner's data</option>
                        <option <?=$role =='Edited a residence location data'?'selected == selected':''; ?> value="Edited a residence location data">Edited a residence location data</option>
                        <option <?=$role =='Edited a residence property data'?'selected == selected':''; ?> value="Edited a residence property data">Edited a residence property data</option>
                        <option <?=$role =='Edited a residence facility data'?'selected == selected':''; ?> value="Edited a residence facility data">Edited a residence facility data</option>
                        <option <?=$role =='Resent residence sms'?'selected == selected':''; ?> value="Resent residence sms">Resent residence sms</option>
                        <option <?=$role =='Resent household sms'?'selected == selected':''; ?> value="Resent household sms">Resent household sms</option>
                        <option <?=$role =='Edited a property owner\'s data'?'selected == selected':''; ?> value="Edited a property owner's data">Edited a property owner's data</option>
                        <option <?=$role =='Added a business property'?'selected == selected':''; ?> value="Added a business property">Added a business property</option>
                        <option <?=$role =='Added a business occupant'?'selected == selected':''; ?> value="Added a business occupant">Added a business occupant</option>
                        <option <?=$role =='Edited a business data'?'selected == selected':''; ?> value="Edited a business data">Edited a business data</option>
                        <option <?=$role =='Edited a business occupant owner data'?'selected == selected':''; ?> value="Edited a business occupant owner data">Edited a business occupant owner data</option>
                        <option <?=$role =='Edited a business occupant category data'?'selected == selected':''; ?> value="Edited a business occupant category data">Edited a business occupant category data</option>
                        <option <?=$role =='Edited a business property owner data'?'selected == selected':''; ?> value="Edited a business property owner data">Edited a business property owner data</option>
                        <option <?=$role =='Edited a business property location data'?'selected == selected':''; ?> value="Edited a business property location data">Edited a business property location data</option>
                        <option <?=$role =='Edited a business property data'?'selected == selected':''; ?> value="Edited a business property data">Edited a business property data</option>
                        <option <?=$role =='Edited a business property facility data'?'selected == selected':''; ?> value="Edited a business property facility data">Edited a business property facility data</option>
                        <option <?=$role =='Resent business property sms'?'selected == selected':''; ?> value="Resent business property sms">Resent business property sms</option>
                        <option <?=$role =='Resent business occupant sms'?'selected == selected':''; ?> value="Resent business occupant sms">Resent business occupant sms</option>
                        <option <?=$role =='Added a product'?'selected == selected':''; ?> value="Added a product">Added a product</option>
                        <option <?=$role =='Added product category 1'?'selected == selected':''; ?> value="Added product category 1">Added product category 1</option>
                        <option <?=$role =='Added product category 2'?'selected == selected':''; ?> value="Added product category 2">Edited category 2</option>
                        <option <?=$role =='Added product category 3'?'selected == selected':''; ?> value="Added product category 3">Edited category 3</option>
                        <option <?=$role =='Added product category 4'?'selected == selected':''; ?> value="Added product category 4">Edited category 4</option>
                        <option <?=$role =='Added product category 5'?'selected == selected':''; ?> value="Added product category 5">Edited category 5</option>
                        <option <?=$role =='Added product category 6'?'selected == selected':''; ?> value="Added product category 6">Edited category 6</option>
                        <option <?=$role =='Edited product name'?'selected == selected':''; ?> value="Edited product name">Edited product name</option>
                        <option <?=$role =='Edited product category 1'?'selected == selected':''; ?> value="Edited product category 1">Edited product category 1</option>
                        <option <?=$role =='Edited product category 2'?'selected == selected':''; ?> value="Edited product category 2">Edited product category 2</option>
                        <option <?=$role =='Edited product category 3'?'selected == selected':''; ?> value="Edited product category 3">Edited product category 3</option>
                        <option <?=$role =='Edited product category 4'?'selected == selected':''; ?> value="Edited product category 4">Edited cproduct ategory 4</option>
                        <option <?=$role =='Edited product category 5'?'selected == selected':''; ?> value="Edited product category 5">Edited product category 5</option>
                        <option <?=$role =='Edited product category 6'?'selected == selected':''; ?> value="Edited product category 6">Edited product category 6</option>
                        <option <?=$role =='Added a penalty'?'selected == selected':''; ?> value="Added a penalty">Added a penalty</option>
                        <option <?=$role =='Updated Cheque Status'?'selected == selected':''; ?> value="Updated Cheque Status">Updated Cheque Status</option>
                        <option <?=$role =='Made a payment'?'selected == selected':''; ?> value="Made a payment">Made a payment</option>
                        <option <?=$role =='Accessed a property'?'selected == selected':''; ?> value="Accessed a property">Accessed a property</option>
                    </select>
                  </div>
                  <div class="col-lg-3 criteria" id="#">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category" name="category">
                        <option value="">Select Collector Category</option>
                        <option <?=$category =='agent'?'selected == selected':''; ?> value="agent">Agent</option>
                        <option <?=$category =='admin'?'selected == selected':''; ?> value="admin">Admin</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group m-form__group row">
                  <div class="col-lg-3" id="agent" style="display:none;">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="agentid" name="agent">
                        <option value="">Select Agent</option>
                        <?php foreach($agent as $agent): ?>
                        <option <?=$agents == $agent->id?'selected == selected':''; ?> value="<?=$agent->id?>"><?= $agent->firstname.' '.$agent->lastname.' ('.$agent->agent_code.')'?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-3" id="admin" style="display:none;">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="adminid" name="user">
                        <option value="">Select Admin</option>
                        <?php foreach($user as $user): ?>
                        <option <?=$users == $user->id?'selected == selected':''; ?> value="<?=$user->id?>"><?= $user->firstname.' '.$user->lastname.' ('.$user->username.')'?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="channel" name="channel">
                        <option value="">Select Channel</option>
                        <option <?=$channel =='Web'?'selected == selected':''; ?> value="Web">Web</option>
                        <option <?=$channel =='Mobile App'?'selected == selected':''; ?> value="Mobile App">Mobile App</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <button type="submit" id="save" class="btn btn-success">
                      Search
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-audit">
              <thead>
                <tr>
                  <th class="text-center">DATE/TIME</th>
                  <th class="text-center">USERNAME</th>
                  <th class="text-center">ACTIVITY</th>
                  <th class="text-center">DESCRIPTION</th>
                  <th class="text-center">STATUS</th>
                  <th class="text-center">CHANNEL</th> 
                </tr>
              </thead>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
