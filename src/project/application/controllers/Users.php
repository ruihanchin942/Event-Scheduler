<?php
// Show login page
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->view('templates/header');
		$this->load->model('Users_model');
	}

	public function index(){
		$this->load->view('login_form');
		$this->load->view('templates/footer');
		//$this->load->view('calendar_home');
	}

	public function test(){
		$this->load->view('mainpage');
	}

	public function signupform(){
		$this->load->view('signup_form');
		$this->load->view('templates/footer');
	}
	public function signup()
	{
		$this->load->library('encryption');
		//check validation
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_valid_password');
		$this->form_validation->set_rules('secure_question', 'Security Question', 'trim|required');
		$this->form_validation->set_rules('secure_answer', 'Security Answer', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('signup_form');
		} else {
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'password' => $this->encryption->encrypt($this->input->post('password')),
					'secure_question' => $this->input->post('secure_question'),
					'secure_answer' => $this->input->post('secure_answer'),
				);
				$result = $this->users_model->signup($data);
				if ($result == TRUE) {
					$data['message_display'] = 'Registration Successfully !';
					$this->load->view('login_form', $data);
				} else {
					$data['message_display'] = 'Username or Email Address already exist!';
					$this->load->view('signup_form', $data);
				}
		}
		$this->load->view('templates/footer');
	}

	public function verify($hash=NULL){
		if($this->users_model->verifyEmailID($hash)){
			$data['message_display'] = 'Email successfully verified!';
			$this->load->view('login_form', $data);
		}else{
			$data['message_display'] = 'Sorry! There is error verifying your Email Address!';
			$this->load->view('login_form', $data);
		}
	}

	public function valid_password($password)
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		}
		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}
		return TRUE;
	}


	public function login($code)
	{
		$captcha = $this->input->post('code');

		//retrieve session data
		$session_set_value = $this->session->all_userdata();

		if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
			$this->load->view('calendar_home');
		} else {
			//check validations
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				if (isset($this->session->userdata['logged_in'])) {
					$data['code'] = $code;
					$this->load->view('calendar_home', $data);
				} else {
					$this->load->view('login_form');
				}
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$result = $this->users_model->login($data);

				if ($result == TRUE && $code == $captcha) {
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$result = $this->users_model->read_username($username);
					if ($result != false) {
						$remember = $this->input->post('remember_me');
						if ($remember){
							//cookie value
							$this->input->set_cookie('username', $username, '86500');
							$this->input->set_cookie('password', $password, '86500');
							echo 'remember me cookie added';

						}else{
							delete_cookie("username"); //delete username cookie
							delete_cookie('password'); // delete password cookie
							echo 'remember me cookie deleted';
						}
						//create session
						$user_data = array(
							'username' => $result[0]->username,
							'password' => $result[0]->password,
							'lastlogin' => time()
						);
						// Add user data in session
						$this->session->set_userdata('logged_in', $user_data);
						$this->load->view('calendar_home');
					}
				}else if($code != $captcha){
					$data = array(
						'error_message' => 'Invalid Captcha'
					);
					$this->load->view('login_form', $data);
				} else {
					$data = array(
						'error_message' => 'Invalid Username or Password'
					);
					$this->load->view('login_form', $data);
				}
			}
		}
		$this->load->view('templates/footer');
	}

	// Logout from user's home page
	public function logout() {
	// Removing session data
		$sess_array = array(
			'username' => '',
			'password' => '',
		);
		//$data = ['username', 'password', 'last_login_timestamp']
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->load->view('login_form');
	}

	public function forgotpwform(){
		$this->load->view('forgotpw');
	}
	public function forgotpw(){
		if (!empty($_POST['username'])){
			$username = $this->input->post('username');
			$result = $this->users_model->finduser($username);
			if ($result == TRUE){
				$data['row'] = $result;
				$this->load->view('answer_form', $data);
			}else{
				echo "Username Invalid/Not Exist";
			}
		}
	}

	public function answerform(){
		$this->load->view('answer_form');
	}
	public function validate_ans($answer, $username){

		$password = $this->input->post('password');//retrieve user input value for new password

		$ans = $this->input->post('answer');
		if ($ans == $answer) {
			$this->users_model->set_new_pw($password, $username);
			$this->form_validation->set_message('validate_ans', 'New Password Changed.');
		} else if ($ans != $answer) {
			$data = array(
				'error_message' => 'Incorrect Answer.'
			);
			$this->load->view('login_form', $data);
		}

	}

	public function userprofile($username){
		$data['username'] = $username;
		$this->load->view('userprofile', $data);
	}
	public function profileupdate($username){
		$secure_question=$this->input->post('ques');
		$secure_answer=$this->input->post('ans');
		$this->Users_model->edit_profile($username, $secure_question, $secure_answer);
		echo 'Profile Updated';
	}

	function search_keyword(){
		/*$query = $this->input->get('query');
		$this->db->like('title', $query);
		$data = $this->db->get("events")->result();
		echo json_encode($data);*/
		$keyword = $this->input->post('keyword');
		$data['results'] = $this->users_model->search($keyword);
		$this->load->view('search_result', $data);
	}

	/*function fetch(){
		echo $this->users_model->fetch_date($this->uri->segment(3));
	}*/

	public function eventList(){
		//post data
		$postData = $this->input->post();

		//get data
		$data = $this->users_model->getEvents($postData);

		echo json_encode($data);
	}


}

