<?php
if(!defined('BASEPATH') )
	exit('No direct script access allowed');
class Tabla_model extends CI_Model {

	public function mostrar_tabla() {
		$tabla = $this->db->list_tables();
		return $tabla;
	}
}