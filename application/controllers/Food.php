<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once BASEPATH . '../vendor/autoload.php';

class Food extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Business_model','res');
		$this->load->model('FoodModel');
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
	
	//	page structure
	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }
	
	//	load add food vendor form
	public function add_food_vendor(){
		//set last page session
		$this->session->set_userdata('last_page', 'add_fv');

		if(has_permission($this->session->userdata('user_info')['id'],'view product')){
			
            $data = array(
				'title' => 'Add Food Vendor',
                'page' => 'food_vendor/add_food_vendor',
				'area' => $this->FoodModel->get_area_councils(),
				'towns' => $this->FoodModel->get_towns(),
			);
			$this->load_page($data);
        }else{
			$data = array(
				'title' => 'Development',
				'page' => 'permission/underdev'

			);
            $this->load_page($data);
		}
	}

		//save signage
		public function save_signage_record(){

			//outdoor owner name/town/seqnumber
			$ownercode = get_ownercode($this->input->post('outdoor_owner_name'));
			$towncode = get_towncode($this->input->post('town'));
			$private = "PVT";
			$assembly = SYSTEM_PREFIX;
			$serial_number = $this->FoodModel->serial_number();
			$outdoor_type = get_outdoor_type_letter($this->input->post('outdoor_type'));
			$gen_code = $assembly.$private.$towncode. str_pad($serial_number, 3, '0', STR_PAD_LEFT);
			$gen_code2 = $assembly.$ownercode.$towncode.$outdoor_type. str_pad($serial_number, 3, '0', STR_PAD_LEFT);

			/*put post data in the data array*/
			if($this->input->post('outdoor_category') === 'commercial'){
				$data['code'] = $gen_code2; 
			}else{
				$data['code'] = $gen_code; 
			}

			$data['outdoor_category'] = trim($this->input->post('outdoor_category'));
			$data['contact_name'] = trim($this->input->post('outdoor_owner_name'));
			$data['outdoor_others'] = trim($this->input->post('outdoor_others'));
			$data['outdoor_others'] = trim($this->input->post('business_name'));
			$data['buis_occ_code'] = trim($this->input->post('buis_occ_code'));
			$data['contact'] = trim($this->input->post('outdoor_owner_contact'));
			$data['signage_message'] = trim($this->input->post('adv_on_display'));
			$data['adv_contact'] = trim($this->input->post('adv_contact'));
			$data['area_council'] = trim($this->input->post('area_council'));
			$data['town'] = trim($this->input->post('town'));
			$data['outdoor_type'] = trim($this->input->post('outdoor_type'));
			$data['no_of_face'] = trim($this->input->post('no_of_face'));
			$data['shape'] = trim($this->input->post('shape'));
			$data['rating_mode'] = trim($this->input->post('rating_mode'));
			$data['unit_of_measure'] = trim($this->input->post('unit_of_measure'));
			$data['length'] = trim($this->input->post('length'));
			$data['height'] = trim($this->input->post('height'));
			$data['gps_lat'] = trim($this->input->post('gps_latitude'));
			$data['gps_long'] = trim($this->input->post('gps_longitude'));
			$data['created_id'] = $this->session->userdata('user_info')['id'];
			$data['created_by'] = "admin";	
			$data['category1'] = trim($this->input->post('cat1'));
			$data['category2'] = trim($this->input->post('cat2'));
			$data['category3'] = trim($this->input->post('cat3'));
			$data['category4'] = trim($this->input->post('cat4'));
			$data['category5'] = trim($this->input->post('cat5'));
			$data['category6'] = trim($this->input->post('cat6'));	
	
			
			$response=$this->FoodModel->save_signage_record($data);
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Signage Record",
			'status' => true,
			'user_category' => "Admin",
			'description' => "Added Signage record with code : $gen_code",
			'channel' => "Web",
		);
		$audit_tray = audit_tray($info);
         //end of insert
		 
			if($response==true){
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
				<strong>Success! </strong> Your Form Was Submitted.
			  </div>");

				}
			else{
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Signage Record",
				'status' => false,
				'user_category' => "Admin",
				'description' => "Form was not Submitted for Signage record with code: $gen_code failed",
				'channel' => "Web",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Success! </strong> Your Form Was Not Submitted.
			  </div>");

		}
		redirect('add_signage');

			}
	
		//	check for business occupant code exits in the database
		public function search_business_occ_code(){
			$search_value = strtoupper($this->uri->segment(3));
			$query = $this->FoodModel->get_business_occ_code($search_value);
			echo json_encode($query);
		}
	
	
	//	load add signage form
	public function add_signage(){
		//set last page session
		$this->session->set_userdata('last_page', 'add_signage');
		$breadCrumbs = buildBreadCrumb(array(
			"label" => "Add Signage Post",
			"url" => "add_signage"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'view product')){
			
			$data = array(
				'area' => $this->FoodModel->get_area_councils(),
				'outdoor' => $this->FoodModel->get_outdoor_vendors(),
				'title' => 'Add Signage Post',
				'page' => 'food_vendor/add_signage',
			);
		}else{
			$data = array(
				'title' => 'Development',
				'page' => 'permission/underdev'

			);
		}
		$data['bread_crumbs'] = $breadCrumbs;
		$this->load_page($data);
	}

	// get towns in selected area council on add residence form...
	public function get_area_towns(){
		// POST data
		$postdata = $this->input->post();
		// get data
		$data = $this->FoodModel->get_area_towns($postdata);
		echo json_encode($data);
	}

	//	load search food vendor page

	public function search_food_vendor(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$data = array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'title' => 'Food Vendor',
			'page' => 'food_vendor/food_vendor',
			'result' => $this->FoodModel->search_food_vendor($search_by,$start_date,$end_date,$search_item),
		);

		$this->load_page($data);
	}

	//	load signage vendor page

	public function search_signage(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$data = array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'title' => 'Signage',
			'page' => 'food_vendor/signage',
			'result' => $this->FoodModel->search_signage($search_by,$start_date,$end_date,$search_item),
		);

		$this->load_page($data);
	}

	//	load add food vendor form
    public function food_vendor(){
		
		// get last record from db
		$last_date = $this->FoodModel->get_date();
		
		//set last page session
		$this->session->set_userdata('last_page', 'view_fv');

        if(has_permission($this->session->userdata('user_info')['id'],'view product')){
            
            $data = array(
                'title' => 'Food Vendor',
                'page' => 'food_vendor/food_vendor',
                'start_date' => $last_date,
                'end_date' => '',
                'keyword' => '',
                'search_by' => 'Date',
                'area' => $this->FoodModel->get_area_councils(),
                'result' => $this->FoodModel->get_food_vendors($last_date)
            );
            $this->load_page($data);
        }else{
            $data = array(
                'title' => 'Development',
                'page' => 'permission/underdev'

            );
            $this->load_page($data);
        }
	}

	//	load signage post page
	public function signage(){
		//get last record date in the db
		$last_date = $this->FoodModel->get_signage_date();

		//set last page session
		$this->session->set_userdata('last_page', 'view_signage');
		buildBreadCrumb(array(
			"url" => "signage",
			"label" => "Signage"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'view product')){
			$product_array = array(4);
			$data = array(
				'title' => 'Signage',
				'page' => 'food_vendor/signage',
				'start_date' => $last_date,
				'end_date' => '',
				'keyword' => '',
				'search_by' => 'Date',
				'products' => $this->res->get_products($product_array),
				// 'result' => $this->FoodModel->get_signage_data(),
				'result' => $this->FoodModel->get_signage($last_date)

			);
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Development',
				'page' => 'permission/underdev'

			);
			$this->load_page($data);
		}
	}	

	//	load edit food vendor page

    public function edit_food_vendor_form($id){

        if(has_permission($this->session->userdata('user_info')['id'],'manage buis prop')){
            $data = array(
                'area' => $this->FoodModel->get_area_councils(),
                'page' => 'food_vendor/edit_food_vendor',
                'title' => 'Edit Food Vendor',
				'result' => $this->FoodModel->get_food_vendor_details($id),
				'towns' => $this->FoodModel->get_towns(),
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

	//	load edit signage page

	public function edit_signage_form($id){

		$breadCrumbs = buildBreadCrumb(array(
			"label" => "Edit Signage Post",
			"url" => "edit_signage_form/$id"
		));

		if(has_permission($this->session->userdata('user_info')['id'],'manage buis prop')){
			$data = array(
				'page' => 'food_vendor/edit_signage',
				'title' => 'Edit Signage Post',
				'area' => $this->FoodModel->get_area_councils(),
				'outdoor' => $this->FoodModel->get_outdoor_vendors(),
				'result' => $this->FoodModel->get_signage_details($id),
			);

		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
		}
		$data['breadCrumbs'] = $breadCrumbs;
		$this->load_page($data);
	}

	//	add new food vendor
	public function add_food_vendor_script(){
		$towncode = strtoupper(substr($this->input->post('vending_point'), 0, 3));
		$number = $this->FoodModel->food_number();
		$primary_contact = trim($this->input->post('phoneno'));
		$code = "FV".$towncode.str_pad($number, 4, '0', STR_PAD_LEFT);
		$data['fv_code'] = $code;
		$data['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$data['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$data['dob'] = trim($this->input->post('dob'));
		$data['phoneno'] = trim($this->input->post('phoneno'));
		$data['town'] = trim($this->input->post('town'));
		$data['area_council'] = trim($this->input->post('area_council'));
        $data['nationality'] = trim($this->input->post('nationality'));
        $data['vending_point'] = trim($this->input->post('vending_point'));
        $data['service_time'] = trim($this->input->post('service_time'));
        $data['cooking_source'] = trim($this->input->post('cooking_source'));
        $data['water_availability'] = trim($this->input->post('avai_of_water'));
        $data['food_type'] = trim($this->input->post('food_type'));
        $data['medically_certified'] = trim($this->input->post('medically_certified'));
        $data['cert_no'] = trim($this->input->post('cert_no'));
        $data['issuer'] = trim($this->input->post('issuer'));
        $data['year'] = trim($this->input->post('year'));
        $data['staff_no'] = trim($this->input->post('staff_no'));
        $data['certified_staff_no'] = trim($this->input->post('certified_staff_no'));
        $data['handler_no'] = trim($this->input->post('handlers_no'));
        $data['issuer'] = trim($this->input->post('issuer'));
        $data['created_by'] = "admin";
        $data['created_id'] = $this->session->userdata('user_info')['id'];
		if($this->input->post('nationality') === 'Ghanaian'){
            $data['id_type'] = trim($this->input->post('id_type'));
            $data['id_number'] = trim($this->input->post('id_number'));
		}else{
			$data['country'] = trim($this->input->post('country'));
			$data['nat_id_no'] = trim($this->input->post('nat_id_no'));
		}
		if($this->input->post('avai_of_water') == 'No'){
			$data['source_water'] = trim($this->input->post('source_water_no'));
		}else{
			$data['source_water'] = trim($this->input->post('source_water_yes'));
        }
        if($this->input->post('food_type') == 'Others'){
			$data['others'] = trim($this->input->post('others'));
		}else{
			
		}

		$food_vendor = $this->FoodModel->add_food_vendor($data);

		if(!$food_vendor){
			
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			$sms_message = "Your Food Joint has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Food Vendor Code is $code\nThank You";

			$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
			send_sms($phone_formatted, $sms_message);
			
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added a food vendor",
                'status' => true,
				'description' => "Added a food vendor with code: $code",
				'user_category' => "admin",
				'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success'>
                <strong>Success! </strong> Your Form Was Submitted.
            </div>");

		}
		redirect(base_url().'add_food_vendor');

    }
    
    //	edit business info data
	public function edit_personnal_data(){
		$id = $this->input->post('id');
		$code = $this->input->post('code');
		$data['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$data['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$data['dob'] = trim($this->input->post('dob'));
		$data['phoneno'] = trim($this->input->post('phoneno'));
		$data['town'] = trim($this->input->post('town'));;
		$data['area_council'] = trim($this->input->post('area_council'));
        $data['nationality'] = trim($this->input->post('nationality'));
        if($this->input->post('nationality') === 'Ghanaian'){
            $data['id_type'] = trim($this->input->post('id_type'));
            $data['id_number'] = trim($this->input->post('id_number'));
		}else{
			$data['country'] = trim($this->input->post('country'));
			$data['nat_id_no'] = trim($this->input->post('nat_id_no'));
		}

		$food_vendor = $this->FoodModel->update_food_vendor($data,$id);


		if(!$food_vendor){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a Food vendor data",
				'status' => true,
				'description' => "Edited a food vendor data with code: $code",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
		
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Food/edit_food_vendor_form/'.$id);

	}
	    //	edit business info data
		public function edit_signage_personnal_data(){
			$id = $this->input->post('id');
			$code = $this->input->post('code');
			$data['outdoor_category'] = trim($this->input->post('outdoor_category'));
			$data['contact_name'] = trim($this->input->post('outdoor_owner_name'));
			$data['contact'] = trim($this->input->post('contact'));
			$data['outdoor_others'] = trim($this->input->post('outdoor_others'));
			$response = $this->FoodModel->update_signage_data($data,$id);
	
	
			if(!$response == true){
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				  </div>");
			}
			else{
				echo "error";
				// insert into audit tray
				// $info = array(
				// 	'user_id' => $this->session->userdata('user_info')['id'],
				// 	'activity' => "Edited a Food vendor data",
				// 	'status' => true,
				// 	'description' => "Edited a food vendor data with code: $code",
				// 	'user_category' => "admin",
				// 	'channel' => "Web"
				// );
				// $audit_tray = audit_tray($info);
				//end of insert
			
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
						<strong>Success! </strong> Your Form Was Submitted.
					  </div>");
	
			}
			redirect(base_url().'Food/edit_signage_form/'.$id);
	
		}

    //	edit business info data
	public function edit_signage_location_data(){
		$id = $this->input->post('id');
		$code = $this->input->post('code');
        $data['area_council'] = trim($this->input->post('area_council'));
        $data['town'] = trim($this->input->post('town'));
        $data['outdoor_type'] = trim($this->input->post('outdoor_type'));
        $data['no_of_face'] = trim($this->input->post('no_of_face'));
		$data['shape'] = trim($this->input->post('shape'));


        // if($this->input->post('avai_of_water') == 'No'){
		// 	$data['source_water'] = trim($this->input->post('source_water_no'));
		// }else{
		// 	$data['source_water'] = trim($this->input->post('source_water_yes'));
        // }
		
		$response = $this->FoodModel->update_signage_data($data,$id);


		if(!$response){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			// $info = array(
			// 	'user_id' => $this->session->userdata('user_info')['id'],
			// 	'activity' => "Edited a Food vendor's location data",
			// 	'status' => true,
			// 	'description' => "Edited a food vendor's location data with code: $code",
			// 	'user_category' => "admin",
			// 	'channel' => "Web"
			// );
			// $audit_tray = audit_tray($info);
			//end of insert
		
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Food/edit_signage_form/'.$id);

    }
    
    //	edit tech info data
	public function edit_signage_tech_data(){
		$id = $this->input->post('id');
		$code = $this->input->post('code');
        $data['rating_mode'] = trim($this->input->post('rating_mode'));
        $data['unit_of_measure'] = trim($this->input->post('unit_of_measure'));
        $data['length'] = trim($this->input->post('length'));
        $data['height'] = trim($this->input->post('height'));
		$data['shape'] = trim($this->input->post('shape'));
		$data['gps_lat'] = trim($this->input->post('gps_latitude'));
		$data['gps_long'] = trim($this->input->post('gps_longitude'));

		// $data['category1'] = trim($this->input->post('cat1'));
		// $data['category2'] = trim($this->input->post('cat2'));
		// $data['category3'] = trim($this->input->post('cat3'));
		// $data['category4'] = trim($this->input->post('cat4'));
		// $data['category5'] = trim($this->input->post('cat5'));
		// $data['category6'] = trim($this->input->post('cat6'));	


        // if($this->input->post('avai_of_water') == 'No'){
		// 	$data['source_water'] = trim($this->input->post('source_water_no'));
		// }else{
		// 	$data['source_water'] = trim($this->input->post('source_water_yes'));
        // }
		
		$response = $this->FoodModel->update_signage_data($data,$id);


		if(!$response){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			// $info = array(
			// 	'user_id' => $this->session->userdata('user_info')['id'],
			// 	'activity' => "Edited a Food vendor's location data",
			// 	'status' => true,
			// 	'description' => "Edited a food vendor's location data with code: $code",
			// 	'user_category' => "admin",
			// 	'channel' => "Web"
			// );
			// $audit_tray = audit_tray($info);
			//end of insert
		
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Food/edit_signage_form/'.$id);

    }

	/*Delete telecom record*/
	public function delete_signage_records()
	{
		//get post data
		$id=$this->input->post('signage_id');
		$batch_no=$this->input->post('signage_code');

		//check if user has permission to delete
		if(!has_permission($this->session->userdata('user_info')['id'],'delete_property_business')){
		$alert_type = "alert-danger";
		$alert_msg = "Sorry";
		$msg = "Tried To Delete for record with code: $batch_no failed because user doesn't have the right.";
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Delete Record",
			'status' => false,
			'user_category' => "Admin",
			'description' => "Tried To Delete for record with code: $batch_no failed because user doesn't have the right.",
			'channel' => "Web",
		);
		$audit_tray = audit_tray($info);
			//end of insert

		}else {
			//if user has permission, allow to delete
		$response=$this->FoodModel->delete_signage_records($id);
		}

		if($response==true){
			$response = "success";
			$alert_type = "alert-success";
			$alert_msg = "Success";
			$msg = "Signage record with code: $batch_no deleted";
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Delete Record",
			'status' => true,
			'user_category' => "Admin",
			'description' => "Deleted signage record with code : $batch_no",
			'channel' => "Web",
		);
		$audit_tray = audit_tray($info);
		}else{
			$response = "failed";
			$alert_type = "alert-danger";
			$alert_msg = "Failed";
			$msg = "Signage record with code: $batch_no couldn't be deleted";
			// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Delete Record",
			'status' => false,
			'user_category' => "Admin",
			'description' => "Deleted for signage record with code : $batch_no failed",
			'channel' => "Web",
			);
			$audit_tray = audit_tray($info);
			//end of insert
		}
		
		$this->session->set_flashdata(
			'message', "<div class='alert $alert_type'>
				<strong>$alert_msg! </strong> $msg
			</div>"
		);
		redirect($_SERVER['HTTP_REFERER']);

	}
    //	edit business info data
	public function edit_tech_data(){
		$id = $this->input->post('id');
		$code = $this->input->post('code');
        $data['food_type'] = trim($this->input->post('food_type'));
        $data['medically_certified'] = trim($this->input->post('medically_certified'));
        $data['cert_no'] = trim($this->input->post('cert_no'));
        $data['issuer'] = trim($this->input->post('issuer'));
        $data['year'] = trim($this->input->post('year'));
        $data['staff_no'] = trim($this->input->post('staff_no'));
        $data['certified_staff_no'] = trim($this->input->post('certified_staff_no'));
        $data['handler_no'] = trim($this->input->post('handlers_no'));
        $data['issuer'] = trim($this->input->post('issuer'));

        if($this->input->post('food_type') == 'Others'){
			$data['others'] = trim($this->input->post('others'));
		}else{
			
		}
		
		$food_vendor = $this->FoodModel->update_food_vendor($data,$id);


		if(!$food_vendor){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a food vendor's technical data",
				'status' => true,
				'description' => "Edited a food vendor's technical data with code: $code",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
		
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Food/edit_food_vendor_form/'.$id);

	}

    

}