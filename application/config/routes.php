<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//signin routes
$route['signin'] = 'Login/signin';

//logout routes
$route['logout'] = 'Login/logout';
$route['unlock'] = 'Login/unlock';

//dashboard routes
$route['dashboard'] = 'Dashboard/dashboard';
$route['revenue_dashboard'] = 'Dashboard/revenue_dashboard';

//user routes
$route['users'] = 'Users/users';
$route['change_password'] = 'Users/change_password';
$route['change_passwordd'] = 'Userss/change_passwordd';
$route['add_user'] = 'Users/add_user_page';
$route['edit_user'] = 'Users/edit_user_page';
$route['edit_user/(:any)'] = 'Users/edit_user_page/$1';
$route['system_audit'] = 'Users/system_audit';
$route['search_system_audit'] = 'Users/search_system_audit';

//profile routes
$route['profile'] = 'Profile/profile';
$route['mobile_agent_dashboard'] = 'Agent/mobile_agent_dashboard';
$route['mobile_agent_dashboard/(:any)'] = 'Agent/mobile_agent_dashboard/$1';
$route['mobile_admin_dashboard'] = 'Agent/mobile_admin_dashboard';
$route['mobile_tv_dashboard'] = 'Agent/mobile_tv_dashboard';

//food vendor & signage routes
$route['food_vendor'] = 'Food/food_vendor';
$route['add_food_vendor'] = 'Food/add_food_vendor';
$route['mobile_agent_dashboard/(:any)'] = 'Agent/mobile_agent_dashboard/$1';
$route['mobile_admin_dashboard'] = 'Agent/mobile_admin_dashboard';
$route['signage'] = 'Food/signage';
$route['add_signage'] = 'Food/add_signage';

//product routes
$route['product'] = 'Product/product';
$route['add_product'] = 'Product/add_product';
$route['add_category1'] = 'Product/add_category1';
$route['add_category2'] = 'Product/add_category2';
$route['add_category3'] = 'Product/add_category3';
$route['add_category4'] = 'Product/add_category4';
$route['add_category5'] = 'Product/add_category5';
$route['add_category6'] = 'Product/add_category6';
$route['view_all_products'] = 'Product/view_all_products';
$route['view_product/(:num)'] = 'Product/view_product/$1';
$route['view_cat3/(:num)'] = 'Product/view_cat3/$1';
$route['view_cat4/(:num)'] = 'Product/view_cat4/$1';
$route['view_cat5/(:num)'] = 'Product/view_cat5/$1';
$route['view_cat6/(:num)'] = 'Product/view_cat6/$1';
$route['view_cat(:num)/(:num)'] = 'Product/view_catx/$1/$2';
$route['edit_product/(:num)'] = 'Product/edit_product/$1';
$route['edit_cat3/(:num)'] = 'Product/edit_cat3/$1';
$route['edit_cat4/(:num)'] = 'Product/edit_cat4/$1';
$route['edit_cat5/(:num)'] = 'Product/edit_cat5/$1';
$route['edit_cat6/(:num)'] = 'Product/edit_cat6/$1';
$route['edit_cat(:num)/(:num)'] = 'Product/edit_catx/$1/$2';

//penalty routes
$route['penalty'] = 'Penalty/penalty';
$route['add_penalty'] = 'Penalty/add_penalty';
$route['view_penalty'] = 'Penalty/view_penalty';

//invoice routes
$route['tax_assignment'] = 'Invoice/tax_assignment';
$route['invoice'] = 'Invoice/invoice';
$route['consolidated_invoice'] = 'Invoice/consolidated_invoice';
$route['onetime_invoices'] = 'Invoice/onetime_invoices';
$route['onetime_invoice/(:any)'] = 'Invoice/onetime_invoice_create_save/$1';
$route['onetime_invoice/view/(:any)'] = 'Invoice/view_onetime_invoice/$1';
$route['onetime_invoice/print/(:any)'] = 'Invoice/print_onetime_invoice/$1';
$route['view_invoice'] = 'Invoice/view_invoice';
$route['batch_print_invoice'] = 'Invoice/batch_print_invoice';
$route['view_invoice/(:any)'] = 'Invoice/view_invoice/$1';
$route['view_consolidated_invoice/(:any)'] = 'Invoice/view_consolidated_invoice/$1';
$route['invoice2'] = 'Invoice/invoice2';
$route['invoice2/(:any)'] = 'Invoice/invoice2/$1';
$route['invoice3'] = 'Invoice/invoice3';
$route['invoice3/(:any)'] = 'Invoice/invoice3/$1';
$route['print_invoice'] = 'Invoice/print_invoice';
$route['print_invoice/(:any)'] = 'Invoice/print_invoice/$1';
$route['print_invoice2'] = 'Invoice/print_invoice2';
$route['print_invoice2/(:any)/(:any)'] = 'Invoice/print_invoice2/$1/$2';
$route['print_demo/(:any)'] = 'Invoice/print_demo/$1';
$route['print_consolidated_invoice/(:any)'] = 'Invoice/print_consolidated_invoice/$1';
$route['transaction'] = 'Invoice/transaction';
$route['toll_transaction'] = 'Invoice/toll_transaction';
$route['adjustment'] = 'Invoice/view_adjustment';
$route['transaction/receipt/(:any)'] = 'Invoice/invoice_transaction_receipt/$1';
$route['transaction/print_receipt/(:any)'] = 'Invoice/print_receipt/$1';
$route['accessed_property'] = 'Invoice/accessed_property';
$route['accessed_business_occupant'] = 'Invoice/accessed_business_occupant';
$route['accessed_residence'] = 'Invoice/accessed_residence';
$route['invoice_payment/(:any)'] = 'Invoice/invoice_payment/$1';
$route['onetime_invoice_payment/(:any)'] = 'Invoice/onetime_invoice_payment/$1';
$route['invoice_transaction/(:any)'] = 'Invoice/invoice_transaction/$1';
$route['invoice_transaction/receipt/(:any)'] = 'Invoice/invoice_transaction_receipt/$1';
$route['invoice_transaction/print_receipt/(:any)'] = 'Invoice/print_receipt/$1';
$route['onetime_invoice_transaction/(:any)'] = 'Invoice/onetime_invoice_transaction/$1';
$route['onetime_invoice_transaction/receipt/(:any)'] = 'Invoice/onetime_invoice_transaction_receipt/$1';
$route['onetime_invoice_transaction/print_receipt/(:any)'] = 'Invoice/print_onetime_receipt/$1';
$route['onetime_invoice_adjustment/(:any)'] = 'Invoice/onetime_invoice_adjustment/$1';
$route['invoice_adjustment/(:any)'] = 'Invoice/invoice_adjustment/$1';
$route['invoice_distribution'] = 'Invoice/invoice_distribution';

// bill generation route
$route['batch_bill_generation'] = 'BillGeneration/batch_bill_generation';

//messages routes
$route['message'] = 'Message/message';
$route['view_message'] = 'Message/view_message';

//commission routes
$route['commission'] = 'Commission/commission';

// agent routes
$route['agent'] = 'Agent/agent';

// report routes
$route['data_report'] = 'Report/data_report';
$route['finance_report'] = 'Report/finance_report';
$route['finance_report/(:any)'] = 'Report/download_finance_report/$1';
$route['finance_report2'] = 'Report/finance_report2';
$route['finance_report3'] = 'Report/finance_report3';

// report routes
$route['add_transport'] = 'Transport/add_transport_form';
$route['property_owner'] = 'Property/property_owner';

//cron routes
$route['cron'] = 'Cron/cron';

//residence routes
$route['residence'] = 'Residence/residence';
$route['add_residence'] = 'Residence/add_residence_form';
$route['edit_residence/(:num)'] = 'Residence/edit_residence_form/$1';
$route['household'] = 'Residence/household';
$route['add_household'] = 'Residence/add_household_form';
$route['view_residence'] = 'Residence/view_residence';
$route['view_residence/(:num)'] = 'Residence/view_residence/$1';
$route['view_household'] = 'Residence/view_household';
$route['view_household/(:num)'] = 'Residence/view_household/$1';

//business routes
$route['property'] = 'Business/business_prop';
$route['add_business_occupant'] = 'Business/add_business_occupant_form';
$route['add_property'] = 'Business/add_business_property_form';
$route['view_business_prop'] = 'Business/view_business';
$route['view_business_prop/(:any)'] = 'Business/view_business/$1';
$route['view_business_occ'] = 'Business/view_business_occ';
$route['view_business_occ/(:any)'] = 'Business/view_business_occ/$1';
$route['business_occupant'] = 'Business/business_occupant';
$route['business_occupant_category'] = 'Business/business_occupant_category';

//bank routes
$route['bank'] = 'Bank/bank';

//event category routes
$route['category'] = 'category/category';

// settings routes
$route['settings'] = 'Setup/settings';

// channel routes
$route['channel'] = 'Channel/channel';

// event routes
$route['event'] = 'Event/event';
$route['view_event'] = 'Event/view_event';
$route['view_event/(:any)'] = 'Event/view_event/$1';

// map routes
$route['map'] = 'Residence/map';
$route['business_map'] = 'Business/map';

//delete record routes
$route['delete_record'] = 'Data/delete_record';
$route['deletedata'] = 'Invoice/deletedata';

// ticket routes
$route['view_ticket'] = 'Ticket/view_ticket';
$route['generate'] = 'Ticket/generate_ticket';
$route['view_ticket/(:any)'] = 'Ticket/view_ticket/$1';



//Chart routes
$route['chart_today'] = 'Dashboard/chart_today';
$route['chart_current_week'] = 'Dashboard/chart_current_week';
$route['chart_past_seven_days'] = 'Dashboard/chart_past_seven_days';
$route['chart_current_month'] = 'Dashboard/chart_current_month';
$route['chart_last_month'] = 'Dashboard/chart_last_month';
$route['last_3_month_revenue'] = 'Dashboard/get_last_3_month_revenue';
$route['last_6_month_revenue'] = 'Dashboard/get_last_6_month_revenue';

$route['get_collectors_daily_revenue'] = 'Dashboard/get_collectors_daily_revenue';
$route['get_collectors_week_revenue'] = 'Dashboard/get_collectors_week_revenue';
$route['collectors_chart_past_seven_days'] = 'Dashboard/collectors_chart_past_seven_days';
$route['collectors_month_revenue'] = 'Dashboard/collectors_month_revenue';
$route['collectors_lastmonth_revenue'] = 'Dashboard/collectors_lastmonth_revenue';
$route['collectors_last_3_month_revenue'] = 'Dashboard/collectors_last_3_month_revenue';
$route['collectors_last_6_month_revenue'] = 'Dashboard/collectors_last_6_month_revenue';

$route['streams_daily_revenue'] = 'Dashboard/streams_daily_revenue';
$route['streams_week_revenue'] = 'Dashboard/streams_week_revenue';
$route['streams_chart_past_seven_days'] = 'Dashboard/streams_chart_past_seven_days';
$route['streams_month_revenue'] = 'Dashboard/streams_month_revenue';
$route['streams_lastmonth_revenue'] = 'Dashboard/streams_lastmonth_revenue';
$route['streams_last_3_month_revenue'] = 'Dashboard/streams_last_3_month_revenue';
$route['streams_last_6_month_revenue'] = 'Dashboard/streams_last_6_month_revenue';
