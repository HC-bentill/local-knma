 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agency extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agency_model');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('email');
		//$this->load->library('phpmailer');
		
		if($this->session->userdata('user_info')['id'] == ''){
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
	
	//	load agency types page
	public function agencytype(){
		$data = array(
			'title' => 'Agency Types',
			'page' => 'agency/agencytype',
			'result' => $this->Agency_model->get_agencytypes(),

		);
		
		$this->load_page($data);
	}

		
	//	load agency page
	
	public function agency(){
		$data = array(
			'title' => 'Agency',
			'page' => 'agency/agency',
			'result' => $this->Agency_model->get_agency(),
			'type' => $this->Agency_model->get_agencytypes(),
		);
		
		$this->load_page($data);
	}

	// delete agency types
	public function delete_agencytype(){
		
		$agencytypeid= $this->uri->segment(3);
		if($this->Agency_model->delete_agencytype($agencytypeid)){
			echo json_encode($agencytypeid);
		}	
	}

	
	//	get agency types details
	public function get_agencytype(){
		$agencytype = $this->uri->segment(3);
		$get_agencytype = $this->Agency_model->get_agencytype($agencytype);
	}
	
	//	update agency type details
	public function update_agencytype(){
		$agency_typename = $this->input->post('agency_typename');
		$description = $this->input->post('description');
		$agency_typeid = $this->input->post('agency_typeid');
		
		$data = array(
			'agency_typename' => $agency_typename,
			'description' => $description,
		);
		
		$id = array(
			'agency_typeid' => $agency_typeid,
		);
		$update_agencytype = $this->Agency_model->update_agencytype($data,$id);
		redirect('agencytype');	
	}

	
	//	add new agency type
	public function add_agencytype(){
		$agency_typename = trim($this->input->post('agency_typename'));
		$description = trim($this->input->post('description'));
		$data = array(
			'agency_typename'=> $agency_typename,
			'description' => $description,
		);
		$insert = $this->Agency_model->add_agencytype($data);
		if(!$insert){
			
		}else{
			
		}
		redirect('agencytype');
				
	}

	//	add new agency
	public function add_agency(){

		// start of image upload
		$config['upload_path'] = 'upload/agency/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|docx';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$file_path = 'upload/user-avatar.png';
			$error = array('error' => $this->upload->display_errors());
			// $this->session->set_flashdata('message',"<div class='alert alert-danger'>". $error['error']." </div>");
		}
		else{
			$file_path = $config['upload_path'].$this->upload->file_name;

			$data = array('upload_data' => $this->upload->data());
			// $this->session->set_flashdata('message',"<div class='alert alert-success'>The upload was successfull</div>");
		}
		 // end of image upload

		$agencycode = trim($this->input->post('agencycode'));
		$agencyname = trim($this->input->post('agencyname'));
		$contact = trim($this->input->post('contact'));
		$email = trim($this->input->post('email'));
		$location = trim($this->input->post('location'));
		$weburl = trim($this->input->post('weburl'));
		$agencytype = trim($this->input->post('agencytype'));
		$description = trim($this->input->post('description'));

		$data = array(
			'agencycode'=> $agencycode,
			'agencyname' => $agencyname,
			'contact' => $contact,
			'email' => $email,
			'location' => $location,
			'weburl' => $weburl,
			'agencytype' => $agencytype,
			'description' => $description,
			'logo' => $file_path
		);

		$this->Agency_model->add_agency($data);

		// generate password
		$length = 10;
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		$pass = $str;

		$agencydata = array(
			'username' =>$agencycode,
			'password' =>$this->encryption->encrypt($pass),
			'role' => 'Administrator',
			'orgid' =>$this->db->insert_id(),
		);

		// save client login details
		$insert = $this->Agency_model->save_agency_login($agencydata);
		if(!$insert){
			$this->session->set_flashdata('message', "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				Success, The Form was not submitted successfully.
				</div>"
			);
		}
		else{
			// send email if channel is activated and email is provided
			$echannelid = 3;
			$echannel = $this->Agency_model->channelstatus($echannelid);

			if($email != '' && $echannel != 0){
				$subject = "Akwaaba Administrative Sign Up Meessage";
				$message =  'Dear <strong>'. $agencyname.'</strong>, You have successfully signup as an administrator on Akwabaa. Your login credentials are : <br/> username : '.$agencycode.'<br/> password : '.$pass;	
				$this->send_email($email,$message,$subject,$agencyname);
			}
			else{

			}
			$this->session->set_flashdata('message', "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button>
				Success, The Form was submitted successfully.
			</div>");				
		}
		redirect('agency');
		
	}

	

// view agency profile
	public function view_agency(){
		$encrpted_key = $this->uri->segment(2);
		$agencyid =base64_decode($encrpted_key);
		$data = array(
			"page" => 'agency/view_agency',
			'title' => 'Agency Details',
			'agency' => $this->Agency_model->get_agency_details($agencyid),
		);
		$this->load_page($data);

	}

	// view agencies under the given agency category
	public function view_agencies(){
		    $agencyid = $this->uri->segment(2);
		    $header =  $this->Agency_model->agency_type($agencyid);
    		$data = array(
				"page" => 'agency/view_agencies',
				'title' => $header,
				'result' => $this->Agency_model->get_agencies($agencyid),
			);
			$this->load_page($data);

	}

	// email system
	function send_email() {
		
		$to_email = "bklutse20@gmail.com";
		
		require_once APPPATH.'libraries/PHPMailer/class.smtp.php';
    	//require 'PHPMailer/PHPMailerAutoload.php';
		require APPPATH.'libraries/PHPMailer/class.phpmailer.php';
		
		$mail = new PHPMailer;
		// SMTP configuration
		//$mail->isSMTP();
		$mail->Host = 'webpreparations.com';
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 1;  
		$mail->Username = 'test@webpreparations.com';
		$mail->Password = 'test@123+-';
		$mail->SMTPSecure = 'TSL';
		$mail->Port = 21;
		$mail->setFrom('test@webpreparations.com', 'Web Preparations');
		$mail->addReplyTo('test@webpreparations.com', 'Web Preparations');
		// Add a recipient
		$mail->addAddress($to_email);
		$mail->addAddress('test@webpreparations.com');
		// Add cc or bcc 
		$mail->addCC('test@webpreparations.com');
		$mail->addBCC('test@webpreparations.com');
		// Email subject
		$mail->Subject = 'Mail Send By Web Preparations';
		// Set email format to HTML
		$mail->isHTML(true);
		// Email body content
		$mailContent = "<h1>How to send mail using PHPMailer with Attachment</h1>
			<p>“The best preparation for tomorrow is doing your best today.” 
			No one is born successful, success requires preparation .So prepare yourself online at very ease...</p>";

   		$mailContent .= "<a href='http://www.webpreparations.com'><button type='submit' name='send' class='btn btn-info' style='background-color:#449D44; color:#fff; font-weight:bold;height:50px; border:1px;'>Click Here for Visit Web Preparations</button></a>";

		// for send an attatchment    
		$path       = "upload/";
		$file_name  = "webpreparations-1510425974.pdf";
		$mail->Body = $mailContent;
		$mail->addAttachment($path.$file_name);
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		// Send email
		if(!$mail->send())
		{
			echo '<div class="alert alert-danger">Mail could not be sent.</div>';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
		else
		{
			echo '<div class="alert alert-success">Mail has been sent successfully..</div>';
		}
	}

	//	check for similar agent code in the database
	public function search_agencycode(){
		$search_valu = $this->uri->segment(3);
		$search_value = strtolower($search_valu);
		$query = $this->db->query("SELECT * from agency WHERE lower(agencycode) = '$search_value'")->result_array();
		echo json_encode($query);
	}

	//	check for similar agent code in the database
	public function test_send_mail(){
		$this->send_email("bklutse20@gmail.com","This is a test message from php mailer","PHP mailer test","Bright");
	}

	//	update agent status
	public function update_agency_status(){
		$agencyid = $this->uri->segment(3);
		$state = $this->uri->segment(4);
		$update = $this->Agency_model->update_agency_status($agencyid,$state);
	}

	function randomString($length = 10) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		echo $str;
	}
	
}