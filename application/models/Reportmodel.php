<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportmodel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

//	get channel and display on the channel manager page 
	public function get_channel(){
		$channel = $this->db->query("SELECT * FROM channels ")->result();
		return($channel);
	}
        
//	totak revenue stream
	public function total_revenue($year, $lowerDateBound, $upperDateBound) {
		$query = (
			"SELECT
			sum(invoice_amount) as inv_amount,
			sum(amount_paid) as amt_paid
			FROM
				invoice
			WHERE
				invoice_year = '$year'
			AND
				DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
			BETWEEN '$lowerDateBound' AND '$upperDateBound'
			"
		);
		$total_revenue = $this->db->query($query)->row_array();
		return($total_revenue);
	}
    
//	total revenue stream at area council leevel
	public function area_council_total_revenue_old($year, $lowerDateBound, $upperDateBound){
		$total_revenue = $this->db->query(
			"SELECT
				COALESCE(area_council, 'NOT_PROVIDED') as area_council,
				COALESCE(name, 'NOT_PROVIDED') as name,
				sum(total_amount) as total_amount,
				sum(amount_paid) as amount_paid
			from (
				SELECT
					b.area_council as area_council,
					a.name as name,sum(i.invoice_amount) as total_amount,
					sum(i.amount_paid) as amount_paid
				from
					invoice i
				left join
					buisness_property b
				on
					i.property_id = b.id
				left join
					revenue_product r
				on
					r.id = i.product_id
				left join
					area_council a
				on
					b.area_council = a.id
				WHERE
					r.target = 2
				AND
					i.invoice_year = '$year'
				AND
					DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
				BETWEEN '$lowerDateBound' AND '$upperDateBound'
				group by
					b.area_council
				UNION ALL
				SELECT
					bb.area_council as area_council,a.name as name,
					sum(i.invoice_amount) as total_amount,
					sum(i.amount_paid) as amount_paid
				from
					invoice i 
				left join
					buisness_occ o
				on
					i.property_id = o.id
				left join
					buisness_property bb
				on
					o.buis_property_code = bb.buis_prop_code
				left join
					revenue_product r
				on
					r.id = i.product_id
				left join
					area_council a
				on
					bb.area_council = a.id
				WHERE
					r.target = 3
				AND
					i.invoice_year = '$year'
				AND
					DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
				BETWEEN '$lowerDateBound' AND '$upperDateBound'
				group by
					bb.area_council
				UNION ALl
				SELECT
					b.area_council as area_council,
					a.name as name, sum(i.invoice_amount) as total_amount,
					sum(i.amount_paid) as amount_paid
				from
					invoice i
				left join
					residence b
				on
					i.property_id = b.id
				left join
					revenue_product r
				on
					r.id = i.product_id
				left join
					area_council a
				on
					b.area_council = a.id
				WHERE
					r.target = 1
				AND
					i.invoice_year = '$year'
				AND
					DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
				BETWEEN '$lowerDateBound' AND '$upperDateBound'
				group by
					b.area_council
				) t
			GROUP BY
				area_council, name"
		)->result();
		return($total_revenue);
	}

	
//	total revenue stream at area council leevel
	public function area_council_total_revenue($year, $lowerDateBound, $upperDateBound){
		$total_revenue = $this->db->query(
			"SELECT
				COALESCE(area_council, 'NOT_PROVIDED') as area_council,
				COALESCE(name, 'NOT_PROVIDED') as name,
				sum(total_amount) as total_amount,
				sum(amount_paid) as amount_paid
			from (
				SELECT
					b.area_council as area_council,
					a.name as name,sum(i.invoice_amount) as total_amount,
					sum(i.amount_paid) as amount_paid
				from
					invoice i
				left join
					buisness_property b
				on
					i.property_id = b.id
				left join
					revenue_product r
				on
					r.id = i.product_id
				left join
					area_council a
				on
					b.area_council = a.id
				WHERE
					r.target = 2
				OR
					r.target = 1
				AND
					i.invoice_year = '$year'
				AND
					DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
				BETWEEN '$lowerDateBound' AND '$upperDateBound'
				group by
					b.area_council
				UNION ALL
				SELECT
					bb.area_council as area_council,a.name as name,
					sum(i.invoice_amount) as total_amount,
					sum(i.amount_paid) as amount_paid
				from
					invoice i 
				left join
					buisness_occ o
				on
					i.property_id = o.id
				left join
					buisness_property bb
				on
					o.buis_property_code = bb.buis_prop_code
				left join
					revenue_product r
				on
					r.id = i.product_id
				left join
					area_council a
				on
					bb.area_council = a.id
				WHERE
					r.target = 3
				AND
					i.invoice_year = '$year'
				AND
					DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
				BETWEEN '$lowerDateBound' AND '$upperDateBound'
				group by
					bb.area_council
				) t
			GROUP BY
				area_council, name"
		)->result();
		return($total_revenue);
	}      
//	total revenue stream at area council leevel
	public function revenue_per_streams($year, $lowerDateBound, $upperDateBound){
		$total_revenue = $this->db->query(
			"SELECT
				r.name, r.id, r.target, sum(invoice_amount) as total_amount,
				sum(amount_paid) as amount_paid
			from
				invoice i
			right join
				revenue_product r
			on
				i.product_id = r.id
			WHERE
				i.invoice_year = '$year'
			AND
				DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
			BETWEEN '$lowerDateBound' AND '$upperDateBound'
			GROUP BY
				i.product_id,r.id
			"
		)->result();
		return($total_revenue);
	}

//	total revenue stream at area council leevel
	public function revenue_per_business_type2(){
		$total_revenue = $this->db->query("SELECT p.name ,p.id, sum(invoice_amount) as total_amount,sum(amount_paid) as amount_paid from invoice i right join product_category1 p on i.category1_id = p.id WHERE p.product_id = 1 GROUP BY p.id")->result();
		return($total_revenue);
	}

//	total revenue stream at area council leevel
	public function revenue_per_business_type($year, $lowerDateBound, $upperDateBound){
		$total_revenue = $this->db->query(
			"SELECT
				p.name ,p.id, sum(invoice_amount) as total_amount,
				sum(amount_paid) as amount_paid
			from
				invoice i
			right join
				product_category1 p
			on
				i.category1_id = p.id
			WHERE
				p.product_id = 1
			AND
				i.invoice_year = '$year'
			AND
				DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
			BETWEEN '$lowerDateBound' AND '$upperDateBound'
			GROUP BY
				p.id
			"
		)->result();
		return($total_revenue);
	}
	
// update account status
	public function update_status($channelid,$state){
			
		$my_own_query = "Update channels set active = '$state' where channelid = '$channelid'";
		$query = $this->db->query($my_own_query);		
	}

//	get channel status
	public function channelstatus($a){
		$status = $this->db->query("SELECT active FROM channels WHERE channelid = $a")->row_array()['active'];
		return($status);
	}

//	get all data
	public function gender_data($a){
		$this->db->select('*');
	    $this->db->from("household");
	    $this->db->where("gender",$a);
	    return $this->db->get()->result();
	}

//	get all data
	public function gender_area_council_data($a,$b){
		$this->db->select('h.*');
	    $this->db->from("household as h");
	    $this->db->where("r.area_council",$b);
	    $this->db->where("h.gender",$a);
	    $this->db->join('residence as r','r.res_code = h.res_prop_code');
		return $this->db->get()->result();
	}

//	get all data
	public function gender_town_data($a,$b){
		$this->db->select('h.*');
	    $this->db->from("household as h");
	    $this->db->where("r.town",$b);
	    $this->db->where("h.gender",$a);
	    $this->db->join('residence as r','r.res_code = h.res_prop_code');
		return $this->db->get()->result();
	}

//	get all data
	public function get_towns($a){
		$this->db->select('id,town');
	    $this->db->from("town");
	    $this->db->where("area_council_id",$a);
		return $this->db->get()->result();
	}

//	get all data
	public function get_town_name($a){
		$this->db->select('town');
	    $this->db->from("town");
	    $this->db->where("id",$a);
		return $this->db->get()->row_array()['town'];
	}

//	get all data
	public function employment_data($a){
		$this->db->select('*');
	    $this->db->from("household");
	    $this->db->where("employment_status",$a);
	    return $this->db->get()->result();
	}

//	get all data
	public function educational_data($a){
		$this->db->select('*');
	    $this->db->from("household");
	    $this->db->where("highest_edu",$a);
	    return $this->db->get()->result();
	}

//	get all data
	public function profession_data($a){
		$this->db->select('*');
	    $this->db->from("household");
	    $this->db->where("profession",$a);
	    return $this->db->get()->result();
	}

//	get all data
	public function educational_area_council_data($id,$edu_id){
		$this->db->select('g.*');
	    $this->db->from("household as g");
	    $this->db->where("r.area_council",$id);
	    $this->db->where("g.highest_edu",$edu_id);
	    $this->db->join('residence as r','r.res_code = g.res_prop_code');
	    return $result = $this->db->get()->result();
	}

//	get all data
	public function profession_area_council_data($id,$prof_id){
		$this->db->select('g.*');
	    $this->db->from("household as g");
	    $this->db->where("r.area_council",$id);
	    $this->db->where("g.profession",$prof_id);
	    $this->db->join('residence as r','r.res_code = g.res_prop_code');
	    return $result = $this->db->get()->result();
	}

//	get all data
	public function educational_town_data($id,$edu_id){
		$this->db->select('g.*');
	    $this->db->from("household as g");
	    $this->db->where("r.town",$id);
	    $this->db->where("g.highest_edu",$edu_id);
	    $this->db->join('residence as r','r.res_code = g.res_prop_code');
	    return $result = $this->db->get()->result();
	}

//	get all data
	public function profession_town_data($id,$prof_id){
		$this->db->select('g.*');
	    $this->db->from("household as g");
	    $this->db->where("r.town",$id);
	    $this->db->where("g.profession",$prof_id);
	    $this->db->join('residence as r','r.res_code = g.res_prop_code');
	    return $result = $this->db->get()->result();
	}

//	get all data
	public function employment_area_council_data($a,$b){
		$this->db->select('h.*');
	    $this->db->from("household as h");
	    $this->db->where("r.area_council",$b);
	    $this->db->where("h.employment_status",$a);
	    $this->db->join('residence as r','r.res_code = h.res_prop_code');
	    return $this->db->get()->result();
	}

//	get all data
	public function employment_town_data($a,$b){
		$this->db->select('h.*');
	    $this->db->from("household as h");
	    $this->db->where("r.town",$b);
	    $this->db->where("h.employment_status",$a);
	    $this->db->join('residence as r','r.res_code = h.res_prop_code');
		return $this->db->get()->result();
	}

//	get all data
	public function get_area_council_name($b){
		$this->db->select('name');
	    $this->db->from("area_council");
	    $this->db->where("id",$b);
		return $this->db->get()->row_array()['name'];
	}

//	get all data
	public function data($data){
		if($data == "Household"){
	    	$this->db->select('*');
	        $this->db->from("household as h");
	        $this->db->join('residence as r','r.res_code = h.res_prop_code');
	        return $result = $this->db->get()->result();

	    }elseif($data == "Residence"){
	        return $result = $this->db->query("SELECT residence.* ,t.town as tt, a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id order by id asc")->result();

	    }elseif($data == "Business Property"){
	        return $result = $this->db->query("SELECT buisness_property.* ,t.town as tt, a.name as area FROM buisness_property left join town t on buisness_property.town = t.id left join area_council a on buisness_property.area_council = a.id order by id asc")->result();

	    }elseif($data == "Business Occupants"){
	    	$this->db->select('*');
	        $this->db->from("buisness_occ as h");
	        $this->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
	        return $result = $this->db->get()->result();
	    }
	}

//	get all data
	public function area_council_data($data,$id){
		$CI = & get_instance();

	    if($data == "Household"){
	    	$this->db->select('h.*');
	        $this->db->from("household as h");
	        $this->db->where("r.area_council",$id);
	        $this->db->join('residence as r','r.res_code = h.res_prop_code');
	        return $result = $this->db->get()->result();

	    }elseif($data == "Residence"){
	        return $result = $this->db->query("SELECT residence.* ,t.town as tt, a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id WHERE residence.area_council = $id order by id asc")->result();

	    }elseif($data == "Business Property"){
	        return $result = $this->db->query("SELECT buisness_property.* ,t.town as tt, a.name as area FROM buisness_property left join town t on buisness_property.town = t.id left join area_council a on buisness_property.area_council = a.id WHERE buisness_property.area_council = $id order by id asc")->result();

	    }elseif($data == "Business Occupants"){
	    	$this->db->select('h.*');
	        $this->db->from("buisness_occ as h");
	        $this->db->where("r.area_council",$id);
	        $this->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
	        return $result = $this->db->get()->result();
	    }
	}

//	get all data
	public function town_data($data,$id){
		$CI = & get_instance();

	    if($data == "Household"){
	    	$this->db->select('h.*');
	        $this->db->from("household as h");
	        $this->db->where("r.town",$id);
	        $this->db->join('residence as r','r.res_code = h.res_prop_code');
	        return $result = $this->db->get()->result();

	    }elseif($data == "Residence"){
	        return $result = $this->db->query("SELECT residence.* ,t.town as tt, a.name as area FROM residence left join town t on residence.town = t.id left join area_council a on residence.area_council = a.id WHERE residence.town = $id order by id asc")->result();

	    }elseif($data == "Business Property"){
	        return $result = $this->db->query("SELECT buisness_property.* ,t.town as tt, a.name as area FROM buisness_property left join town t on buisness_property.town = t.id left join area_council a on buisness_property.town = a.id WHERE buisness_property.area_council = $id order by id asc")->result();

	    }elseif($data == "Business Occupants"){
	    	$this->db->select('h.*');
	        $this->db->from("buisness_occ as h");
	        $this->db->where("r.town",$id);
	        $this->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
	        return $result = $this->db->get()->result();
	    }
	}

//	get educational level
	public function get_edu(){
		$this->db->select('id,level');
		$this->db->from('education');
	    return $this->db->get()->result();
	}

//	get profession
	public function get_prof(){
		$this->db->select('id,name');
		$this->db->from('profession');
	    return $this->db->get()->result();
	}

//	get educational name
	public function get_eduname($id){
		$this->db->select('level');
		$this->db->from('education');
		$this->db->where('id',$id);
	    return $this->db->get()->row_array()['level'];
	}

//	get educational name
	public function get_profname($id){
		$this->db->select('name');
		$this->db->from('profession');
		$this->db->where('id',$id);
	    return $this->db->get()->row_array()['name'];
	}

	//get the years that reports are available for
	public function get_invoice_years() {
		$this->db->distinct();
		$this->db->select('invoice_year');
		$this->db->from('invoice');
		return $this->db->get()->result();
	}
	
}