<?php

class Autocompletar extends CI_Controller {
	
	function __construct() {
		parent:: __construct();
		$this->load->library('table');
		$this->load->model('Autocomplete_Model');
	}

	function get_data() {
		$match = $this->input->get('term', TRUE);
		$item = $this->input->get('item', TRUE);

		$data['item'] = $item;
		$data['results'] = $this->Autocomplete_Model->get_data($item,$match);
		

		$this->load->view('data', $data);
	}
}