<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{
	// Log in
	// Read data using username and password
	public function login($data) {
		$condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function logout(){
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');

		// Set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');

		redirect('users/login');
	}

	public function signup($data){
		$condition = "username =" . "'" . $data['username'] . "'" . " OR " . "email =" . "'" . $data['email'] . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			//insert data
			$this->db->insert('user', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function read_username($username) {
		$condition = "username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();


		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function edit_profile($username, $secure_question, $secure_answer){
		$data = array(
			'secure_question' => $secure_question,
			'secure_answer' => $secure_answer,
		);

		$condition = "username =" . "'" . $username . "'";
		$this->db->where($condition);
		$this->db->update('user', $data);
	}

	public function finduser($username){
		$query = $this->db->get_where('user', array('username'=>$username));
		return $query->row_array();
	}

	public function set_new_pw($password, $username){
		$data = array(

			'password' => $password,

		);
		$condition = "username =" . "'" . $username . "'";
		$this->db->where($condition);
		$this->db->update('user', $data);
	}

	public function load_all_events(){
		$this->db->order_by('event_id');
		return $this->db->get('events');
	}

	function search($keyword){
		$this->db->like('title', $keyword);
		$query = $this->db->get('events');
		return $query->result();
	}

	public function getEvents($postData){

		$response = array();

		if(isset($postData['search']) ){
			// Select record
			$this->db->select('*');
			$this->db->where("title like '%".$postData['search']."%' ");

			$records = $this->db->get('events')->result();

			foreach($records as $row ){
				$response[] = array("label"=>$row->title);
			}

		}

		return $response;
	}

	/*function fetch_data($query){
		$this->db->like('title', $query);
		$query = $this->db->get('events');
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$output[] = array(
					'title' => $row['title']
				);
			}
			echo json_encode($output);
		}
	}*/

	public function sendEmail($to_email){
		$from_email = 'noreply@infs3202-dbe1acac.uqcloud.net';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User, <br/><br/>Please click on the below activation link to verify your email address.<br/><br/>
					https://infs3202-dbe1acac.uqcloud.net/infs3202_project/users/verify/'.md5($to_email).'<br/><br/><br/>Thanks<br/>Admin Team';
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mailhub.eait.uq.edu.au',
			'smtp_port' => 25,
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);

		//send mail
		$this->email->from($from_email);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}

	//activate user account
	public function verifyEmailID($key){
		$data = array('email_verified' => 'verified');
		$this->db->where('md5(email)', $key);
		return $this->db->update('user', $data);
	}
}
