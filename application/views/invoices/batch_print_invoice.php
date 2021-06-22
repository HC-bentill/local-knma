<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
            <form method="POST" action="<?= base_url('Invoice/save_batch_print_invoice')?>" autocomplete="off">
              <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
                <div class="col-lg-12">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-3 criteria" id="#">
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="product" name="product">
                                <option value="">Select Bill Type</option> 
                                <?php foreach($products as $p){ ?>
                                    <option value="<?= $p->id?>"><?=$p->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-3 criteria" id="#">
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category1" name="category1">
                                <option value="0">Select Category 1</option>                       
                            </select>
                        </div>
                        <div class="col-lg-3">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="year" required>
                            <option value="">Select Year</option> 
                            <?php $current_year = date("Y");?>
                            <?php for($i=2017; $i<=$current_year; $i++): ?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php endfor; ?>   
                        </select>
                        </div>
                        <div class="col-lg-3 criteria" id="#">
                            <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="electoral_area" name="electoral_area">
                                <option value="">SELECT ELECTORAL AREA</option>
                                <?php foreach($area as $a){ ?>
                                    <option value="<?= $a->id?>"><?=$a->name?></option>
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
                                Save
                            </button>
                        </div>
                    </div>
                </div>
              </div>
            </form>
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                <thead>
                    <tr>
                        <th class="text-center">BATCH NO</th>
                        <th class="text-center">BILL TYPE</th>
                        <th class="text-center">CATEGORY 1</th>
                        <th class="text-center">YEAR</th>
                        <th class="text-center">ELECTORAL</th>
                        <th class="text-center">TOWN</th>
                        <th class="text-center">DATETIME CREATED</th>
                        <th class="text-center" colspan="2">ACTION</th>
                        <th class="text-center" style="display: none"></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $value):?>
                        <tr>
                            <td><?= $value->batch_no ?></td>
                            <td><?= $value->name ?></td>
                            <td><?= $value->category1 ?></td>
                            <td><?= $value->year ?></td>
                            <td><?= $value->area ?></td>
                            <td><?= $value->town ?></td>
                            <td><?= date("Y-m-d H:i:s",strtotime($value->datetime_created)) ?></td>
                            <td>
                                <?php $invoice_number = 0;?>
                                <form method="post" target="_blank" action="<?=base_url()?>Invoice/print_batch_invoice">
                                    <input type="hidden" name="product" value="<?= $value->product_id ?>">
                                    <input type="hidden" name="category1" value="<?= $value->category1_id ?>">
                                    <input type="hidden" name="year" value="<?=$value->year?>">
                                    <input type="hidden" name="electoral_area" value="<?=$value->area_id?>">
                                    <input type="hidden" name="town" value="<?=$value->town_id?>">
                                    <input type="hidden" name="offset" value="0">
                                    <input type="hidden" name="spool" value="500">
                                    <input type="hidden" name="template" value="wtemplate">
                                    <input type="hidden" name="invoice_number" value="<?=$invoice_number?>">
                                    <button type="submit" class="btn btn-info" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Save to PDF/Print without Template"><span class="fa fa-print"></span></button>
                                </form>
                            </td>
                            <td>
                                <form method="post" target="_blank" action="<?=base_url()?>Invoice/print_batch_invoice">
                                    <input type="hidden" name="product" value="<?= $value->product_id ?>">
                                    <input type="hidden" name="category1" value="<?= $value->category1_id ?>">
                                    <input type="hidden" name="year" value="<?=$value->year?>">
                                    <input type="hidden" name="electoral_area" value="<?=$value->area_id?>">
                                    <input type="hidden" name="town" value="<?=$value->town_id?>">
                                    <input type="hidden" name="offset" value="0">
                                    <input type="hidden" name="spool" value="50">
                                    <input type="hidden" name="template" value="template">
                                    <input type="hidden" name="invoice_number" value="<?=$invoice_number?>">
                                    <button type="submit" class="btn btn-success" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Save to PDF/Print with Template"><span class="fa fa-print"></span></button>
                                </form>
                            </td>
                            <td style="display: none"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->