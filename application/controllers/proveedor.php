<?php

/**
* G7 Gráfico
* Author: Marco Antonio Maciel Tuz
* Description: Carga la vista de UDM
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Proveedor extends CI_Controller {

		public function insertarRegistro()
	{

		$datos['nombre'] = $this->input->post('Nombre');
		$datos['dir_prove'] = $this->input->post('Direccion');
		$datos['tel_prove'] = $this->input->post('Telefono');
		$datos['correo_prove'] = $this->input->post('Correo');
		$datos['contacto'] = $this->input->post('Contacto');
		$datos['estado'] = 1;
		$this->load->model('proveedor_model');
		if($this->proveedor_model->insertar($datos))
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
		redirect('proveedor');
	}

	public function index(){
		$data['catalogo'] = "proveedor";
		$this->load->model("proveedor_model");
		$this->load->model("registros_model");
		$data['registros']= $this->proveedor_model->mostrar();		
		$data['columnas'] = $this->registros_model->get_columns('proveedor');
		$data['foraneas'] = $this->registros_model->get_foreignColumns('proveedor');
		$data['tablasF'] = $this->registros_model->get_referencedTables('proveedor');
		$data['referencias'] = $this->registros_model->get_referencedColumns('proveedor');

		$this->load->view("catalogos/vwHeader", $data);
		$this->load->view("/catalogos/vwProveedor");	
	}
}