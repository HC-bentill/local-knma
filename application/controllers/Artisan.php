<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artisan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ArtisanModel');
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

	// load artisan page
	public function Artisan(){
		
		$a = $this->session->userdata('user_info')['orgid']; //church id
		$data = array(
			'title' => 'Artisans',
			'page' => 'artisan/artisan',
			'result' => $this->ArtisanModel->get_artisans(),
			'job' => $this->ArtisanModel->get_jobs(),
			'bank' => $this->ArtisanModel->get_banks()
		);
		
		$this->load_page($data);
	}
	
	// submit new artisan
	public function add_artisan(){

			$config['upload_path'] = 'upload/artisans/';
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
			$fn = $this->input->post("fn");
			$ln = $this->input->post("ln");
			$dob = $this->input->post("dob");
			$phone = $this->input->post("phone");
			$location = $this->input->post("location");
			$offloc = $this->input->post("offloc");
			$buisname = $this->input->post("buisname");
			$idtype = $this->input->post("idtype");
			$idnum = $this->input->post("idnum");
			$email = $this->input->post("email");
			$paymod = $this->input->post("paymod");
			$momo = $this->input->post("momono");
			$bank = $this->input->post("bank");
			$bankaccno = $this->input->post("bankaccno");
			$job = $this->input->post("job");
			$accstatus = $this->input->post("accstatus");

			if($paymod == 'Mobilemoney'){
				$data = array(
					"gender"=> $gender,
					"firstnames" => $fn,
					"lastname" => $ln,
					"dob" => $dob,
					"phone" => $phone,
					"location" => $location,
					'buisname' => $buisname,
					'officeloc' => $offloc,
					'id_type' => $idtype,
					'id_num' => $idnum,
					'email' => $email,
					'paymod' => $paymod,
					'momo_no' => $momo,
					'job_title' => $job,
					'accact' => $accstatus,
					'photo' => $file_path

				);
			}else{
				$data = array(
					"gender"=> $gender,
					"firstnames" => $fn,
					"lastname" => $ln,
					"dob" => $dob,
					"phone" => $phone,
					"location" => $location,
					'buisname' => $buisname,
					'officeloc' => $offloc,
					'id_type' => $idtype,
					'id_num' => $idnum,
					'email' => $email,
					'paymod' => $paymod,
					'bankname' => $bank,
					'bankaccno' => $bankaccno,
					'job' => $job_title,
					'accact' => $accstatus,
					'photo' => $file_path
				);
			}

			if( $this->ArtisanModel->add_artisan($data) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
			}


		redirect(base_url().'artisan');
	}

	//	get artisan details to be editted
	public function get_artisan(){
		$artid = $this->uri->segment(3);
		$get_artisan = $this->ArtisanModel->fetch_artisan_data($artid);
		
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


	// confirm artisan request
	public function confirm_artisan(){
			$accstatus = $this->input->post("accstatus");
			$id = $this->input->post("artid");
			$data = array(
					'accact' => $accstatus
			);
			$id = array(
				'artid' => $id
			);
			if( $this->ArtisanModel->confirm_artisan($data,$id) ){
				$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was updated successfully.
                </div>");
			}

			redirect(base_url().'artisan');
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