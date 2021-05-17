<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap2.css" />
	<style>
	@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
	body, h1, h2, h3, h4, h5, h6{
		font-family: 'Bree Serif', serif;
	}


	</style>
</head>
<body>

  <div class="container">

    <div class="row">
      <div class="col-xs-6">
        <h1>
          <a href="#">
          <img src="<?=base_url()?>assets/img/elem.png" alt="Ellembelle logo" style="width:2.5em;height:2.5em;"/>
          </a>
        </h1>
      </div>
      <div class="col-xs-6 text-right">
        <h1>INVOICE</h1>
        <h1><small>Invoice #<?=$result->invoice_no ?></small></h1>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-5">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>From: <a href="#">Ellembelle District Assembly</a></h4>
          </div>
          <div class="panel-body">
            <p>
              P.O.Box 34
              <br/>
              Nkroful
              <br/>
              Phone: 0247 2832 233
            </p>
          </div>
        </div>
      </div>
      <div class="col-xs-5 col-xs-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>To : <a href="#"><?=$result->buis_name ?></a></h4>
          </div>
          <div class="panel-body">
            <p>
              <?=$result->buis_occ_code ?>
              <br/>
              <?=$result->town ?>
              <br/>
              Phone: <?=$result->buis_primary_phone ?>
            </p>
          </div>
        </div>
      </div>
    </div> <!-- / end client details section -->
    <div class="row">
      <div class="col-xs-5">
        <h5>INVOICE DATE : <a href="#"><?=date("Y-m-d",strtotime($result->date_created))?></a></h4>
      </div>
      <div class="col-xs-5 col-xs-offset-2">
        <h5>PAYMENT DUE DATE : <a href="#"><?=date("Y-m-d",$result->payment_due_date)?></a></h4>
      </div>
    </div> <!-- / end client details section -->

    <table class="table table-bordered" style="white-space:normal;">
      <thead>
        <tr>
          <th><h5>Main Category</h5></th>
          <th><h5>Service Type</h5></th>
          <th><h5>Business Type</h5></th>
          <th><h5>Category</h5></th>
          <th><h5>Unit Price</h5></th>
          <th><h5>Penalty</h5></th>
          <th><h5>Amount</h5></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?=$result->category1 ?></td>
          <td class="font-weight-semibold text-dark"><?=$result->category2 ?></td>
          <td><?=$result->category3 ?></td>
          <td><?=$result->category4 ?></td>
          <?php
            $invoice_amount = $result->invoice_amount;
            $penalty_amount = $result->penalty_amount;
            $total_amount = $invoice_amount + $penalty_amount;
          ?>
          <td class="text-right"><?= 'GHS '.number_format((float)$invoice_amount, 2, '.', '');?></td>
          <td class="text-right"><?= 'GHS '.number_format((float)$penalty_amount, 2, '.', '');?></td>
          <td class="text-right"><?= 'GHS '.number_format((float)$total_amount, 2, '.', '');?></td>
        </tr>
      </tbody>
    </table>
    
    <div class="row text-right">
      <div class="col-xs-2 col-xs-offset-8">
        <p>
          <strong>
            Sub Total : <br>
            Arrears : <br>
            Total : <br>
          </strong>
        </p>
      </div>
      <div class="col-xs-2">
        <strong>
          <?= 'GHS '.number_format((float)$total_amount, 2, '.', '');?><br>
          GHS 0.00 <br>
          <?= 'GHS '.number_format((float)$total_amount, 2, '.', '');?> <br>
        </strong>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-5">
        <div class="panel panel-info">
        <div class="panel-heading">
          <h4>Payment details</h4>
        </div>
        <div class="panel-body">
          <p>Ghana Commercial Bank</p>
          <p>SWIFT : 24832848323424</p>
          <p>Account Number : 24832848323424</p>
          <p>IBAN : 24832848323424</p>
        </div>
      </div>
      </div>
      <div class="col-xs-7">
      <div class="span7">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4>Contact Details</h4>
          </div>
          <div class="panel-body">
            <p>
              Email : contact@ellembelle.com.com <br><br>
              Mobile : +233556017839 <br> <br>
              Twitter  : <a href="#">@Ellembelle</a>
            </p>
          <!--  <h4>Payment should be mabe by Bank Transfer</h4> -->
          </div>
        </div>
      </div>
      </div>
    </div>
    <div id="footer">
      <p>All Invoices are supposed to be paid 21 days after the invoice generation date. <br>
        REFERENCE: FR28987856541</p>
    </div>

  </div>

  <script>
    window.print();
  </script>

</body>
</html>
