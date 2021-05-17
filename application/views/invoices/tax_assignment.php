<!-- start: page -->

  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th class="text-center">PROPERTY CODE</th>
                  <th class="text-center">IDENTIFIER</th>
                  <th class="text-center">PRODUCT</th>
                  <th class="text-center">CATEGORY 1</th>
                  <th class="text-center">CATEGORY 2</th>
                  <th class="text-center">CATEGORY 3</th>
                  <th class="text-center">CATEGORY 4</th>
                  <th class="text-center">CATEGORY 5</th>
                  <th class="text-center">CATEGORY 6</th>
                  <th class="text-center">AMOUNT</th>
                  <th class="text-center">DATE GENERATED</th>
                  <th class="text-center">INVOICE DUE DATE</th>
                </tr>
               </thead>
              <tbody>
                <?php foreach($result as $value):?>
                  <?php $id = $value->property_id ?>
                  <?php $target = $value->target ?>
                  <tr>
                    <?php if($target == 3){?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?=$this->db->query("SELECT buis_occ_code from buisness_occ WHERE id = '$id'")->row_array()['buis_occ_code']?></a>
                    </td>
                    <?php }else if($target == 2){?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?=$this->db->query("SELECT buis_prop_code from buisness_property WHERE id = '$id'")->row_array()['buis_prop_code']?></a>
                    </td>
                    <?php }else if($target == 1){ ?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?=$this->db->query("SELECT res_code from residence WHERE id = '$id'")->row_array()['res_code']?></a>
                    </td>
                  <?php }else{} ?>
                    <?php if($target == 3){?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?=$this->db->query("SELECT buis_name from buisness_occ WHERE id = '$id'")->row_array()['buis_name']?></a>
                    </td>
                    <?php }else if($target == 2){?>
                    <?php $bus_owner = business_owner_details($value->property_id);?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?= $bus_owner['firstname'].' '.$bus_owner['lastname']?></a>
                    </td>
                    <?php }else if($target == 1){ ?>
                    <?php $owner = owner_details($value->property_id)?>
                    <td>
                      <a style="text-decoration: none;" href='#'><?= $owner['firstname'].' '.$owner['lastname']?></a>
                    </td>
                  <?php }else{} ?>
                    <td><?= $value->name ?></td>
                    <td><?= $value->category1 ?></td>
                    <td><?= $value->category2 ?></td>
                    <td><?= $value->category3 ?></td>
                    <td><?= $value->category4 ?></td>
                    <td><?= $value->category5 ?></td>
                    <td><?= $value->category6 ?></td>
                    <td class="text-center"><?= number_format((float)$value->amount, 2, '.', ''); ?></td>
                    <td class="text-center"><?= date("Y-m-d H:i:s",strtotime($value->date_created)) ?></td>
                    <td class="text-center"><?= "-" ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

<!-- end: page -->
