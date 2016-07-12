<?php
class User_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_by_username($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('user');
	}
}
?>