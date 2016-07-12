<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Supplier_model', 'supplier');
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Supplier';
		$data['content']	= 'content/supplier/index';
		$data['suppliers']	= $this->supplier->get_all()->result_array();
		$this->load_template($data);
	}
	
	public function add(){
		$data['title'] 		= 'Add New Supplier';
		$data['state']		= 'add';
		$data['action']		= 'insert';
		$data['category']	= $this->supplier->get_all()->result_array();
		$data['content']	= '/content/supplier/form';
		$this->load_template($data);
	}
	
	public function edit(){
		$id = $this->input->get('id');
		if(isset($id)){
			$data['title'] 		= 'Edit Supplier';
			$data['state']		= 'edit';
			$data['action']		= 'update';
			$data['suppliers']	= $this->supplier->get_by_id((int)$id)->row_array();
			$data['content']	= '/content/supplier/form';
			$this->load_template($data);
		}else{
			redirect(site_url('supplier'));
		}
	}
	
	public function insert(){
		$datas = $this->input->post();
		$data = array(
			'supplier_code' => $datas['supp_code'],
			'supplier_name' => $datas['supp_name'],
			'supplier_address' => $datas['supp_address'],
			'supplier_phone' => $datas['supp_phone']
		);
		
		if($this->supplier->insert($data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Save data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Save data failed.');
		}
		
		redirect(site_url('supplier'));
	}
	
	public function update(){
		$datas = $this->input->post();
		$data = array(
			'supplier_code' => $datas['supp_code'],
			'supplier_name' => $datas['supp_name'],
			'supplier_address' => $datas['supp_address'],
			'supplier_phone' => $datas['supp_phone']
		);
		
		if($this->supplier->update_by_id((int)$datas['supp_id'], $data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Update data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Update data failed.');
		}
		
		redirect(site_url('supplier'));
	}
	
	public function delete(){
		$id = $this->input->get('id');
		if(isset($id)){
			if($this->supplier->delete_by_id((int)$id)){
				$this->session->set_flashdata('notif_status', TRUE);
				$this->session->set_flashdata('notif_msg', 'Data removed succesfully.');
			}else{
				$this->session->set_flashdata('notif_status', FALSE);
				$this->session->set_flashdata('notif_msg', 'Failed to remove data.');
			}
		}
		
		redirect(site_url('supplier'));
	}
}
