<?php $this->load->view('report/table.css') ?>
<div class="row">
    <div class="col">
        <section class="card card-featured-bottom card-featured-primary">
            <?= $this->session->flashdata('message');?>
            <div class="card-body">
                <div class="tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>finance_report"><i class="fa fa-btc"></i>Revenue Stream Per Zone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url()?>finance_report2"><i class="fa fa-usd"></i>Revenue Per Revenue Stream</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?=base_url()?>finance_report3"><i class="fa fa-money"></i>Revenue Per Business Type</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <section class="card">
                            <div class="card-body">
                                <form method="GET" action="<?= base_url('Report/finance_report3')?>" autocomplete="off">
                                    <div class="row" style="border:1px solid grey;margin-bottom:1em;border-style: dashed;border-radius:1em;padding:1em;">
                                        <div class="col-lg-12">
                                            <div class="form-group m-form__group row">
                                            <div class="col-lg-3">
                                                <select data-plugin-options="{ &quot;minimumResultsForSearch&quot;: 5 }" name="year" id="year" class="form-control">
                                                    <?php
                                                        foreach ($report_years as $row) {

                                                            if (strcmp($selected_year, $row->invoice_year) == 0) {
                                                    ?>
                                                        
                                                        <option selected='selected'><?=$row->invoice_year?></option>

                                                    <?php
                                                            } else {
                                                    ?>
                                                        <option><?=$row->invoice_year?></option>
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
                                                        <option value="<?=$monthKey?>" <?=$selected?>><?=$monthLabel?></option>
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
                                                    <option value="<?=$monthKey?>" <?=$selected?>><?=$monthLabel?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" id="save" class="btn btn-success">
                                                Search
                                                </button>
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
                                        <tbody>
                                            <?php foreach($revenue_per_bustype as $rpb):?>
                                            <?php
                                                if (in_array($rpb->name, $acclusion_array)) {
                                                    continue;
                                                }
                                            ?>
                                            <?php $area_council_total_revenue = get_revenue_bustype_area_council($rpb->id,null, $selected_year); ?>
                                            <?php $detailsBtn = ""; if(count($area_council_total_revenue) > 0) { $detailsBtn="<a href='#' data-id='".$rpb->id."' class='more-detail-btn collapsed'><i class='fa fa-plus' aria-hidden='true'></i></a>"; } ?>
                                            <tbody class="labels">
                                                <tr>
                                                    <td>
                                                        <div class="container">
                                                            <div class='row'>
                                                                <div class='col-sm-3'><?=$detailsBtn;?></div>
                                                                <div class="col-sm-9">
                                                                    <label for="<?=$rpb->id?>"><b><?=$rpb->name?></b></label>
                                                                    <input type="checkbox" name="<?=$rpb->id?>" id="<?=$rpb->id?>" data-toggle="toggle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><b><?=number_format((float)$rpb->total_amount, 2, '.', ',');?></b></td>
                                                    <td><b><?=number_format((float)$rpb->amount_paid, 2, '.', ',');?></b></td>
                                                    <td>
                                                        <b><?=number_format((float)$rpb->total_amount-$rpb->amount_paid, 2, '.', ',');?></b>
                                                    </td>        
                                                </tr>
                                            </tbody>
                                            <tbody id='tbody<?=$rpb->id?>' class="bill-details hide">
                                                <?php foreach ($area_council_total_revenue as $area_revenue):?>
                                                <tr>
                                                    <td><?=$area_revenue->name;?></td>
                                                    <td><?=number_format((float)$area_revenue->total_amount, 2, '.', ',');?></td>
                                                    <td><?=number_format((float)$area_revenue->amount_paid, 2, '.', ',');?></td>
                                                    <td><?=number_format((float)$area_revenue->total_amount-$area_revenue->amount_paid, 2, '.', ',');?></td>                                                
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody> 
                                            <?php endforeach; ?>
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


