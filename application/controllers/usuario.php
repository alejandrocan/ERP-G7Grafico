<?php

/**
* G7 Gráfico
* Author: Marco Antonio Maciel Tuz
* Description: Carga la vista de UDM
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Usuario extends CI_Controller {

		public function insertarRegistro()
	{

		$datos['nombre'] = $this->input->post('Nombre');
		$datos['contra_usr'] = $this->input->post('Contrasena');
		$datos['nombre_usr'] = $this->input->post('Nombre1');
		$datos['nombre2_usr'] = $this->input->post('Nombre2');
		$datos['apellidop_usr'] = $this->input->post('Apellido1');
		$datos['apellidom_usr'] = $this->input->post('Apellido2');
		$datos['correo_usr'] = $this->input->post('Correo');
		$datos['tipo_usr'] = $this->input->post('Tipo');
		$datos['depto_usr'] = $this->input->post('Departamento');
		$datos['id_puesto'] = $this->input->post('Puesto');
		$datos['imagen'] = $this->input->post('Imagen');
		$datos['estado'] = 1;
		$this->load->model('usuario_model');
		if($this->usuario_model->insertar($datos))
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
		redirect('usuario');
	}

	public function index(){
		$data['catalogo'] = "usuario";
		$this->load->model("usuario_model");
		$this->load->model("registros_model");
		$data['registros']= $this->usuario_model->mostrar();		
		$data['columnas'] = $this->registros_model->get_columns('usuario');
		$data['foraneas'] = $this->registros_model->get_foreignColumns('usuario');
		$data['tablasF'] = $this->registros_model->get_referencedTables('usuario');
		$data['referencias'] = $this->registros_model->get_referencedColumns('usuario');

		$this->load->view("catalogos/vwHeader", $data);
		$this->load->view("/catalogos/vwUsuario");	
	}
}