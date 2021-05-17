<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary form-wizard" id="w4">
            <div class="card-body">
                <div class="toolbar">
                    <a href="<?=base_url()?>onetime_invoices" class="tool-icon text-danger" title="Back to onetime invoice listing" data-toggle="tooltip">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
                <div class="alert alert-danger mt-4" id="error_notif" style="display:none"></div>
                <div class="wizard-progress wizard-progress-lg">
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>
                    <ul class="nav wizard-steps">
                        <li class="nav-item active">
                            <a class="nav-link" href="#w4-owner-info" data-toggle="tab"><span>1</span>Owner Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#w4-profile" data-toggle="tab"><span>2</span>Profile Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#w4-category" data-toggle="tab"><span>3</span>Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#w4-payment" data-toggle="tab"><span>4</span>Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#w4-confirm" data-toggle="tab"><span>5</span>Confirmation</a>
                        </li>
                    </ul>
                </div>

                <form class="form-horizontal p-3" novalidate="novalidate" method="post" action="<?=base_url()?>onetime_invoice/save">
                    <div class="tab-content">
                        <div id="w4-owner-info" class="tab-pane active">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="ownership_type">Ownership Type:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="ownership_type" required>
                                        <option value="Owner">Owner</option>
                                        <option value="caretaker">Care Taker</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="phonenumber">Phone Number:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phonenumber" id="phonenumber" required>
                                </div>
                            </div>
                        </div>
                        <div id="w4-profile" class="tab-pane">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-firstname">First Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="firstname" id="w4-firstname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-lastname">Last Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="lastname" id="w4-lastname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="invoice_for">Invoice For:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="invoice_for" name="invoice_for" required>
                                        <option value="1">Individual</option>
                                        <option value="2">Company</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="company" style="display:none;">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-company">Company Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="company" name="company" id="w4-company">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-houseno">House Number:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="houseno" id="w4-houseno">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-area_council">Area Council:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="area_council" id="w4-area_council" required>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Electoral Area:</label>
                                <div class="col-sm-5">
                                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="w4-area_council" name="area_council" required="">
                                        <option value="">SELECT OPTION</option>
                                        <?php foreach($area as $a){ ?>
                                        <option value="<?= $a->id?>"><?=$a->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Town:</label>
                                <div class="col-sm-5">
                                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control"  id="w4-town" name="town" required="">
                                        <option value="">SELECT OPTION</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-town">Town:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="town" id="w4-town" required>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="type_of_invoice">Type of Invoice:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="type_of_invoice" required>
                                        <?php foreach($revenue_products as $rp):?>
                                        <option value="<?php echo $rp->id; ?>" code="<?php echo $rp->code; ?>"><?php echo $rp->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="type_of_invoice">Type of Invoice:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="form_category" id="form_category" value="onetime" required>  
                                </div>
			                </div>
			                <div class="form-group row busname" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-businessname">Business Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="businessname" id="w4-businessname" required>
                                </div>
                            </div>
                            <div class="form-group row busname" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-businesscontact">Business Contact:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="businesscontact" id="w4-businesscontact" required>
                                </div>
                            </div>
                            <div class="form-group row busname" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-businessname">Business Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="businessname" id="w4-businessname" required>
                                </div>
                            </div>
                            <div class="form-group row busname" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-businesscontact">Business Contact:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="businesscontact" id="w4-businesscontact" required>
                                </div>
                            </div>
                        </div>
                        <div id="w4-category" class="tab-pane">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat1">Category 1:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat1" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat2">Category 2:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat2" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat3">Category 3:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat3" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat4">Category 4:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat4" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat5">Category 5:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat5" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="cat6">Category 6:</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="cat6" required>
                                        <option value="">N/A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="w4-payment" class="tab-pane">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1" for="w4-amount">Payment Amount:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="amount" id="w4-amount" required>
                                </div>
                            </div>
                        </div>
                        <div id="w4-confirm" class="tab-pane">
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Ownership Type:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_ownership_type" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Phone Number:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_phone_number" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">First Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_firstname" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Last Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_lastname" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Company Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_company" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">House Number:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_house_number" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Area Council:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_area_council" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Town:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_town" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Type of Invoice:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_type_of_invoice" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 1:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category1" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 2:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category2" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 3:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category3" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 4:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category4" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 5:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category5" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Category 6:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="c_category6" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label text-sm-right pt-1">Payment Amount:</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" name="c_type_of_invoice_code">
                                    <input type="hidden" class="form-control" name="c_price_id">
                                    <input type="text" class="form-control" name="c_amount" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <ul class="pager">
                    <li class="previous disabled">
                        <a><i class="fa fa-angle-left"></i> Previous</a>
                    </li>
                    <li class="finish hidden float-right">
                        <a>Finish</a>
                    </li>
                    <li class="next">
                        <a>Next <i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>
