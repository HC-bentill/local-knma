<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('mixins');

		if($this->session->userdata('user_info')['id'] == ''){

			redirect('login');
		}

		if($this->session->userdata('user_info')['first_login'] == 0){
			redirect('change_passwordd');
		}
	}

	public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }


	public function delete_record(){
		$this->session->set_userdata('last_page', 'delete_record');
		//exit($this->session->userdata('user_info')['id']);
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'delete_record'), TRUE);
		$data = array(
			'title' => 'Delete Records',
			'page' => 'data/delete_record',
		);

		$this->load_page($data);
	}

	public function dashboard1(){

		$this->load->view("dashboard/dashboard1");
	}
}
