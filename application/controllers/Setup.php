<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Setup_model');
                $this->load->model('Agency_model');
		if($this->session->userdata('user_info')['user_id'] == ''){
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

//	load sub-category page	
	public function hospital(){
		$data = array(
			'title' => 'Hospital / Clinics',
			'page' => 'hospital/hospital',
			'result' =>$this->Setup_model->get_hospital(),
		);
		$this->load_page($data);
	}

//	load sub-category page	
	public function settings(){
		$a = $this->session->userdata('user_info')['orgid'];
		$data = array(
			'title' => 'Settings',
			'page' => 'setting/setting',
			'result' =>$this->Setup_model->setting($a),
			'type' => $this->Agency_model->get_agencytypes(),
		);
		$this->load_page($data);
	}

//	load common results page	
	public function commonresults(){
		$data = array(
			'title' => 'Common Results',
			'page' => 'commonresult/commonresult',
			'result' =>$this->Setup_model->get_commonresult(),
		);
		$this->load_page($data);
	}

//	add new category
	public function add_commonresult(){
		$result = trim($this->input->post('result'));
		$data = array(
			'result'=> $result,
			'deletestatus' => 'A',
		);
		$insert = $this->Setup_model->add_commonresult($data);

		if($insert){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Common result saved.
                </div>");
		}
		redirect('commonresults');	


	}

	//	load specimen page	
	public function specimen(){
		$data = array(
			'title' => 'Specimens',
			'page' => 'specimen/specimen',
			'result' =>$this->Setup_model->get_specimen(),
		);
		$this->load_page($data);
	}

// delete hospital
	public function delete_hospital(){
		
		$hosid= $this->uri->segment(3);
		$hos_data = array(
			'hosid'=>$hosid,
		);
		$data = array(
			'delete_status'=>'D',
		);
		if($this->Setup_model->delete_hospital($hos_data,$data)){
			echo json_encode($hos_data);
		}	
	}

// delete test
	public function delete_commonresult(){
		
		$resid= $this->uri->segment(3);
		$test_data = array(
			'resid'=>$resid,
		);
		$data = array(
			'deletestatus'=>'D',
		);
		if($this->Setup_model->delete_commonresult($test_data,$data)){
			echo json_encode($test_data);
		}	
	}
	
// delete specimen
	public function delete_specimen(){
		
		$speid= $this->uri->segment(3);
		$spe_data = array(
			'speid'=>$speid,
		);
		$data = array(
			'delete_status'=>'D',
		);
		if($this->Setup_model->delete_specimen($spe_data,$data)){
			echo json_encode($spe_data);
		}	
	}

//	update hospital details
	public function update_hospital(){
		$hosname = $this->input->post('hosname');
		$oldhosname = $this->input->post('oldhosname');
		$hosid = $this->input->post('hosid');
		
		$data1 = array(
			'nameofcli' => $hosname,
		);
		
		$id1 = array(
			'nameofcli' => $oldhosname,
		);
		$update1 = $this->Setup_model->update_oldhospital($data1,$id1);
		$data = array(
			'hosname' => $hosname,
		);
		
		$id = array(
			'hosid' => $hosid,
		);
		$update = $this->Setup_model->update_hospital($data,$id);
		if($update){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Hospital updated.
                </div>");
		}
		redirect('hospital');	
	}


//	add new agency
	public function update_agency(){

			// upload image to folder

				$config['upload_path'] = 'upload/agency/';
				$config['allowed_types'] = 'gif|jpg|png|pdf|docx';
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload()){
					$file_path = 'upload/user-avatar.png';
					$error = array('error' => $this->upload->display_errors());
					//$this->session->set_flashdata('message',"<div class='alert alert-danger'>". $error['error']." </div>");
				}
				else{
					$file_path = $config['upload_path'].$this->upload->file_name;

					$data = array('upload_data' => $this->upload->data());
					//$this->session->set_flashdata('message',"<div class='alert alert-success'>The upload was successfull</div>");
				}

				if($file_path != 'upload/user-avatar.png'){
					$new_file = $file_path;
				}else{
					$new_file = $this->input->post('img_path');
				}

			// end of image upload
			//$agencycode = trim($this->input->post('agencycode'));
			$agencyname = trim($this->input->post('agencyname'));
			$contact = trim($this->input->post('contact'));
			$email = trim($this->input->post('email'));
			$location = trim($this->input->post('location'));
			$weburl = trim($this->input->post('weburl'));
			$agencytype = trim($this->input->post('agencytype'));
			$description = trim($this->input->post('description'));
			$agencyid = trim($this->input->post('agencyid'));

			$data = array(
				'agencyname' => $agencyname,
				'contact' => $contact,
				'email' => $email,
				'location' => $location,
				'weburl' => $weburl,
				'agencytype' => $agencytype,
				'description' => $description,
				'logo' => $new_file
			);

			$id = array(
				'agencyid'=> $agencyid,
			);
			$upload = $this->Setup_model->update_agency($data,$id);

			if(!$upload){
					
			}
			else{
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");				
			}
			
			redirect('settings');
				
	}

//	update hospital details
	public function update_specimen(){
		$spename = $this->input->post('spename');
		$oldspename = $this->input->post('oldspename');
		$speid = $this->input->post('speid');
		
		$data1 = array(
			'typeofspe' => $spename,
		);
		
		$id1 = array(
			'typeofspe' => $oldspename,
		);
		$update1 = $this->Setup_model->update_oldspecimen($data1,$id1);
		$data = array(
			'spename' => $spename,
		);
		
		$id = array(
			'speid' => $speid,
		);
		$update = $this->Setup_model->update_specimen($data,$id);
		if($update){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Specimen updated.
                </div>");
		}
		redirect('specimen');	
	}

//	update hospital details
	public function update_discount(){
		$dis = $this->input->post('dis');
		
		$data = array(
			'discount' => $dis,
		);
		
		$id = array(
			'disid' => 1,
		);
		$update = $this->Setup_model->update_discount($data,$id);
		if($update){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : discount updated.
                </div>");
		}
		redirect('hospital');	
	}

//	add new hospital
	public function add_hospital(){
		$hosname = trim($this->input->post('hosname'));
		date_default_timezone_set('Africa/Accra');
		$datetime =  date('Y-m-d H:i:s');
		$data = array(
			'hosname'=> $hosname,
			'timesaved' => $datetime,
			'delete_status' => 'A'
		);
			$insert = $this->Setup_model->add_hospital($data);

		if($insert){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Hospital/ Clinic saved.
                </div>");
		}
		redirect('hospital');	

	}


//	add new specimen
	public function add_specimen(){
		$spename = trim($this->input->post('spename'));
		date_default_timezone_set('Africa/Accra');
		$datetime =  date('Y-m-d H:i:s');
		$data = array(
			'spename'=> $spename,
			'timesaved' => $datetime,
			'delete_status' => 'A'
		);
			$insert = $this->Setup_model->add_specimen($data);

		if($insert){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Specimen saved.
                </div>");
		}
		redirect('specimen');	

	}

// redraw hospital table table
    public function redraw_hos_table(){
		
        $data = $this->load->view('hospital/redraw_hos_table');
        return json_encode($data);
    }

// redraw specimen table table
    public function redraw_spe_table(){
		
        $data = $this->load->view('specimen/redraw_spe_table');
        return json_encode($data);
    }


//	get hospital to be editted details
	public function get_hospital_details(){
		$hosid = $this->uri->segment(3);
		$get_hos = $this->Setup_model->get_hos_detail($hosid);
	}
	
//	get hospital to be editted details
	public function get_specimen_details(){
		$speid = $this->uri->segment(3);
		$get_spe = $this->Setup_model->get_spe_detail($speid);
	}
//	update user password
	public function update_password(){
	
		$newpass = $this->input->post('newpass');
		$confirmpass =$this->encryption->encrypt($newpass);
		$userid = $this->input->post('passid');
		
		$data = array(
			'password' => $confirmpass,
		);
		
		$id = array(
			'user_id' => $userid,
		);
		$update_password = $this->Setup_model->update_password($data,$id);
		redirect('login');	
	}

	
	
	public function search_password(){
		$passid = $this->input->post('passid');
		$query = $this->db->query("SELECT * from users WHERE user_id = $passid")->result_array();
		
		$ss =$query[0]['password'];
		$decrypted = $this->encryption->decrypt($ss);
			$pass = array(
				'password'=>$decrypted
			);
			$realpass = array(
				'realpass'=>$pass
			);
			
		

		echo $decrypted;
			
		}

	//	get category to be editted details
	public function get_commonresult_details(){
		$insid = $this->uri->segment(3);
		$get_ins = $this->Setup_model->get_commonresult_detail($insid);
	}

	//	update insurance details
	public function update_commonresult(){
		$result = $this->input->post('result');
		$resid = $this->input->post('resid');
		
		$data = array(
			'result' => $result,
		);
		
		$id = array(
			'resid' => $resid,
		);
		$update = $this->Setup_model->update_commonresult($data,$id);
		if($update){
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  SUCCESS : Common result updated.
                </div>");
		}
		redirect('insurance');	
	}
	
	
//	update user details
	public function update_user(){
		$username = $this->input->post('username');
		$fullname = $this->input->post('fullname');
		$role = $this->input->post('role');
		$userid = $this->input->post('userid');
		
		$data = array(
			'username' => $username,
			'fullname' => $fullname,
			'role' => $role,
		);
		
		$id = array(
			'user_id' => $userid,
		);
		$update_user = $this->Setup_model->update_user($data,$id);
		redirect('users');	
	}

// redraw test table
    public function redraw_commonresult(){
		
        $data = $this->load->view('commonresult/redraw_commonresult');
        return json_encode($data);
    }
	
	
	
}
