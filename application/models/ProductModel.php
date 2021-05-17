<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

	//	get products from db
	public function get_products(){
		$products = $this->db->query("SELECT * FROM revenue_product")->result();
		return($products);
	}

    //	get product x from db
    public function get_product($id){
        $products = $this->db->query("SELECT * FROM revenue_product WHERE id = '$id'")->result();
        return($products);
    }

    //	get category x from db
    public function get_category_x($id, $x){
        $category = $this->db->query("SELECT * FROM product_category$x WHERE id = '$id'")->result();
//        echo  $this->db->last_query;
        return($category);
    }

    //	get category 3 from db
    public function get_category_3($id){
        $category = $this->db->query("SELECT
product_category3.*,
product_category2.category1_id AS category1_id
FROM
product_category3
JOIN product_category2
ON product_category3.category2_id = product_category2.id
WHERE product_category3.id = '$id'")->result();
//        echo  $this->db->last_query;
        return($category);
    }

    //	get category 4 from db
    public function get_category_4($id){
        $category = $this->db->query("SELECT
product_category2.category1_id AS category1_id,
product_category3.category2_id AS category2_id,
product_category4.*
FROM
product_category3
JOIN product_category2
ON product_category3.category2_id = product_category2.id 
JOIN product_category4
ON product_category3.id = product_category4.category3_id
WHERE
product_category4.id = '$id'")->result();
//        echo  $this->db->last_query;
        return($category);
    }

    //	get category 5 from db
    public function get_category_5($id){
        $category = $this->db->query("SELECT
product_category2.category1_id AS category1_id,
product_category3.category2_id AS category2_id,
product_category4.category3_id AS category3_id,
product_category5.*
FROM
product_category3
JOIN product_category2
ON product_category3.category2_id = product_category2.id 
JOIN product_category4
ON product_category3.id = product_category4.category3_id 
JOIN product_category5
ON product_category4.id = product_category5.category4_id
WHERE
product_category5.id = '$id'")->result();
//        echo  $this->db->last_query;
        return($category);
    }


    //	get category 5 from db
    public function get_category_6($id){
        $category = $this->db->query("SELECT
product_category2.category1_id AS category1_id,
product_category3.category2_id AS category2_id,
product_category4.category3_id AS category3_id,
product_category5.category4_id AS category4_id,
product_category6.*
FROM
product_category3
JOIN product_category2
ON product_category3.category2_id = product_category2.id 
JOIN product_category4
ON product_category3.id = product_category4.category3_id 
JOIN product_category5
ON product_category4.id = product_category5.category4_id 
JOIN product_category6
ON product_category5.id = product_category6.category5_id
WHERE
product_category6.id = '$id'")->result();
//        echo  $this->db->last_query;
        return($category);
    }

    //	get category 3 from db
    public function get_category_3_list($id)
    {
        $category = $this->db->query("SELECT
product_category3.*,
product_category2.category1_id AS category1_id
FROM
product_category3
JOIN product_category2
ON product_category3.category2_id = product_category2.id
WHERE product_category3.category2_id = '$id'")->result();
//        echo  $this->db->last_query;
        return ($category);
    }

    //	get all products from db
    public function get_all_products(){
        $products = $this->db->query("SELECT
        revenue_product.id,
        revenue_product.`name` AS Product,
        product_category1.`name` AS category1,
        product_category2.`name` AS category2,
        product_category3.`name` AS category3,
        product_category4.`name` AS category4,
        product_category5.`name` AS category5,
        product_category6.`name` AS category6,
        product_category6.frequency,
        product_category6.unit_of_measure,
        product_category6.price1,
        product_category6.price2,
        product_category6.price3,
        product_category6.price4,
        product_category6.price5,
        product_category1.id AS cat1_id,
        product_category2.id AS cat2_id,
        product_category3.id AS cat3_id,
        product_category4.id AS cat4_id,
        product_category5.id AS cat5_id,
        product_category6.id AS cat6_id
        FROM
        revenue_product
        JOIN product_category1
        ON revenue_product.id = product_category1.product_id 
        JOIN product_category2
        ON product_category1.id = product_category2.category1_id 
        JOIN product_category3
        ON product_category2.id = product_category3.category2_id 
        JOIN product_category4
        ON product_category3.id = product_category4.category3_id 
        JOIN product_category5
        ON product_category4.id = product_category5.category4_id 
        JOIN product_category6
        ON product_category5.id = product_category6.category5_id")->result();
        return($products);
    }

    //	get all products from db
    public function get_cat1($x, $id){
        $product = $this->db->query("SELECT id, product_id, name FROM product_category1 WHERE id = '$id'")->result();
        return($product);
    }

    //	get product from db
    public function get_product_name($id){
        $product = $this->db->query("SELECT * FROM revenue_product WHERE id = '$id'")->result();
        return($product);
    }
    //	get category_x from db
    /**
     * @param $x
     * @param $y = predecessor category id
     * @return mixed
     */
    public function get_category($x, $y){
        $z = $x-1;
        $members = $this->db->query("SELECT * FROM product_category".$x." where category".$z."_id = '$y'")->result();
        return($members);
    }

    //	get category_x from db
    /**
     * @param $x
     * @param $y = next category id
     * @return mixed
     */
    public function get_category_ajax($x, $y){
        $z = $x+1;
        $members = $this->db->query("SELECT * FROM product_category".$x." where category".$z."_id = '$y'")->result();
        return($members);
    }

    //	get category1 from db
    /**
     * @param $product_id
     */
    public function get_category1($product_id){
        $members = $this->db->query("SELECT * FROM product_category1 where product_id = '$product_id'")->result();
        return($members);
    }

    public function get_category2_list($cat1_id){
        $members = $this->db->query("SELECT * FROM product_category2 where category1_id = '$cat1_id'")->result();
        return($members);
    }

    public function update_product($data,$id){
        $this->db->where('id', $id);
        $update = $this->db->update('revenue_product',$data);
        return($update);
    }

    public function update_catx($data,$id,$x){
        $this->db->where('id', $id);
        $update = $this->db->update('product_category'.$x,$data);
        return($update);
    }

    //	add new product to db
    public function add_product($a){
        $insert = $this->db->insert('revenue_product',$a);
        return($insert);
    }

    //	add new category1 to db
    public function add_category1($a){
        $insert = $this->db->insert('product_category1',$a);
        return($insert);
    }

    //	add new category2 to db
    public function add_category2($a){
        $insert = $this->db->insert('product_category2',$a);
        return($insert);
    }

    //	add new category3 to db
    public function add_category3($a){
        $insert = $this->db->insert('product_category3',$a);
        return($insert);
    }

    //	add new category4 to db
    public function add_category4($a){
        $insert = $this->db->insert('product_category4',$a);
        return($insert);
    }

    //	add new category5 to db
    public function add_category5($a){
        $insert = $this->db->insert('product_category5',$a);
        return($insert);
    }

    //	add new category6 to db
    public function add_category6($a){
        $insert = $this->db->insert('product_category6',$a);
        return($insert);
    }

    //	delete a product
    public function delete_product($id){
        $delete = $this->db->query("DELETE from revenue_products WHERE id = '$id'");
        return($delete);
    }

	// update client account activation
	public function update_accactivation($memberid,$state){
			
		$my_own_query = "Update membership set acc_activation = '$state' where memberid = '$memberid'";
		$query = $this->db->query($my_own_query);		
	}

	//	get member details from db
	public function get_member_details($a){
		$member = $this->db->query("SELECT * FROM members m left join profession p on m.profession = p.id left join ministry w on m.ministry = w.id left join educational_level e on m.edu_level = e.id left join position t on m.position = t.id left join grp g on m.group = g.id left join cells c on m.cell = c.id WHERE memid = $a")->row_array();
		return($member);
	}

	//	update a member details
	 public function update_member($data,$id){
        $this->db->where($id);
       $update = $this->db->update('members',$data);
       return($update);
    }

    function getProduct($postData=null){

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
        if($searchValue != ''){
            $searchQuery = " (revenue_product.`name` like '%".$searchValue."%' or 
                product_category1.`name` like '%".$searchValue."%' or 
                product_category2.`name` like'%".$searchValue."%' or 
                product_category3.`name` like'%".$searchValue."%' or 
                product_category4.`name` like'%".$searchValue."%' or 
                product_category5.`name` like'%".$searchValue."%' or 
                product_category6.`name` like'%".$searchValue."%' or 
                product_category6.frequency like'%".$searchValue."%' or
                product_category6.unit_of_measure like'%".$searchValue."%' or 
                product_category6.price1 like'%".$searchValue."%' or 
                product_category6.price2 like'%".$searchValue."%' or 
                product_category6.price3 like'%".$searchValue."%' or 
                product_category6.price4 like'%".$searchValue."%' or
                product_category6.price5 like'%".$searchValue."%') ";
        }
  
  
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("revenue_product");
        $this->db->join("product_category1","revenue_product.id = product_category1.product_id");
        $this->db->join("product_category2","product_category1.id = product_category2.category1_id");
        $this->db->join("product_category3","product_category2.id = product_category3.category2_id");
        $this->db->join("product_category4","product_category3.id = product_category4.category3_id");
        $this->db->join("product_category5","product_category4.id = product_category5.category4_id");
        $this->db->join("product_category6","product_category5.id = product_category6.category5_id");
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;
  
        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("revenue_product");
        $this->db->join("product_category1","revenue_product.id = product_category1.product_id");
        $this->db->join("product_category2","product_category1.id = product_category2.category1_id");
        $this->db->join("product_category3","product_category2.id = product_category3.category2_id");
        $this->db->join("product_category4","product_category3.id = product_category4.category3_id");
        $this->db->join("product_category5","product_category4.id = product_category5.category4_id");
        $this->db->join("product_category6","product_category5.id = product_category6.category5_id");
        if($searchQuery != '')
        $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;
  
        
        ## Fetch records
        $this->db->select('revenue_product.id,
        revenue_product.`name` AS Product,
        product_category1.`name` AS category1,
        product_category2.`name` AS category2,
        product_category3.`name` AS category3,
        product_category4.`name` AS category4,
        product_category5.`name` AS category5,
        product_category6.`name` AS category6,
        product_category6.frequency,
        product_category6.unit_of_measure,
        product_category6.price1,
        product_category6.price2,
        product_category6.price3,
        product_category6.price4,
        product_category6.price5,
        product_category1.id AS cat1_id,
        product_category2.id AS cat2_id,
        product_category3.id AS cat3_id,
        product_category4.id AS cat4_id,
        product_category5.id AS cat5_id,
        product_category6.id AS cat6_id');
        $this->db->from("revenue_product");
        $this->db->join("product_category1","revenue_product.id = product_category1.product_id");
        $this->db->join("product_category2","product_category1.id = product_category2.category1_id");
        $this->db->join("product_category3","product_category2.id = product_category3.category2_id");
        $this->db->join("product_category4","product_category3.id = product_category4.category3_id");
        $this->db->join("product_category5","product_category4.id = product_category5.category4_id");
        $this->db->join("product_category6","product_category5.id = product_category6.category5_id");
        if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
  
        $data = array();
  
        foreach($records as $record ){
          
            $data[] = array( 
                "product"=>$record->Product,
                "category1"=>$record->category1,
                "category2"=>$record->category2,
                "category3"=>$record->category3,
                "category4"=>$record->category4,
                "category5"=>$record->category5,
                "category6"=>$record->category6,
                "frequency"=>$record->frequency,
                "unit_of_measure"=>$record->unit_of_measure,
                "price1"=>$record->price1,
                "price2"=>$record->price2,
                "price3"=>$record->price3,
                "price4"=>$record->price4,
                "price5"=>$record->price5
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