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
<<<<<<< HEAD
=======

		if($catal == "udm"){
			$this->load->view("catalogos/vwUdm");
		}

		if($catal == "usuario"){
			$this->load->view("catalogos/vwUsuario");
		}

>>>>>>> 7343df8e60c3cc9b3089d5196a8cf4391c451dcf
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
		if($catal == "material") {
			$this->load->view("catalogos/vwMaterial");
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

		public function disabled($tabla, $id){
		$this->load->model("registros_model");
		if($this->registros_model->disabledRegister($tabla, $id) ){
			redirect('catalogos/index/'. $tabla);
		}
		else{
			return false;
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de puesto */
	public function insertPuesto($tabla) {
		$datos['nombre'] = $this->input->post("nombre");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

	public function insertUdm($tabla) {

		$datos['nombre'] = $this->input->post('Nombre');
		$datos['tipo_udm'] = $this->input->post('Tipo');
		$datos['estado'] = 1;
		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de departamento */
	public function insertDepartamento($tabla) {
		$datos['nombre_depto'] = $this->input->post("nombre");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

/* Agrega una funcion para insertar los datos en la tabla de familia */
	public function insertFamilia($tabla) {
		$datos['nombre'] = $this->input->post("nombre");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de UDM */
	public function insertPresentacion($tabla) {
		$datos['nombre'] = $this->input->post("nombre");
		$valor = $this->input->post("udm_pres");
		$query =  $this->db->get("udm");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
			{
				$datos['udm_pres'] = $registro->id_udm;
				break;
			}
		}
		$datos['contenido_pres'] = $this->input->post("contenido_pres");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

		/* Agrega una funcion para insertar los datos en la tabla de presentación */
	public function insertUsuario($tabla) {
		$datos['nombre'] = $this->input->post('Nombre');
		$datos['contra_usr'] = MD5($this->input->post('Contrasena'));
		$datos['nombre_usr'] = $this->input->post('Nombre1');
		$datos['nombre2_usr'] = $this->input->post('Nombre2');
		$datos['apellidop_usr'] = $this->input->post('Apellido1');
		$datos['apellidom_usr'] = $this->input->post('Apellido2');
		$datos['correo_usr'] = $this->input->post('Correo');
		$datos['tipo_usr'] = $this->input->post('Tipo');

		$valor = $this->input->post("Departamento");
		$query =  $this->db->get("departamento");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre_depto == $valor)
			{
				$datos['depto_usr'] = $registro->id_depto;
				break;
			}
		}

		$valor = $this->input->post("Puesto");
		$query =  $this->db->get("puesto");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
			{
				$datos['id_puesto'] = $registro->id_puesto;
				break;
			}
		}

		$datos['imagen'] = $this->input->post('Imagen');
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
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
			if($registro->nombre == $valor)
			{
				$datos['udm_produc'] = $registro->id_udm;
				break;
			}
		}

		/*Busca el id de la familia seleccionada*/
		$valor = $this->input->post("familia");
		$query =  $this->db->get("familia");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
<<<<<<< HEAD
=======
			{
>>>>>>> 7343df8e60c3cc9b3089d5196a8cf4391c451dcf
				$datos['familia_produc'] = $registro->id_fam;
				break;
			}
		}

		/*Busca el id del departamento seleccionado*/
		$valor = $this->input->post("departamento");
		$query =  $this->db->get("departamento");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre_depto == $valor)
			{
				$datos['depto_produc'] = $registro->id_depto;
				break;
			}
		}



		$datos['estado'] = 1;
		$data['user']=$this->session->userdata('user');
		$data['title'] = "Sistema G7 Grafico";
		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
			$this->load->view("vwHeader", $data);
			$this->load->view("catalogos/vwAddMaterial");
		}

	}

	public function insertMaterial($tabla){
		$datos['nombre'] = $this->input->post("nombre");

		/*Busca el id de la unidad de medida seleccionada*/
		$valor = $this->input->post("udm_material");
		$query =  $this->db->get("udm");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['udm_material'] = $registro->id_udm;
				break;
		}

		/*Busca el id de la familia seleccionada*/
		$valor = $this->input->post("proveedor_material");
		$query =  $this->db->get("proveedor");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['proveedor_material'] = $registro->id_proveedor;
				break;
		}

		/*Busca el id del departamento seleccionado*/
		$valor = $this->input->post("presentacion");
		$query =  $this->db->get("presentacion");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['presentacion'] = $registro->id_pres;
				break;
		}


		$datos['clave'] = $this->input->post("clave");
		$datos['smax'] = $this->input->post("smax");
		$datos['smin'] = $this->input->post("smin");
		$datos['factor_redimiento'] = $this->input->post("factor_redimiento");
		$datos['cantidad'] = $this->input->post("cantidad");
		$datos['ultimo_costo'] = $this->input->post("ultimo_costo");
		$datestring = "%Y-%m-%d %h:%i:00";
		$time = time();
		$datos['fecha_cotiza'] = mdate($datestring,$time);
		$datos['ultima_edicion'] = mdate($datestring,$time);
		$datos['usr_edicion'] = $this->session->userdata('id_usr');
		$datos['tiempo_elaboracion'] = $this->input->post("tiempo_elaboracion");
		$datos['orden_cronologico'] = $this->input->post("orden_cronologico");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}

	public function updateMaterial($tabla){
		$datos['id_material'] = $this->input->post("id_material");
		$datos['nombre'] = $this->input->post("nombre");

		/*Busca el id de la unidad de medida seleccionada*/
		$valor = $this->input->post("udm_material");
		$query =  $this->db->get("udm");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['udm_material'] = $registro->id_udm;
				break;
		}

		/*Busca el id de la familia seleccionada*/
		$valor = $this->input->post("proveedor_material");
		$query =  $this->db->get("proveedor");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['proveedor_material'] = $registro->id_proveedor;
				break;
		}

		/*Busca el id del departamento seleccionado*/
		$valor = $this->input->post("presentacion");
		$query =  $this->db->get("presentacion");
		$registros = $query->result();
		foreach ($registros as $registro ) {
			if($registro->nombre == $valor)
				$datos['presentacion'] = $registro->id_pres;
				break;
		}


		$datos['clave'] = $this->input->post("clave");
		$datos['smax'] = $this->input->post("smax");
		$datos['smin'] = $this->input->post("smin");
		$datos['factor_redimiento'] = $this->input->post("factor_redimiento");
		$datos['cantidad'] = $this->input->post("cantidad");
		$datos['ultimo_costo'] = $this->input->post("ultimo_costo");
		$datestring = "%Y-%m-%d %h:%i:00";
		$time = time();
		$datos['fecha_cotiza'] = mdate($datestring,$time);
		$datos['ultima_edicion'] = mdate($datestring,$time);
		$datos['usr_edicion'] = $this->session->userdata('id_usr');
		$datos['tiempo_elaboracion'] = $this->input->post("tiempo_elaboracion");
		$datos['orden_cronologico'] = $this->input->post("orden_cronologico");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->editar($datos, $tabla)) {
			redirect('catalogos/index/'. $tabla);
		}
	}
}