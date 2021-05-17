<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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


	public function dashboard(){
		$this->session->set_userdata('last_page', 'dashboard');
		//exit($this->session->userdata('user_info')['id']);
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'), TRUE);
		$data = array(
			'title' => 'Dashboard',
			'page' => 'dashboard/dashboard',
		);

		$this->load_page($data);
	}

	public function dashboard1(){

		$this->load->view("dashboard/dashboard1");
	}
	
	// public function dashboard()
	// {
	// 	$this->session->set_userdata('last_page', 'dashboard');
	// 	//exit($this->session->userdata('user_info')['id']);
	// 	$breadCrumbs = buildBreadCrumb(
	// 		array('label' => 'Dashboard', 'url' => 'dashboard'),
	// 		TRUE
	// 	);
	// 	$data = array(
	// 		'title' => 'Dashboard',
	// 		'page' => 'dashboard/dashboard',
	// 	);

	// 	$this->load_page($data);
	// }

	public function revenue_dashboard()
	{
		$this->session->set_userdata('last_page', 'dashboard');
		//exit($this->session->userdata('user_info')['id']);
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
		);

		$this->load_page($data);
	}

	// public function dashboard1()
	// {

	// 	$this->load->view("dashboard/dashboard1");
	// }

	public function chart_today()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_daily_revenue())) ? get_daily_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}

	public function chart_current_week()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		// $month_ago = new DateTime('now');
		// $month_ago->modify('1 month ago');
		// $month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_week_revenue())) ? get_week_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	public function chart_past_seven_days()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		// $month_ago = new DateTime('now');
		// $month_ago->modify('1 month ago');
		// $month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_lastweek_revenue())) ? get_lastweek_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}

	public function chart_current_month()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		// $month_ago = new DateTime('now');
		// $month_ago->modify('1 month ago');
		// $month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_month_revenue())) ? get_month_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	public function chart_last_month()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$month_ago = new DateTime('now');
		$month_ago->modify('1 month ago');
		$month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_lastmonth_revenue())) ? get_lastmonth_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	
	public function get_last_3_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_last_3_month_revenue())) ? get_last_3_month_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}

	public function get_last_6_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'total_rev_buttons' => (!empty(get_last_6_month_revenue())) ? get_last_6_month_revenue() : 0,
		);

		$this->load_page($data);
	}

	// Collectors

	public function get_collectors_daily_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_daily_revenue())) ? get_collectors_daily_revenue() : 0,
		);

		$this->load_page($data);
	}

	public function get_collectors_week_revenue()
	{
		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_week_revenue())) ? get_collectors_week_revenue() : 0,
		);

		$this->load_page($data);
	}

	public function collectors_chart_past_seven_days()
	{
		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
	
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_lastweek_revenue())) ? get_collectors_lastweek_revenue() : 0,
		);

		$this->load_page($data);
	}

	public function collectors_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$month_ago = new DateTime('now');
		$month_ago->modify('1 month ago');
		$month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_month_revenue())) ? get_collectors_month_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	public function collectors_lastmonth_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$month_ago = new DateTime('now');
		$month_ago->modify('1 month ago');
		$month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_lastmonth_revenue())) ? get_collectors_lastmonth_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	
	public function collectors_last_3_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_last_3_month_revenue())) ? get_collectors_last_3_month_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}

	public function collectors_last_6_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => (!empty(get_collectors_last_6_month_revenue())) ? get_collectors_last_6_month_revenue() : 0,
		);

		$this->load_page($data);
	}

	// streams

	public function streams_daily_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(get_collectors_daily_revenue())) ? get_collectors_daily_revenue() : 0,
		);

		$this->load_page($data);
	}

	public function streams_week_revenue()
	{
		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'collectors_chat_btn' => streams_week_revenue()
		);

		$this->load_page($data);
	}

	public function streams_chart_past_seven_days()
	{
		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
	
		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(streams_chart_past_seven_days())) ? streams_chart_past_seven_days() : 0,
		);

		$this->load_page($data);
	}

	public function streams_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$month_ago = new DateTime('now');
		$month_ago->modify('1 month ago');
		$month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(streams_month_current_revenue())) ? streams_month_current_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	public function streams_lastmonth_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);
		$month_ago = new DateTime('now');
		$month_ago->modify('1 month ago');
		$month_ago = $month_ago->format('Y-m-d');

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(streams_lastmonth_revenue())) ? streams_lastmonth_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}
	
	public function streams_last_3_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(streams_last_3_month_revenue())) ? streams_last_3_month_revenue() : 0,
		);

		$this->load_page($data);
		// $this->load->view("dashboard/dashboard",$data);
	}

	public function streams_last_6_month_revenue()
	{

		$this->session->set_userdata('last_page', 'dashboard');
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Dashboard', 'url' => 'dashboard'),
			TRUE
		);

		$data = array(
			'title' => 'Revenue Dashboard',
			'page' => 'dashboard/revenue_dashboard',
			'streams_chat_btn' => (!empty(streams_last_6_month_revenue())) ? streams_last_6_month_revenue() : 0,
		);

		$this->load_page($data);
	}
}
