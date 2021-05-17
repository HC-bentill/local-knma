<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class MapApi extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}


	public function getLocationDetails_post()
    {
        
        $flag = $this->post('flag');
        $payment_status = $this->post('payment_status');//array('FULLY_PAID','PARTLY_PAID');
        $area_council = $this->post('area_council');
        $town = $this->post('town');
        $property_code = $this->post('property_code');
        if($this->post('year') == ""){
            $year = date('Y');
        }else{
            $year = $this->post('year');
        }
        if($payment_status == ""){
            $payment_where = "";
        }else{
            $payment = explode(',',$payment_status);
            $payment_where = array();
            foreach($payment as $pay){
                $payment_where[] = $pay;
            }
        }
        
        if($flag == "r"){
        
            $this->db->select('i.invoice_no,r.res_code,r.gps_lat,r.gps_long,i.payment_status,concat(prop.firstname," ",prop.lastname) as owner_name,prop.primary_contact as owner_phoneno,a.name as area_council,t.town as town');
            $this->db->from('residence as r');
            $this->db->join('residence_to_owner as ro','r.id = ro.property_id','left');
            $this->db->join('property_owner as prop','ro.owner_id = prop.id','left');
            $this->db->join('town as t','r.town = t.id','left');
            $this->db->join('area_council as a','r.area_council = a.id','left');
            $this->db->join("vw_invoice as i","i.property_id = r.id");
            $this->db->join("revenue_product as rp","rp.id = i.product_id");
            $this->db->where("r.gps_lat <> 0 AND r.gps_long <> 0 AND rp.target = 1");
            ($payment_where) ? $this->db->where_in('i.payment_status', $payment_where) : NULL;
            ($area_council) ? $this->db->where('a.id', $area_council) : NULL;
            ($town) ? $this->db->where('t.id', $town) : NULL;
            ($property_code) ? $this->db->where('r.res_code', $property_code) : NULL;
            ($year) ? $this->db->where('i.invoice_year', $year) : NULL;
            $query = $this->db->get();
            if($query->num_rows() == 0){
                $array = array(
                    'status_code' => '400',
                    'status' => 'nothing found'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }else if($query->num_rows() > 0){
                $this->set_response($query->result(), REST_Controller::HTTP_OK);
            }else{
                $array = array(
                    'status_code' => '500',
                    'status' => 'failed'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }
        }else if($flag == "b"){
            $this->db->select('i.invoice_no,b.buis_prop_code,b.gps_lat,b.gps_long,i.payment_status,concat(prop.firstname," ",prop.lastname) as owner_name,prop.primary_contact as owner_phoneno,a.name as area_council,t.town as town');
            $this->db->from('buisness_property as b');
            $this->db->join('buis_prop_to_owner as ro','b.id = ro.property_id','left');
            $this->db->join('property_owner as prop','ro.owner_id = prop.id','left');
            $this->db->join('town as t','b.town = t.id','left');
            $this->db->join('area_council as a','b.area_council = a.id','left');
            $this->db->join("vw_invoice as i","i.property_id = b.id");
            $this->db->join("revenue_product as rp","rp.id = i.product_id");
            $this->db->where("b.gps_lat <> 0 AND b.gps_long <> 0 AND rp.target = 2");
            ($payment_where) ? $this->db->where_in('i.payment_status', $payment_where) : NULL;
            ($area_council) ? $this->db->where('a.id', $area_council) : NULL;
            ($town) ? $this->db->where('t.id', $town) : NULL;
            ($property_code) ? $this->db->where('b.buis_prop_code', $property_code) : NULL; 
            ($year) ? $this->db->where('i.invoice_year', $year) : NULL;
            $query = $this->db->get();

            if($query->num_rows() == 0){
                $array = array(
                    'status_code' => '400',
                    'status' => 'nothing found'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }else if($query->num_rows() > 0){
                $this->set_response($query->result(), REST_Controller::HTTP_OK);
            }else{
                $array = array(
                    'status_code' => '500',
                    'status' => 'failed'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }
        }else if($flag == "bo"){
            $this->db->select('i.invoice_no,b.buis_occ_code,bo.gps_lat,bo.gps_long,i.payment_status,b.buis_name as business_name,b.buis_primary_phone as owner_phoneno,a.name as area_council,t.town as town');
            $this->db->from('buisness_occ as b');
            $this->db->join('buisness_property as bo','b.buis_property_code = bo.buis_prop_code','left');
            $this->db->join('town as t','bo.town = t.id','left');
            $this->db->join('area_council as a','bo.area_council = a.id','left');
            $this->db->join('buis_occ_to_owner as ro','b.id = ro.property_id','left');
            $this->db->join("vw_invoice as i","i.property_id = b.id");
            $this->db->join("revenue_product as rp","rp.id = i.product_id");
            $this->db->where("bo.gps_lat <> 0 AND bo.gps_long <> 0 AND rp.target = 3");
            ($payment_where) ? $this->db->where_in('i.payment_status', $payment_where) : NULL;
            ($area_council) ? $this->db->where('a.id', $area_council) : NULL;
            ($town) ? $this->db->where('t.id', $town) : NULL;
            ($property_code) ? $this->db->where('b.buis_occ_code', $property_code) : NULL; 
            ($year) ? $this->db->where('i.invoice_year', $year) : NULL;
            $query = $this->db->get();

            if($query->num_rows() == 0){
                $array = array(
                    'status_code' => '400',
                    'status' => 'nothing found'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }else if($query->num_rows() > 0){
                $this->set_response($query->result(), REST_Controller::HTTP_OK);
            }else{
                $array = array(
                    'status_code' => '500',
                    'status' => 'failed'
                );
                $this->set_response($array, REST_Controller::HTTP_OK);
            }
        }else{
            $array = array(
                'status_code' => '500',
                'status' => 'failed'
            );
            $this->set_response($array, REST_Controller::HTTP_OK);
        }

    }

    public function getAreaTown_post()
    {
    	
        $id = $this->post('areaCouncil');
		$this->db->select('id,town');
		$this->db->from('town');
		$this->db->where('area_council_id',$id);
		$query = $this->db->get()->result();
		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$array = array(
                'status_code' => '500',
                'status' => 'failed'
            );
            $this->set_response($array, REST_Controller::HTTP_OK);
		}

    }
    
    public function getAreaCouncil_post()
    {
    	
		$this->db->select('id,name as area_council');
		$this->db->from('area_council');
		$query = $this->db->get()->result();
		if($query){
			$this->set_response($query, REST_Controller::HTTP_OK);
		}else{
			$array = array(
                'status_code' => '500',
                'status' => 'failed'
            );
            $this->set_response($array, REST_Controller::HTTP_OK);
		}

	}
	

}
