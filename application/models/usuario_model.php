<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class Usuario_model extends  CI_Model {

	public function insertar($datos){
		if($this->db->insert('usuario', $datos))
			return true;
		else
			return false;
	}

	public function mostrar(){
		$id = $this->db->list_fields("usuario");
		$this->db->order_by('id_usr asc');
		
		$registro = $this->db->get("usuario");
		return $registro->result();
	}
}
