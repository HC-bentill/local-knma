<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penalty extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('ProductModel');
		$this->load->model('PenaltyModel');
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
	
    //	page structure
	public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }
	
    //	load product page
	public function product(){
    
        $data = array(
            'title' => 'Development',
            'page' => 'permission/underdev'

        );
        $this->load_page($data);

	}

    //	load create product page
    public function add_penalty(){

        //set last page session
        $this->session->set_userdata('last_page', 'add_penalty');
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Penalty Creation",
            "url" => "add_penalty"
        ), TRUE);
        
        if(has_permission($this->session->userdata('user_info')['id'],'add penalty')){
            $data = array(
                'title' => 'Penalty Creation',
                'page' => 'penalty/add_penalty',
                'products' => $this->ProductModel->get_products(),
                'category1_list' => $this->ProductModel->get_category1('1'),
                'category2_list' => $this->ProductModel->get_category('2','1'),
                'category3_list' => $this->ProductModel->get_category('3','1'),
                'category4_list' => $this->ProductModel->get_category('4','1'),
                'category5_list' => $this->ProductModel->get_category('5','1'),
            );

        }else{
            $data = array(
                'title' => 'Permission',
                'page' => 'permission/error'

            );
        }
        $data['bread_crumbs'] = $breadCrumbs;
        $this->load_page($data);
    }


    public function insert_penalty() {
        $productid = $this->input->post("productname");
        $penalty_mode = $this->input->post("penalty_mode");
        $subcat_level = $this->input->post("subcat_level");
        $apply = $this->input->post('apply');
        if($apply == 'apply'){
            $subcat_id = $this->input->post("category".$subcat_level."_name");
        }else{
            $subcat_id = "";
        }

        if($penalty_mode == 'Fixed') {
            $amount = $this->input->post("amount");
            $percentage = "";
        }else if($penalty_mode == 'Percentage'){
            $percentage = $this->input->post("percentage");
            $amount = "";
        }else if($penalty_mode == 'Fixed_Percentage'){
            $percentage = $this->input->post("fp_percentage");
            $amount = $this->input->post("fp_amount");
        }else{
            $percentage = "";
            $amount = "";
        }


        $data = array(
            "product_id"=> $productid,
            "penalty_mode"=> $penalty_mode,
            "penalty_amount"=> $amount,
            "penalty_percentage"=> $percentage,
            "subcat_level"=> $subcat_level,
            "subcat_id"=>$subcat_id
        );

        if( $this->PenaltyModel->add_penalty($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added a penalty",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata(
                'message', "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    Success, The Form was submitted successfully.
                </div>"
            );
        }


        redirect(base_url().'add_penalty');
    }

    //	load view penalty page
	public function view_penalty(){

        //set last page session
        $this->session->set_userdata('last_page', 'view_penalty');

        buildBreadCrumb(array(
            "url" => "view_penalty",
            "label" => "View Penalty"
        ), TRUE);

        if(has_permission($this->session->userdata('user_info')['id'],'view penalty')){
			$data = array(
				'title' => 'View Penalty',
				'page' => 'penalty/view_penalty',
                'result' => $this->PenaltyModel->get_penalties()
			);
        }else{
            $data = array(
                'title' => 'Permission',
                'page' => 'permission/error'

            );
        }
        $this->load_page($data);
	}

}