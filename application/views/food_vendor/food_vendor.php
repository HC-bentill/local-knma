<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('Food/search_food_vendor')?>" autocomplete="off">
            <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
              <div class="col-lg-12">
                <div class="form-group m-form__group row">
                  <div class="col-lg-3">
                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_by" name="search_by">
                        <option value="">Select Option</option>
                        <option <?=$search_by =='Date'?'selected == selected':''; ?> value="Date">Search By Date</option>
                        <option <?=$search_by =='Keyword'?'selected == selected':''; ?> value="Keyword">Search By Keyboard</option>
                    </select>
                  </div>
                  <div class="col-lg-3" id="date1">
                    <input type="date" class=" form-control" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                  </div>
                  <div class="col-lg-3" id="date2">
                    <input type="date" class="form-control" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
                  </div>
                  <div class="col-lg-3" id="search_box" style="display:none;">
                    <input type="text" class="form-control" id="search_item" placeholder="Search by business property code" name="keyword" value="<?=$keyword?>">
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
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th class="text-center">VENDOR CODE</th>
                  <th class="text-center">NAME</th>
                  <th class="text-center">PHONE NO</th>
                  <th class="text-center">AREA COUNCIL</th>
                  <th class="text-center">TOWN</th>
                  <th class="text-center">VENDING POINT</th>
                  <th class="text-center">SERVICE TIME</th>
                  <th class="text-center">FOOD TYPE</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td class="text-center">
                      <a style="text-decoration: none;" href='<?= base_url().'Food/edit_food_vendor_form/'.$value->id?>'><?= $value->fv_code ?></a>
                    </td>
                    <td class="text-center"><?= $value->firstname.' '.$value->lastname ?></td>
                    <td class="text-center"><?= $value->phoneno ?></td>
                    <td class="text-center"><?= $value->area ?></td>
                    <td class="text-center"><?= $value->tt?></td>
                    <td class="text-center"><?= $value->vending_point?></td>
                    <td class="text-center"><?= $value->service_time ?></td>
                    <td class="text-center"><?= $value->food_type == "Others"?$value->others:$value->food_type?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
