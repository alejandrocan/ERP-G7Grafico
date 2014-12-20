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
	function get_data_producto() {
		$match = $this->input->get('term', TRUE);
		$item = $this->input->get('item', TRUE);

		$data['item'] = $item;
		$data['results'] = $this->Autocomplete_Model->get_data_producto($item,$match);
		

		$this->load->view('data', $data);
	}
	function get_udm() {
		$elemento = $this->input->post('elemento');
		$query = $this->db->get_where('material', array('nombre' => $elemento));
		$query = $query->result();
		
		$respuesta = new stdClass();
		foreach ($query as $valor) {
			$respuesta->nombre = $valor->udm_material;
		}

		echo json_encode($respuesta); 
	}
}