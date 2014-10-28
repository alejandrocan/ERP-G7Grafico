<?php

/**
* G7 Gráfico
* Author: Marco Antonio Maciel Tuz
* Description: Carga la vista de UDM
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Udm extends CI_Controller {

	public function insertarRegistro()
	{
		$datos['nombre'] = $this->input->post('Nombre');
		$datos['tipo_udm'] = $this->input->post('Tipo');
		$datos['estado'] = 1;

		$this->load->model('udm_model');
		if($this->udm_model->insertar($datos))
		{
			$mensaje = '<div class="alert alert-success alert-demissable">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
  				<strong>¡Hecho!</strong> Haz agregado un nuevo Registro.
			 	</div>';
		}
		else
		{
			$mensaje = '<div class="alert alert-danger alert-demissable">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
  				<strong>¡Upps!</strong> Inserción no realizada. Intente de nuevo.
			 	</div>';
		}
		redirect('udm');
	}

	public function index(){
		$data['catalogo'] = "udm";
		$this->load->model("udm_model");
		$this->load->model("registros_model");
		$data['registros']= $this->udm_model->mostrar();		
		$data['columnas'] = $this->registros_model->get_columns('udm');
		$data['foraneas'] = $this->registros_model->get_foreignColumns('udm');
		$data['tablasF'] = $this->registros_model->get_referencedTables('udm');
		$data['referencias'] = $this->registros_model->get_referencedColumns('udm');

		$this->load->view("catalogos/vwHeader", $data);
		$this->load->view("vwUdm");	

	}
}
