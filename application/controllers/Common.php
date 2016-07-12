<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends Admin_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		redirect(site_url('dashboard'));
	}

	public function generate_barcode(){
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code128', 'image', array('text' => $this->input->get('code')), array());
	}

	public function get_product(){
		if (!$this->input->is_ajax_request()) {
			redirect(base_url());
		}

		$this->load->model('product_model', 'product');
		$a = $this->product->get_by_name($this->input->get('query'))->result_array();
		$arr['suggestions'] = array();
		foreach ($a as $value) {
			array_push($arr['suggestions'], array('value' => $value['product_name'], 'data' => $value['product_id']));
		}

		echo json_encode($arr);
	}
}