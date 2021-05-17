<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Channelmodel');
		$this->load->helper('url');
		$this->load->helper('html');
		
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
	
//	load commission page
	
	public function commission(){
		
			$data = array(
				'title' => 'Development',
				'page' => 'permission/underdev'

			);
			$this->load_page($data);
	}

}