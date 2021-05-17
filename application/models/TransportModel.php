<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TransportModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }


//	get area councils and display on the add transport form.
	public function get_area_councils(){
		$this->db->select('id,name');
		$this->db->from('area_council');
	    return $this->db->get()->result();
	}

//	get transport meduim and display on the add transport form.
	public function get_transport_meduim(){
		$this->db->select('id,meduim');
		$this->db->from('transport_meduim');
	  return $this->db->get()->result();
	}

//	get make and display on the add transport form.
	public function get_make(){
		$this->db->select('id,make');
		$this->db->from('make');
	  return $this->db->get()->result();
	}


}
