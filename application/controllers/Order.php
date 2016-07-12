<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Order_model', 'order');
		$this->load->model('Supplier_model', 'supplier');
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Order';
		$data['content']	= 'content/order/index';
		$data['orders']	= $this->order->get_all()->result_array();
		$this->load_template($data);
	}
	
	public function add(){
		$data['title'] 		= 'Add New Order';
		$data['state']		= 'add';
		$data['action']		= 'insert';
		$data['supplier']	= $this->supplier->get_all()->result_array();
		$data['content']	= '/content/order/form';
		$this->load_template($data);
	}
	
	public function edit(){
		$id = $this->input->get('id');
		if(isset($id)){
			$data['title'] 		= 'Edit Order';
			$data['state']		= 'edit';
			$data['action']		= 'update';
			$data['order']	= $this->order->get_by_id((int)$id)->row_array();
			$data['supplier']	= $this->supplier->get_all()->result_array();
			$data['content']	= '/content/order/form';
			$this->load_template($data);
		}else{
			redirect(site_url('supplier'));
		}
	}

	public function detail(){
		$this->load->model('Order_detail_model', 'o_detail');
		$data['title'] 		= 'Detail Order';
		$data['content']	= '/content/order/detail';

		$this->db->join('supplier', 'supplier.supplier_id = order.order_supplier');
		$order = $this->order->get_by_id((int)$this->input->get('id'))->row_array();
		$data['order']	= $order;

		$this->db->join('product', 'product.product_id = order_detail.product_id');
		$data['item_order'] = $this->o_detail->get_item_order($order['order_id'])->result_array();
		$this->load_template($data);
	}
	
	public function insert(){
		$this->load->model('Order_detail_model', 'o_detail');
		$datas = $this->input->post();
		$data = array(
			'order_date' => date('Y-m-d', strtotime($datas['order_date'])),
			'order_supplier' => $datas['supplier'],
			'order_shipping' => $datas['ongkir']
		);
		
		$items = array();
		$this->db->trans_start();
		$order_id = $this->order->insert($data);
		if($this->session->has_userdata('items_order')){
			foreach ($this->session->userdata('items_order') as $val){
				array_push($items, array('order_id' => $order_id, 'product_id' => 1, 'quantity' => $val['qty'], 'price' => $val['price'], 'sku' => $val['sku']));
			}
			$this->o_detail->batch_insert($items);
		}
		$this->db->trans_complete();
		if($this->db->trans_status() !== FALSE){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Save data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Save data failed.');
		}
		
		redirect(site_url('order'));
	}
	
	public function update(){
		$datas = $this->input->post();
		$data = array(
			'order_date' => date('Y-m-d', strtotime($datas['order_date'])),
			'order_supplier' => $datas['supplier'],
			'order_shipping' => $datas['ongkir']
		);
		
		if($this->order->update_by_id((int)$datas['order_id'], $data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Update data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Update data failed.');
		}
		
		redirect(site_url('order'));
	}
	
	public function delete(){
		$id = $this->input->get('id');
		if(isset($id)){
			if($this->order->delete_by_id((int)$id)){
				$this->session->set_flashdata('notif_status', TRUE);
				$this->session->set_flashdata('notif_msg', 'Data removed succesfully.');
			}else{
				$this->session->set_flashdata('notif_status', FALSE);
				$this->session->set_flashdata('notif_msg', 'Failed to remove data.');
			}
		}
		
		redirect(site_url('order'));
	}
	
	public function add_item(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$datas = $this->input->post();
		$datas['sku'] = time();
		$datas['id'] = rand();
		$items = array();

		if($this->session->has_userdata('items_order')){
			$items = $this->session->userdata('items_order');
			$this->session->unset_userdata('items_order');
		}

		array_push($items, $datas);
		
		$this->session->set_userdata('items_order', $items);
		$this->_generate_table_body_item_order();
	}

	public function delete_item(){
		$items = $this->session->userdata('items_order');
		$this->session->unset_userdata('items_order');
		$key = array_search($this->input->get('id'), array_column($items, 'id'));
		if($key !== false){
			unset($items[$key]);
		}

		$this->session->set_userdata('items_order', $items);
		$this->_generate_table_body_item_order();
	}

	private function _generate_table_body_item_order(){
		if($this->session->has_userdata('items_order')){
			$tbody = '';
			$i = 1;
			$tot_qty = 0;
			$tot_price = 0;
			foreach ($this->session->userdata('items_order') as $val){
				$tbody .= '<tr>
					<td>'.$i.'</td>
					<td>'.$val['product'].'</td>
					<td>'.$val['qty'].'</td>
					<td><span class="pull-right">'.number_format($val['price'], 0, '', '.').'</span></td>
					<td><span class="pull-right">'.number_format($val['qty'] * $val['price'], 0, '', '.').'</span></td>
					<td><a href="'.site_url('order/delete_item?id='.$val['id']).'" class="btn btn-danger btn-xs delete_item"><i class="fa fa-trash"></a></td>
				</tr>';
				$i++;
				$tot_qty += $val['qty'];
				$tot_price += $val['qty']*$val['price'];
			}
			
			$tbody .= ' <tr>
						<th colspan="2"><span class="pull-right"><strong>Total</strong></span></th>
						<th>'.$tot_qty.'</th>
						<th></th>
						<th><span class="pull-right">'.number_format($tot_price, 0, '', '.').'</span></th>
						<th></th>
					</tr>';
			echo $tbody;	
		}else{
			echo '';
		}
	}
}
