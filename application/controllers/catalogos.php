<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {
	public function insertarRegistro($tabla)
	{
		$columnas = $this->db->list_fields($tabla);
		$cont = 1;
		$datos;
		foreach ($columnas as $columna) {
			if($cont != 1)
			{
				$datos[$columna] = $this->input->post($columna);
				//$datos = array($columna => $this->input->post($columna));
			}
			$cont += 1;
		}

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla))
		{
			redirect('catalogos/index/'.$tabla);
		}
		else
		{

		}
	}

	public function index($catal) {
		$data['catalogo'] = $catal;

		$this->load->model("registros_model");		
		$data['registros']= $this->registros_model->mostrar($catal);		
		
		if($this->uri->segment(4) != ''){
			$id = $this->uri->segment(4);
			if($this->registros_model->disabledRegister($catal, $id)) {
				redirect('catalogos/index/'. $catal);
			}
			else{
				echo "error";
			}
		}

		$data['registros']= $this->registros_model->mostrar($catal);
		$data['columnas'] = $this->registros_model->get_columns($catal);
		$data['foraneas'] = $this->registros_model->get_foreignColumns($catal);
		$data['tablasF'] = $this->registros_model->get_referencedTables($catal);
		$data['referencias'] = $this->registros_model->get_referencedColumns($catal);

		$this->load->view("catalogos/vwHeader", $data);
		$this->load->view("catalogos/vwCatalogoSelected");		
		
	}


	public function enabled($tabla, $id){
		$this->load->model("registros_model");
		if($this->registros_model->enabledRegister($tabla, $id) ){
			redirect('catalogos/index/'. $tabla);
		}
		else{
			return false;
		}
	}
}