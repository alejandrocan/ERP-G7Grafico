<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete_model extends CI_Model {

	function __construct() {
		parent:: __construct();
	}

	function get_data($item, $match) {

		/*Hace un consulta con el valor en match*/
		$this->db->like($item, $match);
		$query = $this->db->get_where('material', array('estado' => '1'));
		$query = $query->result();

		$this->db->like($item, $match);
		$query2 = $this->db->get_where('producto', array('estado' => '1'));
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
		$query = $this->db->get_where('producto', array('estado' => '1'));
		$query = $query->result();
		$j = 0;
		foreach ($query as $valor) {
			$registros[$j] = $valor->nombre;
			$j++;
		}

		return $registros;
	}
	function get_data_udm() {
		
	}
}