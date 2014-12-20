<?php
if(!defined('BASEPATH') )
	exit('No direct script access allowed');
class Tabla_model extends CI_Model {

	public function mostrar_tabla() {
		$tabla = $this->db->list_tables();
		return $tabla;
	}

	public function editQuantity($datos){
		$this->db->where('id',$datos["id"]);
		if($this->db->update('explosion',$datos)){
			return true;
		}
		else{
			return false;
		}
	}

	public function removeProduct($id){
		
		if($this->db->delete('explosion', array('id' => $id))){
			return true;
		}
		else{
			return false;
		}
	}
}