<?php

/**
* G7 Gráfico
* Author: Marco Maciel
* Description: Datos del usuario
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Userprofile extends CI_Controller {

	function __construct() {
		parent:: __construct();

		/*Cargamos las base de datos*/
		//$this->load->database();
	}
	function index() {
		$this->load->view("vwHeader");
		$this->load->view("vwProfile");
		$this->load->view("vwFooter");
	}
}
