<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// function generate a random string
function random_string($type = 'alnum', $len = 8) {
    switch ($type) {
        case 'basic':
            return mt_rand();
        case 'alnum':
        case 'numeric':
        case 'nozero':
        case 'alpha':
            switch ($type) {
                case 'alpha':
                    $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'alnum':
                    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'numeric':
                    $pool = '0123456789';
                    break;
                case 'nozero':
                    $pool = '123456789';
                    break;
            }
            return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
        case 'unique': // todo: remove in 3.1+
        case 'md5':
            return md5(uniqid(mt_rand()));
        case 'encrypt': // todo: remove in 3.1+
        case 'sha1':
            return sha1(uniqid(mt_rand(), TRUE));
    }
}

// active page
function is_active($selected_page_name = "") {
    $CI	=&	get_instance();
    $CI->load->library('session');

    if ($CI->session->userdata('last_page') == $selected_page_name) {
        return "nav-active";
    }else {
        return "";
    }
}


function buildBreadCrumb($currentPage, $clearPreviousPages=FALSE) {
    $CI = &get_instance();
    $CI->load->library('session');
    
    $breadCrumbs = $CI->session->userdata('bread_crumbs');

    if (!is_array($currentPage)) {
        die("`currentPage` must be an array instead");
    }

    if (
            !array_key_exists('label', $currentPage) ||
            !array_key_exists('url', $currentPage)
        ) {
        die("currentPage must contain a key name label and another named url");
    }
    
    if (
            is_null($breadCrumbs) ||
            !array_key_exists('current', $breadCrumbs) || $clearPreviousPages
        ) {
        $breadCrumbs = array(
            'current' => $currentPage, 'previous' => array());
            $CI->session->set_userdata('bread_crumbs', $breadCrumbs);
        return $breadCrumbs;
    }

    $isCurrentPageMatched = (
        $breadCrumbs['current']['label'] == $currentPage['label'] &&
        $breadCrumbs['current']['url'] == $currentPage['url']
    );

    if ($isCurrentPageMatched) {
        return $breadCrumbs;
    }

    $foundAtIndex = -1;
    $previousCrumbs = $breadCrumbs['previous'];
    if (is_null($previousCrumbs)) {
        $previousCrumbs = array();
    }
    $newPrevious = array();
    for($i = 0, $len = count($previousCrumbs); $i < $len; $i++) {
        if (
                $previousCrumbs[$i]['label'] == $currentPage['label'] &&
                $previousCrumbs[$i]['url'] == $currentPage['url']
            ) {
            $foundAtIndex = $i;
            break;
        }
        array_push($newPrevious, $previousCrumbs[$i]);
    }

    
    if ($foundAtIndex == -1) {
        array_push($previousCrumbs, $breadCrumbs['current']);
        $breadCrumbs['current'] = $currentPage;
        $breadCrumbs['previous'] = $previousCrumbs;
        $CI->session->set_userdata('bread_crumbs', $breadCrumbs);
        return $breadCrumbs;
    }
    $breadCrumbs['current'] = $currentPage;
    $breadCrumbs['previous'] = $newPrevious;
    $CI->session->set_userdata('bread_crumbs', $breadCrumbs);
    return $breadCrumbs;
}

function displayBreadCrumbs() {

    $CI = &get_instance();
    $CI->load->library('session');
    
    $breadCrumbs = $CI->session->userdata('bread_crumbs');
    $crumbs = (
        '<li><a href='.base_url().'dashboard>
            <i class="fa fa-home"></i>
        </a></li>'
    );

    foreach( $breadCrumbs['previous'] as $breadCrumb) {
        if (strtoupper($breadCrumb['label']) == strtoupper('dashboard')) {
            continue;
        } else {
            $crumbs .= (
                '<li><a href='.base_url().$breadCrumb['url'].'>'
                    .$breadCrumb['label'].
                '</a></li>'
            );
        }
    }

    if (strtoupper($breadCrumbs['current']['label']) != strtoupper('dashboard')) {
        $crumbs .= (
            '<li><span>'.$breadCrumbs['current']['label'].'</span></li>'
        );
    }

    return $crumbs;

}

// insert data into audit tray
function audit_tray($data) {

    $CI = & get_instance();
    $CI->db->insert('audit_tray', $data);
    return $CI->db->insert_id();
}

// get channels status
function get_channel_status($channelid) {

    $CI = & get_instance();
    $CI->db->select('active');
    $CI->db->from("channels");
    $CI->db->where("channelid",$channelid);
    return $CI->db->get()->row_array()['active'];
}

// get agent status
function get_agent_status($agentid) {

    $CI = & get_instance();
    $CI->db->select('account_status');
    $CI->db->from("agent");
    $CI->db->where("id",$agentid);
    return $CI->db->get()->row_array()['account_status'];
}

// get user status
function get_user_status($id) {

    $CI = & get_instance();
    $CI->db->select('account_status');
    $CI->db->from("users");
    $CI->db->where("id",$id);
    return $CI->db->get()->row_array()['account_status'];
}

// send an sms
function send_sms($phone, $message) {
    $url = "http://api.nalosolutions.com/bulksms/?username=deksolops&password=deks@l@ps&type=0&dlr=1&destination=";
    $url .= $phone . "&source=".SYSTEM_ID."&message=" . rawurlencode($message);

    return file_get_contents($url);
    return true; 
}

// area councils
function area_council() {

    $CI = & get_instance();
    $CI->db->select('id,name');
    $CI->db->from("area_council");
    return $CI->db->get()->result();
}

// get accessed property details
function accessed_property($target,$property_id) {
    $where = array(
        'target' => $target,
        "property_id" => $property_id
    );
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("accessed_property");
    $CI->db->where($where);
    return $CI->db->get()->row_array();
}

// check for user permission
function has_permission($user_id, $role) {
    $CI = & get_instance();
    $data = array(
    	'user_id' => $user_id,
    	'role' => $role
    );
    $CI->db->select('*');
    $CI->db->from('user_roles');
    $CI->db->where($data);
    $query = $CI->db->get();
    if($query->num_rows()) {
        return TRUE;
    }else{
    	return false;
    }
}

//check for generate_bill_status
 function generate_bill_status($id, $table){
    $CI = & get_instance();
    $data = array(
    	'id' => $id,
    	'generate_bill_status' => 1
    );
    $CI->db->select('*');
    $CI->db->from($table);
    $CI->db->where($data);
    $result = $CI->db->get()->row_array();
    return $result;
}


// get area council code
function get_areacode($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('area_council');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}

// get area council code
function get_invoice_arrears($property_id,$product_id,$invoice_year) {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT sum(amount_paid) as amount_paid, sum(invoice_amount) as invoice_amount from invoice WHERE property_id = $property_id AND product_id = $product_id
              AND invoice_year < '$invoice_year'")->row_array();
    return $query;

}

// get area council code
function get_invoice_arrears_new($property_id,$product_id,$invoice_year) {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT * from invoice WHERE (COALESCE(i.amount_paid, 0) + COALESCE(i.adjustment_amount, 0)) >= COALESCE(i.invoice_amount, 0) AND property_id = $property_id AND product_id = $product_id
              AND invoice_year < '$invoice_year'")->row_array();
    return $query;

}

// get area council code
function get_onetime_invoice_arrears($firstname,$invoice_year) {
    $CI = & get_instance();
    $query = $CI->db->query("SELECT sum(amount_paid) as amount_paid, sum(amount) as invoice_amount from invoice_options WHERE firstname = '$firstname'
              AND invoice_year < '$invoice_year'")->row_array();
    return $query;

}


// get business sector code
function get_bussector_code($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('buis_sector');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}

// get category 1 code
function get_category1_code($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('product_category1');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}


// get town code
function get_towncode($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('town');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}

function get_outdoor_type_letter($id){
    // $CI = & get_instance();
    // $data = array(
    //     'outdoor_type' => $id
    // );
    // $CI->db->select('UPPER(LEFT(outdoor_type, 1)) AS outdoor_type');
    // $CI->db->from('signage');
    // $CI->db->where($data);
    // $CI->db->limit('1');
    // return $query = $CI->db->get()->row()->outdoor_type;
    if ($id == "single" ){
        return "S";
    }elseif ($id == "double"){
        return "D";
    }else{
       return "T";
    }
}


// get outdoor owner code
function get_ownercode($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('outdoorvendors');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}

// get telecomvendor code
function get_vendor($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('telecomvendors');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}

// get network code
function get_network($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('code');
    $CI->db->from('telecom');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->code;

}


// get town code
function get_town_name($id) {
    $CI = & get_instance();
    $data = array(
        'id' => $id
    );
    $CI->db->select('town');
    $CI->db->from('town');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->town;

}

// get houseno code
function get_res_houseno($id) {
    $CI = & get_instance();
    $data = array(
        'res_code' => $id
    );
    $CI->db->select('houseno');
    $CI->db->from('residence');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->houseno;

}

// get town id
function get_townid($id) {
    $CI = & get_instance();
    $data = array(
        'buis_prop_code' => $id
    );
    $CI->db->select('town');
    $CI->db->from('buisness_property');
    $CI->db->where($data);
    return $query = $CI->db->get()->row()->town;

}

// check if owner already exit
function owner_exit($primary_contact){
    $CI = & get_instance();
    $query = $CI->db->query("SELECT id from property_owner WHERE primary_contact = ?"
        ,[$primary_contact]);

    if($query->num_rows()) {
        return $query->row_array()['id'];
    }else{
        return false;
    }

}

//ownwer details

function owner_details($id){
    $CI = & get_instance();
    $CI->db->select('p.*');
    $CI->db->from("property_owner as p");
    $CI->db->join('residence_to_owner as r','p.id = r.owner_id');
    $CI->db->where('property_id',$id);
    $query = $CI->db->get()->row_array();

    return $query;
}

//collected by admin

function collected_by_admin($id){
    $CI = & get_instance();

    $CI->db->select('firstname,lastname');
    $CI->db->from("users");
    $CI->db->where('id',$id);
    $query = $CI->db->get()->row_array();
    return $query;
}

//collected by admin

function collected_by_agent($id){
    $CI = & get_instance();

    $CI->db->select('agent_code,firstname,lastname');
    $CI->db->from("agent");
    $CI->db->where('id',$id);
    $query = $CI->db->get()->row_array();
    return $query;
}

//tax assignment name

function get_tax_name($id){
    $CI = & get_instance();

    return $CI->db->query("SELECT buis_name from buisness_occ WHERE id = '$id'")->row_array()['buis_name'];
}

//tax assignment name

function get_tax_code($target,$id){
    $CI = & get_instance();

    if($target == 3){
      return $CI->db->query("SELECT buis_occ_code from buisness_occ WHERE id = '$id'")->row_array()['buis_occ_code'];
    }else if($target == 2){
      return $CI->db->query("SELECT buis_prop_code from buisness_property WHERE id = '$id'")->row_array()['buis_prop_code'];
    }else{
      return $CI->db->query("SELECT res_code from residence WHERE id = '$id'")->row_array()['res_code'];
    }
}

//get gender stat details

function get_gender_stats(){
  $gender_array = array("Male","Female");
  $data = "";
  foreach ($gender_array as $gender) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household");
    $CI->db->where('gender',$gender);
    $count = $CI->db->get()->num_rows();
    $data.="{".'"name":'.'"'.$gender.'",'.'"y":'.$count.',"drilldown":'.'"'.$gender.'"'."},";
  }

  $data_structure = rtrim($data,',');
  return $data_structure;
}

//get profession area council stat details

function get_area_profession_data(){
  $CI = & get_instance();
  $prof = $CI->db->query("select p.name as profession, count(h.profession) pc from profession p, household h where p.id = h.profession group by h.profession order by pc desc limit 10")->result_array();

  $pdata = "";
  foreach ($prof as $p) {
  if(!empty($pdata)) $pdata .= ",";
    $pdata .= "'" . $p['profession'] . "'";
  }

  if($pdata != ""){
    $prof_data = $CI->db->query("select t1.profession, sum(t1.pc) as area_count, t2.area from (select p.name as profession, count(h.profession) pc, h.res_prop_code from profession p, household h where p.id = h.profession group by h.profession, h.res_prop_code) t1 left join (select r.res_code, a.name as area from residence r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.res_prop_code = t2.res_code where t1.profession IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p['profession'];
      $d->id = $p['profession'];
      $d->data = [];
  
      foreach ($prof_data as $pd) {
          if($pd['profession'] == $d->name){
              array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
          }
      }
  
      array_push($series, $d);
    }
    return json_encode($series);
  }else{
    $series = [];
    return json_encode($series);
  }
  
}

//    get count all invoices to be printed
function get_batch_print_invoice($product,$category1, $year, $electoral_area, $town)
{
    $CI = & get_instance();
    $CI->db->select('count(*) as total_count');
    $CI->db->from('vw_invoice as i');
    ($product) ? $CI->db->where('i.product_id', $product) : null;
    ($category1) ? $CI->db->where('i.category1_id', $category1) : null;
    ($year) ? $CI->db->where('i.invoice_year', $year) : null;
    ($electoral_area) ? $CI->db->where('i.area_council_id', $electoral_area) : null;
    ($town) ? $CI->db->where('i.town_id', $town) : null;

    $total = $CI->db->get()->row_array();
    return $total['total_count'];
}

//get gender area council stat details

function get_gender_area_council(){

    $CI = & get_instance();
    $pdata = "'" .'Male'. "',"."'" .'Female'. "'";
    $prof = array("Male","Female");
    //return $pdata;
    $prof_data = $CI->db->query("select t1.gender, sum(t1.pc) as area_count, t2.area from (select h.gender, count(h.gender) pc, h.res_prop_code from household h group by h.gender, h.res_prop_code) t1 left join (select r.res_code, a.name as area from residence r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.res_prop_code = t2.res_code where t1.gender IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['gender'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get revenue stream

function get_revenue_stream_area_council(
    $revenue_id,$target,$year=NULL, $lowerDateBound=NULL, $upperDateBound=NULL
){

    $CI = & get_instance();
    if($target == 3){
        if (is_null($year)) {
            $placeHolder = "";
        } else {
            $placeHolder = "AND i.invoice_year = '$year'";

            if (!is_null($lowerDateBound) && !is_null($upperDateBound)) {
                $placeHolder = (
                    "$placeHolder AND
                        DATE_FORMAT(FROM_UNIXTIME(invoice_due_date), '%Y-%m-%d')
                    BETWEEN '$lowerDateBound' AND '$upperDateBound'"
                );
            }
        }
        $total_revenue = $CI->db->query(
            "SELECT
                COALESCE(bb.area_council, 'NOT_PROVIDED') as area_council,
                COALESCE(a.name, 'NOT_PROVIDED') as name,
                COALESCE(sum(i.invoice_amount), 0) as total_amount,
                COALESCE(sum(i.amount_paid), 0) as amount_paid
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
            $placeHolder
            group by
                bb.area_council
            "
        )->result();
		return($total_revenue);
    }else if ($target == 2){

        if (is_null($year)) {
            $placeHolder = "";
        } else {
            $placeHolder = "AND i.invoice_year = $year";
        }

        $total_revenue = $CI->db->query(
            "SELECT
                COALESCE(b.area_council, 'NOT_PROVIDED') as area_council,
                COALESCE(a.name, 'NOT_PROVIDED') as name,
                COALESCE(sum(i.invoice_amount),  0) as total_amount,
                COALESCE(sum(i.amount_paid), 0) as amount_paid 
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
                i.product_id = $revenue_id
            AND
                r.target = 2
                $placeHolder
            group by
                b.area_council"
        )->result();
		return($total_revenue);
    }else if ($target == 1){

        if (is_null($year)) {
            $placeHolder = "";
        } else {
            $placeHolder = "AND i.invoice_year = $year";
        }
        $total_revenue = $CI->db->query(
            "SELECT
                COALESCE(b.area_council, 'NOT_PROVIDED') as area_council,
                COALESCE(a.name, 'NOT_PROVIDED') as name,
                COALESCE(sum(i.invoice_amount),  0) as total_amount,
                COALESCE(sum(i.amount_paid), 0) as amount_paid 
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
                i.product_id = $revenue_id
            AND
                r.target = 1
                $placeHolder
            group by
                b.area_council
            "
        )->result();
		return($total_revenue);
    }else{
        $total_revenue = array();
		return($total_revenue);
    }
    
}

//get revenue based on business type

function get_revenue_bustype_area_council($revenue_id,$target, $year = NULL){

    $CI = & get_instance();
    
    if (is_null($year)) {
        $placeHolder = "";
    } else {
        $placeHolder = "AND i.invoice_year = $year";
    }

    $total_revenue = $CI->db->query(
        "SELECT
            COALESCE(bb.area_council, 'NOT_PROVIDED') as area_council,
            COALESCE(a.name, 'NOT_PROVIDED') as name,
            COALESCE(sum(i.invoice_amount), 0) as total_amount,
            COALESCE(sum(i.amount_paid), 0) as amount_paid
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
            area_council a
        on
            bb.area_council = a.id
        right join
            product_category1 p
        on
            i.category1_id = p.id 
        WHERE
            p.product_id = 1
            $placeHolder
        group by
            bb.area_council
        "
    )->result();
    
    return($total_revenue);
    
}

//get household area council stat details

function get_data_area_council_statss(){
    $CI = & get_instance();
    //list of tables to collate from
    $tables_array = array("residence"=>"Residence Property","buisness_property"=>"Business Property","buisness_occ"=>"Business Occupants");
    $series = [];
    foreach ($tables_array as $table => $name) {
      $d = new stdClass;
      $d->name = $name;
      $d->id = $name;
      $d->data = [];
      if($table == "household"){
        $prof_data = $CI->db->query("select sum(t1.pc) as area_count, t2.area from (select count(h.res_prop_code) pc, h.res_prop_code from household h group by h.res_prop_code) t1 left join (select r.res_code, a.name as area from residence r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.res_prop_code = t2.res_code group by 2")->result_array();
        foreach ($prof_data as $pd) {
        	if($name == $d->name){
        		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
        	}
        }
      }else if($table == "buisness_occ"){
        $prof_data = $CI->db->query("select sum(t1.pc) as area_count, t2.area from (select count(b.buis_property_code) pc, b.buis_property_code from buisness_occ b group by b.buis_property_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_property_code = t2.buis_prop_code group by 2")->result_array();
        foreach ($prof_data as $pd) {
        	if($name == $d->name){
        		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
        	}
        }
      }else if($table == "buisness_property"){
        $prof_data = $CI->db->query("select sum(t1.pc) as area_count, t2.area from (select count(b.buis_prop_code) pc, b.buis_prop_code from buisness_property b where b.category = 12 group by b.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code group by 2")->result_array();
        foreach ($prof_data as $pd) {
        	if($name == $d->name){
        		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
        	}
        }
      }else if($table == "residence"){
        $prof_data = $CI->db->query("select sum(t1.pc) as area_count, t2.area from (select count(b.buis_prop_code) pc, b.buis_prop_code from buisness_property b where b.category = 13 group by b.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code group by 2")->result_array();
        foreach ($prof_data as $pd) {
        	if($name == $d->name){
        		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
        	}
        }
      }else{

      }
      array_push($series, $d);
    }
    return json_encode($series);
}


//get area employment status stat details

function get_area_employment_status_dataa(){
    $CI = & get_instance();
    $pdata = "'" .'Employed'. "',"."'" .'Self-Employed'."',"."'" .'Unemployed'. "'";
    $prof = array("Employed","Self-Employed","Unemployed");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.employment_status, sum(t1.pc) as area_count, t2.area from (select h.employment_status, count(h.employment_status) pc, h.res_prop_code from household h group by h.employment_status, h.res_prop_code) t1 left join (select r.res_code, a.name as area from residence r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.res_prop_code = t2.res_code where t1.employment_status IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['employment_status'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get edu area council stat details

function get_area_edu_data(){

    $CI = & get_instance();
    $edu = $CI->db->query("select e.level as education, COUNT(h.highest_edu) as pc from education e, household h where e.id = h.highest_edu group by h.highest_edu")->result_array();

    $pdata = "";
    foreach ($edu as $e) {
    if(!empty($pdata)) $pdata .= ",";
    $pdata .= "'" . $e['education'] . "'";
    }

    if ($pdata != ""){

        $edu_data = $CI->db->query("select t1.education, sum(t1.pc) as area_count, t2.area from (select e.level as education, count(h.highest_edu) pc, h.res_prop_code from education e, household h where e.id = h.highest_edu group by h.highest_edu, h.res_prop_code) t1 left join (select r.res_code, a.name as area from residence r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.res_prop_code = t2.res_code where t1.education IN ($pdata) group by 1,3")->result_array();

        $series = [];
        foreach ($edu as $p) {
        $d = new stdClass;
        $d->name = $p['education'];
        $d->id = $p['education'];
        $d->data = [];

        foreach ($edu_data as $pd) {
            if($pd['education'] == $d->name){
                array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
            }
        }

        array_push($series, $d);
        }
        return json_encode($series);
    }else{
        $series = [];
        return json_encode($series);
    }
}


//get profession stat details
function get_profession_data(){
    $CI = & get_instance();
    $CI->db->select('p.name,COUNT(h.profession) as count');
    $CI->db->from("household as h");
    $CI->db->join('profession as p','p.id = h.profession');
    $CI->db->order_by('count','desc');
    $CI->db->limit(10);
    $CI->db->group_by('h.profession');
    $prof = $CI->db->get()->result_array();
    $data = "";
    foreach ($prof as $p) {
        $data .= "{".'"name":'.'"'.$p['name'].'",'.'"y":'.$p['count'].',"drilldown":'.'"'.$p['name'].'"'."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get data stat details
function get_data_stat(){
    $CI = & get_instance();
    //list of tables to collate from
    $tables_array = array(13=>"Residence Property",12=>"Business Property","signage"=>"Signage","buisness_occ"=>"Business Occupants");
    $data = "";

    foreach ($tables_array as $table => $name) {
        if($table == 12 || $table == 13){
            $CI->db->select('count(*) as count1');
            $CI->db->from("buisness_property");
            $CI->db->where("category",$table);
            $total = $CI->db->get()->result_array();
            $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',"drilldown":'.'"'.$name.'"'."},";
        }else{
            $CI->db->select('count(*) as count1');
            $CI->db->from($table);
            $total = $CI->db->get()->result_array();
            $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',"drilldown":'.'"'.$name.'"'."},";
        }
        
    }

    $data_structure = rtrim($data,',');
    return $data_structure;
}

// get daily registration
function get_agent_daily_registration($agent_id){
    $CI = & get_instance();

    //list of tables to collate from
    $tables_array = array("residence","buisness_property","buisness_occ","signage");
    $date_count_array = array();

    //where clauses
    $where = array(
        "agent_id" => $agent_id,
        "agent_category" => "agent"
    );

    $where2 = array(
        "created_id" => $agent_id,
        "created_by" => "agent"
    );

    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {

        if($table == "signage"){
            $CI->db->select('DATE(datetime_created) as date_created, count(*) as count1');
            $CI->db->from($table);
            $CI->db->group_by('1');
            $CI->db->order_by('1','DESC');
            $CI->db->where($where2);
            $CI->db->limit('8');
            $date_record = $CI->db->get()->result_array();
        }else{
            $CI->db->select('DATE(date_created) as date_created, count(*) as count1');
            $CI->db->from($table);
            $CI->db->group_by('1');
            $CI->db->order_by('1','DESC');
            $CI->db->where($where);
            $CI->db->limit('8');
            $date_record = $CI->db->get()->result_array();
        }

        foreach($date_record as $a) {
            $date_record_array_key = $a['date_created'];
            //check if agent_id exists in $agent_count_array
            if (array_key_exists($date_record_array_key,$date_count_array)){
                //add date's count to existing record
                $date_count_array[$date_record_array_key]+=$a['count1'];
            } else {
                //insert date and count
                $date_count_array[$date_record_array_key]=$a['count1'];
            }
        }
    }

    //return last 8 days
    $date_count_array = array_slice($date_count_array,0,8);

    //form data and x-axis data
    $data = "";
    $data_dates = "";
    foreach ($date_count_array as $date_key => $date_count) {
        $date_key = date_create($date_key);
        $date_key =  date_format($date_key,"D, d M");

        $data_dates .= "'$date_key',";
        $data .= "{".'"name":'.'"'.$date_key.'",'.'"y":'.$date_count.',color:"'.'#17a2b8"'."},";
    }
    $data_structure = rtrim($data,',');
    $data_dates = rtrim($data_dates,',');
    return array($data_structure,$data_dates);

}

// get daily registration
function get_agent_daily_breakdown_registration($agent_id){
    $CI = & get_instance();

    //list of tables to collate from
    $tables_array = array("household","residence","buisness_property","buisness_occ","household_transport","businessocc_transport");
    $date_count_array = array();

    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {
        $CI->db->select('DATE(date_created) as date_created, count(*) as count1');
        $CI->db->from($table);
        $CI->db->group_by('1');
        $CI->db->order_by('1','DESC');
        $CI->db->where("agent_id",$agent_id);
        $CI->db->limit('8');
        $date_record = $CI->db->get()->result_array();

        foreach($date_record as $a) {
            $date_record_array_key = $a['date_created'];
            //check if agent_id exists in $agent_count_array
            if (array_key_exists($date_record_array_key,$date_count_array)){
                //add date's count to existing record
                $date_count_array[$date_record_array_key].=",".$a['count1'];
            } else {
                //insert date and count
                $date_count_array[$date_record_array_key]=$a['count1'];
            }
        }
    }

    //return last 8 days
    $date_count_array = array_slice($date_count_array,0,8);

    //form data and x-axis data
    $data = "";
    $data_dates = "";
    foreach ($date_count_array as $date_key => $date_count) {
        $date_key = date_create($date_key);
        $date_key =  date_format($date_key,"D, d M");

        $data_dates .= "'$date_key',";
        $data .= "{".'"name":'.'"'.$date_key.'",'.'"y":'.$date_count.',color:"'.'#17a2b8"'."},";
    }
    return $data_structure = rtrim($data,',');
    // $data_dates = rtrim($data_dates,',');
    // return array($data_structure,$data_dates);

}


//get data stat details
function get_agent_data_stat($agent_id){
    $CI = & get_instance();

    $where = array(
        "agent_id" => $agent_id,
        "agent_category" => "agent"
    );

    $res_where = array(
        "agent_id" => $agent_id,
        "agent_category" => "agent",
        "category" => 13
    );

    $busprop_where = array(
        "agent_id" => $agent_id,
        "agent_category" => "agent",
        "category" => 12
    );

    $where2 = array(
        "created_id" => $agent_id,
        "created_by" => "agent"
    );
    $CI->db->select('*');
    $CI->db->from("signage");
    $CI->db->where($where2);
    $signage = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $CI->db->where($res_where);
    $residence = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $CI->db->where($busprop_where);
    $buis_property = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("buisness_occ");
    $CI->db->where($where);
    $buis_occ = $CI->db->get()->num_rows();

    
    $data_structure = '{"name": "Residence","y":'.$residence.',"drilldown": "Residence"},{"name": "Business Property","y":'.$buis_property.',"drilldown": "Business Property"},{"name": "Business Occupants","y":'.$buis_occ.',"drilldown": "Business Occupants"},{"name": "Signage","y":'.$signage.',"drilldown": "Signage"}';
    return $data_structure;
}

//get household area council stat details
function get_data_area_council_stats(){
    //list of tables to collate from
    $tables_array = array("residence"=>"Residence Property","buisness_property"=>"Business Property","household"=>"Household","buisness_occ"=>"Business Occupants");
    $main_data = "";
    $titles = "";
    foreach ($tables_array as $table => $name) {
      $CI = & get_instance();
      $CI->db->select('id,name');
      $CI->db->from("area_council");
      $area = $CI->db->get()->result();
      $data = "";
      $titles = '{"name":"'.$name.'","id":"'.$name.'","data":[';
      if($table == "household"){
        foreach ($area as $m) {
          $CI->db->select('*');
          $CI->db->from("household as h");
          $CI->db->where("r.area_council",$m->id);
          $CI->db->join('residence as r','r.res_code = h.res_prop_code');
          $count = $CI->db->get()->num_rows();
          $data .= "[".'"'.$m->name.'",'.$count."],";
        }
      }else if($table == "buisness_occ"){
        foreach ($area as $m) {
            $CI->db->select('*');
            $CI->db->from("buisness_occ as h");
            $CI->db->where("r.area_council",$m->id);
            $CI->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
            $count = $CI->db->get()->num_rows();
            $data .= "[".'"'.$m->name.'",'.$count."],";
        }
      }else{
        foreach ($area as $m) {
            $CI->db->select('*');
            $CI->db->from($table);
            $CI->db->where("area_council",$m->id);
            $count = $CI->db->get()->num_rows();
            $data .= "[".'"'.$m->name.'",'.$count."],";
        }
      }

      $data2 = rtrim($data,',');
      $main_data .= $titles.$data2.']},';
    }


    $data_structure = rtrim($main_data,',');
    return $data_structure;
}

//get residence toilet facility stat details

function get_residence_toilet_facility_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(toilet_facility) as count,toilet_facility');
    $CI->db->from("buisness_property");
    $CI->db->where("category",13);
    $CI->db->group_by('toilet_facility');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["toilet_facility"].'","y":'.$emp['count'].',"drilldown":"'.$emp["toilet_facility"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area residence toilet facility stat details

function get_area_residence_toilet_facility_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.toilet_facility, sum(t1.pc) as area_count, t2.area from (select h.toilet_facility, count(h.toilet_facility) pc, h.buis_prop_code from buisness_property h where h.category = 13 group by h.toilet_facility, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.toilet_facility IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['toilet_facility'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get residence means of disposal stat details

function get_residence_means_disposal_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(avai_of_refuse) as count,avai_of_refuse');
    $CI->db->from("buisness_property");
    $CI->db->where("category",13);
    $CI->db->group_by('avai_of_refuse');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["avai_of_refuse"].'","y":'.$emp['count'].',"drilldown":"'.$emp["avai_of_refuse"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area residence means of disposal stat details

function get_area_residence_means_disposal_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.avai_of_refuse, sum(t1.pc) as area_count, t2.area from (select h.avai_of_refuse, count(h.avai_of_refuse) pc, h.buis_prop_code from buisness_property h where h.category = 13 group by h.avai_of_refuse, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.avai_of_refuse IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['avai_of_refuse'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get residence building permit stat details

function get_residence_building_permit_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(building_permit) as count,building_permit');
    $CI->db->from("buisness_property");
    $CI->db->where("category",13);
    $CI->db->group_by('building_permit');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["building_permit"].'","y":'.$emp['count'].',"drilldown":"'.$emp["building_permit"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area residence building permit stat details

function get_area_residence_building_permit_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.building_permit, sum(t1.pc) as area_count, t2.area from (select h.building_permit, count(h.building_permit) pc, h.buis_prop_code from buisness_property h where h.category = 13 group by h.building_permit, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.building_permit IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['building_permit'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get business building permit stat details

function get_business_building_permit_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(building_permit) as count,building_permit');
    $CI->db->from("buisness_property");
    $CI->db->where("category",12);
    $CI->db->group_by('building_permit');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["building_permit"].'","y":'.$emp['count'].',"drilldown":"'.$emp["building_permit"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area business building permit stat details

function get_area_business_building_permit_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.building_permit, sum(t1.pc) as area_count, t2.area from (select h.building_permit, count(h.building_permit) pc, h.buis_prop_code from buisness_property h where h.category = 12 group by h.building_permit, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.building_permit IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['building_permit'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get temporary business building permit stat details

function get_temporary_business_building_permit_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(building_permit) as count,building_permit');
    $CI->db->from("buisness_property");
    $CI->db->where("category",12);
    $CI->db->where('building_type','Temporary');
    $CI->db->group_by('building_permit');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["building_permit"].'","y":'.$emp['count'].',"drilldown":"'.$emp["building_permit"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area temporary business building permit stat details

function get_area_temporary_business_building_permit_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.building_permit, sum(t1.pc) as area_count, t2.area from (select h.building_permit, count(h.building_permit) pc, h.buis_prop_code from buisness_property h where h.building_type = 'Temporary' and h.category = 12 group by h.building_permit, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id and r.building_type = 'Temporary' group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.building_permit IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['building_permit'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get permanent business building permit stat details

function get_permanent_business_building_permit_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(building_permit) as count,building_permit');
    $CI->db->from("buisness_property");
    $CI->db->where("category",12);
    $CI->db->where('building_type','Permanent');
    $CI->db->group_by('building_permit');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["building_permit"].'","y":'.$emp['count'].',"drilldown":"'.$emp["building_permit"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area permanent business building permit stat details

function get_area_permanent_business_building_permit_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.building_permit, sum(t1.pc) as area_count, t2.area from (select h.building_permit, count(h.building_permit) pc, h.buis_prop_code from buisness_property h where h.building_type = 'Permanent' and h.category = 12 group by h.building_permit, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id AND r.building_type = 'Permanent' group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.building_permit IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['building_permit'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get buiness property toilet facility stat details

function get_business_property_toilet_facility_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(toilet_facility) as count,toilet_facility');
    $CI->db->from("buisness_property");
    $CI->db->where("category",12);
    $CI->db->group_by('toilet_facility');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["toilet_facility"].'","y":'.$emp['count'].',"drilldown":"'.$emp["toilet_facility"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area buiness property toilet facility stat details

function get_area_business_property_toilet_facility_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.toilet_facility, sum(t1.pc) as area_count, t2.area from (select h.toilet_facility, count(h.toilet_facility) pc, h.buis_prop_code from buisness_property h where h.category = 12 group by h.toilet_facility, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.toilet_facility IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['toilet_facility'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get buiness property means of disposal stat details

function get_business_property_means_disposal_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(avai_of_refuse) as count,avai_of_refuse');
    $CI->db->from("buisness_property");
    $CI->db->where("category",12);
    $CI->db->group_by('avai_of_refuse');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["avai_of_refuse"].'","y":'.$emp['count'].',"drilldown":"'.$emp["avai_of_refuse"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area buiness property means of disposal stat details

function get_area_business_property_means_disposal_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.avai_of_refuse, sum(t1.pc) as area_count, t2.area from (select h.avai_of_refuse, count(h.avai_of_refuse) pc, h.buis_prop_code from buisness_property h where h.category = 12 group by h.avai_of_refuse, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.avai_of_refuse IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['avai_of_refuse'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

//get buiness property building permit stat details

function get_business_property_building_permit_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(building_permit) as count,avai_of_refuse');
    $CI->db->from("buisness_property");
    $CI->db->group_by('building_permit');
    $toilet_facility = $CI->db->get()->result_array();
    $data = "";
    foreach ($toilet_facility as $emp) {
        $data .= '{"name":"'.$emp["building_permit"].'","y":'.$emp['count'].',"drilldown":"'.$emp["building_permit"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area buiness property building permit stat details

function get_area_business_property_building_permit_data(){
    $CI = & get_instance();
    $pdata = "'" .'Yes'. "',"."'" .'No'."'";
    $prof = array("Yes","No");


    //return $pdata;
    $prof_data = $CI->db->query("select t1.building_permit, sum(t1.pc) as area_count, t2.area from (select h.building_permit, count(h.building_permit) pc, h.buis_prop_code from buisness_property h group by h.building_permit, h.buis_prop_code) t1 left join (select r.buis_prop_code, a.name as area from buisness_property r, area_council a where r.area_council = a.id group by 1,2) t2 on t1.buis_prop_code = t2.buis_prop_code where t1.building_permit IN ($pdata) group by 1,3")->result_array();

    $series = [];
    foreach ($prof as $p) {
      $d = new stdClass;
      $d->name = $p;
      $d->id = $p;
      $d->data = [];

      foreach ($prof_data as $pd) {
      	if($pd['building_permit'] == $d->name){
      		array_push($d->data, [$pd['area'], intval($pd['area_count'])]);
      	}
      }

      array_push($series, $d);
    }
    return json_encode($series);
}

// get daily registration
function get_daily_registration(){
    $CI = & get_instance();

    //list of tables to collate from
    $tables_array = array("household","residence","buisness_property","buisness_occ","household_transport","businessocc_transport","signage");
    $date_count_array = array();

    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {
        
        if($table == "signage"){
            $CI->db->select('DATE(datetime_created) as date_created, count(*) as count1');
        }else{
            $CI->db->select('DATE(date_created) as date_created, count(*) as count1');
        }
        $CI->db->from($table);
        $CI->db->group_by('1');
        $CI->db->order_by('1','DESC');
        $CI->db->limit('8');
        $date_record = $CI->db->get()->result_array();

        foreach($date_record as $a) {
            $date_record_array_key = $a['date_created'];
            //check if agent_id exists in $agent_count_array
            if (array_key_exists($date_record_array_key,$date_count_array)){
                //add date's count to existing record
                $date_count_array[$date_record_array_key]+=$a['count1'];
            } else {
                //insert date and count
                $date_count_array[$date_record_array_key]=$a['count1'];
            }
        }  
    }

    //return last 8 days
    $date_count_array = array_slice($date_count_array,0,8);

    //form data and x-axis data
    $data = "";
    $data_dates = "";
    foreach ($date_count_array as $date_key => $date_count) {
        $date_key = date_create($date_key);
        $date_key =  date_format($date_key,"D, d M");

        $data_dates .= "'$date_key',";
        $data .= "{".'"name":'.'"'.$date_key.'",'.'"y":'.$date_count.',color:"'.'#17a2b8"'."},";
    }
    $data_structure = rtrim($data,',');
    $data_dates = rtrim($data_dates,',');
    return array($data_structure,$data_dates);

}

//get data integrity
function get_data_integrity(){
    $CI = & get_instance();

    //------Missing Location---------
    //list of tables to collate from
    $tables_array = array("residence","buisness_property");
    $missing_location = 0;
    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {
        $CI->db->select('count(*) as count1');
        $CI->db->from($table);
        $CI->db->where('gps_lat = 0 AND gps_long = 0');
        $record = $CI->db->get()->result_array();
        $missing_location += $record[0]['count1'];
    }

    //------Missing Contact Nos---------
    //list of tables to collate from
    $tables_array = array("household","buisness_occ");
    $missing_contacts = 0;
    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {
        $CI->db->select('count(*) as count1');
        $CI->db->from($table);
        if($table == "household")
            $CI->db->where("primary_contact = NULL or primary_contact = ''", NULL, FALSE);
        elseif ($table == 'buisness_occ')
            $CI->db->where("buis_primary_phone = NULL or buis_primary_phone = ''", NULL, FALSE);
        $record = $CI->db->get()->result_array();
        $missing_contacts += $record[0]['count1'];
    }

    //------Missing Code---------
  //list of tables to collate from
    $tables_array = array("household"=>"res_prop_code","buisness_property"=>"buis_prop_code","buisness_occ"=>"buis_occ_code","residence"=>"res_code");
  $missing_code = 0;
    //loop through tables and get date, count from each
    foreach ($tables_array as $table => $tbl_column) {
        $CI->db->select('count(*) as count1');
        $CI->db->from($table);
        $CI->db->where("$tbl_column = NULL or $tbl_column = ''", NULL, FALSE);
        $record = $CI->db->get()->result_array();
        $missing_code += $record[0]['count1'];
    }

    $data_structure = '{"name": "Missing Location","y":'.$missing_location.'},{"name": "Missing Contacts","y":'.$missing_contacts.'},{"name": "Missing Code","y":'.$missing_code.'}';
    return $data_structure;

}

// get Weekly registration
function get_weekly_registration($start_date, $end_date){
    $CI = & get_instance();

    //get first day of start date
    $start_date = getfirstDayOfWeek($start_date);

    //list of tables to collate from
    $tables_array = array("household","signage","residence","buisness_property","buisness_occ","household_transport","businessocc_transport");
    $week_count_array = array();

    //loop through tables and get date, count from each
    foreach ($tables_array as $table) {
        if($table == "signage"){
            $CI->db->select('weekofyear(datetime_created) Wk, count(*) as count1');
            $CI->db->from($table);
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date(datetime_created) >=",$start_date);
                $CI->db->where("date(datetime_created) <=",$end_date);
            }
            $CI->db->group_by('1');
            $date_record = $CI->db->get()->result_array();
        }else{
            $CI->db->select('weekofyear(date_created) Wk, count(*) as count1');
            $CI->db->from($table);
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date(date_created) >=",$start_date);
                $CI->db->where("date(date_created) <=",$end_date);
            }
            $CI->db->group_by('1');
            $date_record = $CI->db->get()->result_array();
        }
        

        foreach($date_record as $a) {
             $date_wk_array_key = $a['Wk'];
            //check if week exists in $agent_count_array
            if (array_key_exists($date_wk_array_key,$week_count_array)){
                //add weeks's count to existing record
                $week_count_array[$date_wk_array_key]+=$a['count1'];
            } else {
                //insert date and count
                $week_count_array[$date_wk_array_key]=0;
                $week_count_array[$date_wk_array_key]+=$a['count1'];
            }
        }
    }

    //form data and x-axis data
    $data = "";
    $data_weeks = "";
    foreach ($week_count_array as $week_key => $week_count) {
        $week_date_range = getWeekStartAndEndDate($week_key, date('Y'));
        $data_weeks .= "'Week $week_key',";
        $data .= "{".'"name":'.'"'.$week_date_range['week_start'].'-'.$week_date_range['week_end'].'",'.'"y":'.$week_count.',color:"'.'#734b6d"'."},";
    }
    $data_structure = rtrim($data,',');
    $data_weeks = rtrim($data_weeks,',');
    return array($data_structure,$data_weeks);
}

//get first day of given week
function getfirstDayOfWeek($date){
    $begweek = (date('l', strtotime($date)) == 'Monday')?date('Y-m-d', strtotime($date)):date('Y-m-d',strtotime('last monday', strtotime($date)));
    return $begweek;
}

// get date range from week number
function getWeekStartAndEndDate($week, $year) {
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    $ret['week_start'] = $dto->format('d M');
    $dto->modify('+6 days');
    $ret['week_end'] = $dto->format('d M');
    return $ret;
}

//get last day of given week
function getlastDayOfWeek($date){
    $endweek = (date('l', strtotime($date)) == 'Sunday')?date('Y-m-d', strtotime($date)):date('Y-m-d',strtotime('Sunday', strtotime($date)));
    return $endweek;
}

//get week number of given date
function getWeekNumber($date){
    $date = new DateTime($date);
    $week = $date->format("W");
    return $week;
}

// get total registration
function get_total_registration($start_date, $end_date) {
    $CI = & get_instance();

    //list of tables to collate from
    $tables_array = array("13"=>"Residence Property","12"=>"Business Property","signage"=>"Signage","buisness_occ"=>"Business Occupants");

    $data = "";
    $data_registration_types = "";
    foreach ($tables_array as $table => $name) {
        if($table == "signage"){
            $CI->db->select('count(*) as count1');
            $CI->db->from($table);
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date(datetime_created) >=",$start_date);
                $CI->db->where("date(datetime_created) <=",$end_date);
            }
            $total = $CI->db->get()->result_array();

            $data_registration_types .= "'$name',";
            $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
        }else{
            
            if($table == 12 || $table == 13){
                $CI->db->select('count(*) as count1');
                $CI->db->from("buisness_property");
                $CI->db->where("category",$table);
                if(isset($start_date)&&isset($end_date)){
                    $CI->db->where("date(date_created) >=",$start_date);
                    $CI->db->where("date(date_created) <=",$end_date);
                }
                $total = $CI->db->get()->result_array();

                $data_registration_types .= "'$name',";
                $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
            }else{
                $CI->db->select('count(*) as count1');
                $CI->db->from($table);
                if(isset($start_date)&&isset($end_date)){
                    $CI->db->where("date(date_created) >=",$start_date);
                    $CI->db->where("date(date_created) <=",$end_date);
                }
                $total = $CI->db->get()->result_array();

                $data_registration_types .= "'$name',";
                $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
            }
            
        }
        
    }
    $data_structure = rtrim($data,',');
    return array($data_structure,$data_registration_types);

}

// get total registration YTD
function get_total_registration_ytd($start_date, $end_date) {
    $CI = & get_instance();

    //list of tables to collate from
    $tables_array = array("13"=>"Residence Property","12"=>"Business Property","signage"=>"Signage","buisness_occ"=>"Business Occupants");

    $data = "";
    $data_registration_types = "";
    foreach ($tables_array as $table => $name) {
        if($table == "signage"){
            $CI->db->select('count(*) as count1');
            $CI->db->from($table);
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date(datetime_created) >=",$start_date);
                $CI->db->where("date(datetime_created) <=",$end_date);
            }
            $total = $CI->db->get()->result_array();

            $data_registration_types .= "'$name',";
            $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
        }else{
            if($table == 12 || $table == 13){
                $CI->db->select('count(*) as count1');
                $CI->db->from("buisness_property");
                $CI->db->where("category",$table);
                if(isset($start_date)&&isset($end_date)){
                    $CI->db->where("date(date_created) >=",$start_date);
                    $CI->db->where("date(date_created) <=",$end_date);
                }
                $total = $CI->db->get()->result_array();

                $data_registration_types .= "'$name',";
                $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
            }else{
                $CI->db->select('count(*) as count1');
                $CI->db->from($table);
                if(isset($start_date)&&isset($end_date)){
                    $CI->db->where("date(date_created) >=",$start_date);
                    $CI->db->where("date(date_created) <=",$end_date);
                }
                $total = $CI->db->get()->result_array();

                $data_registration_types .= "'$name',";
                $data.="{".'"name":'.'"'.$name.'",'.'"y":'.$total[0]['count1'].',color:"#85a329"'."},";
            }
        }
    }
    $data_structure = rtrim($data,',');
    return array($data_structure,$data_registration_types);

}

//get registration status

function get_registration_status($start_date, $end_date){
    $CI = & get_instance();

    //list of tables to collate from(only residence and business property have status column)
    //$tables_array = array("residence","buisness_property");
    $tables_array = array("buisness_property");
    $reg_count_array = array(0,0);

    //loop through tables and get registration count from each
    foreach ($tables_array as $table) {
        $CI->db->select('status, count(*) as count1');
        $CI->db->from($table);
        if(isset($start_date)&&isset($end_date)){
            $CI->db->where("date(date_created) >=",$start_date);
            $CI->db->where("date(date_created) <=",$end_date);
        }
        $CI->db->group_by('1');
        $reg = $CI->db->get()->result_array();

        foreach($reg as $r) {
            //$agent_array_key: for agent_id and agent_code, also serve as a key in $agent_count_array(associative array)
            $reg_array_key = $r['status'];
            //check if status exists in $agent_count_array
            if (array_key_exists($reg_array_key,$reg_count_array)){
                //add agent's count to existing record
                $reg_count_array[$reg_array_key]+=$r['count1'];
            } else {
                //insert agent_id and count
                $reg_count_array[$reg_array_key]=$r['count1'];
            }
        }
    }


    $data_structure = '{"name": "Complete","y":'.$reg_count_array[1].'},{"name": "Incomplete","y":'.$reg_count_array[0].'}';
    return $data_structure;
}

// get Weekly top 5 registration
function get_top_weekly_registration($end_date){
    $CI = & get_instance();

    //get first day of date
    $start_date = getfirstDayOfWeek($end_date);

    //get last day of  date
//    $end_date = getlastDayOfWeek($end_date);

    //list of tables to collate from
    $tables_array = array("household","residence","signage","buisness_property","buisness_occ","household_transport","businessocc_transport");
    $agent_count_array = array();

    //loop through tables and get agent_id, count from each
    foreach ($tables_array as $table) {

        if($table == "signage"){
            $CI->db->select("created_id as agent_id, agent.agent_code, agent.firstname, agent.lastname, count(*) as count1");
            $CI->db->from($table);
            $CI->db->join('agent',$table.'.created_id = agent.id');
            $CI->db->where('created_by','agent');
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date($table.datetime_created) >=",$start_date);
                $CI->db->where("date($table.datetime_created) <=",$end_date);
            }
            $CI->db->group_by('1');

            $agent = $CI->db->get()->result_array();
        }else{
            $CI->db->select("agent_id, agent.agent_code, agent.firstname, agent.lastname, count(*) as count1");
            $CI->db->from($table);
            $CI->db->join('agent',$table.'.agent_id = agent.id');
            $CI->db->where('agent_category','agent');
            if(isset($start_date)&&isset($end_date)){
                $CI->db->where("date($table.date_created) >=",$start_date);
                $CI->db->where("date($table.date_created) <=",$end_date);
            }
            $CI->db->group_by('1');

            $agent = $CI->db->get()->result_array();
        }
        

        foreach($agent as $a) {
            //$agent_array_key: for agent_id and agent_code, also serve as a key in $agent_count_array(associative array)
            $agent_array_key = $a['firstname'].' '.$a['lastname'];

            //check if agent_id exists in $agent_count_array
            if (array_key_exists($agent_array_key,$agent_count_array)){
                //add agent's count to existing record
                $agent_count_array[$agent_array_key]+=$a['count1'];
            } else {
                //insert agent_id and count
                $agent_count_array[$agent_array_key]=$a['count1'];
            }
        }
    }



    //sort $agent_count_array from highest to lowest value
    arsort($agent_count_array);

    //color gradient for chart
    $colors = array('1c4a45','235c57','2a6f68','318179','38948b');
//    $colors = array('85a329','17a2b8','f4516c','85a329','17a2b8','f4516c','85a329','17a2b8','f4516c','85a329');

    //return top 5 agents
    $agent_count_array = array_slice($agent_count_array,0,5);

    //form data and x-axis data
    $data = "";
    $data_agent_names = "";
    $i = 0;
    foreach ($agent_count_array as $agent_name => $agent_count) {

        $data_agent_names .= "'$agent_name',";
        $data .= "{".'"name":'.'"'.$agent_name.'",'.'"y":'.$agent_count.',color:"'.'#'.$colors[$i].'"'."},";
        $i++;
    }

    $start_date_fmt = date_create($start_date);
    $start_date_fmt =  date_format($start_date_fmt,"D, d M");

    $end_date_fmt = date_create(getlastDayOfWeek($end_date));
    $end_date_fmt =  date_format($end_date_fmt,"D, d M");

    $week_no = getWeekNumber($start_date);

    $data_structure = rtrim($data,',');
    $data_agent_names = rtrim($data_agent_names,',');
    $title_text = "Wk ".$week_no.": ".$start_date_fmt." to ".$end_date_fmt;
    return array($data_structure,$data_agent_names,$title_text);
}

//get area residence status stat details

function get_area_residence_toilet_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(toilet_facility) as count,toilet_facility');
    $CI->db->from("residence");
    $CI->db->group_by('toilet_facility');
    $toilet_facility = $CI->db->get()->result_array();
    $correct_data = "";
    $data = "";
    foreach ($toilet_facility as $e) {
        $CI->db->select('id,name');
        $CI->db->from("area_council");
        $prof_data = $CI->db->get()->result_array();
        $d = '{"name":'.'"'.$e['toilet_facility'].'",'.'"id":"'.$e['toilet_facility'].'",'.'"data":[';
        $count = "";
        $data = "";
        foreach ($prof_data as $a) {
            $CI->db->select('*');
            $CI->db->from("residence as g");
            $CI->db->where("g.area_council",$a['id']);
            $CI->db->where("g.toilet_facility",$e['toilet_facility']);

            $count = $CI->db->get()->num_rows();
            $data .= "[".'"'.$a['name'].'",'.$count."],";
        }
        $data2 = rtrim($data,',');
        $correct_data .= $d.$data2."]},";
    }
    $data_structure = rtrim($correct_data,',');
    return $data_structure;
}


//get employment status stat details

function get_employment_status_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(employment_status) as count,employment_status');
    $CI->db->from("household");
    $CI->db->group_by('employment_status');
    $employment = $CI->db->get()->result_array();
    $data = "";
    foreach ($employment as $emp) {
        $data .= '{"name":"'.$emp["employment_status"].'","y":'.$emp['count'].',"drilldown":"'.$emp["employment_status"].'"},';
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get area employment status stat details

function get_area_employment_status_data(){
    $CI = & get_instance();
    $CI->db->select('COUNT(employment_status) as count,employment_status');
    $CI->db->from("household");
    $CI->db->group_by('employment_status');
    $employment = $CI->db->get()->result_array();
    $correct_data = "";
    $data = "";
    foreach ($employment as $e) {
        $CI->db->select('id,name');
        $CI->db->from("area_council");
        $prof_data = $CI->db->get()->result_array();
        $d = '{"name":'.'"'.$e['employment_status'].'",'.'"id":"'.$e['employment_status'].'",'.'"data":[';
        $count = "";
        $data = "";
        foreach ($prof_data as $a) {
            $CI->db->select('*');
            $CI->db->from("household as g");
            $CI->db->join('residence as q','q.res_code = g.res_prop_code');
            $CI->db->where("q.area_council",$a['id']);
            $CI->db->where("g.employment_status",$e['employment_status']);

            $count = $CI->db->get()->num_rows();
            $data .= "[".'"'.$a['name'].'",'.$count."],";
        }
        $data2 = rtrim($data,',');
        $correct_data .= $d.$data2."]},";
    }
    $data_structure = rtrim($correct_data,',');
    return $data_structure;
}

//get educational stat details

function get_educational_data(){
    $CI = & get_instance();
    $CI->db->select('e.level,COUNT(h.highest_edu) as count');
    $CI->db->from("household as h");
    $CI->db->join('education as e','e.id = h.highest_edu');
    $CI->db->group_by('h.highest_edu');
    $edu = $CI->db->get()->result_array();
    $data = "";

    foreach ($edu as $e) {

        $data .= "{".'"name":'.'"'.$e['level'].'",'.'"y":'.$e['count'].',"drilldown":'.'"'.$e['level'].'"'."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get top 5 community stat

function get_com_need_stats(){
    $CI = & get_instance();
    $CI->db->select('c.need,COUNT(h.need_id) as count');
    $CI->db->from("household_needs as h");
    $CI->db->join('community_needs as c','c.id = h.need_id');
    $CI->db->order_by('count','desc');
    $CI->db->limit(5);
    $CI->db->group_by('h.need_id');
    $stat = $CI->db->get()->result_array();
    $data = "";
    foreach ($stat as $s) {

        $data .= "{".'"name":'.'"'.$s['need'].'",'.'"y":'.$s['count']."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get top 5 community stat

function get_com_need_statss(){
    $CI = & get_instance();
    $CI->db->select('c.need,COUNT(h.need_id) as count');
    $CI->db->from("household_needs as h");
    $CI->db->join('community_needs as c','c.id = h.need_id');
    $CI->db->order_by('count','desc');
    $CI->db->limit(5);
    $CI->db->group_by('h.need_id');
    $stat = $CI->db->get()->result_array();
    $data = "";
    foreach ($stat as $s) {

        $data .= "{".'"name":'.'"'.$s['need'].'",'.'"y":'.$s['count']."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get top 5 community in an area council stat

function get_com_need_area_stats($id){
    $CI = & get_instance();
    $CI->db->select('c.need,COUNT(h.need_id) as count');
    $CI->db->from("household_needs as h");
    $CI->db->join('community_needs as c','c.id = h.need_id');
    $CI->db->join('household as a','a.id = h.household_id');
    $CI->db->join('residence as q','q.res_code = a.res_prop_code');
    $CI->db->where("q.area_council",$id);
    $CI->db->order_by('count','desc');
    $CI->db->limit(5);
    $CI->db->group_by('h.need_id');
    $stat = $CI->db->get()->result_array();
    $data = "";
    foreach ($stat as $s) {

        $data .= "{".'"name":'.'"'.$s['need'].'",'.'"y":'.$s['count']."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

//get top 5 community in an town stat

function get_com_need_town_stats($id){
    $CI = & get_instance();
    $CI->db->select('c.need,COUNT(h.need_id) as count');
    $CI->db->from("household_needs as h");
    $CI->db->join('community_needs as c','c.id = h.need_id');
    $CI->db->join('household as a','a.id = h.household_id');
    $CI->db->join('residence as q','q.res_code = a.res_prop_code');
    $CI->db->where("q.town",$id);
    $CI->db->order_by('count','desc');
    $CI->db->limit(5);
    $CI->db->group_by('h.need_id');
    $stat = $CI->db->get()->result_array();
    $data = "";
    foreach ($stat as $s) {

        $data .= "{".'"name":'.'"'.$s['need'].'",'.'"y":'.$s['count']."},";
    }
    $data_structure = rtrim($data,',');
    return $data_structure;
}

// business owner details

function business_owner_details($id){
    $CI = & get_instance();
    $CI->db->select('p.*');
    $CI->db->from("property_owner as p");
    $CI->db->join('buis_prop_to_owner as r','p.id = r.owner_id');
    $CI->db->where('property_id',$id);
    $query = $CI->db->get()->row_array();

    return $query;
}

// business owner details

function business_occ_owner_details($id){
    $CI = & get_instance();
    $CI->db->select('p.*');
    $CI->db->from("property_owner as p");
    $CI->db->join('buis_occ_to_owner as r','p.id = r.owner_id');
    $CI->db->where('property_id',$id);
    $query = $CI->db->get()->row_array();

    return $query;
}

//get residence registration status stats

function get_reg_stats($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $where = array('status' => 1,'agent_id' => $agent_id,"agent_category" => "agent");
    $CI->db->where($where);
    $busprop_complete = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $where = array('status' => 0,'agent_id' => $agent_id,"agent_category" => "agent");
    $CI->db->where($where);
    $busprop_incomplete = $CI->db->get()->num_rows();

    $complete = $busprop_complete;
    $incomplete = $busprop_incomplete;
    $data_structure = '{"name": "Complete","y":'.$complete.'},{"name": "Incomplete","y":'.$incomplete.'}';
    return $data_structure;
}

function get_busprop_reg_stats($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $where = array('status' => 1,'agent_id' => $agent_id );
    $CI->db->where($where);
    $complete = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $where = array('status' => 0,'agent_id' => $agent_id );
    $CI->db->where($where);
    $incomplete = $CI->db->get()->num_rows();
    $data_structure = '{"name": "Complete","y":'.$complete.'},{"name": "Incomplete","y":'.$incomplete.'}';
    return $data_structure;
}

// agents residence count
function get_agent_residence_count($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("residence");
    $CI->db->where("agent_id",$agent_id);
    return $residence = $CI->db->get()->num_rows();
}

// agent household count
function get_agent_household_count($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household");
    $CI->db->where("agent_id",$agent_id);
    return $household = $CI->db->get()->num_rows();
}

// agent business property count
function get_agent_busprop_count($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("buisness_property");
    $CI->db->where("agent_id",$agent_id);
    return $buis_property = $CI->db->get()->num_rows();
}

//agent business occupants
function get_agent_busocc_count($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("buisness_occ");
    $CI->db->where("agent_id",$agent_id);
    return $buis_occ = $CI->db->get()->num_rows();
}

//agent transport count
function get_agent_transport_count($agent_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("businessocc_transport");
    $CI->db->where("agent_id",$agent_id);
    $buis_transport = $CI->db->get()->num_rows();

    $CI->db->select('*');
    $CI->db->from("household_transport");
    $CI->db->where("agent_id",$agent_id);
    $household_transport = $CI->db->get()->num_rows();

    return $transport = $buis_transport + $household_transport;
}


//get product name from product id
function get_product_name($product_id){
    $CI = & get_instance();
    $CI->db->select('name');
    $CI->db->from("revenue_product");
    $CI->db->where('id',$product_id);
    $query = $CI->db->get()->result_array();
    return $query[0]['name'];
}

//get category name from category id and level
function get_category_name($subcat_id, $subcat_level){
    $CI = & get_instance();
    $CI->db->select('name');
    $CI->db->from("product_category".$subcat_level);
    $CI->db->where('id',$subcat_id);
    $query = $CI->db->get()->result_array();
    return $query[0]['name'];
}

function formatPhonenumber($rawPhoneNumber) {
    $cond = (strlen($rawPhoneNumber) > 10 && substr($rawPhoneNumber, 0, 3) == '233');
    $formattedNumber = $cond ? $rawPhoneNumber : '233' . substr($rawPhoneNumber, 1, strlen($rawPhoneNumber));
    return $formattedNumber;
}

// Revenue COllections Code

function get_total_revenue()
{
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}

function get_total_revenue_yearly()
{
    $CI = &get_instance();

    $tables_array = array("year_transaction" => "Year Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("SELECT i.invoice_year as year,sum(i.invoice_amount) as total_amount from vw_invoice i left join transaction r on r.invoice_id = i.id group by i.invoice_year")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['year'] . '",' . '"y":' . intval($pd['total_amount']) . ',"drilldown":' . '"' . $pd['year'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;

    // foreach ($tables_array as $table => $name) {
    //     $CI->db->select('sum(amount) as count1');
    //     $CI->db->from($table);
    //     $total = $CI->db->get()->result_array();
    //     $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    // }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}


function get_revenue_drill()
{
    $CI = &get_instance();

    $tables_array = array("vw_invoice" => "Collections");
    $data = "";
    // $name = "Invoice";
    $series = [];

    foreach ($tables_array as $table => $name) {
        //     $CI->db->select('count(*) as count1');
        $d = new stdClass;
        $d->name = $name;
        $d->id = $name;
        $d->data = [];
        $prof_data = $CI->db->query("select sum(t1.pc) as area_sum, t2.area from (select sum(b.amount) pc, b.id from transaction b group by b.id) t1 left join (select r.id, a.name as area from vw_invoice r, area_council a where r.area_council_id = a.id group by 1,2) t2 on t1.id = t2.id group by 2")->result_array();
        foreach ($prof_data as $pd) {
            if ($name == $d->name) {
                array_push($d->data, [$pd['area'], intval($pd['area_sum'])]);
            }
        }
        // $d->data = $total;
        array_push($series, $d);

    }
    return json_encode($series);
}



function get_revenue_year_drill()
{
    set_time_limit(0);
    $CI = &get_instance();

    $tables_array = array("transactions" => "2020","vw_invoice"=>"2019");
    $data = "";
    // $name = "Invoice";
    $series = [];

    foreach ($tables_array as $table => $name) {
        //     $CI->db->select('count(*) as count1');
        $d = new stdClass;
        $d->name = $name;
        $d->id = $name;
        $d->data = [];
        $prof_data = $CI->db->query("SELECT i.invoice_year as years,c.name as area_council,sum(i.invoice_amount) as total_amount from vw_invoice i left join transaction r on r.invoice_id = i.id left join area_council c on c.id = i.area_council_id group by c.name,i.invoice_year")->result_array();
        foreach ($prof_data as $pd) {
            // if ($d->name = $pd['years']) {
                array_push($d->data, [$pd['area_council'],intval($pd['total_amount'])]);
            // }
        }
        // $d->data = $total;
        array_push($series, $d);

    }
    return json_encode($series);
}


function get_daily_revenue()
{
    
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created)", date("Y-m-d"));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}


function get_week_revenue()
{
    $CI = &get_instance();

    $monday = strtotime("last monday");
    $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;


    $start_date = date("Y-m-d", $monday);

    // $CI->db->select('count(*)');
    // $CI->db->from("transaction");
    // $CI->db->where("date(datetime_created) >=", $start_date);
    // $CI->db->where("date(datetime_created) <=", date('Y-m-d'));
    // $total = $CI->db->get()->result_array();


    // $data_structure = rtrim($total, ',');
    // return $data_structure;

    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created) >=", $start_date);
        $CI->db->where("date(datetime_created) <=", date('Y-m-d'));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}

function get_lastweek_revenue()
{
    $CI = &get_instance();


    $start_date = date('Y-m-d', strtotime("-1 week"));

    // $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created) >=", $start_date);
        $CI->db->where("date(datetime_created) <=", date("Y-m-d"));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function get_month_revenue()
{
    $CI = &get_instance();


    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created) >=", date('Y-m-d', strtotime("-1 month")));
        $CI->db->where("date(datetime_created) <=", date("Y-m-d"));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
   
}

function get_lastmonth_revenue()
{
    $CI = &get_instance();


    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created)", date('Y-m-d', strtotime("-1 month")));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . (empty($total[0]['count1'])) ? 0 : $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}

function get_last_3_month_revenue()
{
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created)", date('Y-m-d', strtotime("-3 month")));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . (empty($total[0]['count1'])) ? 0 : $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function get_last_6_month_revenue()
{
    $CI = &get_instance();

    // $CI = &get_instance();


    $tables_array = array("transaction" => "Collections");
    $data = "";

    foreach ($tables_array as $table => $name) {
        $CI->db->select('sum(amount) as count1');
        $CI->db->from($table);
        $CI->db->where("date(datetime_created)", date('Y-m-d', strtotime("-6 month")));
        $total = $CI->db->get()->result_array();
        $data .= "{" . '"name":' . '"' . $name . '",' . '"y":' . (empty($total[0]['count1'])) ? 0 : $total[0]['count1'] . ',"drilldown":' . '"' . $name . '"' . "},";
    }


    $data_structure = rtrim($data, ',');
    return $data_structure;

}


// Collectors


function get_collectors_total_revenue()
{
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $data = "";

    // foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";

        }


    // }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
}


function get_collectors_daily_revenue()
{

    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "date(transaction.datetime_created) = date('Y-m-d')";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";

        }


    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}


function get_collectors_week_revenue()
{
    
    $monday = strtotime("last monday");
    $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
    $start_date = date("Y-m-d", $monday);

    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "date(transaction.datetime_created) >= '$start_date' AND date(transaction.datetime_created) <= date('Y-m-d')";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";

        }


    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

function get_collectors_lastweek_revenue()
{
      
    $start_date = date('Y-m-d', strtotime("-1 week"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "transaction.datetime_created = '$start_date'";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

function get_collectors_month_revenue()
{

    
    $start_date = date('Y-m-d', strtotime("-1 month"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "transaction.datetime_created = '$start_date'";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function get_collectors_lastmonth_revenue()
{

 
    $start_date = date('Y-m-d', strtotime("-1 month"));

    $end_date = date('Y-m-d');
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "transaction.datetime_created = '$start_date'";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function get_collectors_last_3_month_revenue()
{

     
    $start_date = date('Y-m-d', strtotime("-3 month"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "datetime_created = '$start_date'";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, concat(users.firstname,' ', users.lastname) as agents from transaction join users on users.id = transaction.created_by where $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

function get_collectors_last_6_month_revenue()
{
     
    $start_date = date('Y-m-d', strtotime("-6 month"));

    $end_date = date('Y-m-d');
    $CI = &get_instance();

    $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "AND datetime_created = '$start_date'";

    $data = "";

    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("select sum(amount) as amount, users.firstname as agents from transaction join users on users.id =  transaction.created_by where collected_by = 'agent' $where group by created_by")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    }
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

// Revenue_streams


function collections_revenue_streams()
{
    $CI = &get_instance();

    // $tables_array = array("vw_invoice" => "Revenue Streams Collections");
    $data = "";
    
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join revenue_product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['bop'] . '",' . '"y":' . intval($pd['total_amount']) . ',"drilldown":' . '"Revenue Streams"' . "},";

        }




    $data_structure = rtrim($data, ',');
    return $data_structure;
}


function get_revenue_streams_drill()
{
    $CI = &get_instance();

    $tables_array = array("vw_invoice" => "Revenue Streams");
    $data = "";
    // $name = "Invoice";
    $series = [];
    set_time_limit(0);

    foreach ($tables_array as $table => $name) {
        //     $CI->db->select('count(*) as count1');
        $d = new stdClass;
        $d->name = $name;
        $d->id = $name;
        $d->data = [];
        $prof_data = $CI->db->query("SELECT b.name as business_property,c.name as areas,sum(r.amount) as total_amount from vw_invoice i left join area_council c on i.area_council_id = c.id left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id group by b.name,c.name")->result_array();
        foreach ($prof_data as $pd) {
            if ($name == $d->name) {
                array_push($d->data, [$pd['areas'],intval($pd['total_amount'])]);
            }
        }
        // $d->data = $total;
        array_push($series, $d);

    }
    return json_encode($series);
}

function streams_daily_revenue()
{

    $start_date = date('Y-m-d');

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
    
}


function streams_week_revenue()
{
 
    $monday = strtotime("last monday");
    $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
    $start_date = date("Y-m-d", $monday);

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function streams_chart_past_seven_days()
{
      
    $start_date = date('Y-m-d', strtotime("-1 week"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

function streams_month_current_revenue()
{
    $start_date = date('Y-m-d', strtotime("-1 month"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}

function streams_lastmonth_revenue()
{

 $start_date = date('Y-m-d', strtotime("-1 month"));

    $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;

}

function streams_last_3_month_revenue()
{

     
    $start_date = date('Y-m-d', strtotime("-3 month"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
}

function streams_last_6_month_revenue()
{
     
    $start_date = date('Y-m-d', strtotime("-6 month"));

    // $end_date = date('Y-m-d');
    $CI = &get_instance();

    // $tables_array = array("transaction" => "Collections");
   
    $series = [];

    $where = "r.datetime_created = '$start_date'";

    $data = "";

      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product b on i.product_id = b.id left join transaction r on r.invoice_id = i.id where $where group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['agents'] . '",' . '"y":' . intval($pd['amount']) . ',"drilldown":' . '"' . $pd['agents'] . '"' . "},";
        }

    
    
    $data_structure = rtrim($data, ',');
    return $data_structure;
  
}






function collections_revenue_bop()
{
    $CI = &get_instance();

    $tables_array = array("vw_invoice" => "Collections Per Business Type");
    $data = "";
    // $where2 = array(
    //     // "created_id" => $agent_id,
    //     "name" => "BOP"
    // );
    foreach ($tables_array as $table => $name) {
      
        $prof_data = $CI->db->query("SELECT b.name as bop,sum(r.amount) as total_amount from invoice i left join product_category1 b on i.category1_id = b.id left join transaction r on r.invoice_id = i.id group by b.name")->result_array();
        foreach ($prof_data as $pd) {
            $data .= "{" . '"name":' . '"' . $pd['bop'] . '",' . '"y":' . intval($pd['total_amount']) . ',"drilldown":' . '"' . $pd['bop'] . '"' . "},";

        }


    }


    $data_structure = rtrim($data, ',');
    return $data_structure;
}
