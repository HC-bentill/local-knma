<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TelecomModel extends CI_Model
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

    public function get_telecom_vendors(){
		$this->db->select('id,name');
		$this->db->from('telecomvendors');
	    return $this->db->get()->result();
    }

    public function get_telecom_networks(){
		$this->db->select('id,name');
		$this->db->from('telecomnetworks');
	    return $this->db->get()->result();
    }

    //	get towns and display on the add telecom.
	public function get_towns(){
		$this->db->select('id,town');
		$this->db->from('town');
	    return $this->db->get()->result();
    }
    //save telecom data in db
    public function save_telecom_record($data)
	{
        $this->db->insert('telecom',$data);
        return true;
	}
    //generate serial number
    public function serial_number() {
        $this->db->select('id');
		$this->db->from('telecom');
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
    //	get telecom data and display on the telecom page
	public function get_telecom($last_date){
		$data = $this->db->query("select a.id as id, a.code as code, b.name as vendor, c.name as network, a.site_status as site_status, d.name as area_council, e.town as town, a.created_by as created_by, a.email as email, a.contact as contact from telecom a left join telecomvendors b on a.telecom_vendor_name = b.id left join telecomnetworks c on a.telecom_network_name = c.id left join area_council d on a.area_council = d.id left join town e on a.town = e.id;")->result();
		return($data);
        // WHERE date(a.datetime_created) = '$last_date'
    }

    // get last date from residence table
    public function get_telecom_date(){
        $this->db->select('date(datetime_created) as date1');
        $this->db->from("telecom");
        $this->db->order_by("id",'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

        //	get telecom details from db
	public function get_telecom_details($a){
		$telecom = $this->db->query("select t.*, v.name as vendor_name, n.name as network_name, a.name as area_name, w.town as town_name from telecom t left join outdoorvendors v on t.telecom_vendor_name = v.id left join telecomnetworks n on t.telecom_network_name = n.id left join area_council a on t.area_council = a.id left join town w on t.town = w.id where t.id = '$a'")->row_array();
		// $signage = $this->db->query("SELECT * FROM signage")->row_array();
		return($telecom);
    }

    // update telecom table
    public function update_telecom_data($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('telecom',$data);
    }

    //delete a telecom record
    public function delete_telecom_records($id)
    {
        $this->db->where("id", $id);
        $this->db->delete("telecom");
        return true;
    }
    
}