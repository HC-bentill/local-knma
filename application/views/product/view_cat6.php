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
                            <a class="nav-link"><i class="fa fa-product-hunt"></i> Category 6</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="product" class="tab-pane active">
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="productname">Product Name></label>
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
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="category6_name">Category 6 Name</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->name; ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Frequency</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->frequency; ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Unit of Measure</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->unit_of_measure; ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Price 1</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->price1; ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Price 2</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->price2; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Price 3</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->price3; ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="frequency">Price 4</label>
                                <div class="col-lg-6 padding-top-10">
                                    <span><?=$result[0]->price4; ?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <a href="<?=base_url()?>edit_cat6/<?=$result[0]->id; ?>" class="mb-1 mt-1 mr-1 btn btn-primary">Edit</a>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>
</div>
