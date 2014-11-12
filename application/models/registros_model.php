<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class Registros_model extends  CI_Model {
		
		public function insertar($datos,$tabla)
		{
			if($this->db->insert($tabla, $datos))	
				return true;
			else
				return false;
		}

		public function editar($datos,$tabla)
		{
        	$this->db->where('id_material', $datos['id_material']);
			if($this->db->update($tabla, $datos))	
				return true;
			else
				return false;
		}

		public function mostrar($tabla){
			$id = $this->db->list_fields($tabla);
			foreach ($id as $valor) {
				$this->db->order_by($valor . ' asc');
				break;
			}
			
			$registro = $this->db->get($tabla);
			return $registro->result();
		}



		public function get_foreignColumns($tabla){
			$foraneas = $this->db->query("select table_name,column_name,referenced_table_name,referenced_column_name from information_schema.key_column_usage where constraint_schema='kardex' and referenced_table_name = '".$tabla."' and table_name != '';");
			return $foraneas->result();
		}

		public function get_referencedColumns($tabla){
			$referencias = $this->db->query("select referenced_column_name from information_schema.key_column_usage where constraint_schema='kardex' and referenced_table_name != '' and table_name = '".$tabla."';");
			return $referencias;
		}

		public function get_referencedTables($tabla){
			$tablasForaneas = $this->db->query("select referenced_table_name from information_schema.key_column_usage where constraint_schema='kardex' and referenced_table_name != '' and table_name = '".$tabla."';");
		}

		public function disabledRegister ($tabla, $id){
			$columns = $this->db->list_fields($tabla);
			foreach ($columns as $column) {
				$id_columns = $column;
				break;
			}
			$columnas_foraneas = $this->registros_model->get_foreignColumns($tabla);
			foreach ($columnas_foraneas as $cf) {
				$col_for = $this->db->query("select ".$cf->referenced_column_name." from ".$cf->referenced_table_name." where ".$id_columns." = ".$id.";");
				$col_for = $col_for->result();
				$columna = $cf->referenced_column_name;
				$foreaneas = $this->db->query("select ".$cf->column_name." from ".$cf->table_name.";");
				$foreaneas = $foreaneas->result();
				$foranea = $cf->column_name;
				foreach ($col_for as $c) {
					foreach ($foreaneas as $f) {
						if($f->$foranea == $c->$columna)
							return false;
					}
				}
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

		public function get_columns($tabla){
			$columnas = $this->db->list_fields($tabla);
			return $columnas;
		}

	}




