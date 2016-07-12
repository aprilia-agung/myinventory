<?php
class Category_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all(){
		return $this->db->get('category');
	}
	
	public function get_by_id($id){
		return $this->db->where('category_id', $id)->get('category');
	}
	
	public function insert($data){
		return $this->db->insert('category', $data);
	}
	
	public function update_by_id($id, $data){
		$this->db->where('category_id', $id);
		return $this->db->update('category', $data);
	}
	
	public function delete_by_id($id){
		$this->db->where('category_id', $id);
		return $this->db->delete('category');
	}
}
?>