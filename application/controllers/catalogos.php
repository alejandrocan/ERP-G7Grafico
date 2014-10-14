<?php

/**
* G7 Gráfico
* Author: Ramón Alejandro Can Tepal
* Description: Carga la vista de catalogos seleccionada
*/

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public function catalogo($catal) {
		$data['catalogo'] = $catal;
		$this->load->view("catalogos/vwHeader", $data);
		$this->load->view("catalogos/vwCatalogoSelected");
	}
}