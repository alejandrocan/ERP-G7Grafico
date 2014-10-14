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
		$this->load->view("vwHeader");
		$this->load->view("vwInterface");
		$this->load->view("vwFooter");
	}
}