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
		</head>
		
		<body>
		<html>

<head>
	<title>REVENUE MANAGEMENT SYSTEM</title>
	<!-- Web Fonts  -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>

	<!-- Vendor CSS -->
	<link rel='stylesheet' href='assets/vendor/bootstrap/css/bootstrap.css' />
	<link rel='stylesheet' href='<?= base_url() ?>assets/css/theme.css' />

	<!-- Invoice Print Style -->
	<link rel='stylesheet' href='assets/css/invoice-print.css' />
	<script src='assets/vendor/jquery/jquery.js'></script>
	<script src='assets/js/custom.js'></script>
	<style type='text/css'>
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

			body {
				width: 100%;
				height: 100%
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
	<div class='row' style="width:100%;">
		<div class='col-md-4 mt-3' style='margin-bottom:4em;padding-top:2em;'>
			<h6 class='h4 m-0 text-dark font-weight-bold' style='font-size:90%;'>#$result->invoice_no</h6>
		</div>
		<div class='col-md-4 text-right mb-3'>
			<address class='ib mr-2'>
				Ketu North Municipal Assembly<br>
				PMB 2<br>
				Dzodze<br>
				030 290 7239<br>
				ketunorthmunicipalassembly@gmail.com	<br>
			</address>
			<div class='ib'>
				<img src='assets/img/elem.png' alt='Ga-north logo' style='width:9em;height:9em;'/>
			</div>
	</div>
	</div>
</body>
		
		</body>
		</html>