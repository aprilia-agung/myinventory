<?php
if ( ! function_exists('login_check')){
	function login_check($redirect = false){
		$CI = & get_instance();
		if($CI->session->userdata('user_login') === true){
			return true;
		}else{
			if($redirect == true){
				redirect(base_url().'index.php/login');
			}
			return false;
		}
	}
}

?>