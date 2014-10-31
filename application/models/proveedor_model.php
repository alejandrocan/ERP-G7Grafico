<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class Proveedor_model extends  CI_Model {

	public function insertar($datos){
		if($this->db->insert('proveedor', $datos))
			return true;
		else
			return false;
	}

	public function mostrar(){
		$id = $this->db->list_fields("proveedor");
		$this->db->order_by('id_proveedor asc');
		//$this->db->order_by('estado desc');
		
		$registro = $this->db->get("proveedor");
		return $registro->result();
	}
}