<html>

<head>
	<title>REVENUE MANAGEMENT SYSTEM</title>
	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/theme.css" />

	<!-- Invoice Print Style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/invoice-print.css" />
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
        .footer{
            margin:auto;
            position:absolute;
            left:4%;
            bottom:4%;
            right:4%;
            border-top:
            solid grey 1px
        }

        .footer p{
            margin-top:1%;
            font-size:90%;
            color: red;
            font-weight:bold;
            line-height:140%;
            text-align:justify
        }
        
        #watermark {
            position: fixed;
            top: 25%;
            left: 32%;
            z-index: 99;
        }

        #watermark.print {
            top: 20%;
            left: 19%;
        }

        #watermark img {
            width: 250%;
            height: 100%;
            opacity: 0.1;
        }

        #watermark.print img {
            width: 200%;
            height: 80%;
            opacity: 0.5;
        }

        @media print
        {
            .footer {
                position: fixed;
                display: block;
                margin:auto;
                left:4%;
                bottom:4%;
                right:4%;
                border-top: solid grey 1px;
            }

            /* #watermark img {
                width: 250%;
                height: 100%;
                opacity: 0.1;
            }

            #watermark.print img {
                width: 200%;
                height: 80%;
                opacity: 0.1;
            } */
            .no-print
            {
                display: none !important;
            }
        }
    </style>
</head>

<body>
	<div class="invoice receipt_preview">
		<?php if($template == "template"){ ?>
			<header class="clearfix">
		<?php }else{ ?>
		<?php } ?>
			<div class="row">
				<div class="col-sm-6 mt-3" style="margin-bottom:4em;padding-top:2em;">
					<h2 class="h2 mt-0 mb-1 text-dark font-weight-bold"></h2>
					<h6 class="h4 m-0 text-dark font-weight-bold" style="font-size:90%;">#<?= $result->invoice_no ?></h6>
				</div>
				<div class="col-sm-6 text-right mt-3 mb-3">
					<?php if($template == "template"){ ?>
						<address class="ib mr-2">
							<?php echo SYSTEM_NAME; ?> 
							<br/>
							<?php echo SYSTEM_POST_BOX; ?> 
							<br/>
							<?php echo SYSTEM_ADDRESS; ?> 
							<br/>
							<?php echo SYSTEM_PHONE; ?> 
							<br/>
							<?php echo SYSTEM_MAIL; ?> 
							
						</address>
						<div class="ib">
							<img src="<?=base_url().SYSTEM_LOGO?>" alt="Ga-north logo" style="width:9em;height:9em;"/>
						</div>
					<?php }else{ ?>
					<?php } ?>
				</div>
			</div>
		<?php if($template == "template"){ ?>
			</header>
		<?php }else{ ?>
		<?php } ?>
		<div class="bill-info">
			<div class="row">
				<div class="col-md-6">
					<div class="bill-to">
						<p class="h5 mb-1 text-dark font-weight-semibold">To:</p>
						<address>
						  <?php echo $result->customer_name;?>
						  <br/>
						  <?php echo $result->property_code;?>
						  <br/>
						  <?php echo ($result->busocc_property_code)? $result->busocc_property_code. '<br/>':""; ?>
						  <?php echo ($result->town)? $result->town. '<br/>':""; ?>
						  <?php echo ($result->streetname)? "<b>Streetname:</b> ".$result->streetname. '<br/>':""; ?>
						  <?php echo ($result->landmark)? "<b>Landmark:</b> ".$result->landmark. '<br/>':""; ?>
						  <?php echo ($result->sectorial_code)? "<b>Street Code:</b> ".$result->sectorial_code. '<br/>':""; ?>
						</address>
					</div>
				</div>
				<div class="col-md-6">
					<div class="bill-data text-right">
					  <p class="mb-0">
						<span class="text-dark"><b>Invoice Date:</b></span>
						<span class="value"><?=date("Y-m-d",strtotime($result->date_created))?></span>
					  </p>
					  <p class="mb-0">
						<span class="text-dark"><b>Due Date:</b></span>
						<span class="value"><?= date("Y-m-d",$result->payment_due_date ) ?></span>
					  </p>
					  <br>
					  <p class="mb-0">
						<span class="text-dark"><b>Mobile Money No:</b></span>
						<span class="value">-</span>
					  </p>
					  <p class="mb-0">
						<span class="text-dark"><b>Bank Name:</b></span>
						<span class="value">GCB BANK</span>
					  </p>
					  <p class="mb-0">
						<span class="text-dark"><b>Account No:</b></span>
						<span class="value">5031130001417</span>
					  </p>
					  <p class="mb-0">
						<span class="text-dark"><b>Bank Branch:</b></span>
						<span class="value">Dzodze</span>
					  </p>
					</div>
				</div>
			</div>
		</div>

		<table class="table table-striped mb-0 invoice-items" style="white-space:normal;">
			<thead>
				<tr class="text-dark">
				  <th id="cell-id" class="font-weight-semibold">Bill Type</th>
				  <?php if($result->category1_id == 33 && $result->product_id == 12){ ?>
					<th id="cell-id" class="font-weight-semibold">Main Category</th>
					<th id="cell-item"   class="font-weight-semibold">Structure Type</th>
					<th id="cell-desc"   class="font-weight-semibold">Size</th>
				  <?php }elseif($result->product_id == 12 || $result->product_id == 13){ ?>
					<th id="cell-item"   class="font-weight-semibold">Property Type</th>
					<th id="cell-desc"   class="font-weight-semibold">Building Type</th>
					<th id="cell-price"  class="text-center font-weight-semibold">Construction Material</th>
					<th id="cell-total"  class="text-center font-weight-semibold">Floor/Size </th>
				  <?php }else{ ?>
					<th id="cell-id" class="font-weight-semibold">Main Category</th>
					<th id="cell-item"   class="font-weight-semibold">Service Type</th>
					<th id="cell-desc"   class="font-weight-semibold">Business Type</th>
					<th id="cell-price"  class="text-center font-weight-semibold">Category</th>
				  <?php } ?>
				  <th id="cell-total"  class="text-center font-weight-semibold">Amount</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <td>
					<?php if($result->category1_id == 33 && $result->product_id == 12){ ?>
					  <?="TEMPORARY STRUCTURE PERMIT RENEWAL"?>
					<?php }else{ ?>
					  <?=$result->name ?>
					<?php } ?>
				  </td>
				  <td><?=$result->category1 ?></td>
				  <td class="font-weight-semibold text-dark"><?=$result->category2 ?></td>
				  <td><?=$result->category3 ?></td>
				  <?php if($result->category1_id == 33 && $result->product_id == 12){ ?>
					
				  <?php }else{ ?>
					<td class="text-center"><?=$result->category4 ?></td>
				  <?php } ?>
				  <td class="text-center">
					<?= 'GHS '.number_format((float)$result->invoice_amount + $result->adjustment_amount, 2, '.', ',');?>
					<?php if($result->target != 3){ ?>
					  <?php if($result->accessed == 1){ ?>
						<span class="badge badge-success">Assessed</span>
					  <?php }else{?>
						<span class="badge badge-danger">Unassessed</span>
					  <?php }?>
					<?php }?>
				  </td>
				</tr>
			</tbody>
		</table>

		<div class="invoice-summary">
			<div class="row justify-content-end">
				<div class="col-sm-4">
					<table class="table h6 text-dark">
						<?php
						$arrears_paid = get_invoice_arrears($result->property_id, $result->product_id, $result->invoice_year);
						$actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
						$invoice_amount = $result->invoice_amount;
						$penalty_amount = $result->penalty_amount;
						$discount_amount = $result->adjustment_amount;
						$amount_paid = $result->amount_paid;
						$total_amount = $invoice_amount + $penalty_amount + $actual_arrears - $amount_paid;
						?>
						<tbody>
							<tr>
								<td width="60%" class="text-right">Subtotal</td>
								<td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $result->invoice_amount + $discount_amount, 2, '.', ','); ?></td>
							</tr>	
							<tr>
								<td width="60%" class="text-right">Penalty</td>
								<td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $penalty_amount, 2, '.', ','); ?></td>
							</tr>
							<tr>
								<td width="60%" class="text-right">Arrears</td>
								<td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $actual_arrears, 2, '.', ','); ?></td>
							</tr>
							<tr>
								<td width="60%" class="text-right">Discount</td>
								<td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $discount_amount, 2, '.', ','); ?></td>
							</tr>
							<tr>
								<td width="60%" class="text-right">Payment</td>
								<td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $amount_paid, 2, '.', ','); ?></td>
							</tr>
							<tr>
								<td width="60%" class="text-right">Total</td>
								<td width="40%" class="text-left"><b><?= 'GHS ' . number_format((float) $total_amount, 2, '.', ','); ?></b></td>
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
								<td class="text-right" bal="<?= number_format((float) $total_amount, 2, '.', '') ?>"></td>
							</tr>
						</tbody>
					</table>
					<div class="text-right">
						<div style="position: relative; left: 0; top: 0;">
							<img src="<?=base_url().MCD_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em;position:relative;top:0;left:0;"/>
							<img src="<?=base_url().MCD_STAMP?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em;opacity:0.5;position: absolute;top: 30px;left: 500px;"/>

							<!-- <img src="<?=base_url().MCD_SIGNATURE?>" alt="Signature" style="width:12em;height:8em;"/>
							<img src="<?=base_url().MCD_STAMP?>" alt="Signature" style="width:12em;height:8em;margin-right:0.5em;opacity:0.5;position: absolute;top: 30px;left: 350px;"/> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($template == "template"){ ?>
			<div id="watermark" class="print"><img src="<?= base_url() ?>assets/img/Coat_of_arms_of_Ghana.png" alt="Watermark" /></div>
		<?php }else{ ?>
		<?php } ?>
	</div>

	<?php if($template == "template"){ ?>
		<div class="footer">
			<p>
				Payment should be made at the revenue office or to assembly’s revenue collector or to the bank or mobile money details on the bill. 
				Failure to do so, will attract proceedings taken for the purpose of exacting sale or entry possession and the expense incurred.<br>
				All property bills are based on unassessed rates in the fee fixing.<br>
			</p>
		</div>
	<?php }else{ ?>
	<?php } ?>
	
</body>

</html>
