 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bank_model');
		$this->load->helper('url');
		$this->load->helper('html');
		
		if($this->session->userdata('user_info')['user_id'] == ''){
			redirect('login');
		}
	}
	
//	page structure
	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }
	
//	load bank page
	
	public function bank(){
		$data = array(
			'title' => 'Banks',
			'page' => 'bank/bank',
			'result' => $this->Bank_model->get_banks(),
		);
		
		$this->load_page($data);
	}
	
		// delete bank
	public function delete_bank(){
		
		$bankid= $this->uri->segment(3);
		$bank_data = array(
			'bankid'=>$bankid,
		);
		$data = array(
			'delete_status'=>'Deleted',
		);
		if($this->Bank_model->delete_bank($bank_data,$data)){
			echo json_encode($bank_data);
		}	
	}

	
	//	get category details
	public function get_bank(){
		$bankid = $this->uri->segment(3);
		$get_bank = $this->Bank_model->get_bank($bankid);
	}
	
	//	update bank details
	public function update_bank(){
		$bankname = $this->input->post('bankname');
		$description = $this->input->post('description');
		$bankid = $this->input->post('bankid');
		
		$data = array(
			'bankname' => $bankname,
			'description' => $description,
		);
		
		$id = array(
			'bankid' => $bankid,
		);
		$update_bank = $this->Bank_model->update_bank($data,$id);
		redirect('bank');	
	}

	public function search_bank(){
		$search_value = strtolower($this->input->post('username'));
		$query = $this->db->query("SELECT * from bank WHERE lower(bankname) = '$search_value' AND delete_status = 'Active'")->result_array();
		echo json_encode($query);
	}
	
		//	add new bank
	public function add_bank(){
		$bankname = trim($this->input->post('bankname'));
		$description = trim($this->input->post('description'));
		$data = array(
			'bankname'=> $bankname,
			'description' => $description,
		);
				$insert = $this->Bank_model->add_bank($data);
					if(!$insert){
						
					}
				    else{
						
					}
		redirect('bank');
				
	}

	// draw bank table
	public function load_table(){
		$this->load->helper('url');
		$this->load->helper('html');
		$wow = $this->Bank_model->fetch_banks();
		
		
	}
}