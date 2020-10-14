<?php
class MainModel extends CI_Model{
	public function first_query(){
		$query = $this->db->get('user');
		return $query->result();
	}

	public function insert_data($username, $password){
		$data = array(
			'username' => $username,
			'password' => $password,
		);

		$this->db->insert('user', $data);
	}
}
?>
