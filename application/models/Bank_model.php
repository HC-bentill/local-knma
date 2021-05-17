<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get banks and display on the banks page 
	public function get_banks(){
		$bank = $this->db->query("SELECT * FROM bank WHERE delete_status = 'A' order by bankid asc")->result();
		return($bank);
	}
	
		// update category
    public function update_bank($data,$id){
      
        $this->db->where($id);
        $this->db->update('bank',$data);
    }
	
	 // insert category
    public function add_bank($data){
        $this->db->insert('bank',$data);
	
    }
	
		//	delete a category
	 public function delete_bank($bank_data,$data){
		 
        $this->db->where($bank_data);
        $this->db->update('bank',$data);
    }  
	
	//	get user details to be editted from db
	public function get_bank($a){
		
		$my_own_query = "SELECT * FROM bank where bankid = '$a'";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);
		
		return($result);	
    }


    //redraw table with bank detail
    public function fetch_banks(){
        
        $my_own_query = "select * from bank WHERE delete_status='Active' order by bankid asc";
        $query = $this->db->query($my_own_query);
        
        $result = $query->result_array();
        echo json_encode($result);  
    }
}