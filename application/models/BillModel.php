<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class BillModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    // get products
    public function get_product($pid)
    {
        $this->db->select('*');
        $this->db->from('revenue_product');
        $this->db->where('target <> ""');
        if($pid){
            $this->db->where('id', $pid);
        }else{
            
        }
        $products = $this->db->get()->result();
        return ($products);
    }

    // batch bill generation records
    public function bill_generation()
    {
        $this->db->select('b.*,t.town as town ,a.name as area,r.name as product_name');
        $this->db->from('batch_bill_generation as b');
        $this->db->join('town as t', 'b.town = t.id', 'left');
        $this->db->join('area_council as a', 'b.area_council = a.id', 'left');
        $this->db->join('revenue_product as r', 'r.id = b.product', 'left');
        $bills = $this->db->get()->result();
        return ($bills);
    }
    
    //    get business occupant categories
    public function get_ungenerated_busocc_categories($electoral_area,$town,$runtime,$id)
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_occ o');
        $this->db->join('busocc_to_category b', 'b.busocc_id = o.id');
        $this->db->join('buisness_property as p', 'o.buis_property_code = p.buis_prop_code');

        if($runtime == "normal"){
            $this->db->where('o.invoice_status', 0);
        }

        if($electoral_area){
            $this->db->where('p.area_council', $electoral_area);
        }
        
        if($town){
            $this->db->where('p.town', $town);
        }

        if($id){
            $this->db->where('o.id', $id);
        }
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    // get business and display on the business page
    public function get_ungenerated_business_prop($electoral_area,$town,$runtime,$id,$category)
    {

        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_property o');
        $this->db->join('busprop_to_category b', 'b.property_id = o.id');
        if($runtime == "normal"){
            $this->db->where('o.invoice_status', 0);
        }
        if($electoral_area){
            $this->db->where('o.area_council', $electoral_area);
        }

        if($town){
            $this->db->where('o.town', $town);
        }

        if($category){
            $this->db->where('o.category', $category);
        }

        if($id){
            $this->db->where('o.id', $id);
        }
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    // get business and display on the business page
     public function get_ungenerated_residence_prop($electoral_area,$town,$runtime,$id)
     {
 
        $this->db->select('b.*,o.accessed');
        $this->db->from('residence o');
        $this->db->join('res_to_category b', 'b.property_id = o.id');
        if($runtime == "normal"){
            $this->db->where('o.invoice_status', 0);
        }

        if($electoral_area){
            $this->db->where('o.area_council', $electoral_area);
        }

        if($town){
            $this->db->where('o.town', $town);
        }

        if($id){
            $this->db->where('o.id', $id);
        }
         $bus_categories = $this->db->get()->result();
         return ($bus_categories);
    }

    //  get signages whose bills have not been generated
    public function get_ungenerated_signage($electoral_area,$town,$runtime,$id)
    {
        $this->db->select('s.*');
        $this->db->from('signage s');
        $this->db->where('s.invoice_status', 0);
        $signages = $this->db->get()->result();
        return ($signages);
    }

    // save batch print invoice in db
    public function save_bill_batch($data)
    {
        $insert = $this->db->insert('batch_bill_generation', $data);
        return $this->db->insert_id();
    }


    // check if invoice already exit
    public function check_invoice_exist($where)
    {
        $this->db->select('id,invoice_no,adjustment_amount');
        $this->db->from('vw_invoice as i');
        $this->db->where($where);
        return $query = $this->db->get()->row_array();
    }

    //update invoice amount
    public function update_invoice_record($update_data,$update_where)
    {
        $this->db->where($update_where);
        return $this->db->update('invoice', $update_data);
    }

}
