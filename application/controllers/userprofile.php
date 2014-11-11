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
		$this->load->database();
	}
	function index() {
		if($this->session->userdata('is_logued_in') )
		{
			$id = $this->session->userdata('id_usr');
			$cualquiera = $this->db->query("select imagen from usuario where id_usr=" . $id . ";");
			$data['datos'] = $cualquiera->result();
			$data['user']=$this->session->userdata('user');
			$data['title'] = "Sistema G7 Grafico";
			$this->load->view("vwHeader", $data);
			$this->load->view("vwProfile");
		}
		else
		redirect(login2);
	}
}
