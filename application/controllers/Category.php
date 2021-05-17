 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
		$this->load->helper('url');
		$this->load->helper('html');
		
		if($this->session->userdata('user_info')['user_id'] == ''){
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
	
//	load category page
	
	public function category(){
		$data = array(
			'title' => 'Event Categories',
			'page' => 'category/category',
			'result' => $this->Category_model->get_categories(),
		);
		
		$this->load_page($data);
	}
	
	// delete category
	public function delete_category(){
		
		$categoryid= $this->uri->segment(3);
		if($this->Category_model->delete_category($categoryid)){
			echo json_encode($categoryid);
		}	
	}

	
	//	get category details
	public function get_category(){
		$categoryid = $this->uri->segment(3);
		$get_category = $this->Category_model->get_category($categoryid);
	}
	
	//	update category details
	public function update_category(){
		$categoryname = $this->input->post('categoryname');
		$description = $this->input->post('description');
		$categoryid = $this->input->post('categoryid');
		
		$data = array(
			'category_name' => $categoryname,
			'description' => $description,
		);
		
		$id = array(
			'categoryid' => $categoryid,
		);
		$update_category = $this->Category_model->update_category($data,$id);
		redirect('category');	
	}


	//	add new category
	public function add_category(){
		$categoryname = trim($this->input->post('categoryname'));
		$description = trim($this->input->post('description'));
		$data = array(
			'category_name'=> $categoryname,
			'description' => $description,
		);
				$insert = $this->Category_model->add_category($data);
					if(!$insert){
						
					}
				    else{
						
					}
		redirect('category');
				
	}

}