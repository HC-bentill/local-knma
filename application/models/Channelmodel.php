<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channelmodel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get channel and display on the channel manager page 
	public function get_channel(){
		$channel = $this->db->query("SELECT * FROM channels ")->result();
		return($channel);
	}

//	get channel and display on the channel manager page 
	public function get_channel_status($id){
		$channel = $this->db->query("SELECT channelname FROM channels WHERE channelid = $id")->row_array()['channelname'];
		return($channel);
	}	
	
// update account status
	public function update_status($channelid,$state){
			
		$my_own_query = "Update channels set active = '$state' where channelid = '$channelid'";
		$query = $this->db->query($my_own_query);		
	}

//	get channel status
	public function channelstatus($a){
		$status = $this->db->query("SELECT active FROM channels WHERE channelid = $a")->row_array()['active'];
		return($status);
	}	
}