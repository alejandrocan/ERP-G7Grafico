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
		$datos['estado'] = 1;
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
		if($this->session->userdata('is_logued_in') ){
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
		$data['user']=$this->session->userdata('user');
		$data['title'] = "Sistema G7 Grafico";
		$this->load->view("vwHeader", $data);
		if($catal == "presentacion") {
			$this->load->view("catalogos/vwPresentacion");
		}

		if($catal == "proveedor"){
			$this->load->view("catalogos/vwProveedor");
		}
		if($catal == "producto") {
			$this->load->view("catalogos/vwProductos");
		}
		if($catal == "puesto") {
			$this->load->view("catalogos/vwPuesto");
		}
		if($catal == "familia") {
			$this->load->view("catalogos/vwFamilia");
		}
		if($catal == "departamento") {
			$this->load->view("catalogos/vwDepartamento");
		}
	}
	else
		redirect(login2);
		
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

	/* Agrega una funcion para insertar los datos en la tabla de presentación */
	public function insertPresentacion($tabla) {
		$datos['nombre'] = $this->input->post("nombre");

		$valor = $this->input->post("udm_pres");
		$query =  $this->db->get("udm");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->tipo_udm == $valor)
				$datos['udm_pres'] = $registro->id_udm;
				break;
		}

		
		$datos['contenido_pres'] = $this->input->post("contenido_pres");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}
	/* Agrega una funcion para insertar los datos en la tabla de producto*/
	public function insertProducto($tabla){
		$datos['nombre'] = $this->input->post("nombre");
		$datos['cantidad_produc'] = $this->input->post("cantidad");

		/*Busca el id de la unidad de medida seleccionada*/
		$valor = $this->input->post("udm");
		$query =  $this->db->get("udm");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->tipo_udm == $valor)
				$datos['udm_produc'] = $registro->id_udm;
				break;
		}
		$datos['costo_produc'] = $this->input->post("costo");

		/*Busca el id de la familia seleccionada*/
		$valor = $this->input->post("familia");
		$query =  $this->db->get("familia");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['familia_product'] = $registro->id_fam;
				break;
		}

		/*Busca el id del departamento seleccionado*/
		$valor = $this->input->post("departamento");
		$query =  $this->db->get("departamento");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre_depto == $valor)
				$datos['depto_produc'] = $registro->id_depto;
				break;
		}



		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
			redirect('catalogos/index/'. $tabla);
		}

	}
}