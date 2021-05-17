<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('TaxModel');
		$this->load->helper('url');
		$this->load->helper('html');


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

		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			//get last date
			$last_date = $this->TaxModel->get_date();
			$data = array(
				'title' => 'Transactions',
				'page' => 'invoices/transaction',
				'search_by' => "Criteria",
				'start_date' => $last_date,
				'end_date' => "",
				'payment_mode' => "",
				'keyword' => "",
				'category' => "",
				'agentid' => "",
				'admin' => "",
				'status' => "",
				'transaction' => $this->TaxModel->get_transaction($last_date),
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
                        'transaction' => $this->TaxModel->search_transaction($search_by,$start_date,$end_date,$payment_mode,$keyword,$category,$agent,$admin,$status),
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
        $category1 = $this->input->post('category1');
        $category2 = $this->input->post('category2');
        $category3 = $this->input->post('category3');
        $category4 = $this->input->post('category4');
        $category5 = $this->input->post('category5s');
        $category6 = $this->input->post('category6s');
        $category5s = $this->input->post('category5');
        $category6s = $this->input->post('category6');
        $keyword = $this->input->post('keyword');

        $data = array(
            'title' => 'Invoices',
            'page' => 'invoices/invoice',
            'search_by' => $search_by,
            'product' => $product,
            'category1' => $category1,
            'category2' => $category2,
            'category3' => $category3,
            'category4' => $category4,
            'category5' => $category5,
            'category6' => $category6,
            'category5s' => $category5s,
            'category6s' => $category6s,
            'keyword' => $keyword,
            'products' => $this->TaxModel->get_all_products(),
            'result' => $this->TaxModel->search_invoice($search_by,$keyword,$product,$category1,$category2,$category3,$category4,$category5,$category6)
        );

        $this->load_page($data);
    }

// view invoice
	public function view_invoice($id){
		
		$data = array(
                    'title' => 'View Invoice',
                    'page' => 'invoices/view_invoice',
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
		if(has_permission($this->session->userdata('user_info')['id'],'make payment')){
			$data = array(
                            'title' => 'Pay Invoice',
                            'page' => 'invoices/invoice_payment',
                            'result' => $this->TaxModel->get_invoice_payment_detail($id)
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
		if(has_permission($this->session->userdata('user_info')['id'],'transaction')){
			//exit("hello");
			$data = array(
                            'title' => 'Invoice Transaction(s)',
                            'page' => 'invoices/invoice_transaction',
                            'result' => $this->TaxModel->get_invoice_payment_detail($id),
                            'transaction' => $this->TaxModel->get_invoice_transactions($id)
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
		if(has_permission($this->session->userdata('user_info')['id'],'invoice adjustment')){
			$data = array(
                            'title' => 'Invoice Adjustment',
                            'page' => 'invoices/invoice_adjustment',
                            'result' => $this->TaxModel->getInvoiceData($invoice_id)
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

	// view all adjustments
	public function view_adjustment(){
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

	public function adjustment(){
		$invoice_id = trim($this->input->post("invoice_id"));
		$invoice_type = trim($this->input->post("invoice_type"));
		$adjustment_amount = trim(number_format((float)$this->input->post("adjustment_amount"), 2, '.',''));
		$reason = trim($this->input->post("reason"));
		$approval_status = "p";
		$created_by = $this->session->userdata('user_info')['id'];
		$invoice_amount = trim(number_format((float)$this->input->post("invoice_amount"), 2, '.',''));
		$invoice_no = trim($this->input->post("invoice_no"));

		$data = array(
                    'invoice_id' => $invoice_id,
                    'invoice_type' => $invoice_type,
                    'adjustment_amount' => $adjustment_amount,
                    'reason' => $reason,
                    'approval_status' => $approval_status,
                    'created_by' => $created_by,
                    'invoice_amount' => $invoice_amount,
                    'invoice_no' => $invoice_no
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

			$this->session->set_flashdata('message', "<div class='alert alert-success'>
							<strong>Success! </strong> Your Form Was Submitted.
						</div>");
			
	 }else{
		$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Oh Snap! </strong> Your Form Was Not Submitted.
			</div>");
		
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

	public function print_onetime_invoice($invoice_id){
		if(has_permission($this->session->userdata('user_info')['id'],'print invoice')){
			$data = array(
                            'result' => json_decode($this->TaxModel->get_onetime_invoice_detail($invoice_id))
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
			$rs1 = $this->TaxModel->update_invoice_options(array('amount_paid' => ((float)$invdata->ii_amount_paid + (float)$invdata->amount)), array('id' => $invdata->ii_id));
		}else {
			$rs2 = $this->TaxModel->update_invoice(array('amount_paid' => ((float)$invdata->i_amount_paid + (float)$invdata->amount)), array('id' => $invdata->i_id));
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
			// check payment mode type
			if($this->input->post('payment_mode') == "Mobile Money"){
				$tran['mobile_operator'] = $this->input->post('mobile_operator');
				$tran['momo_number'] = $this->input->post('momo_number');
			}else if($this->input->post('payment_mode') == "Cheque"){
				$tran['bank_name'] = $this->input->post('bank_name');
				$tran['bank_branch'] = $this->input->post('bank_branch');
				$tran['cheque_name'] = $this->input->post('cheque_name');
				$tran['cheque_no'] = $this->input->post('cheque_no');
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
				$tran['payer_name'] = $this->input->post('name');
				$tran['payer_phone'] =  $this->input->post('phone_no');
			}else{
				if($target == 1){
					$owner = owner_details($property_id);
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else if($target == 2){
					$owner = business_owner_details($property_id);
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];

				}else if($target == 3){
					$owner = business_occ_owner_details($property_id);
					$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
					$tran['payer_phone'] =  $owner['primary_contact'];
				}else{
					$tran['payer_name'] =  $this->input->post('fullname');
					$tran['payer_phone'] =  $owner['phonenumber'];
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
				$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
				if($this->input->post('paid_by') == "others"){
					$primary_contact = $this->input->post('phone_no');
					$sms_message = "Your $payment_mode payment of GHS $amount_paid to EDA for $product has been completed at $datetime";
					$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
					$sms_message .= "\nTransaction ID: $transaction_id";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					send_sms($phone_formatted, $sms_message);
				}else{
					if($target == 1){

					}else if($target == 2){

					}else if($target == 3){

					}else{

					}
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
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
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
	public function print_invoice2($id){

		$data = array(
			'result' => json_decode($this->TaxModel->get_invoice_detail($id))
		);

		$this->load->view('invoices/print_invoice3',$data);
	}

// accessed property form
	public function accessed_property(){
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

    $data = array(
        'title' => 'Invoices',
        'page' => 'invoices/invoice',
        'search_by' => "Criteria",
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
        'products' => $this->TaxModel->get_all_products(),
        'result' => json_decode($this->TaxModel->get_invoice())
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
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Residence Property Already Accessed.
						 </div>");
				redirect(base_url('accessed_residence'));
			}elseif($target == 2){
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Business Property Already Accessed.
						 </div>");
				redirect(base_url('accessed_property'));
			}else{
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
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
					$update = $this->TaxModel->update_accessed_record($where,$update_data,'residence');
					if($update){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
						</div>");
						redirect(base_url('accessed_residence'));
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>
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
					$update = $this->TaxModel->update_accessed_record($where,$update_data,'buisness_occ');
					if($update){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
						</div>");
						redirect(base_url('accessed_property'));
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>
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
					$update = $this->TaxModel->update_accessed_record($where,$update_data,'buisness_property');
					if($update){
						$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
						</div>");
						redirect(base_url('accessed_business_occupant'));
					}else{
						$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							 <strong>Sorry! </strong>Your Form Was Not Submitted.
						 </div>");
						 redirect(base_url('accessed_business_occupant'));
					}

				}
			}else{
				if($target == 1){
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
								 <strong>Sorry! </strong>Your Form Was Not Submitted.
							 </div>");
					redirect(base_url('accessed_residence'));
				}elseif($target == 2){
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
								 <strong>Sorry! </strong>Your Form Was Not Submitted.
							 </div>");
					redirect(base_url('accessed_property'));
				}else{
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>
								 <strong>Sorry! </strong>Your Form Was Not Submitted.
							 </div>");
					redirect(base_url('accessed_business_occupant'));
				}
			}
		}
  }

// run tax assignment
  public function do_tax_assignment(){
    $products = $this->TaxModel->get_product();

    foreach($products as $product){
      if($product->target == 3){
        $bus_categories = $this->TaxModel->get_busocc_categories();
        foreach($bus_categories as $bus){
					if($bus->accessed){
						$where = array(
						 	'property_id' => $bus->busocc_id,
						 	'product_id' =>  $product->id,
						 	'target' => 3
						 );
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						//exit($get_accessed_amount);
	          $data = array(
							'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
	            'amount' => $get_accessed_amount,
	            'frequency' => "Per Anum",
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6
	          );
	          $insert = $this->TaxModel->insert_tax_assignment_record($data);
					}else{
						$where = array(
	            'product_id' => $product->id,
	            'category1_id' => $bus->category1,
	            'category2_id' => $bus->category2,
	            'category3_id' => $bus->category3,
	            'category4_id' => $bus->category4,
	            'category5_id' => $bus->category5,
	            'category6_id' => $bus->category6
	          );
	          $compare = $this->TaxModel->get_busocc_compare($where);
	          $data = array(
	            'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
	            'amount' => $compare['price1'],
	            'frequency' => $compare['unit_of_measure'],
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6
	          );
	          $insert = $this->TaxModel->insert_tax_assignment_record($data);
					}


        }
      }else if($product->target == 2){
				$busprop = $this->TaxModel->get_business_prop();
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$data = array(
							'property_id' => $bus->id,
							'product_id' => $product->id,
							'amount' => $get_accessed_amount,
							'frequency' => "Per Annum",
						);
						$insert = $this->TaxModel->insert_tax_assignment_record($data);
					}else{

					}
				}
			}
    }
    if($insert){
      exit("Records Inserted");
    }else{
      exit("something is wrong somewhere");
    }
  }

 // run tax assignment
  public function generate_invoice(){
    $products = $this->TaxModel->get_product();

    foreach($products as $product){
      if($product->target == 3){
        $bus_categories = $this->TaxModel->get_busocc_categories();
        foreach($bus_categories as $bus){

					if($bus->accessed){

						$where = array(
						 	'property_id' => $bus->busocc_id,
						 	'product_id' =>  $product->id,
						 	'target' => 3
						 );
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
	          $code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
						$today =  date('Y-m-d');
					
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
	            'invoice_amount' => $get_accessed_amount,
	            'invoice_year' => date('Y')
	          );
	          $insert = $this->TaxModel->insert_invoice_record($data);

					}else{
						$where = array(
	            'product_id' => $product->id,
	            'category1_id' => $bus->category1,
	            'category2_id' => $bus->category2,
	            'category3_id' => $bus->category3,
	            'category4_id' => $bus->category4,
	            'category5_id' => $bus->category5,
	            'category6_id' => $bus->category6,
	          );
	          $compare = $this->TaxModel->get_busocc_compare($where);
	          $code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 4, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
	          $today =  date('Y-m-d');
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
	            'invoice_amount' => $compare['price1'],
	            'invoice_year' => date('Y')
	          );
	          $insert = $this->TaxModel->insert_invoice_record($data);
					}

        }
      }else if($product->target == 2){
				$busprop = $this->TaxModel->get_business_prop();
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 4, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
	          $today =  date('Y-m-d');
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->id,
	            'product_id' => $product->id,
	            'invoice_amount' => $get_accessed_amount,
	            'invoice_year' => date('Y')
	          );
	          $insert = $this->TaxModel->insert_invoice_record($data);
					}else{

					}
				}
			}
    }
    if($insert){
      exit("Records Inserted");
    }else{
      exit("something is wrong somewhere");
    }
	}
	
	// run tax assignment
  public function generate_ungenerate_invoice(){
    $products = $this->TaxModel->get_product();

    foreach($products as $product){
      if($product->target == 3){
        $bus_categories = $this->TaxModel->get_ungenerated_busocc_categories();
        foreach($bus_categories as $bus){

					if($bus->accessed){

						$where = array(
						 	'property_id' => $bus->busocc_id,
						 	'product_id' =>  $product->id,
						 	'target' => 3
						 );
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
	          $code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
						$today =  date('Y-m-d');
					
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
	            'invoice_amount' => $get_accessed_amount,
	            'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
	          $insert = $this->TaxModel->insert_invoice_record($data);

					}else{
						$where = array(
	            'product_id' => $product->id,
	            'category1_id' => $bus->category1,
	            'category2_id' => $bus->category2,
	            'category3_id' => $bus->category3,
	            'category4_id' => $bus->category4,
	            'category5_id' => $bus->category5,
	            'category6_id' => $bus->category6,
	          );
	          $compare = $this->TaxModel->get_busocc_compare($where);
	          $code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 4, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
	          $today =  date('Y-m-d');
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->busocc_id,
	            'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
	            'invoice_amount' => $compare['price1'],
	            'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
	          $insert = $this->TaxModel->insert_invoice_record($data);
					}

        }
      }else if($product->target == 2){
				$busprop = $this->TaxModel->get_ungenerated_business_prop();
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,date('Y'));
	          $final_code = $code + 1;
	          $number = str_pad($final_code, 4, '0', STR_PAD_LEFT);
	          $invoice_no = "INVN".$product->code.date('Y')."-".$number;
	          $today =  date('Y-m-d');
	          $day = strtotime("+21 days", strtotime($today));
	          $data = array(
	            'invoice_no' => $invoice_no,
	            'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
	            'payment_due_date' => $day,
	            'property_id' => $bus->id,
	            'product_id' => $product->id,
	            'invoice_amount' => $get_accessed_amount,
	            'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_property($bus->id);
	          $insert = $this->TaxModel->insert_invoice_record($data);
					}else{

					}
				}
			}
    }
    if($insert){
      $this->session->set_flashdata('message', "<div class='alert alert-success'>
					<strong>Success! </strong> Your Form Was Submitted.
			</div>");
			redirect(base_url('invoice'));
    }else{
      $this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Sorry! </strong>No Pending Invoice To Be Generated.
						</div>");
			redirect(base_url('invoice'));
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
				$sms_message = "You have been created successfully on the EDA Revenue Platform You are required to pay an amount of GHS $amount. Your reference Code for payment is $invid.\nThank you";
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
	      'revenue_products' => json_decode($this->get_revenue_products())
			);

			$this->load_page($data);
		}
	}

// fees invoice transactions
	public function onetime_invoices(){
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
		$current_status = $this->input->post("status");
		$approval_status = $this->input->post("approval_status");
		$reason = $this->input->post("reason");
		$invoice_type = $this->input->post("invoice_type");
		
 
		if($current_status == "p"){
			if($approval_status == "s"){
				if($invoice_type == "1"){
					// get invoice and adjustment amount from db
					$invoice = $this->TaxModel->get_onetime_invoice_adjustment_amount($invoice_id);
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['amount'] - $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;

					// adjustment data to be updated
					$adjustment_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'approval_status' => $approval_status,
						'approval_reason' => $reason
					);
					$adjustment_where = array(
						'id' => $adjustment_id
					);
					
					//invoice data to be updated 
					$invoice_data = array(
						'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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
					//set new invoice and adjustment amount
					$new_invoice_amount = $invoice['invoice_amount'] - $adjustment_amount;
					$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;

					// adjustment data to be updated
					$adjustment_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'approval_status' => $approval_status,
						'approval_reason' => $reason
					);
					$adjustment_where = array(
						'id' => $adjustment_id
					);
					
					//invoice data to be updated 
					$invoice_data = array(
						'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
						'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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
				//set new invoice and adjustment amount
				$new_invoice_amount = $invoice['amount'] + $adjustment_amount;
				$new_adjustment_amount = $invoice['adjustment_amount'] - $adjustment_amount;

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				//invoice data to be updated 
				$invoice_data = array(
					'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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
				//set new invoice and adjustment amount
				$new_invoice_amount = $invoice['invoice_amount'] + $adjustment_amount;
				$new_adjustment_amount = $invoice['adjustment_amount'] - $adjustment_amount;

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				//invoice data to be updated 
				$invoice_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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
				//set new invoice and adjustment amount
				$new_invoice_amount = $invoice['amount'] - $adjustment_amount;
				$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				//invoice data to be updated 
				$invoice_data = array(
					'amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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
				//set new invoice and adjustment amount
				$new_invoice_amount = $invoice['invoice_amount'] - $adjustment_amount;
				$new_adjustment_amount = $invoice['adjustment_amount'] + $adjustment_amount;

				// adjustment data to be updated
				$adjustment_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'approval_status' => $approval_status,
					'approval_reason' => $reason
				);
				$adjustment_where = array(
					'id' => $adjustment_id
				);
				
				//invoice data to be updated 
				$invoice_data = array(
					'invoice_amount' => number_format((float)$new_invoice_amount , 2, '.', ''),
					'adjustment_amount' => number_format((float)$new_adjustment_amount , 2, '.', '')
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

	public function process_momo(){
		
	}
        

}
