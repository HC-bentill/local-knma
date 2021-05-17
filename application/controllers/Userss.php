<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userss extends CI_Controller {
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
		
	}

	 public function load_page($data)
    {
        $this->load->view('page_layout/layout',$data);
    }

	// load users page
	public function users(){
		if(has_permission($this->session->userdata('user_info')['id'],'view user')){
			//exit($this->session->userdata('user_info')['id']);
			$this->session->set_userdata('last_page', 'view user');

			$data = array(
				'title' => 'Users',
				'result' => $this->User_model->get_users(),
				'page' => 'users/users'

			);
			$this->load_page($data);
		}else{
			//exit($this->session->userdata('user_info')['id']);
			$this->session->set_userdata('last_page', 'view user');

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

	// load change password page
	public function change_passwordd(){
		$breadCrumbs = buildBreadCrumb(
			array('label' => 'Change Password', 'url' => 'change_passwordd'), TRUE);
		$data = array(
			'title' => 'Change Password',
			'page' => 'users/change_passwordd'

		);
		$this->load_page($data);

	}

	// load add users page
	public function add_user_page(){
		if(has_permission($this->session->userdata('user_info')['id'],'create user')){
			//exit($this->session->userdata('user_info')['id']);
			$this->session->set_userdata('last_page', 'add user');

			$data = array(
				'title' => 'Create User',
				'page' => 'users/add_user'

			);
			$this->load_page($data);
		}else{
			//exit($this->session->userdata('user_info')['id']);
			$this->session->set_userdata('last_page', 'add user');

			$data = array(
				'title' => 'Permission',
				'page' => 'permission/error'

			);
			$this->load_page($data);
		}


	}

	// load add users page
	public function edit_user_page($id){
		if(has_permission($this->session->userdata('user_info')['id'],'manage user')){
			$data = array(
				'title' => 'Edit User',
				'page' => 'users/edit_user',
				'result' => $this->User_model->get_user_details($id),
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
            'first_login' => 1
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
		$username = trim($this->input->post('username'));
		$password = random_string();
		$encrypt_password = $this->encryption->encrypt($password);
		$sms_message = "Your Account has successfully being created on MYTICKETSGH platform. Your login details are \nUsername: $username \nPassword: $password \n System link is http://178.62.20.56/myticketsgh";

		$phone_formatted = ((strlen($mobileno) > 10) && substr($mobileno, 0, 3) == '233') ? $mobileno : '233' . substr($mobileno, 1, strlen($mobileno));
		
		if($this->UserModel->phoneno_exit($mobileno)){
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Sorry! </strong> The Phone Number Already Exit.
				</div>");
			redirect(base_url().'add_user');
		}else if($this->UserModel->email_exit($email)){
	
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Sorry! </strong> The E-mail Already Exit.
				</div>");
			redirect(base_url().'add_user');
		}else if($this->UserModel->username_exit($username)){
			$this->session->set_flashdata('message', "<div class='alert alert-danger'>
				<strong>Sorry! </strong> The Username Already Exit.
				</div>");
			redirect(base_url().'add_user');
		}

		$data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'mobileno' => $mobileno,
			'email' => $email,
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
	    }else{
			// insert into audit tray
			$info = array(
				'user_id' => $this->session->userdata('user_info')['id'],
				'activity' => "Added a user",
				'status' => false,
                'description' => "Added user with username: $username",
                'user_category' => "admin",
                'channel' => "Web"
			);
			$audit_tray = audit_tray($info);
			//end of insert
	        $this->session->set_flashdata('message', "<div class='alert alert-danger'>
            	<strong>Success! </strong> Your Form Was Not Submitted.
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
                'description' => "editted user details of user with username: $username",
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

		//exit($this->session->userdata('user_info')['id']);
		$this->session->set_userdata('last_page', 'system audit');

		$data = array(
			'title' => 'System Audit',
			'page' => 'users/system_audit',
			'start_date' => $today,
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

}
