<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PropertyOwner_model','prop');
		$this->load->model('Residence_model','res');
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

  	//load property owners page
  	public function property_owner(){

		//set last page session
		$this->session->set_userdata('last_page', 'property_owner');
		buildBreadCrumb(array(
			"url" => "property_owner",
			"label" => "Property Owner"
		), TRUE);
		
  		if(has_permission($this->session->userdata('user_info')['id'],'property owner')){
  			$data = array(
  				'title' => 'Property Owner',
  				'page' => 'property/property_owner',
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

	//	load edit property owners page
	public function edit_property_owner_form($id){

		if(has_permission($this->session->userdata('user_info')['id'],'manage prop owner')){
			$data = array(
				'page' => 'property/edit_property_owner',
				'title' => 'Manage Property Owner',
				'owner' => $this->prop->get_prop_owner_details($id),
				'area' => $this->res->get_area_councils(),
				'residence' => $this->prop->get_residence($id),
				'busprop' => $this->prop->get_business($id),
				'busocc' => $this->prop->get_business_occ($id)
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

	//	edit owner data
	public function edit_personnal_data(){

		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$owner['owner_native'] = trim($this->input->post('owner_native'));
		$owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$ownid= $this->input->post('ownid');
		if($this->input->post('religion') === "Others"){
			$owner['other_religion'] = $this->input->post('other_religion');
		}
		if($this->input->post('owner_native') == 'Yes, Resides In Property'){
			$owner['town'] = trim($this->input->post('owner_town'));
			$owner['area_council'] = trim($this->input->post('owner_area_council'));
			$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
			$owner['location'] = "";
			$owner['hometown'] = "";
			$owner['ethnicity'] = "";
			$owner['native_language'] = "";
			$owner['region'] = "";
		}elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
			$owner['location'] = trim($this->input->post('owner_location'));
			$owner['hometown'] = trim($this->input->post('owner_hometown'));
			$owner['home_district'] = trim($this->input->post('owner_home_district'));
			$owner['region'] = trim($this->input->post('owner_region'));
			$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
			$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
			$owner['native_language'] = trim($this->input->post('owner_native_language'));
			$owner['town'] = "";
			$owner['area_council'] = "";
			$owner['street_name'] = "";
			$owner['landmark'] = '';
			$owner['locality_code'] = "";
			$owner['street_code'] = "";
			$owner['new_property_no'] = "";
			$owner['old_property_no'] = "";
			$owner['zone_code'] = "";
			$owner['houseno'] = "";
		}else{
			$owner['town'] = trim($this->input->post('owner_town'));
			$owner['area_council'] = trim($this->input->post('owner_area_council'));
			$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
			$owner['location'] = "";
			$owner['hometown'] = "";
			$owner['home_district'] = "";
			$owner['ethnicity'] = "";
			$owner['native_language'] = "";
			$owner['region'] = "";
		}

		$owner_id = $this->res->update_owner($owner,$ownid);


		if(!$owner_id){
				$this->session->set_flashdata('message', "<div class='alert alert-danger'>
							<strong>Oh Snap! </strong> Your Form Was Not Submitted.
						</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a property owner's data",
				'status' => true,
				'description' => "",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
								<strong>Success! </strong> Your Form Was Submitted.
							</div>");

		}
		redirect(base_url().'Property/edit_property_owner_form/'.$ownid);

	}

	// get property owners ajax call
	public function propOwnerList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->prop->getPropertyOwners($postData);

		echo json_encode($data);
	}

}
