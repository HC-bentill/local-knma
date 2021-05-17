<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransportModel',"res");
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

//	load add business occupant page

	public function add_transport_form(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_transport');

		if(has_permission($this->session->userdata('user_info')['id'],'create transport')){
			$data = array(
				'title' => 'Transport Creation',
				'page' => 'transport/add_transport',
					'area' => $this->res->get_area_councils(),
					'transport_meduim' => $this->res->get_transport_meduim(),
					'make' => $this->res->get_make()
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
