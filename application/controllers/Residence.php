 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Residence extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Residence_model','res');
		$this->load->model('Channelmodel');
		$this->load->model('TaxModel');
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

	//	load residence page
	public function residence(){

		//set last page session
		$this->session->set_userdata('last_page', 'view_res');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Residential', 'url' => 'residence'), TRUE);
		if(has_permission($this->session->userdata('user_info')['id'],'view residence')){
			$data = array(
				'title' => 'Residential',
				'start_date' => "",
				'end_date' => '',
				'keyword' => '',
				'search_by' => 'Date',
				'search_option' => '',
				'page' => 'residence/residence',
				'products' => $this->res->get_products(1)
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

	public function search_residence(){

		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$search_option = $this->input->post('search_option');
		if(has_permission($this->session->userdata('user_info')['id'],'view residence')){
			$data = array(
				'title' => 'Residential',
				'start_date' => $start_date,
				'end_date' => $end_date,
				'keyword' => $search_item,
				'search_by' => $search_by,
				'search_option' => $search_option,
				'page' => 'residence/residence'
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

	// load residence map
	public function map(){

		//set last page session
		$this->session->set_userdata('last_page', 'map');
		buildBreadCrumb(array(
			"label" => "Map",
			"url" => "map"
		), TRUE);
		if(has_permission($this->session->userdata('user_info')['id'],'view residence map')){
			$data = array(
				'title' => 'Map',
				'page' => 'residence/map',
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

	//	load add residence page
	public function add_residence_form(){

		$this->session->set_userdata('last_page', 'add_res');
		$crumbs = buildBreadCrumb(
			array('label' => 'Residence Creation', 'url' => 'add_residence'), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'create residence')){
			$data = array(
				'area' => $this->res->get_area_councils(),
				'title' => 'Residence Creation',
				'page' => 'residence/add_residence',
				'construction' => $this->res->get_cons(),
				'roof' => $this->res->get_roof()
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

	//	load edit residence page
	public function edit_residence_form($id,$rescode){

		buildBreadCrumb(array(
			"url" => "Residence/edit_residence_form/$id/$rescode",
			"label" => "Edit Residential Details"
		));

		if(has_permission($this->session->userdata('user_info')['id'],'manage residence')){

			$data = array(
				'area' => $this->res->get_area_councils(),
				'page' => 'residence/edit_residence',
				'title' => 'Edit Residential Details',
				'residence' => $this->res->get_residence_details($id),
				'result' => $this->res->get_residence_household($rescode),
				'construction' => $this->res->get_cons(),
				'roof' => $this->res->get_roof(),
				'invoices' => $this->res->get_property_invoice($id,1),
				'invoices_sum' => $this->res->get_property_invoice_sum($id,1)
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

	//	load household page
	public function household(){

		//get last record date in the db
		$last_date = $this->res->get_household_date();
		
		//set last page session
		$this->session->set_userdata('last_page', 'view_household');

		if(has_permission($this->session->userdata('user_info')['id'],'view household')){
			$data = array(
				'title' => 'Household',
				'page' => 'residence/household',
				'start_date' => $last_date,
				'end_date' => '',
				'keyword' => '',
				'search_by' => 'Date',
				'search_option' => '',
				'result' => $this->res->get_household($last_date),
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

	//	load search_household
	public function search_household(){
		$search_by = $this->input->post('search_by');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$search_item = $this->input->post('keyword');
		$search_option = $this->input->post('search_option');
		$data = array(
			'title' => 'Household',
			'page' => 'residence/household',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'keyword' => $search_item,
			'search_by' => $search_by,
			'search_option' => $search_option,
			'result' => $this->res->search_household(
				$search_by,$start_date,$end_date,$search_item,$search_option),
		);

		$this->load_page($data);
	}

	//	load edit residence page
	public function edit_household_form($id){

		if(has_permission($this->session->userdata('user_info')['id'],'manage household')){
			$get_household_needs = $this->res->get_household_needs($id);
			$needs ="";
			foreach ($get_household_needs as $get) {
				$needs .= $get->need_id.',';
			}

			$data = array(
				'page' => 'residence/edit_household',
				'title' => 'Edit Household Details',
				'education' => $this->res->get_edu(),
				'profession' => $this->res->get_prof(),
				'household' => $this->res->get_household_details($id),
				'com' => $this->res->get_com(),
				'needs' => rtrim($needs,',')
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

	//	load add household page
	public function add_household_form(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_household');

		if(has_permission($this->session->userdata('user_info')['id'],'create household')){
			$data = array(
				'title' => 'Household Creation',
				'page' => 'residence/add_household',
				'education' => $this->res->get_edu(),
				'profession' => $this->res->get_prof(),
				'com' => $this->res->get_com(),
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

	// get towns in selected area council on add residence form...
	public function get_area_towns(){
        // POST data
        $postdata = $this->input->post();
        // get data
        $data = $this->res->get_area_towns($postdata);
        echo json_encode($data);
    }

	// delete agency types
	public function delete_agencytype(){

		$agencytypeid= $this->uri->segment(3);
		if($this->Agency_model->delete_agencytype($agencytypeid)){
			echo json_encode($agencytypeid);
		}
	}

	//	add new residence
	public function add_residence(){

		$areacode = get_areacode($this->input->post('area_council'));
		$towncode = get_towncode($this->input->post('town'));

		//property image upload
		//configure upload
		$config['upload_path'] = './upload/property/residence';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '1000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			
		} else {
			$file_data = $this->upload->data();

			$file_path = '/upload/property/residence/';
			$image = $file_data['file_name'];
		}

		$code = $this->res->resnumber($this->input->post('area_council'),$this->input->post('town'));
		$primary_contact = trim($this->input->post('primary_contact'));
		$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_RESIDENTIAL_PROPERTY_PER_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
		$houseno = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
    	$owner['person_category'] = trim($this->input->post('personal_category'));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$owner['owner_native'] = trim($this->input->post('owner_native'));
		$owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$owner['religion'] = trim($this->input->post('religion'));
		$data['year_of_construction'] = trim($this->input->post('year_of_construction'));
		$data['res_code'] = $gen_rescode;
		$data['town'] = trim($this->input->post('town'));
		$data['area_council'] = trim($this->input->post('area_council'));
		$data['streetname'] = trim($this->input->post('streetname'));
		$data['sectorial_code'] = trim($this->input->post('sectorial_code'));
		$data['landmark'] = trim($this->input->post('landmark'));
		$data['locality_code'] = $towncode;
		$data['street_code'] = trim($this->input->post('street_code'));
		$data['new_property_no'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
		$data['old_property_no'] = trim($this->input->post('old_property_no'));
		$data['zone_code'] = $areacode;
		$data['houseno'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
		$data['location'] = trim($this->input->post('location'));
		$data['ghpost_gps'] = trim($this->input->post('ghpost_gps'));
		$data['building_type'] = $this->input->post('type_of_building');
		$data['temporary_building']= $this->input->post('detail_for_temp');
		$data['building_permit'] = trim($this->input->post('building_permit'));
		$data['planning_permit'] = trim($this->input->post('planning_permit'));
		$data['toilet_facility'] = $this->input->post('toilet_facility');
		$data['avai_of_water'] = $this->input->post('avai_of_water');
		$data['avai_of_refuse']= $this->input->post('avai_of_refuse');
    	$data['building_status'] = trim($this->input->post('building_ status'));
		$data['noOfResidents'] = trim($this->input->post('no_of_residents'));
		$data['resident_greater_18'] = trim($this->input->post('resident_greater_18'));
		$data['upn_number'] = trim($this->input->post('upn_number'));
		$data['inhabitant_status'] = trim($this->input->post('inhabitant_status'));
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['assessable_status'] = trim($this->input->post('property_assessment'));
		$data['construction_material'] = trim($this->input->post('construction_material'));
		$data['roofing_type'] = trim($this->input->post('roofing_type'));
		$data['property_type'] = trim($this->input->post('property_type2'));
		$data['image_path'] = $file_path;
		$data['property_image'] = $image;
		$data['agent_id'] = $this->session->userdata('user_info')['id'];
		$data['agent_category'] = "admin";
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$rate = trim($this->input->post('rate'));
		$data['code'] = $code;
		if($this->input->post('religion') === "Others"){
			$owner['other_religion'] = $this->input->post('other_religion');
		}
		if($this->input->post('property_type') !== 'Compound'){
			$data['no_of_floors'] = trim($this->input->post('no_of_floors'));
		}else{
			$data['no_of_floors'] = "";
		}
		// if($this->input->post('owner_native') == 'Yes, Resides In Property'){
		// 	$owner['town'] = trim($this->input->post('town'));
		// 	$owner['area_council'] = trim($this->input->post('area_council'));
		// 	$owner['locality_code'] = $towncode;
		// 	$owner['zone_code'] = $areacode;
		// 	$owner['ghpostgps_code'] = trim($this->input->post('ghpost_gps'));
		// }elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
		// 	$owner['location'] = trim($this->input->post('owner_location'));
		// 	$owner['hometown'] = trim($this->input->post('owner_hometown'));
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// 	$owner['home_district'] = trim($this->input->post('owner_home_district'));
		// 	$owner['ethnicity'] = trim($this->input->post('owner_ethnicity'));
		// 	$owner['native_language'] = trim($this->input->post('owner_native_language'));
		// 	$owner['region'] = trim($this->input->post('owner_region'));
		// }else{
		// 	$owner_areacode = get_areacode($this->input->post('owner_area_council'));
		// 	$owner_towncode = get_towncode($this->input->post('owner_town'));
		// 	$owner['town'] = trim($this->input->post('owner_town'));
		// 	$owner['area_council'] = trim($this->input->post('owner_area_council'));
		// 	$owner['locality_code'] = $owner_towncode;
		// 	$owner['zone_code'] = $owner_areacode;
		// 	$owner['ghpostgps_code'] = trim($this->input->post('owner_ghpost_gps'));
		// }
		if($this->input->post('building_permit') == 'Yes'){
			$data['building_cert_no'] = trim($this->input->post('building_cert_no'));
		}
		if($this->input->post('planning_permit') == 'Yes'){
			$data['planning_permit_no'] = trim($this->input->post('planning_permit_no'));
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

		$res_id = $this->res->add_residence($data);

		$category = array(
			'property_id' => $res_id,
			'category1' => $this->input->post('cat1'),
			'category2' => $this->input->post('cat2'),
			'category3' => $this->input->post('cat3'),
			'category4' => $this->input->post('cat4'),
			'category5' => $this->input->post('cat5'),
			'category6' => $this->input->post('cat6'),
		);

		if(owner_exit(trim($this->input->post('primary_contact')))){
			$owner_id = owner_exit(trim($this->input->post('primary_contact')));
		}else{
			$owner_id = $this->res->add_owner($owner);
		}
		$res_to_category = $this->res->add_res_to_category($category);
		$res_to_owner = $this->res->add_res_to_owner($res_id,$owner_id);

		if($this->input->post('accessed_status') == 1){
			$data  = array(
				'product_id' => "13",
				'property_id' => $res_id,
				'target' => "1",
				'rateable_value' => $rateable_amount,
				'rate' => $rate,
				'valuation_number' => trim($this->input->post('valuation_number')),
				'invoice_amount' => $rateable_amount * $rate
			);
			$accessed = $this->TaxModel->insert_accessed_record($data);
		}else{
			
		}

		if(!$res_id && !$owner_id && !$res_to_owner){
			
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added a residence property",
				'status' => true,
				'description' => "Added a residence property with code: $gen_rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			
			$echannelid = 1;
        	$echannel = $this->Channelmodel->channelstatus($echannelid);
        	if($echannel != 0){
        		$sms_message = "Your Residence Property has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Residence Property Code is $gen_rescode\nThank You";

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
		redirect('add_residence');

	}

	//	add new household
	public function add_household(){

		$primary_contact = trim($this->input->post('primary_contact'));
		$rescode = trim($this->input->post('res_prop_code'));
		$com_needs = $this->input->post("com_needs");
		$data['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$data['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$data['dob'] = trim($this->input->post('dob'));
		$data['place_of_birth'] = trim($this->input->post('place_of_birth'));
		$data['gender'] = trim($this->input->post('gender'));;
		$data['primary_contact'] = trim($this->input->post('primary_contact'));
		$data['type_of_relationship'] = trim($this->input->post('contact_relationship'));
		$data['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$data['head_of_household'] = trim($this->input->post('head_of_household'));
		$data['res_prop_code'] = trim($this->input->post('res_prop_code'));
		$data['highest_edu'] = trim($this->input->post('highest_edu'));
		$data['profession'] = trim($this->input->post('profession'));
		$data['employment_status'] = $this->input->post('employment_status');
		$data['email'] = trim($this->input->post('email'));
		$data['nationality'] = trim($this->input->post('nationality'));
		$data['marital_status'] = trim($this->input->post('marital_status'));
		$data['hometown'] = $this->input->post('hometown');
		$data['home_district']= $this->input->post('home_district');
		$data['region']= $this->input->post('region');
		$data['religion']= $this->input->post('religion');
		$data['ethnicity']= $this->input->post('ethnicity');
		$data['native_lan']= $this->input->post('native_lan');
		$data['father_firstname']= $this->input->post('father_firstname');
		$data['father_lastname']= $this->input->post('father_lastname');
		$data['father_clan']= $this->input->post('father_clan');
		$data['mother_firstname']= $this->input->post('mother_firstname');
		$data['mother_lastname']= $this->input->post('mother_lastname');
		$data['mother_clan']= $this->input->post('mother_clan');
		$data['no_of_kids']= $this->input->post('no_of_kids');
		$data['date_of_last_emp']= $this->input->post('date_of_last_emp');
		$data['tin']= $this->input->post('tin');
		$data['disability']= $this->input->post('disability');
		if($this->input->post('disability') === "Yes"){
			$data['specify_disability'] = implode(":", $this->input->post('specify_disability'));
		}
		if($this->input->post('religion') === "Others"){
			$data['other_religion'] = $this->input->post('other_religion');
		}
		if($this->input->post('no_of_kids') == 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
		}elseif($this->input->post('no_of_kids') > 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
			$data['lastborn_dob'] = $this->input->post('lastborn_dob');
		}else{

		}
		if($this->input->post('nationality') === 'Ghanaian'){
			$data['id_type'] = trim($this->input->post('id_type'));
			$data['id_number'] = trim($this->input->post('id_number'));
		}else{
			$data['country'] = trim($this->input->post('country'));
			$data['nat_id_no'] = trim($this->input->post('nat_id_no'));
		}
		if($this->input->post('employment_status') == "Employed"){
			$data['employer_name'] = trim($this->input->post('employer_name'));
			$data['current_occupation'] = trim($this->input->post('current_occupation'));
		}elseif($this->input->post('employment_status') == "Self-Employed"){
			$data['buisness_name'] = trim($this->input->post('buisness_name'));
			$data['type_of_buisness'] = trim($this->input->post('type_of_buisness'));
		}else{

		}

		$firstname = $data['firstname'];
		$lastname = $data['lastname'];

		$household = $this->res->add_household($data);

        foreach ($com_needs as $key => $value) {
        	$data1 = array('household_id' => $household ,'need_id' => $this->input->post("com_needs")[$key]);
        	$this->res->add_com_needs($data1);
        }


		if(!$household){
			
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added a household",
				'status' => true,
				'description' => "Added $firstname $lastname to residence with no: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert

			$echannelid = 1;
        	$echannel = $this->Channelmodel->channelstatus($echannelid);
        	if($echannel != 0){
        		$houseno = get_res_houseno($rescode);
						$sms_message = "You have been registered successfully on the Ellembelle District Assembly Platform.\nYour House No is $houseno\nThank You";

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
		redirect('add_household');

	}

	//	edit household member details
	public function edit_household(){

		$primary_contact = trim($this->input->post('primary_contact'));
		$rescode = trim($this->input->post('res_prop_code'));
		$com_needs = $this->input->post("com_needs");
		$data['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$data['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$data['dob'] = trim($this->input->post('dob'));
		$data['place_of_birth'] = trim($this->input->post('place_of_birth'));
		$data['gender'] = trim($this->input->post('gender'));;
		$data['primary_contact'] = trim($this->input->post('primary_contact'));
		$data['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$data['head_of_household'] = trim($this->input->post('head_of_household'));
		$data['res_prop_code'] = trim($this->input->post('res_prop_code'));
		$data['highest_edu'] = trim($this->input->post('highest_edu'));
		$data['profession'] = trim($this->input->post('profession'));
		$data['employment_status'] = $this->input->post('employment_status');
		$data['email'] = trim($this->input->post('email'));
		$data['nationality'] = trim($this->input->post('nationality'));
		$data['marital_status'] = trim($this->input->post('marital_status'));
		$data['hometown'] = $this->input->post('hometown');
		$data['home_district']= $this->input->post('home_district');
		$data['region']= $this->input->post('region');
		$data['ethnicity']= $this->input->post('ethnicity');
		$data['native_lan']= $this->input->post('native_lan');
		$data['father_firstname']= $this->input->post('father_firstname');
		$data['father_lastname']= $this->input->post('father_lastname');
		$data['father_clan']= $this->input->post('father_clan');
		$data['mother_firstname']= $this->input->post('mother_firstname');
		$data['mother_lastname']= $this->input->post('mother_lastname');
		$data['mother_clan']= $this->input->post('mother_clan');
		$data['no_of_kids']= $this->input->post('no_of_kids');
		$data['date_of_last_emp']= $this->input->post('date_of_last_emp');
		if($this->input->post('religion') === "Others"){
			$data['other_religion'] = $this->input->post('other_religion');
		}else{
			$data['other_religion'] = "";
		}
		$id = $this->input->post("id");
		if($this->input->post('no_of_kids') == 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
			$data['lastborn_dob'] = '';
		}elseif($this->input->post('no_of_kids') > 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
			$data['lastborn_dob'] = $this->input->post('lastborn_dob');
		}else{
			$data['firstborn_dob'] = "";
			$data['lastborn_dob'] = "";
		}
		if($this->input->post('nationality') === 'Ghanaian'){
			$data['id_type'] = trim($this->input->post('id_type'));
			$data['id_number'] = trim($this->input->post('id_number'));
			$data['country'] = "";
			$data['nat_id_no'] = "";
		}else{
			$data['country'] = trim($this->input->post('country'));
			$data['nat_id_no'] = trim($this->input->post('nat_id_no'));
			$data['id_type'] = "";
			$data['id_number'] = "";
		}
		if($this->input->post('employment_status') == "Employed"){
			$data['employer_name'] = trim($this->input->post('employer_name'));
			$data['current_occupation'] = trim($this->input->post('current_occupation'));
			$data['buisness_name'] = "";
			$data['type_of_buisness'] = "";
		}elseif($this->input->post('employment_status') == "Self-Employed"){
			$data['buisness_name'] = trim($this->input->post('buisness_name'));
			$data['type_of_buisness'] = trim($this->input->post('type_of_buisness'));
			$data['employer_name'] = "";
			$data['current_occupation'] = "";
		}else{
			$data['buisness_name'] = "";
			$data['type_of_buisness'] = "";
			$data['employer_name'] = "";
			$data['current_occupation'] = "";
		}


		$household = $this->res->update_household($data,$id);
		$delete_need = $this->res->delete_household_need($id);

		if($delete_need){
			foreach ($com_needs as $key => $value) {
				$data1 = array('household_id' => $id ,'need_id' => $this->input->post("com_needs")[$key]);
				$this->res->add_com_needs($data1);
			}
		}

		if(!$household){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
		      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		        <span aria-hidden='true'>&times;</span>
		      </button>
		      Success, The Form was not submitted successfully.
		    </div>");
		}
		else{
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
		      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		        <span aria-hidden='true'>&times;</span>
		      </button>
		      Success, The Form was submitted successfully.
		    </div>");

		}
		redirect('view_household/'.$id);

	}

	//	edit household personnal data details
	public function edit_household_personnal_data(){

		$primary_contact = trim($this->input->post('primary_contact'));
		$data['firstname'] = ucfirst(trim($this->input->post('firstname')));
		$data['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$data['dob'] = trim($this->input->post('dob'));
		$data['place_of_birth'] = trim($this->input->post('place_of_birth'));
		$data['gender'] = trim($this->input->post('gender'));
		$data['email'] = trim($this->input->post('email'));
		$data['religion'] = trim($this->input->post('religion'));
		$data['primary_contact'] = trim($this->input->post('primary_contact'));
		$data['type_of_relationship'] = trim($this->input->post('contact_relationship'));
		$data['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$data['head_of_household'] = trim($this->input->post('head_of_household'));
		$data['res_prop_code'] = trim($this->input->post('res_prop_code'));
		$data['nationality'] = trim($this->input->post('nationality'));
		$data['tin']= $this->input->post('tin');
		$data['disability']= $this->input->post('disability');
		if($this->input->post('disability') === "Yes"){
			$data['specify_disability'] = implode(":", $this->input->post('specify_disability'));
		}
		$id = $this->input->post("id");
		if($this->input->post('religion') === "Others"){
			$data['other_religion'] = $this->input->post('other_religion');
		}else{
			$data['other_religion'] = "";
		}
		if($this->input->post('nationality') === 'Ghanaian'){
			$data['id_type'] = trim($this->input->post('id_type'));
			$data['id_number'] = trim($this->input->post('id_number'));
			$data['country'] = "";
			$data['nat_id_no'] = "";
		}else{
			$data['country'] = trim($this->input->post('country'));
			$data['nat_id_no'] = trim($this->input->post('nat_id_no'));
			$data['id_type'] = "";
			$data['id_number'] = "";
		}

		$household = $this->res->update_household($data,$id);
		if(!$household){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a household personnal data",
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
		redirect('Residence/edit_household_form/'.$id);

	}

	//	edit household member details
	public function edit_household_edu_data(){

		$data['highest_edu'] = trim($this->input->post('highest_edu'));
		$data['profession'] = trim($this->input->post('profession'));
		$data['employment_status'] = $this->input->post('employment_status');
		$data['date_of_last_emp']= $this->input->post('date_of_last_emp');
		$id = $this->input->post("id");
		if($this->input->post('religion') === "Others"){
			$data['other_religion'] = $this->input->post('other_religion');
		}else{
			$data['other_religion'] = "";
		}

		if($this->input->post('employment_status') == "Employed"){
			$data['employer_name'] = trim($this->input->post('employer_name'));
			$data['current_occupation'] = trim($this->input->post('current_occupation'));
			$data['buisness_name'] = "";
			$data['type_of_buisness'] = "";
		}elseif($this->input->post('employment_status') == "Self-Employed"){
			$data['buisness_name'] = trim($this->input->post('buisness_name'));
			$data['type_of_buisness'] = trim($this->input->post('type_of_buisness'));
			$data['employer_name'] = "";
			$data['current_occupation'] = "";
		}else{
			$data['buisness_name'] = "";
			$data['type_of_buisness'] = "";
			$data['employer_name'] = "";
			$data['current_occupation'] = "";
		}

		$household = $this->res->update_household($data,$id);

		if(!$household){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a household education data",
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
		redirect('Residence/edit_household_form/'.$id);

	}

	//	edit household family data
	public function edit_household_family_data(){

		$primary_contact = trim($this->input->post('primary_contact'));
		$com_needs = $this->input->post("com_needs");
		$data['marital_status'] = trim($this->input->post('marital_status'));
		$data['hometown'] = $this->input->post('hometown');
		$data['home_district']= $this->input->post('home_district');
		$data['region']= $this->input->post('region');
		$data['ethnicity']= $this->input->post('ethnicity');
		$data['native_lan']= $this->input->post('native_lan');
		$data['father_firstname']= $this->input->post('father_firstname');
		$data['father_lastname']= $this->input->post('father_lastname');
		$data['father_clan']= $this->input->post('father_clan');
		$data['mother_firstname']= $this->input->post('mother_firstname');
		$data['mother_lastname']= $this->input->post('mother_lastname');
		$data['mother_clan']= $this->input->post('mother_clan');
		$data['no_of_kids']= $this->input->post('no_of_kids');
		$id = $this->input->post("id");
		if($this->input->post('no_of_kids') == 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
			$data['lastborn_dob'] = '';
		}elseif($this->input->post('no_of_kids') > 1){
			$data['firstborn_dob'] = trim($this->input->post('firstborn_dob'));
			$data['lastborn_dob'] = $this->input->post('lastborn_dob');
		}else{
			$data['firstborn_dob'] = "";
			$data['lastborn_dob'] = "";
		}
		$household = $this->res->update_household($data,$id);
		$delete_need = $this->res->delete_household_need($id);

		if($delete_need){
			foreach ($com_needs as $key => $value) {
	        	$data1 = array('household_id' => $id ,'need_id' => $this->input->post("com_needs")[$key]);
	        	$this->res->add_com_needs($data1);
	        }
		}

		if(!$household){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a household family data",
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
		redirect('Residence/edit_household_form/'.$id);

	}

	//	edit owner data
	public function edit_personnal_data(){

		$rescode = $this->input->post('rescode');
		$update = $this->input->post('update_type');
		$original_primary_contact = $this->input->post('original_primary_contact');
		$primary_contact = trim($this->input->post('primary_contact'));

		$owner['firstname'] = ucfirst(trim($this->input->post('firstname')));
    	$owner['person_category'] = ucfirst(trim($this->input->post('personal_category')));
		$owner['lastname'] = ucfirst(trim($this->input->post('lastname')));
		$owner['primary_contact'] = trim($this->input->post('primary_contact'));
		$owner['secondary_contact'] = trim($this->input->post('secondary_contact'));
		$owner['owner_native'] = trim($this->input->post('owner_native'));
		$owner['religion'] = trim($this->input->post('religion'));
		$owner['email'] = trim($this->input->post('email'));
		$owner['postal_address'] = trim($this->input->post('postal_address'));
		$resid= $this->input->post('resid');
		$ownid= $this->input->post('ownid');
		if($this->input->post('religion') === "Others"){
			$owner['other_religion'] = $this->input->post('other_religion');
		}

		if($update == "update"){
			$owner_id = $this->res->update_owner($owner,$ownid);
		}else if($update == "detach"){
			if($primary_contact == $original_primary_contact){
				$owner_id = $this->res->update_owner($owner,$ownid);
			}else if($primary_contact !== $original_primary_contact){
				if(owner_exit(trim($this->input->post('primary_contact')))){
					$id = owner_exit(trim($this->input->post('primary_contact')));
					$owner_id = $this->res->update_res_to_owner($resid,$id);
				}else{
					$id = $this->res->add_owner($owner);
					$owner_id = $this->res->update_res_to_owner($resid,$id);
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
		// }elseif($this->input->post('owner_native') == 'No' || $this->input->post('owner_native') == 'Yes, Does not Reside In Property And In District'){
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

		if($update == "update"){
			$owner_id = $this->res->update_owner($owner,$ownid);
		}else if($update == "detach"){
			if($primary_contact == $original_primary_contact){
				$owner_id = $this->res->update_owner($owner,$ownid);
			}else if($primary_contact !== $original_primary_contact){
				if(owner_exit(trim($this->input->post('primary_contact')))){
					$id = owner_exit(trim($this->input->post('primary_contact')));
					$owner_id = $this->res->update_res_to_owner($resid,$id);
				}else{
					$id = $this->res->add_owner($owner);
					$owner_id = $this->res->update_res_to_owner($resid,$id);
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
				'activity' => "Edited a residence property owner's data",
				'status' => true,
				'description' => "Edited residence property owner info with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Residence/edit_residence_form/'.$resid.'/'.$rescode);

	}

	//	edit residence location data
	public function edit_location_data(){

		$rescode = $this->input->post('rescode');
		$areacode = get_areacode($this->input->post('area_council'));
		$towncode = get_towncode($this->input->post('town'));
		$data['town'] = trim($this->input->post('town'));
		$data['area_council'] = trim($this->input->post('area_council'));
		$data['streetname'] = trim($this->input->post('streetname'));
		$data['sectorial_code'] = trim($this->input->post('sectorial_code'));
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

		$res_id = $this->res->update_residence($data,$resid);


		if(!$res_id){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a residence location data",
				'status' => true,
				'description' => "Edited residence property location data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Residence/edit_residence_form/'.$resid.'/'.$rescode);

	}

	//	edit residence prop data
	public function edit_prop_data(){

		$rescode = $this->input->post('rescode');
		$data['property_type'] = trim($this->input->post('property_type2'));
		$data['construction_material'] = trim($this->input->post('construction_material'));
		$data['roofing_type'] = trim($this->input->post('roofing_type'));
		$data['year_of_construction'] = trim($this->input->post('year_of_construction'));
		$data['building_type'] = $this->input->post('type_of_building');
		$data['temporary_building'] = $this->input->post('detail_for_temp');
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
		$resid= $this->input->post('resid');
		$res_id = $this->res->update_residence($data,$resid);
		$res_to_category = $this->res->update_res_to_category($category,$resid);


		if(!$res_id && !$res_to_category){
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Oh Snap! </strong> Your Form Was Not Submitted.
          	</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a residence property data",
				'status' => true,
				'description' => "Edited residence property data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
				<strong>Success! </strong> Your Form Was Submitted.
			</div>");

		}
		redirect(base_url().'Residence/edit_residence_form/'.$resid.'/'.$rescode);

	}

	//	edit residence facility data
	public function edit_facility_data(){

		$rescode = $this->input->post('rescode');

		//property image upload
		//configure upload
		$config['upload_path'] = './upload/property/residence';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '1000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$image = $this->input->post('old_image');
			$file_path = $this->input->post('image_path');
		} else {
			$file_data = $this->upload->data();

			$file_path = '/upload/property/residence/';
			$image = $file_data['file_name'];
		}

    	$data['building_status'] = trim($this->input->post('building_status'));
		$data['building_permit'] = trim($this->input->post('building_permit'));
		$data['planning_permit'] = trim($this->input->post('planning_permit'));
		$data['toilet_facility'] = $this->input->post('toilet_facility');
		$data['avai_of_water'] = $this->input->post('avai_of_water');
		$data['avai_of_refuse']= $this->input->post('avai_of_refuse');
		$data['noOfResidents'] = trim($this->input->post('no_of_residents'));
		$data['resident_greater_18'] = trim($this->input->post('resident_greater_18'));
		$data['inhabitant_status'] = trim($this->input->post('inhabitant_status'));
		$data['upn_number'] = trim($this->input->post('upn_number'));
		$data['accessed'] = trim($this->input->post('accessed_status'));
		$data['assessable_status'] = trim($this->input->post('property_assessment'));
		$data['image_path'] = $file_path;
		$data['property_image'] = $image;
		$rateable_amount = trim($this->input->post('rateable_amount'));
		$rate = trim($this->input->post('rate'));
		$resid= $this->input->post('resid');
		$apid= $this->input->post('apid');
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
					'product_id' => "13",
					'property_id' => $resid,
					'target' => "1",
					'rateable_value' => $rateable_amount,
					'rate' => $rate,
					'invoice_amount' => $rateable_amount * $rate,
					'valuation_number' => trim($this->input->post('valuation_number'))
				);
				$accessed = $this->TaxModel->insert_accessed_record($data1);	
			}
		}else{
			
		}

		$res_id = $this->res->update_residence($data,$resid);


		if(!$res_id){	
			 $this->session->set_flashdata('message', "<div class='alert alert-danger'>
					<strong>Oh Snap! </strong> Your Form Was Not Submitted.
				</div>");
		}
		else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited a residence facility data",
				'status' => true,
				'description' => "Edited residence property facility data with code: $rescode",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");

		}
		redirect(base_url().'Residence/edit_residence_form/'.$resid.'/'.$rescode);

	}

	// view residence profile page
	public function view_residence($id,$rescode){

		if(has_permission($this->session->userdata('user_info')['id'],'view residence')){
			$data = array(
				'area' => $this->res->get_area_councils(),
				"page" => 'residence/view_residence',
				'title' => 'Residence Details',
				'residence' => $this->res->get_residence_details($id),
				'result' => $this->res->get_residence_household($rescode),
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


	// view household member profile page
	public function view_household($id){

			if(has_permission($this->session->userdata('user_info')['id'],'view household')){
				$get_household_needs = $this->res->get_household_needs($id);
				$needs ="";
				foreach ($get_household_needs as $get) {
					$needs .= $get->need_id.',';
				}

				$data = array(
					"page" => 'residence/view_household',
					'title' => 'Household Member Details',
					'education' => $this->res->get_edu(),
					'profession' => $this->res->get_prof(),
					'household' => $this->res->get_household_details($id),
					'com' => $this->res->get_com(),
					'needs' => rtrim($needs,',')
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

	// view agencies under the given agency category
	public function view_agencies(){
		    $agencyid = $this->uri->segment(2);
		    $header =  $this->Agency_model->agency_type($agencyid);
    		$data = array(
				"page" => 'agency/view_agencies',
				'title' => $header,
				'result' => $this->Agency_model->get_agencies($agencyid),
			);
			$this->load_page($data);

	}

	// resend residence sms
	public function resend_residence_sms(){
		$primary_contact = $this->input->post("number");
		$rescode = $this->input->post("rescode");
		$houseno = $this->input->post("houseno");
		$sms_message = "Your Residence Property has been registered successfully on the ". SYSTEM_ID ." Platform.\n Your Residence Property Code is $rescode\n Your House No is $houseno\nThank You";
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Resent residence sms",
			'status' => true,
			'description' => "Resent an sms to residence with code: $rescode",
			'user_category' => "admin",
			'channel' => "Web"
			
		);
		$audit_tray = audit_tray($info);
		//end of insert
		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
    	send_sms($phone_formatted, $sms_message);
    	$this->session->set_flashdata('message', "<div class='alert alert-success'>
        	<strong>Success! </strong> Sms Successfully Resent.
      	</div>");
      	redirect('residence');
	}

	// resend household sms
	public function resend_household_sms(){
		$primary_contact = $this->input->post("number");
		$rescode = $this->input->post("rescode");
		$houseno = get_res_houseno($rescode);
		$sms_message = "You have been registered successfully on the ". SYSTEM_ID .".\nYour House No is $houseno\nThank You";
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Resent household sms",
			'status' => true,
			'description' => "Resent an sms to household with code: $rescode",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert
		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
    	send_sms($phone_formatted, $sms_message);
    	$this->session->set_flashdata('message', "<div class='alert alert-success'>
        	<strong>Success! </strong> Sms Successfully Resent.
      	</div>");
      	redirect('household');
	}

	// import records from a file
	public function import_residence_records(){
		$count = 0;
		$successful = 0;
		$failed = 0;
		$csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		//	exit($_FILES['file']['name']);

		//configure upload
		$config['upload_path'] = './upload/upload_files/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '10000';

		$this->load->library('upload', $config);

		// do file upload
		if (!$this->upload->do_upload()) {
				$error = $this->upload->display_errors();

				$this->session->set_flashdata('message',"<div class='alert alert-danger'>".$error."</div>");
				redirect(base_url().'residence');
		} else {
			if(!empty($_FILES['userfile']['name']) && in_array($_FILES['userfile']['type'],$csvMimes)){
					$file_data = $this->upload->data();
					if(is_uploaded_file($_FILES['userfile']['tmp_name'])){

							//open uploaded csv file with read only mode
							$csvFile = fopen($_FILES['userfile']['tmp_name'], 'r');

							// skip first line
							// if your csv file have no heading, just comment the next line
							fgetcsv($csvFile);

							//parse data from csv file line by line

							while(($line = fgetcsv($csvFile)) !== FALSE){
									$raw_data = "";
									$row = 0;
									
									$areacode = get_areacode($line[10]);
									$towncode = get_towncode($line[11]);
							
									$owner_exit = owner_exit(trim($line[0]));
									$code = $this->res->resnumber($line[10],$line[11]);
									$primary_contact = trim($line[0]);
									$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_RESIDENTIAL_PROPERTY_PER_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
									$houseno = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
									$owner['firstname'] = ucfirst(trim($line[1]));
									$owner['lastname'] = ucfirst(trim($line[2]));
									$owner['primary_contact'] = trim($line[0]);
									$owner['secondary_contact'] = trim($line[6]);
									$owner['owner_native'] = trim($line[7]);
									$owner['religion'] = trim($line[8]);
									$owner['email'] = trim($line[3]);
									$owner['postal_address'] = trim($line[4]);
									$data['year_of_construction'] = trim($line[29]);
									$data['res_code'] = $gen_rescode;
									$data['town'] = trim($line[11]);
									$data['area_council'] = trim($line[10]);
									$data['streetname'] = trim($line[12]);
									$data['landmark'] = trim($line[13]);
									$data['locality_code'] = $towncode;
									$data['street_code'] = trim($line[14]);
									$data['new_property_no'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
									$data['old_property_no'] = trim($line[15]);
									$data['zone_code'] = $areacode;
									$data['gps_lat']= $line[54];
									$data['gps_long']= $line[55];
									$data['houseno'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
									$data['ghpost_gps'] = trim($line[16]);
									$data['property_type'] = trim($line[27]);
									$data['no_of_rooms'] = trim($line[22]);
									$data['building_type'] = $line[25];
									$data['temporary_building']= $line[26];
									$data['building_permit'] = trim($line[40]);
									$data['planning_permit'] = trim($line[42]);
									$data['construction_material'] = trim($line[23]);
									$data['roofing_type'] = trim($line[24]);
									$data['toilet_facility'] = $line[30];
									$data['avai_of_water'] = $line[34];
									$data['avai_of_refuse']= $line[37];
									$data['noOfResidents'] = trim($line[44]);
									$data['resident_greater_18'] = trim($line[45]);
									$data['assessable_status'] = trim($line[53]);
									$data['building_status'] = trim($line[46]);
									$data['code'] = $code;
									$data["agent_id"] = $this->session->userdata('user_info')['id'];
									$data["agent_category"] = "admin";
									$data['accessed'] = trim($line[48]);
									$data['upn_number'] = trim($line[52]);
									$rateable_amount = trim($line[49]);
									$rate = trim($line[50]);
									if(trim($line[46]) == "0"){
										$data['inhabitant_status'] = $line[47];
									}
									if($line[8] === "Others"){
										$owner['other_religion'] = $line[9];
									}
									if($line[27] !== 'Compound'){
										$data['no_of_floors'] = trim($line[28]);
									}
									if($line[40] == 'Yes'){
										$data['building_cert_no'] = trim($line[41]);
									}
									if($line[42] == 'Yes'){
										$data['planning_permit_no'] = trim($line[43]);
									}
									if($line[30] == 'Yes'){
										$data['t_facility_yes'] = $line[31];
										$data['no_of_toilet_facility'] = $line[32];
									}else{
										$data['t_facility_no'] = trim($line[33]);
									}
									if($line[34] == 'No'){
										$data['source_water_no'] = trim($line[36]);
									}else{
										$data['source_water_yes'] = trim($line[35]);
									}
									if($line[37] == 'Yes'){
										$data['dumping_site_yes'] = trim($line[38]);
									}else{
										$data['dumping_site_no'] = trim($line[39]);
									}
							
									if($owner_exit){
										$owner_id = $owner_exit;
									}else{
										$owner_id = $this->res->add_owner($owner);
									}

									if ($owner_id){
										$res_id = $this->res->add_residence($data);

										if($data->{'accessed'} == 1){
											$datas  = array(
												'product_id' => "13",
												'property_id' => $res_id,
												'target' => "1",
												'rateable_value' => $rateable_amount,
												'rate' => $rate,
												'invoice_amount' => $rateable_amount * $rate,
												'valuation_number' => trim($line[51])
											);
											$accessed = $this->tax->insert_accessed_record($datas);
										}else{
											
										}

										$category['category1'] = trim($line[17]);
										$category['category2'] = trim($line[18]);
										$category['category3'] = trim($line[19]);
										$category['category4'] = trim($line[20]);
										$category['category5'] = trim($line[21]);
										$category['category6'] = trim($line[22]);
										$category['property_id'] = $res_id;
										$category_insert = $this->db->insert('res_to_category',$category);
								
										$res_to_owner = $this->res->add_res_to_owner($res_id,$owner_id);
								
										if($res_to_owner){
								
											// insert into audit tray
											$info = array(
												'user_id' => $this->session->userdata('user_info')['id'],
												'activity' => "Added a residence property",
												'status' => true,
												'user_category' => "admin",
												'description' => "Added a residence property with code: $gen_rescode",
												'channel' => "Web",
											);
											$audit_tray = audit_tray($info);
											//end of insert
											
											$echannelid = 1;
											$echannel = $this->Channelmodel->channelstatus($echannelid);
											if($echannel != 0){
												$sms_message = "Your Residence Property has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Residence Property Code is $gen_rescode\nThank You";
												$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
												send_sms($phone_formatted, $sms_message);
											}else{

											}

										}
										else{
											// insert into audit tray
											$info = array(
												'user_id' => $this->session->userdata('user_info')['id'],
												'activity' => "Added a residence property",
												'status' => false,
												'user_category' => "admin",
												'description' => "Added a residence property with code: $gen_rescode",
												'channel' => "Web",
											);
											$audit_tray = audit_tray($info);
											//end of insert
										}
										$successful++;
									}else{
										$failed++;
										// insert into audit tray
										$info = array(
											'user_id' => $data->{'agentId'},
											'activity' => "Added a residence property",
											'status' => false,
											'user_category' => $data->{'collector'},
											'description' => "Added a residence property with code: $gen_rescode",
											'channel' => "Web",
										);
										$audit_tray = audit_tray($info);
										//end of insert
									}
									$count++;
							}
							if($failed == 0){
								$status = 1;
							}elseif ($failed > 0){
								$status = 0;
							}

							//close opened csv file
							fclose($csvFile);

							// insert into audit tray
							$info = array(
								'user_id' => $this->session->userdata('user_info')['id'],
								'activity' => "Imported Records",
								'status' => false,
								'user_category' => "admin",
								'description' => "Imported $count records for residence property",
								'channel' => "Web",
							);
							$audit_tray = audit_tray($info);
							//end of insert
							if($audit_tray){
								$this->session->set_flashdata('message',"<div class='alert alert-success'>Your import was sucessful. Total records: $count; Successful: $successful; Failed: $failed</div>");
								redirect(base_url().'residence');
							}else{
								$this->session->set_flashdata('message',"<div class='alert alert-danger'>Sorry, Something went wrong while storing file data.</div>");
								redirect(base_url().'residence');
							}
					}else{
						$this->session->set_flashdata('message',"<div class='alert alert-danger'>Sorry, An error occured.</div>");
						redirect(base_url().'residence');
					}
			}else{
				$this->session->set_flashdata('message',"<div class='alert alert-danger'>Invalid File Type.</div>");
				redirect(base_url().'residence');
			}
		}
	}

	// search property owner already exit
	public function search_property_owner($contact){
		$result =  $this->res->owner_exit($contact);
	}

	//	check if residence code exits in the database
	public function search_res_prop_code(){
		$search_value = strtoupper($this->uri->segment(3));
		$query = $this->res->get_res_prop_code($search_value);
		echo json_encode($query);
	}

	//	check if residence code exits in the database
	public function search_res_prop_latlong(){
		$search_value = strtoupper($this->uri->segment(3));
		$query = $this->res->get_res_prop_latlong($search_value);
		echo json_encode($query);
	}

// email system
//	function send_email($email,$message,$subject,$agencyname) {
//            $response = false;
//            $this->load->library("phpmailer_library");
//            $mail = $this->phpmailer_library->load();
//            $body = $message;
//
//            $mail->CharSet = 'UTF-8';
//            $mail->SetFrom('admin@ellembellerms.com','Ellembelle District Assembley');
//
//            //You could either add recepient name or just the email address.
//            $mail->AddAddress($email,$agencyname);
//            $mail->AddAddress($email);
//
//            //Address to which recipient will reply
//            $mail->addReplyTo("admin@ellembellerms.com","Ellembelle District Assembley");
//            //$mail->addCC("cc@example.com");
//            //$mail->addBCC("bcc@example.com");
//
//            // Add a file attachment
//            // $mail->addAttachment("file.txt", "File.txt");
//            // $mail->addAttachment("images/profile.png"); //Filename is optional
//
//            //You could send the body as an HTML or a plain text
//            $mail->IsHTML(true);
//
//            $mail->Subject = $subject;
//            $mail->Body = $body;
//
//            //Send email via SMTP
//            $mail->IsSMTP();
//            $mail->SMTPAuth   = true;
//            $mail->Host       = "mail.ellembellerms.com";
//            $mail->Port       = 587; //you could use port 25, 587, 465 for googlemail
//            $mail->Username   = "admin@ellembellerms.com";
//            $mail->Password   = "email4ERMS";
//
//            if (!$mail->send()) {
//                echo 'Message could not be sent.';
//                echo 'Mailer Error: ' . $mail->ErrorInfo;
//            } else {
//                echo 'Message sent';
//            }
//            
//    }
        
    // email system
    function send_email($email,$message,$subject,$agencyname) {
        $response = false;
        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();
        $body = $message;

        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('bklutse30@gmail.com','Akwabaa');

        //You could either add recepient name or just the email address.
        $mail->AddAddress($email,$agencyname);
        $mail->AddAddress($email);

        //Address to which recipient will reply
        $mail->addReplyTo("bklutse30@gmail.com","Akwabaa");
        //$mail->addCC("cc@example.com");
        //$mail->addBCC("bcc@example.com");

        // Add a file attachment
        // $mail->addAttachment("file.txt", "File.txt");        
        // $mail->addAttachment("images/profile.png"); //Filename is optional

        //You could send the body as an HTML or a plain text
        $mail->IsHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $body;

        //Send email via SMTP
        $mail->IsSMTP();
        $mail->SMTPAuth   = true; 
        $mail->SMTPSecure = "ssl";  //tls
        $mail->Host       = "smtp.googlemail.com";
        $mail->Port       = 587; //you could use port 25, 587, 465 for googlemail
        $mail->Username   = "bklutse30@gmail.com";
        $mail->Password   = "ronaldo222";

        if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent';
            }
        //echo json_encode($response);
    }
  
    public function sendmail() {
        $this->send_email('bklutse20@gmail.com', 'This is a test message', 'test message', '');
    }

	function randomString($length = 10) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		echo $str;
	}
        
 	// resend residence message
	public function send_residence_message(){

		$primary_contact = $this->input->post("primary_contact");
		$message = $this->input->post("message");
		$message_type = $this->input->post("message_type");
		
		if($message_type == "SMS"){
			$echannelid = 1;
			$echannel = $this->Channelmodel->channelstatus($echannelid);
			if($echannel != 0){
				$sms_message = "$message";

				// $phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
				$phone_formatted = formatPhonenumber($primary_contact);
				send_sms($phone_formatted, $sms_message);
				// $this->session->set_flashdata('message', "<div class='alert alert-success'>
				// 	<strong>Success! </strong> SMS sent.
				// </div>");
				return $this->output->set_content_type('application/json')
					->set_status_header(200)
					->set_output(
						json_encode(array("result" => "Sms has been sent")));
			}
			else{
				// $this->session->set_flashdata('message', "<div class='alert alert-warning'>
				// 	<strong>Sorry! </strong> SMS not sent because the channel is blocked.
				// </div>");
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
		//    	'user_id' => $this->session->userdata('user_info')['id'],
		//    	'activity' => "Reset user password",
		//    	'status' => true,
		//    	'description' => "Resetted password of user: $username",
		// 	'user_category' => "admin",
		//    	'channel' => "Web"
		// );
		// $audit_tray = audit_tray($info);
		//end of insert
	
            
	}
 
	// resend residence message
	public function send_household_message(){

		$primary_contact = $this->input->post("primary_contact");
		$message = $this->input->post("message");
		$message_type = $this->input->post("message_type");
		
		if($message_type == "SMS"){
			$echannelid = 1;
			$echannel = $this->Channelmodel->channelstatus($echannelid);
			if($echannel != 0){
				$sms_message = "$message";

				$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
				send_sms($phone_formatted, $sms_message);
				$this->session->set_flashdata('message', "<div class='alert alert-success'>
					<strong>Success! </strong> SMS sent.
				</div>");
			}
			else{
				$this->session->set_flashdata('message', "<div class='alert alert-warning'>
					<strong>Sorry! </strong> SMS not sent because the channel is blocked.
				</div>");
			}
			redirect('household');  
		}else if($message_type == "EMAIL"){
			redirect('household'); 
		}else{
			redirect('household'); 
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
		// end of insert
	
            
	}

	// get residential properties ajax call
	public function residenceList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->res->getResidentialProperties($postData);

		echo json_encode($data);
	}

}
