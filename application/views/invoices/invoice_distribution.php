<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <form method="POST" action="<?= base_url('Invoice/search_invoice_distribution')?>" autocomplete="off">
            <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
              <div class="col-lg-12">
                <div class="form-group m-form__group row">
                    <div class="col-lg-3 criteria" id="#">
                        <input type="date" class=" form-control" id="start_date" name="start_date" value="<?=$start_date?>" placeholder="Enter Start Date" required>
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" value="<?=$end_date?>">
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="product" name="product">
                            <option value="">Select Bill Type</option> 
                            <?php foreach($products as $p){ ?>
                                <option <?=$bill_type == $p->id?'selected == selected':''; ?> value="<?= $p->id?>"><?=$p->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="electoral_area" name="electoral_area">
                            <option value="">SELECT ELECTORAL AREA</option>
                            <?php foreach($area as $a){ ?>
                                <option <?=$electoral_area == $a->id?'selected == selected':''; ?> value="<?= $a->id?>"><?=$a->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="town" name="town">
                            <option value="0">SELECT TOWN</option>
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
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-invoice-distribution">
            <thead>
              <tr>
                <th class="text-center">INVOICE NO</th>
                <th class="text-center">BILL TYPE</th>
                <th class="text-center">ELECTORAL AREA/TOWN</th>
                <th class="text-center">RECIPIENT NAME</th>
                <th class="text-center">RECIPIENT PHONE</th>
                <th class="text-center">RECIPIENT POSITION</th>
                <th class="text-center">REMARK</th>
                <th class="text-center">DEILIVERED BY</th>
                <th class="text-center">DATETIME DELIVERED</th>
              </tr>
            </thead>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->