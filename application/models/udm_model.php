
<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class Udm_model extends  CI_Model {

	public function insertar($datos){
		if($this->db->insert('udm', $datos))
			return true;
		else
			return false;
	}

	public function mostrar(){
		$id = $this->db->list_fields("udm");
		$this->db->order_by('id_udm asc');
		//$this->db->order_by('estado desc');
		
		$registro = $this->db->get("udm");
		return $registro->result();
	}
}
