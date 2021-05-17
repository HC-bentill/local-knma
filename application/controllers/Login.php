<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login  extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');

    }

	public function index(){
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->view('login/login');
	}

	 // sign user in
    public function signin(){
        $user = strtolower(trim($this->input->post('user')));
        $pass = $this->input->post('password');

        if($user_data = $this->LoginModel->validate_user($user)){

			$dpass = $user_data['password'];
			$dbpassword = $this->encryption->decrypt($dpass);
			//exit($dbpassword);

			if($user_data =$this->LoginModel->validate_pass($dbpassword,$pass,$user)){

					// insert into audit tray table
					$info = array(
						'user_id' => $user_data['id'],
						'activity' => "Logged In",
						'status' => true,
						'description' => "",
						'user_category' => "admin",
						'channel' => "Web"
					);
					$audit_tray = audit_tray($info);
					//end of insert

					//$this->LoginModel->insert_footsteps($info);
					$data = array(
		               'id' => $user_data['id'],
		               'username' => $user_data['username'],
					   'password' => $user_data['password'],
					   'firstname' => $user_data['firstname'],
					   'lastname' => $user_data['lastname'],
					   'email' => $user_data['email'],
					   'position' => $user_data['position'],
					   'first_login' => $user_data['first_login']
	                );
					$this->session->set_userdata('user_info',$data);
					
					$this->LoginModel->do_session_job($user_data['id']);


	           redirect('dashboard');
			}else{
				$user_data = $this->LoginModel->validate_user($user);
				// insert into audit tray table
				$info = array(
					'user_id' => $user_data['id'],
					'activity' => "Logged In",
					'status' => false,
					'description' => "Password was incorrect",
					'user_category' => "admin",
					'channel' => "Web"
				);
				$audit_tray = audit_tray($info);
				//end of insert
	            $this->session->set_flashdata('message','<div class="alert alert-danger">Incorrect Credentials.</div>');
	 			redirect('login');

	        }
        }
        else{
        		$this->session->set_flashdata('message','<div class="alert alert-danger">Incorrect Credentials.</div>');
	 			redirect('login');
        }
    }

	// unlock lock screen
    public function unlock(){
        if($this->session->userdata('user_info')['id'] == ''){
        	$this->session->set_flashdata('message','<div class="alert alert-danger">Your session has expired.</div>');
			redirect('login');
		}else{
			$id = $this->session->userdata('user_info')['id'];
			$password = $this->input->post("pwd");
			$user_data = $this->LoginModel->validate_userid($id);
			$dbpass = $user_data['password'];
			$dbpassword = $this->encryption->decrypt($dbpass);

			if($dbpassword == $password){
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Incorect login credentials please login.</div>');
				redirect('login');
			}
		}
    }

    // logout
    public function logout(){
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Logged Out",
			'status' => true,
			'description' => "",
			'user_category' => "admin",
			'channel' => "Web"
		  );
		  $audit_tray = audit_tray($info);
        $this->session->sess_destroy();
        redirect('login');
    }
}
