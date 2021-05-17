<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    // get user
    public function get_users(){
        return $this->db->query( "select * from users WHERE delete_status = 1 order by id asc")->result();
    }
    
    // get user details to be eddited
    public function get_user_details($id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$id);
        $query = $this->db->get()->row();
        return $query;
    }

    // get positions from db and show on add and edit user
    public function get_position(){
        $this->db->select('*');
        $this->db->from('position');
        $query = $this->db->get()->result();
        return $query;
    }

// insert user
    public function add_user($data){
        $this->db->insert('users',$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

//	get channel and display on the channel manager page 
    public function get_user_status($id){
        $user = $this->db->query("SELECT username FROM users WHERE id = $id")->row_array()['username'];
        return($user);
    }	

// update account status
    public function update_status($userid,$state){
            
        $my_own_query = "Update users set account_status = '$state' where id = '$userid'";
        $query = $this->db->query($my_own_query);		
    }

    // insert user roles
    public function add_user_roles($data){
    	$this->db->trans_begin();
        $this->db->insert('user_roles',$data);
        if ($this->db->trans_status() === FALSE) {
            $result = FALSE;
            $this->db->trans_rollback();
        } else {
            $result = true;
            $this->db->trans_commit();
        }

        return $result;
    }

    //  delete exiting user roles
     public function delete_existing_roles($id){
         
        $this->db->where('user_id',$id);
        $this->db->delete('user_roles');
    } 
	
	
    // insert category
    public function add_category($data){
        $this->db->insert('category',$data);
	
    }

    // get system audit for the day
    public function get_system_audit($date){
        $this->db->select('a.*,u.username,ag.firstname,ag.lastname,ag.agent_code');
        $this->db->from("audit_tray as a");
        $this->db->join("users as u","a.user_id=u.id","left");
        $this->db->join("agent as ag","a.user_id=ag.id","left");
        $this->db->where("date(a.datetime_created) = '$date'");
        $this->db->where("a.user_category <> ''");
        $this->db->where("a.user_id <> 0");
        return $this->db->get()->result();
    }

    //	get all agents details
    public function get_agents(){
        $this->db->select('id,firstname,lastname,agent_code');
        $this->db->from('agent');
        $products = $this->db->get()->result();
        return($products);
    }
    
    // search system audit for the using dates
    public function search_system_audit($start_date,$end_date,$role,$user,$agent,$channel,$category){
    
        if($end_date == ""){
          $this->db->select('a.*,u.username,ag.firstname,ag.lastname,ag.agent_code');
          $this->db->from("audit_tray as a");
          $this->db->join("users as u","a.user_id=u.id","left");
          $this->db->join("agent as ag","a.user_id=ag.id","left");
          $this->db->where("date(a.datetime_created) = '$start_date'");
          $this->db->where("a.user_id <> 0");
          $this->db->where("a.user_category <> ''");
          ($role) ? $this->db->where('a.activity', $role) : NULL;
          ($channel) ? $this->db->where('a.channel', $channel) : NULL;
          if($category == "admin"){
            $this->db->where('a.user_category', "admin");
            $this->db->where('a.user_id', $user);
          }else if($category == "agent"){
            $this->db->where('a.user_category', "agent");
            $this->db->where('a.user_id', $agent);
          }else{
  
          }
          return $this->db->get()->result();
        }else{
          $this->db->select('a.*,u.username,ag.firstname,ag.lastname,ag.agent_code');
          $this->db->from("audit_tray as a");
          $this->db->join("users as u","a.user_id=u.id","left");
          $this->db->join("agent as ag","a.user_id=ag.id","left");
          $this->db->where("date(a.datetime_created) BETWEEN '$start_date' AND '$end_date'");
          $this->db->where("a.user_id <> 0");
          $this->db->where("a.user_category <> ''");
          ($role) ? $this->db->where('a.activity', $role) : NULL;
          ($channel) ? $this->db->where('a.channel', $channel) : NULL;
          if($category == "admin"){
            $this->db->where('a.user_category', "admin");
            $this->db->where('a.user_id', $user);
          }else if($category == "agent"){
            $this->db->where('a.user_category', "agent");
            $this->db->where('a.user_id', $agent);
          }else{
  
          }
          return $this->db->get()->result();
        }
        
    }

	//	check for similar username
	 public function duplicate_username($username){
        $duplicate=$this->db->query("SELECT * from users WHERE username = '$username'")->row_array();
    }
	
	//	check for similar categories
	 public function duplicate_categories($search_value){
        $this->db->query("SELECT * from category WHERE categoryname = '$search_value'")->result_array();
    }
	
	//redraw table with users detail
	public function fetch_users(){
		
		$my_own_query = "select * from users WHERE delete_status='Active' order by user_id asc";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);	
    }
	
		
	//redraw table with categories detail
	public function fetch_categories(){
		
		$my_own_query = "select * from category WHERE delete_status='Active' order by categoryid asc";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);	
    }
	
	//	get user details to be editted from db
	public function get_user($a){
		
		$my_own_query = "SELECT * FROM users where user_id = '$a'";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);
		
		return($result);	
    }
	
	//	get user details to be editted from db
	public function get_category($a){
		
		$my_own_query = "SELECT * FROM category where categoryid = '$a'";
		$query = $this->db->query($my_own_query);
		
		$result = $query->result_array();
		echo json_encode($result);
		
		return($result);	
    }
	
	// update user
    public function update_user($data,$id){
      
        $this->db->where($id);
        return $this->db->update('users',$data);
    }
	
	// update category
    public function update_category($data,$id){
      
        $this->db->where($id);
        $this->db->update('category',$data);
    }
	
    public function update_password($data,$where){
        $this->db->where($where);
        return $this->db->update("users",$data);
    }
	
	//	delete a user
	 public function delete_user($user_data,$data){
		 
        $this->db->where($user_data);
        $this->db->update('users',$data);
    } 
	
	//	delete a category
	 public function delete_category($category_data,$data){
		 
        $this->db->where($category_data);
        $this->db->update('category',$data);
    } 

    // request ajax to get all business occupants
    function getAuditTrayRecords($postData=null){

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        $start_date = $postData['start_date'];
        $end_date = $postData['end_date'];
        $role = $postData['role'];
        $channel = $postData['channel'];
        $category = $postData['category'];
        $agents = $postData['agents'];
        $users = $postData['users'];
        $base_url = base_url();

        ## Search 
        $searchQuery = "";
        if($searchValue != ''){
            $searchQuery = "u.username like '%".$searchValue."%' or 
            a.activity like '%".$searchValue."%' or 
            a.description like '%".$searchValue."%' or 
            a.channel like '%".$searchValue."%' or 
            ag.agent_code like '%".$searchValue."%' or 
            concat(ag.firstname,' ',ag.lastname) like '%".$searchValue."%'";
        }


        ## Total number of records without filtering
        $this->db->select("count(*) as allcount");
        $this->db->from("audit_tray as a");
        $this->db->join("users as u","a.user_id=u.id","left");
        $this->db->join("agent as ag","a.user_id=ag.id","left");
        $this->db->where("a.user_category <> ''");
        $this->db->where("a.user_id <> 0");
        
        if($searchValue == '') {
            if($postData['start_date'] != "" && $postData['end_date'] == ""){
                $this->db->where('date(a.datetime_created)',$postData['start_date']);
            }else if($postData['start_date'] != "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else if($postData['start_date'] == "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else{

            }
            ($role) ? $this->db->where('a.activity', $role) : NULL;
            ($channel) ? $this->db->where('a.channel', $channel) : NULL;
            if($category == "admin"){
                $this->db->where('a.user_category', "admin");
                ($users) ? $this->db->where('a.user_id', $users) : NULL;
            }else if($category == "agent"){
                $this->db->where('a.user_category', "agent");
                ($agents) ? $this->db->where('a.user_id', $agents) : NULL;
            }else{
    
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from("audit_tray as a");
        $this->db->join("users as u","a.user_id=u.id","left");
        $this->db->join("agent as ag","a.user_id=ag.id","left");
        $this->db->where("a.user_category <> ''");
        $this->db->where("a.user_id <> 0");
        
        if($searchValue == '') {
            if($postData['start_date'] != "" && $postData['end_date'] == ""){
                $this->db->where('date(a.datetime_created)',$postData['start_date']);
            }else if($postData['start_date'] != "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else if($postData['start_date'] == "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else{

            }
            ($role) ? $this->db->where('a.activity', $role) : NULL;
            ($channel) ? $this->db->where('a.channel', $channel) : NULL;
            if($category == "admin"){
                $this->db->where('a.user_category', "admin");
                ($users) ? $this->db->where('a.user_id', $users) : NULL;
            }else if($category == "agent"){
                $this->db->where('a.user_category', "agent");
                ($agents) ? $this->db->where('a.user_id', $agents) : NULL;
            }else{
    
            }
        }

        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;
        
        ## Fetch records
        $this->db->select("a.*,u.username,ag.firstname,ag.lastname,ag.agent_code");
        $this->db->from("audit_tray as a");
        $this->db->join("users as u","a.user_id=u.id","left");
        $this->db->join("agent as ag","a.user_id=ag.id","left");
        $this->db->where("a.user_category <> ''");
        $this->db->where("a.user_id <> 0");
        
        if($searchValue == '') {
            if($postData['start_date'] != "" && $postData['end_date'] == ""){
                $this->db->where('date(a.datetime_created)',$postData['start_date']);
            }else if($postData['start_date'] != "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else if($postData['start_date'] == "" && $postData['end_date'] != ""){
                $this->db->where('date(a.datetime_created) >=', $postData['start_date']);
                $this->db->where('date(a.datetime_created) <=', $postData['end_date']);
            }else{

            }
            ($role) ? $this->db->where('a.activity', $role) : NULL;
            ($channel) ? $this->db->where('a.channel', $channel) : NULL;
            if($category == "admin"){
                $this->db->where('a.user_category', "admin");
                ($users) ? $this->db->where('a.user_id', $users) : NULL;
            }else if($category == "agent"){
                $this->db->where('a.user_category', "agent");
                ($agents) ? $this->db->where('a.user_id', $agents) : NULL;
            }else{
    
            }
        }

        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach($records as $record ){

            //check if audit tray status
            $status = $record->status;
            if($status == 1){
                $status_badge = '<span class="badge badge-success">Successful</span>';
            }else{
                $status_badge = '<span class="badge badge-danger">Failed</span>';
            }
            
            if($record->user_category == "admin"){
                $user = $record->username;
            }else{
                $user = $record->firstname.' '.$record->lastname.' ('.$record->agent_code.')';
            }

            $data[] = array( 
                "datetime_created"=>$record->datetime_created,
                "name" => $user,
                "activity"=>$record->activity,
                "description"=>$record->description,
                "status"=> $status_badge,
                "channel"=> $record->channel,
            );

        }

        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );

        return $response; 
    }
}