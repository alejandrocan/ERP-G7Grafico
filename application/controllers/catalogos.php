<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {

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