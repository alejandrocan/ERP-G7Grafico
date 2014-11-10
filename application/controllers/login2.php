<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form'));
        $this->load->database('default');
    }
    
    public function index()
    {    
        switch ($this->session->userdata('tipo_usr')) {
            case '':
                $data['token'] = $this->token();
                $data['title'] = 'Sistema G7 Gráfico';
                $this->load->view('login/vwLogin_header',$data);
                $this->load->view('login_view');
                break;
            case 'Administrador':
                redirect(base_url().'index.php/admin');
                break;
            case 'editor':
                redirect(base_url().'editor');
                break;    
            case 'suscriptor':
                redirect(base_url().'suscriptor');
                break;
            default:        
                $data['titulo'] = 'Login con roles de usuario en codeigniter';
                $this->load->view('login/vwLogin_header',$data);
                $this->load->view('login_view');
                break;        
        }
    }
 
public function new_user()
    {
        if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
        {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('username', 'user', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[4]|max_length[150]|xss_clean');
 
            //lanzamos mensajes de error si es que los hay
            
            if($this->form_validation->run() == FALSE)
            {
                $this->index();
            }else{
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                $check_user = $this->login_model->login_user($username,$password);
                if($check_user == TRUE)
                {
                    $data = array(
                    'is_logued_in'     =>         TRUE,
                    'id_usr'     =>         $check_user->id_usr,
                    'tipo_usr'        =>        $check_user->tipo_usr,
                    'user'         =>         $check_user->nombre_usr.' '.$check_user->apellidop_usr,
                    'imagen'     =>         $check_user->imagen,
                    'correo'     =>         $check_user->correo_usr,
                    'depto'     =>         $check_user->depto_usr,
                    'puesto'     =>         $check_user->id_puesto,
                    'nombreusuario'     =>         $check_user->nombre,
                    'nombrecomp'     =>         $check_user->nombre_usr. ' ' . $check_user->nombre2_usr . ' ' . $check_user->apellidop_usr . ' ' . $check_user->apellidom_usr,

                    );        
                    $this->session->set_userdata($data);
                    $this->index();
                }
            }
        }else{
            redirect(base_url().'index.php/login2');
        }
    }
    
    public function token()
    {
        $token = md5(uniqid(rand(),true));
        $this->session->set_userdata('token',$token);
        return $token;
    }
    
    public function logout_ci()
    {
        $this->session->sess_destroy();
        $this->index();
    }
}