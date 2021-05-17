<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CronModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    //	get residence
    	public function get_residence(){
    		$this->db->select('id,res_code,noOfResidents,building_type,property_type,construction_material,roofing_type,no_of_floors,no_of_rooms');
        $this->db->from('residence');
        $residence = $this->db->get()->result();
    		return($residence);
      }
      
    //	get residence
      public function get_all_residence(){
        $this->db->select('*');
        $this->db->from('residence');
        $residence = $this->db->get()->result();
        return($residence);
      }

    //	get residence owner id
    public function get_owner_id($id){
      $this->db->select('owner_id');
      $this->db->from('residence_to_owner');
      $this->db->where('property_id',$id);
      $owner_id = $this->db->get()->row_array()['owner_id'];
      return($owner_id);
    }

    //	add property
    public function add_property($data)
    {
        $insert = $this->db->insert('buisness_property', $data);
        return $this->db->insert_id();
    }

    //assign owner to property
    public function add_property_to_owner($res_id, $owner_id)
    {
        $data = array(
            'owner_id' => $owner_id,
            'property_id' => $res_id
        );
        $insert = $this->db->insert('buis_prop_to_owner', $data);
        return $this->db->insert_id();
    }

    //	get residence owner id
    public function update_access_residence($old_id,$new_id){
      $where = array(
        'target' => 1,
        'property_id' => $old_id
      );

      $data = array(
        'property_id' => $new_id
      );

      $this->db->where($where);
      return $this->db->update('accessed_property',$data);
    }

    //	get residence owner id
    public function get_residence_category($id){

      $this->db->select('*');
      $this->db->from('res_to_category');
      $this->db->where('property_id',$id);
      $category = $this->db->get()->row_array();
      return($category);

    }

     //	get residence owner id
     public function update_invoice_id($old_id,$new_id){
      $where = array(
        'product_id' => 13,
        'property_id' => $old_id
      );

      $data = array(
        'property_id' => $new_id
      );

      $this->db->where($where);
      return $this->db->update('invoice',$data);
    }

    //add business categories
    public function add_property_to_category($category)
    {
      $insert = $this->db->insert('busprop_to_category', $category);
      return $this->db->insert_id();
    }


    //	get business property
    	public function get_business_property(){
    		$this->db->select('id,buis_prop_code,noOfOccupants,property_category,buis_sector,property_typee');
        $this->db->from('buisness_property');
        $business = $this->db->get()->result();
    		return($business);
    	}

    //	get household count
    	public function get_household_count($res_code){
    		$this->db->select('count(*) as count1');
        $this->db->from('household');
        $this->db->where('res_prop_code',$res_code);
        $household = $this->db->get()->row_array()["count1"];
    		return($household);
    	}

    //	get business occupant count
    	public function get_busocc_count($busprop_code){
    		$this->db->select('count(*) as count1');
        $this->db->from('buisness_occ');
        $this->db->where('buis_property_code',$busprop_code);
        $busocc = $this->db->get()->row_array()["count1"];
    		return($busocc);
    	}

    //	get residence
    	public function get_cat6(){
    		$this->db->select('id');
        $this->db->from('product_category6');
        $residence = $this->db->get()->result();
    		return($residence);
    	}

  // update residence
    public function update_residence_status($data,$id){

        $this->db->where($id);
        return $this->db->update('residence',$data);
    }

  // update residence
    public function update_busprop_status($data,$id){

        $this->db->where($id);
        return $this->db->update('buisness_property',$data);
    }

  // update residence
    public function update_cat6($data,$id){

        $this->db->where($id);
        return $this->db->update('product_category6',$data);
    }

  // set property to ungenerated
    public function set_property_to_ungenerated($data){

      $this->db->update('residence',$data);

      $this->db->update('buisness_property',$data);

      $this->db->update('buisness_occ',$data);

      return $this->db->update('signage',$data);
    }
  
  // get already generated invoices
    public function get_already_generated_invoices($year){
      $this->db->select('i.property_id,i.target');
      $this->db->from('vw_invoice as i');
      $this->db->where('i.invoice_year',$year);
      $invoices = $this->db->get()->result();
      return($invoices);
    }
    
    public function add_residence_category($data){
        $insert = $this->db->insert('res_to_category',$data);
        return $this->db->insert_id();
    }
    
    public function add_busprop_category($data){
        $insert = $this->db->insert('busprop_to_category',$data);
        return $this->db->insert_id();
    }
    
    public function get_busprop_categories(){
        $this->db->select('b.*');
        $this->db->from('busprop_to_category b');
        $bus_categories = $this->db->get()->result();
        return($bus_categories);
    }

    public function get_busocc_categories(){
      $this->db->select('b.*');
      $this->db->from('busocc_to_category b');
      $this->db->where('b.category5',0);
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

    public function get_invoices(){
      $this->db->select('b.id,b.area_council_id');
      $this->db->from('vw_invoice b');
      $this->db->where('b.area_council_id',3);
      $invoices = $this->db->get()->result();
      return($invoices);
    }


    public function get_busocc_categories6(){
      $this->db->select('b.*');
      $this->db->from('busocc_to_category b');
      $this->db->where('b.category6',0);
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

    public function get_product_category5(){
      $this->db->select('b.*');
      $this->db->from('product_category6 b');
      $this->db->where('b.category5_id',0);
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

    public function get_product_category6(){
      $this->db->select('b.*');
      $this->db->from('product_category6 b');
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

    public function get_invoice_category5(){
      $this->db->select('b.*');
      $this->db->from('invoice b');
      $this->db->where('b.category5_id',0);
      $this->db->where('b.product_id',1);
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

    public function get_invoice_category6(){
      $this->db->select('b.*');
      $this->db->from('product_category6 b');
      $this->db->where('b.category6_id',0);
      $this->db->where('b.product_id',1);
      $bus_categories = $this->db->get()->result();
      return($bus_categories);
    }

}
