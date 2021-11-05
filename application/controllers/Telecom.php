<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telecom extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TelecomModel');
		$this->load->model('Business_model','res');
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

     	//	load add telecom form
         public function add_telecom(){
        //set last page session
        $this->session->set_userdata('last_page', 'add_telecom');
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Add Telecom Mast",
            "url" => "add_telecom"
        ), TRUE);

        if(has_permission($this->session->userdata('user_info')['id'],'view product')){
            
            $data = array(
                'area' => $this->TelecomModel->get_area_councils(),
                'telecomv' => $this->TelecomModel->get_telecom_vendors(),
                'telecomn' => $this->TelecomModel->get_telecom_networks(),
                'title' => 'Add Telecom Mast',
                'page' => 'telecom/add_telecom',
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
     // store telecom data
    public function save_telecom_record(){
        //contractor/network name/towncode  
        $network = get_network($this->input->post('network_name'));
        $vendor = get_vendor($this->input->post('vendor_name'));
        $towncode = get_towncode($this->input->post('town'));
        $assembly = SYSTEM_PREFIX;
        $serial_number = $this->TelecomModel->serial_number();

        $gen_code = $assembly.$vendor.$network.$towncode .str_pad($serial_number, 3, '0', STR_PAD_LEFT);
        
        $data['code'] = $gen_code; 
        $data['contact'] = trim($this->input->post('contact'));
        $data['telecom_vendor_name'] = trim($this->input->post('vendor_name'));
        $data['telecom_network_name'] = trim($this->input->post('network_name'));
        $data['site_name'] = trim($this->input->post('site_name'));
        $data['site_id'] = trim($this->input->post('site_id'));
        $data['area_council'] = trim($this->input->post('area_council'));
        $data['town'] = trim($this->input->post('town'));
        $data['ghanapost'] = trim($this->input->post('ghanapost'));
        $data['site_status'] = trim($this->input->post('site_status'));
        $data['rating_mode'] = trim($this->input->post('rating_mode'));
        $data['category1'] = trim($this->input->post('cat1'));
        $data['category2'] = trim($this->input->post('cat2'));
        $data['category3'] = trim($this->input->post('cat3'));
        $data['category4'] = trim($this->input->post('cat4'));
        $data['category5'] = trim($this->input->post('cat5'));
        $data['category6'] = trim($this->input->post('cat6'));	
        $data['gps_lat'] = trim($this->input->post('gps_lat'));
        $data['gps_long'] = trim($this->input->post('gps_long'));
        $data['created_id'] = $this->session->userdata('user_info')['id'];
        $data['created_by'] = "admin";	
                //property image upload
        //configure upload
        $config['upload_path'] = './upload/property/business_property';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $file_path = '';
            $image = "";
        } else {
            $file_data = $this->upload->data();

            $file_path = '/upload/telecom/';
            $image = $file_data['file_name'];
        }
        
        $response=$this->TelecomModel->save_telecom_record($data);
    // insert into audit tray
    $info = array(
        'user_id' => $this->session->userdata('user_info')['id'],
        'activity' => "Telecom Record",
        'status' => true,
        'user_category' => "Admin",
        'description' => "Added Telecom record with code : $gen_code",
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
            'activity' => "Telecom Record",
            'status' => false,
            'user_category' => "Admin",
            'description' => "Form was not Submitted for Telecom record with code: $gen_code failed",
            'channel' => "Web",
            );
            $audit_tray = audit_tray($info);
            //end of insert

            $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            <strong>Success! </strong> Your Form Was Not Submitted.
          </div>");

    }
    redirect('add_telecom');

    }
    
    	//	View telecom databale
	public function telecom(){
		//get last record date in the db
		$last_date = $this->TelecomModel->get_telecom_date();

		//set last page session
		$this->session->set_userdata('last_page', 'view_telecom');
		buildBreadCrumb(array(
			"url" => "telecom",
			"label" => "Telecom"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'view product')){
			$product_array = array(7);
			$data = array(
				'title' => 'Telecom',
				'page' => 'telecom/telecom',
				'start_date' => $last_date,
				'end_date' => '',
				'keyword' => '',
				'search_by' => 'Date',
				'products' => $this->res->get_products($product_array),
				'result' => $this->TelecomModel->get_telecom($last_date)

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
    	//	load edit telecom page

	public function edit_telecom_form($id){

		$breadCrumbs = buildBreadCrumb(array(
			"label" => "Edit Telecom Mast",
			"url" => "edit_telecom_form/$id"
		));

		if(has_permission($this->session->userdata('user_info')['id'],'manage buis prop')){
			$data = array(
				'page' => 'telecom/edit_telecom',
				'title' => 'Edit Telecom Mast',
				'area' => $this->TelecomModel->get_area_councils(),
                'telecomv' => $this->TelecomModel->get_telecom_vendors(),
                'telecomn' => $this->TelecomModel->get_telecom_networks(),
				'result' => $this->TelecomModel->get_telecom_details($id),
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

    	    //	edit telecom personal data
		public function edit_telecom_personnal_data(){
			$id = $this->input->post('id');
			$code = $this->input->post('code');
			$data['contact'] = trim($this->input->post('contact'));
			$data['telecom_vendor_name'] = trim($this->input->post('vendor_name'));
			$data['telecom_network_name'] = trim($this->input->post('network_name'));
			$data['site_name'] = trim($this->input->post('site_name'));
            $data['site_id'] = trim($this->input->post('site_id'));
			$response = $this->TelecomModel->update_telecom_data($data,$id);
	
	
			if(!$response == true){
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				  </div>");
			}
			else{
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
			redirect(base_url().'Telecom/edit_telecom_form/'.$id);
	
		}
        //	edit telecom location data
		public function edit_telecom_location_data(){
			$id = $this->input->post('id');
			$code = $this->input->post('code');
			$data['area_council'] = trim($this->input->post('area_council'));
			$data['town'] = trim($this->input->post('town'));
			$data['ghanapost'] = trim($this->input->post('ghanapost'));
			$response = $this->TelecomModel->update_telecom_data($data,$id);
	
	
			if(!$response == true){
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				  </div>");
			}
			else{
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
			redirect(base_url().'Telecom/edit_telecom_form/'.$id);
	
		}
        //	edit telecom technical data
		public function edit_telecom_technical_data(){
			$id = $this->input->post('id');
			$code = $this->input->post('code');
			$data['site_status'] = trim($this->input->post('site_status'));
			$data['rating_mode'] = trim($this->input->post('rating_mode'));
			$data['gps_lat'] = trim($this->input->post('gps_lat'));
			$data['gps_long'] = trim($this->input->post('gps_long'));
			$response = $this->TelecomModel->update_telecom_data($data,$id);
	
	
			if(!$response == true){
				 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				  </div>");
			}
			else{
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
			redirect(base_url().'Telecom/edit_telecom_form/'.$id);
	
		}

	/*Delete telecom record*/
	public function delete_telecom_records()
	{
		//get post data
		$id=$this->input->post('telecom_id');
		$batch_no=$this->input->post('telecom_code');

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
		$response=$this->TelecomModel->delete_telecom_records($id);
		}

		if($response==true){
			$response = "success";
			$alert_type = "alert-success";
			$alert_msg = "Success";
			$msg = "Telecom record with batch no: $batch_no deleted";
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Delete Record",
			'status' => true,
			'user_category' => "Admin",
			'description' => "Telecom record with batch no: $batch_no",
			'channel' => "Web",
		);
		$audit_tray = audit_tray($info);
		}else{
			$response = "failed";
			$alert_type = "alert-danger";
			$alert_msg = "Failed";
			$msg = "Telecom record with code: $batch_no couldn't be deleted";
			// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Delete Record",
			'status' => false,
			'user_category' => "Admin",
			'description' => "Delete for Telecom record with code: $batch_no failed",
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




}