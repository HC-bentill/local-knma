 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once BASEPATH . '../vendor/autoload.php';

class Business extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Business_model','res');
		$this->load->model('Channelmodel');
		$this->load->model('TaxModel');
		$this->load->model('Residence_model');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('mixins');
		//$this->load->library('phpmailer');

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


	//	load business property page	

	public function business_prop(){

		//set last page session
		$this->session->set_userdata('last_page', 'view_busprop');
		buildBreadCrumb(array(
			"url" => "property",
			"label" => "Properties"
		), TRUE);

		// check if user has permission to render the view
		if(has_permission($this->session->userdata('user_info')['id'],'view buis prop')){
			$product_array = array(1,2);
			$data = array(
				'title' => 'Properties',
				'page' => 'business/business',
				'start_date' => '',
				'end_date' => '',
				'keyword' => '',
				'search_option' => '',
				'search_by' => 'Date',
				'products' => $this->res->get_products($product_array)
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

	//	load business property page

	public function search_business_property(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$search_option = $this->input->post('search_option');
		$data = array(
			'title' => 'Properties',
			'page' => 'business/business',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'search_option' => $search_option
		);

		$this->load_page($data);
	}

	// load residence map
	public function map(){
		//set last page session
		$this->session->set_userdata('last_page', 'busprop_map');

		if(has_permission($this->session->userdata('user_info')['id'],'view business map')){
			$data = array(
				'title' => 'Business Map',
				'page' => 'business/map',
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

	//	load add business property page

	public function add_business_property_form(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_busprop');
		$breadCrumbs = buildBreadCrumb(
			array(
				'label' => 'Property Creation',
				'url' => 'add_property'), TRUE);
		
		if(has_permission($this->session->userdata('user_info')['id'],'create buis prop')){
			$data = array(
				'area' => $this->res->get_area_councils(),
				'title' => 'Property Creation',
				'page' => 'business/add_business_prop',
				'construction' => $this->res->get_cons(),
				'roof' => $this->res->get_roof(),
				'prop_cat' => $this->res->get_prop_cat(),
				'com' => $this->res->get_community_needs(),
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

	//	load add business occupant page

	public function add_business_occupant_form(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_busocc');
		$breadCrumbs = buildBreadCrumb(
			array(
				'label' => 'Business Occupant Creation',
				'url' => 'add_business_occupant'), TRUE);
		
		if(has_permission($this->session->userdata('user_info')['id'],'create buis occ')){
			$data = array(
				'area' => $this->res->get_area_councils(),
				'title' => 'Business Occupant Creation',
				'page' => 'business/add_business_occ',
				'bread_crumbs' => $breadCrumbs,
				'bus_sector' => $this->res->get_bus_sector(),
				'prop_cat' => $this->res->get_prop_cat()
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error',
				'bread_crumbs' => $breadCrumbs

			);
			$this->load_page($data);
		}
	}

	//	load edit property page

	public function edit_business_property_form($id,$propcode){

		$breadCrumbs = buildBreadCrumb(
			array(
				'label' => 'Edit Business Property Details',
				'url' => "Business/edit_business_property_form/$id/$propcode"));
		
		if(has_permission($this->session->userdata('user_info')['id'],'manage buis prop')){
			$property_details = $this->res->get_business_details($id);

			$target = ($property_details['category'] == 12)?2:1;

			$get_property_needs = $this->res->get_property_needs($id);
			$needs ="";
			foreach ($get_property_needs as $get) {
				$needs .= $get->need_id.',';
			}


			$data = array(
				'area' => $this->res->get_area_councils(),
				'page' => 'business/edit_business',
				'title' => 'Edit Property Details',
				'result' => $this->res->get_business_prop_occ($propcode),
				'residence' => $property_details,
				'construction' => $this->res->get_cons(),
				'roof' => $this->res->get_roof(),
				'invoices' => $this->Residence_model->get_property_invoice($id,$target),
				'invoices_sum' => $this->res->get_property_invoice_sum($id,$target),
				'com' => $this->res->get_community_needs(),
				'needs' => rtrim($needs,','),
				'bread_crumbs' => $breadCrumbs
			);

			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error',
				'bread_crumbs' => $breadCrumbs
			);
			$this->load_page($data);
		}
	}

	//	load edit property page
	public function edit_business_occupant_form($id){

		$breadCrumbs = buildBreadCrumb(
			array(
				'label' => 'Edit Business Occupant Details',
				'url' => "Business/edit_business_occupant_form/$id"));
		if(has_permission($this->session->userdata('user_info')['id'],'manage buis occ')){
			$data = array(
				'area' => $this->res->get_area_councils(),
				'page' => 'business/edit_business_occ',
				'title' => 'Edit Business Occupant Details',
				'bus' => $this->res->get_business_occ_details($id),
				'bus_categories' => $this->res->get_business_occ_categories($id),
				'invoices' => $this->res->get_property_invoice($id,3),
				'invoices_sum' => $this->res->get_property_invoice_sum($id,3)
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

	// load business occupant page
	public function business_occupant(){
		
		//set last page session
		$this->session->set_userdata('last_page', 'view_busocc');
		buildBreadCrumb(array(
			"label" => "Business Occupants",
			"url" => "business_occupant"
		), TRUE);
		
		if(has_permission($this->session->userdata('user_info')['id'],'view buis occ')){
			$data = array(
				'start_date' => '',
				'end_date' => '',
				'keyword' => '',
				'search_option' => '',
				'search_by' => 'Date',
				'title' => 'Business Occupants',
				'page' => 'business/business_occupant',
				'products' => $this->res->get_products(3)
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

	// load business occupant page
  	public function business_occupant_category(){
      $last_date = $this->res->get_busocc_date();
  		if(has_permission($this->session->userdata('user_info')['id'],'view buis occ')){
  			$data = array(
				'start_date' => $last_date,
				'end_date' => '',
				'keyword' => '',
				'search_by' => 'Date',
				'title' => 'Business Occupants To Category',
				'page' => 'business/business_occupant_category',
				'result' => $this->res->get_business_occ_category($last_date)
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

	//	load search business occupant page
	public function search_busocc(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$search_option = $this->input->post('search_option');
		$data = array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'search_option' => $search_option,
			'title' => 'Business Occupants',
			'page' => 'business/business_occupant',
			'products' => $this->res->get_products(3)
		);

		$this->load_page($data);
	}

	//	load search business occupant page

	public function search_busocc_category(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$data = array(
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'title' => 'Business Occupants To Category',
			'page' => 'business/business_occupant_category',
			'result' => $this->res->search_business_occ_category($search_by,$start_date,$end_date,$search_item)
		);

		$this->load_page($data);
	}

	// get towns in selected area council on add residence form...
	public function get_area_towns(){
        // POST data
        $postdata = $this->input->post();
        // get data
        $data = $this->res->get_area_towns($postdata);
        echo json_encode($data);
    }


	//	add new residence
	public function add_business(){
		$areacode = get_areacode($this->input->post('area_council'));
		$towncode = get_towncode($this->input->post('town'));
		$category = $this->input->post('category');
		$com_needs = $this->input->post("com_needs");
		
		$code = $this->res->resnumber_new($this->input->post('area_council'),$this->input->post('town'),$category);
		$primary_contact = trim($this->input->post('primary_contact'));
		if($category == 12){
			$cat = "Business";
			if($this->input->post('buildingType') == "Temporary"){
				$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_BUSINESS_PROPERTY_TEM_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
			}else{
				$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_BUSINESS_PROPERTY_PER_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
			}
		}else{
			$cat = "Residential";
			$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_RESIDENTIAL_PROPERTY_PER_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
		}
		
	
		$config['upload_path'] = 'upload/property/business_property/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('prop_image')) {
			$file_path = '/upload/property/business_property/';
			$file_name = $this->upload->data('file_name');
			
		} else {
			$file_path = '';
			$file_name = '';			
		};

		
		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
        $owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		// $owner['owner_native'] = trim($this->input->post('owner_native'));
		// $owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['gender'] = trim($this->input->post('gender'));
		$owner['owner_pwd'] = trim($this->input->post('owner_pwd'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		$data['property_image'] = $file_name;
		$data['image_path'] = $file_path;
		$data['buis_prop_code'] = $gen_rescode;
		$data['town'] = trim($this->input->post('town'));
		$data['area_council'] = trim($this->input->post('area_council'));
		$data['year_of_construction'] = trim($this->input->post('year_of_construction'));
		$data['streetname'] = trim($this->input->post('streetname'));
		$data['landmark'] = trim($this->input->post('landmark'));
		$data['locality_code'] = $towncode;
		$data['street_code'] = trim($this->input->post('street_code'));
		$data['category'] = trim($this->input->post('category'));
		$data['new_property_no'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
		$data['old_property_no'] = trim($this->input->post('old_property_no'));
		$data['zone_code'] = $areacode;
		$data['houseno'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
		$data['location'] = trim($this->input->post('location'));
		$data['ghpost_gps'] = trim($this->input->post('ghpost_gps'));
		$data['property_type'] = trim($this->input->post('property_type2'));
		$data['no_of_rooms'] = trim($this->input->post('no_of_rooms'));
		//$data['sectorial_code'] = trim($this->input->post('sectorial_code'));
		$data['construction_material'] = trim($this->input->post('construction_material'));
		$data['roofing_type'] = trim($this->input->post('roofing_type'));
		$data['building_permit'] = trim($this->input->post('building_permit'));
		$data['planning_permit'] = trim($this->input->post('planning_permit'));
		$data['toilet_facility'] = $this->input->post('toilet_facility');
		$data['avai_of_water'] = $this->input->post('avai_of_water');
		$data['avai_of_refuse']= $this->input->post('avai_of_refuse');
		$data['avail_of_electricity']= $this->input->post('avail_of_electricity');
		$data['avail_of_telcom_network']= $this->input->post('avail_of_telcom_network');
		$data['building_status'] = trim($this->input->post('building_status'));
		$data['inhabitant_status'] = trim($this->input->post('inhabitant_status'));
		$data['no_of_residents'] = trim($this->input->post('no_of_residents'));
		$data['resident_greater_18'] = trim($this->input->post('resident_greater_18'));
		$data['building_type'] = $this->input->post('type_of_building');
		$data['noOfOccupants'] = trim($this->input->post('no_of_occupants'));
		$data['upn_number'] = trim($this->input->post('upn_number'));
		$data['no_of_pwd'] = trim($this->input->post('no_of_pwd'));
		$data['assessable_status'] = trim($this->input->post('property_assessment'));
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['agent_id'] = $this->session->userdata('user_info')['id'];
		$data['agent_category'] = "admin";
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$rate = trim($this->input->post('rate'));
		if($this->input->post('type_of_building') == "Temporary"){
			$data['temporary_building']= $this->input->post('detail_for_temp');
		}
		$data['code'] = $code;
		// if($this->input->post('religion') === "Others"){
		// 	$owner['other_religion'] = $this->input->post('other_religion');
		// }
		// if($this->input->post('owner_native') == 'Yes, Resides In Property'){
		// 	$owner['town'] = trim($this->input->post('town'));
		// 	$owner['area_council'] = trim($this->input->post('area_council'));
		// 	$owner['locality_code'] = $towncode;
		// 	$owner['zone_code'] = $areacode;
		// 	$owner['ghpostgps_code'] = trim($this->input->post('ghpost_gps'));
		// }elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
		// 	$owner['location'] = trim($this->input->post('owner_location'));
		// 	$owner['hometown'] = trim($this->input->post('owner_hometown'));
		// 	$owner['home_district'] = trim($this->input->post('owner_home_district'));
		// 	$owner['region'] = trim($this->input->post('owner_region'));
		// 	$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
		// 	$owner['native_language'] = trim($this->input->post('owner_native_language'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// }else{
		// 	$owner_areacode = get_areacode($this->input->post('owner_area_council'));
		// 	$owner_towncode = get_towncode($this->input->post('owner_town'));
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['locality_code'] = $owner_towncode;
		// 	$owner['zone_code'] = $owner_areacode;
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// }
		if($this->input->post('property_type') !== 'Compound'){
			$data['no_of_floors'] = trim($this->input->post('no_of_floors'));
		}else{
			$data['no_of_floors'] = "";
		}

		if($this->input->post('avail_of_telcom_network') == 'Yes'){
			$data['avail_of_telcom_network_yes'] = trim($this->input->post('telcom_network'));
		}else{
			$data['avail_of_telcom_network_yes'] = "";
		}
		if($this->input->post('building_permit') == 'Yes'){
			$data['building_cert_no'] = trim($this->input->post('building_cert_no'));
		}else{
			$data['building_cert_no'] = "";
		}
		if($this->input->post('planning_permit') == 'Yes'){
			$data['planning_permit_no'] = trim($this->input->post('planning_permit_no'));
		}else{
			$data['planning_permit_no'] = "";
		}
		if($this->input->post('toilet_facility') == 'Yes'){
			$data['t_facility_yes'] = $this->input->post('t_facility_yes');
			$data['no_of_toilet_facility'] = trim($this->input->post('no_of_toilet_facility'));
		}else{
			$data['t_facility_no'] = trim($this->input->post('t_facility_no'));
		}
		if($this->input->post('avai_of_water') == 'No'){
			$data['source_water_no'] = trim($this->input->post('source_water_no'));
		}else{
			$data['source_water_yes'] = trim($this->input->post('source_water_yes'));
		}
		if($this->input->post('avai_of_refuse') == 'Yes'){
			$data['dumping_site_yes'] = trim($this->input->post('dumping_site_yes'));
		}else{
			$data['dumping_site_no'] = trim($this->input->post('dumping_site_no'));
		}
		
		$bus_id = $this->res->add_business($data);

		if(owner_exit(trim($this->input->post('primary_contact')))){
			$owner_id = owner_exit(trim($this->input->post('primary_contact')));
		}else{
			$owner_id = $this->res->add_owner($owner);
		}

		foreach ($com_needs as $key => $value) {
        	$community_needs = array('property_id' => $bus_id ,'need_id' => $this->input->post("com_needs")[$key]);
        	$this->res->add_community_needs($community_needs);
        }

		$bus_to_owner = $this->res->add_bus_to_owner($bus_id,$owner_id);

		if($this->input->post('accessed_status') == 1){
			$data  = array(
				'product_id' => $category,
				'property_id' => $bus_id,
				'target' => ($category == 12)?2:1,
				'rateable_value' => $rateable_amount,
				'rate' => $rate,
				'invoice_amount' => $rateable_amount * $rate
			);
			$accessed = $this->TaxModel->insert_accessed_record($data);
		}else{
			
		}
		$category = array(
			'property_id' => $bus_id,
			'category1' => $this->input->post('cat1'),
			'category2' => $this->input->post('cat2'),
			'category3' => $this->input->post('cat3'),
			'category4' => $this->input->post('cat4'),
			'category5' => $this->input->post('cat5'),
			'category6' => $this->input->post('cat6'),
		);
		$bus_to_category = $this->res->add_bus_to_category($category);

		if(!$bus_id && !$owner_id && !$bus_to_owner){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{	
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added a property",
				'status' => true,
				'description' => "Added a $cat property with code: $gen_rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
		
			$echannelid = 1;
        	$echannel = $this->Channelmodel->channelstatus($echannelid);
        	if($echannel != 0){
        		$sms_message = "Your $cat Property has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour $cat Property Code is $gen_rescode\nThank You";

        		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
            	send_sms($phone_formatted, $sms_message);
            	$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
          		</div>");
			}
			else{
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
          		</div>");
			}

		}
		redirect('add_property');

	}

	//	add new business occupant
	public function add_business_occupant(){
		$bus_sector = get_category1_code($this->input->post('cat1'));
		$get_townid = get_townid($this->input->post('buis_property_code'));
		if(!$get_townid){
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
			<strong>Sorry! </strong> The Business Property Code Entered Was Invalid
			</div>");
			redirect('add_business_occupant');
		}
		$towncode = get_towncode($get_townid);

		$primary_contact = $this->input->post('buis_primary_contact');
		$code = $this->res->busnumber2($get_townid,$this->input->post('cat1'));
		$gen_rescode = SYSTEM_PREFIX.$towncode.$bus_sector. str_pad($code, 4, '0', STR_PAD_LEFT);
		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
        $owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		// $owner['owner_native'] = trim($this->input->post('owner_native'));
		// $owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['gender'] = trim($this->input->post('gender'));
		$owner['owner_pwd'] = trim($this->input->post('owner_pwd'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		$data['buis_name'] = trim($this->input->post('buis_name'));
		$data['buis_primary_phone'] = trim($this->input->post('buis_primary_contact'));
		$data['buis_secondary_phone'] = trim($this->input->post('buis_secondary_contact'));
		$data['buis_website'] = trim($this->input->post('buis_website'));
		$data['buis_occ_code'] = $gen_rescode;
		$data['buis_email'] = trim($this->input->post('buis_email'));
		$data['buis_property_code'] = trim($this->input->post('buis_property_code'));
		$data['year_of_est'] = trim($this->input->post('year_of_est'));
		$data['buis_reg_cert_no'] = trim($this->input->post('buis_reg_cert_no'));
		$data['no_of_employees'] = trim($this->input->post('no_of_employees'));
		$data['no_of_rooms'] = $this->input->post('no_of_rooms');
		$data['nature_of_buisness'] = $this->input->post('nature_of_buisness');
		$data['ownership']= $this->input->post('ownership');
		$data['subupn_number'] = trim($this->input->post('subupn_number'));
		$data['old_bus_code'] = trim($this->input->post('old_bus_code'));
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['agent_id'] = $this->session->userdata('user_info')['id'];
		$data['agent_category'] = "admin";
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$data['agent_id'] = $this->session->userdata('user_info')['id'];
		$data['agent_category'] = "admin";
		$rate = trim($this->input->post('rate'));
		$category['category1'] = trim($this->input->post('cat1'));
		$category['category2'] = trim($this->input->post('cat2'));
		$category['category3'] = trim($this->input->post('cat3'));
		$category['category4'] = trim($this->input->post('cat4'));
		$category['category5'] = trim($this->input->post('cat5'));
		$category['category6'] = trim($this->input->post('cat6'));
		// if($this->input->post('religion') === "Others"){
		// 	$owner['other_religion'] = $this->input->post('other_religion');
		// }
		// if($this->input->post('owner_native') == 'Yes, Resides In Property'){
		// 	$owner['town'] = trim($this->input->post('town'));
		// 	$owner['area_council'] = trim($this->input->post('area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('ghpost_gps'));
		// }elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
		// 	$owner['location'] = trim($this->input->post('owner_location'));
		// 	$owner['hometown'] = trim($this->input->post('owner_hometown'));
		// 	$owner['home_district'] = trim($this->input->post('owner_home_district'));
		// 	$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
		// 	$owner['native_language'] = trim($this->input->post('owner_native_language'));
		// 	$owner['region'] = trim($this->input->post('owner_region'));
		// }else{
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// }
		$data['code'] = $code;
		$data['type_of_building'] = $this->input->post('type_of_building');
		if($this->input->post('type_of_building') === 'Temporary'){
			$data['detail_for_temp'] = trim($this->input->post('detail_for_temp'));
		}

		if(owner_exit(trim($this->input->post('primary_contact')))){
			$owner_id = owner_exit(trim($this->input->post('primary_contact')));
		}else{
			$owner_id = $this->res->add_owner($owner);
		}
		$data['owner_id'] = $owner_id;
		$bus_id = $this->res->add_business_occ($data);
		$bus_to_owner = $this->res->add_busocc_to_owner($bus_id,$owner_id);
		$category['busocc_id'] = $bus_id;
		$category_insert = $this->res->add_business_occ_category($category);

		if($this->input->post('accessed_status') == 1){
			$data  = array(
				'product_id' => "1",
				'property_id' => $bus_id,
				'target' => "3",
				'rateable_value' => $rateable_amount,
				'rate' => $rate,
				'invoice_amount' => $rateable_amount * $rate,
				'valuation_number' => trim($this->input->post('valuation_number'))
			);
			$accessed = $this->TaxModel->insert_accessed_record($data);		
		}else{
			
		}

		if(!$bus_id && !$category_insert){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Added a business occupant",
					'status' => true,
					'description' => "Added a business occupant with code: $gen_rescode",
					'user_category' => "admin",
					'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
				
			$echannelid = 1;
			$echannel = $this->Channelmodel->channelstatus($echannelid);
			if($echannel != 0){
				$sms_message = "Your Business has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Business Identity Code is $gen_rescode.\nThank You";

				$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
				send_sms($phone_formatted, $sms_message);
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
				<strong>Success! </strong> Your Form Was Submitted.
				</div>");
			}
			else{
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
					<strong>Success! </strong> Your Form Was Submitted.
				</div>");
			}

		}
		redirect('add_business_occupant');

	}


	//	edit business info data
	public function edit_business_info_data(){
		$id = $this->input->post('id');
		$rescode = $this->input->post('bus_code');
		$data['buis_name'] = trim($this->input->post('buis_name'));
		$data['buis_primary_phone'] = trim($this->input->post('buis_primary_contact'));
		$data['buis_secondary_phone'] = trim($this->input->post('buis_secondary_contact'));
		$data['buis_website'] = trim($this->input->post('buis_website'));
		$data['buis_email'] = trim($this->input->post('buis_email'));
		$data['old_bus_code'] = trim($this->input->post('old_bus_code'));
		$data['buis_property_code'] = trim($this->input->post('buis_property_code'));

		$bus_id = $this->res->update_business_occ($data,$id);


		if(!$bus_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a business data",
				'status' => true,
				'description' => "Edited business occupant data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert

			$this->session->set_flashdata('message', "<div class='alert alert-success'>
			<strong>Success! </strong> Your Form Was Submitted.
			</div>");

		}
		redirect(base_url().'Business/edit_business_occupant_form/'.$id);

	}

	//	edit owner info data
	public function edit_owner_data(){
		$busocc_id = $this->input->post('id');
		$ownid = $this->input->post('ownid');
		$rescode = $this->input->post('bus_code');
		$update = $this->input->post('update_type');
		$original_primary_contact = $this->input->post('original_primary_contact');
		$primary_contact = trim($this->input->post('primary_contact'));

		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
        $owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$owner['gender'] = trim($this->input->post('gender'));
		$owner['owner_pwd'] = trim($this->input->post('owner_pwd'));
		// $owner['owner_native'] = trim($this->input->post('owner_native'));
		// $owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// if($this->input->post('religion') === "Others"){
		// 	$owner['other_religion'] = $this->input->post('other_religion');
		// }

		
		// if($this->input->post('owner_native') == 'Yes, Resides In Property'){
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['location'] = "";
		// 	$owner['hometown'] = "";
		// 	$owner['home_district'] = "";
		// 	$owner['ethnicity'] = "";
		// 	$owner['native_language'] = "";
		// 	$owner['region'] = "";
		// }elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
		// 	$owner['location'] = trim($this->input->post('owner_location'));
		// 	$owner['hometown'] = trim($this->input->post('owner_hometown'));
		// 	$owner['home_district'] = trim($this->input->post('owner_home_district'));
		// 	$owner['region'] = trim($this->input->post('owner_region'));
		// 	$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
		// 	$owner['native_language'] = trim($this->input->post('owner_native_language'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['town'] = "";
		// 	$owner['area_council'] = "";
		// }else{
        //                 $owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['location'] = "";
		// 	$owner['hometown'] = "";
		// 	$owner['home_district'] = "";
		// 	$owner['ethnicity'] = "";
		// 	$owner['native_language'] = "";
		// 	$owner['region'] = "";
		// }

		if($update == "update"){
			$owner_id = $this->res->update_owner($owner,$ownid);
		}else if($update == "detach"){
			if($primary_contact == $original_primary_contact){
				$owner_id = $this->res->update_owner($owner,$ownid);
			}else if($primary_contact !== $original_primary_contact){
				if(owner_exit(trim($this->input->post('primary_contact')))){
					$id = owner_exit(trim($this->input->post('primary_contact')));
					$owner_id = $this->res->update_busocc_to_owner($busocc_id,$id);
				}else{
					$id = $this->res->add_owner($owner);
					$owner_id = $this->res->update_busocc_to_owner($busocc_id,$id);
				}
			}
		}else{
			$owner_id = $this->res->update_owner($owner,$ownid);
		}

		if(!$owner_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a business occupant owner data",
				'status' => true,
				'description' => "Edited business occupant owner info with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
		
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_occupant_form/'.$busocc_id);

	}

	//	edit owner info data
	public function edit_business_category_data(){
		$id = $this->input->post('id');
		$rescode = $this->input->post('bus_code');
		$data['year_of_est'] = trim($this->input->post('year_of_est'));
		$data['buis_reg_cert_no'] = trim($this->input->post('buis_reg_cert_no'));
		$data['no_of_employees'] = trim($this->input->post('no_of_employees'));
		$data['no_of_rooms'] = $this->input->post('no_of_rooms');
		$data['nature_of_buisness'] = $this->input->post('nature_of_buisness');
		$data['ownership']= $this->input->post('ownership');
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['subupn_number'] = trim($this->input->post('subupn_number'));
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$rate = trim($this->input->post('rate'));
		$apid= $this->input->post('apid');
		//$data['code'] = $code;
		$data['type_of_building'] = $this->input->post('type_of_building');
		if($this->input->post('type_of_building') === 'Temporary'){
			$data['detail_for_temp'] = trim($this->input->post('detail_for_temp'));
		}else{
			$data['detail_for_temp'] = "";
		}

		if($this->input->post('accessed_status') == 1){
			if($apid){
				$data1  = array(
					'rateable_value' => $rateable_amount,
					'rate' => $rate,
					'invoice_amount' => $rateable_amount * $rate,
				);
				$accessed = $this->TaxModel->update_accessed_recordd($data1,$apid);
			}else{
				$data1  = array(
					'product_id' => "1",
					'property_id' => $id,
					'target' => "3",
					'rateable_value' => $rateable_amount,
					'rate' => $rate,
					'invoice_amount' => $rateable_amount * $rate,
				);
				$accessed = $this->TaxModel->insert_accessed_record($data1);	
			}
		}else{
			
		}

		$bus_id = $this->res->update_business_occ($data,$id);
		if(!$bus_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{	
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a business occupant category data",
				'status' => true,
				'description' => "Edited business occupant category with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_occupant_form/'.$id);

	}


	//	edit owner data
	public function edit_personnal_data(){

		$rescode = $this->input->post('busprop');
		$category = $this->input->post('category');
		$update = $this->input->post('update_type');
		$original_primary_contact = $this->input->post('original_primary_contact');
		$primary_contact = trim($this->input->post('primary_contact'));

		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
        $owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$owner['gender'] = trim($this->input->post('gender'));
		$owner['owner_pwd'] = trim($this->input->post('owner_pwd'));
		// $owner['owner_native'] = trim($this->input->post('owner_native'));
		// $owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		$resid= $this->input->post('resid');
		$ownid= $this->input->post('ownid');
		if($this->input->post('religion') === "Others"){
			$owner['other_religion'] = $this->input->post('other_religion');
		}
		if($category == 12){
			$cat = "Business";
		}else{
			$cat = "Residential";
		}

		if($update == "update"){
			$owner_id = $this->res->update_owner($owner,$ownid);
		}else if($update == "detach"){
			if($primary_contact == $original_primary_contact){
				$owner_id = $this->res->update_owner($owner,$ownid);
			}else if($primary_contact !== $original_primary_contact){
				if(owner_exit(trim($this->input->post('primary_contact')))){
					$id = owner_exit(trim($this->input->post('primary_contact')));
					$owner_id = $this->res->update_bus_to_owner($resid,$id);
				}else{
					$id = $this->res->add_owner($owner);
					$owner_id = $this->res->update_bus_to_owner($resid,$id);
				}
			}
		}else{
			$owner_id = $this->res->update_owner($owner,$ownid);
		}
		
		// if($this->input->post('owner_native') == 'Yes, Resides In Property'){
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['location'] = "";
		// 	$owner['hometown'] = "";
		// 	$owner['ethnicity'] = "";
		// 	$owner['native_language'] = "";
		// 	$owner['region'] = "";
		// }elseif($this->input->post('owner_native') == 'No'  || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
		// 	$owner['location'] = trim($this->input->post('owner_location'));
		// 	$owner['hometown'] = trim($this->input->post('owner_hometown'));
		// 	$owner['home_district'] = trim($this->input->post('owner_home_district'));
		// 	$owner['region'] = trim($this->input->post('owner_region'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
		// 	$owner['native_language'] = trim($this->input->post('owner_native_language'));
		// 	$owner['town'] = "";
		// 	$owner['area_council'] = "";
		// 	$owner['street_name'] = "";
		// 	$owner['landmark'] = '';
		// 	$owner['locality_code'] = "";
		// 	$owner['street_code'] = "";
		// 	$owner['new_property_no'] = "";
		// 	$owner['old_property_no'] = "";
		// 	$owner['zone_code'] = "";
		// 	$owner['houseno'] = "";
		// }else{
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['location'] = "";
		// 	$owner['hometown'] = "";
		// 	$owner['home_district'] = "";
		// 	$owner['ethnicity'] = "";
		// 	$owner['native_language'] = "";
		// 	$owner['region'] = "";
		// }
		if(!$owner_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a $cat property owner data",
				'status' => true,
				'description' => "Edited $cat property owner info with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_property_form/'.$resid.'/'.$rescode);

	}


	//	edit residence location data
	public function edit_loc_data(){
		$rescode = $this->input->post('busprop');
		$areacode = get_areacode($this->input->post('area_council'));
		$towncode = get_towncode($this->input->post('town'));
		$category = $this->input->post('category');
		$data['town'] = trim($this->input->post('town'));
		$data['area_council'] = trim($this->input->post('area_council'));
		$data['streetname'] = trim($this->input->post('streetname'));
		// $data['sectorial_code'] = trim($this->input->post('sectorial_code'));
		$data['landmark'] = trim($this->input->post('landmark'));
		$data['houseno'] = trim($this->input->post('new_property_noo'));
		$data['location'] = trim($this->input->post('location'));
		$data['locality_code'] = $towncode;
		$data['street_code'] = trim($this->input->post('street_code'));
		$data['new_property_no'] = trim($this->input->post('new_property_noo'));
		$data['old_property_no'] = trim($this->input->post('old_property_no'));
		$data['zone_code'] = $areacode;
		$data['ghpost_gps'] = trim($this->input->post('ghpost_gps'));
		$resid= $this->input->post('resid');
		$ownid= $this->input->post('ownid');

		$res_id = $this->res->update_business_prop($data,$resid);

		if($category == 12){
			$cat = "Business";
		}else{
			$cat = "Residential";
		}

		if(!$res_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a $cat property location data",
				'status' => true,
				'description' => "Edited $cat location data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_property_form/'.$resid.'/'.$rescode);

	}

	//	edit residence prop data
	public function edit_prop_data(){

		$rescode = $this->input->post('busprop');
		$data['category'] = trim($this->input->post('category'));
		$data['property_type'] = trim($this->input->post('property_type2'));
		$data['no_of_rooms'] = trim($this->input->post('no_of_rooms'));
		$data['construction_material'] = trim($this->input->post('construction_material'));
		$data['roofing_type'] = trim($this->input->post('roofing_type'));
		$data['year_of_construction'] = trim($this->input->post('year_of_construction'));
		$category['category1'] = $this->input->post('cat1');
		$category['category2'] = $this->input->post('cat2');
		$category['category3'] = $this->input->post('cat3');
		$category['category4'] = $this->input->post('cat4');
		$category['category5'] = $this->input->post('cat5');
		$category['category6'] = $this->input->post('cat6');
		if($this->input->post('property_type') !== 'Compound'){
			$data['no_of_floors'] = trim($this->input->post('no_of_floors'));
		}else{
			$data['no_of_floors'] = "";
		}
		$data['building_type'] = $this->input->post('type_of_building');
		if($this->input->post('type_of_building') == "Temporary"){
			$data['temporary_building']= $this->input->post('detail_for_temp');
		}
		$resid= $this->input->post('resid');
		$ownid= $this->input->post('ownid');

		$res_id = $this->res->update_business_prop($data,$resid);
		$bus_to_category = $this->res->update_bus_to_category($category,$resid);
		$category_type = $this->input->post('category');
		if($category_type == 12){
			$cat = "Business";
		}else{
			$cat = "Residential";
		}		

		if(!$res_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a $cat property data",
				'status' => true,
				'description' => "Edited $cat property data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_property_form/'.$resid.'/'.$rescode);

	}


	//	edit busocc category data
	public function edit_busocc_category(){

		$busid = $this->input->post('busid');
		$buscatid = $this->input->post('buscatid');
		$busocccode = $this->input->post('busocccode');
		$category['category1'] = $this->input->post('cat1');
		$category['category2'] = $this->input->post('cat2');
		$category['category3'] = $this->input->post('cat3');
		$category['category4'] = $this->input->post('cat4');
		$category['category5'] = $this->input->post('cat5');
		$category['category6'] = $this->input->post('cat6');
		
		$bus_to_category = $this->res->update_busocc_to_category($category,$buscatid);

		if(!$bus_to_category){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a business occupant categories data",
				'status' => true,
				'description' => "Edited business categories data of business occupant whose code is: $busocccode  ",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Business/edit_business_occupant_form/'.$busid);

	}

	//	delete busocc category data
	public function delete_busocc_category(){

		$busid = $this->input->post('busid');
		$buscatid = $this->input->post('buscatid');
		$busocccode = $this->input->post('busocccode');
		
		$bus_to_category = $this->res->delete_busocc_to_category($buscatid);

		if(!$bus_to_category){
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Oh Snap! </strong> Your Form Was Not Submitted.
			</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Deleted a business occupant's categories data",
				'status' => true,
				'description' => "Deleted business categories data of business occupant whose code is $busocccode ",
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

		}
		redirect(base_url().'Business/edit_business_occupant_form/'.$busid);

	}

	//	edit residence facility data
	public function edit_facility_data(){

		$rescode = $this->input->post('busprop');
		$category = $this->input->post('category');
		$com_needs = $this->input->post("com_needs");

		//property image upload
		//configure upload
		// $config['upload_path'] = './upload/property/business_property';
		// $config['allowed_types'] = 'gif|jpg|png|jpeg';
		// $config['max_size'] = '1000';

		// $this->load->library('upload', $config);

		// if (!$this->upload->do_upload('userfile')) {
		// 	$image = $this->input->post('old_image');
		// 	$file_path = $this->input->post('image_path');
		// } else {
		// 	$file_data = $this->upload->data();

		// 	$file_path = '/upload/property/business_property/';
		// 	$image = $file_data['file_name'];
		// }
		$config['upload_path'] = 'upload/property/business_property/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('prop_image')) {
			$file_path = '/upload/property/business_property/';
			$file_name = $this->upload->data('file_name');
			
		} else {
			$file_path = '';
			$file_name = '';
			// echo $this->upload->display_errors(); die();
			
		}

		if($category == 12){
			$cat = "Business";
		}else{
			$cat = "Residential";
		}		
        $data['building_status'] = trim($this->input->post('building_status'));
		$data['building_permit'] = trim($this->input->post('building_permit'));
		$data['planning_permit'] = trim($this->input->post('planning_permit'));
		$data['toilet_facility'] = $this->input->post('toilet_facility');
		$data['avai_of_water'] = $this->input->post('avai_of_water');
		$data['avai_of_refuse']= $this->input->post('avai_of_refuse');
		$data['avail_of_electricity']= $this->input->post('avail_of_electricity');
		$data['avail_of_telcom_network']= $this->input->post('avail_of_telcom_network');
		$data['noOfOccupants'] = trim($this->input->post('no_of_occupants'));
		$data['no_of_residents'] = trim($this->input->post('no_of_residents'));
		$data['resident_greater_18'] = trim($this->input->post('resident_greater_18')); 
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['inhabitant_status'] = trim($this->input->post('inhabitant_status'));
		$data['upn_number'] = trim($this->input->post('upn_number'));
		$data['no_of_pwd'] = trim($this->input->post('no_of_pwd'));
		$data['assessable_status'] = trim($this->input->post('property_assessment'));
		$data['image_path'] = $file_path;
		$data['property_image'] = $file_name;
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$rate = trim($this->input->post('rate'));
		$apid= $this->input->post('apid');
		$resid= $this->input->post('resid');
		$ownid= $this->input->post('ownid');
		$data['building_type'] = $this->input->post('type_of_building');
		if($this->input->post('type_of_building') == "Temporary"){
			$data['temporary_building']= $this->input->post('detail_for_temp');
		}
		if($this->input->post('building_permit') == 'Yes'){
			$data['building_cert_no'] = trim($this->input->post('building_cert_no'));
		}else{
			$data['building_cert_no'] = "";
		}
		if($this->input->post('planning_permit') == 'Yes'){
			$data['planning_permit_no'] = trim($this->input->post('planning_permit_no'));
		}else{
			$data['planning_permit_no'] = "";
		}
		if($this->input->post('toilet_facility') == 'Yes'){
			$data['t_facility_no'] = "";
			$data['t_facility_yes'] = $this->input->post('t_facility_yes');
			$data['no_of_toilet_facility'] = trim($this->input->post('no_of_toilet_facility'));
		}else{
			$data['t_facility_no'] = trim($this->input->post('t_facility_no'));
			$data['t_facility_yes'] = "";
		}
		if($this->input->post('avai_of_water') == 'No'){
			$data['source_water_no'] = trim($this->input->post('source_water_no'));
			$data['source_water_yes'] = "";
		}else{
			$data['source_water_yes'] = trim($this->input->post('source_water_yes'));
			$data['source_water_no'] = "";
		}
		if($this->input->post('avai_of_refuse') == 'Yes'){
			$data['dumping_site_yes'] = trim($this->input->post('dumping_site_yes'));
			$data['dumping_site_no'] = "";
		}else{
			$data['dumping_site_no'] = trim($this->input->post('dumping_site_no'));
			$data['dumping_site_yes'] = "";
		}
		if($this->input->post('avail_of_telcom_network') == 'Yes'){
			$data['avail_of_telcom_network_yes'] = trim($this->input->post('telcom_network'));
		}else{
			$data['avail_of_telcom_network_yes'] = "";
		}

		if($this->input->post('accessed_status') == 1){
			if($apid){
				$data1  = array(
					'rateable_value' => $rateable_amount,
					'rate' => $rate,
					'invoice_amount' => $rateable_amount * $rate,
					'valuation_number' => trim($this->input->post('valuation_number'))
				);
				$accessed = $this->TaxModel->update_accessed_recordd($data1,$apid);
			}else{
				$data1  = array(
					'product_id' => $category,
					'property_id' => $resid,
					'target' => ($category == 12)?2:1,
					'rateable_value' => $rateable_amount,
					'rate' => $rate,
					'invoice_amount' => $rateable_amount * $rate,
					'valuation_number' => trim($this->input->post('valuation_number'))
				);
				$accessed = $this->TaxModel->insert_accessed_record($data1);	
			}	
		}else{
			
		}

		$delete_need = $this->res->delete_property_need($resid);

		if($delete_need){
			foreach ($com_needs as $key => $value) {
	        	$community_needs = array('property_id' => $resid ,'need_id' => $this->input->post("com_needs")[$key]);
        		$this->res->add_community_needs($community_needs);
	        }
		}

		$res_id = $this->res->update_business_prop($data,$resid);


		if(!$res_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a $cat property facility data",
				'status' => true,
				'description' => "Edited $cat property facility data with code: $rescode",
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

		}
		redirect(base_url().'Business/edit_business_property_form/'.$resid.'/'.$rescode);

	}

	// view business profile page
	public function view_business($id,$propcode){

            if(has_permission($this->session->userdata('user_info')['id'],'view buis prop')){
				$data = array(
				'area' => $this->res->get_area_councils(),
					"page" => 'business/view_business',
					'title' => 'Business Property Details',
					'result' => $this->res->get_business_prop_occ($propcode),
					'residence' => $this->res->get_business_details($id),
					'construction' => $this->res->get_cons(),
					'roof' => $this->res->get_roof(),
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
	
	// view business occupants profile page
	public function view_business_occ($id){

		if(has_permission($this->session->userdata('user_info')['id'],'view buis occ')){
			$data = array(
			'area' => $this->res->get_area_councils(),
				"page" => 'business/view_business_occ',
				'bus_sector' => $this->res->get_bus_sector(),
				'title' => 'View Business Occupant',
				'bus' => $this->res->get_business_occ_details($id),
				'prop_cat' => $this->res->get_prop_cat(),
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

	// resend business property sms
	public function resend_business_sms(){
		$primary_contact = $this->input->post("number");
		$buscode = $this->input->post("buscode");
		$category = $this->input->post("category");
		$sms_message = "Your $category Property has been registered successfully on the ". SYSTEM_ID ." Platform.\n Your $category Property Code is $buscode\nThank You";

		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Resent business property sms",
			'status' => true,
			'description' => "Resent code to owner of property code: $buscode",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert

		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
		send_sms($phone_formatted, $sms_message);
		$this->session->set_flashdata(
			'message', "<div class='alert alert-success'>
				<strong>Success! </strong> Sms Successfully Resent.
			</div>");
		redirect('property');
	}

	// resend business occupants sms
	public function resend_business_occ_sms(){
		$primary_contact = $this->input->post("number");
		$buscode = $this->input->post("bus_occ_code");
		$sms_message = "Your Business has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Business Identity Code is $buscode.\nThank You";

		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Resent business occupant sms",
			'status' => true,
			'description' => "Resent code to owner of property code: $buscode",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert
		
		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
		send_sms($phone_formatted, $sms_message);
		$this->session->set_flashdata(
			'message', "<div class='alert alert-success'>
				<strong>Success! </strong> Sms Successfully Resent.
			</div>"
		);
		redirect('business_occupant');
	}


	//	check for business code exits in the database
	public function search_business_prop_code(){
		$search_value = strtoupper($this->uri->segment(3));
		$query = $this->res->get_business_prop_code($search_value);
		echo json_encode($query);
	}

	//	check for business code exits in the database
	public function search_business_prop_latlong(){
		$search_value = strtoupper($this->uri->segment(3));
		$query = $this->res->get_business_prop_latlong($search_value);
		echo json_encode($query);
	}

	// get sectors in selected property category on add business occupants...
	public function get_sectors(){
        // POST data
        $postdata = $this->input->post();
        // get data
        $data = $this->res->get_sectors($postdata);
        echo json_encode($data);
    }

	// get property type in selected business occupants on add business occupants...
	public function get_prop_type(){
        // POST data
        $postdata = $this->input->post();
        // get data
        $data = $this->res->get_prop_type($postdata);
        echo json_encode($data);
    }
    
	// resend business property message
    public function send_business_message(){

		$primary_contact = $this->input->post("primary_contact");
		$message = $this->input->post("message");
		$message_type = $this->input->post("message_type");
		
		if($message_type == "SMS"){
			$echannelid = 1;
			$echannel = $this->Channelmodel->channelstatus($echannelid);
			if($echannel != 0){
				$sms_message = "$message";
				$phone_formatted = formatPhonenumber($primary_contact);
				send_sms($phone_formatted, $sms_message);
				return $this->output->set_content_type('application/json')
					->set_status_header(200)
					->set_output(
						json_encode(array("result" => "Sms has been sent")));
			}
			else{
				return $this->output->set_content_type('application/json')
					->set_status_header(503)
					->set_output(
						json_encode(array("result" => "SMS not sent because the channel is blocked")));
			}
			
		}else if($message_type == "EMAIL"){
			$email = $this->input->post('email');
			# NB i configured email setting in application/config/email.php
			$this->load->library('email');
			$this->email->from("test@gnerms.com");
			$this->email->to($email);
			$this->email->subject('Personal message');
			$this->email->message($message);
			
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

		}else{
			return $this->output->set_content_type('application/json')
				->set_status_header(400)
				->set_output(
					json_encode(
						array(
							"result" => (
								"Process of this kind of message is currently ".
								"unsupported"
							)
						)
					)
				);
		}
        // insert into audit tray
		// $info = array(
		// 	'user_id' => $this->session->userdata('user_info')['id'],
		// 	'activity' => "Reset user password",
		// 	'status' => true,
		// 	'description' => "Resetted password of user: $username",
		// 	'user_category' => "admin",
		// 	'channel' => "Web"
		// );
		// $audit_tray = audit_tray($info);
        //end of insert

    }
    
  	// send message
    public function send_message(){
		
		$primary_contact = $this->input->post("primary_contact");
		$message = $this->input->post("message");
		$message_type = $this->input->post("message_type");
		$file_path = "base_url()?>invoices/invoice.pdf";
 if($message_type == "SMS"){
 $echannelid = 1;
 $echannel = $this->Channelmodel->channelstatus($echannelid);
 if($echannel != 0){
 $sms_message = "$message";
 $phone_formatted = formatPhonenumber($primary_contact);
 send_sms($phone_formatted, $sms_message);
 if (send_sms($phone_formatted, $sms_message)) {
 $this->session->set_flashdata('message', "<div class='alert alert-success'>
     Your Form Was Submitted Successfully.
 </div>");
 }else{
 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
     <strong>There was an Error ! </strong> Your Form Was Not Submitted.
 </div>");
 }
 }
 else{
 return $this->output->set_content_type('application/json')
 ->set_status_header(503)
 ->set_output(
 json_encode(array("result" => "SMS not sent because the channel is blocked")));
 }

 }else if($message_type == "EMAIL"){
 $email = $this->input->post('email');
 # NB i configured email setting in application/config/email.php
 $this->load->library('email');
 $this->email->from("deksol_bills@deksolconsult.com");
 $this->email->to($email);
 $this->email->subject('Personal message');
 $this->email->attach('http://192.168.64.3/knma_erms/assets/img/card.pdf');
 $this->email->message($message);

 if ($this->email->send()) {
 $this->session->set_flashdata('message', "<div class='alert alert-success'>
     Your Form Was Submitted Successfully.
 </div>");
 }else{
 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
     <strong>Oh Snap! </strong> Your Form Was Not Submitted.
 </div>");
 }
 }else{
 return $this->output->set_content_type('application/json')
 ->set_status_header(400)
 ->set_output(
 json_encode(
 array(
 "result" => (
 "Process of this kind of message is currently ".
 "unsupported"
 )
 )
 )
 );
 }
 // insert into audit tray
 // $info = array(
 // 'user_id' => $this->session->userdata('user_info')['id'],
 // 'activity' => "Reset user password",
 // 'status' => true,
 // 'description' => "Resetted password of user: $username",
 // 'user_category' => "admin",
 // 'channel' => "Web"
 // );
 // $audit_tray = audit_tray($info);
 //end of insert

 redirect($_SERVER['HTTP_REFERER']);
 }

 // get business property properties ajax call
 public function businessPropertyList(){
 // POST data
 $postData = $this->input->post();

 // Get data
 $data = $this->res->getBusinessProperties($postData);

 echo json_encode($data);
 }

 // get business occupants ajax call
 public function businessOccupantList(){
 // POST data
 $postData = $this->input->post();

 // Get data
 $data = $this->res->getBusinessOccupant($postData);

 echo json_encode($data);
 }

 public function invoice_email (){
 $this->load->view('invoices/invoice_email');
 }

 public function send_invoice_message(){
 //post data
 $primary_contact = $this->input->post("primary_contact");
 $message = $this->input->post("message");
 $message_type = $this->input->post("message_type");
 $id = $this->input->post("inv_id");

 //load dompdf library
 $this->load->library('pdf');
 $result = json_decode($this->TaxModel->get_invoice_detail($id));
 $template = "template";
 $date_created = date('Y-m-d',strtotime($result->date_created));
 $due_date = date("Y-m-d",$result->payment_due_date );
 $accessedBadge = "";
 if ($result->accessed == 1) {
 $accessedBadge = "<span class='badge badge-success'>Assessed</span>";
 } else {
 $accessedBadge = "<span class='badge badge-danger'>Unassessed</span>";
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
 $amount_paid = $result->amount_paid;
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
 $amount_paid_text = 'GHS '.number_format((float)$amount_paid, 2, '.', ',');
 $html = "
 <html>

     <head>
         <title>REVENUE MANAGEMENT SYSTEM</title>
         <!-- Web Fonts  -->
         <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet'
             type='text/css'>

         <!-- Vendor CSS -->
         <link rel='stylesheet' href='assets/vendor/bootstrap/css/bootstrap.css' />
         <link rel='stylesheet' href='<?= base_url() ?>assets/css/theme.css' />

         <!-- Invoice Print Style -->
         <link rel='stylesheet' href='assets/css/invoice-print.css' />
         <script src='assets/vendor/jquery/jquery.js'></script>
         <script src='assets/js/custom.js'></script>
         <style type='text/css'>
         .invoice-summary table.wordify>tbody tr:last-child>td {
             background-color: #F8F8F8;
             border-bottom: 1px solid #DADADA;
             border-top: 1px solid #DADADA;
         }

         .invoice-summary table.wordify>tbody tr:last-child>td {
             font-size: 1.3rem !important
         }

         footer {
             display: block;
         }

         .footer {
             margin: auto;
             position: absolute;
             left: 4%;
             bottom: 4%;
             right: 4%;
             border-top:
                 solid grey 1px
         }

         .footer p {
             margin-top: 1%;
             font-size: 9%;
             color: red;
             font-weight: bold;
             line-height: 140%;
             text-align: justify
         }

         #watermark {
             position: fixed;
             top: 25%;
             left: 32%;
             z-index: 99;
         }

         #watermark.print {
             top: 20%;
             left: 19%;
         }

         #watermark img {
             width: 250%;
             height: 100%;
             opacity: 0.1;
         }

         #watermark.print img {
             width: 200%;
             height: 80%;
             opacity: 0.5;
         }

		 #qrcode > img{
			width : 40%;
		}

         @media print {
             .footer {
                 position: fixed;
                 display: block;
                 margin: auto;
                 left: 4%;
                 bottom: 4%;
                 right: 4%;
                 border-top: solid grey 1px;
             }

             /* #watermark img {
						width: 250%;
						height: 100%;
						opacity: 0.1;
					}
		
					#watermark.print img {
						width: 200%;
						height: 80%;
						opacity: 0.1;
					} */
             .no-print {
                 display: none !important;
             }
         }
         </style>
     </head>

     <body>
         <div class='row'>
             <div class='col-sm-6 mt-3' style='margin-bottom:4em;padding-top:2em;'>
                 <h6 class='h4 m-0 text-dark font-weight-bold' style='font-size:90%;'>#$result->invoice_no</h6>
             </div>
             <div class='col-sm-6 text-right mt-5 mb-3' style='position:absolute;left:420px;'>
                 <div class='row'>
                     <div class='col-md-6 mt-3' style='padding-right:130px;'>
                         <p style='font-size:12px;'>Ketu North Municipal Assembly<br>
                             PMB 2<br>
                             Dzodze<br>
                             030 290 7239<br>
                             ketunorthmunicipalassembly@gmail.com</p>
                     </div>
                     <div class='col-md-6 mt-4'>
                         <img src='assets/img/elem.png' alt='Ga-north logo' style='width:7em;height:7em;' />
                     </div>
                     <div>
                     </div>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:120px;'>
                     <hr>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-6' style='position:absolute;top:150px;'>
                     <p style='font-size:14px;'><b>To:</b></p>
                     <p style='font-size:12px;'>
                         $result->customer_name<br>
                         $result->property_code<br>
                         $result->busocc_property_code<br>
                         $result->town<br>
                         <b>Streetname:</b>$result->streetname<br>
                         <b>Landmark:</b> $result->landmark<br>
                         $result->sectorial_code<br>
                     </p>
                 </div <div class='col-md-6' style='position:absolute;left:480px;top:150px;'>
                 <p style='font-size:12px;'>
                     <b>Invoice Date:$date_created</b><br>
                     <b>Due Date:</b> $due_date<br>
                     <br><br>
                     <b>Office Contact: </b>0551511511/0503038555<br>
                     <b>Bank Name: </b>GCB BANK<br>
                     <b>Account No: </b>5031130001417<br>
                     <b>Bank Branch: </b>Dzodze<br>

                 </p>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:320px;'>
                     <hr>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:350px;'>
                     <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                         <thead>
                             <tr style='font-size:12px;'>
                                 <th class='text-center'><b>Bill Type</b></th>
                                 <th class='text-center'><b>Main Category</b></th>
                                 <th class='text-center'><b>Service Type</b></th>
                                 <th class='text-center'><b>Business Type</b></th>
                                 <th class='text-center'><b>Category</b></th>
                                 <th class='text-center'><b>Amount</b></th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr style='font-size:12px;margin-top:50px>
									<td class=' text-center'>BOP</td>
                                 <td class='text-center'>$result->name</td>
                                 <td class='text-center'>$result->category1</td>
                                 <td class='text-center''>$result->category2</td>
									<td class=' text-center'>$result->category3</td>
                                 <td class='text-center'>$result->category4</td>
                                 <td class='text-center'>$invoiceAdjustedAmount</td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:400px;'>
                     <hr>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:480px;left:430px'>
                     <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                         <tr style='border-bottom:1px grey solid;'>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Subtotal</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'>$invoiceDiscountAmount</td>
                         </tr>
                         <tr>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Discount</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'>$discountAmount</td>
                         </tr>
                         <tr>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Payment</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'>$amount_paid_text</td>
                         </tr>
                         <tr>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Penalty</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'>$penaltyAmount</td>
                         </tr>
                         <tr>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Arrears</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'>$actualArrearsAmount</td>
                         </tr>
                         <tr>
                             <td style='font-size:14px; width=' 40%' class='text-right mr-4'>Total</td>
                             <td style='font-size:14px; width=' 60%' class='text-left'><b>$totalAmount</b></td>
                         </tr>
                     </table>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:680px;'>
                     <hr>
                 </div>
             </div>
             <div class='row justify-content-end'>
                 <div class='col-md-12' style='position:absolute;top:750px;left:490px;'>
                     <table class='table wordify h6 text-dark'>
                         <tbody>
                             <tr>
                                 <img src='assets/img/MFO_signature.png' alt='Signature'
                                     style='width:7em;height:4em;' />
                                 <img src='assets/img/director_signature.png' alt='Signature'
                                     style='width:7em;height:4em;margin-right:0.5em;' />
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class='row justify-content-end'>
		 		<div class='col-md-6'>

				 <?php 
				 ($result->busocc_property_code)? $busocc = $result->busocc_property_code : $buscocc = ''; ?>

					// <input 
					// 	type='hidden'
					// 	spellcheck='false'
					// 	id='qrtext'
					// 	value='
					// 		Invoice# : <?=$result->invoice_no ?>
					// 		Property# :  <?=$result->property_code ?>
					// 		Business# : <?= $busocc ?>
					// 		Phone# : <?=$result->owner_phoneno ?>
					// 		'
					// />
					// <div id='qrcode'></div>
				</div>
                 <div class='col-md-6' style='position:absolute;top:810px;left:490px;'>
                     <table class='table wordify h6 text-dark'>
                         <tbody>
                             <tr>
                                 <img src='assets/img/MFO_stamp.png' alt='Signature'
                                     style='width:7em;height:4em;margin-right:0.5em' />
                                 <img src='assets/img/director_stamp.png' alt='Signature'
                                     style='width:7em;height:4em;' />
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12' style='position:absolute;top:920px;'>
                     <hr>
                 </div>
             </div>
             <div class='row'>
                 <div class='col-md-12 text-danger' style='position:absolute;top:950px;font-size:12px;'>
                     <p>
                         Payment should be made at the revenue office or to assembly’s revenue collector or to the bank
                         or mobile money details on the bill.
                         Failure to do so, will attract proceedings taken for the purpose of exacting sale or entry
                         possession and the expense incurred.<br>
                         All property bills are based on unassessed rates in the fee fixing.<br>
                     </p>
                 </div>
             </div>
             <div style='
				position:absolute;
				top: 150px;
				left:100px;
				opacity: 0.1;
				'>
                 <img style='
					width: 80%;
					height: 80%
					' src='assets/img/Coat_of_arms_of_Ghana.png' alt='Watermark' />
             </div>
         </div>

		 <!-- QR code Library CDN -->
		 <script src='https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js'></script>
	 
		 <script type='text/javascript'>
		   const qrcode = document.getElementById('qrcode');
		   const textInput = document.getElementById('qrtext');
	 
		   const qr = new QRCode(qrcode);
		   qr.makeCode(textInput.value.trim());
		 </script>
		 
     </body>
     ";
     $this->pdf->loadHtml($html);
     $this->pdf->setPaper('A4', 'portrait');
     $this->pdf->render();
     $pdf = $this->pdf->output();
     //1 = download 0= read
     $this->pdf->stream("test.pdf", array("Attachment"=> 0));
     // file_put_contents('temp_pdf_dir', $html);

     if($message_type == "SMS"){
     $echannelid = 1;
     $echannel = $this->Channelmodel->channelstatus($echannelid);
     if($echannel != 0){
     $sms_message = "$message";
     $phone_formatted = formatPhonenumber($primary_contact);
     send_sms($phone_formatted, $sms_message);
     if (send_sms($phone_formatted, $sms_message)) {
     $this->session->set_flashdata('message', "<div class='alert alert-success'>
         Your Form Was Submitted Successfully.
     </div>");
     }else{
     $this->session->set_flashdata('message', "<div class='alert alert-danger'>
         <strong>There was an Error ! </strong> Your Form Was Not Submitted.
     </div>");
     }
     }
     else{
     return $this->output->set_content_type('application/json')
     ->set_status_header(503)
     ->set_output(
     json_encode(array("result" => "SMS not sent because the channel is blocked")));
     }

     }else if($message_type == "EMAIL"){
    //  $email = $this->input->post('email');
    //  # NB i configured email setting in application/config/email.php
    //  $this->load->library('email');
    //  $this->email->from("deksol_bills@deksolconsult.com");
    //  $this->email->to($email);
    //  $this->email->subject('Personal message');
    //  $this->email->attach($pdf, base_url().'/temp_pdf_dir', "PDF test" . date("m-d H-i-s") . ".pdf", false);
    //  $this->email->message($message);

    //  if ($this->email->send()) {
    //  $this->session->set_flashdata('message', "<div class='alert alert-success'>
    //      Your Form Was Submitted Successfully.
    //  </div>");
    //  }else{
    //  $this->session->set_flashdata('message', "<div class='alert alert-danger'>
    //      <strong>Oh Snap! </strong> Your Form Was Not Submitted.
    //  </div>");
    //  }
     }

     redirect($_SERVER['HTTP_REFERER']);


     }



     }