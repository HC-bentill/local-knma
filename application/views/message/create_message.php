<?php $this->load->view('residence/tab.css') ?>
<!-- start: page -->

<div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
          	<main>

				<input id="tab1" type="radio" name="tabs" checked>
				<label class="label" for="tab1">Predefined Message</label>

				<input id="tab2" type="radio" name="tabs">
				<label class="label" for="tab2">Custom Messages</label>

				<section class="section" id="content1">
				  	<form autocomplete="off" id="formm" method="post" action="#">
						<div class="form-group row">
							<div class="col-sm-4">
                             <label class="control-label text-sm-right pt-2"><strong>Message Category:</strong></label>
                                <select class="form-control" id="" name="" required="">
									<option value="">SELECT OPTION</option>
									<option value="">Covid</option>
									<option value="">Bill payment</option>
                                    <option value="">Birthday</option>
								</select>
							</div>
							<div class="col-sm-4">
                             <label class="control-label text-sm-right pt-2"><strong>Predefined Message:</strong></label>
                                <select class="form-control" id="" name="" required="">
									<option value="">SELECT OPTION</option>
									<option value=""></option>
									<option value=""></option>
								</select>
							</div>
                        </div>
                        <div class="form-group row">
							<div class="col-sm-4">
                                <label class="control-label text-sm-right pt-2"><strong>Message Title:</strong></label>
                                <input type="text" class="form-control" id="" name="" value="" autocomplete="off" required/>
							</div>
                            <div class="col-sm-4">
                                <label class="control-label text-sm-right pt-2"><strong>Recepient:</strong></label>
                                <input type="text" class="form-control" id="" name="" value="" autocomplete="off" required/>
							</div>
                        </div>
                        <div class="form-group row">
							<div class="col-sm-8">
                                <label class="control-label text-sm-right pt-2"><strong>Compose Message:</strong></label>
                                <textarea class="form-control" id="send_pre_msg" name="" rows="6" maxlength="100">
                                </textarea>
                                <span id="rchars">100</span> Character(s) Remaining
							</div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Send" id="" type="submit">
                        </div>
						</div>
                    </form>
				</section>
				<section class="section" id="content2">
				  	<form autocomplete="off" id="formm1" method="post" action="">
                      <div class="form-group row">
							<div class="col-sm-4">
							</div>
							<div class="col-sm-4">
							</div>
							<div class="col-sm-4">
							</div>
						</div>
	                </form>
				</section>
			</main>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->