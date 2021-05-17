<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
            <form method="POST" action="<?= base_url('Invoice/search_invoice')?>" autocomplete="off">
              <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
                <div class="col-lg-12">
                  <div class="form-group m-form__group row">
                    <div class="col-lg-3" style="display:none">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="search_by" name="search_by">
                            <option <?=$search_by =='Criteria'?'selected == selected':''; ?> value="Criteria">Search By Criteria</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                      <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" name="year">
                        <option value="">Select Year</option> 
                        <?php $current_year = date("Y");?>
                        <?php for($i=2017; $i<=$current_year; $i++): ?>
                          <option <?=$year == $i?'selected == selected':''; ?> value="<?=$i?>"><?=$i?></option>
                        <?php endfor; ?> 
                              
                      </select>
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="product" name="product">
                            <option value="">Select Product</option> 
                            <?php foreach($products as $p){ ?>
                                <option <?=$product == $p->id?'selected == selected':''; ?> value="<?= $p->id?>"><?=$p->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category1" name="category1">
                            <option value="0">Select Category 1</option>                       
                        </select>
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category2" name="category2">
                            <option value="0">Select Category 2</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-3" id="search_box">
                      <input type="hidden" value="<?=$category1?>" class="form-control" id="category1s" name="category1s">
                      <input type="hidden" value="<?=$category2?>" class="form-control" id="category2s" name="category2s">
                      <input type="hidden" value="<?=$category3?>" class="form-control" id="category3s" name="category3s">
                      <input type="hidden" value="<?=$category4?>" class="form-control" id="category4s" name="category4s">
                      <input type="hidden" value="<?=$category5?>" class="form-control" id="category5s" name="category5s">
                      <input type="hidden" value="<?=$category6?>" class="form-control" id="category6s" name="category6s">
                      <input type="hidden" value="<?=$category5s?>" class="form-control" id="category5ss" name="category5ss">
                      <input type="hidden" value="<?=$category6s?>" class="form-control" id="category6ss" name="category6ss">
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category3" name="category3">
                            <option value="0">Select Category 3</option>
                        </select> 
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category4" name="category4">
                            <option value="0">Select Category 4</option>
                        </select> 
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category5" name="category5">
                            <option value="0">Select Category 5</option>
                        </select> 
                    </div>
                    <div class="col-lg-3 criteria" id="#">
                        <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="category6" name="category6">
                            <option value="0">Select Category 6</option>
                        </select> 
                    </div>
                  </div>
                  <div class="form-group m-form__group row">
                    
                    <div class="col-lg-3">
                      <button type="submit" id="save" class="btn btn-success">
                        Search
                      </button>
                      <?php if(has_permission($this->session->userdata('user_info')['id'],'generate invoices')){ ?>
                        <a href="<?=base_url("BillGeneration/generate_ungenerate_invoice")?>" class="btn btn-primary">
                          Generate Invoice
                        </a>
                      <?php }else{ ?>

                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools-invoices">
              <thead>
                <tr>
                  <th class="text-center">INVOICE NO</th>
                  <th class="text-center">PROPERTY CODE</th>
                  <th class="text-center">IDENTIFIER</th>
                  <th class="text-center">PRODUCT</th>
                  <th class="text-center">INVOICE AMOUNT</th>
                  <th class="text-center">DISCOUNT</th>
                  <th class="text-center">AMOUNT PAID</th>
                  <th class="text-center">OUTSTANDING AMOUNT</th>
                  <th class="text-center">VALUATION STATUS</th>
                  <th class="text-center">CATEGORY 1</th>
                  <th class="text-center">CATEGORY 2</th>
                  <th class="text-center">CATEGORY 3</th>
                  <th class="text-center">CATEGORY 4</th>
                  <th class="text-center">CATEGORY 5</th>
                  <th class="text-center">CATEGORY 6</th>
                  <th class="text-center">PRINT STATUS</th>
                  <th class="text-center">DATE GENERATED</th>
                  <th class="text-center">PAYMENT DUE DATE</th>
                </tr>
               </thead>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
