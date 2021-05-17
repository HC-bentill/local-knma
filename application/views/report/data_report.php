<?php $this->load->view('residence/tab.css') ?>

<!-- start: page -->

<div class="row">
	<div class="col-md-12">
		<section class="card card-featured-bottom card-featured-primary">
			<?= $this->session->flashdata('message'); ?>
			<div class="card-body">
				<main>
<!-- 
					<input id="tab1" type="radio" name="tabs" checked>
					<label class="label" for="tab1">Gender</label>

					<input id="tab2" type="radio" name="tabs">
					<label class="label" for="tab2">Employment</label>

					<input id="tab3" type="radio" name="tabs">
					<label class="label" for="tab3">Profession</label>

					<input id="tab4" type="radio" name="tabs">
					<label class="label" for="tab4">Education</label> -->

					<input id="tab5" type="radio" name="tabs" checked>
					<label class="label" for="tab5">Data</label>
<!-- 
					<input id="tab6" type="radio" name="tabs">
					<label class="label" for="tab6">Community Needs</label> -->


					<!-- <section class="section" id="content1">

						<div class="col-md-12">
							<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							<table id="datatable-tabletools" class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>AREA COUNCIL</th>
										<th>MALE</th>
										<th>FEMALE</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach (area_council() as $row) { ?>
										<tr>
											<td><a href="<?= base_url() ?>Report/get_towns_area/<?= $row->id ?>/Gender" style="text-decoration: none;"><?= $row->name; ?></a></td>
											<td><a href="<?= base_url() ?>Report/gender_data/Male/<?= $row->id ?>" style="text-decoration: none;"><?= gender_area_council("Male", $row->id); ?></a></td>
											<td><a href="<?= base_url() ?>Report/gender_data/Female/<?= $row->id ?>" style="text-decoration: none;"><?= gender_area_council("Female", $row->id); ?></a></td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot style="border-bottom: 1px solid #eee">
									<tr>
										<td><b style="font-weight: bolder;">TOTAL</b></td>
										<td><a href="<?= base_url() ?>Report/gender_data/Male" style="text-decoration: none;"><?= sum_gender_area_council("Male"); ?></a></td>
										<td><a href="<?= base_url() ?>Report/gender_data/Female" style="text-decoration: none;"><?= sum_gender_area_council("Female"); ?></a></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</section>

					<section class="section" id="content2">
						<div class="col-md-12">
							<div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							<div class="col-md-12">
								<table id="#" class="table table-responsive-md table-striped mb-0">
									<thead>
										<tr>
											<th>AREA COUNCIL</th>
											<th>EMPLOYED</th>
											<th>UNEMPLOYED</th>
											<th>SELF-EMPLOYED</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach (area_council() as $row) { ?>
											<tr>
												<td><a href="<?= base_url() ?>Report/get_towns_area/<?= $row->id ?>/Employment" style="text-decoration: none;"><?= $row->name; ?></a></td>
												<td><a href="<?= base_url() ?>Report/employment_data/Employed/<?= $row->id ?>" style="text-decoration: none;"><?= employment_area_council("Employed", $row->id); ?></a></td>
												<td><a href="<?= base_url() ?>Report/employment_data/Unemployed/<?= $row->id ?>" style="text-decoration: none;"><?= employment_area_council("Unemployed", $row->id); ?></a></td>
												<td><a href="<?= base_url() ?>Report/employment_data/Self-Employed/<?= $row->id ?>" style="text-decoration: none;"><?= employment_area_council("Self-Employed", $row->id); ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
									<tfoot style="border-bottom: 1px solid #eee">
										<tr>
											<td><b style="font-weight: bolder;">TOTAL</b></td>
											<td><a href="<?= base_url() ?>Report/employment_data/Employed" style="text-decoration: none;"><?= sum_employment_area_council("Employed"); ?></a></td>
											<td><a href="<?= base_url() ?>Report/employment_data/Unemployed" style="text-decoration: none;"><?= sum_employment_area_council("Unemployed"); ?></a></td>
											<td><a href="<?= base_url() ?>Report/employment_data/Self-Employed" style="text-decoration: none;"><?= sum_employment_area_council("Self-Employed"); ?></a></td>
										</tr>
									</tfoot>
								</table>
							</div>
					</section>

					<section class="section" id="content3">
						<div class="col-md-12">
							<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							<div class="col-md-12">
								<table id="#" class="table table-responsive-md table-striped mb-0">
									<thead>
										<tr>
											<th>NAME</th>
											<th>NO</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($profession as $row) { ?>
											<tr>
												<td><a href="<?= base_url() ?>Report/get_prof_area_council/<?= $row->id ?>" style="text-decoration: none;"><?= $row->name; ?></a></td>
												<td><a href="<?= base_url() ?>Report/profession_data/<?= $row->id ?>" style="text-decoration: none;"><?= sum_profession_level($row->id); ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
					</section>

					<section class="section" id="content4">
						<div class="col-md-12">
							<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							<div class="col-md-12">
								<table id="#" class="table table-responsive-md table-striped mb-0">
									<thead>
										<tr>
											<th>LEVEL</th>
											<th>NO</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($education as $row) { ?>
											<tr>
												<td><a href="<?= base_url() ?>Report/get_edu_area_council/<?= $row->id ?>" style="text-decoration: none;"><?= $row->level; ?></a></td>
												<td><a href="<?= base_url() ?>Report/educational_data/<?= $row->id ?>" style="text-decoration: none;"><?= sum_educational_level($row->id); ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
					</section> -->

					<section class="section" id="content5">
						<div class="col-md-12">
							<div id="container5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							<div class="col-md-12">
								<table id="#" class="table table-responsive-md table-striped mb-0">
									<thead>
										<tr>
											<th>AREA COUNCIL</th>
											<th>RESIDENCE</th>
											<th>HOUSEHOLD</th>
											<th>BUSINESS PROPERTY</th>
											<th>BUSINESS OCCUPANTS</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach (area_council() as $row) { ?>
											<tr>
												<td><a href="<?= base_url() ?>Report/get_towns_area/<?= $row->id ?>/Data" style="text-decoration: none;"><?= $row->name; ?></a></td>
												<td><a href="<?= base_url() ?>Report/data/Residence/<?= $row->id ?>" style="text-decoration: none;"><?= data_area_council("Residence", $row->id); ?></a></td>
												<td><a href="<?= base_url() ?>Report/data/Household/<?= $row->id ?>" style="text-decoration: none;"><?= data_area_council("Household", $row->id); ?></a></td>
												<td><a href="<?= base_url() ?>Report/data/Business Property/<?= $row->id ?>" style="text-decoration: none;"><?= data_area_council("Business Property", $row->id); ?></a></td>
												<td><a href="<?= base_url() ?>Report/data/Business Occupants/<?= $row->id ?>" style="text-decoration: none;"><?= data_area_council("Business Occupants", $row->id); ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
									<tfoot style="border-bottom: 1px solid #eee">
										<tr>
											<td><b style="font-weight: bolder;">TOTAL</b></td>
											<td><a href="<?= base_url() ?>Report/data/Residence" style="text-decoration: none;"><?= sum_data_area_council("Residence"); ?></a></td>
											<td><a href="<?= base_url() ?>Report/data/Household" style="text-decoration: none;"><?= sum_data_area_council("Household"); ?></a></td>
											<td><a href="<?= base_url() ?>Report/data/Business Property" style="text-decoration: none;"><?= sum_data_area_council("Business Property"); ?></a></td>
											<td><a href="<?= base_url() ?>Report/data/Business Occupants" style="text-decoration: none;"><?= sum_data_area_council("Business Occupants"); ?></a></td>
										</tr>
									</tfoot>
								</table>
							</div>
					</section>

					<!-- <section class="section" id="content6">
						<div class="col-md-12">
							<div id="container6" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							<div class="col-md-12">
								<table id="#" class="table table-responsive-md table-striped mb-0">
									<thead>
										<tr>
											<th>AREA COUNCIL</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach (area_council() as $row) { ?>
											<tr>
												<td><a href="<?= base_url() ?>Report/get_towns_area/<?= $row->id ?>/com_needs" style="text-decoration: none;"><?= $row->name; ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
					</section> -->

				</main>
			</div>
		</section>
	</div>
</div>

<!-- end: page -->