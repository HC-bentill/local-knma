<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AgentModel');
		$this->load->helper('url');
		$this->load->helper('html');

		// if($this->session->userdata('user_info')['id'] == ''){
		// 	redirect('login');
		// }
	}

	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

		public function mobile_agent_dashboard(){

			$this->load->view('agent/mob_agent');
		}

	// mobile admin Dashboard
	public function mobile_admin_dashboard(){

		$this->load->view('agent/mob_admin');
	}


	// mobile tv Dashboard
	public function mobile_tv_dashboard(){

		$this->load->view('agent/mob_tv');
	}

	// load artisan page
	public function agent(){
		$data = array(
			'area' => $this->AgentModel->get_area_councils(),
			'title' => 'Agents',
			'page' => 'agent/agent',
			'education' => $this->AgentModel->get_edu(),
			//'result' => $this->AgentModel->get_agent(),
		);

		$this->load_page($data);
	}

	// submit new artisan
	public function add_agent(){

			$config['upload_path'] = 'upload/agents/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|docx';
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload()){
				$file_path = 'upload/user-avatar.png';
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message',"<div class='alert alert-danger'>". $error['error']." </div>");
			}
			else{
				$file_path = $config['upload_path'].$this->upload->file_name;

				$data = array('upload_data' => $this->upload->data());
				$this->session->set_flashdata('message',"<div class='alert alert-success'>The upload was successfull</div>");
			}
		 // end of image upload

			$gender = $this->input->post("gender");
			$agentcode = $this->input->post("agentcode");
			$fn = $this->input->post("fn");
			$ln = $this->input->post("ln");
			$dob = $this->input->post("dob");
			$phone = $this->input->post("phone");
			$location = $this->input->post("location");
			$agname = $this->input->post("agname");
			$agphone = $this->input->post("agphone");
			$offloc = $this->input->post("offloc");
			$buisname = $this->input->post("buisname");
			$idtype = $this->input->post("idtype");
			$idnum = $this->input->post("idnum");
			$email = $this->input->post("email");
			$paymod = $this->input->post("paymod");
			$momo = $this->input->post("momono");
			$bank = $this->input->post("bank");
			$bankaccno = $this->input->post("bankaccno");
			$accstatus = $this->input->post("accstatus");

			if($paymod == 'Mobilemoney'){
				$data = array(
					"gender"=> $gender,
					"agentcode"=> $agentcode,
					"firstnames" => $fn,
					"lastname" => $ln,
					"dob" => $dob,
					"phone" => $phone,
					"location" => $location,
					"agname" => $agname,
					"agphone" => $agphone,
					'offloc' => $offloc,
					'idtype' => $idtype,
					'idnum' => $idnum,
					'email' => $email,
					'paymod' => $paymod,
					'momono' => $momo,
					'accstatus' => $accstatus,
					'photo' => $file_path
				);
			}else{
				$data = array(
					"gender"=> $gender,
					"agentcode"=> $agentcode,
					"firstnames" => $fn,
					"lastname" => $ln,
					"dob" => $dob,
					"phone" => $phone,
					"location" => $location,
					"agname" => $agname,
					"agphone" => $agphone,
					'offloc' => $offloc,
					'idtype' => $idtype,
					'idnum' => $idnum,
					'email' => $email,
					'paymod' => $paymod,
					'bankname' => $bank,
					'bankaccno' => $bankaccno,
					'accstatus' => $accstatus,
					'photo' => $file_path
				);
			}

			if( $this->AgentModel->add_agent($data) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");;
			}


		redirect(base_url().'agent');
	}

	//	get artisan details to be editted
	public function get_agent(){
		$agentid = $this->uri->segment(3);
		$get_artisan = $this->AgentModel->fetch_agent_data($agentid);

	}

	// view member profile
	public function view_member(){
		    $member_id = $this->uri->segment(2);
	   		$a = $this->session->userdata('user_info')['orgid']; //church id
    		$data = array(
				"page" => 'member/view_member',
				'title' => 'Church Member Details',
				'member' => $this->MemberModel->get_member_details($member_id),
				'cell' => $this->MemberModel->get_cells($a),
				'educational' => $this->MemberModel->get_edu($a),
				'grp' => $this->MemberModel->get_grp($a),
				'ministry' => $this->MemberModel->get_ministry($a),
				'position'=> $this->MemberModel->get_position($a),
				'profession'=> $this->MemberModel->get_profession($a),
			);
			$this->load_page($data);


	}


	// confirm agent request
	public function confirm_agent(){
			$accstatus = $this->input->post("accstatus");
			$id = $this->input->post("agentid");
			$data = array(
					'accstatus' => $accstatus
			);
			$id = array(
				'agentid' => $id
			);
			if( $this->AgentModel->confirm_agent($data,$id) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was updated successfully.
                </div>");
			}

			redirect(base_url().'agent');
	}


	//update member information
	public function update_member_info(){

		// upload image to folder
		$config['upload_path'] = 'upload/members/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|docx';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$file_path = 'upload/user-avatar.png';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message',"<div class='alert alert-danger'>". $error['error']." </div>");
		}
		else{
			$file_path = $config['upload_path'].$this->upload->file_name;

			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('message',"<div class='alert alert-success'>The upload was successfull</div>");
		}

		if($file_path != './upload/user-avatar.png'){
			$new_file = $file_path;
		}else{
			$new_file = $this->input->post('img_path');
		}

			$marital_status = $this->input->post("marital_status");
			$fn = $this->input->post("fn");
			$ln = $this->input->post("ln");
			$dob = $this->input->post("dob");
			$gender = $this->input->post("gender");
			$phone = $this->input->post("phone");
			$profession = $this->input->post("profession");
			$nationality = $this->input->post("country");
			$location = $this->input->post("location");
			$ministry = $this->input->post("ministry");
			$email = $this->input->post("email");
			$edu_level = $this->input->post("edu_level");
			$position = $this->input->post("position");
			$group = $this->input->post("group");
			$date_joined = $this->input->post("date_joined");
			$cell = $this->input->post("cell");
			$id = $this->input->post("id");
			$id1 = $this->input->post("id");
			$image = $new_file;

			$data = array(
				"marital_status"=> $marital_status,
				"fn" => $fn,
				"ln" => $ln,
				"dob" => $dob,
				"gender" => $gender,
				"phone" => $phone,
				"profession"=> $profession,
				"nationality"=>  $nationality,
				"location"=>  $location,
				"ministry" => $ministry,
				"email"=>   $email,
				"edu_level" => $edu_level,
				"position" =>$position,
				"group"=> $group,
				"date_joined" => $date_joined,
				'cell' => $cell,
				'image' => $file_path,
			);

			$id = array(
				'memid' => $id
			);
			if( $this->MemberModel->update_member($data,$id) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was updated successfully.
                </div>");
			}

		redirect(base_url().'view_member/'.$id1);
	}

	public function delete_member(){
		$id = $this->uri->segment(3);
		$delete =$this->MemberModel->delete_member($id);

		if($delete){
			echo 1;
		}
	}

	// load members page after delete
    public function redraw(){
    	 redirect(base_url().'member');
    }

}
