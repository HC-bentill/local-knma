<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
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
		if(has_permission($this->session->userdata('user_info')['id'],'create product')){
			$data = array(
				'title' => 'Development',
				'page' => 'permission/underdev'

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

//	load create product page

    public function add_product(){

        //set last page session
        $this->session->set_userdata('last_page', 'add_product');
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Product Creation",
            "url" => "add_product"
        ), TRUE);
        
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_product',
            );

        }else{
            $data = array(
                'title' => 'Permission',
                'page' => 'permission/error'

            );
        }
        $data['breadCrumbs'] = $breadCrumbs;
        $this->load_page($data);
    }

    public function add_category1(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 1",
            "url" => "add_category1"
        ));

        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category1',
                'products' => $this->ProductModel->get_products(),
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

    public function add_category2(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 2",
            "url" => "add_category2"
        ));
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category2',
                'products' => $this->ProductModel->get_products(),
                'category1_list' => $this->ProductModel->get_category1('1'),
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

    public function add_category3(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 3",
            "url" => "add_category3"
        ));
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category3',
                'products' => $this->ProductModel->get_products(),
                'category1_list' => $this->ProductModel->get_category1('1'),
                'category2_list' => $this->ProductModel->get_category('2','1'),
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

    public function add_category4(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 4",
            "url" => "add_category4"
        ));
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category4',
                'products' => $this->ProductModel->get_products(),
                'category1_list' => $this->ProductModel->get_category1('1'),
                'category2_list' => $this->ProductModel->get_category('2','1'),
                'category3_list' => $this->ProductModel->get_category('3','1'),
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

    public function add_category5(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 5",
            "url" => "add_category5"
        ));
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category5',
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

    public function add_category6(){
        $breadCrumbs = buildBreadCrumb(array(
            "label" => "Category 6",
            "url" => "add_category6"
        ));
        if(has_permission($this->session->userdata('user_info')['id'],'create product')){
            $data = array(
                'title' => 'Product Creation',
                'page' => 'product/add_category6',
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

    public function edit_product($id){

        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $data = array(
                'title' => 'Edit Product',
                'page' => 'product/edit_product',
                'result' => $this->ProductModel->get_product($id),
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

    //	load edit catx page
    public function edit_catx($x, $id){
        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $catx_class = $this->ProductModel->get_category_x($id, $x); //product_id of selected item(category x)
            $product_id =  $catx_class[0] ->product_id;
            $data = array(
                'title' => 'Edit Product'.$x,
                'page' => 'product/edit_cat'.$x,
                'result' => $this->ProductModel->get_category_x($id, $x),
                'products' => $this->ProductModel->get_products(),
                'category1_list' => $this->ProductModel->get_category1($product_id)
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

    //	load edit cat3 page
    public function edit_cat3($id){
        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $data = array(
                'title' => 'Edit Product3',
                'page' => 'product/edit_cat3',
                'result' => $this->ProductModel->get_category_3($id)
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

    //	load edit cat4 page
    public function edit_cat4($id){
        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $data = array(
                'title' => 'Edit Product4',
                'page' => 'product/edit_cat4',
                'result' => $this->ProductModel->get_category_4($id)
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

    //	load edit cat5 page
    public function edit_cat5($id){
        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $data = array(
                'title' => 'Edit Product5',
                'page' => 'product/edit_cat5',
                'result' => $this->ProductModel->get_category_5($id)
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

    //	load edit cat5 page
    public function edit_cat6($id){
        if(has_permission($this->session->userdata('user_info')['id'],'manage product')){
            $data = array(
                'title' => 'Edit Product6',
                'page' => 'product/edit_cat6',
                'result' => $this->ProductModel->get_category_6($id)
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
    public function insert_product() {
        $productname = $this->input->post("productname");

        $data = array(
            "name"=> $productname,
        );

        if( $this->ProductModel->add_product($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added a product",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_product');
    }

    public function update_product() {
        $id = $this->input->post("id");
        $productname = $this->input->post("productname");

        $data = array(
            "name"=> $productname
        );

        if( $this->ProductModel->update_product($data, $id) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product name",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_product/'.$id);
    }

    public function update_cat1() {
        $id = $this->input->post("id");
        $cat1name = $this->input->post("cat1name");

        $data = array(
            "name"=> $cat1name
        );

        if( $this->ProductModel->update_catx($data, $id, 1) ){
             // insert into audit tray
             $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 1",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat1/'.$id);
    }

    public function update_cat2() {
        $id = $this->input->post("id");
        $cat2name = $this->input->post("cat2name");

        $data = array(
            "name"=> $cat2name
        );

        if( $this->ProductModel->update_catx($data, $id, 2) ){
            // insert into audit tray
             $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 2",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat2/'.$id);
    }

    public function update_cat3() {
        $id = $this->input->post("id");
        $cat3name = $this->input->post("cat3name");

        $data = array(
            "name"=> $cat3name
        );

        if( $this->ProductModel->update_catx($data, $id, 3) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 3",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat3/'.$id);
    }

    public function update_cat4() {
        $id = $this->input->post("id");
        $cat4name = $this->input->post("cat4name");

        $data = array(
            "name"=> $cat4name
        );

        if( $this->ProductModel->update_catx($data, $id, 4) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 4",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat4/'.$id);
    }

    public function update_cat5() {
        $id = $this->input->post("id");
        $cat5name = $this->input->post("cat5name");

        $data = array(
            "name"=> $cat5name
        );

        if( $this->ProductModel->update_catx($data, $id, 5)){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 5",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat5/'.$id);
    }

    public function update_cat6() {
        $id = $this->input->post("id");
        $cat6name = $this->input->post("cat6name");
        $frequency = $this->input->post("frequency");
        $unit_of_measure = $this->input->post("unit_of_measure");
        $price1 = $this->input->post("price1");
        $price2 = $this->input->post("price2");
        $price3 = $this->input->post("price3");
        $price4 = $this->input->post("price4");

        $data = array(
            "name"=> $cat6name,
            "frequency"=> $frequency,
            "unit_of_measure"=> $unit_of_measure,
            "price1"=> $price1,
            "price2"=> $price2,
            "price3"=> $price3,
            "price4"=> $price4
        );

        if( $this->ProductModel->update_catx($data, $id, 6)){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Edited product category 6",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'edit_cat6/'.$id);
    }

    public function insert_category1(){
        $product_id = $this->input->post("productname");
        $category1_name = $this->input->post("category1_name");

        $data = array(
            "product_id"=> $product_id,
            "name"=> $category1_name,
        );

        if( $this->ProductModel->add_category1($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 1",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category1');
    }

    public function insert_category2(){
        $product_id = $this->input->post("productname");
        $category1_id = $this->input->post("category1_name");
        $category2_name = $this->input->post("category2_name");

        $data = array(
            "product_id"=> $product_id,
            "category1_id"=> $category1_id,
            "name"=> $category2_name,
        );

        if( $this->ProductModel->add_category2($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 2",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category2');
    }

    public function insert_category3(){
        $product_id = $this->input->post("productname");
        $category2_id = $this->input->post("category2_name");
        $category3_name = $this->input->post("category3_name");

        $data = array(
            "product_id"=> $product_id,
            "category2_id"=> $category2_id,
            "name"=> $category3_name,
        );

        if( $this->ProductModel->add_category3($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 3",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category3');
    }

    public function insert_category4(){
        $product_id = $this->input->post("productname");
        $category3_id = $this->input->post("category3_name");
        $category4_name = $this->input->post("category4_name");

        $data = array(
            "product_id"=> $product_id,
            "category3_id"=> $category3_id,
            "name"=> $category4_name,
        );

        if( $this->ProductModel->add_category4($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 4",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category4');
    }

    public function insert_category5(){
        $product_id = $this->input->post("productname");
        $category4_id = $this->input->post("category4_name");
        $category5_name = $this->input->post("category5_name");

        $data = array(
            "product_id"=> $product_id,
            "category4_id"=> $category4_id,
            "name"=> $category5_name,
        );

        if( $this->ProductModel->add_category5($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 5",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category5');
    }

    public function insert_category6(){
        $product_id = $this->input->post("productname");
        $category5_id = $this->input->post("category5_name");
        $category6_name = $this->input->post("category6_name");
        $frequency = $this->input->post("frequency");
        $unit_of_measure = $this->input->post("unit_of_measure");
        $price1 = $this->input->post("price1");
        $price2 = $this->input->post("price2");
        $price3 = $this->input->post("price3");
        $price4 = $this->input->post("price4");

        $data = array(
            "product_id"=> $product_id,
            "category5_id"=> $category5_id,
            "name"=> $category6_name,
            "frequency"=> $frequency,
            "unit_of_measure"=> $unit_of_measure,
            "price1"=> $price1,
            "price2"=> $price2,
            "price3"=> $price3,
            "price4"=> $price4
        );

        if( $this->ProductModel->add_category6($data) ){
            // insert into audit tray
            $info = array(
                'user_id' => $this->session->userdata('user_info')['id'],
                'activity' => "Added product category 6",
                'status' => true,
                'description' => "",
                'user_category' => "admin",
                'channel' => "Web"
            );
            $audit_tray = audit_tray($info);
            //end of insert
            $this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  Success, The Form was submitted successfully.
                </div>");
        }

        redirect(base_url().'add_category6');
    }

//	load view all products page
	public function view_all_products(){

        //set last page session
        $this->session->set_userdata('last_page', 'view_product');
        buildBreadCrumb(array(
            "url" => "view_all_products",
            "label" => "View Product"
        ), TRUE);
        
        if(has_permission($this->session->userdata('user_info')['id'],'view product')){
			$data = array(
				'title' => 'View Product',
				'page' => 'product/view_all_products'
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

//	load view product
    public function view_product($id){
        $data = array(
            'title' => 'View Product',
            'page' => 'product/view_product',
            'result' => $this->ProductModel->get_product($id)
        );
        $this->load_page($data);
    }

    //	load view catx page
    public function view_catx($x, $id){
        $data = array(
            'title' => 'View Category'.$x,
            'page' => 'product/view_cat'.$x,
            'result' => $this->ProductModel->get_category_x($id, $x)
        );
        $this->load_page($data);
    }

    //	load view cat3 page
    public function view_cat3($id){
        $data = array(
            'title' => 'View Category3',
            'page' => 'product/view_cat3',
            'result' => $this->ProductModel->get_category_3($id)
        );
        $this->load_page($data);
    }

    //	load view cat4 page
    public function view_cat4($id){
        $data = array(
            'title' => 'View Category4',
            'page' => 'product/view_cat4',
            'result' => $this->ProductModel->get_category_4($id)
        );
        $this->load_page($data);
    }

    //	load view cat5 page
    public function view_cat5($id){
        $data = array(
            'title' => 'View Category5',
            'page' => 'product/view_cat5',
            'result' => $this->ProductModel->get_category_5($id)
        );
        $this->load_page($data);
    }

    //	load view cat6 page
    public function view_cat6($id){
        $data = array(
            'title' => 'View Category6',
            'page' => 'product/view_cat6',
            'result' => $this->ProductModel->get_category_6($id)
        );
        $this->load_page($data);
    }

    // get category1 list for ajax
    public function get_category1(){
        // POST data
        $product_id = $this->input->post("product_id");
        // get data
        $data = $this->ProductModel->get_category1($product_id);
        echo json_encode($data);
    }

    // get categoryx list for ajax
    public function get_category(){
        // POST data
        $cat_id = $this->input->post("cat_id");
        $cat_column_id = $this->input->post("cat_column_id");
        // get data
        $data = $this->ProductModel->get_category($cat_column_id,$cat_id);
        echo json_encode($data);
    }

    //get Product name from product id
    function get_product_name($id){
        // POST data
        $product_id = $this->input->post("product_id");
        // get data
        $data = $this->ProductModel->get_product_name($product_id);
        return $data;
    }

// get property owners ajax call
    public function productList(){
        // POST data
        $postData = $this->input->post();

        // Get data
        $data = $this->ProductModel->getProduct($postData);

        echo json_encode($data);
    }

}