<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Residence_model extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	//	get residence and display on the residence page
	public function get_residence($last_date)
	{
		$agency = $this->db->query("SELECT residence.res_code,residence.id,po.firstname,po.lastname,
			po.primary_contact,po.email,residence.status,residence.accessed,residence.houseno ,t.town as tt,
      		a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id left join
			residence_to_owner as ro on residence.id = ro.property_id left join property_owner as po on ro.owner_id = po.id 
      	WHERE date(residence.date_created) = '$last_date' order by residence.id asc")->result();
		return ($agency);
	}

	//	get residence and display on the residence page
	public function search_residence($search_by, $start_date, $end_date, $search_item, $search_option)
	{
		$search_item2 = strtolower($search_item);
		$data = [];
		if ($search_by == "Date") {
			if ($end_date == "") {
				$query = $this->db->query("SELECT residence.res_code,residence.id,po.firstname,po.lastname,
			po.primary_contact,po.email,residence.status,residence.accessed,residence.houseno ,t.town as tt,
        a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id left join
			residence_to_owner as ro on residence.id = ro.property_id left join property_owner as po on ro.owner_id = po.id 
        WHERE date(residence.date_created) = '$start_date' order by residence.id asc");

				if ($query->num_rows() > 0) {
					$data = $query->result();
					$query->free_result();
				} else {
					$data = $query->result();
				}
			} else {
				$query = $this->db->query("SELECT residence.res_code,residence.id,po.firstname,po.lastname,
				po.primary_contact,po.email,residence.status,residence.accessed,residence.houseno ,t.town as tt,
          a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id left join
			residence_to_owner as ro on residence.id = ro.property_id left join property_owner as po on ro.owner_id = po.id 
          WHERE date(residence.date_created) BETWEEN '$start_date' AND '$end_date' order by residence.id asc");

				if ($query->num_rows() > 0) {
					$data = $query->result();
					$query->free_result();
				} else {
					$data = $query->result();
				}
			}
		} else {
			$this->db->select("residence.res_code,residence.id,residence.status,residence.accessed,po.firstname,po.lastname,
			po.primary_contact,po.email,residence.houseno ,t.town as tt,a.name as area");
			$this->db->from('residence');
			$this->db->join('town as t', 'residence.town = t.id', 'left');
			$this->db->join('area_council as a', 'residence.area_council = a.id', 'left');
			$this->db->join('residence_to_owner as ro', 'residence.id = ro.property_id', 'left');
			$this->db->join('property_owner as po', 'ro.owner_id = po.id', 'left');
			($search_option == "residence_code") ? $this->db->like('lower(residence.res_code)', $search_item2) : NULL;
			($search_option == "houseno") ? $this->db->like('lower(residence.houseno)', $search_item2) : NULL;
			($search_option == "owner_firstname") ? $this->db->or_like('lower(po.firstname)', $search_item2) : NULL;
			($search_option == "owner_lastname") ? $this->db->or_like('lower(po.lastname)', $search_item2) : NULL;
			($search_option == "owner_fullname") ? $this->db->or_like('lower(concat(po.firstname, " ", po.lastname))', $search_item2) : NULL;
			($search_option == "owner_pc") ? $this->db->or_like('lower(po.primary_contact)', $search_item2) : NULL;
			($search_option == "owner_sc") ? $this->db->or_like('lower(po.secondary_contact)', $search_item2) : NULL;
			($search_option == "owner_email") ? $this->db->or_like('lower(po.email)', $search_item2) : NULL;
			$data = $this->db->get()->result();
		}

		return $data;
	}

	//	get household and display on the household page
	public function search_household($search_by, $start_date, $end_date, $search_item, $search_option)
	{
		$search_item2 = strtolower($search_item);
		$data = [];
		if ($search_by == "Date") {
			if ($end_date == "") {
				$this->db->select('id,res_prop_code,firstname,lastname,primary_contact,secondary_contact,email,gender');
				$this->db->from('household');
				$this->db->where("date(date_created) = '$start_date'");
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$data = $query->result();
					$query->free_result();
				} else {
					$data = $query->result();
				}
			} else {
				$this->db->select('id,res_prop_code,firstname,lastname,primary_contact,secondary_contact,email,gender');
				$this->db->from('household');
				$this->db->where("date(date_created) BETWEEN '$start_date' AND '$end_date'");
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$data = $query->result();
					$query->free_result();
				} else {
					$data = $query->result();
				}
			}
		} else {
			$this->db->select('id,res_prop_code,firstname,lastname,primary_contact,secondary_contact,email,gender');
			$this->db->from('household');
			($search_option == "firstname") ? $this->db->like('lower(firstname)', $search_item2) : NULL;
			($search_option == "lastname") ? $this->db->or_like('lower(lastname)', $search_item2) : NULL;
			($search_option == "fullname") ? $this->db->or_like('lower(concat(firstname, " ", lastname))', $search_item2) : NULL;
			($search_option == "residence_code") ? $this->db->or_like('lower(res_prop_code)', $search_item2) : NULL;
			($search_option == "pc") ? $this->db->or_like('lower(primary_contact)', $search_item2) : NULL;
			($search_option == "sc") ? $this->db->or_like('lower(secondary_contact)', $search_item2) : NULL;
			($search_option == "email") ? $this->db->or_like('lower(email)', $search_item2) : NULL;
			$data = $this->db->get()->result();
		}

		return $data;
	}

	// get last date from residence table
	public function get_date()
	{
		$this->db->select('date(date_created) as date1');
		$this->db->from("residence");
		$this->db->order_by("id", 'desc');
		$this->db->limit(1);
		return $this->db->get()->row_array()['date1'];
	}

	// get last date from household table
	public function get_household_date()
	{
		$this->db->select('date(date_created) as date1');
		$this->db->from("household");
		$this->db->order_by("id", 'desc');
		$this->db->limit(1);
		return $this->db->get()->row_array()['date1'];
	}

	//	get household and display on the household page
	public function get_household($last_date)
	{
		$this->db->select('id,res_prop_code,firstname,lastname,primary_contact,secondary_contact,email,gender');
		$this->db->from('household');
		$this->db->where("date(date_created) = '$last_date'");
		return $this->db->get()->result();
	}

	//	get residence household and display on the view residence page
	public function get_residence_household($rescode)
	{
		$this->db->select('id,res_prop_code,firstname,lastname,primary_contact,secondary_contact,email,gender');
		$this->db->from('household');
		$this->db->where('res_prop_code', $rescode);
		return $this->db->get()->result();;
	}

	//	add residence
	public function add_residence($data)
	{
		$insert = $this->db->insert('residence', $data);
		return $this->db->insert_id();
	}

	//	add household
	public function add_household($data)
	{
		$insert = $this->db->insert('household', $data);
		return $this->db->insert_id();
	}

	//  get products from db
    public function get_products($target)
    {
        $this->db->select('*');
        $this->db->from('revenue_product');
        $this->db->where('target', $target);
        $products = $this->db->get()->result();
        return ($products);
	}
	
	//	add com needs
	public function add_com_needs($data)
	{
		$this->db->trans_begin();
		$insert = $this->db->insert('household_needs', $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
			return $this->db->insert_id();
		}
	}

	//	add property_owner details...
	public function add_owner($data)
	{
		$insert = $this->db->insert('property_owner', $data);
		return $this->db->insert_id();
	}

	// search if res prop code exist
	public function get_res_prop_code($id)
	{

		return $query = $this->db->query("SELECT * from residence WHERE res_code = '$id'")->result_array();
	}

	// search if res prop code exist
	public function get_res_prop_latlong($id)
	{

		return $query = $this->db->query("SELECT gps_lat,gps_long from residence WHERE res_code = '$id'")->result_array();
	}

	//	get area councils and display on the add residence form.
	public function get_area_councils()
	{
		$this->db->select('id,name');
		$this->db->from('area_council');
		return $this->db->get()->result();
	}

	//	get educational level and display on the add household form.
	public function get_edu()
	{
		$this->db->select('id,level');
		$this->db->from('education');
		return $this->db->get()->result();
	}

	//	get community needs and display on the add household form.
	public function get_com()
	{
		$this->db->select('id,need');
		$this->db->from('community_needs');
		return $this->db->get()->result();
	}

	//	get community needs and display on the add household form.
	public function get_household_needs($id)
	{
		$this->db->select('id,need_id');
		$this->db->from('household_needs');
		$this->db->where('household_id', $id);
		return $this->db->get()->result();
	}
	
	//	get proffession and display on the add household form.
	public function get_prof()
	{
		$this->db->select('id,name');
		$this->db->from('profession');
		return $this->db->get()->result();
	}

	//	get construction material and display on the add residence form.
	public function get_cons()
	{
		$this->db->select('id,material');
		$this->db->from('construction_material');
		return $this->db->get()->result();
	}

	//	get construction material and display on the add residence form.
	public function get_roof()
	{
		$this->db->select('id,roof');
		$this->db->from('roofing_type');
		return $this->db->get()->result();
	}

	//	get area councils and display on the add residence form.
	public function get_area_towns($postdata)
	{
		$this->db->select('id,town');
		$this->db->from('town');
		$this->db->where('area_council_id', $postdata['area']);
		return $this->db->get()->result();
	}

	// check if owner already exit
	public function owner_exit($primary_contact)
	{

		$query = $this->db->query(
			"SELECT * from property_owner WHERE primary_contact = ?",
			[$primary_contact]
		);
		$result =  $query->result_array();
		echo json_encode($result);
		return ($result);
	}

	//	get last area council code
	public function resnumber($areacode, $towncode)
	{
		$this->db->select('code');
		$this->db->from('residence');
		$this->db->where('area_council', $areacode);
		$this->db->where('town', $towncode);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$code = $data->row_array()['code'];
		$result = $code + 1;
		$number = 0 + 1;
		if ($data->num_rows() == 0) {
			return $number;
		} else {
			return $result;
		}
	}

	// update residence
	public function update_owner($data, $id)
	{

		$this->db->where('id', $id);
		return $this->db->update('property_owner', $data);
	}

	// delete household needs
	public function delete_household_need($id)
	{

		$this->db->where('household_id', $id);
		return $this->db->delete('household_needs');
	}


	// update residence type
	public function update_residence($data, $id)
	{

		$this->db->where('id', $id);
		return $this->db->update('residence', $data);
	}

	// update residence type
	public function update_res_to_category($data, $id)
	{

		$this->db->where('property_id', $id);
		return $this->db->update('res_to_category', $data);
	}

	// update res_to_owner
	public function update_res_to_owner($res_id,$owner_id)
	{
		$data = array(
			"owner_id" => $owner_id
		);

		$this->db->where('property_id', $res_id);
		return $this->db->update('residence_to_owner', $data);
	}

	// update household type
	public function update_household($data, $id)
	{

		$this->db->where('id', $id);
		return $this->db->update('household', $data);
	}

	//assign owner to residence
	public function add_res_to_owner($res_id, $owner_id)
	{
		$data = array(
			'owner_id' => $owner_id,
			'property_id' => $res_id
		);
		$insert = $this->db->insert('residence_to_owner', $data);
		return $this->db->insert_id();
	}

	//assign owner to residence
	public function add_res_to_category($category)
	{
		$insert = $this->db->insert('res_to_category', $category);
		return $this->db->insert_id();
	}

	//assign owner to residence
	public function get_residence_details($id)
	{
		$data = array(
			'r.id' => $id
		);
		$this->db->select("r.*,t.town as tt ,a.name as area,c.category1,c.category2,c.category3,c.category4,c.category5,c.category6");
		$this->db->from("residence as r");
		$this->db->where($data);
		$this->db->join('town as t', 'r.town =t.id', 'left');
		$this->db->join('area_council as a', 'r.area_council = a.id', 'left');
		$this->db->join('res_to_category as c', 'c.property_id = r.id', 'left');
		return $this->db->get()->row_array();
	}

	//get invoices for a particular property
	public function get_property_invoice($id, $target)
	{
		$data = array(
			'i.property_id' => $id,
			'i.target' => $target
		);
		$this->db->select('i.*');
		$this->db->from('vw_invoice as i');
		$this->db->where($data);
		return $this->db->get()->result();
	}

	//get sum of invoices for a particular property
	public function get_property_invoice_sum($id, $target)
	{
		$data = array(
			'i.property_id' => $id,
			'i.target' => $target
		);
		$this->db->select('sum(i.invoice_amount) as invoice_amount, sum(i.adjustment_amount) as discount,
		sum(i.amount_paid) as amount_paid');
		$this->db->from('vw_invoice as i');
		$this->db->where($data);
		return $this->db->get()->row_array();
	}

	//assign owner to residence
	public function get_household_details($id)
	{
		$data = array(
			'h.id' => $id
		);
		$this->db->select("h.*,e.level ,p.name as prof");
		$this->db->from("household as h");
		$this->db->where($data);
		$this->db->join('education as e', 'h.highest_edu = e.id', 'left');
		$this->db->join('profession as p', 'h.profession = p.id', 'left');
		return $this->db->get()->row_array();
	}

	function getResidentialProperties($postData = null)
	{

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
		$base_url = base_url();

		## Search 
		$searchQuery = "";
		if ($searchValue != '') {
			$searchQuery = "po.primary_contact like '%" . $searchValue . "%' or 
			residence.res_code like '%" . $searchValue . "%' or 
			a.name like '%" . $searchValue . "%' or 
			t.town like '%" . $searchValue . "%' or 
			concat(po.firstname,' ',po.lastname) like '%" . $searchValue . "%' or 
			po.primary_contact like '%" . $searchValue . "%'";
		}


		## Total number of records without filtering
		$this->db->select("count(*) as allcount");
		$this->db->from('residence');
		$this->db->join('town as t', 'residence.town = t.id', 'left');
		$this->db->join('area_council as a', 'residence.area_council = a.id', 'left');
		$this->db->join('residence_to_owner as ro', 'residence.id = ro.property_id', 'left');
		$this->db->join('property_owner as po', 'ro.owner_id = po.id', 'left');
		$this->db->join("users as u","residence.agent_id=u.id","left");
        $this->db->join("agent as ag","residence.agent_id=ag.id","left");

		if ($searchValue == '') {
			if ($postData['start_date'] != "" && $postData['end_date'] == "") {
				$this->db->where('date(residence.date_created)', $postData['start_date']);
			} else if ($postData['start_date'] != "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else if ($postData['start_date'] == "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else {
			}
		}
		$records = $this->db->get()->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select("count(*) as allcount");
		$this->db->from('residence');
		$this->db->join('town as t', 'residence.town = t.id', 'left');
		$this->db->join('area_council as a', 'residence.area_council = a.id', 'left');
		$this->db->join('residence_to_owner as ro', 'residence.id = ro.property_id', 'left');
		$this->db->join('property_owner as po', 'ro.owner_id = po.id', 'left');
		$this->db->join("users as u","residence.agent_id=u.id","left");
        $this->db->join("agent as ag","residence.agent_id=ag.id","left");

		if ($searchValue == '') {
			if ($postData['start_date'] != "" && $postData['end_date'] == "") {
				$this->db->where('date(residence.date_created)', $postData['start_date']);
			} else if ($postData['start_date'] != "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else if ($postData['start_date'] == "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else {
			}
		}

		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}

		$records = $this->db->get()->result();
		$totalRecordwithFilter = $records[0]->allcount;

		## Fetch records
		$this->db->select('residence.res_code,residence.id,residence.status,residence.invoice_status,residence.accessed,po.firstname,po.lastname,
		po.primary_contact,po.email,residence.houseno ,t.town as tt,a.name as area, residence.image_path,residence.property_image,
		CASE WHEN residence.agent_category = "agent" THEN concat(ag.firstname," ",ag.lastname," (",ag.agent_code,")") WHEN residence.agent_category = "admin" THEN concat(u.firstname," ",u.lastname," (",u.username,")") END as registered_by');
		$this->db->from('residence');
		$this->db->join('town as t', 'residence.town = t.id', 'left');
		$this->db->join('area_council as a', 'residence.area_council = a.id', 'left');
		$this->db->join('residence_to_owner as ro', 'residence.id = ro.property_id', 'left');
		$this->db->join('property_owner as po', 'ro.owner_id = po.id', 'left');
		$this->db->join("users as u","residence.agent_id=u.id","left");
        $this->db->join("agent as ag","residence.agent_id=ag.id","left");

		if ($searchValue == '') {
			if ($postData['start_date'] != "" && $postData['end_date'] == "") {
				$this->db->where('date(residence.date_created)', $postData['start_date']);
			} else if ($postData['start_date'] != "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else if ($postData['start_date'] == "" && $postData['end_date'] != "") {
				$this->db->where('date(residence.date_created) >=', $postData['start_date']);
				$this->db->where('date(residence.date_created) <=', $postData['end_date']);
			} else {
			}
		}

		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}

		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			# edit residence url
			$url = base_url() . 'Residence/edit_residence_form/' . $record->id . '/' . $record->res_code;
			$residence_url = "<a href='$url'>" . $record->res_code . "</a>";

			//residence id (pk)
			$id = $record->id;

			//check if residence is assessed
			$assessed = $record->accessed;
			if ($assessed == 1) {
				$assessed_badge = '<span class="badge badge-success">Assessed</span>';
			} else {
				$assessed_badge = '<span class="badge badge-danger">Unassessed</span>';
			}

			//check if residence is status
			$status = $record->status;
			if ($status == 1) {
				$status_badge = '<span class="badge badge-success">Complete</span>';
			} else {
				$status_badge = '<span class="badge badge-danger">Incomplete</span>';
			}

			//check if property invoice is generated
			$invoice_status = $record->invoice_status;
			if ($invoice_status == 1) {
				$invoice_status_badge = '<span class="badge badge-success">Generated</span>';
			} else {
				$invoice_status_badge = '<span class="badge badge-danger">Not Generated</span>';
			}

			$res_code = $record->res_code;
			$primary_contact = trim($record->primary_contact);
			$email = $record->email;
			$houseno = $record->houseno;
			$resend_sms_button = "";

			$resend_sms_button .= '<form method="post" action="' . $base_url . 'Residence/resend_residence_sms">';
			$resend_sms_button .= "<input type='hidden' name='number' value='$primary_contact'>";
			$resend_sms_button .= "<input type='hidden' name='rescode' value='$res_code'>";
			$resend_sms_button .= "<input type='hidden' name='houseno' value='$houseno'>";
			$resend_sms_button .= "<button type='submit' class='btn btn-success'><span class='fa fa-refresh'></span></button>";
			$resend_sms_button .= "</form>";

			$funcCall = "confirm_modall('" . $primary_contact . "','" . $email . "')";
			$billCall = "bill_modal('". $id . "','". $record->res_code ."')";
			$residence_key = "res";
			$deleteRecord = "delete_modal('". $id . "','". $record->res_code ."','".$residence_key."')";
			$alertbillCall = "alert('Sorry, You dont have the permission to perform this action')";

			# message url
			$message_button = '<a class="btn btn-info" style="margin:0.5em" onclick="' . $funcCall . '"><i style="color:white" class="fa fa-envelope"></i></a>';
			
			//  bill generation button
            if(has_permission($this->session->userdata('user_info')['id'],'single_bill_generation')){
                $bill_button = "<a class='btn btn-info' style='margin:0.5em' onclick=$billCall><i style='color:white' class='fa fa-file'></i></a>";
            }else{
                $bill_button = '';
			}
			
			//  delete record button
            if(has_permission($this->session->userdata('user_info')['id'],'delete_property_business')){
                $delete_button = "<a class='btn btn-danger' style='margin:0.5em' onclick=$deleteRecord><i style='color:white' class='fa fa-trash'></i></a>";
            }else{
                $delete_button = '';
            }

			if($record->property_image == ''){
				$property_image = base_url().'upload/property/residence/no-image.png';
			}else{
				$property_image = base_url().$record->image_path.$record->property_image;
			}
			# # image button
			$image_button = '<a class="btn btn-info example-image-link" style="margin:0.5em" href="' . $property_image . '" data-lightbox="example-1"><i style="color:white" class="fa fa-picture-o"></i></a>';

			// property owner full name
			$fullname = $record->firstname . " " . $record->lastname;

			$data[] = array(
				"res_code" => $residence_url,
				"area" => $record->area,
				"tt" => $record->tt,
				"status" => $status_badge,
				"assessed" => $assessed_badge,
				"invoice_status" => $invoice_status_badge,
				"owner" => $fullname,
				"primary_contact" => $primary_contact,
				"registered_by" => $record->registered_by,
				"resend_code" => $resend_sms_button,
				"bill_generation" => $image_button.$message_button.$bill_button.$delete_button
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
