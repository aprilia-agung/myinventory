<?php
class Order_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all(){
		$this->db->join('supplier', 'supplier.supplier_id = order.order_supplier');
		return $this->db->get('order');
	}
	
	public function get_by_id($id){
		return $this->db->where('order_id', $id)->get('order');
	}
	
	public function insert($data){
		$this->db->insert('order', $data);
		return $this->db->insert_id();
	}
	
	public function update_by_id($id, $data){
		$this->db->where('order_id', $id);
		return $this->db->update('order', $data);
	}
	
	public function delete_by_id($id){
		$this->db->where('order_id', $id);
		return $this->db->delete('order');
	}
}
?>