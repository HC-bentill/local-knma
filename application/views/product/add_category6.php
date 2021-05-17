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

</style>
<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">

                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_product"><i class="fa fa-product-hunt"></i> Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category1"><i class="fa fa-window-restore"></i> Category1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category2"><i class="fa fa-window-restore"></i> Category2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category3"><i class="fa fa-window-restore"></i> Category3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category4"><i class="fa fa-window-restore"></i> Category4</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category5"><i class="fa fa-window-restore"></i> Category5</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=base_url()?>add_category6"><i class="fa fa-window-restore"></i> Category6</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="category6" class="tab-pane active">
                            <form class="form-horizontal form-bordered" method="post" action="<?=base_url()?>Product/insert_category6">
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Product</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate productname" name="productname">
                                            <option value="">Select an option</option>
                                            <?php foreach($products as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="frequency">Frequency</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate" name="frequency">
                                            <option>NON RECURRING</option>
                                            <option>RECURRING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Category 1</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate category1_name" name="category1_name">
                                            <option value="">Select an option</option>
                                            <?php foreach($category1_list as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="frequency">Unit of Measure</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate" name="unit_of_measure">
                                            <option>Per Annum </option>
                                            <option>Per m2 </option>
                                            <option>PerDay</option>
                                            <option>Per m2  per annum</option>
                                            <option>Dependent on class of access </option>
                                            <option>Onetime</option>
                                            <option>Per Annum /per mast </option>
                                            <option>Per burial </option>
                                            <option>Per Court Order </option>
                                            <option>One Week </option>
                                            <option>Per Month </option>
                                            <option>Per Visit </option>
                                            <option>Per Day </option>
                                            <option>Per animal </option>
                                            <option>Per bird </option>
                                            <option>Per 100 Culms </option>
                                            <option>Per Bundle </option>
                                            <option>Per Maxi bag </option>
                                            <option>Per Mini bag </option>
                                            <option>Per bag </option>
                                            <option>Per load </option>
                                            <option>Per sack</option>
                                            <option>Per bag/ Per container </option>
                                            <option>100 pieces </option>
                                            <option>Maxi bag </option>
                                            <option>Mini bag </option>
                                            <option>Per basket</option>
                                            <option>Per one</option>
                                            <option>Per gallon</option>
                                            <option>Daily parking </option>
                                            <option>monthly</option>
                                            <option>Per day/night </option>
                                            <option>Per Reg.  </option>
                                            <option>Per Doc.  </option>
                                            <option>Per 30 Mins. </option>
                                            <option>First 1 hour </option>
                                            <option>Second Hour </option>
                                            <option>Every hour above 2 hours </option>
                                            <option>Per week  </option>
                                            <option>per head load</option>
                                            <option>Per Trip </option>
                                            <option>PerCase</option>
                                            <option>PerTree</option>
                                            <option>PerAnimal</option>
                                            <option>PerHour/Case</option>
                                            <option>Overnight</option>
                                            <option>Per Project</option>
                                            <option>Per metre </option>
                                            <option>PerMonth</option>
                                            <option>4x4ft</option>
                                            <option>Per event</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Category 2</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate category2_name" name="category2_name">
                                            <option value="">Select an option</option>
                                            <?php foreach($category2_list as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="price1">Price 1</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="price1" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Category 3</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate category3_name" name="category3_name">
                                            <option value="">Select an option</option>
                                            <?php foreach($category3_list as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="price2">Price 2</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="price2" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Category 4</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate category4_name" name="category4_name">
                                            <option value="">Select an option</option>
                                            <?php foreach($category4_list as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="price3">Price 3</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="price3" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2">Category 5</label>
                                    <div class="col-lg-4">
                                        <select data-plugin-selectTwo class="form-control populate category5_name" name="category5_name">
                                            <option value="">Select an option</option>
                                            <?php foreach($category5_list as $a){ ?>
                                                <option value="<?= $a->id?>"><?=$a->name?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="price4">Price 4</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="price4" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 control-label text-lg-right pt-2" for="category6_name">Category 6 Name</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" name="category6_name" />
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
