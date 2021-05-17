<html>

<head>
  <title>REVENUE MANAGEMENT SYSTEM</title>
  <!-- Web Fonts  -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />

  <!-- Invoice Print Style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/invoice-print.css" />
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
  <style type="text/css" media="print">
    .invoice-summary table.wordify>tbody tr:last-child>td {
      background-color: #F8F8F8;
      border-bottom: 1px solid #DADADA;
      border-top: 1px solid #DADADA;
    }

    .invoice-summary table.wordify>tbody tr:last-child>td {
      font-size: 1.3rem !important
    }

    ;
  </style>
</head>

<body>
  <div class="invoice receipt_preview">
    <header class="clearfix">
      <div class="row">
        <div class="col-sm-6 mt-3">
          <h2 class="h2 mt-0 mb-1 text-dark font-weight-bold">INVOICE</h2>
          <h4 class="h4 m-0 text-dark font-weight-bold">#<?= $result->invoice_no ?></h4>
        </div>
        <div class="col-sm-6 text-right mt-3 mb-3">

          <address class="ib mr-5">
            Ga North Municipal Assembly
            <br />
            P.O Box: OF 594
            <br />
            Ofankor, Accra, Ghana
            <br />
            GhanaPostGPS: GW-0450-8542
            <br />
            Phone: 030 290 8086
          </address><br />
          <div class="ib">
            <img src="<?= base_url() ?>assets/img/elem.png" alt="Ga north logo" style="width:9em;height:9em;" />
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
              <?= $result->buis_name ?>
              <br />
              <?= $result->buis_occ_code ?>
              <br />
              <?= $result->tt ?>, Accra, Ghana
              <br />
              Phone: <?= $result->buis_primary_phone ?>
              <br />
              <?= $result->buis_email ?>
            </address>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bill-data text-right">
            <p class="mb-0">
              <span class="text-dark">Invoice Date:</span>
              <span class="value"><?= date("Y-m-d", strtotime($result->date_created)) ?></span>
            </p>
            <p class="mb-0">
              <span class="text-dark">Due Date:</span>
              <span class="value"><?= date("Y-m-d", $result->payment_due_date) ?></span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-responsive-md invoice-items" style="white-space:normal;">
      <thead>
        <tr class="text-dark">
          <th id="cell-id" class="font-weight-semibold">Payment Reason</th>
          <th id="cell-id" class="font-weight-semibold">Main Category</th>
          <th id="cell-item" class="font-weight-semibold">Service Type</th>
          <th id="cell-desc" class="font-weight-semibold">Business Type</th>
          <th id="cell-price" class="text-center font-weight-semibold">Category</th>
          <th id="cell-total" class="text-center font-weight-semibold">Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= $result->name ?></td>
          <td><?= $result->category1 ?></td>
          <td class="font-weight-semibold text-dark"><?= $result->category2 ?></td>
          <td><?= $result->category3 ?></td>
          <td class="text-center"><?= $result->category4 ?></td>
          <td class="text-center"><?= 'GHS ' . number_format((float) $result->invoice_amount, 2, '.', ','); ?></td>
        </tr>
      </tbody>
    </table>

    <div class="invoice-summary">
      <div class="row justify-content-end">
        <div class="col-sm-6">
          <table class="table h6 text-dark">
            <?php
            $arrears_paid = get_invoice_arrears($result->property_id, $result->product_id, $result->invoice_year);
            $actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
            $invoice_amount = $result->invoice_amount;
            $penalty_amount = $result->penalty_amount;
            $total_amount = $invoice_amount + $penalty_amount + $actual_arrears;
            ?>
            <tbody>
              <tr>
                <td width="60%" class="text-right">Subtotal</td>
                <td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $result->invoice_amount, 2, '.', ','); ?></td>
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
                <td width="60%" class="text-right">Total</td>
                <td width="40%" class="text-left"><?= 'GHS ' . number_format((float) $total_amount, 2, '.', ','); ?></td>
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
            <img src="<?= base_url() ?>assets/img/MCD_signature.png" alt="Signature" style="width:12em;height:8em;margin-right:0.5em" />
            <img src="<?= base_url() ?>assets/img/MFO_signature.png" alt="Signature" style="width:12em;height:8em;" />
          </div>
          <div class="text-right">
            <img src="<?= base_url() ?>assets/img/STAMP1.png" alt="Signature" style="width:12em;height:8em;margin-right:0.5em" />
            <img src="<?= base_url() ?>assets/img/STAMP2.png" alt="Signature" style="width:12em;height:8em;" />
          </div>
        </div>
      </div>
    </div>
    <div id="watermark" class="print"><img src="<?= base_url() ?>assets/img/Coat_of_arms_of_Ghana.png" alt="Watermark" /></div>
  </div>

  <script>
    window.print();
  </script>
</body>

</html>