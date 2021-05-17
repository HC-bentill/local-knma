<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get event categories and display on the event categories page 
	public function get_categories(){
		$bank = $this->db->query("SELECT * FROM event_category order by categoryid asc")->result();
		return($bank);
	}
	
	// update category
    public function update_category($data,$id){
      
        $this->db->where($id);
        $this->db->update('event_category',$data);
    }
	
	 // insert category
    public function add_category($data){
        $this->db->insert('event_category',$data);
	
    }
	
	//	delete a category
	 public function delete_category($data){
		 
        $this->db->query("DELETE from event_category WHERE categoryid =$data ");
    }  
	
	//	get user details to be editted from db
	public function get_category($a){
		
		$my_own_query = "SELECT * FROM event_category where categoryid = '$a'";
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