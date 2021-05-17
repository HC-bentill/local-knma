<style type="text/css">
    .owner_reside{
        display:none;
    }
    .owner_reside_not{
        display:none;
    }

</style>
<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
                <form class="form-horizontal form-bordered" method="post" action="<?=base_url()?>Penalty/insert_penalty" >
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-lg-right pt-2">Product</label>
                        <div class="col-lg-4">
                            <select data-plugin-selectTwo class="form-control populate productname" name="productname" required>
                                <option value="">Select an option</option>
                                <?php foreach($products as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-lg-2 control-label text-lg-right pt-2">Penalty Mode</label>
                        <div class="col-lg-4">
                            <select data-plugin-selectTwo class="form-control populate" name="penalty_mode" id="penalty_mode" required>
                                <option value="">Select an option</option>
                                <option value="Fixed">Fixed Amount</option>
                                <option value="Percentage">Percentage</option>
                                <option value="Fixed_Percentage">Fixed + Percentage</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 control-label text-lg-right pt-2">
                            Apply penalty to sub-category <br /><br />
                            <i class="subcat">(Select Category you want to apply this penalty to)</i>
                        </label>
                        <div class="col-lg-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="apply" name="apply" id="apply" >
                                </label>
                            </div>
                        </div>

                        <label class="col-lg-2 control-label text-lg-right pt-2 hidden amount" for="amount">Amount</label>
                        <div class="col-lg-4 hidden amount">
                            <input type="number" class="form-control" name="amount" id="amount" required />
                        </div>

                        <label class="col-lg-2 control-label text-lg-right pt-2 hidden percentage" for="percentage">Percentage</label>
                        <div class="col-lg-4 hidden percentage">
                            <input type="number" class="form-control" max="100" name="percentage" id="percentage" required />
                        </div>

                        <label class="col-lg-2 control-label text-lg-right pt-2 fixed_percentage hidden" for="fixed_percentage">Amount + Percentage</label>
                        <div class="col-lg-2  fixed_percentage hidden">
                            <input type="number" class="form-control" name="fp_amount" placeholder="Amount" id="fp_amount" required />
                        </div>
                        <div class="col-lg-2 fixed_percentage hidden">
                            <input type="number" class="form-control" max="100" name="fp_percentage" placeholder="Percentage" id="fp_percentage" required />
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="1">&nbsp; Category 1</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category1_name" name="category1_name">
                                <option value="">Select an option</option>
                                <?php foreach($category1_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>


                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="2">&nbsp; Category 2</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category2_name" name="category2_name">
                                <option value="">Select an option</option>
                                <?php foreach($category2_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="3">&nbsp; Category 3</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category3_name" name="category3_name">
                                <option value="">Select an option</option>
                                <?php foreach($category3_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="4">&nbsp; Category 4</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category4_name" name="category4_name">
                                <option value="">Select an option</option>
                                <?php foreach($category4_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="5">&nbsp; Category 5</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category5_name" name="category5_name">
                                <option value="">Select an option</option>
                                <?php foreach($category5_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="6">&nbsp; Category 6</label>
                        <div class="col-lg-4 subcat">
                            <select data-plugin-selectTwo class="form-control populate category6_name" name="category6_name">
                                <option value="">Select an option</option>
                                <?php foreach($category6_list as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row subcat">
                        <label class="col-lg-2 control-label text-lg-right pt-2 subcat"><input type="radio" name="subcat_level" value="">&nbsp; None</label>

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

        </section>
    </div>
</div>
