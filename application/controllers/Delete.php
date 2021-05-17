<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');

		if($this->session->userdata('user_info')['id'] == ''){
			redirect('login');
		}
	}

	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

    // delete a property and business record
	public function delete_property_business()
	{   
        // get post data
        $code = $this->input->post('property_code');
        $property_id = $this->input->post('property_id');
        $flag = $this->input->post('flag');

        //check if user has permission to delete
		if(!has_permission($this->session->userdata('user_info')['id'],'delete_property_business')){

            $alert_type = "alert-danger";
            $alert_msg = "Sorry";
            $msg = "Tried To Delete for record with code: $code failed because user doesn't have the right.";
			// insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Delete Record",
                'status' => false,
                'user_category' => "Admin",
                'description' => "Tried To Delete for record with code: $code failed because user doesn't have the right.",
                'channel' => "Web",
            );
            $audit_tray = audit_tray($info);
            //end of insert

		}else{

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
                    $alert_type = "alert-success";
                    $alert_msg = "Success";
                    $msg = "Record with code: $code deleted";
				}else{
                    $response = "fail";
                    $alert_type = "alert-danger";
                    $alert_msg = "Sorry";
                    $msg = "Record with code: $code failed to delete due to system error";
				}	
			}else if($flag == "res"){
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
                    $alert_type = "alert-success";
                    $alert_msg = "Success";
                    $msg = "Record with code: $code deleted";
				}else{
                    $response = "fail";
                    $alert_type = "alert-danger";
                    $alert_msg = "Sorry";
                    $msg = "Record with code: $code failed to delete due to system error";
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
                    $alert_type = "alert-success";
                    $alert_msg = "Success";
                    $msg = "Record with code: $code deleted";
				}else{
                    $response = "fail";
                    $alert_type = "alert-danger";
                    $alert_msg = "Sorry";
                    $msg = "Record with code: $code failed to delete due to system error";
				}
			}else{
                $response = "fail";
                $alert_type = "alert-danger";
                $alert_msg = "Sorry";
                $msg = "Record with code: $code failed to delete due to system error";
                
			}

			if($response == "success"){
				$sql = "DELETE i FROM invoice i JOIN revenue_product r ON r.id = i.product_id WHERE r.target = $target AND i.property_id = $property_id";
				$this->db->query($sql);
			}

			if($response == "success"){
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Delete Record",
					'status' => true,
					'user_category' => "Admin",
					'description' => "Deleted $property_category record with code: $code",
					'channel' => "Web",
				);
				$audit_tray = audit_tray($info);
			}else{
				// insert into audit tray
				$info = array(
					'user_id' => $this->session->userdata('user_info')['id'],
					'activity' => "Delete Record",
					'status' => false,
					'user_category' => "Admin",
					'description' => "Delete for record with code: $code failed",
					'channel' => "Web",
				);
				$audit_tray = audit_tray($info);
				//end of insert
			}
        }
        
        $this->session->set_flashdata(
			'message', "<div class='alert $alert_type'>
				<strong>$alert_msg! </strong> $msg
			</div>"
		);
		redirect($_SERVER['HTTP_REFERER']);

	}

    

}
