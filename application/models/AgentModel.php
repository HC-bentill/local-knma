<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AgentModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get area councils and display on the agent form.
	public function get_area_councils(){
		$this->db->select('id,name');
		$this->db->from('area_council');
	    return $this->db->get()->result();
	}

//	get last area council code
	public function agentnumber(){
		$this->db->select('id');
		$this->db->from('agent');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
    $data = $this->db->get();
    $code = $data->row_array()['id'];
    $result= $code + 1;
    $number = 0 + 1;
    if ($data->num_rows() == 0) {
        return $number;
    }else{
        return $result;
    }
	}

	//	get educational level and display on the agent form.
	public function get_edu(){
		$this->db->select('id,level');
		$this->db->from('education');
	    return $this->db->get()->result();
	}

	//	get agent from db
	public function get_agent(){
		$artisan = $this->db->query("SELECT * FROM agent")->result();
		return($artisan);
	}

	//	get member details from db
	public function get_member_details($a){
		$member = $this->db->query("SELECT * FROM members m left join profession p on m.profession = p.id left join ministry w on m.ministry = w.id left join educational_level e on m.edu_level = e.id left join position t on m.position = t.id left join grp g on m.group = g.id left join cells c on m.cell = c.id WHERE memid = $a")->row_array();
		return($member);
	}
	//	add new agent to db
	public function add_agent($a){
		$insert = $this->db->insert('agent',$a);
		return($insert);
	}

	//	get agent details to be editted from db
	public function fetch_agent_data($a){

		$my_own_query = "SELECT * FROM agent where agentid = '$a'";
		$query = $this->db->query($my_own_query);

		$result = $query->result_array();
		echo json_encode($result);

		return($result);


    }

    //	confirm agent details
	 public function confirm_agent($data,$id){
        $this->db->where($id);
       $update = $this->db->update('agent',$data);
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

  // validate user
  public function validate_user($user){
      $data = array(
          'lower(agent_code)' => $user
      );
      $this->db->where($data);
      return $this->db->get('agent')->row_array();
  }

   // validate user
  public function validate_userid($id){
      $data = array(
          'id' => $id,
          'delete_status' => 1,
//            'password' => $password
      );
      $this->db->where($data);
      return $this->db->get('agency_users')->row_array();
  }

public function validate_pass($dbpassword,$pass,$user){
     if($dbpassword == $pass){
     $data = array(
          'lower(agent_code)' => $user,
      );
      $this->db->where($data);
      return $this->db->get('agent')->result_array();
   }

  }
}
