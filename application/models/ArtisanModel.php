<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArtisanModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

	//	get artisan from db
	public function get_artisans(){
		$artisan = $this->db->query("SELECT * FROM artisan")->result();
		return($artisan);
	}

	//	get member details from db
	public function get_member_details($a){
		$member = $this->db->query("SELECT * FROM members m left join profession p on m.profession = p.id left join ministry w on m.ministry = w.id left join educational_level e on m.edu_level = e.id left join position t on m.position = t.id left join grp g on m.group = g.id left join cells c on m.cell = c.id WHERE memid = $a")->row_array();
		return($member);
	}
	//	add new artisan to db
	public function add_artisan($a){
		$insert = $this->db->insert('artisan',$a);
		return($insert);
	}

	//	get artisan details to be editted from db
	public function fetch_artisan_data($a){
		
		$my_own_query = "SELECT * FROM artisan where artid = '$a'";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);
		
		return($result);
		
	
    }

    //	confirm artisan details
	 public function confirm_artisan($data,$id){
        $this->db->where($id);
       $update = $this->db->update('artisan',$data);
       return($update);
    }

	//	update a member details
	 public function update_member($data,$id){
        $this->db->where($id);
       $update = $this->db->update('members',$data);
       return($update);
    }

    //	delete a member details
	 public function delete_member($id){
       $delete = $this->db->query("DELETE from members WHERE memid = '$id'");
       return($delete);
    }

    //	get banks and display on the banks page 
	public function get_jobs(){
		$bank = $this->db->query("SELECT * FROM job WHERE delete_status = 'A' order by jobid asc")->result();
		return($bank);
	}

	
//	get banks and display on the banks page 
	public function get_banks(){
		$bank = $this->db->query("SELECT * FROM bank WHERE delete_status = 'A' order by bankid asc")->result();
		return($bank);
	}
}