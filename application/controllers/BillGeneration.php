<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '../vendor/autoload.php';

class BillGeneration extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('TaxModel');
        $this->load->model('BillModel');
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

	// batch bill generation page
	public function batch_bill_generation(){

		//set last page session
		$this->session->set_userdata('last_page', 'batch_bill_generation');
		buildBreadCrumb(array(
			"url" => "transaction",
			"label" => "Transaction"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'batch_bill_generation')){
			$data = array(
				'title' => 'Batch Bill Generation',
				'page' => 'bills/batch_bill_generation',
				'bill_generation' => $this->BillModel->bill_generation(),
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
							'invoice_amount' => $compare['price1'],
							'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}

				}
			}else if($product->target == 2){
				$busprop = $this->TaxModel->get_business_prop(12);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 2
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
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.date('Y')."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
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
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 1){
				$busprop = $this->TaxModel->get_business_prop(13);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 1
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
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => date('Y')
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.date('Y')."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
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
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 4){
				$signage = $this->TaxModel->get_signage();
				foreach($signage as $sig){
					// if($bus->accessed == 1){
					// 	$where = array(
					// 		'property_id' => $bus->property_id,
					// 		'product_id' =>  $product->id,
					// 		'target' => 1
					// 	);
					// 	$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
					// 	$code = $this->TaxModel->get_code($product->id,date('Y'));
					// 	$final_code = $code + 1;
					// 	$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
					// 	$invoice_no = "INVN".$product->code.date('Y')."-".$number;
					// 	$today =  date('Y-m-d');
					// 	$day = strtotime("+21 days", strtotime($today));
					// 	$data = array(
					// 		'invoice_no' => $invoice_no,
					// 		'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
					// 		'payment_due_date' => $day,
					// 		'property_id' => $bus->property_id,
					// 		'product_id' => $product->id,
					// 		'invoice_amount' => $get_accessed_amount,
					// 		'invoice_year' => date('Y')
					// 	);
					// 	$update = $this->TaxModel->update_residence_property($bus->property_id);
					// 	$insert = $this->TaxModel->insert_invoice_record($data);
					// }else{
					$where = array(
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
					);
					$compare = $this->TaxModel->get_busocc_compare($where);
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
						'property_id' => $sig->id,
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
						'invoice_amount' => $compare['price1'],
						'invoice_year' => date('Y')
					);
					$update = $this->TaxModel->update_signage($sig->id);
					$insert = $this->TaxModel->insert_invoice_record($data);
					
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
	public function customised_generate_invoice($year){
		
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
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->busocc_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => $year
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
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
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
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}

				}
			}else if($product->target == 2){
				$busprop = $this->TaxModel->get_business_prop(12);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
						'invoice_no' => $invoice_no,
						'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
						'payment_due_date' => $day,
						'property_id' => $bus->property_id,
						'product_id' => $product->id,
						'invoice_amount' => $get_accessed_amount,
						'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $compare['price1'],
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 1){
				$busprop = $this->TaxModel->get_business_prop(13);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 1
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
						'invoice_no' => $invoice_no,
						'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
						'payment_due_date' => $day,
						'property_id' => $bus->property_id,
						'product_id' => $product->id,
						'invoice_amount' => $get_accessed_amount,
						'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $compare['price1'],
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
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
		$invoice_year = "2022";

    	foreach($products as $product){
      		if($product->target == 3){
				$bus_categories = $this->TaxModel
					->get_ungenerated_busocc_categories();
				foreach($bus_categories as $bus){

					if($bus->accessed){

						$where = array(
							'property_id' => $bus->busocc_id,
							'product_id' =>  $product->id,
							'target' => 3
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
						$today =  date('Y-m-d');
							
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->busocc_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_occ(
							$bus->busocc_id);
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
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
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
						'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 2){
				$busprop = $this->TaxModel->get_ungenerated_business_prop(12);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $compare['price1'],
							'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
            	}     
			}else if($product->target == 1){
				$busprop = $this->TaxModel->get_ungenerated_business_prop(13);
				foreach($busprop as $bus){
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 1
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'invoice_amount' => $get_accessed_amount,
							'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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
						$code = $this->TaxModel->get_code($product->id,$invoice_year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $compare['price1'],
							'invoice_year' => $invoice_year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
            	}
			}else if($product->target == 4){
				$signage = $this->TaxModel->get_ungenerated_signage();
				foreach($signage as $sig){
					// if($bus->accessed == 1){
					// 	$where = array(
					// 		'property_id' => $bus->property_id,
					// 		'product_id' =>  $product->id,
					// 		'target' => 1
					// 	);
					// 	$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
					// 	$code = $this->TaxModel->get_code($product->id,$invoice_year);
					// 	$final_code = $code + 1;
					// 	$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
					// 	$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
					// 	$today =  date('Y-m-d');
					// 	$day = strtotime("+21 days", strtotime($today));
					// 	$data = array(
					// 		'invoice_no' => $invoice_no,
					// 		'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
					// 		'payment_due_date' => $day,
					// 		'property_id' => $bus->property_id,
					// 		'product_id' => $product->id,
					// 		'invoice_amount' => $get_accessed_amount,
					// 		'invoice_year' => $invoice_year
					// 	);
					// 	$update = $this->TaxModel->update_residence_property($bus->property_id);
					// 	$insert = $this->TaxModel->insert_invoice_record($data);
					// }else{
					$where = array(
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
					);
					$compare = $this->TaxModel->get_busocc_compare($where);
					$code = $this->TaxModel->get_code($product->id,$invoice_year);
					$final_code = $code + 1;
					$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
					$invoice_no = "INVN".$product->code.$invoice_year."-".$number;
					$today =  date('Y-m-d');
					$day = strtotime("+21 days", strtotime($today));
					$data = array(
						'invoice_no' => $invoice_no,
						'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
						'payment_due_date' => $day,
						'property_id' => $sig->id,
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
						'invoice_amount' => $compare['price1'],
						'invoice_year' => $invoice_year
					);
					$update = $this->TaxModel->update_signage($sig->id);
					$insert = $this->TaxModel->insert_invoice_record($data);
					
				}
			}
		}
		
		if($insert){
			$this->session->set_flashdata(
				'message', "<div class='alert alert-success'>
					<strong>Success! </strong> Your Form Was Submitted.
				</div>"
			);
			redirect(base_url('invoice'));
		}else{
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>No Pending Invoice To Be Generated.
				</div>"
			);
			redirect(base_url('invoice'));
		}
		
	}
    
    // generate batch bills
	public function generate_batch_bill(){
    	

        $pid = $this->input->post("product");
        $year = $this->input->post("year");
        $electoral_area = $this->input->post("electoral_area");
        $town = $this->input->post("town");
		$runtime = $this->input->post("runtime_type");
		$amount_type = $this->input->post("amount_type");
		$amount = $this->input->post("amount");
        $id = "";
		$count = 0;

        // get all products
        $products = $this->BillModel->get_product($pid);
		// exit(var_dump($products));
		foreach($products as $product){

			if($product->target == 3){
				$bus_categories = $this->BillModel->get_ungenerated_busocc_categories($electoral_area,$town,$runtime,$id);
				foreach($bus_categories as $bus){
					$count++;
					if($bus->accessed){
						$where = array( 
							'property_id' => $bus->busocc_id,
							'product_id' =>  $product->id,
							'target' => 3
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);

						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $get_accessed_amount;
						}
						//end amount type check
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->busocc_id,
							'product_id' => $product->id,
							'invoice_amount' => $inv_amount,
							'invoice_year' => $year
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

						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $compare['price1'];
						}
						//end amount type check

						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
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
							'invoice_amount' => $inv_amount,
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_occ($bus->busocc_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}

				}
			}else if($product->target == 2){
				$busprop = $this->BillModel->get_ungenerated_business_prop($electoral_area,$town,$runtime,$id,12);
				foreach($busprop as $bus){
					$count++;
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 2
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $get_accessed_amount;
						}
						//end amount type check
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
						'invoice_no' => $invoice_no,
						'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
						'payment_due_date' => $day,
						'property_id' => $bus->property_id,
						'product_id' => $product->id,
						'invoice_amount' => $inv_amount,
						'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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

						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $compare['price1'];
						}
						//end amount type check

						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $inv_amount,
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 1){
				$busprop = $this->BillModel->get_ungenerated_business_prop($electoral_area,$town,$runtime,$id,13);
				foreach($busprop as $bus){
					$count++;
					if($bus->accessed == 1){
						$where = array(
							'property_id' => $bus->property_id,
							'product_id' =>  $product->id,
							'target' => 1
						);
						$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $get_accessed_amount;
						}
						//end amount type check
						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'invoice_amount' => $inv_amount,
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
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

						//start check - amount type that was selected 
						if($amount_type == "fixed_amount"){
							$inv_amount = $amount;			
						}else{
							$inv_amount = $compare['price1'];
						}
						//end amount type check

						$code = $this->TaxModel->get_code($product->id,$year);
						$final_code = $code + 1;
						$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
						$invoice_no = "INVN".$product->code.$year."-".$number;
						$today =  date('Y-m-d');
						$day = strtotime("+21 days", strtotime($today));
						$data = array(
							'invoice_no' => $invoice_no,
							'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
							'payment_due_date' => $day,
							'property_id' => $bus->property_id,
							'product_id' => $product->id,
							'category1_id' => $bus->category1,
							'category2_id' => $bus->category2,
							'category3_id' => $bus->category3,
							'category4_id' => $bus->category4,
							'category5_id' => $bus->category5,
							'category6_id' => $bus->category6,
							'invoice_amount' => $inv_amount,
							'invoice_year' => $year
						);
						$update = $this->TaxModel->update_business_property($bus->property_id);
						$insert = $this->TaxModel->insert_invoice_record($data);
					}
				}
			}else if($product->target == 4){
				$signage = $this->TaxModel->get_ungenerated_signage($electoral_area,$town,$runtime,$id);
				foreach($signage as $sig){
					$count++;
					// if($bus->accessed == 1){
					// 	$where = array(
					// 		'property_id' => $bus->property_id,
					// 		'product_id' =>  $product->id,
					// 		'target' => 1
					// 	);
					// 	$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
					// 	$code = $this->TaxModel->get_code($product->id,date('Y'));
					// 	$final_code = $code + 1;
					// 	$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
					// 	$invoice_no = "INVN".$product->code.date('Y')."-".$number;
					// 	$today =  date('Y-m-d');
					// 	$day = strtotime("+21 days", strtotime($today));
					// 	$data = array(
					// 		'invoice_no' => $invoice_no,
					// 		'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
					// 		'payment_due_date' => $day,
					// 		'property_id' => $bus->property_id,
					// 		'product_id' => $product->id,
					// 		'invoice_amount' => $get_accessed_amount,
					// 		'invoice_year' => date('Y')
					// 	);
					// 	$update = $this->TaxModel->update_residence_property($bus->property_id);
					// 	$insert = $this->TaxModel->insert_invoice_record($data);
					// }else{
					$where = array(
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
					);
					$compare = $this->TaxModel->get_busocc_compare($where);

					//start check - amount type that was selected 
					if($amount_type == "fixed_amount"){
						$inv_amount = $amount;			
					}else{
						$inv_amount = $compare['price1'];
					}
					//end amount type check

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
						'property_id' => $sig->id,
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
						'invoice_amount' => $inv_amount,
						'invoice_year' => date('Y')
					);
					$update = $this->TaxModel->update_signage($sig->id);
					$insert = $this->TaxModel->insert_invoice_record($data);
					
				}
            }
            
		}
		
		$code = $this->TaxModel->get_batch_bill_count();
		$final_code = $code + 1;
		$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
	
		
		if($insert){

			$data = array(
				'batch_no' => "BBG".$number,
				'year' => $year,
				'product' => $pid,
				'area_council' => $electoral_area,
				'town' => $town,
				'runtime_type' => $runtime,
				'no_record' => $count,
				'amount_type' => $amount_type,
				'amount' => $amount,
				'status' => 1,
				'creator_category' => "admin",
				'created_by' => $this->session->userdata('user_info')['id']
			);
			
			$save = $this->BillModel->save_bill_batch($data);

            // insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Generated a bill",
				'status' => true,
				'description' => "$count bills were generated successfully",
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
			redirect(base_url('batch_bill_generation'));
		}else{

			$data = array(
				'batch_no' => "BBG".$number,
				'year' => $year,
				'product' => $pid,
				'area_council' => $electoral_area,
				'town' => $town,
				'runtime_type' => $runtime,
				'no_record' => $count,
				'amount_type' => $amount_type,
				'amount' => $amount,
				'creator_category' => "admin",
				'created_by' => $this->session->userdata('user_info')['id']
			);
			
			$save = $this->BillModel->save_bill_batch($data);

            // insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Generated a bill",
				'status' => false,
				'description' => "There were no bills to generate",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
            //end of insert
            
			$this->session->set_flashdata(
				'message', "<div class='alert alert-danger'>
					<strong>Sorry! </strong>No Pending Invoice To Be Generated.
				</div>"
			);
			redirect(base_url('batch_bill_generation'));
		}

	}

	// generate batch bills
	public function generate_single_bill(){
    	

        $pid = $this->input->post("product");
        $year = $this->input->post("year");
		$runtime = $this->input->post("runtime_type");
		$property_code = $this->input->post("property_code");
		$amount_type = $this->input->post("amount_type");
		$amount = $this->input->post("amount");
		$product_name = get_product_name($pid);
		$electoral_area = "";
		$town = "";
        $id = $this->input->post("property_id");
		$count = 0;

        // get all products
        $products = $this->BillModel->get_product($pid);
		// exit(var_dump($products));
		foreach($products as $product){

			if($product->target == 3){
				$bus_categories = $this->BillModel->get_ungenerated_busocc_categories($electoral_area,$town,$runtime,$id);
				foreach($bus_categories as $bus){
					$count++;
					// check if bill is already generated
					//start check
					$checkwhere = array( 
						'property_id' => $bus->busocc_id,
						'product_id' =>  $product->id,
						'target' => $product->target,
						'invoice_year' => $year
					);

					$check = $this->BillModel->check_invoice_exist($checkwhere);
					//end check

					if($runtime == "generation"){		
						if($check){
							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill generation for business occupant code: $property_code failed because an invoice with no: $invoice_no already exist for the same property";
							$status = false;
							$insert = false;						
						}else{

							//start bill generation

							//check if property is accessed
							if($bus->accessed){
								$where = array( 
									'property_id' => $bus->busocc_id,
									'product_id' =>  $product->id,
									'target' => 3
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $get_accessed_amount;
								}
								//end amount type check
								
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
								$today =  date('Y-m-d');
								
								$day = strtotime("+21 days", strtotime($today));
								$data = array(
									'invoice_no' => $invoice_no,
									'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
									'payment_due_date' => $day,
									'property_id' => $bus->busocc_id,
									'product_id' => $product->id,
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
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

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $compare['price1'];
								}
								//end amount type check
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
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
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
								);
								$update = $this->TaxModel->update_business_occ($bus->busocc_id);
								$insert = $this->TaxModel->insert_invoice_record($data);
							}
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							$msg = "$year $product_name bill with invoice no: $invoice_no was generated for business occupant code: $property_code using the $amount_type";
						}
					}else if($runtime == "update"){
						if($check){
							//start bill generation

							//check if property is accessed
							if($bus->accessed){
								$where = array( 
									'property_id' => $bus->busocc_id,
									'product_id' =>  $product->id,
									'target' => $product->target
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $get_accessed_amount - $check["adjustment_amount"];
								}
								//end amount type check

								$update_data = array(
									'invoice_amount' => $final_invoice_amount
								);

								$update_where = array(
									'id' => $check["id"]
								);
								
								$update = $this->TaxModel->update_business_occ($bus->busocc_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
		
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

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $compare['price1'] - $check["adjustment_amount"];
								}
								//end amount type check
								$update_data = array(
									'invoice_amount' => $final_invoice_amount,
									'category1_id' => $bus->category1,
									'category2_id' => $bus->category2,
									'category3_id' => $bus->category3,
									'category4_id' => $bus->category4,
									'category5_id' => $bus->category5,
									'category6_id' => $bus->category6
								);

								$update_where = array(
									'id' => $check["id"]
								);
								$update = $this->TaxModel->update_business_occ($bus->busocc_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
							}
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill for invoice no: $invoice_no and business property code: $property_code was updated using the $amount_type";
						}else{
							$msg = "$year $product_name bill update for business occupant code: $property_code failed because there was no bill found for the property per the selected criteria";
							$status = false;
							$insert = false;						
						}
					}else{
						$msg = "System Error: No operation performed";
						$status = false;
						$insert = false;						
					}	
				}
			}else if($product->target == 2){
				$busprop = $this->BillModel->get_ungenerated_business_prop($electoral_area,$town,$runtime,$id,12);
				foreach($busprop as $bus){
					$count++;

					// check if bill is already generated
					//start check
					$checkwhere = array( 
						'property_id' => $bus->property_id,
						'product_id' =>  $product->id,
						'target' => $product->target,
						'invoice_year' => $year
					);

					$check = $this->BillModel->check_invoice_exist($checkwhere);
					//end check

					if($runtime == "generation"){		
						if($check){
							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill generation for business property code: $property_code failed because an invoice with no: $invoice_no already exist for the same property";
							$status = false;
							$insert = false;						
						}else{

							//start bill generation

							//check if property is accessed
							if($bus->accessed == 1){
								$where = array(
									'property_id' => $bus->property_id,
									'product_id' =>  $product->id,
									'target' => $product->target
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $get_accessed_amount;
								}
								//end amount type check
								
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
								$today =  date('Y-m-d');
								$day = strtotime("+21 days", strtotime($today));
								$data = array(
									'invoice_no' => $invoice_no,
									'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
									'payment_due_date' => $day,
									'property_id' => $bus->property_id,
									'product_id' => $product->id,
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
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
								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $compare['price1'];
								}
								//end amount type check
								
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
								$today =  date('Y-m-d');
								$day = strtotime("+21 days", strtotime($today));
								$data = array(
									'invoice_no' => $invoice_no,
									'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
									'payment_due_date' => $day,
									'property_id' => $bus->property_id,
									'product_id' => $product->id,
									'category1_id' => $bus->category1,
									'category2_id' => $bus->category2,
									'category3_id' => $bus->category3,
									'category4_id' => $bus->category4,
									'category5_id' => $bus->category5,
									'category6_id' => $bus->category6,
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->TaxModel->insert_invoice_record($data);
							}		
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							$msg = "$year $product_name bill with invoice no: $invoice_no was generated for business property code: $property_code using the $amount_type";
						}
					}else if($runtime == "update"){
						if($check){
							//start bill generation

							//check if property is accessed
							if($bus->accessed){
								$where = array( 
									'property_id' => $bus->property_id,
									'product_id' =>  $product->id,
									'target' => $product->target
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
								$final_invoice_amount = $get_accessed_amount - $check["adjustment_amount"];

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $get_accessed_amount - $check["adjustment_amount"];
								}
								//end amount type check

								$update_data = array(
									'invoice_amount' => $final_invoice_amount
								);

								$update_where = array(
									'id' => $check["id"]
								);
								
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
		
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

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $compare['price1'] - $check["adjustment_amount"];
								}
								//end amount type check

								$update_data = array(
									'invoice_amount' => $final_invoice_amount,
									'category1_id' => $bus->category1,
									'category2_id' => $bus->category2,
									'category3_id' => $bus->category3,
									'category4_id' => $bus->category4,
									'category5_id' => $bus->category5,
									'category6_id' => $bus->category6
								);

								$update_where = array(
									'id' => $check["id"]
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
							}
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							//end check

							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill for invoice no: $invoice_no and business property code: $property_code was updated using the $amount_type";
						}else{
							$msg = "$year $product_name bill update for business property code: $property_code failed because there was no bill found for the property per the selected criteria";
							$status = false;
							$insert = false;						
						}
					}else{
						$msg = "System Error: No operation performed";
							$status = false;
							$insert = false;						
					}	
				}
			}else if($product->target == 1){
				$busprop = $this->BillModel->get_ungenerated_business_prop($electoral_area,$town,$runtime,$id,13);
				foreach($busprop as $bus){
					$count++;

					// check if bill is already generated
					//start check
					$checkwhere = array( 
						'property_id' => $bus->property_id,
						'product_id' =>  $product->id,
						'target' => $product->target,
						'invoice_year' => $year
					);

					$check = $this->BillModel->check_invoice_exist($checkwhere);
					//end check

					if($runtime == "generation"){		
						if($check){
							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill generation for business property code: $property_code failed because an invoice with no: $invoice_no already exist for the same property";
							$status = false;
							$insert = false;						
						}else{

							//start bill generation

							//check if property is accessed
							if($bus->accessed == 1){
								$where = array(
									'property_id' => $bus->property_id,
									'product_id' =>  $product->id,
									'target' => $product->target
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $get_accessed_amount;
								}
								//end amount type check
								
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
								$today =  date('Y-m-d');
								$day = strtotime("+21 days", strtotime($today));
								$data = array(
									'invoice_no' => $invoice_no,
									'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
									'payment_due_date' => $day,
									'property_id' => $bus->property_id,
									'product_id' => $product->id,
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
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
								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$inv_amount = $amount;			
								}else{
									$inv_amount = $compare['price1'];
								}
								//end amount type check
								
								$code = $this->TaxModel->get_code($product->id,$year);
								$final_code = $code + 1;
								$number = str_pad($final_code, 5, '0', STR_PAD_LEFT);
								$invoice_no = "INVN".$product->code.$year."-".$number;
								$today =  date('Y-m-d');
								$day = strtotime("+21 days", strtotime($today));
								$data = array(
									'invoice_no' => $invoice_no,
									'invoice_due_date' => strtotime(date("Y-m-d H:i:s")),
									'payment_due_date' => $day,
									'property_id' => $bus->property_id,
									'product_id' => $product->id,
									'category1_id' => $bus->category1,
									'category2_id' => $bus->category2,
									'category3_id' => $bus->category3,
									'category4_id' => $bus->category4,
									'category5_id' => $bus->category5,
									'category6_id' => $bus->category6,
									'invoice_amount' => $inv_amount,
									'invoice_year' => $year
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->TaxModel->insert_invoice_record($data);
							}		
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							$msg = "$year $product_name bill with invoice no: $invoice_no was generated for business property code: $property_code using the $amount_type";
						}
					}else if($runtime == "update"){
						if($check){
							//start bill generation

							//check if property is accessed
							if($bus->accessed){
								$where = array( 
									'property_id' => $bus->property_id,
									'product_id' =>  $product->id,
									'target' => $product->target
								);
								$get_accessed_amount =  $this->TaxModel->get_accessed_details($where);
								$final_invoice_amount = $get_accessed_amount - $check["adjustment_amount"];

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $get_accessed_amount - $check["adjustment_amount"];
								}
								//end amount type check

								$update_data = array(
									'invoice_amount' => $final_invoice_amount
								);

								$update_where = array(
									'id' => $check["id"]
								);
								
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
		
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

								//start check - amount type that was selected 
								if($amount_type == "fixed_amount"){
									$final_invoice_amount = $amount - $check["adjustment_amount"];			
								}else{
									$final_invoice_amount = $compare['price1'] - $check["adjustment_amount"];
								}
								//end amount type check

								$update_data = array(
									'invoice_amount' => $final_invoice_amount,
									'category1_id' => $bus->category1,
									'category2_id' => $bus->category2,
									'category3_id' => $bus->category3,
									'category4_id' => $bus->category4,
									'category5_id' => $bus->category5,
									'category6_id' => $bus->category6
								);

								$update_where = array(
									'id' => $check["id"]
								);
								$update = $this->TaxModel->update_business_property($bus->property_id);
								$insert = $this->BillModel->update_invoice_record($update_data,$update_where);
							}
							// end bill generation

							//check if bill was successfully generated
							if($insert){
								$status = true;
							}else{
								$status = false;
							}
							//end check

							$invoice_no = $check['invoice_no'];
							$msg = "$year $product_name bill for invoice no: $invoice_no and business property code: $property_code was updated using the $amount_type";
						}else{
							$msg = "$year $product_name bill update for business property code: $property_code failed because there was no bill found for the property per the selected criteria";
							$status = false;
							$insert = false;						
						}
					}else{
						$msg = "System Error: No operation performed";
							$status = false;
							$insert = false;						
					}	
				}
			}else if($product->target == 4){
				$signage = $this->TaxModel->get_ungenerated_signage($electoral_area,$town,$runtime,$id);
				foreach($signage as $sig){
					$count++;
					
					$where = array(
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
					);
					$compare = $this->TaxModel->get_busocc_compare($where);

					//start check - amount type that was selected 
					if($amount_type == "fixed_amount"){
						$inv_amount = $amount;			
					}else{
						$inv_amount = $compare['price1'];
					}
					//end amount type check
					
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
						'property_id' => $sig->id,
						'product_id' => $product->id,
						'category1_id' => $sig->category1,
						'category2_id' => $sig->category2,
						'category3_id' => $sig->category3,
						'category4_id' => $sig->category4,
						'category5_id' => $sig->category5,
						'category6_id' => $sig->category6,
						'invoice_amount' => $inv_amount,
						'invoice_year' => date('Y')
					);
					$update = $this->TaxModel->update_signage($sig->id);
					$insert = $this->TaxModel->insert_invoice_record($data);
					
				}
            }
            
		}
	
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Single bill $runtime",
			'status' => $status,
			'description' => "$msg",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert

		// check status
		if($status == true){
			$alert_type = "alert-success";
			$alert_msg = "Success";
		}else{
			$alert_type = "alert-danger";
			$alert_msg = "Sorry";
		}
		$this->session->set_flashdata(
			'message', "<div class='alert $alert_type'>
				<strong>$alert_msg! </strong> $msg
			</div>"
		);
		redirect($_SERVER['HTTP_REFERER']);
		
	}

}