<div class="row">
  <div class="col-lg-12 mb-3">
    <section class="card card-featured-bottom card-featured-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-12">
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Ownership Category:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Household">Household</option>
                  <option value="Business Occupant">Business Occupant</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Enter Generated Code:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Personal Category:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Owner">Owner</option>
                  <option value="Caretaker">Caretaker</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Managed By Self:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Contact:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Firstname:</strong></label>
                <input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" autocomplete="off"/>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Lastname:</strong></label>
                <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Does Owner Reside In District:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Location:</strong></label>
                <input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" autocomplete="off"/>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner District:</strong></label>
                <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Region:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="owner_region" name="owner_region" required="">
                      <option value="">SELECT OPTION</option>
                      <option value="Greater Accra">Greater Accra</option>
                      <option value="Western">Western</option>
                      <option value="Central">Central</option>
                      <option value="Eastern">Eastern</option>
                      <option value="Nothern">Nothern</option>
                      <option value="Upper East">Upper East</option>
                      <option value="Upper West">Upper West</option>
                      <option value="Volta">Volta</option>
                      <option value="Ashanti">Ashanti</option>
                      <option value="Brong Ahafo">Brong Ahafo</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Area Council:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 10 }" class="form-control" id="owner_area_council" name="owner_area_council">
                  <option value="">SELECT OPTION</option>
                  <?php foreach($area as $a){ ?>
                    <option value="<?= $a->id?>"><?=$a->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Owner Town:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="owner_town" name="owner_town">
                  <option value="">SELECT OPTION</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Caretaker Contact:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Caretaker Firstname:</strong></label>
                <input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" autocomplete="off"/>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Caretaker Lastname:</strong></label>
                <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Area Council:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="area_council" name="area_council" required="">
                  <option value="">SELECT OPTION</option>
                  <?php foreach($area as $a){ ?>
                    <option value="<?= $a->id?>"><?=$a->name?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Town:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                    <option value="">SELECT OPTION</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Transport Medium Type:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                    <option value="">SELECT OPTION</option>
                    <?php foreach($transport_meduim as $t){ ?>
                      <option value="<?= $t->id?>"><?=$t->meduim?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Specify Transport Meduim:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Mode Of Transmission:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Manual">Manual</option>
                  <option value="Auto-Fueled">Auto-Fueled</option>
                  <option value="Automatic">Automatic</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Fuel Type:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Gas">Gas</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Size/Dimension:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Small-Truck">Small-Truck</option>
                  <option value="Medium-Truck">Medium-Truck</option>
                  <option value="Large-Truck">Large-Truck</option>
                  <option value="SUV">SUV</option>
                  <option value="SUV-4x4">SUV-4x4</option>
                  <option value="4x4">4x4</option>
                  <option value="Saloon">Saloon</option>
                  <option value="Pickup">Pickup</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Make:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                  <?php foreach($make as $m){ ?>
                    <option value="<?= $m->id?>"><?=$m->make?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Model:</strong></label>
                <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Year Of Manufacture:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Engine Capacity:</strong></label>
                <input type="text" class="form-control" id="buis_secondary_contact" name="buis_secondary_contact" autocomplete="off"/>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>No Of Outboard Motors:</strong></label>
                <input type="text" class="form-control" id="buis_name" name="buis_name" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Registration No:</strong></label>
                <input type="text" class="form-control" id="buis_primary_contact" name="buis_primary_contact" autocomplete="off" required/>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Purpose:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                  <option value="Private">Private</option>
                  <option value="Commercial">Commercial</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Transport Category:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                </select>
              </div>
              <div class="col-sm-4">
                <label class="control-label text-sm-right pt-2"><strong>Transport Sub-Category:</strong></label>
                <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town"required="">
                  <option value="">SELECT OPTION</option>
                </select>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
