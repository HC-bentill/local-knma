<?php $this->load->view('residence/map.css') ?>
<!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <div class="card-body">
          <a class="btnshowMapFilters" href="#" style="position: absolute;right:85px; z-index: 999; margin-top: 2em">
              <img src="<?=base_url("assets/icon.png")?>" style="width: 40px; height: 40px; filter: grayscale(100%);">
          </a>

          <div id="showMapFilters" style="display:none; background-color:#ddd; width: 20em; position: absolute; top:20;left:60;right:0px; z-index: 999;opacity: 0.9; margin-top: 0em;height:100%;">
            <div class="container" style="margin: 1em; margin-right:1em">
              <form action="map" method="get" style="padding-right:1em">
                                
                <div class="row">
                    <a href="#" class="btnshowMapFilters" style="font-size:1.5em; xmargin-left:9em">X</a>
                </div>
                <hr>
                <input type="hidden" value="1" name="searchRecord">
                <b>Key Filters</b>
                <br>
                <br>
                <b class="textColor">Business Type</b>
                <div class="">
                  <select name="maptype" id="maptype" class="form-control">
                    <option value="r" <?=($this->input->get('maptype') == 'r')?'selected':"";?>>Residential</option>
                    <option value="b" <?=($this->input->get('maptype') == 'b')?'selected':"";?>>Bussiness</option>
                    <option value="bo" <?=($this->input->get('maptype') == 'bo')?'selected':"";?>>buz occupants</option>
                  </select>
                </div>
                <b class="textColor">Year</b>
                <div class="">
                  <select name="year" id="year" class="form-control">
                    <option><?= -1 + (int)date('Y') ?></option>
                    <?php for ($i = 0; $i < 6; $i++): ?>
                      <option><?php echo $i + (int)date('Y') ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <hr>
                <b>Geographical Filters</b>
                <br>
                <br>
                <b class="textColor">Area/Zonal Council</b>
                <div class="">
                    <select name="area_council" id="sel_area" class="form-control">
                    </select>
                </div>
                <b class="textColor">Town</b>
                <div class="">
                    <select name="town" id="sel_town" class="form-control">
                    </select>
                </div>
                <hr>

                <b>Payment Filters</b>
                <br>
                <br>
                  <div class="container">
                    <div class="row">
                        <label class="switch">
                          <input type="checkbox" <?=($this->input->get('noPay') == 'NO_PAYMENT')?'checked':"";?> value="NO_PAYMENT" name="noPay" id="maptype"> 
                          <span class="noPay round slider"></span>
                        </label>
                        <span class="textColor"> No Payment</span>
                    </div>
                    <br>
                    <div class="row">
                        <label class="switch">
                          <input type="checkbox" <?=($this->input->get('noPay') == 'PARTLY_PAID')?'checked':"";?> value="PARTLY_PAID" name="partPay" id="maptype">
                          <span class="part round slider"></span>
                        </label>
                        <span class="textColor"> Part Payment</span>
                    </div>
                    <br>
                    <div class="row">
                        <label class="switch">
                          <input type="checkbox" <?=($this->input->get('payType') == '3')?'checked':"";?> value="" name="payType" id="maptype">
                          <span class="slider round full"></span>
                        </label>
                        <span class="textColor"> Full Payment</span>
                    </div>

                    <br>
                  </div>

                  <hr>
                  <b>Advance Filters</b>
                  <br>
                  <br>
                  <b class="textColor">Enter Data</b>
                  <div class="">
                      <input type="text" placeholder="enter data" name="searchCode" class="form-control">
                  </div>
                  <br>
                  <div class="row">
                    <label class="switch">
                      <input type="checkbox" <?=($this->input->get('payType') == '1')?'checked':"";?> value="" name="payType" id="maptype">
                      <span class="slider round"></span>
                    </label>
                    <span class="textColor"> InvoiceNo</span>
                  </div>
                  <div class="row">
                    <label class="switch">
                      <input type="checkbox" <?=($this->input->get('payType') == '2')?'checked':"";?> value="" name="payType" id="maptype">
                      <span class="slider round"></span>
                    </label>
                    <span class="textColor"> Property/Business Code</span>
                  </div>
                  <div class="row">
                    <label class="switch">
                      <input type="checkbox" <?=($this->input->get('payType') == '3')?'checked':"";?> value="" name="payType" id="maptype">
                      <span class="slider round"></span>
                    </label>
                    <span class="textColor"> PhoneNo</span>
                  </div>
      
                  <div class="container">
                    <button type="submit" class="btn btn-outline-success btn-fw" id="btnSearchCode">Search</button>
                  </div>
                  <br>
              </form>
            </div>
        </div>
    

        <div id="totalCount"></div>
        <div id="map" style="height:75em">Loading...</div>

      </section>
    </div>
  </div>
  
<!-- end: page --> 


  


 

  


 
  