<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Product_model', 'product');
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Product';
		$data['content']	= 'content/product/index';
		$data['product']	= $this->product->get_all()->result_array();
		$this->load_template($data);
	}
	
	public function add(){
		$this->load->model('Category_model', 'cat');
		$this->load->model('Supplier_model', 'supp');
		$data['title'] 		= 'Add New Product';
		$data['state']		= 'add';
		$data['action']		= 'insert';
		$data['category']	= $this->cat->get_all()->result_array();
			$data['suppliers']	= $this->supp->get_all()->result_array();
		$data['content']	= '/content/product/form';
		$this->load_template($data);
	}
	
	public function edit(){
		$this->load->model('Category_model', 'cat');
		$this->load->model('Supplier_model', 'supp');
		$id = $this->input->get('id');
		if(isset($id)){
			$data['title'] 		= 'Edit Product';
			$data['state']		= 'edit';
			$data['action']		= 'update';
			$data['category']	= $this->cat->get_all()->result_array();
			$data['suppliers']	= $this->supp->get_all()->result_array();
			$data['product']	= $this->product->get_by_id((int)$id)->row_array();
			$data['content']	= '/content/product/form';
			$this->load_template($data);
		}else{
			redirect(site_url('product'));
		}
	}
	
	public function insert(){
		$datas = $this->input->post();
		$data = array(
			'product_category' => $datas['prod_cat'],
			'product_code' => $datas['prod_code'],
			'product_name' => $datas['prod_name']
		);
		
		if($this->product->insert($data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Save data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Save data failed.');
		}
		
		redirect(site_url('product'));
	}
	
	public function update(){
		$datas = $this->input->post();
		$data = array(
			'product_category' => $datas['prod_cat'],
			'product_code' => $datas['prod_code'],
			'product_name' => $datas['prod_name']
		);
		
		if($this->product->update_by_id((int)$datas['prod_id'], $data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Update data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Update data failed.');
		}
		
		redirect(site_url('product'));
	}
	
	public function delete(){
		$id = $this->input->get('id');
		if(isset($id)){
			if($this->product->delete_by_id((int)$id)){
				$this->session->set_flashdata('notif_status', TRUE);
				$this->session->set_flashdata('notif_msg', 'Data removed succesfully.');
			}else{
				$this->session->set_flashdata('notif_status', FALSE);
				$this->session->set_flashdata('notif_msg', 'Failed to remove data.');
			}
		}
		
		redirect(site_url('product'));
	}
}
