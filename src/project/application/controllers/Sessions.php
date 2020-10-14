<?php
// Show login page
class sessions extends CI_Controller{
	public function demo(){
		if ($this->session->userdata('view1')){
			$this->session->set_userdata('view1', $this->session->userdata('view1')+1);
		}else{
			$this->session->set_userdata('view1', 1);
		}

		if ($this->session->userdata('view2')){
			$this->session->set_userdata('view2', $this->session->userdata('view2')+1);
		}else{
			$this->session->set_userdata('view2', 1);
		}
		$data['title'] = 'Session Demo';
		$data['view1'] = $this->session->userdata('view1');
		$data['view2'] = $this->session->userdata('view2');
		$this->load->view('templates/header');
		$this->load->view('sessiondemos/session_view',$data);
		$this->load->view('templates/footer');
	}
	public function destory(){
		$this->session->sess_destroy();
		$data['title'] = 'Session Demo';
		$data['view1'] = $this->session->userdata('view1');
		$data['view2'] = $this->session->userdata('view2');
		$this->load->view('templates/header');
		$this->load->view('sessiondemos/session_view',$data);
		$this->load->view('templates/footer');
	}
	public function unset(){
		$this->session->unset_userdata('view1');
		$data['title'] = 'Session Demo';
		$data['view1'] = $this->session->userdata('view1');
		$data['view2'] = $this->session->userdata('view2');
		$this->load->view('templates/header');
		$this->load->view('sessiondemos/session_view',$data);
		$this->load->view('templates/footer');
	}
}


