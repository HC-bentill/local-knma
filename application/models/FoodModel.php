<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FoodModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    //	get area councils and display on the add food vendor form.
	public function get_area_councils(){
		$this->db->select('id,name');
		$this->db->from('area_council');
	    return $this->db->get()->result();
    }

    public function get_outdoor_vendors(){
		$this->db->select('id,name');
		$this->db->from('outdoorvendors');
	    return $this->db->get()->result();
    }

    //	get towns and display on the add food vendor form.
	public function get_towns(){
		$this->db->select('id,town');
		$this->db->from('town');
	    return $this->db->get()->result();
    }

    // public function get_signage_data(){
    //    $this->db->query("SELECT a.id as id, a.code as signage_code, a.outdoor_category as outdoor_category, a.outdoor_owner_contact as outdoor_owner_contact, b.name as area_council, d.name as outdoor_owner_name, c.town as town_name, a.outdoor_type as outdoor_type, a.created_by as registered_by FROM signage a inner join outdoorvendors d on a.outdoor_owner_name = d.id  inner join area_council b inner join town c on c.area_council_id = b.id WHERE a.town = c.id;")->row_array();
    //    return $this->db->get()->result();
    // }

    //	get number of food vendors
	public function food_number(){
		$this->db->select('id');
		$this->db->from('food_vendor');
	    $data = $this->db->get();
	    $number = $data->num_rows();
        return $code = $number + 1;    
    }

    //	get number of no registration
	public function no_registration_number(){
		$this->db->select('id');
		$this->db->from('no_registration');
	    $data = $this->db->get();
	    $number = $data->num_rows();
        return $number;
    }

    
    //	get number of signage
	public function signage_number(){
		$this->db->select('id');
		$this->db->from('signage');
	    $data = $this->db->get();
	    $number = $data->num_rows();
        return $code = $number + 1;    
	}
    
    //	get food vendors and display on the vendors page
	public function get_food_vendors($last_date){
		$agency = $this->db->query("SELECT f.* ,t.town as tt,
      a.name as area FROM food_vendor f left join town t on f.town = t.id left join area_council a on f.area_council = a.id
      WHERE date(f.datetime_created) = '$last_date' order by f.id asc")->result();
		return($agency);
    }

//	get food vendor and display on the food vendor page
    public function search_food_vendor($search_by,$start_date,$end_date,$search_item){
        $search_item2 = strtolower($search_item);
        $data = [];
        if($search_by == "Date"){
        if($end_date == ""){
            $this->db->select("f.* ,t.town as tt,a.name as area");
            $this->db->from("food_vendor as f");
            $this->db->join('town as t','f.town = t.id','left');
            $this->db->join('area_council as a','f.area_council = a.id','left');
            $this->db->where("date(datetime_created) = '$start_date'");
            $query = $this->db->get();
            if ($query->num_rows() > 0){
                $data = $query->result();
                $query->free_result();
            }else{
                $data = $query->result();
            }
        }else{
            $this->db->select("f.* ,t.town as tt,a.name as area");
            $this->db->from("food_vendor as f");
            $this->db->join('town as t','f.town = t.id','left');
            $this->db->join('area_council as a','f.area_council = a.id','left');
            $this->db->where("date(datetime_created) BETWEEN '$start_date' AND '$end_date'");
            $query = $this->db->get();
            if ($query->num_rows() > 0){
                $data = $query->result();
                $query->free_result();
            }else{
                $data = $query->result();
            }
        }
        }else{
            $this->db->select("f.* ,t.town as tt,a.name as area");
            $this->db->from("food_vendor as f");
            $this->db->join('town as t','f.town = t.id','left');
            $this->db->join('area_council as a','f.area_council = a.id','left');
            $this->db->like('lower(fv_code)',$search_item2);
            $this->db->or_like('lower(firstname)',$search_item2);
            $this->db->or_like('lower(lastname)',$search_item2);
            $this->db->or_like('lower(phoneno)',$search_item2);
            $this->db->or_like('lower(id_number)',$search_item2);
            $query = $this->db->get();
            if ($query->num_rows() > 0){
                $data = $query->result();
                $query->free_result();
            }else{
                $data = $query->result();
            }
        }

        return $data;
    }

//	get signage and display on the signage page
public function search_signage($search_by,$start_date,$end_date,$search_item){
    $search_item2 = strtolower($search_item);
    $data = [];
    if($search_by == "Date"){
    if($end_date == ""){
        $this->db->select("f.*");
        $this->db->from("signage as f");
        $this->db->where("date(datetime_created) = '$start_date'");
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            $data = $query->result();
            $query->free_result();
        }else{
            $data = $query->result();
        }
    }else{
        $this->db->select("f.*");
        $this->db->from("signage as f");
        $this->db->where("date(datetime_created) BETWEEN '$start_date' AND '$end_date'");
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            $data = $query->result();
            $query->free_result();
        }else{
            $data = $query->result();
        }
    }
    }else{
        $this->db->select("f.*");
        $this->db->from("signage as f");
        $this->db->like('lower(code)',$search_item2);
        $this->db->or_like('lower(company_name)',$search_item2);
        $this->db->or_like('lower(contact)',$search_item2);
        $this->db->or_like('lower(contact_name)',$search_item2);
        $this->db->or_like('lower(street_name)',$search_item2);
        $this->db->or_like('lower(landmark)',$search_item2);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            $data = $query->result();
            $query->free_result();
        }else{
            $data = $query->result();
        }
    }

    return $data;
}

    public function serial_number() {
        $this->db->select('id');
		$this->db->from('signage');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$code = $data->row_array()['id'];
		$result = $code + 1;
		$number = 1;
		if ($data->num_rows() == "") {
			return $number;
		} else {
			return $result;
		}

    }

//	get food vendors and display on the signage page
	public function get_signage($last_date){
		$data = $this->db->query("select a.id as id, a.code as signage_code, a.outdoor_category as outdoor_category, a.contact as outdoor_owner_contact, b.name as area_council, d.name as outdoor_owner_name, c.town as town_name, a.email as email, a.outdoor_type as outdoor_type, a.created_by as registered_by FROM signage a left join outdoorvendors d on a.contact_name = d.id left join area_council b on a.area_council = b.id left join town c on a.town = c.id;")->result();
		return($data);
        // WHERE date(a.datetime_created) = '$last_date'
    }
    
    // get last date from residence table
    public function get_date(){
        $this->db->select('date(datetime_created) as date1');
        $this->db->from("food_vendor");
        $this->db->order_by("id",'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

    // get last date from residence table
    public function get_signage_date(){
        $this->db->select('date(datetime_created) as date1');
        $this->db->from("signage");
        $this->db->order_by("id",'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

    //	add food vendor
	public function add_food_vendor($data){
		$insert = $this->db->insert('food_vendor',$data);
		return $this->db->insert_id();
    }

    //	add food vendor
	public function add_signage($data){
		$insert = $this->db->insert('signage',$data);
		return $this->db->insert_id();
    }
    
    //	get food vendor details from db
	public function get_food_vendor_details($a){
		$food_vendor = $this->db->query("SELECT * FROM food_vendor f where f.id = '$a'")->row_array();
		return($food_vendor);
    }

    //	get signage details from db
	public function get_signage_details($a){
		$signage = $this->db->query("SELECT f.*, a.name as area_council_name, t.town as town_name, o.name as outdoor_name FROM signage f left join area_council a on f.area_council = a.id left join town t on f.town = t.id left join outdoorvendors o on f.contact_name = o.id where f.id = $a")->row_array();
		// $signage = $this->db->query("SELECT * FROM signage")->row_array();
		return($signage);
    }
    
    // update food vendor
    public function update_food_vendor($data,$id){

        $this->db->where('id',$id);
        return $this->db->update('food_vendor',$data);
    }
    // update food vendor
    public function update_signage_data($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('signage',$data);
    }

    // search if business occ code exist
    public function get_business_occ_code($id)
    {
        return $query = $this->db->query(
            "SELECT * from buisness_occ WHERE buis_occ_code = '$id'"
        )->result_array();
    }

    public function save_signage_record($data)
	{
        $this->db->insert('signage',$data);
        return true;
	}

    public function get_area_towns($postdata)
    {
        $this->db->select('id,town');
        $this->db->from('town');
        $this->db->where('area_council_id', $postdata['area']);
        return $this->db->get()->result();
    }

    //delete a signage record
    public function delete_signage_records($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("signage");
        return true;
    }
}