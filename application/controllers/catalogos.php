<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public $PRODUCTO_NAME = array();

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
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNP[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNP', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');

		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado un nuevo Puesto. Espere mientras es redirigido :) </div>';
				$this->index("puesto",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/puesto/registros');
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}

	//Verifica si el nombre del Puesto es unico (Agregar)
	public function isUniqueNP($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('puesto', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	//Verifica si el nombre del Puesto es unico (Editar)
	public function isUniqueNPE()
	{
		$id = $this->input->post('id_puesto');
		$nombre = $this->input->post('nombre');
        $query = null; //emptying in case 
        $query = $this->db->get_where('puesto', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
                else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_puesto == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

	public function insertUdm($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNUDM[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_rules('Tipo', 'Tipo', 'required');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNUDM', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post('Nombre');
			$datos['tipo_udm'] = $this->input->post('Tipo');
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado una nueva unidad de medida (UDM). Espere mientras es redirigido :) </div>';
				$this->index("udm",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/udm/registros');
			}
		}
		else
		{
			$this->index("udm",null);
		}
	}

	//verifica que el nombre de la unidad de medida no esté ocupado (Agregar)
	public function isUniqueNUDM($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('udm', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

		//verifica que el nombre de la unidad de medida no esté ocupado (Editar)
	public function isUniqueNUDME()
	{
		$id = $this->input->post('id_udm');
		$nombre = $this->input->post('nombre');
        $query = null; //emptying in case 
        $query = $this->db->get_where('udm', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_udm == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

	/* Agrega una funcion para insertar los datos en la tabla de departamento */
	public function insertDepartamento($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueND[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueND', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
       	{
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado un nuevo Departamento. Espere mientras es redirigido :) </div>';
				$this->index("departamento",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/departamento/registros');
			}
		}
		else
		{
			$this->index("departamento",null);
		}
	}

	//Verifica que el nombre del Departamento no esté repetido (Agregar)
	public function isUniqueND($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('departamento', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	//Verifica que el nombre del Departamento no esté repetido (Editar)
	public function isUniqueNDE()
	{
		$id = $this->input->post('id_depto');
		$nombre = $this->input->post('nombre');
        $query = null; //emptying in case 
        $query = $this->db->get_where('departamento', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_depto == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

/* Agrega una funcion para insertar los datos en la tabla de familia */
	public function insertFamilia($tabla) {

		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNF[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNF', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado una nueva Familia. Espere mientras es redirigido :) </div>';
				$this->index("familia",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/familia/registros');
			}
		}
		else
		{
			$this->index("familia",null);
		}
	}

	public function updateFamilia($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNFE');
		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNFE', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_fam'] = $this->input->post("id_fam");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_familia($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el Registro. Espere mientras es redirigido :) </div>';
				$this->index("familia",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/familia/registros');
			}
		}
		else
		{
			$this->index("familia",null);
		}
	}
	public function updatePuesto($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNPE');
		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNPE', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_puesto'] = $this->input->post("id_puesto");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_puesto($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el Registro. Espere mientras es redirigido :) </div>';
				$this->index($tabla,$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/puesto/registros');
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}
	
	public function updateDepartamento($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNDE');
		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNDE', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Editar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');

		if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_depto'] = $this->input->post("id_depto");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_departamento($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el registro. Espere mientras es redirigido :) </div>';
				$this->index("departamento",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/departamento/registros');
			}
		}
		else
		{
			$this->index("departamento",null);
		}
	}

	public function updateProveedor($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('dir_prove', 'Dirección', 'trim|max_length[50]');
		$this->form_validation->set_rules('tel_prove', 'Teléfono', 'required|trim|min_length[7]|max_length[11]|integer');
		$this->form_validation->set_rules('correo_prove', 'Correo', 'trim|valid_email|max_length[50]');
		$this->form_validation->set_rules('contacto', 'Contacto', 'trim|max_length[30]');

		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe estar vacío</div>');
        $this->form_validation->set_message('min_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe ser menor a %d carácteres</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe ser mayor a %d carácteres</div>');
        $this->form_validation->set_message('valid_email', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El %s no es válido</div>');
        $this->form_validation->set_message('integer', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s debe contener sólo números</div>');

        if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_proveedor'] = $this->input->post("id_proveedor");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['dir_prove'] = $this->input->post("dir_prove");
			$datos['tel_prove'] = $this->input->post("tel_prove");
			$datos['correo_prove'] = $this->input->post("correo_prove");
			$datos['contacto'] = $this->input->post("contacto");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_proveedor($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el registro. Espere mientras es redirigido :) </div>';
				$this->index("proveedor",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/proveedor/registros');
			}
		}
				else
		{
			$this->index($tabla,null);
		}
	}

	public function updatePresentacion($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNPreE');
		$this->form_validation->set_rules('udm_pres', 'UDM', 'required');
		$this->form_validation->set_rules('contenido', 'Contenido', 'required|trim|max_length[4]|numeric');
		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('numeric', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s debe contener únicamente números enteros</div>');
		$this->form_validation->set_message('isUniqueNPreE', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s ya ha sido usado en otra Presentación. Ingrese una diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_pres'] = $this->input->post("id_pres");
			$datos['nombre']= $this->input->post('nombre');		
			$datos['udm_pres'] = $this->input->post('udm_pres');
			$datos['contenido_pres']= $this->input->post('contenido');
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_presentacion($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el Registro. Espere mientras es redirigido :) </div>';
				$this->index("presentacion",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/presentacion/registros');
			}
		}
		else
		{
			$this->index($tabla,null);
		}	
	}	

	public function updateUdm($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNUDME');
		$this->form_validation->set_rules('tipo_udm', 'Tipo', 'required');
		$this->form_validation->set_message('required', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('isUniqueNUDME', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Modificar. El valor del campo %s ya ha sido usado. Ingrese uno diferente.</div>');
		if ($this->form_validation->run() == TRUE) 
        {
			$datos['id_udm'] = $this->input->post("id_udm");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['tipo_udm'] = $this->input->post("tipo_udm");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->editar_udm($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificaado el Registro. Espere mientras es redirigido :) </div>';
				$this->index("udm",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/udm/registros');
			}
		}
		else
		{
			$this->index("udm",null);
		}
	}


	public function duplicar_familia($tabla){
		$datos['nombre']= $this->input->post('nombre');		
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('familia',$datos);
	}	
	public function duplicar_departamento($tabla){
		$datos['nombre']= $this->input->post('nombre');		
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('departamento',$datos);
	}
	public function duplicar_proveedor($tabla){
		$datos['nombre']= $this->input->post('nombre');	
		$datos['direccion']= $this->input->post('direccion');	
		$datos['telefono']= $this->input->post('telefono');	
		$datos['correo']= $this->input->post('correo');	
		$datos['contacto']= $this->input->post('contacto');	
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('proveedor',$datos);
	}
	public function duplicar_presentacion($tabla){
		$datos['nombre']= $this->input->post('nombre');	
		$datos['udm']= $this->input->post('udm');	
		$datos['contenido']= $this->input->post('contenido');					
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('presentacion',$datos);
	}
	public function duplicar_puesto($tabla){
		$datos['nombre']= $this->input->post('nombre');		
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('puesto',$datos);
	}	

	public function duplicar_UDM($tabla){
		$datos['nombre']= $this->input->post('nombre');		
		$datos['tipo_udm']= $this->input->post('tipo_udm');
			$this->index('udm',$datos);
	}
	/*

                <td><input class="form-control" value="<?php if(@$clave){echo $clave;}?>" type="text" name="clave"></td>
                <td><input class="form-control" value="<?php if(@$smax){echo $udm;}?>" type="text" name="smax"></td>
                <td><input class="form-control" value="<?php if(@$smin){echo $proveedor;}?>" type="text" name="smin"></td>
                <td><input class="form-control" value="<?php if(@$factor){echo $factor;}?>" type="text" name="factor_redimiento"></td>
                <td><input class="form-control" value="<?php if(@$cantidad){echo $cantidad;}?>" type="text" name="cantidad"></td>
                <td><input class="form-control" value="<?php if(@$costo){echo $costo;}?>" type="text" name="ultimo_costo"></td>
                <td><input class="form-control" value="<?php if(@$tiempo){echo $tiempo;}?>" type="text" name="tiempo_elaboracion"></td>
                <td><input class="form-control" value="<?php if(@$orden){echo $orden;}?>" type="text" name="orden_cronologico"></td>
	*/
	public function duplicar_material($tabla){
		$datos['proveedor_material']= $this->input->post('proveedor');	
		$datos['udm_material']= $this->input->post('udm');	
		$datos['presentacion_m']= $this->input->post('presentacion');	
		$datos['nombre']= $this->input->post('nombre');	
		$datos['clave']= $this->input->post('clave');				
		$datos['smax']= $this->input->post('smax');	
		$datos['smin']= $this->input->post('smin');	
		$datos['factor']= $this->input->post('factor');	
		$datos['cantidad']= $this->input->post('cantidad');	
		$datos['costo']= $this->input->post('costo');	
		$datos['tiempo']= $this->input->post('tiempo');	
		$datos['orden_cronologico']= $this->input->post('orden');	
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('material',$datos);
	}	
	/*

	public function duplicar_udm($tabla){
		$datos['nombre']= $this->input->post('nombre');						
		$datos['tipo']= $this->input->post('tipo');	
		//$this->load->view("catalogos/vwPresentacion",$erro2);
			$this->index('Udm',$datos);
	}
	*/
	//Verifica que el nombre de la Familia no esté ocupado (Agregar)
	public function isUniqueNF($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('familia', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	public function isUniqueNFE()
	{
		$id = $this->input->post('id_fam');
		$nombre = $this->input->post('nombre');
        $query = null; //emptying in case 
        $query = $this->db->get_where('familia', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_fam == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

	public function insertProveedor($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('Direccion', 'Dirección', 'trim|max_length[50]');
		$this->form_validation->set_rules('Telefono', 'Teléfono', 'required|trim|min_length[7]|max_length[11]|integer');
		$this->form_validation->set_rules('Correo', 'Correo', 'trim|valid_email|max_length[50]');
		$this->form_validation->set_rules('Contacto', 'Contacto', 'trim|max_length[30]');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
        $this->form_validation->set_message('min_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser menor a %d carácteres</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
        $this->form_validation->set_message('valid_email', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El %s no es válido</div>');
        $this->form_validation->set_message('integer', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener sólo números</div>');

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
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado un nuevo Proveedor. Espere mientras es redirigido :) </div>';
				$this->index("proveedor",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/proveedor/registros');
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}

	/* Agrega una funcion para insertar los datos en la tabla de UDM */
	public function insertPresentacion($tabla) {
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|trim|max_length[50]|callback_isUniqueNPre[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_rules('UDM', 'UDM', 'required');
		$this->form_validation->set_rules('Contenido', 'Contenido', 'required|trim|max_length[4]|numeric');
		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe ser mayor a %d carácteres</div>');
		$this->form_validation->set_message('numeric', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener una expresion numérica. Ej. 1, 1.8, 4.98</div>');
		$this->form_validation->set_message('isUniqueNPre', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s ya ha sido usado en otra Presentación. Ingrese una diferente.</div>');

		if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['udm_pres'] = $this->input->post("UDM");
			$datos['contenido_pres'] = $this->input->post("Contenido");
			$datos['estado'] = 1;

			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos,$tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado una nueva Presentación. Espere mientras es redirigido :) </div>';
				$this->index("presentacion",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/presentacion/registros');
			}
		}
		else
		{
			$this->index($tabla,null);
		}
	}

	public function isUniqueNPre($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('presentacion', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	public function isUniqueNPreE()
	{
		$id = $this->input->post("id_pres");
		$nombre = $this->input->post("nombre");
        $query = $this->db->get_where('presentacion', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_pres == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

		/* Agrega una funcion para insertar los datos en la tabla de usuario */
	public function insertUsuario()
	{

		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|max_length[15]|trim|callback_espacio['.$this->input->post('Nombre').']|callback_isUniqueNU[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_rules('Contrasena', 'Contraseña', 'required|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('Nombre1', 'Primer Nombre', 'required|max_length[15]');
		$this->form_validation->set_rules('Nombre2', 'Segundo Nombre', 'max_length[15]');
		$this->form_validation->set_rules('Apellido1', 'Apellido Paterno', 'required|max_length[15]');
		$this->form_validation->set_rules('Apellido2', 'Apellido Materno', 'max_length[15]');
		$this->form_validation->set_rules('Correo', 'Correo', 'required|valid_email|max_length[45]|callback_isUniqueCU[' . $this->input->post('Correo') . ']');
		$this->form_validation->set_rules('Puesto', 'Puesto', 'required');
		$this->form_validation->set_rules('Departamento', 'Departamento', 'required');
		$this->form_validation->set_rules('Tipo', 'Tipo', 'required');

        $this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s no puede estar vacío</div>');
        $this->form_validation->set_message('min_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El campo %s debe tener al menos %d carácteres</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no puede tener más de %d carácteres</div>');
        $this->form_validation->set_message('valid_email', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo %s no es correo válido</div>');
        $this->form_validation->set_message('espacio', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button> El campo Nombre no debe contener espacios en blanco</div>');
        $this->form_validation->set_message('isUniqueNU', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El valor del campo %s, ya se ha utilizado por otro usuario. Ingrese uno diferente.</div>');
        $this->form_validation->set_message('isUniqueCU', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El valor del campo %s, ya se ha utilizado por otro usuario. Ingrese uno diferente.</div>');

        if ($this->form_validation->run() == TRUE) 
        {
        	$datos['imagen'] = "";
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
	            $file_info = $this->upload->data();
	            $datos['imagen'] = $file_info['file_name'];
	        

			$this->load->model('registros_model');
           	$datos['nombre'] = $this->input->post('Nombre');
			$datos['contra_usr'] = MD5($this->input->post('Contrasena'));
			$datos['nombre_usr'] = $this->input->post('Nombre1');
			$datos['nombre2_usr'] = $this->input->post('Nombre2');
			$datos['apellidop_usr'] = $this->input->post('Apellido1');
			$datos['apellidom_usr'] = $this->input->post('Apellido2');
			$datos['correo_usr'] = $this->input->post('Correo');
			$datos['tipo_usr'] = $this->input->post('Tipo');
			$datos['estado'] = 1;
			$datos['depto_usr'] = $this->input->post("Departamento");
			$datos['id_puesto'] = $this->input->post("Puesto");
			if($this->registros_model->insertar($datos, "usuario")) 

			{
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado un nuevo Usuario. Espere mientras es redireccionado :)</div>';
				$this->index("usuario",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/usuario/registros');
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
			return FALSE;
		return TRUE;
 	}

 	public function isUniqueNU($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('usuario', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	 public function isUniqueCU($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('usuario', array(//making selection
            'correo_usr' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
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
			if($registro->nombre == $valor)
			{
				$datos['depto_produc'] = $registro->id_depto;
				break;
			}
		}
		$datos['estado'] = 0;
		$data['user']=$this->session->userdata('user');
		$data['title'] = "Sistema G7 Grafico";
		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
			$this->load->view("vwHeader", $data);
			$this->load->view("catalogos/vwAddMaterial");
		}
	}

	public function insertMaterial($tabla){
		$this->form_validation->set_rules('Nombre', 'Nombre', 'required|max_length[100]|trim|callback_isUniqueNM[' . $this->input->post('Nombre') . ']');
		$this->form_validation->set_rules('UDM', 'UDM', 'required');
		$this->form_validation->set_rules('Proveedor', 'Proveedor', 'required');
		$this->form_validation->set_rules('Presentacion', 'Presentacion', 'required');
		$this->form_validation->set_rules('clave', 'Clave', 'required|trim|max_length[100]');
		$this->form_validation->set_rules('smax', 'Stock_Maxima', 'trim|numeric|max_length[5]');
		$this->form_validation->set_rules('smin', 'Stock_Minima', 'trim|numeric|max_length[6]');
		$this->form_validation->set_rules('factor_redimiento', 'Factor_Redimiento', 'required|trim|numeric|max_length[7]');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|trim|integer|max_length[7]');
		$this->form_validation->set_rules('ultimo_costo', 'Ultimo_Costo', 'required|trim|numeric|max_length[10]');
		$this->form_validation->set_rules('orden_cronologico', 'Orden_Elaboracion', 'trim|integer|max_length[5]');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no puede estar vacío</div>');
        $this->form_validation->set_message('exact_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener %d carácteres exactamente</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe no puede contener más de %d caracteres</div>');
        $this->form_validation->set_message('isUniqueNM', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s, ya se ha utilizado por otro usuario. Ingrese uno diferente.</div>');
        $this->form_validation->set_message('espacio', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo Nombre no debe contener espacios en blanco</div>');
        $this->form_validation->set_message('integer', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener sólo números</div>');
        $this->form_validation->set_message('numeric', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no es un número válido. Ej: 1, 1.6, 8.98</div>');

        if ($this->form_validation->run() == TRUE) 
        {
			$datos['nombre'] = $this->input->post("Nombre");
			$datos['udm_material'] = $this->input->post("UDM");
			$datos['proveedor_material'] = $this->input->post("Proveedor");
			$datos['presentacion'] = $this->input->post("Presentacion");
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
			$datos['orden_cronologico'] = $this->input->post("orden_cronologico");
			$datos['estado'] = 1;
			$this->load->model('registros_model');
			if($this->registros_model->insertar($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha agregado un nuevo Material. Espere mientras es redireccionado :)</div>';
				$this->index("material",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/material/registros');
			}
		}
		else
		{
			$this->index("material",null);
		}
	}

	public function FormatoTiempo()
	{
		$tiempo = $this->input->post('tiempo_elaboracion');
		for($i=0;$i<strlen($tiempo);$i++)
		{
			if($i==2||$i==5)
			{
				if(!$tiempo[$i]==":")
					return FALSE;
			}
			else
			{
				if(!is_numeric($tiempo[$i]))
					return FALSE;
			}
		}
		return TRUE;
	}

	//verifica que el nombre del material no esté ocupado (Agregar)
	public function isUniqueNM($texto)
	{
        $query = null; //emptying in case 
        $query = $this->db->get_where('material', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}

	//verifica que el nombre del material no esté ocupado (Editar)
	public function isUniqueNME($texto)
	{
        $id = $this->input->post("id_material");
		$nombre = $this->input->post("nombre");
        $query = $this->db->get_where('material', array(//making selection
            'nombre' => $texto
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        {
        	$query = $query->result();
        	foreach ($query as $pre) {
        	}
        	if($pre->id_material == $id)
        		return TRUE;
        	else
        		return FALSE;
        }
	}

	public function updateMaterial($tabla){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]|trim|callback_isUniqueNME');
		$this->form_validation->set_rules('udm_material', 'UDM', 'required');
		$this->form_validation->set_rules('proveedor_material', 'Proveedor', 'required');
		$this->form_validation->set_rules('presentacion', 'Presentacion', 'required');
		$this->form_validation->set_rules('clave', 'Clave', 'required|trim|max_length[100]');
		$this->form_validation->set_rules('smax', 'Stock_Maxima', 'trim|integer|max_length[5]');
		$this->form_validation->set_rules('smin', 'Stock_Minima', 'trim|integer|max_length[6]');
		$this->form_validation->set_rules('factor_redimiento', 'Factor_Redimiento', 'trim|numeric|max_length[7]');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|trim|numeric|max_length[7]');
		$this->form_validation->set_rules('ultimo_costo', 'Ultimo_Costo', 'required|trim|numeric|max_length[10]');
		$this->form_validation->set_rules('orden_cronologico', 'Orden_Elaboracion', 'trim|integer|max_length[5]');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no puede estar vacío</div>');
        $this->form_validation->set_message('exact_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener %d carácteres exactamente</div>');
        $this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe no puede contener más de %d caracteres</div>');
        $this->form_validation->set_message('isUniqueNME', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s, ya se ha utilizado por otro usuario. Ingrese uno diferente.</div>');
        $this->form_validation->set_message('espacio', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo Nombre no debe contener espacios en blanco</div>');
        $this->form_validation->set_message('integer', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener sólo números</div>');
        $this->form_validation->set_message('numeric', '<div class="container alert alert-info alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no es un número válido. Ej: 1, 1.6, 8.98</div>');
    

        if ($this->form_validation->run() == TRUE) 
        {

			$datos['id_material'] = $this->input->post("id_material");
			$datos['nombre'] = $this->input->post("nombre");
			$datos['udm_material'] = $this->input->post("udm_material");
			$datos['proveedor_material'] = $this->input->post("proveedor_material");
			$datos['presentacion'] = $this->input->post("presentacion");
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
			$datos['orden_cronologico'] = $this->input->post("orden_cronologico");
			$datos['estado'] = 1;

			$this->load->model('registros_model');
			if($this->registros_model->editar($datos, $tabla)) {
				$error['mensaje'] = '<div class="container alert alert-success alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Se ha modificado el Material. Espere mientras es redireccionado :)</div>';
				$this->index("material",$error);
				header('Refresh:2;url="' . base_url() . '/index.php/catalogos/index/material/registros');
			}
		}
		else
		{
			$this->index("material",null);
		}
	}
	public function newProduct($tabla) 
	{
		$datos['nombre'] = $this->input->post("nombre");
		$this->PRODUCTO_NAME['registros'] = $datos['nombre'];

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
			if($registro->nombre == $valor)
			{
				$datos['depto_produc'] = $registro->id_depto;
				break;
			}
		}
		$datos['estado'] = 0;
		
		$this->load->model('registros_model');
		if($this->registros_model->insertar($datos, $tabla)) {
			$this->addMaterial($this->PRODUCTO_NAME['registros']);
			#header('Refresh:2;url="' . base_url() . '/index.php/catalogos/addMaterial/'.$this->PRODUCTO_NAME['registros']);
		}
	}
	public function addMaterial($name){
		$data['producto'] = $name;
		$data['user']=$this->session->userdata('user');
		$data['title'] = "Sistema G7 Grafico";
		$this->load->view("vwHeader", $data);
		$this->load->view("catalogos/vwAddMaterial");
	}

	public function notZero()
	{
		$numero = $this->input->post('cant_usada');
		if($numero!=0&&$numero>0)
			return TRUE;
		else
			return FALSE;
	}

	public function noVacio()
	{
		$numero = $this->input->post('cant_usada');
		if($numero==""||$numero==NULL)
			return FALSE;
		else
			return TRUE;
	}

	public function addNewMaterial() {
		$data['id_producto'] = $this->input->post('idProducto');
		$this->form_validation->set_rules('elemento', 'Elemento', 'required');
		$this->form_validation->set_rules('cant_usada', 'Cantidad Usada', 'callback_noVacio|trim|numeric|callback_notZero');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>No se ha cargado un Producto/Material</div>');
		$this->form_validation->set_message('noVacio', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no puede estar vacío</div>');
		$this->form_validation->set_message('notZero', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no puede ser Cero (0) o menor a 0</div>');
		$this->form_validation->set_message('numeric', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe contener una catidad numérica</div>');
        if ($this->form_validation->run() == TRUE) 
        {
			
			$elemento = $this->input->post('elemento');
			$cantidad = $this->input->post('cant_usada');
			//////////////////////////////
			$query = $this->db->get_where('material', array('nombre' => $elemento));
			$query = $query->result();
			if($query != null){
				foreach ($query as $valor) {
					if($valor->nombre == $elemento){
						$data['id_elemento'] = $valor->id_material;
						$fr = $valor->factor_redimiento;
						$ucosto = $valor->ultimo_costo;
						$data['costo'] = $ucosto * $fr* $cantidad;
						$data['tipo_elemento'] = 'material';
					}
				}
			}else{
				$query = $this->db->get('producto');
				$query = $query->result();
				foreach ($query as $valor) {
					if($valor->nombre == $elemento){
						$data['id_elemento'] = $valor->id_produc;
						$data['costo'] = $valor->costo_produc * $cantidad;
						$data['tipo_elemento'] = 'producto';
					}
				}
			}
			/////////////////////////////
			$udm = $this->input->post('udm');
			$query = $this->db->get_where('udm', array('nombre' => $udm ));
			$query = $query->result();
			foreach ($query as $valor) {
				$data['udmid'] = $valor->id_udm;
			}
			////////////////////////////
			$data['cantidadusada'] =  $this->input->post('cant_usada');
			
			$this->db->insert('producto_material', $data);
			$data['udm'] = $this->input->post('udm');
			$data['producto'] = $this->input->post('elemento');
			$data['registro'] = $this->input->post('nombreProducto');
			$this->addMaterial($this->input->post('nombreProducto'));
			redirect('/NewProducts/addMateriales/'. $data['id_producto']);
			#header('Refresh:5;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$data['id_producto']);
		}
		else
		{
			redirect('/NewProducts/addMateriales/'. $data['id_producto']);
		}
	}
	public function upProducto($producto, $id) {
		$data['estado'] = 1;
		$data['costo_produc'] = 0;
		//////////////////////////////////
		$query2 = $this->db->get_where('producto_material', array('id_producto' => $id));
		$query2 = $query2->result();
		foreach ($query2 as $valor) {
			$data['costo_produc'] = $data['costo_produc'] + $valor->costo;
		}
		//////////////////////////////////
		$this->db->where('id_produc', $id);
		$query = $this->db->get('producto');
		$query = $query->result();
		foreach ($query as $value) {
			$producto = $value->nombre;
			break;
		}
		//////////////////////////////////
		$this->db->where('id_produc', $id);
		$this->db->update('producto', $data);
		header('Refresh:0;url="' . base_url() . '/index.php/catalogos/index/producto/registros');
	}
} 