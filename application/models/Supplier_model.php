<?php
class Supplier_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all(){
		return $this->db->get('supplier');
	}
	
	public function get_by_id($id){
		return $this->db->where('supplier_id', $id)->get('supplier');
	}
	
	public function insert($data){
		return $this->db->insert('supplier', $data);
	}
	
	public function update_by_id($id, $data){
		$this->db->where('supplier_id', $id);
		return $this->db->update('supplier', $data);
	}
	
	public function delete_by_id($id){
		$this->db->where('supplier_id', $id);
		return $this->db->delete('supplier');
	}
}
?>