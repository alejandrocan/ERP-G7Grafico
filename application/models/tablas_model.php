<?php
if (! defined('BASEPATH') )
	exit("No direct script access allowed");

class Tablas_model extends CI_Model {

	public function mostrarTablas() {
		$tablas = $this->db->list_tables();
		return $tablas;
	}

}