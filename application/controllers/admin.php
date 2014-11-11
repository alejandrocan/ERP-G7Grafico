<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * 
 */
class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
    }
    
    public function index()
    {
        if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        $this->load->model('tabla_model');
        $data['tables'] =  $this->tabla_model->mostrar_tabla();
        $this->load->view('vwHeader',$data);
        $this->load->view('vwInterface');
        $this->load->view('vwFooter');
    }
}