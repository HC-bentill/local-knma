<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>accessed_property"><i class="fa fa-btc"></i>Business Property</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=base_url()?>accessed_business_occupant"><i class="fa fa-usd"></i>Business Occupant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>accessed_residence"><i class="fa fa-university"></i>Residence</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="product" class="tab-pane active">
                            <form class="form-horizontal form-bordered" method="post" action="<?=base_url()?>Invoice/insert_accessed_property" >
                              <div class="form-group row">
                                  <label class="col-lg-3 control-label text-lg-right pt-2">Choose Product</label>
                                  <div class="col-lg-6">
                                      <select data-plugin-selectTwo class="form-control" name="product" id="product" required>
                                        <option value="">Select an option</option>
                                        <?php foreach($product as $p){ ?>
                                          <option value="<?= $p->id?>"><?=$p->name?></option>
                                        <?php } ?>
                                      </select>
                                  </div>
                              </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2">Choose Business Occupant</label>
                                    <div class="col-lg-6">
                                        <select data-plugin-selectTwo class="form-control" name="property_id" id="property_id" required>
                                          <option value="">Select an option</option>
                                          <?php foreach($result as $r){ ?>
                                            <option value="<?= $r->id?>"><?=$r->buis_occ_code.' - '.$r->buis_name?></option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="productname">Rateable Amount</label>
                                    <div class="col-lg-6">
                                        <input type="number" step=".01" class="form-control" name="rateable_amount" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="productname">Rate</label>
                                    <div class="col-lg-6">
                                        <input type="number" step=".001" class="form-control" name="rate" required />
                                    </div>
                                </div>
                                <div class="form-group row" style="display:none;">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="target">Target</label>
                                    <div class="col-lg-6">
                                        <input type="number" value="3" class="form-control" name="target" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="mb-1 mt-1 mr-1 btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>
        </section>
        </div>
</div>
