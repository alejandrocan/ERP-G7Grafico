<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function insertarRegistro($tabla)
	{
		$columnas = $this->db->list_fields($tabla);
		$cont = 1;
		$datos;
		foreach ($columnas as $columna) {
			if($cont != 1)
			{
				$datos[$columna] = $this->input->post($columna);
			}
			$cont += 1;
		}
		$datos['estado'] = 1;
		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla))
		{
			$this->index($tabla,null);
		}
		else
		{

		}
	}

	public function index($catal,$erro2) 
	{
		if($this->session->userdata('is_logued_in') )
		{
			$data['catalogo'] = $catal;

			$this->load->model("registros_model");		
			$data['registros']= $this->registros_model->mostrar($catal);

			$data['user']=$this->session->userdata('user');
			$data['title'] = "Sistema G7 Grafico";
			$this->load->view("vwHeader", $data);

			if($this->uri->segment(4) != 'registros'){
				if($catal == "udm"){
				$this->load->view("catalogos/vwUdm",$erro2);
				}
				if($catal == "presentacion") {
					$this->load->view("catalogos/vwPresentacion",$erro2);
				}
				if($catal == "proveedor"){
					$this->load->view("catalogos/vwProveedor",$erro2);
				}
				if($catal == "producto") {
					$this->load->view("catalogos/vwProductos",$erro2);
				}
				if($catal == "puesto") {
					$this->load->view("catalogos/vwPuesto",$erro2);
				}
				if($catal == "familia") {
					$this->load->view("catalogos/vwFamilia",$erro2);
				}
				if($catal == "departamento") {
					$this->load->view("catalogos/vwDepartamento",$erro2);
				}
				if($catal == "usuario"){
					$this->load->view("catalogos/vwUsuario",$erro2);
					$this->load->library('form_validation');
		        	$this->load->helper('form');
				}
				if($catal == "material") {
					$this->load->view("catalogos/vwMaterial",$erro2);
				}
			}
			#$data['registros']= $this->registros_model->mostrar($catal);
			#$data['columnas'] = $this->registros_model->get_columns($catal);
			#$data['foraneas'] = $this->registros_model->get_foreignColumns($catal);
			#$data['tablasF'] = $this->registros_model->get_referencedTables($catal);
			#$data['referencias'] = $this->registros_model->get_referencedColumns($catal);
			else{
			if($catal == "udm"){
				$this->load->view("catalogos/vwUdm");
			}
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
			if($catal == "usuario"){
				$this->load->view("catalogos/vwUsuario");
				$this->load->library('form_validation');
	        	$this->load->helper('form');
			}
			if($catal == "material") {
				$this->load->view("catalogos/vwMaterial");
			}}
		}
		else{
			redirect(login2);
		}
	}


	public function enabled($tabla, $id){
		$this->load->model("registros_model");
		if($this->registros_model->enabledRegister($tabla, $id) ){
			$this->index($tabla,null);
			
		}
		else{
			return false;
		}
	}

		public function disabled($tabla, $id){
		$this->load->model("registros_model");
		if($this->registros_model->disabledRegister($tabla, $id) ){
			$this->index($tabla,null);
			
		}
		else{
			$error2['error2'] = "El resgistro esta en uso, no puede ser deshabilitado";
			$this->index($tabla,$error2);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de puesto */
	public function insertPuesto($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no debe ser mayor a %d carácteres</div>');

		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
			$this->index($tabla,null);
				
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}

	public function insertUdm($tabla) {

		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no debe ser mayor a %d carácteres</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post('Nombre');
			$datos['tipo_udm'] = $this->input->post('Tipo');
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$this->index($tabla,null);
			}
		}
		else
		{
			$this->index("udm",null);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de departamento */
	public function insertDepartamento($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no debe ser mayor a %d carácteres</div>');


		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$this->index($tabla,null);
			}
		}
		else
		{
			$this->index("departamento",null);
		}
	}

/* Agrega una funcion para insertar los datos en la tabla de familia */
	public function insertFamilia($tabla) {
		$datos['nombre'] = $this->input->post("nombre");
		$datos['estado'] = 1;

		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos,$tabla)) {
			$this->index($tabla,null);
		}
	}

	public function insertProveedor($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('Direccion', 'Dirección', 'trim|max_length[50]');
		$this->form_validation->set_rules('Telefono', 'Teléfono', 'required|trim|min_length[7]|max_length[11]|numeric');
		$this->form_validation->set_rules('Correo', 'Correo', 'trim|valid_email|max_length[50]');
		$this->form_validation->set_rules('Contacto', 'Contacto', 'trim|max_length[30]');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no debe estar vacío</div>');
        $this->form_validation->set_message('min_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s debe ser menor a %d carácteres</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no debe ser mayor a %d carácteres</div>');
        $this->form_validation->set_message('valid_email', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El %s no es válido</div>');
        $this->form_validation->set_message('numeric', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s debe contener sólo números</div>');

        if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post('Nombre');
			$datos['dir_prove'] = $this->input->post('Direccion');
			$datos['tel_prove'] = $this->input->post('Telefono');
			$datos['correo_prove'] = $this->input->post('Correo');
			$datos['contacto'] = $this->input->post('Contacto');
			$datos['estado'] = 1;

			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$this->index($tabla,null);
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de UDM */
	public function insertPresentacion($tabla) {
$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no debe ser mayor a %d carácteres</div>');

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
			$this->index($tabla,null);
		}
	}

		/* Agrega una funcion para insertar los datos en la tabla de usuario */
	public function insertUsuario()
	{

		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|max_length[15]|trim|callback_espacio['.$this->input->post('Nombre').']');
		$this->form_validation->set_rules('Contrasena', 'Contraseña', 'required|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('Nombre1', 'Primer Nombre', 'required|max_length[15]');
		$this->form_validation->set_rules('Nombre2', 'Segundo Nombre', 'max_length[15]');
		$this->form_validation->set_rules('Apellido1', 'Apellido Paterno', 'required|max_length[15]');
		$this->form_validation->set_rules('Apellido2', 'Apellido Materno', 'max_length[15]');
		$this->form_validation->set_rules('Correo', 'Correo', 'required|valid_email|max_length[45]');
		$this->form_validation->set_rules('Puesto', 'Puesto', 'required');
		$this->form_validation->set_rules('Departamento', 'Departamento', 'required');
		$this->form_validation->set_rules('Tipo', 'Tipo', 'required');

        $this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no puede estar vacío</div>');
        $this->form_validation->set_message('min_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s debe tener al menos %d carácteres</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no puede tener más de %d carácteres</div>');
        $this->form_validation->set_message('valid_email', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no es correo válido</div>');
        $this->form_validation->set_message('espacio', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo Nombre no debe contener espacios en blanco</div>');

        if ($this->form_validation->run() == TRUE) 
        {
        	$this->load->helper('file');
			$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '4000';
            $config['max_width'] = '4024';
            $config['max_height'] = '4008';
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('Imagen'))
            {
            	$error = array('error' => $this->upload->display_errors());

				$this->index("usuario",$error);
				
				
            }
				$this->load->model('registros_model');
            	$file_info = $this->upload->data();
            	$datos['nombre'] = $this->input->post('Nombre');
				$datos['contra_usr'] = MD5($this->input->post('Contrasena'));
				$datos['nombre_usr'] = $this->input->post('Nombre1');
				$datos['nombre2_usr'] = $this->input->post('Nombre2');
				$datos['apellidop_usr'] = $this->input->post('Apellido1');
				$datos['apellidom_usr'] = $this->input->post('Apellido2');
				$datos['correo_usr'] = $this->input->post('Correo');
				$datos['tipo_usr'] = $this->input->post('Tipo');
				$datos['imagen'] = $file_info['file_name'];
				$datos['estado'] = 1;
				$datos['depto_usr'] = $this->input->post("Departamento");
				$datos['id_puesto'] = $this->input->post("Puesto");
				if($this->registros_model->insertar($datos, "usuario")) 
				{
					$this->index("usuario",null);
				}
			
		}
		else
		{
			$this->index("usuario",null);
		}
	}

	public function espacio($nombre)
	{
		$res = strpos($nombre," ");
		if($res !== FALSE)
		{
			return FALSE;
		}
		return TRUE;
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
			{
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
			$this->index($tabla,null);
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
			$this->index($tabla,null);
		}
	}
}