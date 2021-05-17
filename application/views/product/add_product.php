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
                        <li class="nav-item active">
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
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>add_category6"><i class="fa fa-window-restore"></i> Category6</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="product" class="tab-pane active">
                            <form class="form-horizontal form-bordered" method="post" action="<?=base_url()?>Product/insert_product" >
                                <div class="form-group row">
                                    <label class="col-lg-3 control-label text-lg-right pt-2" for="productname">Product Name</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" name="productname" required />
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
