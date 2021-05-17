<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

	public function do_session_job($pss_user){
		$hehehe = session_id();

		$my_own_query = "delete from ci_sessions where userid = '$pss_user'";
		$query = $this->db->query($my_own_query);


		$my_own_query = "Update ci_sessions set userid = '$pss_user' where id =  '$hehehe'";
		$query = $this->db->query($my_own_query);
	}
    // validate user
    public function validate_user($user){
        $data = array(
            'lower(username)' => $user,
            'delete_status' => 1,
            'account_status' => 1,
//            'password' => $password
        );
        $this->db->where($data);
        return $this->db->get('users')->row_array();
    }

    // validate user
    public function validate_userr($user){
        $data = array(
            'lower(username)' => $user,
            'delete_status' => 1,
            //'account_status' => 1
//            'password' => $password
        );
        $this->db->where($data);
        return $this->db->get('users')->row_array();
    }

     // validate user
    public function validate_userid($id){
        $data = array(
            'id' => $id,
            'delete_status' => 1,
            'account_status' => 1
//            'password' => $password
        );
        $this->db->where($data);
        return $this->db->get('users')->row_array();
    }

	public function validate_pass($dbpassword,$pass,$user){
       if($dbpassword == $pass){
		   $data = array(
            'lower(username)' => $user,
            'delete_status' => 1,
            'account_status' => 1
        );
		$this->db->where($data);
        return $this->db->get('users')->row_array();
	   }

    }

    public function validate_passs($dbpassword,$pass,$user){
         if($dbpassword == $pass){
  		   $data = array(
              'lower(username)' => $user,
              'delete_status' => 1,
              //'account_status' => 1,
          );
  		$this->db->where($data);
        return $this->db->get('users')->result_array();
  	   }

    }

	public function insert_footsteps($info){
		$this->db->insert('footsteps',$info);
	}



}
