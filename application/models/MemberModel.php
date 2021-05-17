<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MemberModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

	//	get clients from db
	public function get_members(){
		$members = $this->db->query("SELECT * FROM membership")->result();
		return($members);
	}

	// update client account activation
	public function update_accactivation($memberid,$state){
			
		$my_own_query = "Update membership set acc_activation = '$state' where memberid = '$memberid'";
		$query = $this->db->query($my_own_query);		
	}

	//	get member details from db
	public function get_member_details($a){
		$member = $this->db->query("SELECT * FROM members m left join profession p on m.profession = p.id left join ministry w on m.ministry = w.id left join educational_level e on m.edu_level = e.id left join position t on m.position = t.id left join grp g on m.group = g.id left join cells c on m.cell = c.id WHERE memid = $a")->row_array();
		return($member);
	}
	//	add new member to db
	public function add_member($a){
		$insert = $this->db->insert('members',$a);
		return($insert);
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
}