<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller {
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
	
//	load bank page
	
	public function channel(){

		//set last page session
		$this->session->set_userdata('last_page', 'channel');
		buildBreadCrumb(array(
			"label" => "Channel",
			"url" => "channel"
		), TRUE);
		if(has_permission($this->session->userdata('user_info')['id'],'manage channels')){
			$data = array(
				'title' => 'Channel Manager',
				'page' => 'channel/channel',
				'result' => $this->Channelmodel->get_channel(),
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

//	update channel status
	public function update_status(){
		$channelid = $this->uri->segment(3);
		$state = $this->uri->segment(4);
		
		$channel = $this->Channelmodel->get_channel_status($channelid);

		if($state == 0){
			$switch = "disabled";
		}else{
			$switch = "enabled";
		}
		// insert into audit tray table
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Updated Channel status",
			'status' => true,
			'description' => "$switch $channel channel",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert
			
		$update = $this->Channelmodel->update_status($channelid,$state);
	}
}