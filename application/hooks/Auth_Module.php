<?php

class Auth_Module {
	private $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
	}

	function check_user_login(){
		if(!$this->CI->session->is_loggin-in)
			//if no session found redirect to login page
			redirect(site_url('login'));
	}
}
