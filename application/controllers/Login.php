<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('admin');
	}

	public function index(){
		if(login_check()){
			redirect(site_url('dashboard'));
		}
		
		$data = array();
		$data['title'] 		= 'Login';
		$this->load->view('login_view', $data);
	}

	public function signin(){
		$data = $this->input->post();
		$this->load->model('User_model', 'user');
		$user = $this->user->get_by_username($data['username'])->row_array();
		// check user exist
		if(!empty($user)){
			if($user['password'] === md5($data['password'])){
				$this->session->set_userdata('user_login', true);
				$this->session->set_userdata('name', $user['name']);
			}else{
				$this->session->set_flashdata('notif_status', false);
				$this->session->set_flashdata('notif_msg', 'User & password missmatch');
			}
		}else{
			$this->session->set_flashdata('notif_status', false);
			$this->session->set_flashdata('notif_msg', 'User not registered');
		}
		redirect(site_url('login'));
	}

	public function signout(){
		$this->session->set_userdata('user_login', false);
		$this->session->sess_destroy();
		$this->db->close();
		
		$this->session->set_flashdata('notif_status', true);
		$this->session->set_flashdata('notif_msg', "You're logout now.");
		redirect(site_url('login'));
	}


}
