<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class Registros_model extends  CI_Model {
		
		public function mostrar($tabla){
			$id = $this->db->list_fields($tabla);
			foreach ($id as $valor) {
				$this->db->order_by($valor . ' asc');
				break;
			}
			
			$registro = $this->db->get($tabla);
			return $registro->result();
		}

		public function disabledRegister ($tabla, $id){
			$columns = $this->db->list_fields($tabla);
			foreach ($columns as $column) {
				$id_columns = $column;
				break;
			}
			if($this->db->query("update ". $tabla. ' set estado = 0 where '. $id_columns . ' = '. $id)) {
				return true;
			}
			else{
				return false;
			}
		}

		public function enabledRegister($tabla, $id) {
			$columns = $this->db->list_fields($tabla);
			foreach ($columns as $column) {
				$id_columns = $column;
				break;
			}
			if($this->db->query("update ". $tabla. ' set estado = 1 where '. $id_columns . ' = '. $id)) {
				return true;
			}
			else{
				return false;
			}
		}


}

