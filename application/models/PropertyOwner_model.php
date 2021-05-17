<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PropertyOwner_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get property owner and display on the property owner page
	public function get_property_owner(){
    $this->db->select('id, person_category, firstname, lastname, primary_contact, secondary_contact, email');
		$this->db->from('property_owner');
		return $this->db->get()->result();
	}

  public function get_prop_owner_details($id){
    $this->db->select("*");
		$this->db->from('property_owner');
    $this->db->where("id",$id);
		return $this->db->get()->row_array();
	}

  //	get property owner and display on the property owner page
	public function get_residence($id){
		$agency = $this->db->query("SELECT residence.id, residence.status, residence.res_code, residence.houseno ,t.town as tt, a.name as area FROM residence
      left join town t on residence.town = t.id
      left join area_council a on residence.area_council = a.id
      left join residence_to_owner r on r.property_id = residence.id WHERE owner_id = $id order by id asc")->result();
		  return($agency);
	}

  //	get business and display on the business page
	public function get_business($id){
		$agency = $this->db->query("SELECT buisness_property.buis_prop_code, buisness_property.id, buisness_property.status,t.town as tt, a.name as area FROM buisness_property
      left join town t on buisness_property.town = t.id
      left join area_council a on buisness_property.area_council = a.id
      left join buis_prop_to_owner b on b.property_id = buisness_property.id WHERE owner_id = $id order by id asc")->result();
		  return($agency);
	}

  //	get residence and display on the residence page
	public function get_business_occ($id){
		$this->db->select("buisness_occ.id, buisness_occ.buis_primary_phone, buisness_occ.buis_occ_code, buisness_occ.buis_email, buisness_occ.buis_name, buisness_occ.buis_occ_code");
		$this->db->from("buisness_occ");
    $this->db->join('buis_occ_to_owner as r','buisness_occ.id = r.property_id');
    $this->db->where("r.owner_id",$id);
		return $this->db->get()->result();
  }
  
  function getPropertyOwners($postData=null){

      $response = array();

      ## Read value
      $draw = $postData['draw'];
      $start = $postData['start'];
      $rowperpage = $postData['length']; // Rows display per page
      $columnIndex = $postData['order'][0]['column']; // Column index
      $columnName = $postData['columns'][$columnIndex]['data']; // Column name
      $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
      $searchValue = $postData['search']['value']; // Search value

      ## Search 
      $searchQuery = "";
      if($searchValue != ''){
          $searchQuery = " (firstname like '%".$searchValue."%' or 
                lastname like '%".$searchValue."%' or 
                primary_contact like'%".$searchValue."%' or 
                secondary_contact like'%".$searchValue."%' or 
                email like'%".$searchValue."%' ) ";
      }


      ## Total number of records without filtering
      $this->db->select('count(*) as allcount');
      $records = $this->db->get('property_owner')->result();
      $totalRecords = $records[0]->allcount;

      ## Total number of record with filtering
      $this->db->select('count(*) as allcount');
      if($searchQuery != '')
      $this->db->where($searchQuery);
      $records = $this->db->get('property_owner')->result();
      $totalRecordwithFilter = $records[0]->allcount;

      
      ## Fetch records
      $this->db->select('*');
      if($searchQuery != '')
      $this->db->where($searchQuery);
      $this->db->order_by($columnName, $columnSortOrder);
      $this->db->limit($rowperpage, $start);
      $records = $this->db->get('property_owner')->result();

      $data = array();

      foreach($records as $record ){
        
          $data[] = array( 
              "person_category"=>$record->person_category,
              "firstname"=>$record->firstname,
              "lastname"=>$record->lastname,
              "primary_contact"=>$record->primary_contact,
              "secondary_contact"=>$record->secondary_contact,
              "email"=>$record->email
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
