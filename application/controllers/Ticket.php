<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ticket_model');
		$this->load->helper('url');
		$this->load->helper('html');
		
		if($this->session->userdata('user_info')['user_id'] == ''){
			redirect('login');
		}

		if($this->session->userdata('user_info')['first_login'] == 0){
			redirect('change_passwordd');
		}
	}
	
//	page structure
	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }
	
//	load bank page
	
	public function generate_ticket(){
		$ticket = $this->input->post('ticket');
		$eventidd = $this->input->post("eventidd");
		$numbered =  implode(',',$this->input->post("number"));
		$numberedd =  explode(',',$this->input->post("numbered"));

		foreach($ticket as $key => $value){

				$number = $this->input->post("number")[$key]; 
				//exit($number);
				for ($k = 0; $k < $number; $k++) {
					$length = 20;
					$str = "";
					$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
					$max = count($characters) - 1;
					for ($i = 0; $i < $length; $i++) {
						$rand = mt_rand(0, $max);
						$str .= $characters[$rand];
					}
					$ticket = array(
						'eventid' => $this->input->post("eventid")[$key],
						'ticket' => $this->input->post("ticket")[$key],
						'ticketcode' => $str, 
						'barcode' =>"",
						'qrcode' => "",
						'user' => "",
						'sold' => 0,
						'checked' => 0,
					);
					$this->Ticket_model->add_ticket($ticket);
				}
		}
		
		redirect('view_ticket/'.$eventidd);
	}
	

// view ticket details
	public function view_ticket(){
		$encrpted_key = $this->uri->segment(2);
                $eventid =base64_decode($encrpted_key);
    		$data = array(
				"page" => 'ticket/view_ticket',
				'title' => 'Tickets',
				'ticket' =>  $this->Event_model->ticketcost($eventid),
				'sold' =>  $this->Ticket_model->sold($eventid),
				'unsold' =>  $this->Ticket_model->unsold($eventid),
			);
			$this->load_page($data);


	}

// loop
	public function loop(){
		$columns = 5;
		$array  = '5,5,5';
		$arra = explode(',', $array);
		foreach($arra as $aa){
			for ($k = 0 ; $k < $columns; $k++){
				 echo '<td>hello</td><br>'; 
			}
		}
	}
	
}