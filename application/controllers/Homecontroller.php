<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Homecontroller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('validated')) {
			redirect('admin/login/index');
		}
	}

	public function index()
	{
		$data['_view'] = 'calendar_home';
		$this->load->view('templates/body', $data);
	}
}
