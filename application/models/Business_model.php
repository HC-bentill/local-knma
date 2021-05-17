<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business_model extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();
    }

    //	get business and display on the business page
    public function get_business($last_date)
    {
        $agency = $this->db->query(
            "SELECT buisness_property.buis_prop_code,buisness_property.id,".
            "buisness_property.accessed,po.firstname,po.lastname,".
            "po.primary_contact,po.email,buisness_property.status,". 
            "t.town as tt, a.name as area FROM buisness_property ". 
            "left join town t on buisness_property.town = t.id left join ". 
            "area_council a on buisness_property.area_council = a.id left join ". 
            "buis_prop_to_owner as bpo on buisness_property.id = bpo.property_id". 
            " left join property_owner as po on bpo.owner_id = po.id WHERE ". 
            "date(buisness_property.date_created) = '$last_date' order by id asc"
        )->result();
        return ($agency);
    }

    //	get business property and display on the business property page
    public function search_business_property($search_by, $start_date, $end_date, $search_item, $search_option)
    {
        $search_item2 = strtolower($search_item);
        $data = [];
        if ($search_by == "Date") {
            if ($end_date == "") {
                $query = $this->db->query(
                    "SELECT buisness_property.buis_prop_code,".
                    "buisness_property.id,po.firstname,po.lastname,".
                    "po.primary_contact,po.email,buisness_property.status,".
                    "buisness_property.accessed,t.town as tt, a.name as area ".
                    "FROM buisness_property left join town t on ". 
                    "buisness_property.town = t.id left join area_council a on ".
                    "buisness_property.area_council = a.id left join ".
                    "buis_prop_to_owner as bpo on buisness_property.id = ". 
                    "bpo.property_id left join property_owner as po on ".
                    "bpo.owner_id = po.id WHERE date(buisness_property.date_created) =".
                    " '$start_date' order by id asc"
                );

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            } else {
                $query = $this->db->query(
                    "SELECT buisness_property.buis_prop_code,".
                    "buisness_property.id,po.firstname,po.lastname,".
                    "po.primary_contact,po.email,buisness_property.status,".
                    "buisness_property.accessed,t.town as tt, a.name as area ".
                    "FROM buisness_property left join town t on ". 
                    "buisness_property.town = t.id left join area_council a on ".
                    "buisness_property.area_council = a.id left join ".
                    "buis_prop_to_owner as bpo on buisness_property.id = ".
                    "bpo.property_id left join property_owner as po on ". 
                    "bpo.owner_id = po.id WHERE date(buisness_property.date_created) ".
                    "BETWEEN '$start_date' AND '$end_date' order by id asc"
                );

                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            }
        } else {
            $this->db->select(
                "buisness_property.buis_prop_code,buisness_property.id,". 
                "po.firstname,po.lastname, po.primary_contact,po.email,".
                "buisness_property.status,buisness_property.accessed,t.town ".
                "as tt, a.name as area"
            );
            $this->db->from('buisness_property');
            $this->db->join('town as t', 'buisness_property.town = t.id', 'left');
            $this->db->join('area_council as a', 'buisness_property.area_council = a.id', 'left');
            $this->db->join('buis_prop_to_owner as bpo', 'buisness_property.id = bpo.property_id', 'left');
            $this->db->join('property_owner as po', 'bpo.owner_id = po.id', 'left');
            if ($search_option == "busprop_code") {
                $this->db->like(
                    'lower(buisness_property.buis_prop_code)', $search_item2);
            }
            if ($search_option == "owner_firstname") {
                $this->db->or_like('lower(po.firstname)', $search_item2);
            }
            if ($search_option == "owner_lastname") {
                $this->db->or_like('lower(po.lastname)', $search_item2);
            }
            if ($search_option == "owner_fullname") {
                $this->db->or_like(
                    'lower(concat(po.firstname, " ", po.lastname))',
                    $search_item2
                );
            }
            if ($search_option == "owner_pc") {
                $this->db->or_like('lower(po.primary_contact)', $search_item2);
            }
            
            if ($search_option == "owner_sc") {
                $this->db->or_like(
                    'lower(po.secondary_contact)', $search_item2);
            }
            if ($search_option == "owner_email") {
                $this->db->or_like('lower(po.email)', $search_item2);
            }
            $data = $this->db->get()->result();
        }

        return $data;
    }


    //	get business occupant and display on the business occupant page
    public function search_business_occ($search_by, $start_date, $end_date, $search_item, $search_option)
    {
        $search_item2 = strtolower($search_item);
        $data = [];
        if ($search_by == "Date") {
            if ($end_date == "") {
                $this->db->select(
                    "b.id,b.buis_occ_code,b.buis_name,b.buis_primary_phone,". 
                    "b.buis_email,po.firstname,po.lastname,po.primary_contact,".
                    "po.email"
                );
                $this->db->from("buisness_occ as b");
                $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
                $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
                $this->db->where("date(b.date_created) = '$start_date'");
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            } else {
                $this->db->select(
                    "b.id,b.buis_occ_code,b.buis_name,b.buis_primary_phone,".
                    "b.buis_email,po.firstname,po.lastname,po.primary_contact,".
                    "po.email"
                );
                $this->db->from("buisness_occ as b");
                $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
                $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
                $this->db->where("date(b.date_created) BETWEEN '$start_date' AND '$end_date'");
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
                "b.id,b.buis_occ_code,b.buis_name,b.buis_primary_phone,".
                "b.buis_email,po.firstname,po.lastname,po.primary_contact,".
                "po.email"
            );
            $this->db->from("buisness_occ as b");
            $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
            $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
            if ($search_option == "bus_code") {
                $this->db->like('lower(b.buis_occ_code)', $search_item2);
            }
            if ($search_option == "bus_name") {
                $this->db->or_like('lower(b.buis_name)', $search_item2);
            }
            if ($search_option == "bus_pc") {
                $this->db->or_like(
                    'lower(b.buis_primary_phone)', $search_item2);
            }
            if ($search_option == "bus_sc") {
                $this->db->or_like(
                    'lower(b.buis_secondary_phone)', $search_item2);
            }
            if ($search_option == "bus_email") {
                $this->db->or_like('lower(b.buis_email)', $search_item2);
            }
            if ($search_option == "bus_website") {
                $this->db->or_like('lower(b.buis_website)', $search_item2);
            }
            if ($search_option == "busprop_code") {
                $this->db->or_like(
                    'lower(b.buis_property_code)', $search_item2);
            }
            if ($search_option == "owner_firstname") {
                $this->db->or_like('lower(po.firstname)', $search_item2);
            }
            if ($search_option == "owner_lastname") {
                $this->db->or_like('lower(po.lastname)', $search_item2);
            }
            if ($search_option == "owner_fullname") {
                $this->db->or_like(
                    'lower(concat(po.firstname, " ", po.lastname))',
                    $search_item2
                );
            }
            if ($search_option == "owner_pc") {
                $this->db->or_like('lower(po.primary_contact)', $search_item2);
            }
            if ($search_option == "owner_sc") {
                $this->db->or_like(
                    'lower(po.secondary_contact)', $search_item2);
            }
            if ($search_option == "owner_email") {
                $this->db->or_like('lower(po.email)', $search_item2);
            }
            $data = $this->db->get()->result();
        }

        return $data;
    }

    //	get business occupant and display on the business occupant page
    public function search_business_occ_category(
        $search_by, $start_date, $end_date, $search_item)
    {
        $search_item2 = strtolower($search_item);
        $data = [];
        if ($search_by == "Date") {
            if ($end_date == "") {
                $this->db->select(
                    "b.id,b.buis_occ_code,b.buis_name,c.name as category1,".
                    "d.name as category2,e.name as category3,".
                    "f.name as category4,g.name as category5,".
                    "h.name as category6"
                );
                $this->db->from("buisness_occ as b");
                $this->db->join(
                    'busocc_to_category as a', 'b.id = a.busocc_id', 'left');
                $this->db->join(
                    'product_category1 as c', 'c.id = a.category1', 'left');
                $this->db->join(
                    'product_category2 as d', 'd.id = a.category2', 'left');
                $this->db->join(
                    'product_category3 as e', 'e.id = a.category3', 'left');
                $this->db->join(
                    'product_category4 as f', 'f.id = a.category4', 'left');
                $this->db->join(
                    'product_category5 as g', 'g.id = a.category5', 'left');
                $this->db->join(
                    'product_category6 as h', 'h.id = a.category6', 'left');
                $this->db->where("date(date_created) = '$start_date'");
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $data = $query->result();
                    $query->free_result();
                } else {
                    $data = $query->result();
                }
            } else {
                $this->db->select(
                    "b.id,b.buis_occ_code,b.buis_name,c.name as category1,".
                    "d.name as category2,e.name as category3,".
                    "f.name as category4,g.name as category5,".
                    "h.name as category6"
                );
                $this->db->from("buisness_occ as b");
                $this->db->join(
                    'busocc_to_category as a', 'b.id = a.busocc_id', 'left');
                $this->db->join(
                    'product_category1 as c', 'c.id = a.category1', 'left');
                $this->db->join(
                    'product_category2 as d', 'd.id = a.category2', 'left');
                $this->db->join(
                    'product_category3 as e', 'e.id = a.category3', 'left');
                $this->db->join(
                    'product_category4 as f', 'f.id = a.category4', 'left');
                $this->db->join(
                    'product_category5 as g', 'g.id = a.category5', 'left');
                $this->db->join(
                    'product_category6 as h', 'h.id = a.category6', 'left');
                $this->db->where(
                    "date(date_created) BETWEEN '$start_date' AND '$end_date'");
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
                "b.id,b.buis_occ_code,b.buis_name,c.name as category1,
                d.name as category2,e.name as category3,f.name as category4,
                g.name as category5,h.name as category6"
            );
            $this->db->from("buisness_occ as b");
            $this->db->join(
                'busocc_to_category as a', 'b.id = a.busocc_id', 'left');
            $this->db->join(
                'product_category1 as c', 'c.id = a.category1', 'left');
            $this->db->join(
                'product_category2 as d', 'd.id = a.category2', 'left');
            $this->db->join(
                'product_category3 as e', 'e.id = a.category3', 'left');
            $this->db->join(
                'product_category4 as f', 'f.id = a.category4', 'left');
            $this->db->join(
                'product_category5 as g', 'g.id = a.category5', 'left');
            $this->db->join(
                'product_category6 as h', 'h.id = a.category6', 'left');
            $this->db->like('lower(buis_occ_code)', $search_item2);
            $this->db->or_like('lower(buis_name)', $search_item2);
            $this->db->or_like('lower(buis_primary_phone)', $search_item2);
            $this->db->or_like('lower(buis_secondary_phone)', $search_item2);
            $this->db->or_like('lower(buis_email)', $search_item2);
            $this->db->or_like('lower(buis_website)', $search_item2);
            $this->db->or_like('lower(buis_property_code)', $search_item2);
            $data = $this->db->get()->result();
        }

        return $data;
    }

    // get last date from business table
    public function get_date()
    {
        $this->db->select('date(date_created) as date1');
        $this->db->from("buisness_property");
        $this->db->order_by("id", 'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

    // get last date from business occupant table
    public function get_busocc_date()
    {
        $this->db->select('date(date_created) as date1');
        $this->db->from("buisness_occ");
        $this->db->order_by("id", 'desc');
        $this->db->limit(1);
        return $this->db->get()->row_array()['date1'];
    }

    //	get residence and display on the residence page
    public function get_business_occ($last_date)
    {
        $this->db->select(
            "b.id,b.buis_occ_code,b.buis_name,b.buis_primary_phone,b.buis_email,
            po.firstname,po.lastname, po.primary_contact,po.email"
        );
        $this->db->from("buisness_occ as b");
        $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
        $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
        $this->db->where("date(b.date_created) = '$last_date'");
        return $this->db->get()->result();
    }

    //	get residence and display on the residence page
    public function get_business_occ_category($last_date)
    {
        $this->db->select(
            "b.id,b.buis_occ_code,b.buis_name,c.name as category1,".
            "d.name as category2,e.name as category3,f.name as category4,".
            "g.name as category5,h.name as category6"
        );
        $this->db->from("buisness_occ as b");
        $this->db->join(
            'busocc_to_category as a', 'b.id = a.busocc_id', 'left');
        $this->db->join('product_category1 as c', 'c.id = a.category1', 'left');
        $this->db->join('product_category2 as d', 'd.id = a.category2', 'left');
        $this->db->join('product_category3 as e', 'e.id = a.category3', 'left');
        $this->db->join('product_category4 as f', 'f.id = a.category4', 'left');
        $this->db->join('product_category5 as g', 'g.id = a.category5', 'left');
        $this->db->join('product_category6 as h', 'h.id = a.category6', 'left');
        $this->db->where("date(date_created) = '$last_date'");
        return $this->db->get()->result();
    }

    //	get residence and display on the residence page
    public function get_business_occ_categories($id)
    {
        $this->db->select(
            "a.id,c.id as cat1,d.id as cat2,e.id as cat3,f.id as cat4,".
            "g.id as cat5,h.id as cat6,c.name as category1,".
            "d.name as category2,e.name as category3,f.name as category4,".
            "g.name as category5,h.name as category6"
        );
        $this->db->from("busocc_to_category as a");
        $this->db->join('product_category1 as c', 'c.id = a.category1', 'left');
        $this->db->join('product_category2 as d', 'd.id = a.category2', 'left');
        $this->db->join('product_category3 as e', 'e.id = a.category3', 'left');
        $this->db->join('product_category4 as f', 'f.id = a.category4', 'left');
        $this->db->join('product_category5 as g', 'g.id = a.category5', 'left');
        $this->db->join('product_category6 as h', 'h.id = a.category6', 'left');
        $this->db->where("busocc_id", $id);
        return $this->db->get()->result();
    }

    //	get businesss household and display on the view business page
    public function get_business_prop_occ($rescode)
    {
        $this->db->select(
            "id,buis_occ_code,buis_name,buis_primary_phone,buis_email");
        $this->db->from("buisness_occ");
        $this->db->where('buis_property_code', $rescode);
        return $this->db->get()->result();;
    }

    //	add business
    public function add_business($data)
    {
        $insert = $this->db->insert('buisness_property', $data);
        return $this->db->insert_id();
    }

    //	add business
    public function add_business_occ_category($category)
    {
        $insert = $this->db->insert('busocc_to_category', $category);
        return $this->db->insert_id();
    }

    //	get sectors in selected property category on add business occupants...
    public function get_sectors($postdata)
    {
        $this->db->select('id,name');
        $this->db->from('buis_sector');
        $this->db->where('prop_cat', $postdata['prop_cat']);
        return $this->db->get()->result();
    }

    //	get community needs and display on the add property form.
	public function get_community_needs()
	{
		$this->db->select('id,need');
		$this->db->from('community_needs');
		return $this->db->get()->result();
    }
    
    //	add community needs
	public function add_community_needs($data)
	{
		$this->db->trans_begin();
		$insert = $this->db->insert('property_needs', $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
			return $this->db->insert_id();
		}
    }
    
    //	get community needs 
	public function get_property_needs($id)
	{
		$this->db->select('id,need_id');
		$this->db->from('property_needs');
		$this->db->where('property_id', $id);
		return $this->db->get()->result();
    }
    
    // delete property needs
	public function delete_property_need($id)
	{

		$this->db->where('property_id', $id);
		return $this->db->delete('property_needs');
	}

    //	get property type in selected business occupants on add business occupants...
    public function get_prop_type($postdata)
    {
        $this->db->select('id,name');
        $this->db->from('property_type');
        $this->db->where('sector', $postdata['buis_sector']);
        return $this->db->get()->result();
    }

    //	add business occupants
    public function add_business_occ($data)
    {
        $insert = $this->db->insert('buisness_occ', $data);
        return $this->db->insert_id();
    }

    //	add property_owner details...
    public function add_owner($data)
    {
        $insert = $this->db->insert('property_owner', $data);
        return $this->db->insert_id();
    }

    //	get construction material and display on the add business proprty form.
    public function get_cons()
    {
        $this->db->select('id,material');
        $this->db->from('construction_material');
        return $this->db->get()->result();
    }

    //	get construction material and display on the add  business proprty form.
    public function get_roof()
    {
        $this->db->select('id,roof');
        $this->db->from('roofing_type');
        return $this->db->get()->result();
    }

    //	get area councils and display on the add residence form.
    public function get_bus_sector()
    {
        $this->db->select('id,name');
        $this->db->from('buis_industry_type');
        return $this->db->get()->result();
    }

    //	get property category and display on the add business occupant form.
    public function get_prop_cat()
    {
        $this->db->select('id,cat_name');
        $this->db->from('property_category');
        return $this->db->get()->result();
    }

    //	get area councils and display on the add residence form.
    public function get_area_councils()
    {
        $this->db->select('id,name');
        $this->db->from('area_council');
        return $this->db->get()->result();
    }

    //	get business sector and display on the add residence form.

    public function get_area_towns($postdata)
    {
        $this->db->select('id,town');
        $this->db->from('town');
        $this->db->where('area_council_id', $postdata['area']);
        return $this->db->get()->result();
    }

    //	get last area council code
    public function resnumber($areacode, $towncode)
    {
        $this->db->select('code');
        $this->db->from('buisness_property');
        $this->db->where('area_council', $areacode);
        $this->db->where('town', $towncode);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $data = $this->db->get();
        $code = $data->row_array()['code'];
        $result = $code + 1;
        $number = 0 + 1;
        if ($data->num_rows() == 0) {
            return $number;
        } else {
            return $result;
        }
    }

    //	get last area council code
	public function resnumber_new($areacode, $towncode, $category)
	{
		$where = array(
			'town' => $towncode,
			'area_council' => $areacode,
			'category' => $category
		);
		$this->db->select('code');
		$this->db->from('buisness_property');
		$this->db->where($where);
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);
		$data = $this->db->get();
		$code = $data->row_array()['code'];
		$result = $code + 1;
		$number = 0 + 1;
		if ($data->num_rows() == 0) {
			return $number;
		} else {
			return $result;
		}
	}

    //	get last business occupant code
    public function busnumber($townid, $bus_sector)
    {
        $this->db->select('b.code');
        $this->db->from('buisness_occ as b');
        $this->db->join('buisness_property as p', 'b.buis_property_code = p.buis_prop_code');
        $this->db->where('town', $townid);
        $this->db->where('buis_sector', $bus_sector);
        $this->db->order_by('b.id', 'desc');
        $this->db->limit(1);
        $data = $this->db->get();
        $code = $data->row_array()['code'];
        $result = $code + 1;
        $number = 0 + 1;
        if ($data->num_rows() == 0) {
            return $number;
        } else {
            return $result;
        }
    }

    //	get last business occupant code
    public function busnumber2($townid, $category1)
    {
        $this->db->select('b.code');
        $this->db->from('buisness_occ as b');
        $this->db->join('buisness_property as p', 'b.buis_property_code = p.buis_prop_code');
        $this->db->join('busocc_to_category as q', 'q.busocc_id = b.id');
        $this->db->where('town', $townid);
        $this->db->where('category1', $category1);
        $this->db->order_by('b.id', 'desc');
        $this->db->limit(1);
        $data = $this->db->get();
        $code = $data->row_array()['code'];
        $result = $code + 1;
        $number = 0 + 1;
        if ($data->num_rows() == 0) {
            return $number;
        } else {
            return $result;
        }
    }

    // update residence
    public function update_owner($data, $id)
    {

        $this->db->where('id', $id);
        return $this->db->update('property_owner', $data);
    }

    // update business propety type
    public function update_business_prop($data, $id)
    {

        $this->db->where('id', $id);
        return $this->db->update('buisness_property', $data);
    }

    // update business occ propety type
    public function update_business_occ($data, $id)
    {

        $this->db->where('id', $id);
        return $this->db->update('buisness_occ', $data);
    }

    // update business property category
    public function update_bus_to_category($data, $id)
    {

        $this->db->where('property_id', $id);
        return $this->db->update('busprop_to_category', $data);
    }

    // update business property category
    public function update_busocc_to_category($data, $id)
    {

        $this->db->where('id', $id);
        return $this->db->update('busocc_to_category', $data);
    }

    // update bus_prop_to_owner
	public function update_bus_to_owner($bus_id,$owner_id)
	{
		$data = array(
			"owner_id" => $owner_id
		);

		$this->db->where('property_id', $bus_id);
		return $this->db->update('buis_prop_to_owner', $data);
    }
    
    // update bus_occ_to_owner
	public function update_busocc_to_owner($bus_id,$owner_id)
	{
		$data = array(
			"owner_id" => $owner_id
		);

		$this->db->where('property_id', $bus_id);
		return $this->db->update('buis_occ_to_owner', $data);
    }

    // update business property category
    public function delete_busocc_to_category($id)
    {

        $this->db->where('id', $id);
        return $this->db->delete('busocc_to_category');
    }

    // search if business prop code exist
    public function get_business_prop_code($id)
    {

        return $query = $this->db->query(
            "SELECT * from buisness_property WHERE buis_prop_code = '$id'"
        )->result_array();
    }

    // search if business prop code exist
    public function get_business_prop_latlong($id)
    {

        return $query = $this->db->query(
            "SELECT gps_lat,gps_long from buisness_property WHERE ".
            "buis_prop_code = '$id'"
        )->result_array();
    }

    //  get products from db
    public function get_products($target)
    {
        $this->db->select('*');
        $this->db->from('revenue_product');
        $this->db->where_in('target', $target);
        $products = $this->db->get()->result();
        return ($products);
    }

    //assign owner to business property
    public function add_bus_to_owner($res_id, $owner_id)
    {
        $data = array(
            'owner_id' => $owner_id,
            'property_id' => $res_id
        );
        $insert = $this->db->insert('buis_prop_to_owner', $data);
        return $this->db->insert_id();
    }

    //assign owner to business occupants
    public function add_busocc_to_owner($res_id, $owner_id)
    {
        $data = array(
            'owner_id' => $owner_id,
            'property_id' => $res_id
        );
        $insert = $this->db->insert('buis_occ_to_owner', $data);
        return $this->db->insert_id();
    }

    //add business categories
    public function add_bus_to_category($category)
    {
        $insert = $this->db->insert('busprop_to_category', $category);
        return $this->db->insert_id();
    }

    //get business property detail for view
    public function get_business_details($id)
    {
        $data = array(
            'b.id' => $id
        );
        $this->db->select(
            "b.*,t.town as tt ,a.name as area,c.category1,c.category2,".
            "c.category3,c.category4,c.category5,c.category6"
        );
        $this->db->from("buisness_property as b");
        $this->db->where($data);
        $this->db->join('town as t', 'b.town =t.id', 'left');
        $this->db->join('area_council as a', 'b.area_council = a.id', 'left');
        $this->db->join('busprop_to_category as c', 'c.property_id = b.id', 'left');
        return $this->db->get()->row_array();
    }

    //get business occupant detail for view
    public function get_business_occ_details($id)
    {
        $data = array(
            'b.id' => $id
        );
        $this->db->select(
            "b.*,t.town as tt ,a.name as area,s.name as sector,p.gps_lat, ".
            "p.gps_long"
        );
        $this->db->from("buisness_occ as b");
        $this->db->where($data);
        $this->db->join('buisness_property as p', 'b.buis_property_code = p.buis_prop_code');
        $this->db->join('town as t', 'p.town =t.id', 'left');
        $this->db->join('buis_sector as s', 'b.buis_sector = s.id', 'left');
        $this->db->join('area_council as a', 'p.area_council = a.id', 'left');
        return $this->db->get()->row_array();
    }

    //get invoices for a particular property
    public function get_property_invoice($id, $target)
    {
        $data = array(
            'i.property_id' => $id,
            'i.target' => $target
        );
        $this->db->select('i.*');
        $this->db->from('vw_invoice as i');
        $this->db->where($data);
        return $this->db->get()->result();
    }

    //get sum of invoices for a particular property
    public function get_property_invoice_sum($id, $target)
    {
        $data = array(
            'i.property_id' => $id,
            'i.target' => $target
        );
        $this->db->select(
            'sum(i.invoice_amount) as invoice_amount,'.
            'sum(i.adjustment_amount) as discount, '.
            'sum(i.amount_paid) as amount_paid'
        );
        $this->db->from('vw_invoice as i');
        $this->db->where($data);
        return $this->db->get()->row_array();
    }

    // request ajax to get all business properties
    function getBusinessProperties($postData = null)
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
        $start_date = $postData['start_date'];
        $end_date = $postData['end_date'];
        $base_url = base_url();

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
                "po.primary_contact like '%" . $searchValue . "%' or 
                buisness_property.buis_prop_code like '%" . $searchValue .
                "%' or a.name like '%" . $searchValue . "%' or t.town like '%" .
                $searchValue . "%' or concat(po.firstname,' ',po.lastname) ".
                "like '%" . $searchValue . "%' or po.primary_contact like '%" .
                $searchValue . "%'"
            );
        }


        ## Total number of records without filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('buisness_property');
        $this->db->join('town as t', 'buisness_property.town = t.id', 'left');
        $this->db->join(
            'area_council as a',
            'buisness_property.area_council = a.id',
            'left'
        );
        $this->db->join(
            'buis_prop_to_owner as bpo',
            'buisness_property.id = bpo.property_id',
            'left'
        );
        $this->db->join('property_owner as po', 'bpo.owner_id = po.id', 'left');
        $this->db->join("users as u","buisness_property.agent_id=u.id","left");
        $this->db->join("agent as ag","buisness_property.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where(
                    'date(buisness_property.date_created)',
                    $start_date
                );
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else {
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('buisness_property');
        $this->db->join('town as t', 'buisness_property.town = t.id', 'left');
        $this->db->join(
            'area_council as a',
            'buisness_property.area_council = a.id',
            'left'
        );
        $this->db->join(
            'buis_prop_to_owner as bpo',
            'buisness_property.id = bpo.property_id',
            'left'
        );
        $this->db->join('property_owner as po', 'bpo.owner_id = po.id', 'left');
        $this->db->join("users as u","buisness_property.agent_id=u.id","left");
        $this->db->join("agent as ag","buisness_property.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where(
                    'date(buisness_property.date_created)',
                    $start_date
                );
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else {
            }
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select(
            "buisness_property.buis_prop_code,buisness_property.id,".
            "po.firstname,po.lastname,po.primary_contact,po.email,".
            "buisness_property.status,buisness_property.invoice_status,buisness_property.category,".
            "buisness_property.accessed,t.town as tt, a.name as area,buisness_property.image_path,".
            "buisness_property.property_image,".
            'CASE WHEN buisness_property.agent_category = "agent" THEN concat(ag.firstname," ",ag.lastname," (",ag.agent_code,")") WHEN buisness_property.agent_category = "admin" THEN concat(u.firstname," ",u.lastname," (",u.username,")") END AS registered_by'
        );
        $this->db->from('buisness_property');
        $this->db->join('town as t', 'buisness_property.town = t.id', 'left');
        $this->db->join(
            'area_council as a', 
            'buisness_property.area_council = a.id', 'left');
        $this->db->join(
            'buis_prop_to_owner as bpo',
            'buisness_property.id = bpo.property_id', 'left');
        $this->db->join(
            'property_owner as po', 'bpo.owner_id = po.id', 'left');
        $this->db->join("users as u","buisness_property.agent_id=u.id","left");
        $this->db->join("agent as ag","buisness_property.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where(
                    'date(buisness_property.date_created)',
                    $start_date
                );
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where(
                    'date(buisness_property.date_created) >=',
                    $start_date
                );
                $this->db->where(
                    'date(buisness_property.date_created) <=',
                    $end_date
                );
            } else {
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
            # edit residence url
            $url = base_url() . 'Business/edit_business_property_form/' . $record->id . '/' . $record->buis_prop_code;
            $business_url = "<a href='$url'>" . $record->buis_prop_code . "</a>";

            //residence id (pk)
            $id = $record->id;

            //check if business is assessed
            $assessed = $record->accessed;
            if ($assessed == 1) {
                $assessed_badge = '<span class="badge badge-success">Assessed</span>';
            } else {
                $assessed_badge = '<span class="badge badge-danger">Unassessed</span>';
            }

            //check if business is status
            $status = $record->status;
            if ($status == 1) {
                $status_badge = '<span class="badge badge-success">Complete</span>';
            } else {
                $status_badge = '<span class="badge badge-danger">Incomplete</span>';
            }

            //check if property invoice is generated
            $invoice_status = $record->invoice_status;
            if ($invoice_status == 1) {
                $invoice_status_badge = '<span class="badge badge-success">Generated</span>';
            } else {
                $invoice_status_badge = '<span class="badge badge-danger">Not Generated</span>';
            }

            #category
            $cat = ($record->category == 12)? "Business": "Residential";

            // form id
            $form_id = ($record->category == 12)? 2: 1;
            
            $buscode = $record->buis_prop_code;
            $primary_contact = $record->primary_contact;
            $resend_sms_button = "";

            $resend_sms_button .= '<form method="post" action="' . $base_url . 'Business/resend_business_sms">';
            $resend_sms_button .= "<input type='hidden' name='number' value='$primary_contact'>";
            $resend_sms_button .= "<input type='hidden' name='buscode' value='$buscode'>";
            $resend_sms_button .= "<input type='hidden' name='category' value='$cat'>";
            $resend_sms_button .= "<button type='submit' class='btn btn-success'><span class='fa fa-refresh'></span></button>";
            $resend_sms_button .= "</form>";

            $funcCall = "confirm_modall('". $primary_contact . "','". $record->email . "')";

            $billCall = "property_bill_modal('". $id . "','". $record->buis_prop_code . "','". $form_id."')";

            $property_key = "busprop";
			$deleteRecord = "delete_modal('". $id . "','". $record->buis_prop_code ."','".$property_key."')";
            
            # message url
            $message_button = '<a class="btn btn-info" style="margin:0.5em" onclick="' . $funcCall . '"><i style="color:white" class="fa fa-envelope"></i></a>';

            //  bill generation button
            if(has_permission($this->session->userdata('user_info')['id'],'single_bill_generation')){
                $bill_button = "<a class='btn btn-info' onclick=$billCall><i style='color:white' class='fa fa-file'></i></a>";
            }else{
                $bill_button = '';
            }

            //  delete record button
            if(has_permission($this->session->userdata('user_info')['id'],'delete_property_business')){
                $delete_button = "<a class='btn btn-danger' style='margin:0.5em' onclick=$deleteRecord><i style='color:white' class='fa fa-trash'></i></a>";
            }else{
                $delete_button = '';
            }

            if($record->property_image == ''){
				$property_image = base_url().'upload/property/residence/no-image.png';
			}else{
				$property_image = base_url().$record->image_path.$record->property_image;
			}
			# image button
            $image_button = '<a class="btn btn-info example-image-link" style="margin:0.5em" href="' . $property_image . '" data-lightbox="example-1"><i style="color:white" class="fa fa-picture-o"></i></a>';        
            

            // property owner full name
            $fullname = $record->firstname . " " . $record->lastname;

            $data[] = array(
                "buis_prop_code" => $business_url,
                "area" => $record->area,
                "tt" => $record->tt,
                "category" => $cat,
                "status" => $status_badge,
                "assessed" => $assessed_badge,
                "invoice_status" => $invoice_status_badge,
                "owner" => $fullname,
                "primary_contact" => $primary_contact,
                "registered_by" => $record->registered_by,
                "resend_code" => $resend_sms_button,
                "bill_generation" => $image_button.$message_button.$bill_button.$delete_button
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

    // request ajax to get all business occupants
    function getBusinessOccupant($postData = null)
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
        $start_date = $postData['start_date'];
        $end_date = $postData['end_date'];
        $base_url = base_url();

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = (
                "po.primary_contact like '%" . $searchValue . 
                "%' or b.buis_occ_code like '%" . $searchValue . "%' or 
                b.buis_name like '%" . $searchValue . "%' or 
                b.buis_primary_phone like '%" . $searchValue . "%' or
                b.buis_email like '%" . $searchValue . "%' or 
                concat(po.firstname,' ',po.lastname) like '%" . $searchValue .
                "%' or b.buis_property_code like '%" . $searchValue . "%'"
            );
        }


        ## Total number of records without filtering
        $this->db->select("count(*) as allcount");
        $this->db->from("buisness_occ as b");
        $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
        $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
        $this->db->join("users as u","b.agent_id=u.id","left");
        $this->db->join("agent as ag","b.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(b.date_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else {
            }
        }
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from("buisness_occ as b");
        $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
        $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
        $this->db->join("users as u","b.agent_id=u.id","left");
        $this->db->join("agent as ag","b.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(b.date_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else {
            }
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select(
            "b.id,b.buis_occ_code,b.buis_name,b.buis_primary_phone,b.buis_email,
            b.invoice_status,po.firstname,po.lastname,
            po.primary_contact,po.email,".
            'CASE WHEN b.agent_category = "agent" THEN concat(ag.firstname," ",ag.lastname," (",ag.agent_code,")") WHEN b.agent_category = "admin" THEN concat(u.firstname," ",u.lastname," (",u.username,")") END AS registered_by'
        );
        $this->db->from("buisness_occ as b");
        $this->db->join('buis_occ_to_owner as boo', 'b.id = boo.property_id', 'left');
        $this->db->join('property_owner as po', 'boo.owner_id = po.id', 'left');
        $this->db->join("users as u","b.agent_id=u.id","left");
        $this->db->join("agent as ag","b.agent_id=ag.id","left");

        if ($searchValue == '') {
            if ($start_date != "" && $end_date == "") {
                $this->db->where('date(b.date_created)', $start_date);
            } else if ($start_date != "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else if ($postData['start_date'] == "" && $end_date != "") {
                $this->db->where('date(b.date_created) >=', $start_date);
                $this->db->where('date(b.date_created) <=', $end_date);
            } else {
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
            # edit residence url
            $url = base_url() . 'Business/edit_business_occupant_form/' . $record->id;
            $business_url = "<a href='$url'>" . $record->buis_occ_code . "</a>";

            //residence id (pk)
            $id = $record->id;


            $buscode = $record->buis_occ_code;
            $primary_contact = $record->primary_contact;
            $resend_sms_button = "";

            $resend_sms_button .= '<form method="post" action="' . $base_url . 'Business/resend_business_occ_sms">';
            $resend_sms_button .= "<input type='hidden' name='number' value='$primary_contact'>";
            $resend_sms_button .= "<input type='hidden' name='bus_occ_code' value='$buscode'>";
            $resend_sms_button .= "<button type='submit' class='btn btn-success'><span class='fa fa-refresh'></span></button>";
            $resend_sms_button .= "</form>";

            $funcCall = "confirm_modall('". $primary_contact . "','". $record->email . "')";
            $billCall = "bill_modal('". $id . "','". $record->buis_occ_code ."')";

            $property_key = "busocc";
			$deleteRecord = "delete_modal('". $id . "','". $record->buis_occ_code ."','".$property_key."')";

            # message url
            $message_button = "<a class='btn btn-info' onclick=$funcCall style='margin:0.5em'><i style='color:white' class='fa fa-envelope'></i></a>";

            //  bill generation button
            if(has_permission($this->session->userdata('user_info')['id'],'single_bill_generation')){
                $bill_button = "<a class='btn btn-info' onclick=$billCall><i style='color:white' class='fa fa-file'></i></a>";
            }else{
                $bill_button = '';
            }

            //  delete record button
            if(has_permission($this->session->userdata('user_info')['id'],'delete_property_business')){
                $delete_button = "<a class='btn btn-danger' style='margin:0.5em' onclick=$deleteRecord><i style='color:white' class='fa fa-trash'></i></a>";
            }else{
                $delete_button = '';
            }

            $action_panel = "<span>$bill_button $resend_sms_button $message_button</span>";

            // property owner full name
            $fullname = $record->firstname . " " . $record->lastname;

            //check if property invoice is generated
            $invoice_status = $record->invoice_status;
            if ($invoice_status == 1) {
                $invoice_status_badge = '<span class="badge badge-success">Generated</span>';
            } else {
                $invoice_status_badge = '<span class="badge badge-danger">Not Generated</span>';
            }

            $data[] = array(
                "buis_occ_code" => $business_url,
                "buis_name" => $record->buis_name,
                "buis_primary_phone" => $record->buis_primary_phone,
                "buis_email" => $record->buis_email,
                "invoice_status" => $invoice_status_badge,
                "owner_name" => $fullname,
                "primary_contact" => $record->primary_contact,
                "registered_by" => $record->registered_by,
                "resend_code" => $resend_sms_button,
                "bill_generation" => $message_button.$bill_button.$delete_button
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
