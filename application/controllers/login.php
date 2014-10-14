<?php 

class Login extends CI_Controller{
   
   function __construct() 
   { 
        parent::__construct();
        $this ->load->model('login_model');
        $this->load->library(array('session','form_validation'));   
           
   }
  
function index()
    {  // reglas de validación
       $this->form_validation->set_rules('username', 'Usuario', 'callback__valid_login');
       $this->form_validation->set_rules('password', 'Contraseña','|md5|required');
      
        $this->form_validation->set_message('required', 'el campo %s es requerido');
        $this->form_validation->set_message('_valid_login', 'El usuario o contraseña son incorrectos');
      
        $this -> form_validation -> set_error_delimiters('<ul><li>', '</li></ul>');
        $user = FALSE;
        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Sistema G7 Gráfico';

            $this->load->view('login/vwLogin_header',$data);
            $this->load->view('login/vwLogin_content',$data);
            $this->load->view('login/vwLogin_footer',$data);
        }
        else{
            $user=TRUE;   
            $username = $this->input->post('username');
            $data_user = $array = array('user'=> $username, 'logued_in' => TRUE);
             
        // asignamos dos datos a la sesión --> (username y logued_in)                                     
            $this->session->set_userdata($data_user); 
            
            $data['title'] = 'Sistema G7 Gráfico'; 
            $data['user'] = $username;  // = $this->session->userdata('user');
           
            
            $this->load->view('vwHeader',$data);
            $this->load->view('vwInterface');
            $this->load->view('vwFooter');
                 
               
        }
  }
   
function _valid_login($username,$password)
    { 
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        return $this->login_model->valid_user($username,$password);
    }

function valid_login_ajax(){
    //verificamos si la petición es via ajax
if($this->input->is_ajax_request()){

         if($this->input->post('username')!==''){
            $username = $this->input->post('username');
             
        $this->login_model->valid_user_ajax($username);   

        }
}else{
        redirect('login');
}

} // fin del método valid_login_ajax
   
function logout(){
             
         $this->session->sess_destroy(); 
         redirect('login');       
}
  
}