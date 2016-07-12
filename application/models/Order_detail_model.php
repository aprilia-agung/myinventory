<?php
class Order_detail_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function batch_insert($data){
		return $this->db->insert_batch('order_detail', $data);
	}

	public function get_item_order($id){
		return $this->db->where('order_id', $id)->get('order_detail');
	}
}
?>