<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
      	<?= $this->session->flashdata('message');?>
        <div class="card-body">
            
          	<main>

                <input id="tab1" type="radio" name="tabs" checked>
                <label class="label" for="tab1">Personal Info</label>

                <input id="tab2" type="radio" name="tabs">
                <label class="label" for="tab2">Location Info</label>

                <input id="tab3" type="radio" name="tabs">
                <label class="label" for="tab3">Technical Info</label>

                <input id="tab4" type="radio" name="tabs">
				<label class="label" for="tab4">Map</label>


                <section class="section" id="content1">
                    <form autocomplete="off" id="basicformm" method="post" action="<?=base_url()?>Food/edit_personnal_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Company Name:</strong></label>
                            <input type="text" class="form-control" id="company_name" value="<?=$result['company_name']?>" name="company_name" autocomplete="off" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Contact:</strong></label>
                            <input type="text" class="form-control" id="contact" value="<?=$result['contact']?>" name="contact" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Contact Name:</strong></label>
                            <input type="text" class="form-control" id="contact_name" value="<?=$result['contact_name']?>" name="contact_name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Personnal Info" id="btn1" type="button">
                        </div>
                    </div>
                    </form>
                </section>

                <section class="section" id="content2">
                    <form autocomplete="off" id="locform" method="post" action="<?=base_url()?>Food/edit_location_data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Road Class:</strong></label>
                            <input type="text" class="form-control" id="road_class" value="<?=$result['street_name']?>" name="road_class" autocomplete="off" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Street Name:</strong></label>
                            <input type="text" class="form-control" id="street_name" value="<?=$result['street_name']?>" name="street_name" autocomplete="off" required/>
                        </div>
                        <div class="col-sm-4">
                            <label class="control-label text-sm-right pt-2"><strong>Landmark:</strong></label>
                            <input type="text" class="form-control" id="landmark" value="<?=$result['landmark']?>" name="landmark" autocomplete="off" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Location Info" id="btn2" type="button">
                        </div>
                    </div>
                    </form>
                </section>

                <section class="section" id="content3">
                    <form autocomplete="off" id="propform" method="post" action="<?=base_url()?>Food/edit_tech_data">
                    
                    <div class="form-group row">
                        <label class="col-sm-4 control-label text-sm-right pt-2">&nbsp;</label>
                        <div class="col-sm-4 pull-right">
                            <input name="id" value="<?= $result['id']?>" type="hidden">
                            <input name="code" value="<?= $result['code']?>" type="hidden">
                            <input style="font-size:1.0rem" class="btn btn-primary form-control" value="Update Technical Info" id="btn3" type="button">
                        </div>
                    </div>
                    </form>
                </section>
                <section class="section" id="content4">
                        <div id="map" style="width:100%;height: 30em;"></div>
                </section>
			</main>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
<script>

	function initMap() {
		var myLatLng = {lat: <?=$result['gps_lat']?>, lng: <?=$result['gps_long']?>};

		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: myLatLng,
			gestureHandling: 'cooperative'
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map
		});
	}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEMcP8mSrlPeI8jMLVh9PU7RBrQZVJ6I&callback=initMap">
</script>
