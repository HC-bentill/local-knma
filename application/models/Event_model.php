<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get event categories and display on the event page 
	public function get_categories(){
		$bank = $this->db->query("SELECT * FROM event_category order by categoryid asc")->result();
		return($bank);
	}

//	get events and display on the event page 
	public function get_event($role,$orgid){
		if($role == "Super-Administrator"){
			$event = $this->db->query("SELECT a.agencycode, e.eventname, c.category_name, e.location, e.date, e.time, e.enddate, e.eventid FROM event e left join event_category c on e.eventcategory = c.categoryid left join agency a on e.agencyid =  a.agencyid")->result();
			return($event);
		}
		else{
			$event = $this->db->query("SELECT a.agencycode, e.eventname, c.category_name, e.location, e.date, e.time, e.enddate, e.eventid FROM event e left join event_category c on e.eventcategory = c.categoryid left join agency a on e.agencyid =  a.agencyid where e.agencyid = '$orgid'")->result();
			return($event);
		}
	}

//	get event details from db
	public function get_event_details($a){
		$event = $this->db->query("SELECT * FROM event e left join event_category c on e.eventcategory = c.categoryid where e.eventid = '$a'")->row_array();
		return($event);
	}

//	get ticket details from db
	public function ticketcost($a){
		$ticket = $this->db->query("SELECT * FROM ticketcost where eventid = '$a'")->result();
		return($ticket);
	}

//	get event images from db
	public function eventimage($a){
		$eventimg = $this->db->query("SELECT * FROM eventimages where eventid = '$a'")->result();
		return($eventimg);
	}

// insert event
    public function add_event($data){
       $insert = $this->db->insert('event',$data);
	   return($insert);	
    }

// insert event ticket cost
    public function add_ticketcost($data){
       $insert = $this->db->insert('ticketcost',$data);
	   return($insert);	
    }

// insert ticket cost
    public function add_eventimages($data){
       $insert =$this->db->insert('eventimages',$data);
	   return($insert);	
    }

//	delete a member details
	 public function delete_event($id){
       $delete = $this->db->query("DELETE from event WHERE eventid = '$id'");
       return($delete);
    }
	
		// update category
    public function update_bank($data,$id){
      
        $this->db->where($id);
        $this->db->update('bank',$data);
    }
}