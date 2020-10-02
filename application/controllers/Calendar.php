<?php
// Show login page
class Calendar extends CI_Controller
{
	//load calendar
	public function load(){
		$event_data = $this->users_model->load_all_events();
		foreach($event_data->result_array() as $row)
		{
			$data[] = array(
				'event_id' => $row['event_id'],
				'title' => $row['title'],
				'start' => $row['start_date'],
				'end' => $row['end_date']
			);
		}
		echo json_encode($data);
	}


	function update()
	{
		if($this->input->post('id'))
		{
			$data = array(
				'title'   => $this->input->post('title'),
				'start_event' => $this->input->post('start'),
				'end_event'  => $this->input->post('end')
			);

			$this->calendar_model->update_event($data, $this->input->post('id'));
		}
	}

	public function add_event_form(){
		$this->load->view('templates/header');
		$this->load->view('add_event_form');
	}
	function add(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('start', 'Start Date', 'required');
		$this->form_validation->set_rules('end', 'End Date', 'required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('add_event_form');
		}else{
			$data = array(
				'title' => $this->input->post('title'),
				'location' => $this->input->post('location'),
				'start_date' => $this->input->post('start'),
				'end_date' => $this->input->post('end')
			);
			$result = $this->calendar_model->add_event($data);
			if ($result == TRUE) {
				$data['message_display'] = 'Event added!';
				$this->load->view('templates/header');
				$this->load->view('calendar_home', $data);
			} else {
				$data['message_display'] = 'An event already existed at chosen time.';
				$this->load->view('templates/header');
				$this->load->view('calendar_home', $data);
			}
		}
	}

	public function edit_event_form(){
		$this->load->view('templates/header');
		$this->load->view('edit_event_form');
	}
	function edit(){
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		if($this->calendar_model->edit_event($id, $title, $start, $end)){
			echo "Event updated.";
		};
	}

	public function delete_event_form(){
		$this->load->view('templates/header');
		$this->load->view('delete_event_form');
	}
	function delete(){
		$id = $this->input->post('id');
		$this->calendar_model->delete_event($id);
		$this->load->view('templates/header');
		$this->load->view('calendar_home');
	}

	public function add_vote(){
		$selected = $this->input->post('poll_option');
		$this->calendar_modal->add_vote($selected);
		echo json_encode($selected);
	}


}
