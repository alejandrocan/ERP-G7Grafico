
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
		foreach ($id as $valor) {
			$this->db->order_by($valor . ' asc');
			break;
		}
		
		$registro = $this->db->get("udm");
		return $registro->result();
	}
}
