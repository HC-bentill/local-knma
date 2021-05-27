<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Api extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Residence_model','res');
		$this->load->model('Business_model','bus');
		$this->load->model('AgentModel','agent');
		$this->load->model('LoginModel','user');
		$this->load->model('TaxModel','tax');
		$this->load->model('FoodModel');
		$this->load->model('Channelmodel');
	}

	public function hello_get()
	{
		$tokenData = 'Hello World!';

		// Create a token
		$token = AUTHORIZATION::generateToken($tokenData);
		// Set HTTP status code
		$status = parent::HTTP_OK;
		// Prepare the response
		$response = ['status' => $status, 'token' => $token];
		// REST_Controller provide this method to send responses
		$this->response($response, $status);
	}

	public function token_post()
	{
		$id = $this->post('id');
		$output['token'] = $id;
		$this->set_response($output, REST_Controller::HTTP_OK);
	}

	public function rescode_post()
	{
		$id = strtoupper($this->post('resPropCode'));
		$query = $this->db->query("SELECT res_code from residence WHERE res_code = '$id'");
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}
        
	public function agentTransactionCount_post()
  	{
		$id = $this->post('collectorId');
		$collectedBy = $this->post('collectedBy');
		$query = $this->db->query("SELECT category, toll_type, count(id) as count from toll_transaction WHERE collected_by = '$collectedBy' AND created_by = '$id' group by 1,2")->result_array();
		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function codeSearch_post()
	{
		$search_category = $this->post('searchCategory');
		$primary_contact = trim($this->post('primaryContact'));
		$category = $this->post('category');
		$property_code = trim(strtoupper($this->post('propertyCode')));
		$category2 = $this->post('category2');

		if($search_category == "pn"){
			$id = owner_exit($primary_contact);
			if($id){
				if($category == "res"){
					$query = $this->db->query("SELECT b.id, buis_prop_code as code, t.town, a.name, 'busprop' as flag FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
										left join town t on b.town = t.id left join area_council a on b.area_council = a.id WHERE r.owner_id = ? AND b.category = ?",[$id,13]);

					if($query->num_rows() > 0){
						$this->set_response($query->result(), REST_Controller::HTTP_OK);
					}else{
						$this->set_response("Empty", REST_Controller::HTTP_OK);
					}
				}elseif($category == "busprop"){
					$query = $this->db->query("SELECT b.id, buis_prop_code as code, t.town, a.name, 'busprop' as flag FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
										left join town t on b.town = t.id left join area_council a on b.area_council = a.id WHERE r.owner_id = ? AND b.category = ?",[$id,12]);
					if($query->num_rows() > 0){
						$this->set_response($query->result(), REST_Controller::HTTP_OK);
					}else{
						$this->set_response("Empty", REST_Controller::HTTP_OK);
					}
				}elseif($category == "busocc"){
					$query = $this->db->query("SELECT b.id, buis_occ_code as code, t.town, a.name, 'busocc' as flag FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
									left join buisness_property p on b.buis_property_code =  p.buis_prop_code
									left join town t on p.town = t.id left join area_council a on p.area_council = a.id WHERE r.owner_id = ?",[$id]);
					if($query->num_rows() > 0){
						$this->set_response($query->result(), REST_Controller::HTTP_OK);
					}else{
						$this->set_response("Empty", REST_Controller::HTTP_OK);
					}
				}elseif($category == "all"){
					$query1 = $this->db->query("SELECT b.id, buis_prop_code as code, t.town, a.name, 'busprop' as flag FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
										left join town t on b.town = t.id left join area_council a on b.area_council = a.id WHERE r.owner_id = ? AND b.category = ?",[$id,13])->result();

					$query2 = $this->db->query("SELECT b.id, buis_prop_code as code, t.town, a.name, 'busprop' as flag FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
										left join town t on b.town = t.id left join area_council a on b.area_council = a.id WHERE r.owner_id = ? AND b.category = ?",[$id,12])->result();

					$query3 = $this->db->query("SELECT b.id, buis_occ_code as code, t.town, a.name, 'busocc' as flag FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
													left join buisness_property p on b.buis_property_code =  p.buis_prop_code
													left join town t on p.town = t.id left join area_council a on p.area_council = a.id WHERE r.owner_id = ?",[$id])->result();

					$query = array_merge($query1, $query2, $query3);

					if($query !== "[]"){
						$this->set_response($query, REST_Controller::HTTP_OK);
					}else{
						$this->set_response("Empty", REST_Controller::HTTP_OK);
					}
				}else{
					$query = $this->db->query("SELECT buis_occ_code as code, t.town, a.name FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
										left join buisness_property p on b.buis_property_code =  p.buis_prop_code
										left join town t on p.town = t.id left join area_council a on p.area_council = a.id WHERE r.owner_id = ?",[$id]);

					if($query->num_rows() > 0){
						$this->set_response($query->result(), REST_Controller::HTTP_OK);
					}else{
						$this->set_response("Empty", REST_Controller::HTTP_OK);
					}
				}
			}else{
					$this->set_response("Nothing Found", REST_Controller::HTTP_OK);
			}
		}else if($search_category == "pc"){
			if($category2 == "res"){
				$query = $this->db->query("SELECT firstname,lastname,primary_contact FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
									left join property_owner p on r.owner_id = p.id WHERE b.buis_prop_code = ? AND b.category = ?",[$property_code,13]);

				if($query->num_rows() > 0){
					$this->set_response($query->result(), REST_Controller::HTTP_OK);
				}else{
					$this->set_response("Empty", REST_Controller::HTTP_OK);
				}
			}elseif($category2 == "busprop"){
				$query = $this->db->query("SELECT firstname,lastname,primary_contact FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
									left join property_owner p on r.owner_id = p.id WHERE b.buis_prop_code = ? AND b.category = ?",[$property_code,12]);
				if($query->num_rows() > 0){
					$this->set_response($query->result(), REST_Controller::HTTP_OK);
				}else{
					$this->set_response("Empty", REST_Controller::HTTP_OK);
				}
			}elseif($category2 == "busocc"){
				$query = $this->db->query("SELECT firstname,lastname,primary_contact FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
									left join property_owner p on r.owner_id = p.id WHERE b.buis_occ_code = ?",[$property_code]);
				if($query->num_rows() > 0){
					$this->set_response($query->result(), REST_Controller::HTTP_OK);
				}else{
					$this->set_response("Empty", REST_Controller::HTTP_OK);
				}
			}else{
				$query = $this->db->query("SELECT firstname,lastname,primary_contact FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
									left join property_owner p on r.owner_id = p.id WHERE r.buis_occ_code = ?",[$property_code]);

				if($query->num_rows() > 0){
					$this->set_response($query->result(), REST_Controller::HTTP_OK);
				}else{
					$this->set_response("Empty", REST_Controller::HTTP_OK);
				}
			}
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}
	}

	public function householdSearch_post()
	{
		$primary_contact = $this->post('primaryContact');

		$query = $this->db->query("SELECT h.firstname, h.lastname, h.res_prop_code, r.houseno FROM household h left join residence r on h.res_prop_code = r.res_code
		WHERE h.primary_contact = ?",[$primary_contact]);

		if($query->num_rows() > 0){
			$this->set_response($query->result(), REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}

	}

	public function incomplete_post()
	{
		$agentId = $this->post('agentId');
		$category = $this->post('category');

		if($category === "res"){
			$query = $this->db->query("SELECT buis_prop_code as code, t.town, a.name, b.gps_lat, b.gps_long FROM buisness_property b left join town t on b.town = t.id
							left join area_council a on b.area_council = a.id WHERE b.agent_id = ? AND b.category= ? AND b.status= ?",[$agentId,13,0])->result();
		}elseif($category === "busprop"){
			$query = $this->db->query("SELECT buis_prop_code as code, t.town, a.name, b.gps_lat, b.gps_long FROM buisness_property b left join town t on b.town = t.id
							left join area_council a on b.area_council = a.id WHERE b.agent_id = ? AND b.category= ? AND b.status= ?",[$agentId,12,0])->result();
		}else{
			$query1 = $this->db->query("SELECT buis_prop_code as code, t.town, a.name, b.gps_lat, b.gps_long FROM buisness_property b left join town t on b.town = t.id
			left join area_council a on b.area_council = a.id WHERE b.agent_id = ? AND b.category= ? AND b.status= ?",[$agentId,13,0])->result();

			$query2 = $this->db->query("SELECT buis_prop_code as code, t.town, a.name, b.gps_lat, b.gps_long FROM buisness_property b left join town t on b.town = t.id
			left join area_council a on b.area_council = a.id WHERE b.agent_id = ? AND b.category= ? AND b.status= ?",[$agentId,12,0])->result();

			$query = array_merge($query1, $query2);
		}
		if($query !== "[]"){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}

	}

	// delete a record from the mobile app
	public function deleteRecord_post()
	{
		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{

			$code = $this->post('code');
			$property_id = $this->post('propertyId');
			$flag = $this->post('flag');

			if($flag == "busprop"){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('buisness_property');
				
				$this->db->where('property_id', $property_id);
				$del2 = $this->db->delete('busprop_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('buis_prop_to_owner');

				$property_category = "business property";
				$target = 2;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}
				
			}else if($flag == "res"){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('buisness_property');
				
				$this->db->where('property_id', $property_id);
				$del2 = $this->db->delete('busprop_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('buis_prop_to_owner');
				
				$property_category = "residence";
				$target = 1;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}

			}else if($flag == "busocc"){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('buisness_occ');
				
				$this->db->where('busocc_id', $property_id);
				$del2 = $this->db->delete('busocc_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('buis_occ_to_owner');
				
				$property_category = "business occupant";
				$target = 3;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}
			}else{
				$response = "fail";
			}

			if($response == "success"){
				$sql = "DELETE i FROM invoice i JOIN revenue_product r ON r.id = i.product_id WHERE r.target = $target AND i.property_id = $property_id";
				$this->db->query($sql);
			}

			if($response == "success"){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Delete Record",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Deleted $property_category record with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Delete Record",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Delete for record with code: $code failed",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
			}

			$this->set_response($response, REST_Controller::HTTP_OK);

		}

	}

	// get record to be editted
	public function getEditRecord_post()
	{
		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{

			$code = $this->post('code');
			$property_id = $this->post('propertyId');

			$this->db->select('id');
			$this->db->from('buisness_property');
			$this->db->where('buis_prop_code', $code);
			$busprop_query = $this->db->get();

			$this->db->select('id');
			$this->db->from('residence');
			$this->db->where('res_code', $code);
			$res_query = $this->db->get();

			$this->db->select('id');
			$this->db->from('buisness_occ');
			$this->db->where('buis_occ_code', $code);
			$busocc_query = $this->db->get();

			if($busprop_query->num_rows() > 0){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('buisness_property');
				
				$this->db->where('property_id', $property_id);
				$del2 = $this->db->delete('busprop_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('buis_prop_to_owner');

				$property_category = "business property";
				$target = 2;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}
				
			}else if($res_query->num_rows() > 0){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('residence');
				
				$this->db->where('property_id', $property_id);
				$del2 = $this->db->delete('res_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('residence_to_owner');
				
				$property_category = "residence";
				$target = 1;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}

			}else if($busocc_query->num_rows() > 0){
				$this->db->where('id', $property_id);
				$del1 = $this->db->delete('buisness_occ');
				
				$this->db->where('busocc_id', $property_id);
				$del2 = $this->db->delete('busocc_to_category');
				
				$this->db->where('property_id', $property_id);
				$del3 = $this->db->delete('buis_occ_to_owner');
				
				$property_category = "business occupant";
				$target = 3;
				if($del1 && $del2 && $del3){
					$response = "success";
				}else{
					$response = "fail";
				}
			}else{
				$response = "fail";
			}

			if($response == "success"){
				$sql = "DELETE i FROM invoice i JOIN revenue_product r ON r.id = i.product_id WHERE r.target = $target AND i.property_id = $property_id";
				$this->db->query($sql);
			}

			if($response == "success"){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Delete Record",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Deleted $property_category record with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Delete Record",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Delete for record with code: $code failed",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
			}

			$this->set_response($response, REST_Controller::HTTP_OK);

		}
	}

	// get record to be editted
	public function getRecordCategories_post()
	{

		$code = $this->post('code');
		$property_id = $this->post('propertyId');
		$flag = $this->post('flag');
		$response = "success";

		if($flag == "busprop" || $flag == "res" || $flag == "busocc"){
			$this->db->select(
				"a.id as property_id,po.id as owner_id,boo.id as cat_id,c.id as cat1,d.id as cat2,e.id as cat3,f.id as cat4,".
				"g.id as cat5,h.id as cat6,c.name as category1,".
				"d.name as category2,e.name as category3,f.name as category4,".
				"g.name as category5,h.name as category6,".
				"po.firstname,po.lastname,po.primary_contact"
			);
		}
		if($flag == "busprop"){
			$this->db->from("buisness_property as b");
			$this->db->join('buis_prop_to_owner as boo', 'b.id = boo.property_id', 'left');
			$this->db->join("busprop_to_category as a", 'b.id = a.property_id', 'left');
		}else if($flag == "res"){
			$this->db->from("residence as b");
			$this->db->join('residence_to_owner as boo', 'b.id = boo.property_id', 'left');
			$this->db->join("res_to_category as a", 'b.id = a.property_id', 'left');
		}else if($flag == "busocc"){
			$this->db->from("buisness_occ as b");
			$this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
			$this->db->join("busocc_to_category as a", 'b.id = a.busocc_id', 'left');
		}else{
			$response = "fail";
		}

		if($response == "success"){
			$this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
			
			$this->db->join('product_category1 as c', 'c.id = a.category1', 'left');
			$this->db->join('product_category2 as d', 'd.id = a.category2', 'left');
			$this->db->join('product_category3 as e', 'e.id = a.category3', 'left');
			$this->db->join('product_category4 as f', 'f.id = a.category4', 'left');
			$this->db->join('product_category5 as g', 'g.id = a.category5', 'left');
			$this->db->join('product_category6 as h', 'h.id = a.category6', 'left');
			$this->db->where("b.id", $property_id);
		}

		if($response == "success"){
			$query = $this->db->get()->result();

			if($query !== "[]"){
				$this->set_response($query, REST_Controller::HTTP_OK);
			}else{
				$this->set_response("Empty", REST_Controller::HTTP_OK);
			}
		}else{
			$this->set_response($response, REST_Controller::HTTP_OK);
		}
		

	}


	// save invoice distribution
	public function invoiceDistribution_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			
			$property_id = trim($this->post('propertyId'));
			$data['invoiceno'] = trim($this->post('invoiceno'));
			$data['invoiceid'] = trim($this->post('invoiceId'));
			if(trim($this->post('recipientCategory')) == "Others"){
				$data['recipient_name'] = ucfirst(trim($this->post('recipientName')));
				$data['recipient_phone'] = trim($this->post('recipientPhone'));
				if($this->post('recipientPosition') == "Others"){
					$data['recipient_position'] = trim($this->post('otherPosition'));
				}else{
					$data['recipient_position'] = trim($this->post('recipientPosition'));
				}
				$recipient_name = ucfirst(trim($this->post('recipientName')));
				$recipient_phone = trim($this->post('recipientPhone'));
			}else{
				if($this->post('target') == 1){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from buis_prop_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else if($this->post('target') == 2){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from buis_prop_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else if($this->post('target') == 3){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from buis_occ_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else{

				}

			}
			$data['remark'] = trim($this->post('remark'));
			$data['created_by'] = trim($this->post('id'));
			$data['creator_category'] = trim($this->post('collector'));
			
			$invoiceno = trim($this->post('invoiceno'));

			$invoice_distribution = $this->tax->add_invoice_distribution($data);
			
			if($invoice_distribution){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Invoice Distribution",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Invoice no: $invoiceno distributed to $recipient_name whose phone no is $recipient_phone",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Invoice Distribution",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Invoice no: $invoiceno distributed to $recipient_name whose phone no is $recipient_phone",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}

	}

	// get matured invoices
	public function getMaturedVisit_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$id = $this->post('id');
			$collector = $this->post('collector');
			$where = array(
				'i.created_by' => $id,
				'i.creator_category' => $collector 
			);
			$this->db->select("i.invoiceno,i.invoiceid,i.comeback_date,i.recipient_name,i.recipient_phone,i.recipient_position");
			$this->db->from('invoice_visit as i');
			$this->db->where($where);

			$query = $this->db->get()->result();

			if($query){
				$this->set_response($query, REST_Controller::HTTP_OK);
			}else{
				$this->set_response("Empty", REST_Controller::HTTP_OK);
			}
		}
	}

	// save invoice visit
	public function invoiceVisit_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{	
			if ($this->post('periodType') == "Period"){
				$comeback_date = date("Y-m-d", strtotime($this->post('period')));
			}else if ($this->post('periodType') == "Date"){
				$comeback_date = $this->post('comebackDate');
			}else{

			}

			
			$data['invoiceno'] = trim($this->post('invoiceno'));
			$data['invoiceid'] = trim($this->post('invoiceId'));
			$data['period_type'] = trim($this->post('periodType'));
			$data['comeback_date'] = $comeback_date;
			$data['created_by'] = trim($this->post('id'));
			$data['creator_category'] = trim($this->post('collector'));
			$invoiceno = trim($this->post('invoiceno'));
			$property_id = trim($this->post('propertyId'));

			if(trim($this->post('recipientCategory')) == "Others"){
				$data['recipient_name'] = ucfirst(trim($this->post('recipientName')));
				$data['recipient_phone'] = trim($this->post('recipientPhone'));
				$data['recipient_position'] = trim($this->post('recipientPosition'));
				if($this->post('recipientPosition') == "Others"){
					$data['recipient_position'] = trim($this->post('otherPosition'));
				}
				$recipient_name = ucfirst(trim($this->post('recipientName')));
				$recipient_phone = trim($this->post('recipientPhone'));
			}else{
				if($this->post('target') == 1){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from residence_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else if($this->post('target') == 2){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from buis_prop_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else if($this->post('target') == 3){
					$owner = $this->db->query("SELECT p.firstname,p.lastname,p.primary_contact from buis_occ_to_owner r left join 
					property_owner p on r.owner_id = p.id WHERE r.property_id = $property_id")->row_array();

					$data['recipient_name'] = $owner['firstname'].' '.$owner['lastname'];
					$data['recipient_phone'] = $owner['primary_contact'];
					$data['recipient_position'] = "Owner/Caretaker";
					$recipient_name = $owner['firstname'].' '.$owner['lastname'];
					$recipient_phone = $owner['primary_contact'];
					$data['recipient_position'] == "Owner/Caretaker";
				}else{

				}

			}

			$invoice_visit = $this->tax->add_invoice_visit($data);
			
			if($invoice_visit){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Invoice Visit",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Invoice no: $invoiceno was visited and $recipient_name whose phone no is $recipient_phone gave a comeback date of $comeback_date",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Invoice Visit",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Invoice no: $invoiceno was visited and $recipient_name whose phone no is $recipient_phone gave a comeback date of $comeback_date",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}

	}

	public function agentInvoices_post()
	{
		$agentId = $this->post('agentId');
		$agentCategory = $this->post('collector');

		if($agentCategory == "agent"){
			$this->db->select('zone');
			$this->db->from('agent as ag');
			$this->db->where('ag.id',$agentId);
			$zone = $this->db->get()->row_array()['zone'];

			if($zone){
				$this->db->select('*');
				$this->db->from('agent_zone as az');
				$this->db->where('az.id',$zone);
				$zone_details = $this->db->get()->row_array();
			}
		}else{
			$zone = false;
		}

		$this->db->select('i.*, a.name as area_council, t.town as town');
		$this->db->from('vw_invoice as i');
		$this->db->join("area_council as a",'a.id = i.area_council_id','left');
		$this->db->join("town as t",'t.id = i.town_id','left');
		$this->db->where('i.status',0);
		if($zone){
			$minimum_amount = (int)$zone_details['minimum_value'];
			$maximum_amount = (int)$zone_details['maximum_value'];
			$this->db->group_start();
			($zone_details['area_council']) ? $this->db->where_in('i.area_council_id', explode(',',$zone_details['area_council'])) : null;
			($zone_details['towns']) ? $this->db->or_where_in('i.town_id', explode(',',$zone_details['towns'])) : null;
			$this->db->group_end();
			($zone_details['revenue_type']) ? $this->db->where_in('i.product_id', explode(',',$zone_details['revenue_type'])) : null;
			($zone_details['minimum_operator']) ? $this->db->where("i.invoice_amount ".$zone_details['minimum_operator'].$minimum_amount) : null;
			($zone_details['maximum_operator']) ? $this->db->where("i.invoice_amount ".$zone_details['maximum_operator'].$maximum_amount) : null;
		}
		
		$this->db->limit(20);
		$query = $this->db->get()->result();

		if($query !== "[]"){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}

	}

	public function searchInvoice_post()
	{
		$item = $this->post('item');
		$search_by = $this->post('searchBy');
		$agentId = $this->post('agentId');
		$agentCategory = $this->post('collector');

		if($agentCategory == "agent"){
			$this->db->select('zone');
			$this->db->from('agent as ag');
			$this->db->where('ag.id',$agentId);
			$zone = $this->db->get()->row_array()['zone'];

			if($zone){
				$this->db->select('*');
				$this->db->from('agent_zone as az');
				$this->db->where('az.id',$zone);
				$zone_details = $this->db->get()->row_array();
			}
		}else{
			$zone = false;
		}

		$this->db->select('i.*, a.name as area_council, t.town as town');
		$this->db->from('vw_invoice as i');
		$this->db->join("area_council as a",'a.id = i.area_council_id','left');
		$this->db->join("town as t",'t.id = i.town_id','left');
		if($zone){
			$minimum_amount = (int)$zone_details['minimum_value'];
			$maximum_amount = (int)$zone_details['maximum_value'];
			$this->db->group_start();
			($zone_details['area_council']) ? $this->db->where_in('i.area_council_id', explode(',',$zone_details['area_council'])) : null;
			($zone_details['towns']) ? $this->db->or_where_in('i.town_id', explode(',',$zone_details['towns'])) : null;
			$this->db->group_end();
			($zone_details['revenue_type']) ? $this->db->where_in('i.product_id', explode(',',$zone_details['revenue_type'])) : null;
			($zone_details['minimum_operator']) ? $this->db->where("i.invoice_amount ".$zone_details['minimum_operator'].$minimum_amount) : null;
			($zone_details['maximum_operator']) ? $this->db->where("i.invoice_amount ".$zone_details['maximum_operator'].$maximum_amount) : null;
		}
		($search_by == "in") ? $this->db->where('i.invoice_no',$item) : null;
		($search_by == "po") ? $this->db->where('i.owner_phoneno', $item) : null;
		($search_by == "pc") ? $this->db->where('i.property_code', $item) : null;
		$query = $this->db->get()->result();

		if($query !== "[]"){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}
	}

// get transactions of a particular invoice
	public function getInvoiceTransactions_post(){

		$invoiceno = $this->post('invoiceno');
		$invoiceid = $this->post('invoiceid');
		$fromIO = $this->post('fromIO');

		$where = array(
			"invoice_id" => $invoiceid,
			"fromIO" => $fromIO,
			"status" => 1,
		);

		$this->db->select('t.id,t.transaction_id,t.channel,t.amount,payer_name,t.payer_phone,
		t.created_by,t.collected_by,t.datetime_created,t.payment_mode,
		concat(a.firstname," ",a.lastname) as agent_user,a.agent_code,u.username,concat(u.firstname," ",u.lastname) as admin_user');
		$this->db->from('transaction as t');
		$this->db->join('agent as a','t.created_by = a.id','left');
		$this->db->join('users as u','t.created_by = u.id','left');
		$this->db->where($where);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}
	}
        
        
// update location residence and business property
	public function updateBusOccLocation_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($$this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
						
			$propertyCode = $this->post('NewPropertyCode');
			$busOccCode = $this->post('busOccCode');      
			$id = $this->post('id');
			$collector = $this->post('collector');

			$where = array('buis_occ_code' => $busOccCode);
			$data = array(
				'buis_property_code' => $propertyCode,
			);
			$this->db->where($where);
			$update = $this->db->update('buisness_occ',$data);

			if($update){
				// insert into audit tray
				$info = array(
					'user_id' => $id,
					'activity' => "Updated a business occupant location",
					'status' => true,
					'user_category' => $collector,
					'description' => "Updated a business occupant location with code: $busOccCode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $id,
					'activity' => "Updated a residence property location",
					'status' => false,
					'user_category' => $collector,
					'description' => "Updated a residence location with code: $propertyCode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
						
		}
	}

	public function agentOnetimeInvoices_post()
	{
		$agentId = $this->post('agentId');
		$category = $this->post('collector');

		$this->db->select('id,invoice_id,phonenumber,firstname,lastname,amount,amount_paid,revenue_product_name,revenue_product_id');
	    $this->db->from('invoice_options');
		$this->db->where('collected_by',$category);
		$this->db->where('status',0);
		$this->db->where('created_by',$agentId);
		$this->db->limit(20);
	    $query = $this->db->get()->result();

		if($query !== "[]"){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Empty", REST_Controller::HTTP_OK);
		}

	}


	public function householdcheck_post()
	{
		$id = strtoupper($this->post('ownerCode'));
		$query = $this->db->query("SELECT id from household WHERE id = ?",[$id]);
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function businessOccCheck_post()
	{
		$id = strtoupper($this->post('ownerCode'));
		$query = $this->db->query("SELECT id from buisness_occ WHERE buis_occ_code = ?",[$id]);
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}

	public function buscode_post()
  {
		$id = strtoupper($this->post('busPropCode'));
		$query = $this->db->query("SELECT buis_prop_code from buisness_property WHERE buis_prop_code = '$id'");
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}

        
	public function busOccCode_post()
  {
     	$id = strtoupper($this->post('busOccCode'));
		$query = $this->db->query("SELECT buis_occ_code from buisness_occ WHERE buis_occ_code = '$id'");
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}

	public function getAreaTown_post()
	{
		$id = $this->post('areaCouncil');
		$this->db->select('id,town');
		$this->db->from('town');
		$this->db->where('area_council_id',$id);
		$query = $this->db->get()->result();
		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}

	public function getProductCat1_post()
  	{
		$id = $this->post('invoiceType');
		$this->db->select('id,name');
		$this->db->from('product_category1');
		$this->db->where('product_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("fail", REST_Controller::HTTP_OK);
		}

	}

	public function getProductCat2_post()
   {
		$id = $this->post('category1');
		$this->db->select('id,name');
		$this->db->from('product_category2');
		$this->db->where('category1_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("fail", REST_Controller::HTTP_OK);
		}
	}

	public function getProductCat3_post()
    {
		$id = $this->post('category2');
		$this->db->select('id,name');
		$this->db->from('product_category3');
		$this->db->where('category2_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("fail", REST_Controller::HTTP_OK);
		}

	}

	public function getProductCat4_post()
    {
		$id = $this->post('category3');
		$this->db->select('id,name');
		$this->db->from('product_category4');
		$this->db->where('category3_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("fail", REST_Controller::HTTP_OK);
		}

	}

	public function getProductCat5_post()
    {
		$id = $this->post('category4');
		$this->db->select('id,name');
		$this->db->from('product_category5');
		$this->db->where('category4_id',$id);
		$query = $this->db->get()->result();
		$this->set_response($query, REST_Controller::HTTP_OK);
	}

	public function getProductCat6_post()
  	{
		$id = $this->post('category5');
		$this->db->select('id,name');
		$this->db->from('product_category6');
		$this->db->where('category5_id',$id);
		$query = $this->db->get()->result();
		$this->set_response($query, REST_Controller::HTTP_OK);

	}


	public function getCat2_post()
   {

		$id = $this->post('category1');
		$this->db->select('id,name');
		$this->db->from('category_2');
		$this->db->where('category1_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function getCat3_post()
   {
		$id = $this->post('category2');
		$this->db->select('id,name');
		$this->db->from('category_3');
		$this->db->where('category2_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function getCat4_post()
  	{

		$id = $this->post('category3');
		$this->db->select('id,name');
		$this->db->from('category_4');
		$this->db->where('category3_id',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function getCat5_post()
  	{
		$id = $this->post('category4');
		$this->db->select('id,name');
		$this->db->from('category_5');
		$this->db->where('category4_id',$id);
		$query = $this->db->get()->result();
		$this->set_response($query, REST_Controller::HTTP_OK);
	}

	public function getCat6_post()
  	{

		$id = $this->post('category5');
		$this->db->select('id,name');
		$this->db->from('category_6');
		$this->db->where('category5_id',$id);
		$query = $this->db->get()->result();
		$this->set_response($query, REST_Controller::HTTP_OK);

	}

	public function getSectors_post()
  {
		$id = $this->post('propertyCategory');
		$this->db->select('id,name');
		$this->db->from('buis_sector');
		$this->db->where('prop_cat',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function getPropType_post()
  {
		$id = $this->post('busSector');
		$this->db->select('id,name');
		$this->db->from('property_type');
		$this->db->where('sector',$id);
		$query = $this->db->get()->result();

		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}


	public function propOwnerExit_post()
  {
		$primary_contact = $this->post('ownerPrimaryContact');
		$query = $this->db->query("SELECT * from property_owner WHERE primary_contact = ?",[$primary_contact]);
		$result =  json_encode($query->result_array());

		if($query->num_rows() > 0){
			$this->set_response($result, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("{}", REST_Controller::HTTP_OK);
		}
	}

	public function propOwnerExit2_post()
  {
		$primary_contact = $this->post('ownerPrimaryContact');
		$query = $this->db->query("SELECT * from property_owner WHERE primary_contact = ?",[$primary_contact]);
		  $result =  $query->result_array();
		  
		if($query->num_rows() > 0){
			$this->set_response($result, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("{}", REST_Controller::HTTP_OK);
		}
	}
		
	public function productPrice_post()
	{
		$where = array(
			'product_id' => $this->post('invoiceType'),
			'category1_id' => $this->post('category1'),
			'category2_id' => $this->post('category2'),
			'category3_id' => $this->post('category3'),
			'category4_id' => $this->post('category4'),
			'category5_id' => $this->post('category5'),
			'category6_id' => $this->post('category6'),
		);
		$compare = $this->tax->get_busocc_compare2($where);
		if($compare){
			$this->set_response($compare, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("fail", REST_Controller::HTTP_OK);
		}
	}

	public function getOwnerCode_post()
	{
		$phoneno = $this->post('phoneno');
		$propertyType = $this->post('propertyType');
		$id = owner_exit($phoneno);
		if($propertyType == "r"){
			$query = $this->db->query("SELECT res_code as code FROM residence left join residence_to_owner r on residence.id = r.property_id
			left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id WHERE r.owner_id = ?",[$id]);

			if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}

		}else if($propertyType == "p"){

			$query = $this->db->query("SELECT buis_prop_code as code FROM buisness_property b left join buis_prop_to_owner r on b.id = r.property_id
			left join town t on b.town = t.id left join area_council a on b.area_council = a.id WHERE r.owner_id = ?",[$id]);

			if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}

		}else if($propertyType == "b"){
			$query = $this->db->query("SELECT buis_occ_code as code FROM buisness_occ b left join buis_occ_to_owner  r on b.id = r.property_id
								left join buisness_property p on b.buis_property_code =  p.buis_prop_code
								left join town t on p.town = t.id left join area_council a on p.area_council = a.id WHERE r.owner_id = ?",[$id]);

			if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}

		}else{

			$array = array(
				'status_code' => '404',
				'status' => 'failed'
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);

		}

	}

	public function checkCustomerPhone_post()
	{
		$phoneno = $this->post('phoneno');
		$id = owner_exit($phoneno);
		if($id){
			$array = array(
				'status_code' => '001',
				'status' => 'success'
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}else{
			$array = array(
				'status_code' => '404',
				'status' => 'failed'
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}
	}

	public function getCustomerInvoices_post()
	{
		$phoneno = $this->post('phoneno');
		$propertyType = $this->post('propertyType');
		$id = owner_exit($phoneno);
		
		if($propertyType == "r"){
			$where = array(
				'ro.owner_id' => $id,
				'i.status' => 0,
				'r.target' => 1
			);
			$this->db->select('i.*');
			$this->db->from('invoice as i');
			$this->db->join('revenue_product as r','r.id = i.product_id');
			$this->db->join('residence_to_owner as ro','i.property_id = ro.property_id','left');
			$this->db->where($where);
			$query = $this->db->get();
			
			if($query->num_rows() == 0){
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}else if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '404',
					'status' => 'failed'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}
		}else if($propertyType == "p"){
			$where = array(
				'bo.owner_id' => $id,
				'i.status' => 0,
				'r.target' => 2
			);
			$this->db->select('i.*');
			$this->db->from('invoice as i');
			$this->db->join('revenue_product as r','r.id = i.product_id');
			$this->db->join('buis_prop_to_owner as bo','i.property_id = bo.property_id','left');
			$this->db->where($where);
			$query = $this->db->get();
			
			if($query->num_rows() == 0){
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}else if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '404',
					'status' => 'failed'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}
		}else if($propertyType == "b"){
			$where = array(
				'boo.owner_id' => $id,
				'i.status' => 0,
				'r.target' => 3
			);
			$this->db->select('i.*');
			$this->db->from('invoice as i');
			$this->db->join('revenue_product as r','r.id = i.product_id');
			$this->db->join('buis_occ_to_owner as boo','i.property_id = boo.property_id','left');
			$this->db->where($where);
			$query = $this->db->get();
			
			if($query->num_rows() == 0){
				$array = array(
					'status_code' => '400',
					'status' => 'nothing found'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}else if($query->num_rows() > 0){
				$this->set_response(json_encode($query->result()), REST_Controller::HTTP_OK);
			}else{
				$array = array(
					'status_code' => '404',
					'status' => 'failed'
				);
				$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
			}
		}else{
			$array = array(
				'status_code' => '404',
				'status' => 'failed'
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}

	}

	public function saveBusOccAnnex_post()
	{
		
		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			
			$busOccCode = $this->post('busOccCode');
			$id = $this->db->query("SELECT id from buisness_occ WHERE buis_occ_code = ?",[$busOccCode])->row()->id;
			$data['busocc_id'] = $id;
			$data['category1'] = $this->post('category1');
			$data['category2'] = $this->post('category2');
			$data['category3'] = $this->post('category3');
			$data['category4'] = $this->post('category4');
			$data['category5'] = $this->post('category5');
			$data['category6'] = $this->post('category6');
			$data['agent_id'] = $this->post('agentId');
			$data['agent_category'] = $this->post('collector');

			$insert = $this->db->insert('busocc_to_category',$data);

			if($insert){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a business occupant category record",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added a business occupant category record to business occupant with code: $busOccCode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a business occupant category record",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a business occupant category record to business occupant with code: $busOccCode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
		}

	}

	public function saveSusuTransaction_post()
	{

		$datetime = date("Y-m-d H:i:s");
		$transaction_id = random_string('numeric',10);
		$amount = number_format((float)$this->post('amount'), 2, '.', '');
		$primary_contact = $this->post('phoneno');
		$accountno = $this->post('accountno');
		$data['accountno'] = $this->post('accountno');
		$data['phoneno'] = $this->post('phoneno');
		$data['amount'] = $this->post('amount');
		$data['mode_of_payment'] = $this->post('modePayment');
		$data['agent_id'] = $this->post('id');
		$data['status'] = 1;
		$data['approval'] = "p";
		$data['collected_by'] = $this->post('collector');
		$data['channel'] = "Mobile App";
		$data['savings'] = number_format((float)$this->post('savings'), 2, '.', '');
		$data['shares'] = number_format((float)$this->post('shares'), 2, '.', '');
		$data['loan'] = number_format((float)$this->post('loan'), 2, '.', '');
		$data['loan_interest'] = number_format((float)$this->post('interest'), 2, '.', '');
		$data['transaction_id'] = $transaction_id;
		$data['transaction_date'] = $datetime;

		$account_amount = $this->db->query("SELECT sum(amount) as total_con from susu_transaction WHERE accountno = ?",[$accountno])->row()->total_con;
		$total_amount = $account_amount + $amount;
		$total_contribution =  number_format((float)$total_amount, 2, '.', '');
		$insert = $this->db->insert('susu_transaction',$data);


		if($insert){
			$sms_message = "Credit Alert \nGHS $amount has been credited to your account $accountno on $datetime.\nTransaction ID: $transaction_id\nAvail Bal. : $total_contribution";
			$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
			@send_sms($phone_formatted, $sms_message);
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function saveTollTransaction_post()
	{

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collectedBy') == "agent" && get_agent_status($this->post('createdBy')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collectedBy') == "admin" && get_user_status($this->post('createdBy')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{

			$transaction_id = random_string('numeric',10);
			$amount = number_format((float)$this->post('amount'), 2, '.', '');
			$data['amount'] = $amount;
			$data['category'] = $this->post('category');
			$data['channel'] = $this->post('channel');
			$data['created_by'] = $this->post('createdBy');
			$data['phoneno'] = $this->post('phoneno');
			$data['serialno'] = $this->post('serialno');
			$data['collected_by'] = $this->post('collectedBy');
			$data['toll_type'] = $this->post('tollType');
			$data['transaction_id'] = $transaction_id;

			$insert = $this->db->insert('toll_transaction',$data);

			if($insert){
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
		}
	}

	public function saveInvoice_post()
	{

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$today =  date('Y-m-d');
			$due_date = strtotime("+21 days", strtotime($today));
			if($this->post('invoiceFor') == '2'){
				$company = $this->post('companyName');
			}else{
				$company = "";
			}
			$data = array(
				'status' => 'Pending',
				'ownership_type' => $this->post('category'),
				'phonenumber' => $this->post('primaryContact'),
				'firstname' => $this->post('firstname'),
				'lastname' => $this->post('lastname'),
				'company_name' => $company,
				'area_council' => $this->post('areaCouncil'),
				'town' => $this->post('town'),
				'revenue_product_id' => $this->post('invoiceType'),
				'revenue_product_name' => $this->post('invoiceTypeName'),
				'category1' => $this->post('category1'),
				'category2' => $this->post('category2'),
				'category3' => $this->post('category3'),
				'category4' => $this->post('category4'),
				'category5' => $this->post('category5'),
				'category6' => $this->post('category6'),
				'amount' => $this->post('amount'),
				'product_category6_id' => $this->post('category6s'),
				'due_date' => $due_date,
				'created_by' => $this->post('id'),
				'collected_by' => $this->post('collector'),
			);
			$id = $this->tax->save_onetime_invoice($data);
			$number = str_pad($id, 5, '0', STR_PAD_LEFT);
			$product_code = $this->tax->get_part_product($this->post('invoiceType'));
			$code = $product_code['code'];
			$invid = "INV".$code.date('Y')."-".$number;
			$phone = $this->post('primaryContact');
			$amount = $this->post('amount');
			$this->tax->update_invoice_id($product_code['code'], $id);

			if($id > 0){

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Saved a onetime invoice.",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Created a onetime invoice with invoice id: $invid",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$echannelid = 6;
				$echannel = $this->Channelmodel->channelstatus($echannelid);
				if($echannel != 0){
					$sms_message = "You have been created successfully on the ". SYSTEM_ID ." Revenue Platform You are required to pay an amount of GHS $amount. Your reference Code for payment is $invid.\nThank you";
					$phone_formatted = ((strlen($phone) > 10) && substr($phone, 0, 3) == '233') ? $phone : '233' . substr($phone, 1, strlen($phone));
					$sms_rs = @send_sms($phone_formatted, $sms_message);
				}else{

				}
				
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Saved a onetime invoice.",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Created a onetime invoice with invoice id: $invid",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}
	}

	public function saveHousehold_post()
	{
		
		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$primary_contact = $this->post('primaryContact');
			$rescode = strtoupper(trim($this->post('resPropCode')));
			$firstname = ucfirst(trim($this->post('firstname')));
			$lastname = ucfirst(trim($this->post('lastname')));
			$com_needs = $this->post('needs');
			$data['firstname'] = ucfirst(trim($this->post('firstname')));
			$data['lastname'] = ucfirst(trim($this->post('lastname')));
			$data['dob'] = trim($this->post('dob'));
			$data['place_of_birth'] = trim($this->post('pob'));
			$data['gender'] = trim($this->post('gender'));
			$data['primary_contact'] = trim($this->post('primaryContact'));
			$data['secondary_contact'] = trim($this->post('secondaryContact'));
			$data['head_of_household'] = trim($this->post('household'));
			$data['email'] = trim($this->post('email'));
			$data['nationality'] = trim($this->post('nationality'));
			$data['tin']= trim($this->post('tin'));
			$data['disability']= $this->post('disability');
			$data['res_prop_code'] = strtoupper(trim($this->post('resPropCode')));
			$data['religion']= $this->post('religion');
			$data['highest_edu'] = $this->post('highestEdu');
			$data['profession'] = $this->post('profession');
			$data['employment_status'] = $this->post('employmentStatus');
			$data['date_of_last_emp']= trim($this->post('doe'));
			$data['marital_status'] = $this->post('maritalStatus');
			$data['hometown'] = trim($this->post('hometown'));
			$data['home_district']= trim($this->post('hometownDistrict'));
			$data['region']= $this->post('region');
			$data['ethnicity']= trim($this->post('ethnicity'));
			$data['native_lan']= trim($this->post('nativeLan'));
			$data['type_of_relationship']= trim($this->post('typeOfRelationship'));
			$data['father_firstname']= ucfirst(trim($this->post('fFirstname')));
			$data['father_lastname']= ucfirst(trim($this->post('fLastname')));
			$data['father_clan']= $this->post('fclan');
			$data['mother_firstname']= ucfirst(trim($this->post('mFirstname')));
			$data['mother_lastname']= ucfirst(trim($this->post('mLastname')));
			$data['mother_clan']= $this->post('mclan');
			$data['no_of_kids']= trim($this->post('nokids'));
			$data['specify_disability']= trim($this->post('disabilities'));
			$data["agent_id"] = $this->post('agentId');
			$data["agent_category"] = $this->post('collector');
			if($this->post('religion') === "Others"){
				$data['other_religion'] = trim($this->post('religionName'));
			}
			if($this->post('profession') == "38"){
				$data['other_profession'] = trim($this->post('profOthersSpecify'));
			}
			if($this->post('nokids') == 1){
				$data['firstborn_dob'] = trim($this->post('fob'));
			}elseif($this->post('nokids') > 1){
				$data['firstborn_dob'] = trim($this->post('fob'));
				$data['lastborn_dob'] = trim($this->post('lob'));
			}else{

			}
			if($this->post('nationality') == 'Ghanaian'){
				$data['id_type'] = $this->post('idType');
				$data['id_number'] = trim($this->post('idNumber'));
			}else{
				$data['country'] = trim($this->post('country'));
				$data['nat_id_no'] = trim($this->post('natIdNo'));
			}
			if($this->post('employmentStatus') == "Employed"){
				$data['employer_name'] = trim($this->post('employerName'));
				$data['current_occupation'] = trim($this->post('currentOccupation'));
			}elseif($this->post('employmentStatus') == "Self-Employed"){
				$data['buisness_name'] = trim($this->post('businessName'));
				$data['type_of_buisness'] = trim($this->post('typeBusiness'));
			}else{

			}

			$household = $this->res->add_household($data);
			foreach ($com_needs as $key => $value) {
				$data1 = array('household_id' => $household ,'need_id' => $this->post('needs')[$key]);
				$this->res->add_com_needs($data1);
			}
			if($household){

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a household",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added $firstname $lastname to residence with no: $rescode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$houseno = get_res_houseno($rescode);
				if($this->post('meansTransport') == "0"){
					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						$sms_message = "You have been registered successfully on the ". SYSTEM_ID ." Platform.\nYour House No is $houseno\nThank You";
						$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
						@send_sms($phone_formatted, $sms_message);
					}else{

					}
					$this->set_response("success", REST_Controller::HTTP_OK);
				}else{
					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						$tcode = "T".str_pad($household, 3, '0', STR_PAD_LEFT);
						$sms_message = "You have been registered successfully on the ". SYSTEM_ID ." Platform.\nYour House No is $houseno\nYour Transport Code is $tcode\nThank You";
						$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
						@send_sms($phone_formatted, $sms_message);
					}else{

					}
					$this->set_response("success", REST_Controller::HTTP_OK);
				}
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a household",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added $firstname $lastname to residence with no: $rescode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
		}   
	}

// validtae no registration code
	public function validateNoRegistrationCode_post()
  	{
		$id = $this->post('noRegistrationCode');
		$query = $this->db->query("SELECT no_registration_code from no_registration WHERE no_registration_code = '$id'");
		if($query->num_rows() > 0){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}
	}


// save business occupant
	public function saveBusinessOcc_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$bus_sector = get_category1_code($this->post('category1'));
			$get_townid = get_townid(trim($this->post('busPropCode')));
			$towncode = get_towncode($get_townid);
	
			$primary_contact = $this->post('busPrimaryContact');
			$code = $this->bus->busnumber2($get_townid,$this->post('category1'));
			$gen_rescode = SYSTEM_PREFIX.$towncode.$bus_sector. str_pad($code, 4, '0', STR_PAD_LEFT);
			$owner_exit = owner_exit(trim($this->post('ownerPrimaryContact')));
			$data['buis_name'] = trim($this->post('busName'));
			$data['buis_primary_phone'] = trim($this->post('busPrimaryContact'));
			$data['buis_secondary_phone'] = trim($this->post('busSecondaryContact'));
			$data['buis_website'] = trim($this->post('busWebsite'));
			$data['buis_occ_code'] = $gen_rescode;
			$data['old_bus_code'] = trim($this->post('oldBusCode'));
			$data['buis_email'] = trim($this->post('busEmail'));
			$data['buis_property_code'] = strtoupper(trim($this->post('busPropCode')));
			$data['class'] = trim($this->post('propertyClass'));
			$data['year_of_est'] = trim($this->post('yearEst'));
			$data['buis_reg_cert_no'] = trim($this->post('businessRegCertNo'));
			$data['no_of_employees'] = trim($this->post('noEmployees'));
			$data['no_of_rooms'] = trim($this->post('noRooms'));
			$data['subupn_number'] = trim($this->post('subupnNumber'));
			$data['nature_of_buisness'] = $this->post('businessOperation');
			$data['ownership']= $this->post('ownership');
			$data["agent_id"] = $this->post('agentId');
			$data["agent_category"] = $this->post('collector');
			$category['category1'] = trim($this->post('category1'));
			$category['category2'] = trim($this->post('category2'));
			$category['category3'] = trim($this->post('category3'));
			$category['category4'] = trim($this->post('category4'));
			$category['category5'] = trim($this->post('category5'));
			$category['category6'] = trim($this->post('category6'));
			$data['accessed'] = trim($this->post('accessed'));
			$rateable_amount = trim($this->post('rateableAmount'));
			$rate = trim($this->post('rate'));
			$owner['person_category'] = trim($this->post('category'));
			$owner['firstname'] = ucfirst(trim($this->post('ownerFirstname')));
			$owner['lastname'] = ucfirst(trim($this->post('ownerLastname')));
			$owner['primary_contact'] = trim($this->post('ownerPrimaryContact'));
			$owner['secondary_contact'] = trim($this->post('ownerSecondaryContact'));
			// $owner['owner_native'] = trim($this->post('native'));
			$owner['email'] = trim($this->post('ownerEmail'));
			$owner['postal_address'] = trim($this->post('ownerPostalAddress'));
			$owner['gender'] = trim($this->post('ownerGender'));
			$owner['owner_pwd'] = trim($this->post('ownerPWD'));
			$owner['ghpostgps_code'] = trim($this->post('ownerGhpostgps'));
			// $owner['religion'] = trim($this->post('religion'));
			$data['code'] = $code;
			$data['type_of_building'] = $this->post('businessBuilding');
			if($this->post('businessBuilding') === 'Temporary'){
				$data['detail_for_temp']  = trim($this->post('buildingType'));
			}
			// if($this->post('religion') === "Others"){
			// 	$owner['other_religion'] = $this->post('religionName');
			// }
			if($owner_exit){
				$owner_id = $owner_exit;
			}else{
				$owner_id = $this->bus->add_owner($owner);
			}
	
			$data['owner_id'] = $owner_id;

			if($owner_id){
				$bus_id = $this->bus->add_business_occ($data);
				$bus_to_owner = $this->bus->add_busocc_to_owner($bus_id,$owner_id);
				if($this->post('accessed') == 1){
					$data  = array(
						'product_id' => "1",
						'property_id' => $bus_id,
						'target' => "3",
						'rateable_value' => $rateable_amount,
						'rate' => $rate,
						'invoice_amount' => $rateable_amount * $rate
					);
					$accessed = $this->tax->insert_accessed_record($data);		
				}else{
					
				}
				$category['busocc_id'] = $bus_id;
				$category_insert = $this->db->insert('busocc_to_category',$category);
				if($bus_id){
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a business occupant",
						'status' => true,
						'user_category' => $this->post('collector'),
						'description' => "Added a business occupant with code: $gen_rescode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						$sms_message = "Your Business has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Business Identity Code is $gen_rescode.\nThank You";
						$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
						@send_sms($phone_formatted, $sms_message);
					}else{

					}

					$return = array(
						'message' => "success",
						'code' => $gen_rescode
					);
					$this->set_response($return, REST_Controller::HTTP_OK);
				}else{
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a business occupant",
						'status' => false,
						'user_category' => $this->post('collector'),
						'description' => "Added a business occupant with code: $gen_rescode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert

					$return = array(
						'message' => "failed",
						'code' => $gen_rescode
					);
		
					$this->set_response($return, REST_Controller::HTTP_OK);
				}
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a business occupant",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a business occupant with code: $gen_rescode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$return = array(
					'message' => "failed",
					'code' => $gen_rescode
				);
	
				$this->set_response($return, REST_Controller::HTTP_OK);
			}
			
		}
	}


	//	add new residence
	public function saveResidenceOld_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$areacode = get_areacode($this->post('areaCouncil'));
			$towncode = get_towncode($this->post('town'));
	
			$areacode = get_areacode($this->post('areaCouncil'));
			$towncode = get_towncode($this->post('town'));
			$owner_exit = owner_exit(trim($this->post('ownerPrimaryContact')));
			$code = $this->res->resnumber($this->post('areaCouncil'),$this->post('town'));
			$primary_contact = trim($this->post('ownerPrimaryContact'));
			$gen_rescode = SYSTEM_PREFIX.$areacode .$towncode.SYSTEM_RESIDENTIAL_PROPERTY_PER_PREFIX. str_pad($code, 4, '0', STR_PAD_LEFT);
			$houseno = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$owner['firstname'] = ucfirst(trim($this->post('ownerFirstname')));
			$owner['lastname'] = ucfirst(trim($this->post('ownerLastname')));
			$owner['primary_contact'] = trim($this->post('ownerPrimaryContact'));
			$owner['secondary_contact'] = trim($this->post('ownerSecondaryContact'));
			$owner['owner_native'] = trim($this->post('native'));
			$owner['religion'] = trim($this->post('religion'));
			$owner['email'] = trim($this->post('ownerEmail'));
			$owner['postal_address'] = trim($this->post('ownerPostalAddress'));
			$data['year_of_construction'] = trim($this->post('yearConstruction'));
			$data['res_code'] = $gen_rescode;
			$data['town'] = trim($this->post('town'));
			$data['area_council'] = trim($this->post('areaCouncil'));
			$data['sectorial_code'] = trim($this->post('sectorialcode'));
			$data['streetname'] = trim($this->post('streetname'));
			$data['landmark'] = trim($this->post('landmark'));
			$data['locality_code'] = $towncode;
			$data['street_code'] = trim($this->post('streetCode'));
			$data['new_property_no'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$data['old_property_no'] = trim($this->post('oldPropertyNo'));
			$data['zone_code'] = $areacode;
			$data['gps_lat']= $this->post('gpsLat');
			$data['gps_long']= $this->post('gpsLong');
			$data['houseno'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$data['location'] = trim($this->post('location'));
			$data['ghpost_gps'] = trim($this->post('ghpostgps'));
			$data['property_type'] = trim($this->post('propertyType'));
			$data['grade_type'] = trim($this->post('gradeType'));
			$data['no_of_rooms'] = trim($this->post('category6'));
			$data['building_type'] = $this->post('buildingType');
			$data['temporary_building']= $this->post('temporaryDetail');
			$data['building_permit'] = trim($this->post('selected2'));
			$data['planning_permit'] = trim($this->post('planningPermit'));
			$data['construction_material'] = trim($this->post('consMaterial'));
			$data['roofing_type'] = trim($this->post('roofType'));
			$data['toilet_facility'] = $this->post('toilet');
			$data['avai_of_water'] = $this->post('water');
			$data['avai_of_refuse']= $this->post('refuse');
			$data['noOfResidents'] = trim($this->post('noOfResidents'));
			$data['resident_greater_18'] = trim($this->post('noOfResidentsGreater18'));
			$data['assessable_status'] = trim($this->post('assessableStatus'));
			$data['property_image'] = trim($this->post('photo'));
			$data['building_status'] = trim($this->post('buildingStatus'));
			$data['code'] = $code;
			$data["agent_id"] = $this->post('agentId');
			$data["agent_category"] = $this->post('collector');
			$data['accessed'] = trim($this->post('accessed'));
			$data['upn_number'] = trim($this->post('upnNumber'));
			$rateable_amount = trim($this->post('rateableAmount'));
			$rate = trim($this->post('rate'));
			if(trim($this->post('buildingStatus')) == "0"){
				$data['inhabitant_status'] = $this->post('inhabitedStatus');
			}
			if($this->post('religion') === "Others"){
				$owner['other_religion'] = $this->post('religionName');
			}
			if($this->post('propertyType') !== 'Compound'){
				$data['no_of_floors'] = trim($this->post('noFloors'));
			}
			if($this->post('selected2') == 'Yes'){
				$data['building_cert_no'] = trim($this->post('buildingPermitNo'));
			}
			if($this->post('planningPermit') == 'Yes'){
				$data['planning_permit_no'] = trim($this->post('planningPermitNo'));
			}
			if($this->post('toilet') == 'Yes'){
				$data['t_facility_yes'] = $this->post('toiletYes');
				$data['no_of_toilet_facility'] = $this->post('noOfToiletFacility');
			}else{
				$data['t_facility_no'] = trim($this->post('toiletNo'));
			}
			if($this->post('water') == 'No'){
				$data['source_water_no'] = trim($this->post('waterNo'));
			}else{
				$data['source_water_yes'] = trim($this->post('waterYes'));
			}
			if($this->post('refuse') == 'Yes'){
				$data['dumping_site_yes'] = trim($this->post('refuseYes'));
			}else{
				$data['dumping_site_no'] = trim($this->post('refuseNo'));
			}
	
			if($owner_exit){
				$owner_id = $owner_exit;
			}else{
				$owner_id = $this->res->add_owner($owner);
			}

			if ($owner_id){
				$res_id = $this->res->add_residence($data);

				if($this->post('accessed') == 1){
					$datas  = array(
						'product_id' => "13",
						'property_id' => $res_id,
						'target' => "1",
						'rateable_value' => $rateable_amount,
						'rate' => $rate,
						'invoice_amount' => $rateable_amount * $rate,
						'valuation_number' => trim($this->post('valuationNumber'))
					);
					$accessed = $this->tax->insert_accessed_record($datas);
				}else{
					
				}

				$category['category1'] = trim($this->post('category1'));
				$category['category2'] = trim($this->post('category2'));
				$category['category3'] = trim($this->post('category3'));
				$category['category4'] = trim($this->post('category4'));
				$category['category5'] = trim($this->post('category5'));
				$category['category6'] = trim($this->post('category6'));
				$category['property_id'] = $res_id;
				$category_insert = $this->db->insert('res_to_category',$category);
		
				$res_to_owner = $this->res->add_res_to_owner($res_id,$owner_id);
		
				if($res_to_owner){
		
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a residence property",
						'status' => true,
						'user_category' => $this->post('collector'),
						'description' => "Added a residence property with code: $gen_rescode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					
					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						$sms_message = "Your Residence Property has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Residence Property Code is $gen_rescode\nThank You";
						$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
						@send_sms($phone_formatted, $sms_message);
					}else{

					}
					$this->set_response("success", REST_Controller::HTTP_OK);
				}
				else{
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a residence property",
						'status' => false,
						'user_category' => $this->post('collector'),
						'description' => "Added a residence property with code: $gen_rescode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
		
					$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
				}
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a residence property",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a residence property with code: $gen_rescode",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
	
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
			
		}
	}

	public function getTransportSubCat_post(){

		$id = strtoupper($this->post('transportSubCat'));
		$this->db->select('id,subcategory');
		$this->db->from('transport_subcategory');
		$this->db->where('category',$id);
		$query = $this->db->get()->result();
		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
		}

	}

	public function checkUssdChannel_post(){
    if(get_channel_status(2) == 0){
			$array = array(
				"status" => "stop"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}else{
			$array = array(
				"status" => "active"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}
	}

	public function checkAgentCode_post(){
		$agent_code = $this->post('agent_code');
    	$this->db->select('id,account_status,password');
		$this->db->from('agent');
		$this->db->where('agent_code',$agent_code);
		$result = $this->db->get();
		$numrows = $result->num_rows();
		$query = $result->row_array();

		if($numrows == 0){
			$array = array(
				"status" => "not found"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}else if($numrows > 0){
			if($query['account_status']){
				$status = "active";
			}else{
				$status = "inactive";
			}
			$data = array(
				'id' => $query['id'],
				'status' => $status,
				'password' => $this->encryption->decrypt($query['password'])
			);
			$this->set_response(json_encode($data), REST_Controller::HTTP_OK);
		}else{
			$array = array(
				"status" => "fail"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}
		 
	}

	public function ussdGetInvoiceDetails_post(){
		$invoice_no = $this->post('invoice_no');
    	$this->db->select('*');
		$this->db->from('invoice');
		$this->db->where('invoice_no',$invoice_no);
		$result = $this->db->get();
		$numrows = $result->num_rows();
		$query = $result->row_array();

		if($numrows == 0){
			$array = array(
				"status" => "not found"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}else if($numrows > 0){
			$this->set_response(json_encode($query), REST_Controller::HTTP_OK);
		}else{
			$array = array(
				"status" => "fail"
			);
			$this->set_response(json_encode($array), REST_Controller::HTTP_OK);
		}
		 
	}

	public function saveBusiness_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$areacode = get_areacode($this->post('areaCouncil'));
			$towncode = get_towncode($this->post('town'));
			$owner_exit = owner_exit($this->post('ownerPrimaryContact'));
			$category = $this->post('invoiceType');
			$com_needs = $this->post('needs');
			
			$code = $this->bus->resnumber_new($this->post('areaCouncil'),$this->post('town'),$category);
			$primary_contact = trim($this->post('ownerPrimaryContact'));
			

			if($this->post('invoiceType') == 12){
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

			// if($this->post('manualLatLong') != ""){
			// 	$manLatLong = explode(",",$this->post('manualLatLong'));
			// }
			
			$houseno = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$owner['person_category'] = trim($this->post('category'));
			$owner['firstname'] = ucfirst(trim($this->post('ownerFirstname')));
			$owner['lastname'] = ucfirst(trim($this->post('ownerLastname')));
			$owner['primary_contact'] = trim($this->post('ownerPrimaryContact'));
			$owner['secondary_contact'] = trim($this->post('ownerSecondaryContact'));
			$owner['gender'] = trim($this->post('ownerGender'));
			$owner['owner_pwd'] = trim($this->post('ownerPWD'));
			// $owner['owner_native'] = trim($this->post('native'));
			// $owner['religion'] = trim($this->post('religion'));
			$owner['email'] = trim($this->post('ownerEmail'));
			$owner['postal_address'] = trim($this->post('ownerPostalAddress'));
			$owner['ghpostgps_code'] = trim($this->post('ownerGhpostgps'));
			$data['year_of_construction'] = trim($this->post('yearConstruction'));
			$data['buis_prop_code'] = $gen_rescode;
			$data['town'] = trim($this->post('town'));
			$data['area_council'] = trim($this->post('areaCouncil'));
			$data['gps_lat']= $this->post('gpsLat');
			$data['gps_long']= $this->post('gpsLong');
			$data['streetname'] = trim($this->post('streetname'));
			$data['landmark'] = trim($this->post('landmark'));
			$data['locality_code'] = $towncode;
			$data['sectorial_code'] = trim($this->post('sectorialcode'));
			$data['street_code'] = trim($this->post('streetCode'));
			$data['new_property_no'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$data['old_property_no'] = trim($this->post('oldPropertyNo'));
			$data['buis_sector'] = trim($this->post('businessSector'));
			$data['property_category'] = trim($this->post('propertyCategory'));
			$data['property_typee'] = trim($this->post('propertyTypee'));
			$data['zone_code'] = $areacode;
			$data['houseno'] = $towncode.str_pad($code, 4, '0', STR_PAD_LEFT);
			$data['location'] = trim($this->post('location'));
			$data['ghpost_gps'] = trim($this->post('ghpostgps'));
			$data['property_type'] = trim($this->post('propertyType'));
			$data['grade_type'] = trim($this->post('gradeType'));
			$data['no_of_residents'] = trim($this->post('noOfResidents'));
			$data['resident_greater_18'] = trim($this->post('noOfResidentsGreater18'));
			$data['category'] = trim($this->post('invoiceType'));
			$data['no_of_rooms'] = trim($this->post('noRooms'));
			$data['building_permit'] = trim($this->post('selected2'));
			$data['planning_permit'] = trim($this->post('planningPermit'));
			$data['construction_material'] = trim($this->post('consMaterial'));
			$data['roofing_type'] = trim($this->post('roofType'));
			$data['toilet_facility'] = $this->post('toilet');
			$data['avai_of_water'] = $this->post('water');
			$data['avai_of_refuse']= $this->post('refuse');
			$data['avail_of_electricity']= $this->post('availOfElectricity');
			$data['avail_of_telcom_network']= $this->post('availOfTelecom');
			$data['noOfOccupants'] = trim($this->post('noOfOccupants'));
			$data['upn_number'] = trim($this->post('upnNumber'));
			$data['code'] = $code;
			$data["agent_id"] = $this->post('agentId');
			$data["agent_category"] = $this->post('collector');
			$data['building_type'] = $this->post('buildingType');
			$data['temporary_building']= $this->post('temporaryDetail');
			$data['building_status'] = trim($this->post('buildingStatus'));
			$data['no_of_pwd'] = trim($this->post('noPWD'));
			$data['accessed'] = trim($this->post('accessed'));
			$data['assessable_status'] = trim($this->post('assessableStatus'));
			$data['property_image'] = trim($this->post('photo'));
			$rateable_amount = trim($this->post('rateableAmount'));
			$rate = trim($this->post('rate'));
			if(trim($this->post('buildingStatus')) == "0"){
				$data['inhabitant_status'] = $this->post('inhabitedStatus');
			}
			// if($this->post('religion') === "Others"){
			// 	$owner['other_religion'] = $this->post('religionName');
			// }
			if($this->post('propertyType') !== 'Compound'){
				$data['no_of_floors'] = trim($this->post('noFloors'));
			}
			if($this->post('selected2') == 'Yes'){
				$data['building_cert_no'] = trim($this->post('buildingPermitNo'));
			}
			if($this->post('planningPermit') == 'Yes'){
				$data['planning_permit_no'] = trim($this->post('planningPermitNo'));
			}
			if($this->post('toilet') == 'Yes'){
				$data['t_facility_yes'] = $this->post('toiletYes');
				$data['no_of_toilet_facility'] = $this->post('noOfToiletFacility');
			}else{
				$data['t_facility_no'] = trim($this->post('toiletNo'));
			}
			if($this->post('water') == 'No'){
				$data['source_water_no'] = trim($this->post('waterNo'));
			}else{
				$data['source_water_yes'] = trim($this->post('waterYes'));
			}
			if($this->post('refuse') == 'Yes'){
				$data['dumping_site_yes'] = trim($this->post('refuseYes'));
			}else{
				$data['dumping_site_no'] = trim($this->post('refuseNo'));
			}
			if($this->post('availOfTelecom') == 'Yes'){
				$data['avail_of_telcom_network_yes'] = trim($this->post('telecomNetwork'));
			}else{
				$data['avail_of_telcom_network_yes'] = "";
			}
	
			if($owner_exit){
				$owner_id = $owner_exit;
			}else{
				$owner_id = $this->bus->add_owner($owner);
			}


			if($owner_id){
				$res_id = $this->bus->add_business($data);

				foreach ($com_needs as $key => $value) {
					$community_needs = array('property_id' => $res_id ,'need_id' => $this->post("needs")[$key]);
					$this->bus->add_community_needs($community_needs);
				}

				if($this->post('accessed') == 1){
					$data  = array(
						'product_id' => $category,
						'property_id' => $res_id,
						'target' => ($category == 12)?2:1,
						'rateable_value' => $rateable_amount,
						'rate' => $rate,
						'invoice_amount' => $rateable_amount * $rate,
						'valuation_number' => trim($this->post('valuationNumber'))
					);
					$accessed = $this->tax->insert_accessed_record($data);
				}else{
					
				}
	
				$bus_category['category1'] = trim($this->post('category1'));
				$bus_category['category2'] = trim($this->post('category2'));
				$bus_category['category3'] = trim($this->post('category3'));
				$bus_category['category4'] = trim($this->post('category4'));
				$bus_category['category5'] = trim($this->post('category5'));
				$bus_category['category6'] = trim($this->post('category6'));
				$bus_category['property_id'] = $res_id;
				$category_insert = $this->db->insert('busprop_to_category',$bus_category);
	
				$bus_to_owner = $this->bus->add_bus_to_owner($res_id,$owner_id);
		
				if($bus_to_owner){
		
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a $cat property",
						'status' => true,
						'user_category' => $this->post('collector'),
						'description' => "Added a $cat property with code: $gen_rescode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						$sms_message = "Your $cat Property has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour $cat Property Code is $gen_rescode\nThank You";
						$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
						@send_sms($phone_formatted, $sms_message);
					}else{

					}
					
					$this->set_response("success", REST_Controller::HTTP_OK);
				}
				else{
		
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Added a $cat property",
						'status' => false,
						'user_category' => $this->post('collector'),
						'description' => "Added a $cat property with code: $gen_rescode",
						'channel' => "Mobile App",
					);
		
					$audit_tray = audit_tray($info);
					//end of insert
		
					$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
				}
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added a $cat property",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a $cat property with code: $gen_rescode",
					'channel' => "Mobile App",
				);
	
				$audit_tray = audit_tray($info);
				//end of insert
	
				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
			
			
		}
	}

		// save Transport
		public function saveTransport_post(){

			if(get_channel_status(5) == 0){
				$this->set_response("stop", REST_Controller::HTTP_OK);
			}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
				$this->set_response("block", REST_Controller::HTTP_OK);
			}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
				$this->set_response("block", REST_Controller::HTTP_OK);
			}else{
				$ownershipcat = $this->post('ownershipCat');
				$code = trim($this->post('ownerCode'));
				$data['owner_code'] = trim($this->post('ownerCode'));
				$data['meduim'] = trim($this->post('medium'));
				$data['mode_operation'] = trim($this->post('modeOperation'));
				$data['fuel_type'] = $this->post('fuelType');
				$data['size_dimension'] = $this->post('sizeDimension');
				$data['make'] = $this->post('make');
				$data['model'] = $this->post('model');
				$data['year_of_manufacture'] = $this->post('yearManufacture');
				$data['engine_capacity'] = trim($this->post('engineCapacity'));
				$data['no_outboard_motors'] = trim($this->post('noOutboardMotors'));
				$data['registration_no'] = trim($this->post('registrationNo'));
				$data['purpose'] = trim($this->post('purpose'));
				$data['manager'] = $this->post('manager');
				$data["agent_id"] = $this->post('agentId');
				$data["agent_category"] = $this->post('collector');
				$data['personnal_category'] = trim($this->post('personnalCat'));
				if($this->post('purpose') == "Commercial"){
					$data['transport_category'] = trim($this->post('transportCat'));
					$data['transport_subcategory'] = trim($this->post('transportSubCat'));
				}else{
	
				}
				if($this->post('personnalCat') == "Owner"){
					if($this->post('manager') == "No"){
						$data['caretaker_contact']= $this->post('caretakerContact');
						$data['caretaker_firstname'] = ucfirst(trim($this->post('caretakerFirstname')));
						$data['caretaker_lastname'] = ucfirst(trim($this->post('caretakerLastname')));
						$data['area_council'] = trim($this->post('areaCouncil'));
						$data['town'] = trim($this->post('town'));
					}else{
	
					}
				}else{
					$data['owner_contact'] = $this->post('ownerContact');
					$data['owner_firstname']= $this->post('ownerFirstname');
					$data['owner_lastname'] = ucfirst(trim($this->post('ownerLastname')));
					$data["ownerReside_district"] = $this->post('ownerReside');
					if($this->post('ownerReside') == "Yes"){
						$data['owner_areacouncil'] = ucfirst(trim($this->post('ownerAreaCouncil')));
						$data['owner_town'] = trim($this->post('ownertown'));
					}else{
						$data['owner_location'] = trim($this->post('ownerLocation'));
						$data["owner_district"] = $this->post('ownerDistrict');
						$data['owner_region'] = trim($this->post('ownerRegion'));
					}
				}
				if($this->post('medium') === 'others'){
					$data['specify_meduim'] = trim($this->post('specifyMeduim'));
				}
				if($ownershipcat == "Business Occupant"){
					$insert = $this->db->insert('businessocc_transport',$data);
					$save = $this->db->insert_id();
					if($save){
						// insert into audit tray
						$info = array(
							'user_id' => $this->post('agentId'),
							'activity' => "Added a business transport",
							'status' => true,
							'user_category' => $this->post('collector'),
							'description' => "Added a business transport with code: $code",
							'channel' => "Mobile App",
						);
						$audit_tray = audit_tray($info);
						//end of insert
						$this->set_response("success", REST_Controller::HTTP_OK);
					}else{
						// insert into audit tray
						$info = array(
							'user_id' => $this->post('agentId'),
							'activity' => "Added a business transport",
							'status' => false,
							'user_category' => $this->post('collector'),
							'description' => "Added a business transport with code: $code",
							'channel' => "Mobile App",
						);
						$audit_tray = audit_tray($info);
						//end of insert
						$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
					}
				}else{
					$insert = $this->db->insert('household_transport',$data);
					$save = $this->db->insert_id();
					if($save){
						// insert into audit tray
						$info = array(
							'user_id' => $this->post('agentId'),
							'activity' => "Added a household transport",
							'status' => true,
							'user_category' => $this->post('collector'),
							'description' => "Added a household transport with code: $code",
							'channel' => "Mobile App",
						);
						$audit_tray = audit_tray($info);
						//end of insert
						$this->set_response("success", REST_Controller::HTTP_OK);
					}else{
						// insert into audit tray
						$info = array(
							'user_id' => $this->post('agentId'),
							'activity' => "Added a household transport",
							'status' => false,
							'user_category' => $this->post('collector'),
							'description' => "Added a household transport with code: $code",
							'channel' => "Mobile App",
						);
						$audit_tray = audit_tray($info);
						//end of insert
						$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
					}
				}
			}
		}


	// save Food Vendor
	public function saveFoodVendor_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$towncode = strtoupper(substr($this->post('vendingPoint'), 0, 3));
			$number = $this->FoodModel->food_number();
			$primary_contact = trim($this->post('primaryContact'));
			$code = "FV".$towncode.str_pad($number, 4, '0', STR_PAD_LEFT);
			$data['fv_code'] = $code;
			$data['firstname'] = ucfirst(trim($this->post('firstname')));
			$data['lastname'] = ucfirst(trim($this->post('lastname')));
			$data['dob'] = trim($this->post('dob'));
			$data['phoneno'] = trim($this->post('primaryContact'));
			$data['town'] = trim($this->post('town'));
			$data['area_council'] = trim($this->post('areaCouncil'));
			$data['nationality'] = trim($this->post('nationality'));
			$data['vending_point'] = trim($this->post('vendingPoint'));
			$data['service_time'] = trim($this->post('serviceTime'));
			$data['cooking_source'] = trim($this->post('sourceCooking'));
			$data['water_availability'] = trim($this->post('waterAvailability'));
			$data['food_type'] = trim($this->post('foodType'));
			$data['medically_certified'] = trim($this->post('medicallyCertified'));
			$data['cert_no'] = trim($this->post('certificateNo'));
			$data['issuer'] = trim($this->post('issuer'));
			$data['year'] = trim($this->post('year'));
			$data['staff_no'] = trim($this->post('staffNo'));
			$data['certified_staff_no'] = trim($this->post('certifiedStaffNo'));
			$data['handler_no'] = trim($this->post('handlersNo'));
			$data['issuer'] = trim($this->post('issuer'));
			$data['created_by'] = $this->post('collector');
			$data['created_id'] = $this->post('id');
			$data['gps_lat'] = $this->post('gpsLat');
			$data['gps_long'] = $this->post('gpsLong');
			if($this->post('nationality') === 'Ghanaian'){
				$data['id_type'] = trim($this->post('idType'));
				$data['id_number'] = trim($this->post('idNumber'));
			}else{
				$data['country'] = trim($this->post('country'));
				$data['nat_id_no'] = trim($this->post('natIdNo'));
			}
			if($this->post('waterAvailability') == 'No'){
				$data['source_water'] = trim($this->post('waterNo'));
			}else{
				$data['source_water'] = trim($this->post('waterYes'));
			}
			if($this->post('foodType') == 'Others'){
				$data['others'] = trim($this->post('others'));
			}else{
				
			}

			$food_vendor = $this->FoodModel->add_food_vendor($data);
			
			if($food_vendor){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a food vendor",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added a food vendor with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$echannelid = 6;
				$echannel = $this->Channelmodel->channelstatus($echannelid);
				if($echannel != 0){
					$sms_message = "Your Food Joint has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour Food Vendor Code is $code\nThank You";
					$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
					@send_sms($phone_formatted, $sms_message);
				}else{

				}
				
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a food vendor",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a food vendor with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}

	}


	// save signage
	public function saveSignage_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			if ($this->post('outdoorCategory') == "Commercial"){
				if ($this->post('contactAvailable') == "Yes"){
					if($this->post('companyName') == "OTHERS"){
						$company_name = strtoupper(substr(trim($this->post('companyNameOthers')), 0, 3));
					}else{
						$company_name = strtoupper(substr(trim($this->post('companyName')), 0, 3));
						
					}	
				}else if ($this->post('contactAvailable') == "No"){
					$company_name = strtoupper(substr(trim($this->post('companyAd')), 0, 3));
				}else{

				}
			}else if($this->post('outdoorCategory') == "Private"){
				$company_name = strtoupper(substr(trim($this->post('companyNameOthers')), 0, 3));
			}else{

			}
			$number = $this->FoodModel->signage_number();
			$primary_contact = trim($this->post('contact'));
			$code = $company_name.str_pad($number, 4, '0', STR_PAD_LEFT);
			$data['outdoor_category'] = trim($this->post('outdoorCategory'));
			if ($this->post('outdoorCategory') == "Commercial"){
				$data['contact_available'] = trim($this->post('contactAvailable'));

				if ($this->post('contactAvailable') == "Yes"){
					if($this->post('companyName') == "OTHERS"){
						$data['company_name'] = ucfirst(trim($this->post('companyNameOthers')));
					}else{
						$data['company_name'] = ucfirst(trim($this->post('companyName')));
						
					}	
				}else if ($this->post('contactAvailable') == "No"){
					$data['company_name'] = ucfirst(trim($this->post('companyAd')));
				}else{

				}
			}else if($this->post('outdoorCategory') == "Private"){
				$data['signage_message'] = ucfirst(trim($this->post('signageMessage')));
				$data['company_name'] = ucfirst(trim($this->post('companyNameOthers')));
			}else{

			}
			$data['code'] = $code;
			$data['company_name'] = ucfirst(trim($this->post('companyName')));
			$data['contact'] = ucfirst(trim($this->post('contact')));
			$data['secondary_contact'] = ucfirst(trim($this->post('secondaryContact')));
			$data['contact_name'] = trim($this->post('contactName'));
			$data['road_class'] = trim($this->post('roadClass'));
			$data['street_name'] = trim($this->post('streetName'));
			$data['landmark'] = trim($this->post('landmark'));
			$data['category1'] = trim($this->post('category1'));
			$data['category2'] = trim($this->post('category2'));
			$data['category3'] = trim($this->post('category3'));
			$data['category4'] = trim($this->post('category4'));
			$data['category5'] = trim($this->post('category5'));
			$data['category6'] = trim($this->post('category6'));
			$data['length'] = trim($this->post('length'));
			$data['breadth'] = trim($this->post('breadth'));
			$data['type_of_face'] = trim($this->post('typeOfFaces'));
			$data['no_of_face'] = trim($this->post('noOfFaces'));
			$data['outdoor_type'] = trim($this->post('outdoorType'));
			if (trim($this->post('outdoorType')) == "Non-electronic"){
				$data['illumination'] = trim($this->post('illumination'));
				if (trim($this->post('illumination')) == "Yes") {
					$data['illuminationType'] = trim($this->post('illuminationType'));
				}	
			}
			$data['gps_lat'] = $this->post('gpsLat');
			$data['gps_long'] = $this->post('gpsLong');
			$data['created_by'] = $this->post('collector');
			$data['created_id'] = $this->post('id');
		

			$food_vendor = $this->FoodModel->add_signage($data);
			
			if($food_vendor){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a signage post",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added a signage post with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$echannelid = 6;
				$echannel = $this->Channelmodel->channelstatus($echannelid);
				// if($echannel != 0){
				// 	$sms_message = "Your signage post has been registered successfully on the ". SYSTEM_ID ." Platform.\nYour signage code is $code\nThank You";
				// 	$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
				// 	send_sms($phone_formatted, $sms_message);
				// }else{

				// }
				
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a signage post",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added a signage post with code: $code",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}

	}


	// save no registration
	public function saveNoRegistration_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			
			if(trim($this->post('propertyCategory')) == "Mixed" || trim($this->post('propertyCategory')) == "Business"){
				$data['no_of_bus_occupants'] = trim($this->post('noOfBusOccupants'));
				$data['no_of_stores'] = trim($this->post('noOfStores'));
			}else{

			}
			if($this->post('manualLatLong') != ""){
				$manLatLong = explode(",",$this->post('manualLatLong'));
			}

			if($this->post('propertyCategory') == 'Mixed'){
				$seperator = 'M';
			}elseif($this->post('propertyCategory') == 'Business'){
				$seperator = 'B';
			}elseif($this->post('propertyCategory') == 'Business Occupant'){
				$seperator = 'O';		
			}elseif($this->post('propertyCategory') == 'Residential'){
				$seperator = 'R';			
			}
			
			// get no registration count
			$number = $this->FoodModel->no_registration_number();
			$code = $number + 1;
			$no_registration_code = "NR".$seperator.str_pad($code, 4, '0', STR_PAD_LEFT);

			$data['no_registration_code'] = $no_registration_code;
			$data['area_council'] = $this->post('areaCouncil');
			$data['town'] = $this->post('town');
			$data['property_category'] = trim($this->post('propertyCategory'));
			$data['building_type'] = trim($this->post('buildingType'));
			$data['property_type'] = trim($this->post('propertyType'));
			$data['gps_lat'] = trim($this->post('gpsLat'));
			$data['gps_long'] = trim($this->post('gpsLong'));
			$data['reason'] = trim($this->post('reason'));
			$data['photo'] = trim($this->post('photo'));
			$data['category'] = $this->post('collector');
			$data['creator_id'] = $this->post('id');
			if($this->post('manualLatLong') != ""){
				$data['man_gps_lat'] = $manLatLong[0];
				$data['man_gps_long'] = $manLatLong[1];
			}
		

			$save = $this->db->insert('no_registration',$data);
			
			if($save){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a no registration record",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added a no registration record",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$response = array(
					'message' => "success",
					'code' => $no_registration_code
				);
				
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a no registration record",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "The request failed",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}

	}

	// save no registration
	public function saveLoc_post(){

			$data['action'] = $this->post("action");
			$data['user_id'] = $this->post("userId");
			$data['gps_lat'] = $this->post("lat");
			$data['gps_long'] = $this->post("long");
			
			$save = $this->db->insert('user_location',$data);
	}

	// save Transport
	public function saveGprtuTransport_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('category') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('category') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$registration = trim($this->post('registrationNumber'));
			$data['registration_code'] = trim($this->post('registrationNumber'));
			$data['meduim'] = trim($this->post('medium'));
			$data['make'] = $this->post('make');
			$data['model'] = $this->post('model');
			$data['year_of_manufacture'] = $this->post('yearManufacture');
			$data['registration_no'] = trim($this->post('registrationNo'));
			$data['manager'] = $this->post('manager');
			$data["created_id"] = $this->post('id');
			$data["category"] = $this->post('category');
			$data['owner_contact'] = $this->post('ownerContact');
			$data['owner_firstname']= $this->post('ownerFirstname');
			$data['owner_lastname'] = ucfirst(trim($this->post('ownerLastname')));
			$data['owner_areacouncil'] = ucfirst(trim($this->post('ownerAreaCouncil')));
			$data['owner_town'] = trim($this->post('ownertown'));
			
			if($this->post('manager') == "No"){
				$data['driver_contact']= $this->post('driverContact');
				$data['driver_firstname'] = ucfirst(trim($this->post('driverFirstname')));
				$data['driver_lastname'] = ucfirst(trim($this->post('driverLastname')));
				$data['area_council'] = trim($this->post('areaCouncil'));
				$data['town'] = trim($this->post('town'));
			}else{
				$data['driver_contact']= $this->post('ownerContact');
				$data['driver_firstname'] = ucfirst(trim($this->post('ownerFirstname')));
				$data['driver_lastname'] = ucfirst(trim($this->post('ownerLastname')));
				$data['area_council'] = trim($this->post('ownerAreaCouncil'));
				$data['town'] = trim($this->post('ownertown'));
			}
			if($this->post('medium') === '10'){
				$data['specify_meduim'] = trim($this->post('specifyMeduim'));
			}
			
			$insert = $this->db->insert('gprtu_transport',$data);
			$save = $this->db->insert_id();
			if($save){

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a vehicle",
					'status' => true,
					'user_category' => $this->post('category'),
					'description' => "Added a vehicle with registration no: $registration",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{

				// insert into audit tray
				$info = array(
					'user_id' => $this->post('id'),
					'activity' => "Added a vehicle",
					'status' => false,
					'user_category' => $this->post('category'),
					'description' => "Added a vehicle with registration no: $registration",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("fail", REST_Controller::HTTP_OK);
			}
		}
	}

	// save Unregistered individual data
	public function saveUnregistered_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$firstnames = ucfirst(trim($this->post('firstname')));
			$lastname = ucfirst(trim($this->post('lastname')));
			$data['contact']= $this->post('contact');
			$data['firstname'] = ucfirst(trim($this->post('firstname')));
			$data['lastname'] = ucfirst(trim($this->post('lastname')));
			$data['area_council'] = trim($this->post('areaCouncil'));
			$data['town'] = trim($this->post('town'));
			$data["agent_id"] = $this->post('agentId');
			$data["agent_category"] = $this->post('collector');

			$insert = $this->db->insert('unregistered_household',$data);
			$save = $this->db->insert_id();
			if($save){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added an unregistered household",
					'status' => true,
					'user_category' => $this->post('collector'),
					'description' => "Added an unregistered household with name $firstname $lastname",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Added an unregistered household",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Added an unregistered household with name $firstname $lastname",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert

				$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
			}
		}
	}

	// update location residence and business property
	public function updateLocation_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$propertyCat = $this->post('propertyCat');
			$propertyCode = $this->post('propertyCode');
			$latitude = $this->post('latitude');
			$longitude = $this->post('longitude');
			$id = $this->post('id');
			$collector = $this->post('collector');

			if($propertyCat == "Residence"){
				$where = array('res_code' => $propertyCode);
				$data = array(
					'gps_lat' => $latitude,
					'gps_long' => $longitude
				);

				$this->db->where($where);
				$update = $this->db->update('residence',$data);

				if($update){
					// insert into audit tray
					$info = array(
						'user_id' => $id,
						'activity' => "Updated a residence property location",
						'status' => true,
						'user_category' => $collector,
						'description' => "Updated a residence property location with code: $propertyCode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$this->set_response("success", REST_Controller::HTTP_OK);
				}else{
					// insert into audit tray
					$info = array(
						'user_id' => $id,
						'activity' => "Updated a residence property location",
						'status' => false,
						'user_category' => $collector,
						'description' => "Updated a residence location with code: $propertyCode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
				}
			}else{
				$where = array('buis_prop_code' => $propertyCode);
				$data = array(
					'gps_lat' => $latitude,
					'gps_long' => $longitude
				);

				$this->db->where($where);
				$update = $this->db->update('buisness_property',$data);

				if($update){
					// insert into audit tray
					$info = array(
						'user_id' => $id,
						'activity' => "Updated a business property location",
						'status' => true,
						'user_category' => $collector,
						'description' => "Updated a business property location with code: $propertyCode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$this->set_response("success", REST_Controller::HTTP_OK);
				}else{
					// insert into audit tray
					$info = array(
						'user_id' => $id,
						'activity' => "Updated a business property location",
						'status' => false,
						'user_category' => $collector,
						'description' => "Updated a business property location with code: $propertyCode",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert
					$this->set_response("Unauthorised", REST_Controller::HTTP_OK);
				}
			}
		}
	}
                                
                    


	// login
	public function login_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else{
			$user = strtolower(trim($this->post('user')));
			$pass = $this->post('password');
			if($user_data = $this->agent->validate_user($user)){

				$dpass = $user_data['password'];
				$dbpassword = $this->encryption->decrypt($dpass);
				//exit($dbpassword);
				
				if($user_data = $this->agent->validate_pass($dbpassword,$pass,$user)){
					// insert into audit tray
					// $info = array(
					// 	'user_id' => $user_data['id'],
					// 	'activity' => "Logged In",
					// 	'status' => true,
					// 	'user_category' => "agent",
					// 	'description' => "Logged In",
					// 	'channel' => "Mobile App",
					// );
					// $audit_tray = audit_tray($info);
					//end of insert
					$this->set_response($user_data, REST_Controller::HTTP_OK);
				}else{
					$this->set_response("false", REST_Controller::HTTP_OK);
				}
			}
			else{
				$this->set_response("false", REST_Controller::HTTP_OK);
			}
		}

	}

	// send_sms
	public function sendSms_post(){

		$phoneno = trim($this->post('phoneno'));
		$message = $this->post('message');
		$phone_formatted = ((strlen($phoneno) > 10) && substr($phoneno, 0, 3) == '233') ? $phoneno : '233' . substr($phoneno, 1, strlen($phoneno));
		@send_sms($phone_formatted, $message);

		$this->set_response("success", REST_Controller::HTTP_OK);

	}

	// send_sms
	public function sendInvoiceSms_post(){
		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('id')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$adjustment_amount = $this->post("adjustmentAmount");
			$amount_paid = $this->post("amountPaid");
			$customer_name = $this->post("customerName");
			$phoneno = $this->post("phoneno");
			$invoice_amount = $this->post("invoiceAmount");
			$property_code = $this->post("propertyCode");
			$invoice_year = $this->post("invoiceYear");
			$revenue_type = $this->post("revenueType");
			$collector = $this->post("collector");
			$id = $this->post("id");

			$message = "Dear Customer \nYour ".$revenue_type." Bill on ".$property_code ." for ". $invoice_year ." is GHs ".$invoice_amount.".Plz pay at any nearest ". SYSTEM_ID ." office, Revenue Paypoint, Zonal Council.\nThank U.";
			$phone_formatted = ((strlen($phoneno) > 10) && substr($phoneno, 0, 3) == '233') ? $phoneno : '233' . substr($phoneno, 1, strlen($phoneno));
			$echannelid = 6;
			$echannel = $this->Channelmodel->channelstatus($echannelid);
			if($echannel != 0){
				@send_sms($phone_formatted, $message);
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				$this->set_response("failed", REST_Controller::HTTP_OK);
			}

			$this->set_response("success", REST_Controller::HTTP_OK);
		}

	}

	// login
	public function adminLogin_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else{
			$user = strtolower(trim($this->post('user')));
			$pass = $this->post('password');
			if($user_data = $this->user->validate_userr($user)){

				$dpass = $user_data['password'];
				$dbpassword = $this->encryption->decrypt($dpass);
				//exit($dbpassword);
				
				if($user_pass = $this->user->validate_passs($dbpassword,$pass,$user)){
					// insert into audit tray
					// $info = array(
					// 	'user_id' => $user_pass['id'],
					// 	'activity' => "Logged In",
					// 	'status' => true,
					// 	'user_category' => "admin",
					// 	'description' => "Logged In",
					// 	'channel' => "Mobile App",
					// );
					// $audit_tray = audit_tray($info);
					// //end of insert
					$this->set_response($user_pass, REST_Controller::HTTP_OK);
				}else{
					$this->set_response("false", REST_Controller::HTTP_OK);
				}
			}
			else{
				$this->set_response("false", REST_Controller::HTTP_OK);
			}
		}
	}


// change agent password
	public function changePassword_post()
	{
		$id = $this->post('id');
		$newPass = $this->post('newPass');
		$password = $this->encryption->encrypt($newPass);
		$where = array('id' => $id);
		$data = array(
					'password' => $password,
					'first_login' => 1
				);
		$this->db->where($where);
		$update = $this->db->update("agent",$data);
		if($update){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("failure", REST_Controller::HTTP_OK);
		}

	}

// change password
	public function changeAdminPassword_post()
	{
		$id = $this->post('id');
		$newPass = $this->post('newPass');
		$password = $this->encryption->encrypt($newPass);
		$where = array('id' => $id);
		$data = array(
						'password' => $password,
						'first_login' => 1
					);
		$this->db->where($where);
		$update = $this->db->update("users",$data);
		if($update){
			$this->set_response("success", REST_Controller::HTTP_OK);
		}else{
			$this->set_response("failure", REST_Controller::HTTP_OK);
		}

	}

	// send otp
	public function sendOTP_post(){

		$phone = $this->post('phoneNo');
		$invoice_no = $this->post('invoiceno');
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
		$this->tax->save_otp_code($data);
		$echannelid = 6;
		$echannel = $this->Channelmodel->channelstatus($echannelid);
		if($echannel != 0){
			$amount = $this->post('amount');
			$sms_message = "Kindly confirm payment of $amount for invoice $invoice_no by sharing OTP $otp with the agent/collector.";
			$phone_formatted = ((strlen($phone) > 10) && substr($phone, 0, 3) == '233') ? $phone : '233' . substr($phone, 1, strlen($phone));
			$sms_rs = @send_sms($phone_formatted, $sms_message);
			if(substr($sms_rs, 0, 4) == '1701'){
				$this->set_response("success", REST_Controller::HTTP_OK);
			}else{
				$this->set_response("failed", REST_Controller::HTTP_OK);
			}
		}else{
			$this->set_response("failed", REST_Controller::HTTP_OK);
		}
	}

	// validate otp
	public function validateOTP(){
		$otp = $this->post('otp');
		$paymode = $this->post('paymentMode');

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
				$this->tax->update_otp('Expired', $result['id']);
				return 'expired';
			}else{
				$this->tax->update_otp('Used', $result['id']);
				return 'success';
			}
		}else{
			return 'invalid';
		}
	}

	// process mobile app payment.
	public function processPayment_post(){

		if(get_channel_status(5) == 0){
			$this->set_response("stop", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "agent" && get_agent_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else if($this->post('collector') == "admin" && get_user_status($this->post('agentId')) == 0){
			$this->set_response("block", REST_Controller::HTTP_OK);
		}else{
			$invoice_id = $this->post('invoiceId');
			$invoice_no = $this->post('invoiceno');
			$payment_mode = $this->post('paymentMode');
			$actual_invoice_amount = (float)$this->post('invoiceAmount');
			$target = !empty($this->post('target')) ? $this->post('target') : 0;
			$valid = $this->validateOTP();
			$invoice_amount_paid = (float)$this->post('amountPaidSoFar');
			// check if its a part payment or full payment
			if($this->post('paymentType') == "Full Payment"){
				$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
			}else{
				$amount_paid = (float)$this->post('amountPaid');//part payment
			}

			if($this->post('product') == 1){
					$invoiceTypeName = "BOP";
				
			}else if($this->post('product') == 2){
				
					$invoiceTypeName = "UNASSESSED BUS PROP";
				
			}else if($this->post('product') == 3){
				
					$invoiceTypeName = "UNASSESSED RES PROP";
				
			}else if($this->post('product') == 4){
				
					$invoiceTypeName = "FEES";
				
			}else if($this->post('product') == 5){
				
					$invoiceTypeName = "FINES";
				
			}else if($this->post('product') == 6){
				
					$invoiceTypeName = "BUILDING PLAN PERMIT";
				
			}else if($this->post('product') == 7){
				
					$invoiceTypeName = "PERMIT CHARGES";
				
			}else if($this->post('product') == 8){
				
					$invoiceTypeName = "RENT";
				
			}else if($this->post('product') == 9){
				
					$invoiceTypeName = "PERMIT";
				
			}else if($this->post('product') == 12){
				
					$invoiceTypeName = "BUSINESS PROPERTY RATE";
				
			}else if($this->post('product') == 13){
				
					$invoiceTypeName = "RESIDENCE PROPERTY RATE";
				
			}
			if( $valid == 'success' ){
				$product = $this->post('product');
				$property_id = !empty($this->post('propertyId')) ? $this->post('propertyId') : 0;
				$actual_invoice_amount = (float)$this->post('invoiceAmount');
				$transaction_id = random_string('numeric',10);
				$datetime = date("Y-m-d H:i:s");
				$payment_mode = $this->post('paymentMode');

				// get amount already paid //target == 0 is for onetime invoice
				//$invoice_amount_paid = ($target == 0) ? $this->input->post('amount_paid_so_far') : $this->TaxModel->get_invoice_amount_paid($invoice_id);
				$invoice_amount_paid = (float)$this->post('amountPaidSoFar');
				//update amount paid in db

				// check if its a part payment or full payment
				if($this->post('paymentType') == "Full Payment"){
					$amount_paid = $actual_invoice_amount - $invoice_amount_paid;
				}else{
					$amount_paid = (float)$this->post('amountPaid');//part payment
				}

				if($payment_mode == "Cheque"){
					$new_amount_paid = $invoice_amount_paid;
				}else {
					$new_amount_paid = $invoice_amount_paid + $amount_paid;
				}

				// where
				$where = array('id' => $invoice_id);



				// update invoice status if $new_amount_paid <= $actual_invoice_amount or not
				if(number_format((float)$actual_invoice_amount , 2, '.', '') <= number_format((float)$new_amount_paid , 2, '.', '') ){
					// data to be updated
					$data = array('amount_paid' => number_format((float)$new_amount_paid , 2, '.', ''),'status' => 1 );
				}else{
					// data to be updated
					$data = array('amount_paid' => number_format((float)$new_amount_paid , 2, '.', ''));
				}
				// pass data and where clause to the model
				if($target == 0){
					$update_invoice_amount_paid = $this->tax->update_invoice_options($data,$where);
				}else{
					$update_invoice_amount_paid = $this->tax->update_invoice($data,$where);
				}



				if($new_amount_paid > $invoice_amount_paid){
					$tran['status'] = 1;
				}else {
					$tran['status'] = 0;
				}

			// get transaction data and insert in transactions table
				$tran['invoice_id'] = $this->post('invoiceId');
				$tran['transaction_id'] = $transaction_id;
				$tran['payment_mode'] = $this->post('paymentMode');
				$tran['valuation_no'] = $this->post('valuationNumber');
				$tran['gcr_no'] = $this->post('gcrNumber');
				// check payment mode type
				if($this->post('paymentMode') == "Mobile Money"){
					$tran['mobile_operator'] = $this->post('mobileOperator');
					$tran['momo_number'] = $this->post('momoNumber');
				}else if($this->post('paymentMode') == "Cheque"){
					$tran['bank_name'] = $this->post('bankName');
					$tran['bank_branch'] = $this->post('bankBranch');
					$tran['cheque_name'] = $this->post('chequeName');
					$tran['cheque_no'] = $this->post('chequeNo');
				}else if($this->post('paymentMode') == "Mobile Money Number"){
					$tran['sender_momo_number'] = $this->post('senderMomoNo');
					$tran['sender_transaction_id'] = $this->post('momoTransId');
				}else{

				}
				$tran['payment_type'] = $this->post('paymentType');

				// check if its a part payment or full payment
				if($this->post('paymentType') == "Full Payment"){
					$tran['amount'] = $actual_invoice_amount - $invoice_amount_paid;
				}else{
					$tran['amount'] = $this->post('amountPaid');
				}
				$tran['paid_by'] = $this->post('paidBy');
				// check who is making the payment
				if($this->post('paidBy') == "others"){
					$primary_contact = $this->post('phoneNumber');
					$tran['payer_name'] = $this->post('name');
					$tran['payer_phone'] =  $this->post('phoneNumber');
				}else{
					if($target == 1){
						$owner = business_owner_details($property_id);
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
						$primary_contact = $this->post('phoneNumber');
						$tran['payer_name'] = $owner['firstname'].' '.$owner['lastname'];
						$tran['payer_phone'] =  $owner['primary_contact'];
					}else if($target == 0){
						$primary_contact = $this->post('ownerPhoneNumber');
						$tran['payer_name'] =  $this->post('ownerName');
						$tran['payer_phone'] =  $this->post('ownerPhoneNumber');
					}
				}
				$tran['fromIO'] = ($target == 0) ? 1 : 0;
				$tran['channel'] = "Mobile App";
				$tran['created_by'] = $this->post('agentId');
				$tran['collected_by'] = $this->post('collector');

				//insert into transactions table
				$insert_transaction = $this->tax->insert_transaction($tran);

				if($insert_transaction){

					$echannelid = 6;
					$echannel = $this->Channelmodel->channelstatus($echannelid);
					if($echannel != 0){
						//send sms after successful payment
						if($this->post('paidBy') == "others"){
							$primary_contact = $this->post('phoneNumber');
							
							if($target == 1){
								$owner = business_owner_details($property_id);
								$owner_contact = $owner['primary_contact'];
							}else if($target == 2){
								$owner = business_owner_details($property_id);
								$owner_contact = $owner['primary_contact'];
			
							}else if($target == 3){
								$owner = business_occ_owner_details($property_id);
								$owner_contact = $owner['primary_contact'];
							}else if($target == 0){
								$owner_contact =  $this->post('phoneNumber');
							}

							// send sms to rate payer
							$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
							$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ."for $invoiceTypeName has been completed at $datetime";
							$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
							$sms_message .= "\nTransaction ID: $transaction_id";
							$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
							@send_sms($phone_formatted, $sms_message);

							//send sms to owner/caretaker
							$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
							$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ."for $invoiceTypeName has been completed at $datetime";
							$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
							$sms_message .= "\nTransaction ID: $transaction_id";
							$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
							@send_sms($phone_formatted, $sms_message);

						}else{
							$balance = number_format((float)$actual_invoice_amount - $new_amount_paid , 2, '.', ',');
							$sms_message = "Your $payment_mode payment of GHS $amount_paid to ". SYSTEM_ID ."for $invoiceTypeName has been completed at $datetime";
							$sms_message .= ($payment_mode == "Cheque") ? " with Pending status." : ". Your outstanding amount is $balance.";
							$sms_message .= "\nTransaction ID: $transaction_id";
							$phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
							@send_sms($phone_formatted, $sms_message);
						}
					}else{

					}

					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Made a payment",
						'status' => true,
						'user_category' => $this->post('collector'),
						'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert

					$this->set_response("success", REST_Controller::HTTP_OK);
				}else{
					
					// insert into audit tray
					$info = array(
						'user_id' => $this->post('agentId'),
						'activity' => "Made a payment",
						'status' => false,
						'user_category' => $this->post('collector'),
						'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no",
						'channel' => "Mobile App",
					);
					$audit_tray = audit_tray($info);
					//end of insert

					$this->set_response("failed", REST_Controller::HTTP_OK);
				}
			}
			else if( $valid == 'expired' ){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Made a payment",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is expired",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("expired", REST_Controller::HTTP_OK);
			}
			else if( $valid == 'invalid' ){
				// insert into audit tray
				$info = array(
					'user_id' => $this->post('agentId'),
					'activity' => "Made a payment",
					'status' => false,
					'user_category' => $this->post('collector'),
					'description' => "Made a $payment_mode payment of GHs $amount_paid for $invoice_no but OTP is invalid",
					'channel' => "Mobile App",
				);
				$audit_tray = audit_tray($info);
				//end of insert
				$this->set_response("invalid", REST_Controller::HTTP_OK);
			}
		}

	}

}
