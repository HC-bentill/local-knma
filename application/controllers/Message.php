<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
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

	//	load message page

	public function message(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_mess');
		buildBreadCrumb(array(
			"label" => "Message",
			"url" => "message"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'create message')){
			$data = array(
				'title' => 'Create Message',
				'page' => 'message/create_message',
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

	//	load view message page

	public function view_message(){

		//set last page session
		$this->session->set_userdata('last_page', 'view_mess');
		buildBreadCrumb(array(
			"url" => "view_message",
			"label" => "View Message"
		), TRUE);
		
		if(has_permission($this->session->userdata('user_info')['id'],'view message')){
			$data = array(
				'title' => 'Business Property',
				'page' => 'business/business',
				'start_date' => '',
				'end_date' => '',
				'keyword' => '',
				'search_option' => '',
				'search_by' => 'Date'
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

}
