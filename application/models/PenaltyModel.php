<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PenaltyModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

	//	get penalty from db
	public function get_penalties(){
		$members = $this->db->query("SELECT * FROM penalty")->result();
		return($members);
	}

    //	add new penalty to db
    public function add_penalty($a){
        $insert = $this->db->insert('penalty',$a);
        return($insert);
    }


}