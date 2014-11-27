<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete_model extends CI_Model {

	function __construct() {
		parent:: __construct();
	}

	function get_data($item, $match) {

		/*Hace un consulta con el valor en match*/
		$this->db->like($item, $match);
		$query = $this->db->get('material');
		$query = $query->result();
		$this->db->like($item, $match);
		$query2 = $this->db->get('producto');
		$query2 = $query2->result();
		$j = 0;
		/*se guardan los registros en un arreglo*/
		foreach ($query as $valor) {
			$arreglo[$j] =$valor->nombre;
			$j++;
		}
		foreach ($query2 as $valor) {
			$arreglo[$j] =$valor->nombre;
			$j++;
		}
		
		

		return $arreglo;
	}

	function get_data_producto($item, $match) {
		$this->db->like($item, $match);
		$query = $this->db->get('producto');

		return $query->result();
	}
}