<?php 

	if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

	class Login_model extends CI_Model{

		public function __construct() 
	     {
	           parent::__construct(); 
	           $this->load->database();
	     }

		function valid_user($username, $password){
			$this->db->where('nombreusuario_usr', $username);
			$this->db->where('contra_usr', $password);

			$query = $this->db->get('usuarios');

			if($query->num_rows() > 0){
				return TRUE;
			} else{
				return FALSE;
			}
		}

		function valid_user_ajax($username){
			$this->db-where('nombreusuario_usr', $username);
			$query = $this->db->get('usuarios');

			if($query->num_rows() > 0){
				echo $query->numrows();
			}
		}
	}

?>