
<div class="inner-wrapper">
    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
            <div class="sidebar-title">
                Navigation
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">

                    <ul class="nav nav-main">
                        <!-- <li class="<?php echo is_active('dashboard'); ?>">
                            <a class="nav-link" href="<?=base_url()?>dashboard">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li> -->
                        <li class="nav-parent <?php echo is_active('dashboard'); ?><?php echo is_active('dashboard'); ?>">
                            <a class="nav-link" href="#">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Dashboards</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('dashboard'); ?>">
                                    <a class="nav-link" href="<?= base_url() ?>dashboard">
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="<?php echo is_active('dashboard'); ?>">
                                    <a class="nav-link" href="<?= base_url() ?>revenue_dashboard">
                                        <span>Revenue Dashboard</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- <li class="nav-parent <?php echo is_active('add_res'); ?><?php echo is_active('view_res'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Residential</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_res'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_residence">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_res'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>residence">
                                        View
                                    </a>
                                </li>

                            </ul>
                        </li> -->
                        <li class="nav-parent <?php echo is_active('add_busprop'); ?><?php echo is_active('view_busprop'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                <span>Property</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_busprop'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_property">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_busprop'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>property">
                                        View
                                    </a>
                                </li>

                            </ul>
                        </li>
                        
                        <li class="nav-parent <?php echo is_active('add_busocc'); ?><?php echo is_active('view_busocc'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-btc" aria-hidden="true"></i>
                                <span>Business Occupant</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_busocc'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_business_occupant">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_busocc'); ?>">
                                        <a class="nav-link" href="<?=base_url()?>business_occupant">
                                            View
                                        </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-parent <?php echo is_active('add_signage'); ?><?php echo is_active('view_signage'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-map-signs" aria-hidden="true"></i>
                                <span>Signage Post</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_signage'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_signage">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_signage'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>signage">
                                        View
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="<?php echo is_active('property_owner'); ?>">
                            <a class="nav-link" href="<?=base_url()?>property_owner">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Property Owners</span>
                            </a>
                        </li>

                        <li class="nav-parent <?php echo is_active('add_mess'); ?><?php echo is_active('view_mess'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>Messages</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_mess'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>message">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_mess'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>view_message">
                                        View
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-parent <?php echo is_active('add_product'); ?><?php echo is_active('view_product'); ?><?php echo is_active('access_property'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                                <span>Product</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_product'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_product">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_product'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>view_all_products">
                                        View
                                    </a>
                                </li>
                                <li class="<?php echo is_active('access_property'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>accessed_property">
                                        Access Property
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-parent <?php echo is_active('add_penalty'); ?><?php echo is_active('view_penalty'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                <span>Penalty</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_penalty'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_penalty">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_penalty'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>view_penalty">
                                        View
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <?php 
                            $invoiceActiveStatus = is_active('tax_assign');
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('invoice') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('onetime') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('transaction') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('batch_print_invoice') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('toll_transaction') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('adjustment') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('consolidated_invoice') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('invoice_distribution') : $invoiceActiveStatus;
                            $invoiceActiveStatus = $invoiceActiveStatus == "" ? is_active('batch_bill_generation') : $invoiceActiveStatus;
                        ?>
                        <li class="nav-parent <?=$invoiceActiveStatus?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                                <span>Invoices</span>
                            </a>
                            <ul class="nav nav-children">
                                <!-- <li class="<?php echo is_active('tax_assign'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>tax_assignment">
                                        Tax Assignment
                                    </a>
                                </li> -->
                                <li class="<?php echo is_active('invoice'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>invoice">
                                        Invoice
                                    </a>
                                </li>
                                <li class="<?php echo is_active('consolidated_invoice'); ?>">
                                    <a href="<?=base_url()?>consolidated_invoice" class="nav-link">
                                        Consolidated Invoice
                                    </a>
                                </li>
                                <li class="<?php echo is_active('onetime'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>onetime_invoices">
                                        Onetime Invoice
                                    </a>
                                </li>
                                <li class="<?php echo is_active('transaction'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>transaction">
                                        Transaction
                                    </a>
                                </li>
                                <li class="<?php echo is_active('toll_transaction'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>toll_transaction">
                                        Toll Transaction
                                    </a>
                                </li>
                                <li class="<?php echo is_active('adjustment'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>adjustment">
                                        Adjustments
                                    </a>
                                </li>
                                <li class="<?php echo is_active('batch_print_invoice'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>batch_print_invoice">
                                        Batch Printing
                                    </a>
                                </li>
                                <li class="<?php echo is_active('invoice_distribution'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>invoice_distribution">
                                        Invoice Distribution
                                    </a>
                                </li>
                                <li class="<?php echo is_active('batch_bill_generation'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>batch_bill_generation">
                                        Batch Bill Generation
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-parent <?php echo is_active('data_report'); ?><?php echo is_active('finance_report'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-bar-chart-o" aria-hidden="true"></i>
                                <span>Report</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('data_report'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>data_report">
                                        Data Report
                                    </a>
                                </li>
                                <li class="<?php echo is_active('finance_report'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>finance_report">
                                        Finance Report
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="<?php echo is_active('map'); ?>">
                            <a class="nav-link" href="<?=base_url()?>map">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>Map</span>
                            </a>
                        </li>
                        <li class="<?php echo is_active('channel'); ?>">
                            <a class="nav-link" href="<?=base_url()?>channel">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>Channels</span>
                            </a>
                        </li>
                        <li class="<?php echo is_active('system_audit'); ?>">
                            <a class="nav-link" href="<?=base_url()?>system_audit">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span>System Audit</span>
                            </a>
                        </li>
                        <?php if(is_active('batch_delete_record') != ""): ?>
                        <li class="<?php echo is_active('batch_delete_record'); ?>">
                            <a class="nav-link" href="<?=base_url()?>delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                <span>Delete Records</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-parent <?php echo is_active('add_user'); ?><?php echo is_active('view_user'); ?>">
                            <a class="nav-link" href="#">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span>User Management</span>
                            </a>
                            <ul class="nav nav-children">
                                <li class="<?php echo is_active('add_user'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>add_user">
                                        Create
                                    </a>
                                </li>
                                <li class="<?php echo is_active('view_user'); ?>">
                                    <a class="nav-link" href="<?=base_url()?>users">
                                        View
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </nav>

            </div>

            <script>
                // Maintain Scroll Position
                if (typeof localStorage !== 'undefined') {
                    if (localStorage.getItem('sidebar-left-position') !== null) {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                            sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                        sidebarLeft.scrollTop = initialPosition;
                    }
                }
            </script>


        </div>

    </aside>
    <!-- end: sidebar -->

    <section role="main" class="content-body">

    <header class="page-header">
        <h2><?php echo $title; ?></h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
            <?=displayBreadCrumbs()?>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>

    </header>
