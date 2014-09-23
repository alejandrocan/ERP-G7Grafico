<?php

/**
* G7 Gráfico
* Author: Alejandro Can
* Description: Carga la interfaz de usuario
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class UserInterface extends CI_Controller {

	function __construct() {
		parent:: __construct();

		/*Cargamos las base de datos*/
		$this->load->database();
	}
	function index() {
		$data['title'] = 'Inicio';
		$data['main_content'] = 'inicio';
		$this->load->view('main_template', $data);
	}
}