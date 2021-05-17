<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MemberModel');
		$this->load->helper('url');
		$this->load->helper('html');
		
		if($this->session->userdata('user_info')['user_id'] == ''){
			redirect('login');
		}
		if($this->session->userdata('user_info')['orgid'] == ''){
			redirect('login');
		}
	}
	
	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

	// load members page
	public function member(){
		
		$data = array(
			'title' => 'Member',
			'page' => 'member/member',
			'result' => $this->MemberModel->get_members(),
		);
		
		$this->load_page($data);
	}
	
	//	update client account activation
	public function update_accactivation(){
		$memberid = $this->uri->segment(3);
		$state = $this->uri->segment(4);
			
		$update = $this->MemberModel->update_accactivation($memberid,$state);
	}
	// submit new member request
	public function add_member(){

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
		 // end of image upload

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
			$image = $this->input->post("image");
			$orgid = $this->session->userdata('user_info')['orgid'];

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
				'orgid' => $orgid
			);

			if( $this->MemberModel->add_member($data) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");;
			}


		redirect(base_url().'member');
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