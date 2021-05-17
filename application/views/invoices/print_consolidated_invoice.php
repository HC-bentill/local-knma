<html>
	<head>
		<title>REVENUE MANAGEMENT SYSTEM</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/theme.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/invoice-print.css" />
		<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
		<style type="text/css" media="print">
			.invoice-summary table.wordify > tbody tr:last-child > td {
          		background-color: #F8F8F8;
				border-bottom: 1px solid #DADADA;
				border-top: 1px solid #DADADA;
			}
          	.invoice-summary table.wordify > tbody tr:last-child > td {
				font-size: 1.3rem !important
			}
			footer {
				display: block;
			}
			#footer{
				margin:auto;
				position:absolute;
				left:4%;
				bottom:4%;
				right:4%;
				border-top:
				solid grey 1px
			}

			#footer p{
				margin-top:1%;
				font-size:90%;
				color: red;
				font-weight:bold;
				line-height:140%;
				text-align:justify
			}
    	</style>
	</head>
	<body>
    <div class="invoice receipt_preview">
      <header class="clearfix">
        <div class="row">
          <div class="col-sm-6 mt-3">
            <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
          </div>
          <div class="col-sm-6 text-right mt-3 mb-3">
		  	<address class="ib mr-2">
				<?php echo SYSTEM_NAME; ?> 
				<br/>
				<?php echo SYSTEM_POST_BOX; ?> 
				<br/>
				<?php echo SYSTEM_ADDRESS; ?> 
				<br/>
				<?php echo SYSTEM_PHONE; ?> 
				<br/>
				<?php echo SYSTEM_GHPOSTGPS; ?> 
			</address>
            <div class="ib">
				<img src="<?=base_url().SYSTEM_LOGO?>" alt="Ga-north logo" style="width:9em;height:9em;"/>
            </div>
          </div>
        </div>
      </header>
      <div class="bill-info">
        <div class="row">
          <div class="col-md-6">
            <div class="bill-to">
              <p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
			  <?php $owner_name = $result->contact->owner_name ?>
			  <a href="#"><?=(is_null($owner_name) ? "No Contact" : $owner_name)?></a>

            </div>
          </div>
          <div class="col-md-6">
            <div class="bill-data text-right">
              <p class="mb-0">
                <span class="text-dark">Invoice Date:</span>
                <span class="value"><?=date("Y-m-d",$result->summary->invoice_due_date)?></span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-responsive-md invoice-items" style="white-space:normal;">
        <thead>
          	<tr class="text-dark">
		  		<th><h5>Invoice Number</h5></th>
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
			<?php foreach($result->records as $row)  { ?>
          	<?php
				$arrears_paid = get_invoice_arrears($row->property_id,$row->product_id,$row->invoice_year);
				$actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
				$invoice_amount = $row->invoice_amount;
				$penalty_amount = $row->penalty_amount;
				$total_amount = $invoice_amount + $penalty_amount + $actual_arrears;
          	?>
          	<tr>
				<td><?=$row->invoice_no ?></td>
				<td><?=$row->category1 ?></td>
				<td class="font-weight-semibold text-dark"><?=$row->category2 ?></td>
				<td><?=$row->category3 ?></td>
				<td><?=$row->category4 ?></td>
				<td class="text-right"><?= 'GHS '.number_format((float)$invoice_amount, 2, '.', '');?></td>
				<td class="text-right"><?= 'GHS '.number_format((float)$penalty_amount, 2, '.', '');?></td>
            	<td class="text-right"><?= 'GHS '.number_format((float)$total_amount, 2, '.', '');?></td>
          	</tr>
          <?php } ?>
        </tbody>
      </table>

      <div class="invoice-summary">
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <table class="table h6 text-dark">
				<tbody>
					<tr>
						<td width="60%" class="text-right">Subtotal</td>
						<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->summary->subtotal, 2, '.', '');?></td>
					</tr>
					<tr>
						<td width="60%" class="text-right">Discount</td>
						<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->summary->discount, 2, '.', ',');?></td>
					</tr>
					<tr>
						<td width="60%" class="text-right">Penalty</td>
						<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->summary->penalty_amount, 2, '.', ',');?></td>
					</tr>
					<tr>
						<td width="60%" class="text-right">Arrears</td>
						<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->summary->actual_arrears, 2, '.', ',');?></td>
					</tr>
					<tr>
						<td width="60%" class="text-right">Total</td>
						<td width="40%" class="text-left"><?= 'GHS '.number_format((float)$result->summary->total, 2, '.', ',');?></td>
					</tr>
				</tbody>
            </table>
          </div>
        </div>
		<div class="row justify-content-end">
			<div class="col-sm-12">
				<table class="table wordify h6 text-dark">
					<tbody>
						<tr class="b-top-0">
							<td class="text-right" bal="<?=number_format((float)$total_amount, 2, '.', '') ?>"></td>
						</tr>
					</tbody>
				</table>
				<div class="text-right">
					<img src="<?=base_url().MCE_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em"/>
					<img src="<?=base_url().MCD_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;"/>
				</div>
				<div class="text-right">
					<img src="<?=base_url().MCE_STAMP?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em"/>
					<img src="<?=base_url().MCD_STAMP?>" alt="Signature" style="width:12em;height:8em;"/>
				</div>
			</div>
		</div>
      </div>
	  <div id="watermark" class="print"><img src="<?=base_url()?>assets/img/Coat_of_arms_of_Ghana.png" alt="Watermark"/></div>
    </div>
		<div id="footer">
			<p>PAYMENT SHOULD BE MADE AT THE REVENUE OFFICE OR 
				TO THE REVENUE OFFICER OF THE ASSEMBLY ON OR BEFORE <?=date("Y-m-d",$result->summary->payment_due_date)?>. FAILURE TO DO SO, 
				PROCEEDINGS WILL BE TAKEN FOR THE PURPOSE OF EXACTING SALE OR ENTRY INTO POSSESSION AND THE EXPENSES INCURRED
			</p>
		</div>
	</body>
</html>
