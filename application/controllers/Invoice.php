<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '../vendor/autoload.php';

class Invoice extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('TaxModel');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('mixins');


		if($this->session->userdata('user_info')['id'] == ''){
			redirect('login');
		}

		if($this->session->userdata('user_info')['first_login'] == 0){
			redirect('change_passwordd');
		}
	}

	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

	// tax assignment
	public function tax_assignment(){
		//set last page session
		$this->session->set_userdata('last_page', 'tax_assign');

		if(has_permission($this->session->userdata('user_info')['id'],'tax assignment')){
			$data = array(
				'title' => 'Product Assignment',
				'page' => 'invoices/tax_assignment',
				'result' => $this->TaxModel->get_tax_assignment()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// transactions
	public function transaction(){

		//set last page session
		$this->session->set_userdata('last_page', 'transaction');
		buildBreadCrumb(array(
			"url" => "transaction",
			"label" => "Transaction"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			$data = array(
				'title' => 'Transactions',
				'page' => 'invoices/transaction',
				'search_by' => "Criteria",
				'start_date' => "",
				'end_date' => "",
				'payment_mode' => "",
				'keyword' => "",
				'category' => "",
				'agentid' => "",
				'admin' => "",
				'status' => "",
				'transaction_type' => "payment",
				'transaction_amount' => $this->TaxModel->get_transaction_amount($search_by = "Criteria",$start_date = null,$end_date = null,$payment_mode = null,
										$keyword = null,$category = null ,$agentid = null,$admin = null,$status = null,$transaction_type = "payment"),
				'agent' => $this->TaxModel->get_agents(),
				'user' => $this->TaxModel->get_users()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// toll transactions
	public function toll_transaction(){

		//set last page session
		$this->session->set_userdata('last_page', 'toll_transaction');
		buildBreadCrumb(array(
			"url" => "toll_transaction",
			"label" => "Toll Transaction"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			//get last date
			$last_date = $this->TaxModel->get_toll_date();
			$data = array(
				'title' => 'Toll Transactions',
				'page' => 'invoices/toll_transaction',
				'search_by' => "Criteria",
				'start_date' => $last_date,
				'end_date' => "",
				'payment_mode' => "",
				'keyword' => "",
				'category' => "",
				'agentid' => "",
				'admin' => "",
				'status' => "",
				'transaction' => $this->TaxModel->get_toll_transaction($last_date),
				'agent' => $this->TaxModel->get_agents(),
				'user' => $this->TaxModel->get_users()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// search transaction
	public function search_transaction(){
		//exit($this->input->post('status'));
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$payment_mode = $this->input->post('payment_mode');
		$category = $this->input->post('category');
		$agent = $this->input->post('agent');
		$admin = $this->input->post('admin');
		$status = $this->input->post('status');
		$keyword = $this->input->post('keyword');
		$transaction_type = $this->input->post('transaction_type');

		$data = array(
			'title' => 'Transactions',
			'page' => 'invoices/transaction',
			'search_by' => $search_by,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'payment_mode' => $payment_mode,
			'keyword' => $keyword,
			'category' => $category,
			'agentid' => $agent,
			"admin" => $admin,
			"status" => $status,
			'transaction_type' => $transaction_type,
			'transaction_amount' => $this->TaxModel->get_transaction_amount($search_by,$start_date,$end_date,$payment_mode,
										$keyword,$category,$agent,$admin,$status,$transaction_type),
			'agent' => $this->TaxModel->get_agents(),
			'user' => $this->TaxModel->get_users()
		);

		$this->load_page($data);
	}

	// search transaction
	public function search_toll_transaction(){
		//exit($this->input->post('status'));
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$payment_mode = $this->input->post('payment_mode');
		$category = $this->input->post('category');
		$agent = $this->input->post('agent');
		$admin = $this->input->post('admin');
		$status = $this->input->post('status');

      	$keyword = $this->input->post('keyword');

		$data = array(
			'title' => 'Toll Transactions',
			'page' => 'invoices/toll_transaction',
			'search_by' => $search_by,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'payment_mode' => $payment_mode,
			'keyword' => $keyword,
			'category' => $category,
			'agentid' => $agent,
			"admin" => $admin,
			"status" => $status,
			'transaction' => $this->TaxModel->search_toll_transaction(
				$search_by,$start_date,$end_date,$payment_mode,
				$keyword,$category,$agent,$admin,$status
			),
			'agent' => $this->TaxModel->get_agents(),
			'user' => $this->TaxModel->get_users()
		);

		$this->load_page($data);
	}

	// search invoice
    public function search_invoice(){
        //exit($this->input->post('status'));
        $search_by = $this->input->post('search_by');
		$product = $this->input->post('product');
		$year = $this->input->post('year');
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $category5 = $this->input->post('category5');
        $category6 = $this->input->post('category6');
        $category5s = $this->input->post('category5');
        $category6s = $this->input->post('category6');
        $keyword = $this->input->post('keyword');

        $data = array(
            'title' => 'Invoices',
            'page' => 'invoices/invoice',
            'search_by' => $search_by,
			'product' => $product,
			'year' => $year,
            'category1' => $category1,
            'category2' => $category2,
            'category3' => $category3,
            'category4' => $category4,
            'category5' => $category5,
            'category6' => $category6,
            'category5s' => $category5s,
            'category6s' => $category6s,
            'keyword' => $keyword,
            'products' => $this->TaxModel->get_all_products()
        );

        $this->load_page($data);
    }

	// view invoice
	public function view_invoice($id){
		$breadCrumbs = buildBreadCrumb(array(
			"label" => "View Invoice",
			"url" => "view_invoice/$id"
		));
		$data = array(
			'title' => 'View Invoice',
			'page' => 'invoices/view_invoice',
			'bread_crumbs' => $breadCrumbs,
			'result' => json_decode($this->TaxModel->get_invoice_detail($id))
		);

		$this->load_page($data);
	}

	public function view_onetime_invoice($invoice_id){
		$data = array(
			'title' => 'View Invoice',
			'page' => 'invoices/view_onetime_invoice',
			'result' => json_decode($this->TaxModel->get_onetime_invoice_detail($invoice_id))
		);

		$this->load_page($data);
	}

	// invoice payment
	public function invoice_payment($id){
		$breadCrumbs = buildBreadCrumb(array(
			"label" => "Pay Invoice",
			"url" => "invoice_payment/$id"
		));
		if(has_permission($this->session->userdata('user_info')['id'],'make payment')){
			$data = array(
				'title' => 'Pay Invoice',
				'page' => 'invoices/invoice_payment',
				'result' => $this->TaxModel->get_invoice_payment_detail($id)
			);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
		}
		$data['bread_crumbs'] = $breadCrumbs;
		$this->load_page($data);
	}

	public function onetime_invoice_payment($id){

		if(has_permission($this->session->userdata('user_info')['id'],'make payment')){
			$data = array(
				'title' => 'Pay Invoice',
				'page' => 'invoices/onetime_invoice_payment',
				'result' => $this->TaxModel->get_onetime_invoice_payment_detail($id)
			);
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// invoice transactions
	public function invoice_transaction($id){
		$breadCrumbs = buildBreadCrumb(
			array(
				'label' => "Invoice Transaction(s)",
				'url' => "invoice_transaction/$id"));

		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			//exit("hello");
			$data = array(
				'title' => 'Invoice Transaction(s)',
				'page' => 'invoices/invoice_transaction',
				'result' => $this->TaxModel->get_invoice_payment_detail($id),
				'transaction' => $this->TaxModel->get_invoice_transactions($id)
			);

		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
		}
		$data['bread_crumbs'] = $breadCrumbs;
		$this->load_page($data);
	}

	public function onetime_invoice_transaction($id){
		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			//exit("hello");
			$data = array(
				'title' => 'Onetime Invoice Transaction(s)',
				'page' => 'invoices/onetime_invoice_transaction',
				'transaction' => $this->TaxModel->get_onetime_invoice_transactions($id)
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	public function invoice_transaction_receipt($tid){
		//exit("hello");
		$txn = json_decode($this->TaxModel->get_receipt_transaction($tid));
		$inv = json_decode($this->TaxModel->get_invoice_detail($txn->invoice_id));
		$data = array(
			'title' => 'Invoice Transaction Receipt',
			'page' => 'invoices/payment_receipt',
			'result' => $inv,
			'receipt_txn' => $txn
		);

		$this->load_page($data);
	}

	public function onetime_invoice_transaction_receipt($tid){
		$txn = json_decode($this->TaxModel->get_receipt_transaction_by_invoice_no($tid));
		$inv = json_decode($this->TaxModel->get_onetime_invoice_detail($txn->invoice_no));
		$data = array(
			'title' => 'Onetime Invoice Transaction Receipt',
			'page' => 'invoices/onetime_payment_receipt',
			'result' => $inv,
			'receipt_txn' => $txn
		);

		$this->load_page($data);
	}

	// onetime invoice adjustment
	public function onetime_invoice_adjustment($invoice_id){
		if(has_permission($this->session->userdata('user_info')['id'],'invoice adjustment')){
			$data = array(
				'title' => 'Onetime Invoice Adjustment',
				'page' => 'invoices/onetime_invoice_adjustment',
				'result' => $this->TaxModel->getOnetimeInvoiceData($invoice_id)
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// invoice adjustmenr
	public function invoice_adjustment($invoice_id){
		$breadCrumbs = buildBreadCrumb(array(
			"label" => "Invoice Adjustment",
			"url" => ""
		));
		if(has_permission($this->session->userdata('user_info')['id'],'invoice adjustment')){
			$data = array(
				'title' => 'Invoice Adjustment',
				'page' => 'invoices/invoice_adjustment',
				'result' => $this->TaxModel->getInvoiceData($invoice_id)
			);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
		}
		$data['bread_crumbs'] = $breadCrumbs;
		$this->load_page($data);
	}

	// view all adjustments
	public function view_adjustment(){
		//set last page session
		$this->session->set_userdata('last_page', 'adjustment');
		buildBreadCrumb(array(
			"label" => "View Adjustments",
			"url" => "view_adjustment"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'view adjustment')){
			$data = array(
				'title' => 'View Adjustments',
				'page' => 'invoices/view_adjustment',
				'result' => $this->TaxModel->getAllAdjustments()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// invoice distribution
	public function invoice_distribution(){
		//set last page session
		$this->session->set_userdata('last_page', 'invoice_distribution');

		buildBreadCrumb(array(
			"label" => "Invoice Distribution",
			"url" => "invoice_distribution"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'invoice_distribution')){
			//exit("hello");
			$data = array(
				'title' => 'Invoice Distribution',
				'page' => 'invoices/invoice_distribution',
				'start_date' => "",
				'end_date' => "",
				'bill_type' => "",
				'town' => "",
				'electoral_area' => "",
				'area' => $this->TaxModel->get_area_councils(),
				'products' => $this->TaxModel->get_all_products(),	
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// search transaction
	public function search_invoice_distribution(){
		//exit($this->input->post('status'));
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$product = $this->input->post('product');
		$electoral_area = $this->input->post('electoral_area');
		$town = $this->input->post('town');

		$data = array(
			'title' => 'Invoice Distribution',
			'page' => 'invoices/invoice_distribution',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'bill_type' => $product,
			'town' => $town,
			'electoral_area' => $electoral_area,
			'area' => $this->TaxModel->get_area_councils(),
			'products' => $this->TaxModel->get_all_products(),
		);

		$this->load_page($data);
	}

	public function adjustment(){
		$invoice_id = trim($this->input->post("invoice_id"));
		$invoice_type = trim($this->input->post("invoice_type"));
		$adjustment_amount = trim(number_format((float)$this->input->post("adjustment_amount"), 2, '.',''));
		$reason = trim($this->input->post("reason"));
		$adjustment_type = trim($this->input->post("adjustment_type"));
		$approval_status = "p";
		$created_by = $this->session->userdata('user_info')['id'];
		$invoice_amount = trim(number_format((float)$this->input->post("invoice_amount"), 2, '.',''));
		$invoice_no = trim($this->input->post("invoice_no"));

		//property image upload
		//configure upload
		$config['upload_path'] = './upload/adjustment';
		$config['allowed_types'] = '*';
		$config['max_size'] = '100000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$file_path = '';
			$image = '';
		} else {
			$file_data = $this->upload->data();

			$file_path = '/upload/adjustment/';
			$image = $file_data['file_name'];
		}

		if($adjustment_type == '-'){
			if($invoice_type == 1){
				$invoice = $this->TaxModel->get_onetime_invoice_adjustment_amount($invoice_id);		
				$total_paid = $invoice['amount_paid'] + $invoice['adjustment_amount'] + $adjustment_amount;
				$invoice_amount = $invoice['amount'] - $total_paid;
	
				if($invoice_amount < 0){
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong> You cannot pass this adjustment because it wil negate the invoice amountt.
					</div>");
					redirect(base_url('adjustment'));
				}
			}else if($invoice_type == 2){
				$invoice = $this->TaxModel->get_invoice_adjustment_amount($invoice_id);		
				$total_paid = $invoice['amount_paid'] + $invoice['adjustment_amount'] + $adjustment_amount;
				$invoice_amount = $invoice['invoice_amount'] - $total_paid;
	
				if($invoice_amount < 0){
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong> You cannot pass this adjustment because it wil negate the invoice amountt.
					</div>");
					redirect(base_url('adjustment'));
				}
			}
		}

		$data = array(
			'invoice_id' => $invoice_id,
			'invoice_type' => $invoice_type,
			'adjustment_amount' => $adjustment_amount,
			'adjustment_type' => $adjustment_type,
			'reason' => $reason,
			'approval_status' => $approval_status,
			'audit_approval' => 'p',
			'created_by' => $created_by,
			'invoice_amount' => $invoice_amount,
			'invoice_no' => $invoice_no,
			'file_path' => $file_path,
			'document' => $image
		);
		$save = $this->TaxModel->add_adjustment($data);

		if($save){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added an adjustment",
				'status' => true,
				'description' => "Added an adjustment of amount GHS $adjustment_amount to invoice with ID: $invoice_no",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert

			$this->session->set_flashdata(
				'message', "<div class='alert alert-success'>
					<strong>Success! </strong> Your Form Was Submitted.
				</div>"
			);
			
		}else{
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				</div>"
			);
			
		}

		if($this->input->post("invoice_type") == "1"){
			redirect(base_url("onetime_invoice_adjustment/".$invoice_no));
		}else{
			redirect(base_url("invoice_adjustment/".$invoice_id));
		}
			
	}

	public function print_receipt($tid){
		if(has_permission($this->session->userdata('user_info')['id'],'print invoice')){
			$txn = json_decode($this->TaxModel->get_receipt_transaction($tid));
			$inv = json_decode($this->TaxModel->get_invoice_detail($txn->invoice_id));
			$data = array(
					'invoice_txn' => $inv,
					'receipt_txn' => $txn
			);

			$this->load->view('invoices/print_receipt',$data);
		}else{
			$data = array(
					'title' => 'Permission',
					'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	public function print_onetime_receipt($tid){
		$txn = json_decode(
			$this->TaxModel->get_receipt_transaction_by_invoice_no($tid));
		$inv = json_decode(
			$this->TaxModel->get_onetime_invoice_detail($txn->invoice_no));
		$data = array(
			'result' => $inv,
			'receipt_txn' => $txn
		);

		$this->load->view('invoices/print_onetime_receipt',$data);
	}

	public function print_onetime_invoice($invoice_id){
		if(has_permission(
				$this->session->userdata('user_info')['id'],'print invoice')){
			$data = array(
        		'result' => json_decode(
					$this->TaxModel->get_onetime_invoice_detail($invoice_id)
				)
			);

			$this->load->view('invoices/print_onetime_invoice',$data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// process payment

	public function validateOTP(){
		$otp = $this->input->post('otp');
		$paymode = $this->input->post('payment_mode');

		if($paymode == 'Mobile Money'){
			return "success";
		}

		$CI = & get_instance();
	    $result = $CI->db->query("select * from otp where code=$otp order by id desc limit 1")->result_array();
		$result = array_shift($result);
		if(!empty($result)){
			$now = date("Y-m-d H:i:s");
			$d1 = new DateTime($now);
			$d2 = new DateTime($result['expire_on']);

			if($d1 > $d2){
				$this->TaxModel->update_otp('Expired', $result['id']);
				return 'expired';
			}else{
				$this->TaxModel->update_otp('Used', $result['id']);
				return 'success';
			}
		}else{
			return 'invalid';
		}
	}

	public function updateChequeStatus(){
		$tid = $this->input->post('transactonId');
		$status = (int)$this->input->post('status');
		$invdata = json_decode($this->TaxModel->get_cheque_invoice($tid));
		$amount_paid = number_format((float)$invdata->amount, 2, '.', ',');
		if((int)$invdata->fromIO == 1){//onetime cheque clearance
			$rs1 = $this->TaxModel->update_invoice_options(
				array(
					'amount_paid' => (
						(float)$invdata->ii_amount_paid + (float)$invdata->amount)),
				array('id' => $invdata->ii_id)
			);
		}else {
			$rs2 = $this->TaxModel->update_invoice(
				array(
					'amount_paid' => ((float)$invdata->i_amount_paid + (float)$invdata->amount)), 
				array('id' => $invdata->i_id)
			);
		}
		$rs3 = $this->TaxModel->update_transaction_status(array('status' => 1), array('id' => $invdata->id));

		if(isset($rs1) && $rs1 && $rs3 || isset($rs2) && $rs2 && $rs3){
			// insert into audit tray

			if((int)$invdata->fromIO == 1){
				$sms_message = "Your cheque payment of GHS $amount_paid on invoice# $invdata->ii_invoice_no to EDA with transactionID $invdata->transaction_id in Pending status has been cleared successfully";
				$phone_formatted = ((strlen($invdata->payer_phone) > 10) && substr($invdata->payer_phone, 0, 3) == '233') ? $invdata->payer_phone : '233' . substr($invdata->payer_phone, 1, strlen($invdata->payer_phone));
				send_sms($phone_formatted, $sms_message);
			}else{
				$sms_message = "Your cheque payment of GHS $amount_paid on invoice# $invdata->i_invoice_no to EDA with transactionID $invdata->transaction_id in Pending status has been cleared successfully";
				$phone_formatted = ((strlen($invdata->payer_phone) > 10) && substr($invdata->payer_phone, 0, 3) == '233') ? $invdata->payer_phone : '233' . substr($invdata->payer_phone, 1, strlen($invdata->payer_phone));
				send_sms($phone_formatted, $sms_message);
			}

			if((int)$invdata->fromIO == 1){
				$invoice_no = $invdata->ii_invoice_no;
			}else{
				$invoice_no = $invdata->i_invoice_no;
			}
			
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Updated Cheque Status",
				'status' => true,
				'description' => "Updated Cheque status of invoice no: $invoice_no to successful",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			echo json_encode(array('code' => 0, 'message' => 'success'));
		}else{
			echo json_encode(array('code' => 90, 'message' => 'An error occurred while performing adjustment and updating cheque status'));
		}
	}

	public function process_payment(){
		$invoice_id = $this->input->post('invoice_id');
		$invoice_no = $this->input->post('invoice_number');
		$target = !empty($this->input->post('target')) ? $this->input->post('target') : 0;
		$payment_mode = $dat->{'paymentMode'};
		$actual_invoice_amount = (float)$this->input->post('actual_invoice_amount');
		$valid = $this->validateOTP();

		$invoice_amount_paid = (float)$this->input->post('amount_paid_so_far');
		// check if its a part payment or full payment
		if($dat->{'paymentType'} == "Full Payment"){
			$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
		}else{
			$amount_paid = (float)$dat->{'amountPaid'};//part payment
		}

		if( $valid == 'success' ){
			$product = $this->input->post('product');
			$property_id = !empty($this->input->post('property_id')) ? $this->input->post('property_id') : 0;
			$actual_invoice_amount = (float)$this->input->post('actual_invoice_amount');
			$transaction_id = random_string('numeric',10);
			$datetime = date("Y-m-d H:i:s");
			$payment_mode = $this->input->post('payment_mode');

			if($payment_mode == "Cheque"){
				//property image upload
				//configure upload
				$config['upload_path'] = './upload/cheque/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('userfile')) {
					
				} else {
					$file_data = $this->upload->data();

					$tran['image_path'] = '/upload/cheque/';
					$tran['cheque_image'] = $file_data['file_name'];
				}
			}else {
				$new_amount_paid = $invoice_amount_paid + $amount_paid;
			}

			// get amount already paid //target == 0 is for onetime invoice
			//$invoice_amount_paid = ($target == 0) ? $this->input->post('amount_paid_so_far') : $this->TaxModel->get_invoice_amount_paid($invoice_id);
			$invoice_amount_paid = (float)$this->input->post('amount_paid_so_far');
			//update amount paid in db

			// check if its a part payment or full payment
			if($this->input->post('payment_type') == "Full Payment"){
				$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
			}else{
				$amount_paid = (float)$this->input->post('amount_paid');//part payment
			}

			if($payment_mode == "Cheque"){
				$new_amount_paid = $invoice_amount_paid;
			}else {
				$new_amount_paid = $invoice_amount_paid + $amount_paid;
			}
			// where
			$where = array('id' => $invoice_id);

			// data to be updated
			$data = array('amount_paid' => number_format((float)$new_amount_paid , 2, '.', '') );

			// pass data and where clause to the model
			if($target == 0){
				$update_invoice_amount_paid = $this->TaxModel->update_invoice_options($data,$where);
			}else{
				$update_invoice_amount_paid = $this->TaxModel->update_invoice($data,$where);
			}

			// update invoice status if $new_amount_paid <= $actual_invoice_amount or not
			//if(number_format((float)$actual_invoice_amount , 2, '.', '') <= number_format((float)$new_amount_paid , 2, '.', '') ){

			if($new_amount_paid > $invoice_amount_paid){
				$tran['status'] = 1;
			}else {
				$tran['status'] = 0;
			}

		// get transaction data and insert in transactions table
			$tran['invoice_id'] = $this->input->post('invoice_id');
			$tran['transaction_id'] = $transaction_id;
			$tran['payment_mode'] = $this->input->post('payment_mode');
			$tran['gcr_no'] = $this->input->post('gcr_no');
			$tran['valuation_no'] = $this->input->post('valuation_no');
			// check payment mode type
			if($this->input->post('payment_mode') == "Mobile Money"){
				$tran['mobile_operator'] = $this->input->post('mobile_operator');
				$tran['momo_number'] = $this->input->post('momo_number');
				$tran['momo_transaction_id'] = $this->input->post('momo_transaction_id');
			}else if($this->input->post('payment_mode') == "Cheque"){
				$tran['bank_name'] = $this->input->post('bank_name');
				$tran['bank_branch'] = $this->input->post('bank_branch');
				$tran['cheque_name'] = $this->input->post('cheque_name');
				$tran['cheque_no'] = $this->input->post('cheque_no');
			}else if($this->input->post('payment_mode') == "Mobile Money Number"){
				$tran['sender_momo_number'] = $this->input->post('sender_momo_number');
				$tran['sender_transaction_id'] = $this->input->post('sender_transaction_id');
			}else{

			}
			$tran['payment_type'] = $this->input->post('payment_type');

			// check if its a part payment or full payment
			if($this->input->post('payment_type') == "Full Payment"){
				$tran['amount'] = $actual_invoice_amount - $invoice_amount_paid;
			}else{
				$tran['amount'] = $this->input->post('amount_paid');
			}
			$tran['paid_by'] = $this->input->post('paid_by');
			// check who is making the payment
			if($this->input->post('paid_by') == "others"){
				$primary_contact = $this->input->post('phone_no');
				$tran['payer_name'] = $this->input->post('name');
				$tran['payer_phone'] =  $this->input->post('phone_no');
			}else{
				if($target == 1){
					$owner = owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else if($target == 2){
					$owner = business_owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];

				}else if($target == 3){
					$owner = business_occ_owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else if($target == 0){
					$primary_contact = $this->input->post('phone_no');
					$tran['payer_name'] =  $this->input->post('fullname');
					$tran['payer_phone'] =  $this->input->post('phonenumber');
				}
			}

			// get owner phone no
			$tran['fromIO'] = ($target == 0) ? 1 : 0;
			$tran['channel'] = "Web";
			$tran['created_by'] = $this->session->userdata('user_info')['id'];
			$tran['collected_by'] = "admin";

			//insert into transactions table
			$insert_transaction = $this->TaxModel->insert_transaction($tran);

			if($insert_transaction){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Made a payment",
					'status' => true,
					'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				//send sms after successful payment
				if($this->input->post('paid_by') == "others"){
					$primary_contact = $this->input->post('phone_no');
					
					if($target == 1){
						$owner = owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
					}else if($target == 2){
						$owner = business_owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
	
					}else if($target == 3){
						$owner = business_occ_owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
					}else if($target == 0){
						$owner_contact = $this->input->post('phone_no');
					}

					// send sms to rate payer
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($owner_contact) > 10) && substr($owner_contact, 0, 3) == '233') ? $owner_contact : '233' . substr($owner_contact, 1, strlen($owner_contact));
					send_sms($phone_formatted, $sms_message);

					//send sms to owner/caretaker
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					send_sms($phone_formatted, $sms_message);

				}else{
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					send_sms($phone_formatted, $sms_message);
				}
				
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> Your Form Was Submitted.
				</div>");
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Business Occupant Already Accessed.
						 </div>");
			}
		}
		else if( $valid == 'expired' ){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Made a payment",
				'status' => true,
				'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is expired",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>Payment unsuccessful due to expired OTP code.Please try again
				</div>");
		}
		else if( $valid == 'invalid' ){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Made a payment",
				'status' => true,
				'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is invalid",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						 <strong>Sorry! </strong>Payment unsuccessful due to invalid OTP code.Please try again
					 </div>");
		}
		if($target == 0){
			redirect(base_url('onetime_invoice_payment/'.$invoice_no));
		}
		else {
			redirect(base_url('invoice_payment/'.$invoice_id));
		}

	}

	public function process_payment_new(){
		$invoice_id = $this->input->post('invoice_id');
		$invoice_no = $this->input->post('invoice_number');
		$target = !empty($this->input->post('target')) ? $this->input->post('target') : 0;
		$payment_mode = $dat->{'paymentMode'};
		$actual_invoice_amount = (float)$this->input->post('actual_invoice_amount');
		$valid = $this->validateOTP();

		$invoice_amount_paid = (float)$this->input->post('amount_paid_so_far');
		// check if its a part payment or full payment
		if($dat->{'paymentType'} == "Full Payment"){
			$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
		}else{
			$amount_paid = (float)$dat->{'amountPaid'};//part payment
		}

		if( $valid == 'success' ){
			$product = $this->input->post('product');
			$property_id = !empty($this->input->post('property_id')) ? $this->input->post('property_id') : 0;
			$actual_invoice_amount = (float)$this->input->post('actual_invoice_amount');
			$transaction_id = random_string('numeric',10);
			$datetime = date("Y-m-d H:i:s");
			$payment_mode = $this->input->post('payment_mode');

			if($payment_mode == "Cheque"){
				//property image upload
				//configure upload
				$config['upload_path'] = './upload/cheque/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '1000';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('userfile')) {
					
				} else {
					$file_data = $this->upload->data();

					$tran['image_path'] = '/upload/cheque/';
					$tran['cheque_image'] = $file_data['file_name'];
				}
			}else {
				$new_amount_paid = $invoice_amount_paid + $amount_paid;
			}

			// get amount already paid //target == 0 is for onetime invoice
			//$invoice_amount_paid = ($target == 0) ? $this->input->post('amount_paid_so_far') : $this->TaxModel->get_invoice_amount_paid($invoice_id);
			$invoice_amount_paid = (float)$this->input->post('amount_paid_so_far');
			//update amount paid in db

			// check if its a part payment or full payment
			if($this->input->post('payment_type') == "Full Payment"){
				$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
			}else{
				$amount_paid = (float)$this->input->post('amount_paid');//part payment
			}

			if($payment_mode == "Cheque"){
				$new_amount_paid = $invoice_amount_paid;
			}else {
				$new_amount_paid = $invoice_amount_paid + $amount_paid;
			}
			// where
			$where = array('id' => $invoice_id);

			// data to be updated
			$data = array('amount_paid' => number_format((float)$new_amount_paid , 2, '.', '') );

			// pass data and where clause to the model
			if($target == 0){
				$update_invoice_amount_paid = $this->TaxModel->update_invoice_options($data,$where);
			}else{
				$update_invoice_amount_paid = $this->TaxModel->update_invoice($data,$where);
			}

			// update invoice status if $new_amount_paid <= $actual_invoice_amount or not
			//if(number_format((float)$actual_invoice_amount , 2, '.', '') <= number_format((float)$new_amount_paid , 2, '.', '') ){

			if($new_amount_paid > $invoice_amount_paid){
				$tran['status'] = 1;
			}else {
				$tran['status'] = 0;
			}

		// get transaction data and insert in transactions table
			$tran['invoice_id'] = $this->input->post('invoice_id');
			$tran['transaction_id'] = $transaction_id;
			$tran['payment_mode'] = $this->input->post('payment_mode');
			$tran['gcr_no'] = $this->input->post('gcr_no');
			$tran['valuation_no'] = $this->input->post('valuation_no');
			// check payment mode type
			if($this->input->post('payment_mode') == "Mobile Money"){
				$tran['mobile_operator'] = $this->input->post('mobile_operator');
				$tran['momo_number'] = $this->input->post('momo_number');
				$tran['momo_transaction_id'] = $this->input->post('momo_transaction_id');
			}else if($this->input->post('payment_mode') == "Cheque"){
				$tran['bank_name'] = $this->input->post('bank_name');
				$tran['bank_branch'] = $this->input->post('bank_branch');
				$tran['cheque_name'] = $this->input->post('cheque_name');
				$tran['cheque_no'] = $this->input->post('cheque_no');
			}else if($this->input->post('payment_mode') == "Mobile Money Number"){
				$tran['sender_momo_number'] = $this->input->post('sender_momo_number');
				$tran['sender_transaction_id'] = $this->input->post('sender_transaction_id');
			}else{

			}
			$tran['payment_type'] = $this->input->post('payment_type');

			// check if its a part payment or full payment
			if($this->input->post('payment_type') == "Full Payment"){
				$tran['amount'] = $actual_invoice_amount - $invoice_amount_paid;
			}else{
				$tran['amount'] = $this->input->post('amount_paid');
			}
			$tran['paid_by'] = $this->input->post('paid_by');
			// check who is making the payment
			if($this->input->post('paid_by') == "others"){
				$primary_contact = $this->input->post('phone_no');
				$tran['payer_name'] = $this->input->post('name');
				$tran['payer_phone'] =  $this->input->post('phone_no');
			}else{
				if($target == 1){
					$owner = owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else if($target == 2){
					$owner = business_owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];

				}else if($target == 3){
					$owner = business_occ_owner_details($property_id);
					$primary_contact = $owner['primary_contact'];
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else if($target == 0){
					$primary_contact = $this->input->post('phone_no');
					$tran['payer_name'] =  $this->input->post('fullname');
					$tran['payer_phone'] =  $this->input->post('phonenumber');
				}
			}
			$tran['fromIO'] = ($target == 0) ? 1 : 0;
			$tran['channel'] = "Web";
			$tran['created_by'] = $this->session->userdata('user_info')['id'];
			$tran['collected_by'] = "admin";

			//insert into transactions table
			$insert_transaction = $this->TaxModel->insert_transaction($tran);

			if($insert_transaction){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Made a payment",
					'status' => true,
					'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				
				//send sms after successful payment
				if($this->input->post('paid_by') == "others"){
					$primary_contact = $this->input->post('phone_no');
					
					if($target == 1){
						$owner = owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
					}else if($target == 2){
						$owner = business_owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
	
					}else if($target == 3){
						$owner = business_occ_owner_details($property_id);
						$owner_contact = $owner['primary_contact'];
					}else if($target == 0){
						$owner_contact = $this->input->post('phone_no');
					}

					// send sms to rate payer
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($owner_contact) > 10) && substr($owner_contact, 0, 3) == '233') ? $owner_contact : '233' . substr($owner_contact, 1, strlen($owner_contact));
					send_sms($phone_formatted, $sms_message);

					//send sms to owner/caretaker
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					send_sms($phone_formatted, $sms_message);

				}else{
					$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ." for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					send_sms($phone_formatted, $sms_message);
				}
				
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> Your Form Was Submitted.
				</div>");
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Business Occupant Already Accessed.
						 </div>");
			}
		}
		else if( $valid == 'expired' ){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Made a payment",
				'status' => true,
				'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is expired",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>Payment unsuccessful due to expired OTP code.Please try again
				</div>");
		}
		else if( $valid == 'invalid' ){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Made a payment",
				'status' => true,
				'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is invalid",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						 <strong>Sorry! </strong>Payment unsuccessful due to invalid OTP code.Please try again
					 </div>");
		}
		if($target == 0){
			redirect(base_url('onetime_invoice_payment/'.$invoice_no));
		}
		else {
			redirect(base_url('invoice_payment/'.$invoice_id));
		}

	}

	// process transaction reversal
	public function process_reversal(){
		$reversal_reference_id = $this->input->post('transaction_id');
		$id = $this->input->post('id');

		$get_transaction_detail = $this->TaxModel->get_transaction_detail($id);
		$invoice_no = $this->input->post('invoiceno');
		$target = $this->input->post('fromio');
		$payment_mode = $get_transaction_detail["payment_mode"];
		$transaction_id = random_string('numeric',10);

		$amount_paid = (float)$get_transaction_detail["amount"];//part payment
		$invoice_id = $get_transaction_detail["invoice_id"];
		$status = $get_transaction_detail["status"];

		if($target == 0){
			$get_invoice_detail = $this->TaxModel->get_invoice_amount($invoice_id);
		}else{
			$get_invoice_detail = $this->TaxModel->get_onetime_invoice_amount($invoice_id);
		}
		



		if($get_transaction_detail["reversal_status"] == 0 ){
			$actual_invoice_amount = (float)$get_invoice_detail['invoice_amount'];
			$transaction_id = random_string('numeric',10);
			$datetime = date("Y-m-d H:i:s");
			$payment_mode = $get_transaction_detail["payment_mode"];
			

			if($status == 0 ){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Made a payment reversal",
					'status' => false,
					'description' => "Made a payment reversal to a failed transaction with ID: $reversal_reference_id",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Failed Transactions Cannot be reversed.
						 </div>");

				
				redirect(base_url('transaction'));
				
			}else {
				$new_amount_paid = $get_invoice_detail['amount_paid'] - $amount_paid;
			}

			// where
			$where = array('id' => $invoice_id);

			// data to be updated
			$data = array('amount_paid' => number_format((float)$new_amount_paid , 2, '.', '') );

			// pass data and where clause to the model
			if($target == 0){
				$update_invoice_amount_paid = $this->TaxModel->update_invoice($data,$where);		
			}else{
				$update_invoice_amount_paid = $this->TaxModel->update_invoice_options($data,$where);
			}

			//
			// where
			$transaction_where = array('id' => $id);

			// data to be updated
			$transaction_data = array('reversal_status' => 1);

			$update_transaction = $this->TaxModel->update_transaction_status($transaction_data,$transaction_where);
			// update invoice status if $new_amount_paid <= $actual_invoice_amount or not
			//if(number_format((float)$actual_invoice_amount , 2, '.', '') <= number_format((float)$new_amount_paid , 2, '.', '') ){

			if($new_amount_paid > $invoice_amount_paid){
				$tran['status'] = 1;
			}else {
				$tran['status'] = 0;
			}

		// get transaction data and insert in transactions table
			$tran['invoice_id'] = $get_transaction_detail["invoice_id"];
			$tran['reversal_reference_id'] = $reversal_reference_id;
			$tran['transaction_id'] = $transaction_id;
			$tran['payment_mode'] = $get_transaction_detail["payment_mode"];
			$tran['gcr_no'] = $get_transaction_detail["gcr_no"];;
			$tran['valuation_no'] = $get_transaction_detail["valuation_no"];

			// check payment mode type
			$tran['mobile_operator'] = $get_transaction_detail["mobile_operator"];
			$tran['momo_number'] = $get_transaction_detail["momo_number"];
			$tran['momo_transaction_id'] = $get_transaction_detail["momo_transaction_id"];
			$tran['bank_name'] = $get_transaction_detail["bank_name"];
			$tran['bank_branch'] = $get_transaction_detail["bank_branch"];
			$tran['cheque_name'] = $get_transaction_detail["cheque_name"];
			$tran['cheque_no'] = $get_transaction_detail["cheque_no"];
			$tran['payment_type'] = $get_transaction_detail["payment_type"];
			$tran['reversal_status'] = 1;
			$tran['transaction_type'] = 'reversal';
			$tran['status'] = 1;
			
			$tran['amount'] = $get_transaction_detail["amount"];
			
			$tran['paid_by'] = $get_transaction_detail["paid_by"];
			
			// check who is making the payment
			
			$primary_contact = $this->input->post('phone_no');
			$tran['payer_name'] = $get_transaction_detail["payer_name"];
			$tran['payer_phone'] =  $get_transaction_detail["payer_phone"];
			
			$tran['fromIO'] = $target;
			$tran['channel'] = "Web";
			$tran['created_by'] = $this->session->userdata('user_info')['id'];
			$tran['collected_by'] = "admin";

			//insert into transactions table
			$insert_transaction = $this->TaxModel->insert_transaction($tran);

			if($insert_transaction){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Made a payment reversal",
					'status' => true,
					'description' => "Made a payment reversal to transaction ID: $reversal_reference_id",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> Your Form Was Submitted.
				</div>");
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Made a payment reversal",
					'status' => false,
					'description' => "Made a payment reversal to transaction ID: $reversal_reference_id but failed",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Transaction Reversal Failed.
						 </div>");
			}
		}else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Made a payment reversal",
				'status' => false,
				'description' => "Made a payment reversal to an already reversed transaction with ID: $reversal_reference_id",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert

			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						 <strong>Sorry! </strong>You can't reverse an already reversed transaction.
					 </div>");
		}
		redirect(base_url('transaction'));

	}


	// view invoice 2
	public function invoice2($id){

		$data = array(
			'title' => 'View Invoice',
			'page' => 'invoices/invoice2',
			'result' => json_decode($this->TaxModel->get_invoice_detail($id))
		);

		$this->load_page($data);
	}

	// view invoice 3
	public function invoice3($id){

		$data = array(
			'title' => 'View Invoice',
			'page' => 'invoices/invoice3',
			'result' => json_decode($this->TaxModel->get_invoice_detail($id))
		);

		$this->load_page($data);
	}

	// view invoice
	public function print_invoice($id){

		$data = array(
			'result' => json_decode($this->TaxModel->get_invoice_detail($id))
		);

		$this->load->view('invoices/print_invoice',$data);
	}

	// view invoice
	public function print_invoice2($id,$template){

		$data = array(
			'result' => json_decode($this->TaxModel->get_invoice_detail($id)),
			'template' => $template
		);

		$this->load->view('invoices/print_invoice3',$data);
	}

	// generate report for single invoice
	public function create_invoice_pdf($id){

		$mpdf = new \Mpdf\Mpdf(
			array(
				'tempDir' => BASEPATH . "../temp_pdf_dir",
				'format' => 'A4-L'
			)
		);

		$result = json_decode($this->TaxModel->get_invoice_detail_old($id));
		$imageUrls = array(
			base_url().'assets/img/elem.png',
			base_url().'assets/img/MCD_signature.png',
			base_url().'assets/img/MFO_signature.png',
			base_url().'assets/img/STAMP1.png',
			base_url().'assets/img/STAMP2.png',
			base_url().'assets/img/Coat_of_arms_of_Ghana.png',
		);
		$createdDate = date('Y-m-d', strtotime($result->date_created));
		$paymentDate = date('Y-m-d', $result->payment_due_date);
		$accessedBadge = "";
		if ($result->accessed == 1) {
			$accessedBadge = "<span class='badge badge-success'>Assessed</span>";
		} else {
			$accessedBadge = "<span class='badge badge-danger'>Unassessed</span>";
		}
		
		$addressHtml = "";
		if ($result->target == 3) {
			$addressHtml = (
				"<tr><td>$result->buis_name</td></tr>".
				"<tr><td>$result->buis_occ_code</td></tr>". 
				"<tr><td>$result->occ_town, Accra, Ghana</td></tr>"
			);
		} else if ($result->target == 2) {
			$addressHtml = (
				"<tr><td>$result->boName</td></tr>".
				"<tr><td>$result->buis_prop_code</td></tr>".
				"<tr><td>$result->town, Accra, Ghana</td></tr>"
			);
		} else if ($result->target == 1) {
			$addressHtml = "<tr><td>
				<a style='text-decoration: none;' href='#'>$result->roName</a>
			</td></tr>";
		}
		$arrears_paid = get_invoice_arrears(
			$result->property_id, $result->product_id, $result->invoice_year);
		$actual_arrears = (
			$arrears_paid['invoice_amount'] - $arrears_paid['amount_paid']
		);
		$invoice_amount = $result->invoice_amount;
		$penalty_amount = $result->penalty_amount;
		$discount_amount = $result->adjustment_amount;
		$total_amount = $invoice_amount + $penalty_amount + $actual_arrears;
		$invoiceDiscountAmount = (
			'GHS ' . number_format(
				(float) $invoice_amount + $discount_amount, 2, '.', ','
			)
		);
		$invoiceAdjustedAmount = (
			'GHS ' . number_format(
				(float) $invoice_amount + $result->adjustment_amount, 2,
				'.', ','
			)
		);
		$discountAmount = (
			'GHS ' . number_format((float) $discount_amount, 2, '.', ',')
		);
		$invoiceAmount = (
			'GHS ' . number_format((float)$invoice_amount, 2, '.', '')
		);
		$penaltyAmount = (
			'GHS ' . number_format((float)$penalty_amount, 2, '.', '')
		);
		$actualArrearsAmount = (
			'GHS ' . number_format((float)$actual_arrears, 2, '.', ',')
		);
		$totalAmount = (
			'GHS ' . number_format((float)$total_amount, 2, '.', ',')
		);
		$total_amount = (
			'GHS ' . number_format((float)($invoice_amount + $penalty_amount),
			2, '.', '')
		);
		$htmlTemplate = "
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title>Demystifying Email Design</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			</head>
			<body style='margin: 0; padding: 0;'>
			<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
			<td>
			
				<table align='center' border='0' cellpadding='0' cellspacing='0' width='1000' style='border-collapse: collapse;'>
			
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td>
										<h2 class='h2 mt-0 mb-1 text-dark font-weight-bold'>INVOICE</h2>
										<h6 class='h4 m-0 text-dark font-weight-bold' style='font-size:90%;'>#$result->invoice_no</h6>
									</td>
									<td>&nbsp;</td>
									<td align='right'>
										<table border='0' cellpadding='0'>
											<tr>
												<td>Ga North Municipal Assembly</td>
												<td rowspan='5'><img src='$imageUrls[0]' align='right' alt='Ga-north logo' style='width:9em;height:9em;' /></td>
											</tr>
											<tr>
												<td>P.O Box: OF 594</td>
											</tr>
											<tr>
												<td>Ofankor, Accra, Ghana</td>
											</tr>
											<tr>
												<td>GhanaPostGPS: GW-0450-8542</td>
											</tr>
											<tr>
												<td>Phone: 030 290 8086</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan='3'>
										<br>
										<hr/>				
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
			
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td align='left'>
										<table border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td>TO:</td>
											</tr>
											$addressHtml
										</table>
									</td>
									<td align='center'>&nbsp;</td>
									<td align='right'>
										<table border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td>Invoice Date:</td>
												<td>$createdDate</td>
											</tr>
											<tr>
												<td>Due Date:</td>
												<td>$paymentDate</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<thead>
									<tr>
										<th><h5>Payment Reason</h5></th>
										<th><h5>Main Category</h5></th>
										<th><h5>Service Type</h5></th>
										<th><h5>Business Type</h5></th>
										<th><h5>Category</h5></th>
										<th><h5>Amount</h5></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$result->name</td>
										<td>$result->category1</td>
										<td class='font-weight-semibold text-dark'>$result->category2</td>
										<td>$result->category3</td>
										<td align='center'>$result->category4</td>
										<td align='center'>$invoiceAdjustedAmount $accessedBadge</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td width='40%'>&nbsp;</td>
									<td width='45%'>&nbsp;</td>
									<td width='15%'>
										<table border='0' cellpadding='0' cellspacing='0' width='100%'>
											<tr>
												<td width='40%'>Subtotal</td>
												<td width='60%'>$invoiceDiscountAmount</td>
											</tr>
											<tr>
												<td width='40%'>Discount</td>
												<td width='60%'>$discountAmount</td>
											</tr>
											<tr>
												<td width='40%'>Penalty</td>
												<td width='60%'>$penaltyAmount</td>
											</tr>
											<tr>
												<td width='40%'>Arrears</td>
												<td width='60%'>$actualArrearsAmount</td>
											</tr>
											<tr>
												<td width='40%'>Total</td>
												<td width='60%'>$totalAmount</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td width='30%'>
										<img src='$imageUrls[5]' alt='Signature' style='width:12em;height:8em;' />
									</td>
									<td width='30%'></td>
									<td width='20%'>
										<img src='$imageUrls[1]' alt='Signature' style='width:12em;height:8em;margin-right:0.5em' />
										<img src='$imageUrls[2]' alt='Signature' style='width:12em;height:8em;' />
									</td>
									<td width='20%'>
										<img src='$imageUrls[3]' alt='Signature' style='width:12em;height:8em;margin-right:0.5em' />
										<img src='$imageUrls[4]' alt='Signature' style='width:12em;height:8em;' />
									</td>
								</tr>
								<tr>
									<td colspan='4'>
										<p>PAYMENT SHOULD BE MADE AT THE REVENUE OFFICE OR TO THE REVENUE OFFICER OF THE ASSEMBLY ON OR BEFORE $paymentDate. FAILURE TO DO SO, PROCEEDINGS WILL BE TAKEN FOR THE PURPOSE OF EXACTING SALE OR ENTRY INTO POSSESSION AND THE EXPENSES INCURRED
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			
			</td>
			</tr>
			</table>
			</body>	
			</html>";

		
		$tmpFileName = (new DateTime())->getTimestamp();
		$tempFilePath = BASEPATH."../invoices/${id}_$tmpFileName.pdf";
		$mpdf->WriteHTML($htmlTemplate);
		$mpdf->Output($tempFilePath);
		return $tempFilePath;
	}

	// view invoice
	public function create_consolidated_invoice_pdf($primaryContact){

		$mpdf = new \Mpdf\Mpdf(
			array(
				'tempDir' => BASEPATH . "../temp_pdf_dir",
				'format' => 'A4-L'
			)
		);

		$result = json_decode(
			$this->TaxModel->get_consolidated_invoice_detail($primaryContact));

		$imageUrls = array(
			base_url().'assets/img/elem.png',
			base_url().'assets/img/MCD_signature.png',
			base_url().'assets/img/MFO_signature.png',
			base_url().'assets/img/STAMP1.png',
			base_url().'assets/img/STAMP2.png',
			base_url().'assets/img/Coat_of_arms_of_Ghana.png',
		);
		$createdDate = ""; //date('Y-m-d', strtotime($result->date_created));
		$paymentDate = ""; //date('Y-m-d', $result->payment_due_date);
		$contact = $result->contact;
		
		$addressHtml = (
			"<tr><td>$contact->owner_name</td></tr>".
			"<tr><td>$contact->business_code</td></tr>".
			"<tr><td>$contact->town, Ghana</td></tr>"
		);

		$tableRows = "";

		$GeneralSubtotalAmount = (
			'GHS '.number_format(
				(float)$result->summary->subtotal + $result->summary->discount,
				2, '.', ','
			)
		);

		$GeneralDiscountAmount = (
			'GHS '.number_format(
				(float)$result->summary->discount, 2, '.', ','
			)
		);
		$GeneralPenaltyAmount = (
			'GHS '.number_format(
				(float)$result->summary->penalty_amount, 2, '.', ','
			)
		);
		$GeneralArrearsAmount = (
			'GHS '.number_format(
				(float)$result->summary->actual_arrears , 2, '.', ','
			)
		);
		$GeneralTotalAmount = (
			'GHS '.number_format(
				(float)$result->summary->subtotal, 2, '.', ','
			)
		);

		foreach($result->records as $row) {
			$accessedBadge = "";
			if ($row->accessed == 1) {
				$accessedBadge = "<span class='badge badge-success'>Assessed</span>";
			} else {
				$accessedBadge = "<span class='badge badge-danger'>Unassessed</span>";
			}
			$arrears_paid = get_invoice_arrears(
				$row->property_id, $row->product_id, $row->invoice_year);
			$actual_arrears = (
				$arrears_paid['invoice_amount'] - $arrears_paid['amount_paid']
			);
			$invoice_amount = $row->invoice_amount;
			$penalty_amount = $row->penalty_amount;
			$total_amount = $invoice_amount + $penalty_amount + $actual_arrears;
			$totalAmount = (
				'GHS ' . number_format((float)$total_amount, 2, '.', ',')
			);
			
			$tableRows .= (
				"<tr>
					<td>$row->invoice_no</td>
					<td>$row->buis_occ_code</td>
					<td>$row->name</td>
					<td>$row->category1</td>
					<td class='font-weight-semibold text-dark'>$row->category2</td>
					<td>$row->category3</td>
					<td class='text-center'>$row->category4<br/>$accessedBadge</td>
					<td class='text-center'>$totalAmount</td>
				</tr>"
			);
			
		}
		$htmlTemplate = "
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title>Demystifying Email Design</title>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			</head>
			<body style='margin: 0; padding: 0;'>
			<table border='0' cellpadding='0' cellspacing='0' width='100%'>
			<tr>
			<td>
			
				<table align='center' border='0' cellpadding='0' cellspacing='0' width='1000' style='border-collapse: collapse;'>
			
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td>
										<h2 class='h2 mt-0 mb-1 text-dark font-weight-bold'>INVOICE</h2>
										<h6 class='h4 m-0 text-dark font-weight-bold' style='font-size:90%;'></h6>
									</td>
									<td>&nbsp;</td>
									<td align='right'>
										<table border='0' cellpadding='0'>
											<tr>
												<td>Ga North Municipal Assembly</td>
												<td rowspan='5'><img src='$imageUrls[0]' align='right' alt='Ga-north logo' style='width:9em;height:9em;' /></td>
											</tr>
											<tr>
												<td>P.O Box: OF 594</td>
											</tr>
											<tr>
												<td>Ofankor, Accra, Ghana</td>
											</tr>
											<tr>
												<td>GhanaPostGPS: GW-0450-8542</td>
											</tr>
											<tr>
												<td>Phone: 030 290 8086</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan='3'>
										<br>
										<hr/>				
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
			
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td align='left'>
										<table border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td>TO:</td>
											</tr>
											$addressHtml
										</table>
									</td>
									<td align='center'>&nbsp;</td>
									<td align='right'>
										<table border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td>Invoice Date:</td>
												<td>$createdDate</td>
											</tr>
											<tr>
												<td>Due Date:</td>
												<td>$paymentDate</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<thead>
									<tr>
										<th><h5>Invoice No</h5></th>
										<th><h5>Business Code</h5></th>	
										<th><h5>Invoice Type</h5></th>
										<th><h5>Main Category</h5></th>
										<th><h5>Service Type</h5></th>
										<th><h5>Business Type</h5></th>
										<th><h5>Category</h5></th>
										<th><h5>Amount</h5></th>
									</tr>
								</thead>
								<tbody>$tableRows</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td width='40%'>&nbsp;</td>
									<td width='45%'>&nbsp;</td>
									<td width='15%'>
										<table border='0' cellpadding='0' cellspacing='0' width='100%'>
											<tr>
												<td width='40%'>Subtotal</td>
												<td width='60%'>$GeneralSubtotalAmount</td>
											</tr>
											<tr>
												<td width='40%'>Discount</td>
												<td width='60%'>$GeneralDiscountAmount</td>
											</tr>
											<tr>
												<td width='40%'>Penalty</td>
												<td width='60%'>$GeneralPenaltyAmount</td>
											</tr>
											<tr>
												<td width='40%'>Arrears</td>
												<td width='60%'>$GeneralArrearsAmount</td>
											</tr>
											<tr>
												<td width='40%'>Total</td>
												<td width='60%'>$GeneralTotalAmount</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table border='0' cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td width='30%'>
										<img src='$imageUrls[5]' alt='Signature' style='width:12em;height:8em;' />
									</td>
									<td width='30%'></td>
									<td width='20%'>
										<img src='$imageUrls[1]' alt='Signature' style='width:12em;height:8em;margin-right:0.5em' />
										<img src='$imageUrls[2]' alt='Signature' style='width:12em;height:8em;' />
									</td>
									<td width='20%'>
										<img src='$imageUrls[3]' alt='Signature' style='width:12em;height:8em;margin-right:0.5em' />
										<img src='$imageUrls[4]' alt='Signature' style='width:12em;height:8em;' />
									</td>
								</tr>
								<tr>
									<td colspan='4'>
										<p>PAYMENT SHOULD BE MADE AT THE REVENUE OFFICE OR TO THE REVENUE OFFICER OF THE ASSEMBLY ON OR BEFORE $paymentDate. FAILURE TO DO SO, PROCEEDINGS WILL BE TAKEN FOR THE PURPOSE OF EXACTING SALE OR ENTRY INTO POSSESSION AND THE EXPENSES INCURRED
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			
			</td>
			</tr>
			</table>
			</body>	
			</html>";

		
		$tmpFileName = (new DateTime())->getTimestamp();
		$tempFilePath = BASEPATH."../invoices/${primaryContact}_$tmpFileName.pdf";
		$mpdf->WriteHTML($htmlTemplate);
		$mpdf->Output($tempFilePath);
		return $tempFilePath;
	}
	
	// view invoice
	public function print_batch_invoice(){
		$product = $_POST['product'];
		$category1 = $_POST['category1'];
		$year = $_POST['year'];
		$spool = $_POST['spool'];
		$template = $_POST['template'];
		$electoral_area = $_POST['electoral_area'];
		$town = $_POST['town'];
		$offset = $_POST['offset'];
		$number = $_POST['invoice_number'];

		$data = array(
			'result' => json_decode($this->TaxModel->get_batch_invoices($product,$category1,$year,$electoral_area,$town,$offset,$spool)),
			'product' => $product,
			'category1' => $category1,
			'year' => $year,
			'spool' => $spool,
			'template' => $template,
			'electoral_area' => $electoral_area,
			'town' => $town,
			'offset' => $offset,
			'number' => $number,
		);

		$this->load->view('invoices/print_batch',$data);
	}


	// accessed property form
	public function accessed_property(){

		//set last page session
		$this->session->set_userdata('last_page', 'access_property');
		buildBreadCrumb(array(
			"url" => "accessed_property",
			"label" => "Accessed Property"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'access property')){
			$data = array(
				'title' => 'Access Business Property',
				'page' => 'invoices/accessed_property',
				'result' => $this->TaxModel->get_business_property(),
				'product' => $this->TaxModel->get_products(2)
			);

			$this->load_page($data);
		}else{
			$data = array(
					'title' => 'Permission',
					'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	// accessed property form
	public function accessed_business_occupant(){

		buildBreadCrumb(array(
			"url" => "accessed_business_occupant",
			"label" => "Accessed Business Occupant"
		));

		$data = array(
			'title' => 'Access Business Occupant',
			'page' => 'invoices/accessed_business_occupant',
      		'result' => $this->TaxModel->get_business_occ(),
			'product' => $this->TaxModel->get_products(3)
		);

		$this->load_page($data);
	}

	// accessed property form
	public function accessed_residence(){
		buildBreadCrumb(array(
			"url" => "accessed_residence",
			"label" => "Accessed Residence"
		));
		$data = array(
			'title' => 'Access Residence Property',
			'page' => 'invoices/accessed_residence',
			'result' => $this->TaxModel->get_residence(),
			'product' => $this->TaxModel->get_products(1)
		);

		$this->load_page($data);
	}

	// invoice page
  	public function invoice(){
		//set last page session
		$this->session->set_userdata('last_page', 'invoice');
		buildBreadCrumb(array(
			"url" => "invoice",
			"label" => "Invoice"
		), TRUE);

		// Set post parameters;
		$year = "";
		$product = "";
		$category1 = 0;
		$category2 = 0;
		$category3 = 0;
		$category4 = 0;
		$category5 = 0;
		$category6 = 0;

    	$data = array(
			'title' => 'Invoices',
			'page' => 'invoices/invoice',
			'search_by' => "Criteria",
			'year' => "",
			'product' => "",
			'category1' => 0,
			'category2' => 0,
			'category3' => 0,
			'category4' => 0,
			'category5' => 0,
			'category6' => 0,
			'category5s' => 0,
			'category6s' => 0,
			'keyword' => "",
			'products' => $this->TaxModel->get_all_products()
		);

   		$this->load_page($data);
  	}

	// invoice page
  	public function insert_accessed_property(){
		$product = $this->input->post("product");
		$property_id = $this->input->post("property_id");
		$rateable_amount = $this->input->post("rateable_amount");
    	$rate = $this->input->post("rate");
		$target = $this->input->post("target");

		// check if accessed record already exits
		$where = array(
			'product_id' => $product,
			'property_id' => $property_id,
			'target' => $target
		);

		$accessed = $this->TaxModel->checked_accessed($where);

		if($accessed){
			if($target == 1){
				$this->session->set_flashdata(
					'message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Residence Property Already Accessed.
					</div>");
				redirect(base_url('accessed_residence'));
			}elseif($target == 2){
				$this->session->set_flashdata(
					'message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Business Property Already Accessed.
					</div>");
				redirect(base_url('accessed_property'));
			}else{
				$this->session->set_flashdata(
					'message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Business Occupant Already Accessed.
					</div>");
				redirect(base_url('accessed_business_occupant'));
			}
		}else{
			$data  = array(
				'product_id' => $product,
				'property_id' => $property_id,
				'target' => $target,
				'rateable_value' => $rateable_amount,
				'rate' => $rate,
				'invoice_amount' => $rateable_amount * $rate
			);
			$insert = $this->TaxModel->insert_accessed_record($data);

			if($insert){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Accessed a property",
					'status' => true,
					'description' => "",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				if($target == 1){
					$update_data = array(
						'accessed' => 1
					);
					$where = array(
						'id' => $property_id
					);
					$update = $this->TaxModel->update_accessed_record(
						$where,$update_data,'residence');
					if($update){
						$this->session->set_flashdata(
							'message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
							</div>");
						redirect(base_url('accessed_residence'));
					}else{
						$this->session->set_flashdata(
							'message', "<div class='alert alert-danger'>
								<strong>Sorry! </strong>Your Form Was Not Submitted.
						 	</div>");
						redirect(base_url('accessed_property'));
					}
				}elseif($target == 2){
					$update_data = array(
						'accessed' => 1
					);
					$where = array(
						'id' => $property_id
					);
					$update = $this->TaxModel->update_accessed_record(
						$where,$update_data,'buisness_occ');
					if($update){
						$this->session->set_flashdata(
							'message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
							</div>");
						redirect(base_url('accessed_property'));
					}else{
						$this->session->set_flashdata(
							'message', "<div class='alert alert-danger'>
								<strong>Sorry! </strong>Your Form Was Not Submitted.
						 	</div>");
						redirect(base_url('accessed_property'));
					}
				}else{
					$update_data = array(
						'accessed' => 1
					);
					$where = array(
						'id' => $property_id
					);
					$update = $this->TaxModel->update_accessed_record(
						$where,$update_data,'buisness_property');
					if($update){
						$this->session->set_flashdata(
							'message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
							</div>");
						redirect(base_url('accessed_business_occupant'));
					}else{
						$this->session->set_flashdata(
							'message', "<div class='alert alert-danger'>
								<strong>Sorry! </strong>Your Form Was Not Submitted.
						 	</div>");
						 redirect(base_url('accessed_business_occupant'));
					}

				}
			}else{
				if($target == 1){
					$this->session->set_flashdata(
						'message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>Your Form Was Not Submitted.
						</div>");
					redirect(base_url('accessed_residence'));
				}elseif($target == 2){
					$this->session->set_flashdata(
						'message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>Your Form Was Not Submitted.
						</div>");
					redirect(base_url('accessed_property'));
				}else{
					$this->session->set_flashdata(
						'message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>Your Form Was Not Submitted.
						</div>");
					redirect(base_url('accessed_business_occupant'));
				}
			}
		}
  	}

	//	update client status
	public function update_print_status(){
		$id = $this->uri->segment(3);
		$state = $this->uri->segment(4);
		$update = $this->TaxModel->update_print_status($id,$state);
	}

	// fees invoice creation
	public function onetime_invoice_create_save($mode){
		if($mode == "save"){
			$id = $this->save_onetime_invoice();
			$number = str_pad($id, 5, '0', STR_PAD_LEFT);
			$code = $_POST['c_type_of_invoice_code'];
			$invid = "INV".$code.date('Y')."-".$number;
			$phone = $_POST['c_phone_number'];
			$amount = $_POST['c_amount'];
			$this->TaxModel->update_invoice_id($_POST['c_type_of_invoice_code'], $id);
			if($id > 0){
				$sms_message = "You have been created successfully on the ". SYSTEM_ID ." Revenue Platform You are required to pay an amount of GHS $amount. Your reference Code for payment is $invid.\nThank you";
				$phone_formatted = ((strlen($phone) > 10) && substr($phone, 0, 3) == '233') ? $phone : '233' . substr($phone, 1, strlen($phone));
				$sms_rs = send_sms($phone_formatted, $sms_message);

				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Saved a onetime invoice.",
					'status' => true,
					'description' => "Created a onetime invoice with invoice id: $invid",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> You have successfully saved fees invoice data.
				</div>");
				redirect(base_url('onetime_invoices'));
			}
		}
		else { //on creation
			$data = array(
				'title' => 'Onetime Invoice Creation',
				'page' => 'invoices/onetime_invoice_creation',
				'revenue_products' => json_decode($this->get_revenue_products()),
				'area' => $this->TaxModel->get_area_councils(),
			);

			$this->load_page($data);
		}
	}

	// fees invoice transactions
	public function onetime_invoices(){
		
		//set last page session
		$this->session->set_userdata('last_page', 'onetime');
		buildBreadCrumb(array(
			"url" => "onetime_invoices",
			"label" => "Onetime Invoice Transactions"
		), TRUE);

		$data = array(
			'title' => 'Onetime Invoice Transactions',
			'page' => 'invoices/onetime_invoices',
      		'onetime_transactions' => json_decode($this->get_onetime_transactions())
		);

		$this->load_page($data);
	}

	// process approval
	public function process_approval(){
		$invoice_id = $this->input->post("invoiceid");
		$adjustment_id = $this->input->post("adjustmentid");
		$adjustment_amount = $this->input->post("adjustment_amount");
		$adjustment_type = $this->input->post("adjustment_type");
		$current_status = $this->input->post("status");
		$approval_status = $this->input->post("approval_status");
		$reason = $this->input->post("reason");
		$invoice_type = $this->input->post("invoice_type");
		
		if($current_status == "p"){
			
			if($approval_status == "s"){
				
				if($invoice_type == "1"){
					// get invoice and adjustment amount from db
					$invoice = $this->TaxModel->get_onetime_invoice_adjustment_amount($invoice_id);
					

					if($adjustment_type == "-"){
						//set new invoice and adjustment amount
						$new_invoice_amount = $invoice['amount'] - $adjustment_amount;
						$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;
						$total_paid = $invoice['amount_paid'] + $invoice['adjustment_amount'] + $adjustment_amount;
						$invoice_amount = $invoice['amount'] - $total_paid;

						//set transaction type
						$tran['transaction_type'] = 'downward adjustment';

						//invoice data to be updated 
						$invoice_data = array(
							'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
							'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
						);
						
						if($invoice_amount < 0){
							$this->session->set_flashdata('message', "<div class='alert alert-danger'>
									<strong>Sorry! </strong> You cannot approve this adjustment.
							</div>");
							redirect(base_url('adjustment'));
						}
					}else if($adjustment_type == "+"){
						//set new invoice and adjustment amount
						$new_invoice_amount = $invoice['amount'] + $adjustment_amount;

						//set transaction type
						$tran['transaction_type'] = 'upward adjustment';

						//invoice data to be updated 
						$invoice_data = array(
							'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						);
						
					}

					// adjustment data to be updated
					$adjustment_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'approval_status' => $approval_status,
						'approval_reason' => $reason
					);
					$adjustment_where = array(
						'id' => $adjustment_id
					);
					

					$invoice_where = array(
						'id' => $invoice_id
					);

					// update adjustment data
					$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

					//update invoice data
					$invoice_update = $this->TaxModel->update_onetime_invoice($invoice_data,$invoice_where);

					if($adjustment_update && $invoice_update){

						$transaction_id = random_string('numeric',10);
						$datetime = date("Y-m-d H:i:s");
						// get transaction data and insert in transactions table
						$tran['invoice_id'] = $invoice_id;
						$tran['transaction_id'] = $transaction_id;
						// $tran['payment_mode'] = $get_transaction_detail["payment_mode"];
						// $tran['gcr_no'] = $get_transaction_detail["gcr_no"];;
						// $tran['valuation_no'] = $get_transaction_detail["valuation_no"];

						// check payment mode type
						// $tran['mobile_operator'] = $get_transaction_detail["mobile_operator"];
						// $tran['momo_number'] = $get_transaction_detail["momo_number"];
						// $tran['momo_transaction_id'] = $get_transaction_detail["momo_transaction_id"];
						// $tran['bank_name'] = $get_transaction_detail["bank_name"];
						// $tran['bank_branch'] = $get_transaction_detail["bank_branch"];
						// $tran['cheque_name'] = $get_transaction_detail["cheque_name"];
						// $tran['cheque_no'] = $get_transaction_detail["cheque_no"];
						// $tran['payment_type'] = $get_transaction_detail["payment_type"];
						$tran['reversal_status'] = 1;
						
						$tran['status'] = 1;
						
						$tran['amount'] = $adjustment_amount;
						
						// $tran['paid_by'] = $get_transaction_detail["paid_by"];
						
						// check who is making the payment
						
						// $primary_contact = $this->input->post('phone_no');
						// $tran['payer_name'] = $get_transaction_detail["payer_name"];
						// $tran['payer_phone'] =  $get_transaction_detail["payer_phone"];
						
						$tran['fromIO'] = $invoice_type;
						$tran['channel'] = "Web";
						$tran['created_by'] = $this->session->userdata('user_info')['id'];
						$tran['collected_by'] = "admin";

						//insert into transactions table
						$insert_transaction = $this->TaxModel->insert_transaction($tran);

						$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
						</div>");
						redirect(base_url('adjustment'));
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>Your Form Was Not Submitted.
						</div>");
						redirect(base_url('adjustment'));
					}

				}else{
					// get invoice and adjustment amount from db
					$invoice = $this->TaxModel->get_invoice_adjustment_amount($invoice_id);

					if($adjustment_type == "-"){
						//set new invoice and adjustment amount
						$new_invoice_amount = $invoice['invoice_amount'] - $adjustment_amount;
						$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;
						$total_paid = $invoice['amount_paid'] + $invoice['adjustment_amount'] + $adjustment_amount;
						$invoice_amount = $invoice['invoice_amount'] - $total_paid;

						//set transaction type
						$tran['transaction_type'] = 'downward adjustment';

						//invoice data to be updated 
						$invoice_data = array(
							'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
							'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
						);
						
						if($invoice_amount < 0){
							$this->session->set_flashdata('message', "<div class='alert alert-danger'>
									<strong>Sorry! </strong> You cannot approve this adjustment.
							</div>");
							redirect(base_url('adjustment'));
						}
					}else if($adjustment_type == "+"){
						//set new invoice and adjustment amount
						$new_invoice_amount = $invoice['invoice_amount'] + $adjustment_amount;

						//set transaction type
						$tran['transaction_type'] = 'upward adjustment';

						//invoice data to be updated 
						$invoice_data = array(
							'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						);
						
					}

					// adjustment data to be updated
					$adjustment_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'approval_status' => $approval_status,
						'approval_reason' => $reason
					);
					$adjustment_where = array(
						'id' => $adjustment_id
					);

					$invoice_where = array(
						'id' => $invoice_id
					);

					// update adjustment data
					$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

					//update invoice data
					$invoice_update = $this->TaxModel->update_invoice($invoice_data,$invoice_where);

					if($adjustment_update && $invoice_update){

						$transaction_id = random_string('numeric',10);
						$datetime = date("Y-m-d H:i:s");
						// get transaction data and insert in transactions table
						$tran['invoice_id'] = $invoice_id;
						$tran['transaction_id'] = $transaction_id;
						// $tran['payment_mode'] = $get_transaction_detail["payment_mode"];
						// $tran['gcr_no'] = $get_transaction_detail["gcr_no"];;
						// $tran['valuation_no'] = $get_transaction_detail["valuation_no"];

						// check payment mode type
						// $tran['mobile_operator'] = $get_transaction_detail["mobile_operator"];
						// $tran['momo_number'] = $get_transaction_detail["momo_number"];
						// $tran['momo_transaction_id'] = $get_transaction_detail["momo_transaction_id"];
						// $tran['bank_name'] = $get_transaction_detail["bank_name"];
						// $tran['bank_branch'] = $get_transaction_detail["bank_branch"];
						// $tran['cheque_name'] = $get_transaction_detail["cheque_name"];
						// $tran['cheque_no'] = $get_transaction_detail["cheque_no"];
						// $tran['payment_type'] = $get_transaction_detail["payment_type"];
						$tran['reversal_status'] = 1;
						
						$tran['status'] = 1;
						
						$tran['amount'] = $adjustment_amount;
						
						// $tran['paid_by'] = $get_transaction_detail["paid_by"];
						
						// check who is making the payment
						
						// $primary_contact = $this->input->post('phone_no');
						// $tran['payer_name'] = $get_transaction_detail["payer_name"];
						// $tran['payer_phone'] =  $get_transaction_detail["payer_phone"];
						
						$tran['fromIO'] = 0;
						$tran['channel'] = "Web";
						$tran['created_by'] = $this->session->userdata('user_info')['id'];
						$tran['collected_by'] = "admin";

						//insert into transactions table
						$insert_transaction = $this->TaxModel->insert_transaction($tran);
						$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
						</div>");
						redirect(base_url('adjustment'));
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>Your Form Was Not Submitted.
						</div>");
						redirect(base_url('adjustment'));
					}
				}
				
			}else{
				// adjustment data to be updated
				$adjustment_data = array(
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);

				// update adjustment data
				$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

				if($adjustment_update){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Your Form Was Not Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}
			}

		}else if($current_status == "s"){

			if($invoice_type == "1"){
				// get invoice and adjustment amount from db
				$invoice = $this->TaxModel->get_onetime_invoice_adjustment_amount($invoice_id);
				

				if($adjustment_type == "-"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['amount'] + $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] - $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
					);
					
				}else if($adjustment_type == "+"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['amount'] - $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					);
					
				}

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				$invoice_where = array(
					'id' => $invoice_id
				);

				// update adjustment data
				$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

				//update invoice data
				$invoice_update = $this->TaxModel->update_onetime_invoice($invoice_data,$invoice_where);

				if($adjustment_update && $invoice_update){
					$this->session->set_flashdata(
						'message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Your Form Was Not Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}
			}else{
				// get invoice and adjustment amount from db
				$invoice = $this->TaxModel->get_invoice_adjustment_amount($invoice_id);
				

				if($adjustment_type == "-"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['invoice_amount'] + $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] - $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
					);
					
				}else if($adjustment_type == "+"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['invoice_amount'] - $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					);
					
				}

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				$invoice_where = array(
					'id' => $invoice_id
				);

				// update adjustment data
				$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

				//update invoice data
				$invoice_update = $this->TaxModel->update_invoice($invoice_data,$invoice_where);

				if($adjustment_update && $invoice_update){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Your Form Was Not Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}
			}

		}else{

			if($invoice_type == "1"){
				// get invoice and adjustment amount from db
				$invoice = $this->TaxModel->get_onetime_invoice_adjustment_amount($invoice_id);
				

				if($adjustment_type == "-"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['amount'] - $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
					);
					
				}else if($adjustment_type == "+"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['amount'] + $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					);
					
				}

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);

				$invoice_where = array(
					'id' => $invoice_id
				);

				// update adjustment data
				$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

				//update invoice data
				$invoice_update = $this->TaxModel->update_onetime_invoice($invoice_data,$invoice_where);

				if($adjustment_update && $invoice_update){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Your Form Was Not Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}
			}else{
				// get invoice and adjustment amount from db
				$invoice = $this->TaxModel->get_invoice_adjustment_amount($invoice_id);
				
				if($adjustment_type == "-"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['invoice_amount'] - $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;


					//invoice data to be updated 
					$invoice_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
					);
					
				}else if($adjustment_type == "+"){
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['invoice_amount'] + $adjustment_amount;

					//invoice data to be updated 
					$invoice_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					);
					
				}


				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);

				$invoice_where = array(
					'id' => $invoice_id
				);

				// update adjustment data
				$adjustment_update = $this->TaxModel->update_adjustment($adjustment_data,$adjustment_where);

				//update invoice data
				$invoice_update = $this->TaxModel->update_invoice($invoice_data,$invoice_where);

				if($adjustment_update && $invoice_update){
					$this->session->set_flashdata('message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
						<strong>Sorry! </strong>Your Form Was Not Submitted.
					</div>");
					redirect(base_url('adjustment'));
				}
			}

		}

	}

	// process approval
	public function process_audit_approval(){
		$invoice_id = $this->input->post("invoiceid");
		$invoiceno = $this->input->post("invoiceno");
		$adjustment_id = $this->input->post("adjustmentid");
		$adjustment_amount = $this->input->post("adjustment_amount");
		$adjustment_type = $this->input->post("adjustment_type");
		$current_status = $this->input->post("status");
		$approval_status = $this->input->post("approval_status");
		$reason = $this->input->post("reason");
		$invoice_type = $this->input->post("invoice_type");
		$adjustment_type_name = "";

		if($adjustment_type == "-"){
			$adjustment_type_name = "Downward";
		}else if(adjustment_type =="+"){
			$adjustment_type_name = "Upward";
		}

		// adjustment data to be updated
		if($approval_status == 's'){
			$approval_text = "approved";
		}else if($approval_status == 'f'){
			$approval_text = "declined";
		}else{
			$approval_text = "";
		}
		
		if($current_status == "p"){
			
			$audit_data = array(
				'audit_approval' => $approval_status,
				'audit_comment' => $reason,
				'audit_by' => $this->session->userdata('user_info')['id']
			);
			$adjustment_where = array(
				'id' => $adjustment_id
			);

			// update adjustment data
			$audit_update = $this->TaxModel->update_adjustment($audit_data,$adjustment_where);

			if($audit_update){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Adjustment Audit Approval",
					'status' => true,
					'description' => "Audit $approval_text a $adjustment_type_name Adjustment of GHS $adjustment_amount for invoice no: $invoiceno",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> Your Form Was Submitted.
				</div>");
				redirect(base_url('adjustment'));
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Adjustment Audit Approval",
					'status' => false,
					'description' => "Audit $approval_text a $adjustment_type_name Adjustment of GHS $adjustment_amount for invoice no: $invoiceno",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>Your Form Was Not Submitted.
				</div>");
				redirect(base_url('adjustment'));
			}
		}else if($current_status == "s"){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Adjustment Audit Approval",
				'status' => false,
				'description' => "Audit $approval_text a $adjustment_type_name Adjustment of GHS $adjustment_amount for invoice no: $invoiceno failed because it had already been approved by finance",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Sorry! </strong>Sorry this request cannot be processed because the finance team has already approved this adjustment.
			</div>");
			redirect(base_url('adjustment'));

		}else{

			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Adjustment Audit Approval",
				'status' => false,
				'description' => "Audit $approval_text a $adjustment_type_name Adjustment of GHS $adjustment_amount for invoice no: $invoiceno failed because it had already been declined by finance",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Sorry! </strong>Sorry this request cannot be processed because the finance team has already declined this adjustment.
			</div>");
			redirect(base_url('adjustment'));

		}

	}

	public function get_onetime_transactions(){
		$CI = & get_instance();
		$result = $CI->db->query("select * from invoice_options order by id desc")->result_array();
		return json_encode($result);
	}

	public function get_onetime_invoice_pricing(){
		$CI = & get_instance();
		$column = $_POST['column'];
		$id = $_POST['id'];
		$result = $CI->db->query("select id, price1 from product_category6 where $column=$id")->result_array();
		echo json_encode($result);
	}

	public function save_onetime_invoice(){
		$today =  date('Y-m-d');
		$due_date = strtotime("+21 days", strtotime($today));
		if($_POST['invoice_for'] == '2'){
			$company = $_POST['company'];
		}else{
			$company = "";
		}
		$data = array(
			'status' => 'Pending',
			'ownership_type' => $_POST['c_ownership_type'],
			'phonenumber' => $_POST['c_phone_number'],
			'firstname' => $_POST['c_firstname'],
			'lastname' => $_POST['c_lastname'],
			'company_name' => $company,
			'house_number' => $_POST['c_house_number'],
			'area_council' => $_POST['c_area_council'],
			'town' => $_POST['c_town'],
			'revenue_product_id' => $_POST['type_of_invoice'],
			'revenue_product_name' => $_POST['c_type_of_invoice'],
			'category1' => $_POST['cat1'],
			'category2' => $_POST['cat2'],
			'category3' => $_POST['cat3'],
			'category4' => $_POST['cat4'],
			'category5' => $_POST['cat5'],
			'category6' => $_POST['cat6'],
			'amount' => $_POST['c_amount'],
			'product_category6_id' => $_POST['c_price_id'],
			'due_date' => $due_date
		);
		return $this->TaxModel->save_onetime_invoice($data);
	}

	public function get_revenue_products(){
	    $CI = & get_instance();
	    $result = $CI->db->query("select id, name, code from revenue_product where code is not NULL")->result_array();
	    return json_encode($result);
	}
        
  	public function get_product_category1(){
		$id = $_POST['id'];
		$table = $_POST['table'];
		$CI = & get_instance();
		$result = $CI->db->query("select id, name from product_category1 where product_id=$id")->result_array();
		echo json_encode($result);
	}

	public function get_product_category(){
		$id = $_POST['id'];
		$table = $_POST['table'];
		$column = $_POST['column'];
		$CI = & get_instance();
		$result = $CI->db->query("select id, name from $table where $column=$id")->result_array();
		echo json_encode($result);
	}

	public function get_owner_details_by_phone(){ //make a db request and send data
		$phone = $_POST['phone_number'];
		$otype = $_POST['ownership_type'];
		$CI = & get_instance();
		$result = $CI->db->query("select p.firstname, p.lastname, a.code as area_code, a.name as area_name, t.town, t.code as town_code, p.houseno from property_owner p, area_council a, town t where p.area_council = a.id and p.town = t.id and p.primary_contact = '$phone'")->result_array();
		echo json_encode($result);
	}

	// batch print invoice
	public function batch_print_invoice(){
		//set last page session
		$this->session->set_userdata('last_page', 'batch_print_invoice');
		buildBreadCrumb(array(
			"url" => "batch_print_invoice",
			"label" => "Batch Print Invoice"
		), TRUE);
		
		if(has_permission($this->session->userdata('user_info')['id'],'batch_print_invoice')){
			$data = array(
				'title' => 'Batch Print Invoice',
				'page' => 'invoices/batch_print_invoice',
				'result' => $this->TaxModel->get_batches(),
				'area' => $this->TaxModel->get_area_councils(), 
				'products' => $this->TaxModel->get_all_products()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'
			);
			$this->load_page($data);
		}
	}

	public function save_batch_print_invoice(){
		$code = $this->TaxModel->get_batch_count();
		$final_code = $code + 1;
		$number = str_pad($final_code, 4, '0', STR_PAD_LEFT);
		$batch_no = "BAT".$number;
		$year = $_POST['year'];
		$electoral_area = $_POST['electoral_area'];
		$town = $_POST['town'];
		$product = $_POST['product'];
		$category1 = $_POST['category1'];
		if($this->TaxModel->batch_exit($product,$category1,$year,$electoral_area,$town)){
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>This batch already exit.
			</div>");
			redirect(base_url('batch_print_invoice'));
		}else{
			$data = array(
				'batch_no' => $batch_no,
				'product' => $product,
				'category1' => $category1,
				'year' => $year,
				'electoral_area' => $electoral_area,
				'town' => $town,
				'user_id' => $this->session->userdata('user_info')['id']
			);
			$save = $this->TaxModel->save_batch($data);
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
					<strong>Success! </strong>Batch Successfully Saved.
			</div>");
			redirect(base_url('batch_print_invoice'));
		}
	}

	public function send_otp(){
		$phone = $this->input->post('phone_no');
		$invoice_no = $this->input->post('invoice_no');
		$otp = rand(100100, 999999);
		$now = date("Y-m-d H:i:s");
		$start = new DateTime($now);
		$start->add(new DateInterval('PT5M'));
		$data = array(
			'status' => 'Pending',
			'expire_on' => $start->format("Y-m-d H:i:s"),
			'code' => $otp,
			'invoice_no' => $invoice_no,
			'phonenumber' => $phone
		);
		$this->TaxModel->save_otp_code($data);

		$amount = $this->input->post('amount');
		$sms_message = "Kindly confirm payment of $amount for invoice $invoice_no by sharing OTP $otp with the agent/collector.";
		$phone_formatted = ((strlen($phone) > 10) && substr($phone, 0, 3) == '233') ? $phone : '233' . substr($phone, 1, strlen($phone));
		$sms_rs = send_sms($phone_formatted, $sms_message);
		if(substr($sms_rs, 0, 4) == '1701'){
			$result = explode('|', $sms_rs);
		}else{
			$result = explode(':', $sms_rs);
		}
		echo json_encode(array('code' => $result[0], 'message' => $result[1]));
	}

	// get invoice ajax call
	public function invoiceList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->TaxModel->getInvoices($postData);

		echo json_encode($data);
	}

	// get trasactions ajax call
	public function transactionList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->TaxModel->getTransactions($postData);

		echo json_encode($data);
	}

	// get invoice distribution list ajax call
	public function invoiceDistributionList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->TaxModel->getInvoiceDistribution($postData);

		echo json_encode($data);
	}

	public function consolidated_invoice() {
		//set last page session
		$this->session->set_userdata('last_page', 'consolidated_invoice');
		buildBreadCrumb(array(
			"label" => "Consolidated Invoices",
			"url" => "consolidated_invoice"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'consolidated_invoice')){
			$data = array(
				'title' => 'Consolidated Invoices',
				'page' => 'invoices/consolidated_invoice.php'
			);
			$this->load_page($data);
		}else{
			$data = array(
					'title' => 'Permission',
					'page' => 'permission/error'
			);
			$this->load_page($data);
		}
		
	}

	// get consolated invoice ajax call
	public function consolidatedInvoiceList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->TaxModel->getConsolidatedInvoices($postData);

		echo json_encode($data);
	}

	// view invoice
	public function view_consolidated_invoice($primaryContact){
		//set last page session
		// $this->session->set_userdata('last_page', 'view_consolidated_invoice');
		$data = array(
			'title' => 'View Consolidated Invoice',
			'page' => 'invoices/view_consolidated_invoice',
			'result' => json_decode(
				$this->TaxModel->get_consolidated_invoice_detail(
					$primaryContact
				)
			)
		);

		$this->load_page($data);
	}

	public function print_consolidated_invoice($primaryContact) {
		$data = array(
			'result' => json_decode(
				$this->TaxModel->get_consolidated_invoice_detail(
					$primaryContact
				)
			)
		);

		$this->load->view('invoices/print_consolidated_invoice',$data);
	}

	public function send_invoice_sms() {
		$phoneNumbers = $this->input->post('phoneNumbers');
		$totalAmount = $this->input->post('total_amount');
		$penaltyAmount = $this->input->post('penalty_amount');
		$discountAmount = $this->input->post('discount_amount');
		$arrearsAmount = $this->input->post('arrears_amount');
		$msg = (
			"You have a bill of Total Amount of $totalAmount, which includes ".
			"a Penalty of $penaltyAmount, Discount of $discountAmount, and ".
			"Arrears of $arrearsAmount");

		if(is_null($phoneNumbers)) {
			return $this->output->set_content_type('application/json')
				->set_status_header(400)
				->set_output(
					json_encode(
						array(
							"result" => (
								"message wasn't sent because no numbers were attached".
								" to the message"
							)
						)
					)
				);
		} else {
			$phoneNumbers = json_decode($phoneNumbers);
		}

		foreach ($phoneNumbers as $phoneNumber) {
			if (!strcmp($phoneNumber, "") == 0) {
				send_sms(formatPhonenumber($phoneNumber), $msg);
			}
		}

		return $this->output->set_content_type('application/json')
			->set_status_header(200)
			->set_output(
				json_encode(array("result" => "message sent"))
			);
	}

	public function send_invoice_email($invoiceId) {
		$email = $this->input->post('email');
		$totalAmount = $this->input->post('total_amount');
		$penaltyAmount = $this->input->post('penalty_amount');
		$discountAmount = $this->input->post('discount_amount');
		$arrearsAmount = $this->input->post('arrears_amount');
		$msg = (
			"You have a bill of Total Amount of $totalAmount, which includes ".
			"a Penalty of $penaltyAmount, Discount of $discountAmount, and ".
			"Arrears of $arrearsAmount");

		if(is_null($email)) {
			return $this->output->set_content_type('application/json')
				->set_status_header(200)
				->set_output(
					json_encode(
						array(
							"result" => (
								"message wasn't sent because no destination email was ".
								"attached"
							)
						)
					)
				);
		}

		# Generate pdf that will be sent as email attachment
		$attachmentFile = $this->create_invoice_pdf($invoiceId);
		# NB i configured email setting in application/config/email.php
		$this->load->library('email');
		$this->email->from("test@gnerms.com");
        $this->email->to($email);
        $this->email->subject('Bill Summary');
		$this->email->message($msg);
		$this->email->attach(
			$attachmentFile, "attachment", "invoice.pdf");	
		unlink($attachmentFile);
		
		if ($this->email->send()) {
			return $this->output->set_content_type('application/json')
				->set_status_header(200)
				->set_output(
					json_encode(
						array(
							"result" => "Message has been delivered successfully"
						)
					)
				);
		}
		return $this->output->set_content_type('application/json')
			->set_status_header(400)
			->set_output(
				json_encode(
					array(
						"result" => (
							"There was an error sending the email kindly ".
							"try again"
						)
					)
				)
			);

	}

	public function send_consolidated_invoice_email($primaryContact) {
		$email = $this->input->post('email');
		$totalAmount = $this->input->post('total_amount');
		$penaltyAmount = $this->input->post('penalty_amount');
		$discountAmount = $this->input->post('discount_amount');
		$arrearsAmount = $this->input->post('arrears_amount');
		$msg = (
			"You have a bill of Total Amount of $totalAmount, which includes ".
			"a Penalty of $penaltyAmount, Discount of $discountAmount, and ".
			"Arrears of $arrearsAmount");

		if(is_null($email)) {
			return $this->output->set_content_type('application/json')
				->set_status_header(200)
				->set_output(
					json_encode(
						array(
							"result" => (
								"message wasn't sent because no destination email was ".
								"attached"
							)
						)
					)
				);
		}

		# Generate pdf that will be sent as email attachment
		$attachmentFile = $this->create_consolidated_invoice_pdf(
			$primaryContact);
		# NB i configured email setting in application/config/email.php
		$this->load->library('email');
		$this->email->from("test@gnerms.com");
        $this->email->to($email);
        $this->email->subject('Bill Summary');
		$this->email->message($msg);
		$this->email->attach(
			$attachmentFile, "attachment", "invoice.pdf");	
		unlink($attachmentFile);
		
		if ($this->email->send()) {
			return $this->output->set_content_type('application/json')
				->set_status_header(200)
				->set_output(
					json_encode(
						array(
							"result" => "Message has been delivered successfully"
						)
					)
				);
		}
		return $this->output->set_content_type('application/json')
			->set_status_header(400)
			->set_output(
				json_encode(
					array(
						"result" => (
							"There was an error sending the email kindly ".
							"try again"
						)
					)
				)
			);

	}

}