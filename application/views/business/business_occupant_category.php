
  <!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('Business/search_busocc_category')?>" autocomplete="off">
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
                    <input type="text" class="form-control" id="search_item" placeholder="Search by business property code, etc" name="keyword" value="<?=$keyword?>">
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
                  <th class="text-center">BUSINESS CODE</th>
                  <th class="text-center">BUSINESS NAME</th>
                  <th class="text-center">CATEGORY 1</th>
                  <th class="text-center">CATEGORY 2</th>
                  <th class="text-center">CATEGORY 3</th>
                  <th class="text-center">CATEGORY 4</th>
                  <th class="text-center">CATEGORY 5</th>
                  <th class="text-center">CATEGORY 6</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td class="text-center">
                      <a style="text-decoration: none;" href='<?= base_url().'Business/edit_business_occupant_form/'.$value->id?>'><?= $value->buis_occ_code ?></a>
                    </td>
                    <td class="text-center"><?= $value->buis_name ?></td>
                    <td class="text-center"><?= $value->category1 ?></td>
                    <td class="text-center"><?= $value->category2 ?></td>
                    <td class="text-center"><?= $value->category3 ?></td>
                    <td class="text-center"><?= $value->category4 ?></td>
                    <td class="text-center"><?= $value->category5 ?></td>
                    <td class="text-center"><?= $value->category6 ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
