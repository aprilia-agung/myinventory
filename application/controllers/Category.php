<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Category_model', 'cat');
	}

	public function index(){
		$data = array();
		$data['title'] 		= 'Category';
		$data['content']	= '/content/category/index';
		$data['category']	= $this->cat->get_all()->result_array();
		$this->load_template($data);
	}
	
	public function add(){
		$data['title'] 		= 'Add Category';
		$data['state']		= 'add';
		$data['action']		= 'insert';
		$data['content']	= '/content/category/form';
		$this->load_template($data);
	}
	
	public function edit(){
		$id = $this->input->get('id');
		if(isset($id)){
			$data['title'] 		= 'Edit Category';
			$data['state']		= 'edit';
			$data['action']		= 'update';
			$data['category']	= $this->cat->get_by_id((int)$id)->row_array();
			$data['content']	= '/content/category/form';
			$this->load_template($data);
		}else{
			redirect(site_url('category'));
		}
	}
	
	public function insert(){
		$datas = $this->input->post();
		$data = array(
			'category_code' => $datas['cat_code'],
			'category_name' => $datas['cat_name']
		);
		
		if($this->cat->insert($data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Save data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Save data failed.');
		}
		
		redirect(site_url('category'));
	}
	
	public function update(){
		$datas = $this->input->post();
		$data = array(
			'category_code' => $datas['cat_code'],
			'category_name' => $datas['cat_name']
		);
		
		if($this->cat->update_by_id((int)$datas['cat_id'], $data)){
			$this->session->set_flashdata('notif_status', TRUE);
			$this->session->set_flashdata('notif_msg', 'Update data successfully.');
		}else{
			$this->session->set_flashdata('notif_status', FALSE);
			$this->session->set_flashdata('notif_msg', 'Update data failed.');
		}
		
		redirect(site_url('category'));
	}
	
	public function delete(){
		$id = $this->input->get('id');
		if(isset($id)){
			if($this->cat->delete_by_id((int)$id)){
				$this->session->set_flashdata('notif_status', TRUE);
				$this->session->set_flashdata('notif_msg', 'Data removed succesfully.');
			}else{
				$this->session->set_flashdata('notif_status', FALSE);
				$this->session->set_flashdata('notif_msg', 'Failed to remove data.');
			}
		}
		
		redirect(site_url('category'));
	}
}
