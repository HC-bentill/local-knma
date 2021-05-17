<style type="text/css">
    .owner_reside{
        display:none;
    }
    .owner_reside_not{
        display:none;
    }
    .nav-item{
        width: 170px;
    }
    .padding-top-10{
        padding-top: 10px;
    }

</style>
<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">

                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=base_url()?>add_product"><i class="fa fa-product-hunt"></i> Product</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="product" class="tab-pane active">
                            <form class="form-horizontal form-bordered" method="post" action="<?=base_url()?>Product/update_cat6" >
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="productname">Product Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_product_name($result[0]->product_id) ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="category1_name">Category 1 Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_category_name($result[0]->category1_id, 1); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="category2_name">Category 2 Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_category_name($result[0]->category2_id, 2); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="category3_name">Category 3 Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_category_name($result[0]->category3_id, 3); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="category4_name">Category 4 Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_category_name($result[0]->category4_id, 4); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="category5_name">Category 5 Name</label>
                                    <div class="col-lg-6 padding-top-10">
                                        <span><?=get_category_name($result[0]->category4_id, 5); ?></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="cat6name">Category 6 Name</label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="id" value="<?=$result[0]->id; ?>">
                                        <input type="text" class="form-control" name="cat6name" value="<?=$result[0]->name; ?>" required />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Frequency</label>
                                    <div class="col-lg-6">
                                        <select data-plugin-selectTwo class="form-control populate" name="frequency">
                                            <option <?php echo ($result[0]->frequency == 'NON RECURRING') ? 'selected="selected"' : '' ?>>NON RECURRING</option>
                                            <option <?php echo ($result[0]->frequency == 'RECURRING') ? 'selected="selected"' : '' ?>>RECURRING</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Unit of Measure</label>
                                    <div class="col-lg-6">
                                        <select data-plugin-selectTwo class="form-control populate" name="unit_of_measure">
                                            <option <?php echo ($result[0]->frequency == 'Per Annum') ? 'selected="selected"' : '' ?>>Per Annum </option>
                                            <option <?php echo ($result[0]->frequency == 'Per m2') ? 'selected="selected"' : '' ?>>Per m2 </option>
                                            <option <?php echo ($result[0]->frequency == 'PerDay') ? 'selected="selected"' : '' ?>>PerDay</option>
                                            <option <?php echo ($result[0]->frequency == 'Per m2  per annum') ? 'selected="selected"' : '' ?>>Per m2  per annum</option>
                                            <option <?php echo ($result[0]->frequency == 'Dependent on class of access </opti') ? 'selected="selected"' : '' ?>>Dependent on class of access </option>
                                            <option <?php echo ($result[0]->frequency == 'Onetime') ? 'selected="selected"' : '' ?>>Onetime</option>
                                            <option <?php echo ($result[0]->frequency == 'Per Annum /per mast') ? 'selected="selected"' : '' ?>>Per Annum /per mast </option>
                                            <option <?php echo ($result[0]->frequency == 'Per burial') ? 'selected="selected"' : '' ?>>Per burial </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Court Order') ? 'selected="selected"' : '' ?>>Per Court Order </option>
                                            <option <?php echo ($result[0]->frequency == 'One Week') ? 'selected="selected"' : '' ?>>One Week </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Month') ? 'selected="selected"' : '' ?>>Per Month </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Visit') ? 'selected="selected"' : '' ?>>Per Visit </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Day') ? 'selected="selected"' : '' ?>>Per Day </option>
                                            <option <?php echo ($result[0]->frequency == 'Per animal') ? 'selected="selected"' : '' ?>>Per animal </option>
                                            <option <?php echo ($result[0]->frequency == 'Per bird') ? 'selected="selected"' : '' ?>>Per bird </option>
                                            <option <?php echo ($result[0]->frequency == 'Per 100 Culms') ? 'selected="selected"' : '' ?>>Per 100 Culms </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Bundle') ? 'selected="selected"' : '' ?>>Per Bundle </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Maxi bag') ? 'selected="selected"' : '' ?>>Per Maxi bag </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Mini bag') ? 'selected="selected"' : '' ?>>Per Mini bag </option>
                                            <option <?php echo ($result[0]->frequency == 'Per bag') ? 'selected="selected"' : '' ?>>Per bag </option>
                                            <option <?php echo ($result[0]->frequency == 'Per load') ? 'selected="selected"' : '' ?>>Per load </option>
                                            <option <?php echo ($result[0]->frequency == 'Per sack') ? 'selected="selected"' : '' ?>>Per sack</option>
                                            <option <?php echo ($result[0]->frequency == 'Per bag/ Per container') ? 'selected="selected"' : '' ?>>Per bag/ Per container </option>
                                            <option <?php echo ($result[0]->frequency == '100 pieces') ? 'selected="selected"' : '' ?>>100 pieces </option>
                                            <option <?php echo ($result[0]->frequency == 'Maxi bag') ? 'selected="selected"' : '' ?>>Maxi bag </option>
                                            <option <?php echo ($result[0]->frequency == 'Mini bag') ? 'selected="selected"' : '' ?>>Mini bag </option>
                                            <option <?php echo ($result[0]->frequency == 'Per basket') ? 'selected="selected"' : '' ?>>Per basket</option>
                                            <option <?php echo ($result[0]->frequency == 'Per one') ? 'selected="selected"' : '' ?>>Per one</option>
                                            <option <?php echo ($result[0]->frequency == 'Per gallon') ? 'selected="selected"' : '' ?>>Per gallon</option>
                                            <option <?php echo ($result[0]->frequency == 'Daily parking') ? 'selected="selected"' : '' ?>>Daily parking </option>
                                            <option <?php echo ($result[0]->frequency == 'monthly') ? 'selected="selected"' : '' ?>>monthly</option>
                                            <option <?php echo ($result[0]->frequency == 'Per day/night') ? 'selected="selected"' : '' ?>>Per day/night </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Reg. ') ? 'selected="selected"' : '' ?>>Per Reg.  </option>
                                            <option <?php echo ($result[0]->frequency == 'Per Doc. ') ? 'selected="selected"' : '' ?>>Per Doc.  </option>
                                            <option <?php echo ($result[0]->frequency == 'Per 30 Mins.') ? 'selected="selected"' : '' ?>>Per 30 Mins. </option>
                                            <option <?php echo ($result[0]->frequency == 'First 1 hour') ? 'selected="selected"' : '' ?>>First 1 hour </option>
                                            <option <?php echo ($result[0]->frequency == 'Second Hour') ? 'selected="selected"' : '' ?>>Second Hour </option>
                                            <option <?php echo ($result[0]->frequency == 'Every hour above 2 hours') ? 'selected="selected"' : '' ?>>Every hour above 2 hours </option>
                                            <option <?php echo ($result[0]->frequency == 'Per week ') ? 'selected="selected"' : '' ?>>Per week  </option>
                                            <option <?php echo ($result[0]->frequency == 'per head load') ? 'selected="selected"' : '' ?>>per head load</option>
                                            <option <?php echo ($result[0]->frequency == 'Per Trip') ? 'selected="selected"' : '' ?>>Per Trip </option>
                                            <option <?php echo ($result[0]->frequency == 'PerCase') ? 'selected="selected"' : '' ?>>PerCase</option>
                                            <option <?php echo ($result[0]->frequency == 'PerTree') ? 'selected="selected"' : '' ?>>PerTree</option>
                                            <option <?php echo ($result[0]->frequency == 'PerAnimal') ? 'selected="selected"' : '' ?>>PerAnimal</option>
                                            <option <?php echo ($result[0]->frequency == 'PerHour/Case') ? 'selected="selected"' : '' ?>>PerHour/Case</option>
                                            <option <?php echo ($result[0]->frequency == 'Overnight') ? 'selected="selected"' : '' ?>>Overnight</option>
                                            <option <?php echo ($result[0]->frequency == 'Per Project') ? 'selected="selected"' : '' ?>>Per Project</option>
                                            <option <?php echo ($result[0]->frequency == 'Per metre') ? 'selected="selected"' : '' ?>>Per metre </option>
                                            <option <?php echo ($result[0]->frequency == 'PerMonth') ? 'selected="selected"' : '' ?>>PerMonth</option>
                                            <option <?php echo ($result[0]->frequency == '4x4ft') ? 'selected="selected"' : '' ?>>4x4ft</option>
                                            <option <?php echo ($result[0]->frequency == 'Per event') ? 'selected="selected"' : '' ?>>Per event</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="price1">Price 1</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="price1" value="<?=$result[0]->price1; ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="price2">Price 2</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="price2" value="<?=$result[0]->price2; ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="price3">Price 3</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="price3" value="<?=$result[0]->price3; ?>" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="price4">Price 4</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="price4" value="<?=$result[0]->price4; ?>"/>
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
