<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

	class Registros_model extends  CI_Model{
		

		public function mostrar($tabla){
			$id = $this->db->list_fields($tabla);
			foreach ($id as $valor) {
				$this->db->order_by($valor . ' asc');
				break;
			}
			
			$registro = $this->db->get($tabla);
			return $registro->result();
		}
	}

