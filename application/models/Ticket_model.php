<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }


	
// insert ticket
    public function add_ticket($data){
        $this->db->insert('ticket',$data);
	
    }

// tickets sold
    public function sold($data){
        $count = $this->db->query("SELECT * FROM ticket WHERE eventid = '$data' AND sold = '1'")->num_rows();
		return($count);
    }

// tickets unsold
    public function unsold($data){
        $count = $this->db->query("SELECT * FROM ticket WHERE eventid = '$data' AND sold = '0'")->num_rows();
		return($count);
    }
	
}