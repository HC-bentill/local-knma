<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class TaxModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    //    get products
    public function get_product()
    {
        $this->db->select('*');
        $this->db->from('revenue_product');
        $this->db->where('target <> ""');
        $products = $this->db->get()->result();
        return ($products);
    }

    //    get particular products
    public function get_part_product($id)
    {
        $this->db->select('code');
        $this->db->from('revenue_product');
        $this->db->where('id', $id);
        $products = $this->db->get()->row_array();
        return ($products);
    }

	// get code
    public function get_code($product, $year)
    {

        $where = array(
            'product_id' => $product,
            'invoice_year' => $year,
        );
        $this->db->select('count(*) as count');
        $this->db->from('invoice');
        $this->db->where($where);
        $products = $this->db->get()->row_array()['count'];
        return ($products);
    }

	//check if batch exist
    public function batch_exit($product, $category1, $year, $electoral_area, $town)
    {

        $this->db->select('count(*) as count');
        $this->db->from('batch_print_invoice');
        ($product) ? $this->db->where('product', $product) : null;
        ($category1) ? $this->db->where('category1', $category1) : null;
        ($year) ? $this->db->where('year', $year) : null;
        ($electoral_area) ? $this->db->where('electoral_area', $electoral_area) : null;
        ($town) ? $this->db->where('town', $town) : null;  
        $products = $this->db->get()->row_array()['count'];

        if ($products > 0) {
            return true;
        } else {
            return false;
        }
    }

	//get batch count
    public function get_batch_count()
    {

        $this->db->select('count(*) as count');
        $this->db->from('batch_print_invoice');
        $batch_no = $this->db->get()->row_array()['count'];
        return ($batch_no);
    }

    //delete a batch invoice record
    public function deleterecords($id)
    {
      $this->db->where("id", $id);
      $this->db->delete("batch_print_invoice");
      return true;
    }

    //get batch bill count
    public function get_batch_bill_count()
    {

        $this->db->select('count(*) as count');
        $this->db->from('batch_bill_generation');
        $batch_no = $this->db->get()->row_array()['count'];
        return ($batch_no);
    }

	//get all print invoices batches
    public function get_batches()
    {
        $this->db->select('b.batch_no,b.property_category,b.product as product_id,b.category1 as category1_id,b.year,b.electoral_area as area_id,b.town as town_id,t.town as town ,a.name as area,r.name, r.target,c.name as category1,b.datetime_created, b.id as bi_id');
        $this->db->from('batch_print_invoice as b');
        $this->db->join('town as t', 'b.town = t.id', 'left');
        $this->db->join('area_council as a', 'b.electoral_area = a.id', 'left');
        $this->db->join('revenue_product as r', 'r.id = b.product', 'left');
        $this->db->join('product_category1 as c', 'c.id = b.category1', 'left');
        $this->db->order_by('1','desc');

        $batch = $this->db->get()->result();
        return ($batch);
    }

	//    get tax Assignment
    public function get_tax_assignment()
    {
        $this->db->select('t.*, r.name, r.target,c.name as category1,d.name as category2,e.name as category3,f.name as category4,g.name as category5,h.name as category6');
        $this->db->from('tax_assignment as t');
        $this->db->join('revenue_product as r', 'r.id = t.product_id');
        $this->db->join('product_category1 as c', 'c.id = t.category1_id', 'left');
        $this->db->join('product_category2 as d', 'd.id = t.category2_id', 'left');
        $this->db->join('product_category3 as e', 'e.id = t.category3_id', 'left');
        $this->db->join('product_category4 as f', 'f.id = t.category4_id', 'left');
        $this->db->join('product_category5 as g', 'g.id = t.category5_id', 'left');
        $this->db->join('product_category6 as h', 'h.id = t.category6_id', 'left');
        $products = $this->db->get()->result();
        return ($products);
    }

	//    get all invoices
    public function get_invoice($product, $category1, $category2, $category3, $category4, $category5, $category6)
    {
        $this->db->select('i.*, r.name, r.target,c.name as category1,d.name as category2,e.name as category3, f.name as category4,g.name as category5,
          h.name as category6, b.buis_name, b.buis_occ_code, p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName, rd.res_code,
          concat(prop.firstname, " ", prop.lastname) as roName');
        $this->db->from('invoice as i');
        $this->db->join('revenue_product as r', 'r.id = i.product_id');
        $this->db->join('product_category1 as c', 'c.id = i.category1_id', 'left');
        $this->db->join('product_category2 as d', 'd.id = i.category2_id', 'left');
        $this->db->join('product_category3 as e', 'e.id = i.category3_id', 'left');
        $this->db->join('product_category4 as f', 'f.id = i.category4_id', 'left');
        $this->db->join('product_category5 as g', 'g.id = i.category5_id', 'left');
        $this->db->join('product_category6 as h', 'h.id = i.category6_id', 'left');
        $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
        $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
        $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
        $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
        $this->db->limit(50);
        $this->db->order_by('i.id', "desc");
        ($product) ? $this->db->where('i.product_id', $product) : null;
        ($category1 != 0) ? $this->db->where('i.category1_id', $category1) : null;
        ($category2 != 0) ? $this->db->where('i.category2_id', $category2) : null;
        ($category3 != 0) ? $this->db->where('i.category3_id', $category3) : null;
        ($category4 != 0) ? $this->db->where('i.category4_id', $category4) : null;
        ($category5 != 0) ? $this->db->where('i.category5_id', $category5) : null;
        ($category6 != 0) ? $this->db->where('i.category6_id', $category6) : null;
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->result();
            $query->free_result();
        } else {
            $data = $query->result();
        }

        return ($data);
    }

	//    get all invoices to be printed
    public function get_batch_invoices_old($property_category, $year, $electoral_area, $town,$offset)
    {
        
        if ($town == "0") {
            if ($property_category == 1) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "rp.area_council" => $electoral_area,
                );
            } elseif ($property_category == 2) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "p.area_council" => $electoral_area,
                );
            } elseif ($property_category == 3) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "z.area_council" => $electoral_area,
                );
            }
        } else {
            if ($property_category == 1) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "rp.area_council" => $electoral_area,
                    "rp.town" => $town,
                );
            } elseif ($property_category == 2) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "p.area_council" => $electoral_area,
                    "p.town" => $town,
                );
            } elseif ($property_category == 3) {
                $where = array(
                    "r.target" => $property_category,
                    "i.invoice_year" => $year,
                    "z.area_council" => $electoral_area,
                    "z.town" => $town,
                );
            }
        }
        $this->db->select(
			'i.*, r.name, r.target,c.name as category1,d.name as category2,
			e.name as category3,f.name as category4, b.buis_name,b.buis_property_code, b.buis_email,
			b.buis_occ_code, b.buis_primary_phone,p.buis_prop_code,rp.res_code,
			concat(prop.firstname, " ", prop.lastname) as roName, 
			concat(po.firstname, " ", po.lastname) as boName,
			po.primary_contact,rp.town as res_town,p.town as bus_town,z.town as busocc_town'
		);
        $this->db->from('invoice as i');
        $this->db->join('revenue_product as r', 'r.id = i.product_id');
        $this->db->join('product_category1 as c', 'c.id = i.category1_id', 'left');
        $this->db->join('product_category2 as d', 'd.id = i.category2_id', 'left');
        $this->db->join('product_category3 as e', 'e.id = i.category3_id', 'left');
        $this->db->join('product_category4 as f', 'f.id = i.category4_id', 'left');

        $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
        $this->db->join('residence as rp', 'i.property_id = rp.id', 'left');
        $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
        $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
        $this->db->join('buisness_property as z', 'b.buis_property_code = z.buis_prop_code', 'left');
        $this->db->limit(50,$offset);
        $this->db->where($where);
        $invoices = $this->db->get()->result_array();
        return json_encode($invoices);
    }

    //    get all invoices to be printed
    public function get_batch_invoices($product, $category1, $year, $electoral_area, $town,$offset,$spool)
    {
        $this->db->select('i.*,t.town');
        $this->db->from('vw_invoice as i');
        $this->db->join('town as t', 'i.town_id = t.id', 'left');
        ($product) ? $this->db->where('i.product_id', $product) : null;
        ($category1) ? $this->db->where('i.category1_id', $category1) : null;
        ($year) ? $this->db->where('i.invoice_year', $year) : null;
        ($electoral_area) ? $this->db->where('i.area_council_id', $electoral_area) : null;
        ($town) ? $this->db->where('i.town_id', $town) : null;
        $this->db->limit($spool,$offset);

        $invoices = $this->db->get()->result_array();
        return json_encode($invoices);
    }


	//    get all agents details
    public function get_agents()
    {
        $this->db->select('id,firstname,lastname,agent_code');
        $this->db->from('agent');
        $products = $this->db->get()->result();
        return ($products);
    }

	//    get area councils and display on the add residence form.
    public function get_area_councils()
    {
        $this->db->select('id,name');
        $this->db->from('area_council');
        return $this->db->get()->result();
    }

	//    get all users
    public function get_users()
    {
        $this->db->select('id,firstname,lastname,username');
        $this->db->from('users');
        $products = $this->db->get()->result();
        return ($products);
    }

	// get products
    public function get_invoice_detail_old($id)
    {
        $this->db->select(
			'i.*, r.name, r.target,c.name as category1,d.name as category2,
			e.name as category3, f.name as category4, b.buis_name, b.buis_email,
			b.buis_occ_code,b.buis_property_code, b.buis_primary_phone,p.buis_prop_code, t.town,
			tt.town as occ_town,
			concat(prop.firstname, " ", prop.lastname) as roName,
            concat(po.firstname, " ", po.lastname) as boName,
            res.res_code,rt.town as res_town,
            po.primary_contact, po.secondary_contact, po.email'
        );
        $this->db->from('vw_invoice as i');
        $this->db->join('revenue_product as r', 'r.id = i.product_id');
        $this->db->join(
            'product_category1 as c', 'c.id = i.category1_id', 'left');
        $this->db->join(
            'product_category2 as d', 'd.id = i.category2_id', 'left');
        $this->db->join(
            'product_category3 as e', 'e.id = i.category3_id', 'left');
        $this->db->join(
            'product_category4 as f', 'f.id = i.category4_id', 'left');

        $this->db->join(
            'residence_to_owner as ro', 'i.property_id = ro.property_id',
            'left'
        );
        $this->db->join(
            'property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join(
            'buis_prop_to_owner as bo', 'i.property_id = bo.property_id',
            'left'
        );
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
        $this->db->join(
            'buisness_property as p', 'i.property_id = p.id', 'left');
        $this->db->join(
                'residence as res', 'i.property_id = res.id', 'left');
        $this->db->join(
            'buisness_property as z', 'b.buis_property_code = z.buis_prop_code',
            'left'
        );
        $this->db->join('town as tt', 'z.town = tt.id', 'left');
        $this->db->join('town as t', 'p.town = t.id', 'left');
        $this->db->join('town as rt', 'res.town = rt.id', 'left');

        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array();
        return json_encode($invoices);
    }

    // get products
    public function get_invoice_detail($id)
    {
        $this->db->select('i.*,t.town');
        $this->db->from('vw_invoice as i');
        $this->db->join('town as t', 'i.town_id = t.id', 'left');

        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array();
        return json_encode($invoices);
    }

    // get invoice for payment
    public function get_invoice_payment_detail_old($id)
    {
        $this->db->select(
			'i.invoice_no, i.id, i.invoice_amount, i.adjustment_amount,
			i.amount_paid, i.property_id, r.target, r.name, prop.primary_contact as roPC,
			po.primary_contact as bpoPC, poo.primary_contact as booPC'
		);
        $this->db->from('invoice as i');
        $this->db->join('revenue_product as r', 'r.id = i.product_id');

        $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
        $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join('buis_occ_to_owner as boo', 'i.property_id = boo.property_id', 'left');
        $this->db->join('property_owner as poo', 'boo.owner_id = poo.id', 'left');

        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array();
        return ($invoices);
    }

    // get transaction amount/count for payment
    public function get_transaction_amount($search_by,$start_date,$end_date,$payment_mode,$keyword,$category,$agentid,$admin,$status,$transaction_type)
    {
        $this->db->select("
            sum(IF(status=0,amount,0)) AS failed_amount,
            sum(IF(status=1,amount,0)) AS success_amount,
            sum(amount) AS total_amount,
            SUM(if(status=0, 1, 0)) AS failed_count,
            SUM(if(status=1, 1, 0)) AS success_count,
            count(id) AS total_count
        ");
        $this->db->from('transaction as t');
        if($end_date == "") {
            ($start_date) ? $this->db->where('date(t.datetime_created)', $start_date) : null;
        }else{
            $this->db->where("date(t.datetime_created) BETWEEN '$start_date' AND '$end_date'");
        }
        ($transaction_type) ? $this->db->where('t.transaction_type', $transaction_type) : null;
        ($payment_mode) ? $this->db->where('t.payment_mode', $payment_mode) : null;
        ($status) ? $this->db->where('t.status', $status) : null;
        if ($category == "admin") {
            $this->db->where('t.collected_by', "admin");
            $this->db->where('t.created_by', $admin);
        } else if ($category == "agent") {
            $this->db->where('t.collected_by', "agent");
            $this->db->where('t.created_by', $agentid);
        } else {

        }

        $transaction = $this->db->get()->row_array();
        return ($transaction);
    }

    // get invoice for payment
    public function get_invoice_payment_detail($id)
    {
        $this->db->select(
            'i.invoice_no, i.id, i.invoice_amount, i.adjustment_amount,
            i.amount_paid, i.property_id, i.target, i.name, i.owner_phoneno,
             i.product_id, i.invoice_year, i.penalty_amount'
        );
        $this->db->from('vw_invoice as i');
        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array();
        return ($invoices);
    }

	public function get_consolidated_invoice_payment_detail($id)
    {
        $this->db->select(
			'i.invoice_no, i.id, i.invoice_amount, i.adjustment_amount,
            i.amount_paid, i.property_id, r.target, r.name,
            prop.primary_contact as roPC, po.primary_contact as bpoPC,
            poo.primary_contact as booPC'
		);
        $this->db->from('invoice as i');
        $this->db->join(
            'revenue_product as r', 'r.id = i.product_id');
        $this->db->join(
            'residence_to_owner as ro',
            'i.property_id = ro.property_id', 'left'
        );
        $this->db->join(
            'property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join(
            'buis_prop_to_owner as bo',
            'i.property_id = bo.property_id', 'left'
        );
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join(
            'buis_occ_to_owner as boo',
            'i.property_id = boo.property_id', 'left');
        $this->db->join(
            'property_owner as poo', 'boo.owner_id = poo.id', 'left');
        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array();
        return ($invoices);
	}
	
    public function get_onetime_invoice_payment_detail($id)
    {
        $this->db->select(
			'id, invoice_id, concat(firstname, " ", lastname) as fullname,
			amount as invoice_amount, amount_paid, phonenumber,
			revenue_product_name'
		);
        $this->db->from('invoice_options');

        $this->db->where('invoice_id', $id);
        return $this->db->get()->row_array();
    }

    public function get_onetime_invoice_detail($id)
    {
        $this->db->select(
			'i.*, c.name as category1_name, d.name as category2_name,
			e.name as category3_name, f.name as category4_name'
		);
        $this->db->from('invoice_options as i');
        $this->db->join('product_category1 as c', 'c.id = i.category1', 'left');
        $this->db->join('product_category2 as d', 'd.id = i.category2', 'left');
        $this->db->join('product_category3 as e', 'e.id = i.category3', 'left');
        $this->db->join('product_category4 as f', 'f.id = i.category4', 'left');
        $this->db->where('i.invoice_id', $id);
        $invoices = $this->db->get()->row_array();
        return json_encode($invoices);
    }

    public function get_cheque_invoice($tid)
    {
        $this->db->select(
			't.id,t.fromIO,t.payer_name,t.payer_phone,t.transaction_id,
			t.payment_mode,t.status,t.amount,i.id as i_id, i.invoice_no as i_invoice_no,
			i.amount_paid as i_amount_paid,ii.id as ii_id, ii.invoice_id as ii_invoice_no,
			ii.amount_paid as ii_amount_paid'
		);
        $this->db->from('transaction as t');
        $this->db->join('invoice as i', 't.invoice_id = i.id', 'left');
        $this->db->join('invoice_options as ii', 't.invoice_id = ii.id', 'left');
        $this->db->where('t.transaction_id', $tid);
        return json_encode($this->db->get()->row_array());
    }

	// get last date from residence table
    public function get_date()
    {
        $this->db->select('date(datetime_created) as date1');
        $this->db->from("transaction");
        $this->db->order_by("id", 'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

	// get last date from residence table
    public function get_toll_date()
    {
        $this->db->select('date(datetime_created) as date1');
        $this->db->from("toll_transaction");
        $this->db->order_by("id", 'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

	//    get invoice for amount paid
    public function get_invoice_amount_paid($id)
    {
        $this->db->select('i.amount_paid');
        $this->db->from('invoice as i');
        $this->db->where('i.id', $id);
        $invoices = $this->db->get()->row_array()['amount_paid'];
        return ($invoices);
    }

	//    get all adjustments
    public function getAllAdjustments()
    {
        $this->db->select('a.*,concat(u.firstname," ",u.lastname," (",u.username,")") as creator');
        $this->db->from('invoice_adjustment a');
        $this->db->join("users as u","a.created_by=u.id","left");
        $adjustment = $this->db->get()->result();
        return ($adjustment);
    }

	//    update invoice
    public function update_invoice($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('invoice', $data);
    }

	//    update onetime invoice
    public function update_onetime_invoice($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('invoice_options', $data);
    }

    public function update_transaction_status($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('transaction', $data);
    }

    public function update_invoice_options($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('invoice_options', $data);
    }

	//    get residence and display on the residence page
    public function get_business_occ()
    {
        $this->db->select("id,buis_occ_code,buis_name");
        $this->db->from("buisness_occ");
        return $this->db->get()->result();
    }

	//    get business and display on the business page
    public function get_business_property()
    {
        $agency = $this->db->query(
			"SELECT buisness_property.buis_prop_code,buisness_property.id 
			FROM buisness_property order by id asc"
		)->result();
        return ($agency);
    }

	//    search transaction
    public function search_transaction(
		$search_by, $start_date, $end_date, $payment_mode, $keyword, $category,
		$agent, $admin, $status
	)
    {
        $keyword = strtolower($keyword);
        $data = [];
        if ($search_by == "Criteria") {
            if ($end_date == "") {
                $this->db->select(
					't.*, i.property_id, r.name, r.target,i.invoice_no,
					o.invoice_id as onetime_no, b.buis_name, b.buis_occ_code,
					p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName,
					rd.res_code, concat(prop.firstname, " ", prop.lastname) as roName,
					o.firstname, o.lastname, concat(o.firstname, " ", o.lastname) as onetimeName,
					o.company_name'
				);
                $this->db->from('transaction as t');
                $this->db->join('invoice as i', 'i.id = t.invoice_id', 'left');
                $this->db->join('revenue_product as r', 'r.id = i.product_id', 'left');
                $this->db->join('invoice_options as o', 'o.id = t.invoice_id', 'left');
                $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
                $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
                $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
                $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
                $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
                $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
                $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
                $this->db->where('date(datetime_created)', $start_date);
                ($payment_mode) ? $this->db->where('t.payment_mode', $payment_mode) : null;
                ($status) ? $this->db->where('t.status', $status) : null;
                if ($category == "admin") {
                    $this->db->where('t.collected_by', "admin");
                    $this->db->where('t.created_by', $admin);
                } else if ($category == "agent") {
                    $this->db->where('t.collected_by', "agent");
                    $this->db->where('t.created_by', $agent);
                } else {

                }
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            } else {
                $this->db->select(
					't.*, i.property_id, r.name, r.target,i.invoice_no,o.invoice_id as onetime_no,
					b.buis_name, b.buis_occ_code, p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName,]
					rd.res_code, concat(prop.firstname, " ", prop.lastname) as roName,
					o.firstname, o.lastname, concat(o.firstname, " ", o.lastname) as onetimeName,
					o.company_name'
				);
                $this->db->from('transaction as t');
                $this->db->join('invoice as i', 'i.id = t.invoice_id', 'left');
                $this->db->join('revenue_product as r', 'r.id = i.product_id', 'left');
                $this->db->join('invoice_options as o', 'o.id = t.invoice_id', 'left');
                $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
                $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
                $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
                $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
                $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
                $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
                $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
                $this->db->where("date(t.datetime_created) BETWEEN '$start_date' AND '$end_date'");
                ($payment_mode) ? $this->db->where('t.payment_mode', $payment_mode) : null;
                ($status) ? $this->db->where('t.status', $status) : null;
                if ($category == "admin") {
                    $this->db->where('t.collected_by', "admin");
                    $this->db->where('t.created_by', $admin);
                } else if ($category == "agent") {
                    $this->db->where('t.collected_by', "agent");
                    $this->db->where('t.created_by', $agent);
                } else {

                }
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            }
        } else {
            $this->db->select(
				't.*, i.property_id, r.name, r.target,i.invoice_no,o.invoice_id as onetime_no,
				b.buis_name, b.buis_occ_code, p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName,
				rd.res_code, concat(prop.firstname, " ", prop.lastname) as roName,
				o.firstname, o.lastname, concat(o.firstname, " ", o.lastname) as onetimeName,
				o.company_name'
			);
            $this->db->from('transaction as t');
            $this->db->join('invoice as i', 'i.id = t.invoice_id', 'left');
            $this->db->join('revenue_product as r', 'r.id = i.product_id', 'left');
            $this->db->join('invoice_options as o', 'o.id = t.invoice_id', 'left');
            $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
            $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
            $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
            $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
            $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
            $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
            $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
            $this->db->like('lower(t.transaction_id)', $keyword);
            $this->db->or_like('lower(i.invoice_no)', $keyword);
            $this->db->or_like('lower(t.payer_name)', $keyword);
            $this->db->or_like('lower(t.payer_phone)', $keyword);
            $data = $this->db->get()->result();
        }

        return $data;
    }

	//    search transaction
    public function search_toll_transaction(
		$search_by, $start_date, $end_date, $payment_mode, $keyword, $category,
		$agent, $admin, $status
	)
    {
        $keyword = strtolower($keyword);
        $data = [];
        if ($search_by == "Criteria") {
            if ($end_date == "") {
                $this->db->select('t.*,c.category as cat,y.toll');
                $this->db->from('toll_transaction as t');
                $this->db->join('toll_category as c', 'c.id = t.category', 'left');
                $this->db->join('toll_type as y', 'y.id = t.toll_type', 'left');
                $this->db->where('date(datetime_created)', $start_date);
                if ($category == "admin") {
                    $this->db->where('t.collected_by', "admin");
                    $this->db->where('t.created_by', $admin);
                } else if ($category == "agent") {
                    $this->db->where('t.collected_by', "agent");
                    $this->db->where('t.created_by', $agent);
                } else {

                }
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            } else {
                $this->db->select('t.*,c.category as cat,y.toll');
                $this->db->from('toll_transaction as t');
                $this->db->join('toll_category as c', 'c.id = t.category', 'left');
                $this->db->join('toll_type as y', 'y.id = t.toll_type', 'left');
                $this->db->where(
					"date(t.datetime_created) BETWEEN '$start_date' AND '$end_date'");
                if ($category == "admin") {
                    $this->db->where('t.collected_by', "admin");
                    $this->db->where('t.created_by', $admin);
                } else if ($category == "agent") {
                    $this->db->where('t.collected_by', "agent");
                    $this->db->where('t.created_by', $agent);
                } else {

                }
                $query = $this->db->get();

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            }
        } else {
            $this->db->select('t.*,c.category as cat,y.toll');
            $this->db->from('toll_transaction as t');
            $this->db->join('toll_category as c', 'c.id = t.category', 'left');
            $this->db->join('toll_type as y', 'y.id = t.toll_type', 'left');
            $this->db->like('lower(c.transaction_id)', $keyword);
            $this->db->or_like('lower(c.toll)', $keyword);
            $this->db->or_like('lower(t.transaction_d)', $keyword);
            $this->db->or_like('lower(t.serialno)', $keyword);
            $data = $this->db->get()->result();
        }

        return $data;
    }

    //   get residence and display on the residence page
    public function get_residence()
    {
        $residence = $this->db->query(
			"SELECT residence.res_code,residence.id from residence order by 
			residence.id asc"
		)->result();
        return ($residence);
    }

	//  get susu transactions
    public function get_transaction($last_date)
    {
        $this->db->select(
			't.*, i.property_id, r.name, r.target,i.invoice_no,o.invoice_id as onetime_no,
			b.buis_name, b.buis_occ_code, p.buis_prop_code,
			concat(po.firstname, " ", po.lastname) as boName, rd.res_code,
			concat(prop.firstname, " ", prop.lastname) as roName,o.firstname,
			o.lastname, concat(o.firstname, " ", o.lastname) as onetimeName,
			o.company_name'
		);
        $this->db->from('transaction as t');
        $this->db->join('invoice as i', 'i.id = t.invoice_id', 'left');
        $this->db->join('revenue_product as r', 'r.id = i.product_id', 'left');
        $this->db->join('invoice_options as o', 'o.id = t.invoice_id', 'left');
        $this->db->join('residence_to_owner as ro', 'i.property_id = ro.property_id', 'left');
        $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
        $this->db->join('property_owner as prop', 'ro.owner_id = prop.id', 'left');
        $this->db->join('buis_prop_to_owner as bo', 'i.property_id = bo.property_id', 'left');
        $this->db->join('property_owner as po', 'bo.owner_id = po.id', 'left');
        $this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
        $this->db->join('buisness_property as p', 'i.property_id = p.id', 'left');
        $this->db->where('date(datetime_created)', $last_date);
        $transaction = $this->db->get()->result();
        return ($transaction);
    }

    //  get transactions details
    public function get_transaction_detail($id)
    {
        $this->db->select('t.*');
        $this->db->from('transaction as t');
        $this->db->where('t.id', $id);
        $transaction = $this->db->get()->row_array();
        return ($transaction);

    }

    //  get invoice amounts i.e invoice_amount and amount_paid
    public function get_invoice_amount($invoiceid)
    {
        $this->db->select('i.invoice_amount,i.amount_paid');
        $this->db->from('invoice as i');
        $this->db->where('i.id', $invoiceid);
        $transaction = $this->db->get()->row_array();
        return ($transaction);
        
    }

    //  get invoice amounts i.e invoice_amount and amount_paid
    public function get_onetime_invoice_amount($invoiceid)
    {
        $this->db->select('i.amount as invoice_amount,i.amount_paid');
        $this->db->from('invoice_options as i');
        $this->db->where('i.id', $invoiceid);
        $transaction = $this->db->get()->row_array();
        return ($transaction);
        
    }

	//    get toll transactions
    public function get_toll_transaction($last_date)
    {
        $this->db->select('t.*,c.category as cat,y.toll');
        $this->db->from('toll_transaction as t');
        $this->db->join('toll_category as c', 'c.id = t.category', 'left');
        $this->db->join('toll_type as y', 'y.id = t.toll_type', 'left');
        $this->db->where('date(t.datetime_created)', $last_date);
        $transaction = $this->db->get()->result();
        return ($transaction);
    }

	//    get business occupant categories
    public function get_busocc_categories()
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_occ o');
        $this->db->join('busocc_to_category b', 'b.busocc_id = o.id');
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

	//    get business property categories
    public function get_business_prop_old()
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_property o');
        $this->db->join('busprop_to_category b', 'b.property_id = o.id');
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    //    get business property categories
    public function get_business_prop($category)
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_property o');
        $this->db->join('busprop_to_category b', 'b.property_id = o.id');
        $this->db->where('o.category', $category);
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

	//    get residence property categories
    public function get_residence_prop()
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('residence o');
        $this->db->join('res_to_category b', 'b.property_id = o.id');
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    //    get signages categories
    public function get_signage()
    {
        $this->db->select('s.*');
        $this->db->from('signage s');
        $signage_categories = $this->db->get()->result();
        return ($signage_categories);
    }

	//    get business occupant categories
    public function get_ungenerated_busocc_categories()
    {
        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_occ o');
        $this->db->join('busocc_to_category b', 'b.busocc_id = o.id');
        $this->db->where('o.invoice_status', 0);
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
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

	//  get products from db
    public function get_all_products()
    {
        $this->db->select('*');
        $this->db->from('revenue_product');
        $products = $this->db->get()->result();
        return ($products);
    }

	//    check if property is already accessed
    public function checked_accessed($where)
    {
        $this->db->select('*');
        $this->db->from('accessed_property');
        $this->db->where($where);
        $accessed = $this->db->get()->num_rows();

        if ($accessed > 0) {
            return true;
        } else {
            return false;
        }
    }

	//    insert accessed record
    public function insert_accessed_record($data)
    {
        $insert = $this->db->insert('accessed_property', $data);
        return $this->db->insert_id();
    }

    public function update_accessed_recordd($data, $id)
    {
        $where = array('id' => $id);
        $this->db->where($where);
        return $this->db->update('accessed_property', $data);
    }

	// insert fees invoice Records
    public function save_onetime_invoice($data)
    {
        $insert = $this->db->insert('invoice_options', $data);
        return $this->db->insert_id();
    }

	// save batch print invoice in db
    public function save_batch($data)
    {
        $insert = $this->db->insert('batch_print_invoice', $data);
        return $this->db->insert_id();
    }

	// insert invoice distribution Records
    public function add_invoice_distribution($data)
    {
        $insert = $this->db->insert('invoice_distribution', $data);
        return $this->db->insert_id();
    }

	// insert invoice distribution Records
    public function add_invoice_visit($data)
    {
        $insert = $this->db->insert('invoice_visit', $data);
        return $this->db->insert_id();
    }

    public function save_otp_code($data)
    {
        $insert = $this->db->insert('otp', $data);
        return $this->db->insert_id();
    }

    public function update_otp($status, $id)
    {
        $where = array('id' => $id);
        $data = array('status' => $status);
        $this->db->where($where);
        return $this->db->update('otp', $data);
    }

    public function update_invoice_id($code, $id)
    {
        $number = str_pad($id, 5, '0', STR_PAD_LEFT);
        $invid = "INV" . $code . date('Y') . "-" . $number;
        $where = array('id' => $id);
        $data = array('invoice_id' => $invid);
        $this->db->where($where);
        return $this->db->update('invoice_options', $data);
    }

	//    update record to accessed
    public function update_accessed_record($where, $data, $table)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

	//    get business occupant categories
    public function get_busocc_compare($where)
    {
        $this->db->select('unit_of_measure,price1');
        $this->db->from('product_category6');
        $this->db->where($where);
        $bus_categories = $this->db->get()->row_array();
        return ($bus_categories);
    }

	//    get business occupant categories
    public function get_busocc_compare2($where)
    {
        $this->db->select('unit_of_measure,price1');
        $this->db->from('product_category6');
        $this->db->where($where);
        $bus_categories = $this->db->get()->result_array();
        return ($bus_categories);
    }

	// update client account status
    public function update_print_status($id, $state)
    {
        $code = array(
            'id' => $id,
        );
        $data = array(
            'print' => $state,
        );

        $this->db->where($code);
        $this->db->update('invoice', $data);
    }

	//    insert tax assignment categories
    public function insert_tax_assignment_record($data)
    {
        $insert = $this->db->insert('tax_assignment', $data);
        return $this->db->insert_id();
    }

	//    insert tax assignment categories
    public function insert_invoice_record($data)
    {
        $insert = $this->db->insert('invoice', $data);
        return $this->db->insert_id();
    }

	//    insert adjustment
    public function add_adjustment($data)
    {
        $insert = $this->db->insert('invoice_adjustment', $data);
        return $this->db->insert_id();
    }

	//    insert transaction
    public function insert_transaction($data)
    {
        $insert = $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }

	//    get business and display on the business page
    public function get_ungenerated_business_prop_old()
    {

        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_property o');
        $this->db->join('busprop_to_category b', 'b.property_id = o.id');
        $this->db->where('o.invoice_status', 0);
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    //    get business and display on the business page
    public function get_ungenerated_business_prop($category)
    {

        $this->db->select('b.*,o.accessed');
        $this->db->from('buisness_property o');
        $this->db->join('busprop_to_category b', 'b.property_id = o.id');
        $this->db->where('o.invoice_status', 0);
        $this->db->where('o.category', $category);
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

    //    get business and display on the business page
    public function get_ungenerated_residence_prop()
    {

        $this->db->select('b.*,o.accessed');
        $this->db->from('residence o');
        $this->db->join('res_to_category b', 'b.property_id = o.id');
        $this->db->where('o.invoice_status', 0);
        $bus_categories = $this->db->get()->result();
        return ($bus_categories);
    }

     //  get signages whose bills have not been generated
     public function get_ungenerated_signage()
     {
         $this->db->select('s.*');
         $this->db->from('signage s');
         $this->db->where('s.invoice_status', 0);
         $signages = $this->db->get()->result();
         return ($signages);
     }

	// update business occ propety type
    public function update_business_occ($id)
    {
        $data = array(
            'invoice_status' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('buisness_occ', $data);
    }

	// update business property propety type
    public function update_business_property($id)
    {
        $data = array(
            'invoice_status' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('buisness_property', $data);
    }

	// update business property propety type
    public function update_residence_property($id)
    {
        $data = array(
            'invoice_status' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('residence', $data);
    }

    // update signage invoice status
    public function update_signage($id)
    {
        $data = array(
            'invoice_status' => 1,
        );
        $this->db->where('id', $id);
        return $this->db->update('signage', $data);
    }

	//    get business occupant categories
    public function get_accessed_details($where)
    {
        $this->db->select('invoice_amount');
        $this->db->from('accessed_property');
        $this->db->where($where);
        $amount = $this->db->get()->row_array()['invoice_amount'];
        return ($amount);
    }

	//    get invoice transaction
    public function get_invoice_transactions($id)
    {
        $this->db->select('t.*,i.invoice_no');
        $this->db->from('transaction as t');
        $this->db->join('invoice as i', 'i.id = t.invoice_id');
        $this->db->where(array('t.invoice_id' => $id, 't.fromIO' => 0));
        $transaction = $this->db->get()->result();
        return ($transaction);
    }

    public function get_onetime_invoice_transactions($id)
    {
        $this->db->select('t.*,i.invoice_id as invoice_no');
        $this->db->from('transaction as t');
        $this->db->join('invoice_options as i', 'i.id = t.invoice_id');
        $this->db->where(array('i.invoice_id' => $id, 't.fromIO' => 1));
        $transaction = $this->db->get()->result();
        return ($transaction);
    }

    public function get_receipt_transaction($tid)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction_id', $tid);
        $transaction = $this->db->get()->row_array();
        return json_encode($transaction);
    }

    public function getOnetimeInvoiceData($id)
    {
        $this->db->select('*');
        $this->db->from('invoice_options');
        $this->db->where('invoice_id', $id);
        $transaction = $this->db->get()->row_array();
        return $transaction;
    }

    public function getInvoiceData($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('id', $id);
        $transaction = $this->db->get()->row_array();
        return $transaction;
    }

    public function get_receipt_transaction_by_invoice_no($tid)
    {
        $this->db->select('t.*, i.invoice_id as invoice_no, i.revenue_product_name');
        $this->db->from('transaction as t');
        $this->db->join('invoice_options as i', 'i.id = t.invoice_id');
        $this->db->where(array('t.transaction_id' => $tid, 't.fromIO' => 1));
        $transaction = $this->db->get()->row_array();
        return json_encode($transaction);
    }

	// get invoice and adjustment amount
    public function get_invoice_adjustment_amount($id)
    {
        $this->db->select('invoice_amount,adjustment_amount,amount_paid');
        $this->db->from('invoice');
        $this->db->where('id', $id);
        $transaction = $this->db->get()->row_array();
        return $transaction;
    }

	// get invoice and adjustment amount
    public function get_onetime_invoice_adjustment_amount($id)
    {
        $this->db->select('amount,adjustment_amount,amount_paid');
        $this->db->from('invoice_options');
        $this->db->where('id', $id);
        $transaction = $this->db->get()->row_array();
        return $transaction;
    }

	// update adjustment
    public function update_adjustment($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('invoice_adjustment', $data);
    }

	//    search transaction
    public function search_invoice(
        $search_by, $keyword, $product, $category1, $category2, $category3,
        $category4, $category5, $category6
    ) {
        $keyword = strtolower($keyword);
        $data = [];
        if ($search_by == "Criteria") {

            $this->db->select(
				'i.*, r.name, r.target,c.name as category1,d.name as category2,
				e.name as category3, f.name as category4,g.name as category5,
				h.name as category6, b.buis_name, b.buis_occ_code,
				p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName,
				rd.res_code,
				concat(prop.firstname, " ", prop.lastname) as roName'
			);
            $this->db->from('invoice as i');
            $this->db->join('revenue_product as r', 'r.id = i.product_id');
            $this->db->join(
                'product_category1 as c', 'c.id = i.category1_id', 'left');
            $this->db->join(
                'product_category2 as d', 'd.id = i.category2_id', 'left');
            $this->db->join(
                'product_category3 as e', 'e.id = i.category3_id', 'left');
            $this->db->join(
                'product_category4 as f', 'f.id = i.category4_id', 'left');
            $this->db->join(
                'product_category5 as g', 'g.id = i.category5_id', 'left');
            $this->db->join(
                'product_category6 as h', 'h.id = i.category6_id', 'left');

            $this->db->join(
                'residence_to_owner as ro', 'i.property_id = ro.property_id',
                'left'
            );
            $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
            $this->db->join(
                'property_owner as prop', 'ro.owner_id = prop.id', 'left');
            $this->db->join(
                'buis_prop_to_owner as bo', 'i.property_id = bo.property_id',
                'left'
            );
            $this->db->join(
                'property_owner as po', 'bo.owner_id = po.id', 'left');
            $this->db->join(
                'buisness_occ as b', 'i.property_id = b.id', 'left');
            $this->db->join(
                'buisness_property as p', 'i.property_id = p.id', 'left');
            if ($product) {
                $this->db->where('i.product_id', $product);
            }
            if ($category1 != 0) {
                $this->db->where('i.category1_id', $category1);
            }
            if ($category2 != 0) {
                $this->db->where('i.category2_id', $category2);
            }
            if ($category3 != 0) {
                $this->db->where('i.category3_id', $category3);
            }
            if ($category4 != 0) {
                $this->db->where('i.category4_id', $category4);
            }
            if ($category5 != 0) {
                $this->db->where('i.category5_id', $category5);
            }
            if ($category6 != 0) {
                $this->db->where('i.category6_id', $category6);
            }
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $data = $query->result();
                $query->free_result();
            } else {
                $data = $query->result();
            }
        } else {
            $this->db->select(
				'i.*, r.name, r.target,c.name as category1,d.name as category2,
				e.name as category3, f.name as category4,g.name as category5,
				h.name as category6, b.buis_name, b.buis_occ_code,
				p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName,
				rd.res_code, concat(prop.firstname, " ", prop.lastname) as roName'
			);
            $this->db->from('invoice as i');
            $this->db->join('revenue_product as r', 'r.id = i.product_id');
            $this->db->join(
                'product_category1 as c', 'c.id = i.category1_id', 'left');
            $this->db->join(
                'product_category2 as d', 'd.id = i.category2_id', 'left');
            $this->db->join(
                'product_category3 as e', 'e.id = i.category3_id', 'left');
            $this->db->join(
                'product_category4 as f', 'f.id = i.category4_id', 'left');
            $this->db->join(
                'product_category5 as g', 'g.id = i.category5_id', 'left');
            $this->db->join(
                'product_category6 as h', 'h.id = i.category6_id', 'left');

            $this->db->join(
                'residence_to_owner as ro', 'i.property_id = ro.property_id',
                'left'
            );
            $this->db->join('residence as rd', 'ro.id = rd.id', 'left');
            $this->db->join(
                'property_owner as prop', 'ro.owner_id = prop.id', 'left');
            $this->db->join(
                'buis_prop_to_owner as bo', 'i.property_id = bo.property_id',
                'left'
            );
            $this->db->join(
                'property_owner as po', 'bo.owner_id = po.id', 'left');
            $this->db->join(
                'buisness_occ as b', 'i.property_id = b.id', 'left');
            $this->db->join(
                'buisness_property as p', 'i.property_id = p.id', 'left');
            $this->db->like('lower(i.invoice_no)', $keyword);
            $this->db->or_like('lower(b.buis_occ_code)', $keyword);
            $this->db->or_like('lower(p.buis_prop_code)', $keyword);
            $this->db->or_like('lower(rd.res_code)', $keyword);
            $this->db->or_like(
                'lower(concat(prop.firstname, " ", prop.lastname))', $keyword);
            $this->db->or_like(
                'lower(concat(po.firstname, " ", po.lastname))', $keyword);
            $this->db->or_like('lower(b.buis_name)', $keyword);
            $data = $this->db->get()->result();
        }

        return $data;
    }

    //   function getInvoices($postData=null){

    //     $response = array();

    //     ## Read value
    //     $draw = $postData['draw'];
    //     $start = $postData['start'];
    //     $rowperpage = $postData['length']; // Rows display per page
    //     $columnIndex = $postData['order'][0]['column']; // Column index
    //     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
    //     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
    //     $searchValue = $postData['search']['value']; // Search value

    //     ## Search
    //     $searchQuery = "";
    //     if($searchValue != ''){
    //         $searchQuery = "r.`name` like '%".$searchValue."%' or
    //         c.`name` like '%".$searchValue."%' or
    //         i.`invoice_no` like '%".$searchValue."%' or
    //         d.`name` like'%".$searchValue."%' or
    //         e.`name` like'%".$searchValue."%' or
    //         f.`name` like'%".$searchValue."%' or
    //         g.`name` like'%".$searchValue."%' or
    //         h.`name` like'%".$searchValue."%' or
    //         rd.res_code like'%".$searchValue."%' or
    //         p.buis_prop_code like'%".$searchValue."%' or
    //         b.buis_occ_code like'%".$searchValue."%' or
    //         concat(prop.firstname,' ', prop.lastname) like'%".$searchValue."%' or
    //         b.buis_name like'%".$searchValue."%' or
    //         concat(po.firstname,' ', po.lastname) like'%".$searchValue."%'";

    //     }

    //     ## Total number of records without filtering
    //       $this->db->select('count(*) as allcount');
    //       $this->db->from('invoice as i');
    //       $this->db->join('revenue_product as r','r.id = i.product_id');
    //       $this->db->join('product_category1 as c','c.id = i.category1_id','left');
    //       $this->db->join('product_category2 as d','d.id = i.category2_id','left');
    //       $this->db->join('product_category3 as e','e.id = i.category3_id','left');
    //       $this->db->join('product_category4 as f','f.id = i.category4_id','left');
    //       $this->db->join('product_category5 as g','g.id = i.category5_id','left');
    //       $this->db->join('product_category6 as h','h.id = i.category6_id','left');
    //       $this->db->join('residence_to_owner as ro','i.property_id = ro.property_id','left');
    //       $this->db->join('residence as rd','ro.id = rd.id','left');
    //       $this->db->join('property_owner as prop','ro.owner_id = prop.id','left');
    //       $this->db->join('buis_prop_to_owner as bo','i.property_id = bo.property_id','left');
    //       $this->db->join('property_owner as po','bo.owner_id = po.id','left');
    //       $this->db->join('buisness_occ as b','i.property_id = b.id','left');
    //       $this->db->join('buisness_property as p','i.property_id = p.id','left');

    //       $records = $this->db->get()->result();
    //       $totalRecords = $records[0]->allcount;

    //     ## Total number of record with filtering
    //     $this->db->select('count(*) as allcount');
    //     $this->db->from('invoice as i');
    //     $this->db->join('revenue_product as r','r.id = i.product_id');
    //     $this->db->join('product_category1 as c','c.id = i.category1_id','left');
    //     $this->db->join('product_category2 as d','d.id = i.category2_id','left');
    //     $this->db->join('product_category3 as e','e.id = i.category3_id','left');
    //     $this->db->join('product_category4 as f','f.id = i.category4_id','left');
    //     $this->db->join('product_category5 as g','g.id = i.category5_id','left');
    //     $this->db->join('product_category6 as h','h.id = i.category6_id','left');
    //     $this->db->join('residence_to_owner as ro','i.property_id = ro.property_id','left');
    //     $this->db->join('residence as rd','ro.id = rd.id','left');
    //     $this->db->join('property_owner as prop','ro.owner_id = prop.id','left');
    //     $this->db->join('buis_prop_to_owner as bo','i.property_id = bo.property_id','left');
    //     $this->db->join('property_owner as po','bo.owner_id = po.id','left');
    //     $this->db->join('buisness_occ as b','i.property_id = b.id','left');
    //     $this->db->join('buisness_property as p','i.property_id = p.id','left');

    //     if($searchValue == ''){
    //       ($postData['product']) ? $this->db->where('i.product_id', $postData['product']) : NULL;
    //       ($postData['year']) ? $this->db->where('i.invoice_year', $postData['year']) : NULL;
    //       ($postData['category1'] != 0) ? $this->db->where('i.category1_id', $postData['category1']) : NULL;
    //       ($postData['category2'] != 0) ? $this->db->where('i.category2_id', $postData['category2']) : NULL;
    //       ($postData['category3'] != 0) ? $this->db->where('i.category3_id', $postData['category3']) : NULL;
    //       ($postData['category4'] != 0) ? $this->db->where('i.category4_id', $postData['category4']) : NULL;
    //       ($postData['category5'] != 0) ? $this->db->where('i.category5_id', $postData['category5']) : NULL;
    //       ($postData['category6'] != 0) ? $this->db->where('i.category6_id', $postData['category6']) : NULL;
    //     }
    //     if($searchQuery != '')
    //     $this->db->where($searchQuery);
    //     $records = $this->db->get()->result();
    //     $totalRecordwithFilter = $records[0]->allcount;

    //     ## Fetch records
    //     $this->db->select('i.*, r.name, r.target,c.name as category1,d.name as category2,e.name as category3, f.name as category4,g.name as category5,
    //     h.name as category6, b.buis_name, b.buis_occ_code, p.buis_prop_code, concat(po.firstname, " ", po.lastname) as boName, rd.res_code,
    //     concat(prop.firstname, " ", prop.lastname) as roName');
    //     $this->db->from('invoice as i');
    //     $this->db->join('revenue_product as r','r.id = i.product_id');
    //     $this->db->join('product_category1 as c','c.id = i.category1_id','left');
    //     $this->db->join('product_category2 as d','d.id = i.category2_id','left');
    //     $this->db->join('product_category3 as e','e.id = i.category3_id','left');
    //     $this->db->join('product_category4 as f','f.id = i.category4_id','left');
    //     $this->db->join('product_category5 as g','g.id = i.category5_id','left');
    //     $this->db->join('product_category6 as h','h.id = i.category6_id','left');
    //     $this->db->join('residence_to_owner as ro','i.property_id = ro.property_id','left');
    //     $this->db->join('residence as rd','ro.id = rd.id','left');
    //     $this->db->join('property_owner as prop','ro.owner_id = prop.id','left');
    //     $this->db->join('buis_prop_to_owner as bo','i.property_id = bo.property_id','left');
    //     $this->db->join('property_owner as po','bo.owner_id = po.id','left');
    //     $this->db->join('buisness_occ as b','i.property_id = b.id','left');
    //     $this->db->join('buisness_property as p','i.property_id = p.id','left');

    //     if($searchValue == ''){
    //       ($postData['product']) ? $this->db->where('i.product_id', $postData['product']) : NULL;
    //       ($postData['year']) ? $this->db->where('i.invoice_year', $postData['year']) : NULL;
    //       ($postData['category1'] != 0) ? $this->db->where('i.category1_id', $postData['category1']) : NULL;
    //       ($postData['category2'] != 0) ? $this->db->where('i.category2_id', $postData['category2']) : NULL;
    //       ($postData['category3'] != 0) ? $this->db->where('i.category3_id', $postData['category3']) : NULL;
    //       ($postData['category4'] != 0) ? $this->db->where('i.category4_id', $postData['category4']) : NULL;
    //       ($postData['category5'] != 0) ? $this->db->where('i.category5_id', $postData['category5']) : NULL;
    //       ($postData['category6'] != 0) ? $this->db->where('i.category6_id', $postData['category6']) : NULL;
    //     }
    //     if($searchQuery != '')
    //     $this->db->where($searchQuery);
    //     $this->db->order_by($columnName, $columnSortOrder);
    //     $this->db->limit($rowperpage, $start);
    //     $records = $this->db->get()->result();

    //     $data = array();

    //     foreach($records as $record ){

    //         $url = base_url()."invoice_transaction/".$record->id;
    //         $url_invoice = base_url()."view_invoice/".$record->id;
    //         //amount paid
    //         $amount_paid = "<a href='$url'>".number_format((float)$record->amount_paid, 2, '.', ',')."</a>";

    //         // invoice no url
    //         $invoice_url = "<a href='$url_invoice'>".$record->invoice_no."</a>";

    //         //invoice id (pk)
    //         $id = $record->id;

    //         if($record->target == 1){
    //           $property_code = $record->res_code;
    //         }else if($record->target == 2){
    //           $property_code = $record->buis_prop_code;
    //         }else if($record->target == 3){
    //           $property_code = $record->buis_occ_code;
    //         }else{
    //           $property_code = "";
    //         }

    //         if($record->target == 1){
    //           $customer_name = $record->roName;
    //         }else if($record->target == 2){
    //           $customer_name = $record->boName;
    //         }else if($record->target == 3){
    //           $customer_name = $record->buis_name;
    //         }else{
    //           $customer_name = "";
    //         }

    //         $switch = "";
    //         if($record->print == 1){
    //           $switch .= "<label class='switch'>";
    //           $switch .= "<input id='$id' onChange='invoiceStatus(this.id)' type='checkbox' checked>";
    //           $switch .= "<span class='slider round'></span>";
    //           $switch .= "</label>";
    //         }else{
    //           $switch .= "<label class='switch'>";
    //           $switch .= "<input id='$id' onChange='invoiceStatus(this.id)' type='checkbox'>";
    //           $switch .= "<span class='slider round'></span>";
    //           $switch .= "</label>";
    //         }

    //         $data[] = array(
    //             "invoice_no"=>$invoice_url,
    //             "property_code"=>$property_code,
    //             "owner_name"=>$customer_name,
    //             "product"=>$record->name,
    //             "invoice_amount"=> number_format((float)$record->invoice_amount + $record->adjustment_amount, 2, '.', ','),
    //             "adjustment_amount"=> number_format((float)$record->adjustment_amount, 2, '.', ','),
    //             "amount_paid"=> $amount_paid,
    //             "outstanding_amount"=> number_format((float)$record->invoice_amount - $record->amount_paid, 2, '.', ','),
    //             "category1"=>$record->category1,
    //             "category2"=>$record->category2,
    //             "category3"=>$record->category3,
    //             "category4"=>$record->category4,
    //             "category5"=>$record->category5,
    //             "category6"=>$record->category6,
    //             "switch"=> $switch,
    //             "date_created"=>date("Y-m-d H:i:s",strtotime($record->date_created)),
    //             "payment_due_date"=>date("Y-m-d",$record->payment_due_date)
    //         );
    //     }

    //     ## Response
    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordwithFilter,
    //         "aaData" => $data
    //     );

    //     return $response;
    // }

    public function getConsolidatedInvoices($postData = null)
    {
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowPerPage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
				"i.`customer_name` like '%" . $searchValue . "%' or
      			i.`primary_contact` like '%" . $searchValue . "%' or
				i.`secondary_contact` like'%" . $searchValue . "%'"
			);
        }

        # Total number of records without filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('vw_consolidated_invoice as i');

        # Total number of records before filtering
        $totalRecords = $this->db->get()->result()[0]->allcount;
        if ($searchQuery != "") {
            $this->db->from('vw_consolidated_invoice as i');
            $this->db->select('count(*) as allcount');
            $this->db->where($searchQuery);
            $totalRecordWithFilter = $this->db->get()->result()[0]->allcount;
        } else {
            # Total records after filtering
            $totalRecordWithFilter = $totalRecords;
        }

        $this->db->select("i.*");
        $this->db->from("vw_consolidated_invoice as i");
        $this->db->order_by("property_owner_id", $columnSortOrder);
        $this->db->limit($rowPerPage, $start);
        if ($searchQuery != "") {
            $this->db->where($searchQuery);
        }
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record) {
            $primaryContact = $record->primary_contact;
            $primaryContactFound = TRUE;

            if (is_null($primaryContact)) {
                $primaryContact = "0_".str_replace(" ", "_",$record->customer_name);
                $primaryContactFound = FALSE;
            }

            $url_invoice = base_url() . "view_consolidated_invoice/" . $primaryContact;

            // invoice no url
            $invoice_url = (
				"<a href='$url_invoice'>".
					(!$primaryContactFound ? "No Contact" : $primaryContact).
				"</a>"
			);

            $data[] = array(
                // "invoice_no" => $invoice_url,
                "owner_name" => $record->customer_name,
                "discount" => $record->discount,
                "invoice_count" => $record->invoice_count,
                "primary_contact" => $invoice_url,
                "secondary_contact" => $record->secondary_contact,
                "invoice_amount" => number_format(
					(float) $record->invoice_amount + $record->discount,
					2, '.', ','
				),
                "adjustment_amount" => number_format(
					(float) $record->discount, 2, '.', ','
				),
                "amount_paid" => number_format(
					(float) $record->amount_paid, 2, '.', ','
				),
                "outstanding_amount" => number_format(
					(float) $record->outstanding_amount, 2, '.', ','
				),
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordWithFilter,
            "aaData" => $data,
        );

        return $response;

    }

    public function getInvoices($postData = null)
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

        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
				"i.`name` like '%" . $searchValue . "%' or
				i.`category1` like '%" . $searchValue . "%' or
				i.`invoice_no` like '%" . $searchValue . "%' or
				i.`category2` like'%" . $searchValue . "%' or
				i.`category3` like'%" . $searchValue . "%' or
				i.`category4` like'%" . $searchValue . "%' or
				i.`category5` like'%" . $searchValue . "%' or
				i.`category6` like'%" . $searchValue . "%' or
				i.customer_name like'%" . $searchValue . "%' or
				i.property_code like'%" . $searchValue . "%'"
			);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('vw_invoice as i');

        if ($searchValue == '') {
            if ($postData['product']) {
                $this->db->where('i.product_id', $postData['product']);
            }
            if ($postData['year']) {
                $this->db->where('i.invoice_year', $postData['year']);
            }
            if ($postData['category1'] != 0) {
                $this->db->where('i.category1_id', $postData['category1']);
            }
            if ($postData['category2'] != 0) {
                $this->db->where('i.category2_id', $postData['category2']);
            }
            if ($postData['category3'] != 0) {
                $this->db->where('i.category3_id', $postData['category3']);
            }
            if ($postData['category4'] != 0) {
                $this->db->where('i.category4_id', $postData['category4']);
            }
            if ($postData['category5'] != 0) {
                $this->db->where('i.category5_id', $postData['category5']);
            }
            if ($postData['category6'] != 0) {
                $this->db->where('i.category6_id', $postData['category6']);
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('vw_invoice as i');

        if ($searchValue == '') {
            if ($postData['product']) {
                $this->db->where('i.product_id', $postData['product']);
            }
            if ($postData['year']) {
                $this->db->where('i.invoice_year', $postData['year']);
            }
            if ($postData['category1'] != 0) {
                $this->db->where('i.category1_id', $postData['category1']);
            }
            if ($postData['category2'] != 0) {
                $this->db->where('i.category2_id', $postData['category2']);
            }
            if ($postData['category3'] != 0) {
                $this->db->where('i.category3_id', $postData['category3']);
            }
            if ($postData['category4'] != 0) {
                $this->db->where('i.category4_id', $postData['category4']);
            }
            if ($postData['category5'] != 0) {
                $this->db->where('i.category5_id', $postData['category5']);
            }
            if ($postData['category6'] != 0) {
                $this->db->where('i.category6_id', $postData['category6']);
            }
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('i.*');
        $this->db->from('vw_invoice as i');

        if ($searchValue == '') {
            
            if ($postData['product']) {
                $this->db->where('i.product_id', $postData['product']);
            }

            if ($postData['year']) {
                $this->db->where('i.invoice_year', $postData['year']);
            }
            
            if ($postData['category1'] != 0) {
                $this->db->where('i.category1_id', $postData['category1']);
            }

            if ($postData['category2'] != 0) {
                $this->db->where('i.category2_id', $postData['category2']);
            }

            if ($postData['category3'] != 0) {
                $this->db->where('i.category3_id', $postData['category3']);
            }

            if ($postData['category4'] != 0) {
                $this->db->where('i.category4_id', $postData['category4']);
            }

            if ($postData['category5'] != 0) {
                $this->db->where('i.category5_id', $postData['category5']);
            }
            
            if ($postData['category6'] != 0) {
                $this->db->where('i.category6_id', $postData['category6']);
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

            $url = base_url() . "invoice_transaction/" . $record->id;
            $url_invoice = base_url() . "view_invoice/" . $record->id;

            //amount paid
            $amount_paid = (
                "<a href='$url'>" . number_format(
                    (float) $record->amount_paid, 2, '.', ',') . "</a>"
            );
            // invoice no url
            $invoice_url = "<a href='$url_invoice'>" . $record->invoice_no . "</a>";
            //invoice id (pk)
            $id = $record->id;
            //check if invoice is assessed
            $assessed = $record->accessed;

            if ($assessed == 1) {
                $badge = '<span class="badge badge-success">Assessed</span>';
            } else {
                $badge = '<span class="badge badge-danger">Unassessed</span>';
            }

            $switch = "";
            if ($record->print == 1) {
                $switch .= "<label class='switch'>";
                $switch .= "<input id='$id' onChange='invoiceStatus(this.id)' type='checkbox' checked>";
                $switch .= "<span class='slider round'></span>";
                $switch .= "</label>";
            } else {
                $switch .= "<label class='switch'>";
                $switch .= "<input id='$id' onChange='invoiceStatus(this.id)' type='checkbox'>";
                $switch .= "<span class='slider round'></span>";
                $switch .= "</label>";
            }

            $data[] = array(
                "invoice_no" => $invoice_url,
                "property_code" => $record->property_code,
                "owner_name" => $record->customer_name,
                "product" => $record->name,
                "invoice_amount" => number_format((float) $record->invoice_amount + $record->adjustment_amount, 2, '.', ','),
                "adjustment_amount" => number_format((float) $record->adjustment_amount, 2, '.', ','),
                "amount_paid" => $amount_paid,
                "assessed" => $badge,
                "outstanding_amount" => number_format((float) $record->invoice_amount - $record->amount_paid, 2, '.', ','),
                "category1" => $record->category1,
                "category2" => $record->category2,
                "category3" => $record->category3,
                "category4" => $record->category4,
                "category5" => $record->category5,
                "category6" => $record->category6,
                "switch" => $switch,
                "date_created" => date("Y-m-d H:i:s", strtotime($record->date_created)),
                "payment_due_date" => date("Y-m-d", $record->payment_due_date),
            );

        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        );

        return $response;
    }

    public function getTransactions($postData = null)
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

        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
                "t.`transaction_id` like '%" . $searchValue . 
                "%' or t.`invoice_no` like '%" . $searchValue .
                "%' or t.`payment_mode` like'%" . $searchValue .
                "%' or t.`payer_name` like'%" . $searchValue .
                "%' or t.`payer_phone` like'%" . $searchValue .
                "%' or t.`channel` like'%" . $searchValue .
                "%' or t.customer_name like'%" . $searchValue .
                "%' or t.company_name like'%" . $searchValue .
                "%' or t.property_code like'%" . $searchValue . "%'"
            );
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('vw_transaction as t');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            }
            
            if ($postData['payment_mode']) { 
                $this->db->where('t.payment_mode', $postData['payment_mode']);
            }
            if ($postData['transaction_type']) {
                $this->db->where('t.transaction_type', $postData['transaction_type']);
            }
            if ($postData['status'] != "") {
                $this->db->where('t.status', $postData['status']);
            }

            if ($postData['category'] == "admin") {
                $this->db->where('t.collected_by', "admin");
                
                if ($postData['admin']) {
                    $this->db->where('t.created_by', $postData['admin']);
                }
            } else if ($postData['category'] == "agent") {
                $this->db->where('t.collected_by', "agent");
                if ($postData['agent']) {
                    $this->db->where('t.created_by', $postData['agent']);
                }
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('vw_transaction as t');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            }
            
            if ($postData['payment_mode']) {
                $this->db->where('t.payment_mode', $postData['payment_mode']);
            }
            if ($postData['transaction_type']) {
                $this->db->where('t.transaction_type', $postData['transaction_type']);
            }
            if ($postData['status'] != "") {
                $this->db->where('t.status', $postData['status']);
            }
            if ($postData['category'] == "admin") {
                $this->db->where('t.collected_by', "admin");
                if ($postData['admin']) {
                    $this->db->where('t.created_by', $postData['admin']);
                }
            } else if ($postData['category'] == "agent") {
                $this->db->where('t.collected_by', "agent");
                if ($postData['agent']) {
                    $this->db->where('t.created_by', $postData['agent']);
                }
            }
        }
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('t.*');
        $this->db->from('vw_transaction as t');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(datetime_created) >=', $start_date);
                $this->db->where('date(datetime_created) <=', $end_date);
            }
            
            if ($postData['payment_mode']) {
                $this->db->where('t.payment_mode', $postData['payment_mode']);
            }
            if ($postData['transaction_type']) {
                $this->db->where('t.transaction_type', $postData['transaction_type']);
            }   
            if ($postData['status'] != "") {
                $this->db->where('t.status', $postData['status']);
            }
            if ($postData['category'] == "admin") {
                $this->db->where('t.collected_by', "admin");
                if ($postData['admin']) {
                    $this->db->where('t.created_by', $postData['admin']);
                }
            } else if ($postData['category'] == "agent") {
                $this->db->where('t.collected_by', "agent");
                if ($postData['agent']) {
                    $this->db->where('t.created_by', $postData['agent']);
                }
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

            // status badge
            if ($record->status == 1) {
                $badge = '<span class="badge badge-success">Successful</span>';
            } else {
                $badge = '<span class="badge badge-danger">Pending</span>';
            }

            // Transaction Type
            if ($record->transaction_type == "payment") {
                $transaction_type = '<span class="badge badge-success">Payment</span>';
            } else if($record->transaction_type == "reversal"){
                $transaction_type = '<span class="badge badge-danger">Reversal</span>';
            }else if($record->transaction_type == "downward adjustment" || $record->transaction_type == "upward adjustment"){
                $transaction_type = '<span class="badge badge-danger">'.$record->transaction_type.'</span>';
            }else{
                $transaction_type = '';
            }

            // property owner
            if ($record->fromIO == 1) {
                $company_name = ($record->company_name !== "") ? '(' . $record->company_name . ')' : "";
                $property_owner = $record->customer_name . ' ' . $company_name;
            } else {
                $property_owner = $record->customer_name;
            }

            //transaction id (pk)
            $id = $record->id;

            if ($record->fromIO == 1) {
                $url = base_url() . "onetime_invoice_transaction/receipt/" . $record->transaction_id;
            } else {
                $url = base_url() . "transaction/receipt/" . $record->transaction_id;
            }

            // reciept url
            $reciept_url = "<a href='$url'>reciept</a>";

            if ($record->collected_by == "admin") {
                $admin = collected_by_admin($record->created_by);
                $collector = $admin['firstname'] . ' ' . $admin['lastname'];
            } else if ($record->collected_by == "agent") {
                $agent = collected_by_agent($record->created_by);
                $collector = $agent['firstname'] . ' ' . $agent['lastname'] . ' (' . $agent['agent_code'] . ')';
            } else {
                $collector = "";
            }

            if($record->fromIO == 1){
                $invoice_url = base_url()."onetime_invoice_transaction/".$record->onetime_no;
                $invoice_no = "<a href='$invoice_url'>$record->onetime_no</a>";
            }else{
                $invoice_url = base_url()."invoice_transaction/".$record->invoice_id;
                $invoice_no = "<a href='$invoice_url'>$record->invoice_no</a>";
            }

            if($record->cheque_image == ''){
				$cheque_image = base_url().'upload/property/residence/no-image.png';
			}else{
				$cheque_image = base_url().$record->image_path.$record->cheque_image;
            }
            
			# # image button
            $image_button = '<a class="btn btn-info example-image-link" href="' . $cheque_image . '" data-lightbox="example-1">View Photo</a>';
            
            # # reversal button
            $reverse_url = base_url().'invoice/reverse_transaction/'. $record->transaction_id;
            $reversal_button = '';

            $funcCall = "reverse_modal('" . $record->transaction_id . "','" . $record->invoice_no . "','" . number_format((float) $record->amount, 2, '.', ',') . "','" . $record->id . "','". $record->fromIO . "')";

            if(has_permission($this->session->userdata('user_info')['id'],'transaction reversal')){
                if($record->transaction_type == "reversal"){
                    $reversal_button = '';
                }else if($record->transaction_type == "payment"){
                    $reversal_button = '<a class="btn btn-danger" style="color:white;" onclick="' . $funcCall . '">Reverse</a>';
                }else{
                    $reversal_button = '';
                }
                
            }else{
                $reversal_button = '';
            }
            

            $data[] = array(
                "invoice_no" => $invoice_no,
                "transaction_id" => $record->transaction_id,
                "gcr_no" => $record->gcr_no,
                "transaction_type" => $transaction_type,
                "payment_mode" => $record->payment_mode,
                "amount" => number_format((float) $record->amount, 2, '.', ','),
                "status" => $badge,
                "identifier" => $property_owner,
                "payer_name" => $record->payer_name,
                "payer_phone" => $record->payer_phone,
                "channel" => $record->channel,
                "collector" => $collector,
                "datetime" => date("Y-m-d H:i:s", strtotime($record->datetime_created)),
                "reciept" => $reciept_url,
                "photo" => $image_button,
                "reversal" => $reversal_button
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        );

        return $response;
    }

    // get invoice distribution list
    public function getInvoiceDistribution($postData = null)
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

        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
                "d.`invoiceno` like '%" . $searchValue . 
                "%' or d.`recipient_name` like '%" . $searchValue .
                "%' or d.`recipient_phone` like'%" . $searchValue .
                "%' or d.`recipient_position` like'%" . $searchValue . "%'"
            );
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('invoice_distribution as d');
        $this->db->join('vw_invoice as i','d.invoiceno = i.invoice_no');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(d.datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            }
            
            if ($postData['area']) { 
                $this->db->where('i.area_council_id', $postData['area']);
            }
            if ($postData['bill_type'] != "") {
                $this->db->where('i.product_id', $postData['bill_type']);
            }
            if ($postData['town']) {
                $this->db->where('i.town_id', $postData['town']);
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('invoice_distribution as d');
        $this->db->join('vw_invoice as i','d.invoiceno = i.invoice_no');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(d.datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            }
            
            if ($postData['area']) { 
                $this->db->where('i.area_council_id', $postData['area']);
            }
            if ($postData['bill_type'] != "") {
                $this->db->where('i.product_id', $postData['bill_type']);
            }
            if ($postData['town']) {
                $this->db->where('i.town_id', $postData['town']);
            }
        }
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('d.*,i.name as product,a.name as electoral_area, t.town as town');
        $this->db->from('invoice_distribution as d');
        $this->db->join('vw_invoice as i','d.invoiceno = i.invoice_no');
        $this->db->join("area_council as a",'a.id = i.area_council_id');
		$this->db->join("town as t",'t.id = i.town_id');

        if ($searchValue == '') {
            $start_date = $postData['start_date'];
            $end_date = $postData['end_date'];
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(d.datetime_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            } else if ($start_date == "" && $end_date != "") {
                $this->db->where('date(d.datetime_created) >=', $start_date);
                $this->db->where('date(d.datetime_created) <=', $end_date);
            }
            
            if ($postData['area']) { 
                $this->db->where('i.area_council_id', $postData['area']);
            }
            if ($postData['bill_type'] != "") {
                $this->db->where('i.product_id', $postData['bill_type']);
            }
            if ($postData['town']) {
                $this->db->where('i.town_id', $postData['town']);
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

            //get name of the person who delivered the bill
            if ($record->creator_category == "admin") {
                $admin = collected_by_admin($record->created_by);
                $collector = $admin['firstname'] . ' ' . $admin['lastname'];
            } else if ($record->creator_category == "agent") {
                $agent = collected_by_agent($record->created_by);
                $collector = $agent['firstname'] . ' ' . $agent['lastname'] . ' (' . $agent['agent_code'] . ')';
            } else {
                $collector = "";
            }

            $data[] = array(
                "invoice_no" => $record->invoiceno,
                "bill_type" => $record->product,
                "town" => $record->electoral_area ." / ".$record->town,
                "recipient_name" => $record->recipient_name,
                "recipient_phone" => $record->recipient_phone,
                "recipient_position" => $record->recipient_position,
                "remark" => $record->remark,
                "delivered_by" => $collector,
                "datetime" => date("Y-m-d H:i:s", strtotime($record->datetime_created))
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
        );

        return $response;
    }
    
    private function getConsolidatePropertyOwnerDetails($row) {
        $ownerDetails = array(
            "owner_name" => $row->roName,
            "business_code" => $row->buis_occ_code,
            "town" => $row->town,
            "primary_contact" => $row->primary_contact,
            "email" => $row->email,
            "secondary_contact" => $row->secondary_contact
        );
        return $ownerDetails;
    }

    private function sumInvoiceAmountAndDiscount($destination, $row) {
                
        if (array_key_exists('subtotal', $destination)) {
            $destination['subtotal'] = $destination['subtotal'] + $row->invoice_amount;
        } else {
            $destination['subtotal'] = $row->invoice_amount;
        }

        if (array_key_exists('discount', $destination)) {
            $destination['discount'] = $destination['discount'] + $row->adjustment_amount;
        } else {
            $destination['discount'] = $row->adjustment_amount;
        }

        if (array_key_exists('penalty_amount', $destination)) {
            $destination['penalty_amount'] += $row->penalty_amount;
        } else {
            $destination['penalty_amount'] = $row->penalty_amount;
        }

        $arrears_paid = get_invoice_arrears(
            $row->property_id, $row->product_id, $row->invoice_year);
        $actual_arrears = $arrears_paid['invoice_amount'] - $arrears_paid['amount_paid'];
        $total_amount = $row->invoice_amount + $row->penalty_amount + $actual_arrears;
        if (array_key_exists('total', $destination)) {
            $destination['total'] = $destination['total'] + $total_amount;
        } else {
            $destination['total'] = $total_amount;
        }

        if (array_key_exists('actual_arrears', $destination)) {
            $destination['actual_arrears'] = $destination['actual_arrears'] + $actual_arrears;
        } else {
            $destination['actual_arrears'] = $actual_arrears;
        }

        return $destination;
    }

	// get the details of a consolidated invoice
	public function get_consolidated_invoice_detail($primaryContact)
	{
        $contactName = "";
        $searchWithContactName = FALSE;

        if(substr($primaryContact, 0, 2) == "0_") {
            $searchWithContactName = TRUE;
            $contactName = str_replace(
                "_", " ",
                substr($primaryContact, 2, strlen($primaryContact) - 2)
            );
        }
		$this->db->select(
			'i.*, r.name, r.target,c.name as category1,d.name as category2,
			e.name as category3, f.name as category4, b.buis_name, b.buis_email,
			b.buis_occ_code, b.buis_primary_phone,p.buis_prop_code, t.town,
			tt.town as occ_town,
			concat(prop.firstname, " ", prop.lastname) as roName,
            concat(po.firstname, " ", po.lastname) as boName, po.primary_contact,
            po.secondary_contact, po.email,
            (case
                when (`r`.`target` = 3) then `b`.`buis_name`
                when (`r`.`target` = 2) then concat(`po`.`firstname`, " ", `po`.`lastname`)
                when (`r`.`target` = 1) then concat(`prop`.`firstname`, " ", `prop`.`lastname`)
                else "" end) AS customer_name'
		);
		$this->db->from('invoice as i');
		$this->db->join('revenue_product as r', 'r.id = i.product_id');
		$this->db->join(
            'product_category1 as c', 'c.id = i.category1_id', 'left');
		$this->db->join(
            'product_category2 as d', 'd.id = i.category2_id', 'left');
		$this->db->join(
            'product_category3 as e', 'e.id = i.category3_id', 'left');
		$this->db->join(
            'product_category4 as f', 'f.id = i.category4_id', 'left');
		$this->db->join(
            'residence_to_owner as ro',
            'i.property_id = ro.property_id', 'left');
		$this->db->join(
            'property_owner as prop', 'ro.owner_id = prop.id', 'left');
		$this->db->join(
            'buis_prop_to_owner as bo',
            'i.property_id = bo.property_id', 'left');
		$this->db->join(
            'property_owner as po', 'bo.owner_id = po.id', 'left');
		$this->db->join('buisness_occ as b', 'i.property_id = b.id', 'left');
		$this->db->join(
            'buisness_property as p', 'i.property_id = p.id', 'left');
		$this->db->join(
            'buisness_property as z',
            'b.buis_property_code = z.buis_prop_code', 'left');
		$this->db->join('town as tt', 'z.town = tt.id', 'left');
        $this->db->join('town as t', 'p.town = t.id', 'left');
        
        $year = date('Y');
        $this->db->where('i.invoice_amount IS NOT NULL');
        $this->db->where('i.invoice_year', $year);
        $this->db->where('i.status !=', 1, FALSE);
        $this->db->where('i.amount_paid < i.invoice_amount');
        
        if ($searchWithContactName) {
            $this->db->where('prop.primary_contact', NULL, False);
            $this->db->where('prop.secondary_contact', NULL, False);
            $this->db->having("customer_name", $contactName);
        } else {
            $this->db->where('prop.primary_contact', $primaryContact);
            $this->db->or_where('prop.secondary_contact', $primaryContact);
        }

        $query = $this->db->get();
        
		$records = array();
        $contactInfo = array();
        $contactInfoProcessed = FALSE;
        $reportAmountSummary = array();
        $invoiceDates = array();
        $dueDateSet = FALSE;
        
		foreach($query->result() as $record) {
            if (!$contactInfoProcessed) {
                $contactInfo = $this->getConsolidatePropertyOwnerDetails($record);
                $contactInfoProcessed = True;
            }
            array_push($records, $record);
            $reportAmountSummary = $this->sumInvoiceAmountAndDiscount(
                $reportAmountSummary, $record);
            
            if(!$dueDateSet) {
                $invoiceDates = array(
                    "payment_due_date" => $record->payment_due_date,
                    "invoice_due_date" => $record->invoice_due_date
                );
                $dueDateSet = TRUE;
            }
        }
        
        $reportAmountSummary = array_merge($invoiceDates, $reportAmountSummary);
        $result = array(
            "contact" => $contactInfo,
            "records" => $records,
            "summary" => $reportAmountSummary
        );
        // die(var_dump($result));
		return json_encode($result);
    }

}
