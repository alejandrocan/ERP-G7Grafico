<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {


	function index() {
		
	}

	function catalogo() {
		$this->load->view("catalogos/vwHeader");
		$this->load->view("catalogos/vwTest");
		$this->load->view("vwFooter");
	}

}