<?php $this->load->view('report/table.css') ?>

<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary">
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url() ?>finance_report"><i class="fa fa-btc"></i>Revenue Stream Per Zone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>finance_report2"><i class="fa fa-usd"></i>Revenue Per Revenue Stream</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>finance_report3?>"><i class="fa fa-money"></i>Revenue Per Business Type</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <section class="card">
                            <div class="card-body">
                                <form method="GET" action="<?= base_url('Report/finance_report') ?>" autocomplete="off">
                                    <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
                                        <div class="col-lg-12">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-3">
                                                    <select data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="year" id="year" class="form-control">
                                                        <?php
                                                        foreach ($report_years as $row) {

                                                            if (strcmp($selected_year, $row->invoice_year) == 0) {
                                                        ?>

                                                                <option selected='selected'><?= $row->invoice_year ?></option>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option><?= $row->invoice_year ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="beginMonth" name="beginMonth">
                                                        <?php
                                                            foreach ($year_months as $monthKey => $monthLabel) {
                                                                $selected = "";
                                                                if (strcmp($monthKey, $selected_begin_month) == 0) {
                                                                    $selected = "selected='selected'";
                                                                }
                                                        ?>
                                                            <option value="<?= $monthKey ?>" <?= $selected ?>><?= $monthLabel ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select data-plugin-selecttwo="" data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" class="form-control" id="endMonth" name="endMonth">
                                                        <?php
                                                            foreach ($year_months as $monthKey => $monthLabel) {
                                                                $selected = "";
                                                                if (strcmp($monthKey, $selected_end_month) == 0) {
                                                                    $selected = "selected='selected'";
                                                                }
                                                        ?>
                                                            <option value="<?= $monthKey ?>" <?= $selected ?>><?= $monthLabel ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button type="submit" id="save" class="btn btn-success">
                                                        Search
                                                    </button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnDownloadGroup" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Download
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnDownloadGroup">
                                                            <a class="dropdown-item" href="finance_report/excel">Excel</a>
                                                            <a class="dropdown-item" href="finance_report/pdf">PDF</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-12">
                                    <table class="table table-responsive-md table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>TOTAL INVOICES GENERATED</th>
                                                <th>TOTAL PAYMENT MADE</th>
                                                <th>TOTAL OUTSTANDING INVOICES</th>
                                            </tr>
                                        </thead>
                                        <tbody class="labels">
                                            <?php $detailsBtn = "";
                                                if (count($area_council_total_revenue) > 0) {
                                                    $detailsBtn = "<a href='#' data-id='1' class='more-detail-btn collapsed'><i class='fa fa-plus' aria-hidden='true'></i></a>";
                                                } ?>
                                        <tbody class="labels">
                                            <tr>
                                                <td>
                                                    <div class="container">
                                                        <div class='row'>
                                                            <div class='col-sm-3'><?= $detailsBtn; ?></div>
                                                            <div class="col-sm-9">
                                                                <label for="accounting"><b>Total Revenue</b></label>
                                                                <input type="checkbox" name="total_revenue" id="accounting" data-toggle="toggle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><b><?= number_format((float)$total_revenue['inv_amount'], 2, '.', ','); ?></b></td>
                                                <td><b><?= number_format((float)$total_revenue['amt_paid'], 2, '.', ','); ?></b></td>
                                                <td>
                                                    <b><?= number_format((float)$total_revenue['inv_amount'] - $total_revenue['amt_paid'], 2, '.', ','); ?></b>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody id='tbody1' class="bill-details hide">
                                            <?php foreach ($area_council_total_revenue as $area_revenue) : ?>
                                                <?php
                                                if (in_array($area_revenue->name, $acclusion_array)) {
                                                    continue;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?= $area_revenue->name; ?></td>
                                                    <td><?= number_format((float)$area_revenue->total_amount, 2, '.', ','); ?></td>
                                                    <td><?= number_format((float)$area_revenue->amount_paid, 2, '.', ','); ?></td>
                                                    <td><?= number_format((float)$area_revenue->total_amount - $area_revenue->amount_paid, 2, '.', ','); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>