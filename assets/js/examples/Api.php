<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Residence_model','res');
	}

	public function token_post()
    {
    	$data = json_decode(file_get_contents('php://input'));
       	$id = $data->{'id'};
        $output['token'] = $id;
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    public function rescode_post()
    {
    	$data = json_decode(file_get_contents('php://input'));
       	$id = strtoupper($data->{'resPropCode'});
        $query = $this->db->query("SELECT * from residence WHERE res_code = '$id'");
        if($query->num_rows() > 0){
        	$this->set_response("success", REST_Controller::HTTP_OK);
        }else{
        	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);	
        }
        
    }

    public function saveHousehold_post()
    {
    	$dat = json_decode(file_get_contents('php://input'));
   
        $primary_contact = $dat->{'primaryContact'};
		$rescode = strtoupper(trim($dat->{'resPropCode'}));
		$data['firstname'] = trim($dat->{'firstname'});
		$data['lastname'] = trim($dat->{'lastname'});
		$data['dob'] = trim($dat->{'dob'});
		$data['place_of_birth'] = trim($dat->{'pob'});
		$data['gender'] = trim($dat->{'gender'});
		$data['primary_contact'] = trim($dat->{'primaryContact'});
		$data['secondary_contact'] = trim($dat->{'secondaryContact'});
		$data['head_of_household'] = trim($dat->{'household'});
		$data['res_prop_code'] = trim($dat->{'resPropCode'});
		$data['highest_edu'] = $dat->{'highestEdu'};
		$data['profession'] = $dat->{'profession'};
		$data['employment_status'] = $dat->{'employmentStatus'};
		$data['email'] = trim($dat->{'email'});
		$data['nationality'] = trim($dat->{'nationality'});
		$data['marital_status'] = $dat->{'maritalStatus'};
		$data['hometown'] = trim($dat->{'hometown'});
		$data['home_district']= trim($dat->{'hometownDistrict'});
		$data['region']= $dat->{'region'};
		$data['religion']= $dat->{'religion'};
		$data['ethnicity']= trim($dat->{'ethnicity'});
		$data['native_lan']= trim($dat->{'nativeLan'});
		$data['father_firstname']= trim($dat->{'fFirstname'});
		$data['father_lastname']= trim($dat->{'fLastname'});
		$data['father_clan']= $dat->{'fclan'};
		$data['mother_firstname']= trim($dat->{'mFirstname'});
		$data['mother_lastname']= trim($dat->{'mLastname'});
		$data['mother_clan']= $dat->{'mclan'};
		$data['no_of_kids']= trim($dat->{'nokids'});
		$data['date_of_last_emp']= trim($dat->{'doe'});
		$data['tin']= trim($dat->{'tin'});
		$data['disability']= $dat->{'disability'};
		if($dat->{'religion'} === "Others"){
			$data['other_religion'] = trim($dat->{'religionName'});
		}
		if($dat->{'nokids'} == 1){
			$data['firstborn_dob'] = trim($dat->{'fob'});
		}elseif($dat->{'nokids'} > 1){
			$data['firstborn_dob'] = trim($dat->{'fob'});
			$data['lastborn_dob'] = trim($dat->{'lob'});
		}else{

		}
		if($dat->{'nationality'} === 'Ghanaian'){
			$data['id_type'] = $dat->{'idType'};
			$data['id_number'] = trim($dat->{'idNumber'});
		}else{
			$data['country'] = trim($dat->{'country'});
			$data['nat_id_no'] = trim($dat->{'natIdNo'});
		}
		if($dat->{'employmentStatus'} === "Employed"){
			$data['employer_name'] = trim($dat->{'employerName'});
			$data['current_occupation'] = trim($dat->{'currentOccupation'});
		}elseif($dat->{'employmentStatus'} === "Self-Employed"){
			$data['buisness_name'] = trim($dat->{'businessName'});
			$data['type_of_buisness'] = trim($dat->{'typeBusiness'});
		}else{

		}
		

		$household = $this->res->add_household($data);
		if($household){
			$houseno = get_res_houseno($rescode);
			$sms_message = "You have been registered successfully on the Ellembelle District Assembly Platform.\nYour House No is $houseno\nThank You";
    		
    		$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
        	send_sms($phone_formatted, $sms_message);
        	$this->set_response('success', REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		}
    }
}