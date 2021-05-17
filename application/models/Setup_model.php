<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }
	
// update password
    public function update_password($data,$id){
      
        $this->db->where($id);
        $this->db->update('users',$data);
    }

// update password
    public function setting($a){
       $setting = $this->db->query("SELECT * from agency where agencyid = $a")->row_array();
       return($setting);
    }
	
// update user
    public function update_user($data,$id){
      
        $this->db->where($id);
        $this->db->update('users',$data);
    }

// update agency
    public function update_agency($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('agency',$data);
        return($update);
    }

// insert hospital/clinic
    public function add_hospital($data){
        $insert = $this->db->insert('hospital',$data);
        return($insert);
    
    }

// insert specimen
    public function add_specimen($data){
        $insert = $this->db->insert('specimen',$data);
        return($insert);
    
    }

// insert specimen
    public function add_commonresult($data){
        $insert = $this->db->insert('commonresults',$data);
        return($insert);
    
    }

// update category
    public function update_oldhospital($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('labtest',$data);
        return ($update);
    }

// update category
    public function update_oldspecimen($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('labtest',$data);
        return ($update);
    }

// update category
    public function update_specimen($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('specimen',$data);
        return ($update);
    }

// update discount
    public function update_discount($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('discount',$data);
        return ($update);
    }

// update hospital
    public function update_hospital($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('hospital',$data);
        return ($update);
    }


//  delete hospital
     public function delete_hospital($hos_data,$data){
         
        $this->db->where($hos_data);
        $this->db->update('hospital',$data);
    }

//  delete hospital
     public function delete_commonresult($hos_data,$data){
         
        $this->db->where($hos_data);
        $this->db->update('commonresults',$data);
    }

//  delete specimen
     public function delete_specimen($spe_data,$data){
         
        $this->db->where($spe_data);
        $this->db->update('specimen',$data);
    }

//  get hospital details to be editted from db
    public function get_hos_detail($a){
        
        $my_own_query = "SELECT * FROM hospital where hosid = '$a'";
        $query = $this->db->query($my_own_query);
        $result = $query->result_array();
        echo json_encode($result);
        
        return($result);    
    }


//  get hospital details to be editted from db
    public function get_spe_detail($a){
        
        $my_own_query = "SELECT * FROM specimen where speid = '$a'";
        $query = $this->db->query($my_own_query);
        $result = $query->result_array();
        echo json_encode($result);
        
        return($result);    
    }

//  get hospitals and display on the hospitals page 
    public function get_hospital(){
        $hospital = $this->db->query("SELECT * FROM hospital WHERE delete_status = 'A' order by hosid asc")->result();
        return($hospital);
    }

//  get hospitals and display on the hospitals page 
    public function get_commonresult(){
        $hospital = $this->db->query("SELECT * FROM commonresults WHERE deletestatus = 'A' order by resid asc")->result();
        return($hospital);
    }


// update sub-category details
    public function update_commonresult($data,$id){
      
        $this->db->where($id);
        $update = $this->db->update('commonresults',$data);
        return ($update);
    }

//  get insurance details to be editted from db
    public function get_commonresult_detail($a){
        
        $my_own_query = "SELECT * FROM commonresults where resid = '$a'";
        $query = $this->db->query($my_own_query);
        $result = $query->result_array();
        echo json_encode($result);
        
        return($result);    
    }
    

//  get specimen and display on the specimen page 
    public function get_specimen(){
        $specimen = $this->db->query("SELECT * FROM specimen WHERE delete_status = 'A' order by speid asc")->result();
        return($specimen);
    }

}