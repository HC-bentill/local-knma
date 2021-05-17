<html>
	<head>
		<title>REVENUE MANAGEMENT SYSTEM</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/invoice-print.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/theme.css" />
        <style type="text/css" media="print">
          /* @page { size: landscape; } */
          .invoice-summary table.wordify > tbody tr:last-child > td {
          	background-color: #F8F8F8;
          	border-bottom: 1px solid #DADADA;
          	border-top: 1px solid #DADADA;
          }

          .invoice-summary table.wordify > tbody tr:last-child > td {
          	font-size: 1.3rem !important
          };
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
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	</head>
	<body>
		<div class="invoice receipt_preview">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-6 mt-3">
						<h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">RECEIPT</h2>
                        <h6 class="h4 m-0 text-dark font-weight-bold"><?php echo 'SRNo: ' ?><?=($receipt_txn->gcr_no)?$receipt_txn->gcr_no : str_pad($receipt_txn->id, 6, '0', STR_PAD_LEFT);?></h6><br>
						<h6 class="h4 m-0 text-dark font-weight-bold" style="font-size:90%;">#<?=$invoice_txn->invoice_no ?></h6>
                        
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
                            <address>
                                <?php echo $invoice_txn->customer_name;?>
                                <br/>
                                <?php echo $invoice_txn->property_code;?>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bill-data text-right">
                            <p class="mb-0">
                                <span class="text-dark">Payment Date:</span>
                                <span class="value"><?=$receipt_txn->datetime_created ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-responsive-md invoice-items" style="white-space:normal;">
                <thead>
                    <tr class="text-dark">
                        <th id="cell-id" class="font-weight-semibold">Payment Reason</th>
                        <th id="cell-id" class="font-weight-semibold">Transaction ID</th>
                        <th id="cell-id"     class="font-weight-semibold">Main Category</th>
                        <th id="cell-item"   class="font-weight-semibold">Service Type</th>
                        <th id="cell-desc"   class="font-weight-semibold">Business Type</th>
                        <th id="cell-total"  class="text-center font-weight-semibold">Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $receipt_txn->payment_type . ' of ' . $invoice_txn->name; ?></td>
                        <td><?php echo $receipt_txn->transaction_id; ?> <span class="badge badge-success"><?=$receipt_txn->payment_mode ?></span></td>
                        <td><?=$invoice_txn->category1 ?></td>
                        <td class="font-weight-semibold text-dark"><?=$invoice_txn->category2 ?></td>
                        <td><?=$invoice_txn->category3 ?></td>
                        <td class="text-center"><?= 'GHS '.number_format((float)$receipt_txn->amount , 2, '.', ',');?></td>
                    </tr>
                </tbody>
            </table>

            <div class="invoice-summary">
                <div class="row justify-content-end">
                    <div class="col-sm-4">
                        <table class="table h6 text-dark">
                            <tbody>
                                <tr>
                                    <td width="50%" class="text-right">Invoice Amount</td>
                                    <td width="50%" class="text-left"><?= 'GHS '.number_format((float)$invoice_txn->invoice_amount, 2, '.', ',');?></td>
                                </tr>
                                <tr>
                                    <td width="50%" class="text-right">Amount Paid</td>
                                    <td width="50%" class="text-left"><?= 'GHS '.number_format((float)$receipt_txn->amount, 2, '.', ',');?></td>
                                </tr>
                                <tr>
                                    <td width="50%" class="text-right">Current Balance</td>
                                    <td width="50%" class="text-left">GHS <?php $bal = (float)number_format((float)$invoice_txn->invoice_amount, 2, '.', '') - (float)number_format((float)$invoice_txn->amount_paid, 2, '.', ''); echo number_format($bal , 2, '.', ',');?></td>
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
                                    <td class="text-right" bal="<?=number_format((float)$receipt_txn->amount, 2, '.', '') ?>"></td>
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
			<p>NOTICE: <br> PAYMENT WITH CHEQUE DOES NOT REFLECT ON ACCOUNT UNTIL CHEQUE IS CLEARED. THANK YOU
			</p>
		</div>
	</body>
</html>
