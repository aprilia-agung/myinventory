<?php
class Product_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all(){
		$this->db->join('category', 'category.category_id = product.product_category');
		return $this->db->get('product');
	}
	
	public function get_by_id($id){
		return $this->db->where('product_id', $id)->get('product');
	}

	public function get_by_name($name){
		return $this->db->like('product_name', $name)->get('product');	
	}
	
	public function insert($data){
		return $this->db->insert('product', $data);
	}
	
	public function update_by_id($id, $data){
		$this->db->where('product_id', $id);
		return $this->db->update('product', $data);
	}
	
	public function delete_by_id($id){
		$this->db->where('product_id', $id);
		return $this->db->delete('product');
	}
}
?>