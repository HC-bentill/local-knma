<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');	

class Agency_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get agency type and display on the agency type page 
	public function get_agencytypes(){
		$bank = $this->db->query("SELECT * FROM agencytype order by agency_typeid asc")->result();
		return($bank);
	}

//	get agency and display on the agency page 
	public function get_agency(){
		$agency = $this->db->query("SELECT * FROM agency order by agencyid asc")->result();
		return($agency);
	}

//	get agencies in a particular agency type
	public function get_agencies($a){
		$agency = $this->db->query("SELECT * FROM agency WHERE agencyid = $a")->result();
		return($agency);
	}

//	get agency type
	public function agency_type($a){
		$agencytype = $this->db->query("SELECT agency_typename FROM agencytype WHERE agency_typeid = $a")->row_array()['agency_typename'];
		return($agencytype);
	}	

//	get channel status
	public function channelstatus($a){
		$status = $this->db->query("SELECT active FROM channels WHERE channelid = $a")->row_array()['active'];
		return($status);
	}	
	
// update agency type
    public function update_agencytype($data,$id){
      
        $this->db->where($id);
        $this->db->update('agencytype',$data);
    }

//	get agency details from db
	public function get_agency_details($a){
		$agency = $this->db->query("SELECT a.logo, a.agencyname, a.agencycode, a.location, a.contact, a.email, t.agency_typename, a.weburl, a.description, a.active, a.agencyid FROM agency a left join agencytype t on a.agencytype = t.agency_typeid WHERE agencyid = $a")->row_array();
		return($agency);
	}
	
// insert agency type
    public function add_agencytype($data){
        $this->db->insert('agencytype',$data);
	
    }

// insert agency
    public function add_agency($data){
        $insert = $this->db->insert('agency',$data);
		return($insert);
    }

// save agency login credentials
	public function save_agency_login($data){
		$insert = $this->db->insert('users', $data);
		return($insert);
	}
	
//	delete a agency type
	 public function delete_agencytype($data){
		 
        $this->db->query("DELETE from agencytype WHERE agency_typeid =$data ");
    }  
	
//	get user details to be editted from db
	public function get_agencytype($a){
		
		$my_own_query = "SELECT * FROM agencytype where agency_typeid = '$a'";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);
		
		return($result);	
    }

// update agency status
	public function update_agency_status($agencyid,$state){
			
		$my_own_query = "Update agency set active = '$state' where agencyid = '$agencyid'";
		$query = $this->db->query($my_own_query);
		if($state == 0){
			$this->db->query("Update users set delete_status = 'Del' where orgid = '$agencyid'");
		}else{
			$this->db->query("Update users set delete_status = 'Active' where orgid = '$agencyid'");
		}		
	}

//redraw table with bank detail
    public function fetch_banks(){
        
        $my_own_query = "select * from bank WHERE delete_status='Active' order by bankid asc";
        $query = $this->db->query($my_own_query);
        
        $result = $query->result_array();
        echo json_encode($result);  
    }
}