<?php

// get number of males and females in an area council		
function gender_area_council($gender,$id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as h");
    $CI->db->where("r.area_council",$id);
    $CI->db->where("h.gender",$gender);
    $CI->db->join('residence as r','r.res_code = h.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get sum of males and females		
function sum_gender_area_council($gender){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household");
    $CI->db->where("gender",$gender);
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in a town		
function gender_town($gender,$id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as h");
    $CI->db->where("r.town",$id);
    $CI->db->where("h.gender",$gender);
    $CI->db->join('residence as r','r.res_code = h.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function employment_area_council($status,$id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->join('residence as q','q.res_code = g.res_prop_code');
    $CI->db->where("q.area_council",$id);
    $CI->db->where("g.employment_status",$status);
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function sum_employment_area_council($status){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("g.employment_status",$status);
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function sum_educational_level($id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("g.highest_edu",$id);
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function sum_profession_level($id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("g.profession",$id);
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function educational_area_council($id,$edu_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("r.area_council",$id);
    $CI->db->where("g.highest_edu",$edu_id);
    $CI->db->join('residence as r','r.res_code = g.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function profession_area_council($id,$prof_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("r.area_council",$id);
    $CI->db->where("g.profession",$prof_id);
    $CI->db->join('residence as r','r.res_code = g.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function educational_town($id,$edu_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("r.town",$id);
    $CI->db->where("g.highest_edu",$edu_id);
    $CI->db->join('residence as r','r.res_code = g.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function profession_town($id,$prof_id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as g");
    $CI->db->where("r.town",$id);
    $CI->db->where("g.profession",$prof_id);
    $CI->db->join('residence as r','r.res_code = g.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in a town		
function employment_town($employment,$id){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from("household as h");
    $CI->db->where("r.town",$id);
    $CI->db->where("h.employment_status",$employment);
    $CI->db->join('residence as r','r.res_code = h.res_prop_code');
    return $count = $CI->db->get()->num_rows();
}

// get number of males and females in an area council		
function data_area_council($data,$id){
    $CI = & get_instance();

    if($data == "Household"){
    	$CI->db->select('*');
        $CI->db->from("household as h");
        $CI->db->where("r.area_council",$id);
        $CI->db->join('residence as r','r.res_code = h.res_prop_code');
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Residence"){
        $where = array(
            "area_council" => $id,
            "category" => 13
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Business Property"){
        $where = array(
            "area_council" => $id,
            "category" => 12
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Business Occupants"){
    	$CI->db->select('*');
        $CI->db->from("buisness_occ as h");
        $CI->db->where("r.area_council",$id);
        $CI->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
        return $count = $CI->db->get()->num_rows();
    }
}

// get number of males and females in an area council		
function data_town($data,$id){
    $CI = & get_instance();

    if($data == "Household"){
    	$CI->db->select('*');
        $CI->db->from("household as h");
        $CI->db->where("r.town",$id);
        $CI->db->join('residence as r','r.res_code = h.res_prop_code');
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Residence"){
        $where = array(
            "town" => $id,
            "category" => 13
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Business Property"){
        $where = array(
            "town" => $id,
            "category" => 12
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($data == "Business Occupants"){
    	$CI->db->select('*');
        $CI->db->from("buisness_occ as h");
        $CI->db->where("r.town",$id);
        $CI->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
        return $count = $CI->db->get()->num_rows();
    }
}

// get data in an area council		
function sum_data_area_council($status){
    $CI = & get_instance();
    
    if($status == "Household"){
    	$CI->db->select('*');
        $CI->db->from("household as h");
        $CI->db->join('residence as r','r.res_code = h.res_prop_code');
        return $count = $CI->db->get()->num_rows();

    }elseif($status == "Residence"){
        $where = array(
            "category" => 13
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($status == "Business Property"){
        $where = array(
            "category" => 12
        );
    	$CI->db->select('*');
        $CI->db->from("buisness_property");
        $CI->db->where($where);
        return $count = $CI->db->get()->num_rows();

    }elseif($status == "Business Occupants"){
    	$CI->db->select('*');
        $CI->db->from("buisness_occ as h");
        $CI->db->join('buisness_property as r','r.buis_prop_code = h.buis_property_code');
        return $count = $CI->db->get()->num_rows();
    }
}
?>