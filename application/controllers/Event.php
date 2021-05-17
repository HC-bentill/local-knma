<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Event_model');
		$this->load->helper('url');
		$this->load->helper('html');

		
		if($this->session->userdata('user_info')['user_id'] == ''){
			redirect('login');
		}

		if($this->session->userdata('user_info')['first_login'] == 0){
			redirect('change_passwordd');
		}
	}
	
	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

	
	public function event(){
		
		$role = $this->session->userdata('user_info')['role'];
		$orgid = $this->session->userdata('user_info')['orgid'];

		$data = array(
			'title' => 'Events',
			'page' => 'event/event',
			'result' => $this->Event_model->get_event($role,$orgid),
			'event' => $this->Event_model->get_categories(),
		);
		
		$this->load_page($data);
	}

	public function date(){
		date_default_timezone_set('Europe/Warsaw');
		$datetime1 = new DateTime('2013-11-01');
		$datetime2 = new DateTime('2013-11-15');
		$interval = $datetime1->diff($datetime2);
		echo $interval->format('%a');;
	}

//	add new event
	public function add_event(){

			$eventname = trim($this->input->post('eventname'));
			$date = trim($this->input->post('date'));
			$enddate = trim($this->input->post('enddate'));
			$eventcategory = trim($this->input->post('eventcategory'));
			$gpostgps = trim($this->input->post('gpostgps'));
			$venue = trim($this->input->post('venue'));
			$location = trim($this->input->post('location'));
			$time = trim($this->input->post('time'));
			$departure_from = trim($this->input->post('departure_from'));
			$arrival_at = trim($this->input->post('arrival_at'));
			$departure_time = trim($this->input->post('departure_time'));
			$posarrival_time = trim($this->input->post('posarrival_time'));
			$origin = trim($this->input->post('origin'));
			$PG = trim($this->input->post('pg'));
			$title = trim($this->input->post('title'));
			$releasedate = trim($this->input->post('releasedate'));
			$thumbnail = trim($this->input->post('thumbnail'));
			$director = trim($this->input->post('director'));
			$cast = trim($this->input->post('cast'));
			$description = trim($this->input->post('description'));
			$ticket = $this->input->post('ticket');

			if($eventcategory == 3)	{
				$data = array(
					'eventname'=> $eventname,
					'date' => $date,
					'enddate' => $enddate,
					'eventcategory' => $eventcategory,
					'gpostgps' => $gpostgps,
					'venue' => $venue,
					'location' => $location,
					'time' => $time,
					'departure_from' => $departure_from,
					'arrival_at' => $arrival_at,
					'departure_time' => $departure_time,
					'posarrival_time' => $posarrival_time,
					'description' => $description,
					'agencyid' => $this->session->userdata('user_info')['orgid'],			
				);
			}elseif($eventcategory == 4){
				$data = array(
					'eventname'=> $eventname,
					'date' => $date,
					'enddate' => $enddate,
					'eventcategory' => $eventcategory,
					'gpostgps' => $gpostgps,
					'location' => $location,
					'venue' => $venue,
					'time' => $time,
					'origin' => $origin,
					'PG' => $PG,
					'title' => $title,
					'releasedate' => $releasedate,
					'thumbnail' => $thumbnail,
					'director' => $director,
					'cast' => $cast,
					'description' => $description,
					'agencyid' => $this->session->userdata('user_info')['orgid'],		
				);
			}else{
				$data = array(
					'eventname'=> $eventname,
					'date' => $date,
					'enddate' => $enddate,
					'eventcategory' => $eventcategory,
					'gpostgps' => $gpostgps,
					'location' => $location,
					'venue' => $venue,
					'time' => $time,
					'description' => $description,
					'agencyid' => $this->session->userdata('user_info')['orgid'],			
				);
			}
			$this->Event_model->add_event($data);
			$id = $this->db->insert_id();

// insert into tickets and cost table
			foreach($ticket as $key => $value){
				$costdata = array(
				'eventid' =>$id,
				'ticket' =>$this->input->post('ticket')[$key],
				'cost' => $this->input->post('cost')[$key],
				);
				$this->Event_model->add_ticketcost($costdata);
			}

// upload multiple event images 
			$config = array();
            $config['upload_path'] = 'upload/event/';
            $config['allowed_types'] = 'xls|xlsx|doc|docx|pdf|JPEG|JPG|txt|gif|jpg|png';
            //$config['max_size'] = '0';
            //$config['overwrite'] = FALSE
            $this->load->library('upload');;

            $files = $_FILES['userfile1']; //- exit(print_r($files));
            $cpt = count($_FILES['userfile1']['name']);
            for ($i = 0; $i < $cpt; $i++) { //echo $files['name'][$i]; exit();
                $name = $files['name'][$i];
                $_FILES['userfile11']['name'] = $name;
                $_FILES['userfile11']['type'] = $files['type'][$i];
                $_FILES['userfile11']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['userfile11']['error'] = $files['error'][$i];
                $_FILES['userfile11']['size'] = $files['size'][$i];

                $this->upload->initialize($config);
                $this->upload->do_upload('userfile11');
                $cfiles = array(
                    'eventid' => $id,
                    'path' => 'upload/event/',
                    'image' => $this->upload->data('file_name'),
                ); //exit(print_r($files));

                $this->Event_model->add_eventimages($cfiles);
                
            }

			redirect('view_event/'.$id);
				
	}

// view event details
	public function view_event(){
		$encrpted_key = $this->uri->segment(2);
                $eventid =base64_decode($encrpted_key);
    		$data = array(
				"page" => 'event/view_event',
				'title' => 'Event Details',
                                'eventid' => $eventid,
				'event' => $this->Event_model->get_event_details($eventid),
				'ticket' =>  $this->Event_model->ticketcost($eventid),
				'eventimage' =>  $this->Event_model->eventimage($eventid),
				'eventcat' => $this->Event_model->get_categories(),
			);
			$this->load_page($data);


	}

// delete this event
	public function delete_event(){
		$id = $this->uri->segment(3);
		$delete =$this->Event_model->delete_event($id);

		if($delete){
			echo 1;
		}
	}

// generate qr code

	public function qrcode(){
		$this->load->library('ciqrcode');

		$params['data'] = 'This is a text to encode become QR Code';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		$this->ciqrcode->generate($params);

		echo '<img src="'.base_url().'tes.png" />';

	}
	
}