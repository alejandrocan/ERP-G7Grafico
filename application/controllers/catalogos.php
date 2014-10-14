<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public function catalogo() {
		$catalogo = 'Hola';
		$this->load->view("catalogos/vwHeader", $catalogo);
		$this->load->view("catalogos/vwCatalogoSelected");
	}

}