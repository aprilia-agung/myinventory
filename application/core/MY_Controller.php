<?php

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
}

class Admin_Controller extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('admin');
		login_check(true);
	}
	
	public function load_template($content){
		$this->load->view('index', $content);
	}
}
?>