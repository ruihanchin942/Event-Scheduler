<?php

class Calendar_model extends CI_Model
{
	function fetch_all_event(){
		$this->db->order_by('id');
		return $this->db->get('events');
	}

	function insert_event($data)
	{
		$this->db->insert('events', $data);
	}

	function update_event($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('events', $data);
	}

	function add_event($data){
		$start1 = date_create_from_format('Y-m-d H:i:s', 'start_date');
		$this->db->select('start_date');
		$this->db->from('events');
		$this->db->where('start_date', $start1);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			//insert data
			$this->db->insert('events', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	function edit_event($id, $title, $start, $end){
		$start_date = date_create_from_format('Y-m-d H:i:s', $start);
		$end_date = date_create_from_format('Y-m-d H:i:s', $end);
		$data = array(
			'title' => $title,
			'start_date' => $start_date,
			'end_date' => $end_date
		);
		$this->db->where('event_id', $id);
		$this->db->update('events', $data);
	}

	function delete_event($id)
	{

		$this->db->where('event_id', $id);
		$this->db->delete('events');
	}

	function load_poll(){
		$query = $this->db->get('poll');
		return $query->result();
	}

}
?>
