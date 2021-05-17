<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Channelmodel');
		$this->load->helper('url');
		$this->load->helper('html');

		if($this->session->userdata('user_info')['id'] == ''){
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

	// load users page
	public function users(){

		//set last page session
		$this->session->set_userdata('last_page', 'view_user');
		buildBreadCrumb(array(
			"label" => "Users",
			"url" => "users"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'view user')){
			$data = array(
				'title' => 'Users',
				'result' => $this->User_model->get_users(),
				'page' => 'users/users'

			);
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
			$this->load_page($data);
		}

	}

	// load change password page
	public function change_password(){
			$data = array(
				'title' => 'Change Password',
				'page' => 'users/change_password'

			);
			$this->load_page($data);

	}

	// load add users page
	public function add_user_page(){

		//set last page session
		$this->session->set_userdata('last_page', 'add_user');
		buildBreadCrumb(array(
			"label" => "Create User",
			"url" => "add_user"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'create user')){
			$data = array(
				'title' => 'Create User',
				'page' => 'users/add_user',
				'position' => $this->User_model->get_position(),
			);
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
			$this->load_page($data);
		}


	}

	// load add users page
	public function edit_user_page($id){
		buildBreadCrumb(array(
			"label" => "Edit User",
			"url" => "edit_user/$id"
		));
		if(has_permission($this->session->userdata('user_info')['id'],'manage user')){
			$data = array(
				'title' => 'Edit User',
				'page' => 'users/edit_user',
				'result' => $this->User_model->get_user_details($id),
				'position' => $this->User_model->get_position(),
				'id' => $id

			);
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
			$this->load_page($data);
		}

	}

	// load process change password page
	public function process_change_password(){
		$pass = $this->encryption->encrypt($this->input->post('new_password'));
        $id = $this->session->userdata('user_info')['id'];

		$data = array(
            'password' => $pass,
		);
		$where = array(
            'id' => $id,
		);
		$update = $this->User_model->update_password($data,$where);

        if($update){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Changed password",
				'status' => true,
				'description' => "",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
        	$this->session->set_flashdata('message', "<div class='alert alert-success'>
            	<strong>Success! </strong> Password Successfully Changed, Log in.
          	</div>");
            redirect('login');
        }else{
        	$this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Failure! </strong> Something Went Wrong.
          	</div>");
            redirect('login');
        }

	}

	//	add new user
	public function add_user(){

		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$mobileno = trim($this->input->post('mobileno'));
		$roles = $this->input->post('role');
		$email = $this->input->post('email');
		$position = $this->input->post('position');
		$username = trim($this->input->post('username'));
		$password = random_string();
		$encrypt_password = $this->encryption->encrypt($password);
		$base_url = base_url();
		$sms_message = "You have successfully being created on ". SYSTEM_ID ." Revenue System. Your login details are \nUsername: $username \nPassword: $password \n System link is $base_url";

    $phone_formatted = ((strlen($mobileno) > 10) && substr($mobileno, 0, 3) == '233') ? $mobileno : '233' . substr($mobileno, 1, strlen($mobileno));

		$data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'mobileno' => $mobileno,
			'email' => $email,
			'position' => $position,
			'username'=> $username,
			'password' => $encrypt_password,
		);
		$insert_id = $this->User_model->add_user($data);

		foreach ($this->input->post('role') as $value) {

            $dataa = array(
	            	  'user_id' => $insert_id,
	            	  'role' => $value
	            	);
            $this->User_model->add_user_roles($dataa);
        }
        if($insert_id){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added a user",
				'status' => true,
                'description' => "Added user with username: $username",
                'user_category' => "admin",
                'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
        	send_sms($phone_formatted, $sms_message);
	        $this->session->set_flashdata('message', "<div class='alert alert-success'>
            	<strong>Success! </strong> Your Form Was Submitted.
          	</div>");
	        redirect(base_url().'add_user');
	    }


	}

	//	add new user
	public function edit_user_details(){

		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$mobileno = trim($this->input->post('mobileno'));
		$roles = $this->input->post('role');
		$email = $this->input->post('email');
		$position = $this->input->post('position');
		$username = trim($this->input->post('username'));
		$id = $this->input->post('id');

		$data = array(
					'firstname' => $firstname,
					'lastname' => $lastname,
					'mobileno' => $mobileno,
					'email' => $email,
					'position' => $position,
					'username'=> $username,
				);
		$where = array(
					'id' => $id,
				 );

		$update = $this->User_model->update_user($data,$where);
        if($update){
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Edited user data",
				'status' => true,
				'description' => "Edited user with username: $username",
				'user_category' => "admin",
				'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
			$this->session->set_flashdata('message', "<div class='alert alert-success'>
				<strong>Success! </strong> Your Form Was Submitted.
			</div>");
			redirect(base_url().'edit_user/'.$id);
	    }


	}

	// load system audit page
	public function system_audit(){
		$today = date('Y-m-d');
		//exit($this->session->userdata('user_info')['id']);

		//set last page session
		$this->session->set_userdata('last_page', 'system_audit');
		buildBreadCrumb(array(
			"url" => "system_audit",
			"label" => "System Audit"
		), TRUE);

		if(has_permission($this->session->userdata('user_info')['id'],'system_audit')){
			$data = array(
				'title' => 'System Audit',
				'page' => 'users/system_audit',
				'start_date' => '',
				'end_date' => '',
				'role' =>'',
				'users' =>'',
				'agents' =>'',
				'channel' => '',
				'category' => '',
				'result' => $this->User_model->get_system_audit($today),
				'agent' => $this->User_model->get_agents(),
				'user' => $this->User_model->get_users()
			);
	
			$this->load_page($data);
		}else{
			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
			$this->load_page($data);
		}
	}

	//	add new user
	public function edit_user_roles(){

		$roles = $this->input->post('role');
		$id = $this->input->post('id');

		$delete_existing_roles = $this->User_model->delete_existing_roles($id);
		foreach ($this->input->post('role') as $value) {

            $dataa = array(
	            	  'user_id' => $id,
	            	  'role' => $value
	            	);
            $this->User_model->add_user_roles($dataa);
		}
		// insert into audit tray
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Edited user roles",
			'status' => true,
			'description' => "",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert
		$this->session->set_flashdata('message', "<div class='alert alert-success'>
	            	<strong>Success! </strong> Your Form Was Submitted.
	          	</div>");
        redirect(base_url().'edit_user/'.$id);


	}
	//	get user details
	public function get_user(){
		$userid = $this->uri->segment(3);
		$get_user = $this->User_model->get_user($userid);
	}

	// search users dynamicaly
    public function search_users($val = ''){
        $data['searchValue'] = $val;
        $data = $this->load->view('users/search_user', $data);
        return json_encode($data);
   }

//	check for similar usernames in the database
	public function search_user(){
		$search_valu = $this->uri->segment(3);
		$search_value = strtolower($search_valu);
		$query = $this->db->query("SELECT * from users WHERE lower(username) = '$search_value'")->result_array();
		echo json_encode($query);
	}


//	search for users current password during change of passwords
	public function search_password(){
		$passid = $this->input->post('passid');
		$query = $this->db->query("SELECT * from users WHERE user_id = $passid")->result_array();

		$ss =$query[0]['password'];
		$decrypted = $this->encryption->decrypt($ss);
			$pass = array(
				'password'=>$decrypted
			);
			$realpass = array(
				'realpass'=>$pass
			);



		echo $decrypted;

	}

	// search system audit page
	public function search_system_audit(){

		$start_date = $this->input->post("start_date");
		$end_date = $this->input->post("end_date");
		$role = $this->input->post("role");
		$user = $this->input->post("user");
		$agent = $this->input->post("agent");
		$channel = $this->input->post("channel");
		$category = $this->input->post("category");

		//exit($this->session->userdata('user_info')['id']);
		$data = array(
			'title' => 'System Audit',
			'page' => 'users/system_audit',
      		'js' => 'user/user_js',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'role' => $role,
			'users' => $user,
			'agents' => $agent,
			'channel' => $channel,
			'category' => $category,
			'result' => $this->User_model->search_system_audit($start_date,$end_date,$role,$user,$agent,$channel,$category),
			'agent' => $this->User_model->get_agents(),
      		'user' => $this->User_model->get_users()
		);

		$this->load_page($data);
	}

// redraw users table
    public function redraw_table(){
        $content['title'] = 'Users';
        $content['result'] = $this->User_model->get_users();
        echo $data['content'] = $this->load->view('users/user_ajax', $content, TRUE);
    }

	// draw users table after insert
	public function load_aable(){
		$this->load->helper('url');
		$this->load->helper('html');
		$wow = $this->User_model->fetch_users();


	}

	//	update partner status
	public function update_status(){
		$userid = $this->uri->segment(3);
		$state = $this->uri->segment(4);
		
		$user = $this->User_model->get_user_status($userid);

		if($state == 0){
			$switch = "disabled";
		}else{
			$switch = "enabled";
		}
		// insert into audit tray table
		$info = array(
			'user_id' => $this->session->userdata('user_info')['id'],
			'activity' => "Updated user status",
			'status' => true,
			'description' => "$switch $user account",
			'user_category' => "admin",
			'channel' => "Web"
		);
		$audit_tray = audit_tray($info);
		//end of insert
			
		$update = $this->User_model->update_status($userid,$state);
	}

	// delete user
	public function delete_user(){

		$userid= $this->uri->segment(3);
		$user_data = array(
			'id'=>$userid,
		);
		$data = array(
			'delete_status'=>'Deleted',
		);
		if($this->User_model->delete_user($user_data,$data)){
			echo json_encode($user_data);
		}
	}

// reset user password
	public function resend_user_sms(){

		$primary_contact = $this->input->post("number");
		$username = $this->input->post("username");
		$id = $this->input->post("id");
        $password = random_string();
		$encrypt_password = $this->encryption->encrypt($password);

		$data = array(
			'password' => $encrypt_password,
			'first_login' => 0
		);
		$where = array(
            'id' => $id,
		);
		$update = $this->User_model->update_password($data,$where);

        // insert into audit tray
        $info = array(
            'user_id' => $this->session->userdata('user_info')['id'],
            'activity' => "Reset user password",
            'status' => true,
            'description' => "Resetted password of user: $username",
            'user_category' => "admin",
            'channel' => "Web"
        );
        $audit_tray = audit_tray($info);
        //end of insert
        
        $echannelid = 1;
        $echannel = $this->Channelmodel->channelstatus($echannelid);
        if($echannel != 0){
            $sms_message = "Your password has been resetted to $password \n System link is ".base_url();

            $phone_formatted = ((strlen($primary_contact) > 10) && substr($primary_contact, 0, 3) == '233') ? $primary_contact : '233' . substr($primary_contact, 1, strlen($primary_contact));
            send_sms($phone_formatted, $sms_message);
            $this->session->set_flashdata('message', "<div class='alert alert-success'>
                <strong>Success! </strong> SMS sent.
            </div>");
        }
        else{
            $this->session->set_flashdata('message', "<div class='alert alert-warning'>
                <strong>Sorry! </strong> SMS not sent because the channel is blocked.
            </div>");
        }
        redirect('users');
	}

// get business property properties ajax call
	public function auditTrayList(){
		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->User_model->getAuditTrayRecords($postData);

		echo json_encode($data);
	}

}
