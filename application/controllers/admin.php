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
        ////////////////////////////////////////////
        $data['catalogos'] = "active";
        $data['licatalogos'] = "tab-pane fade in active";
        $data['explosion'] = "null";
        $data['liexplosion'] = "tab-pane fade";
        $data['reportes'] = "null";
        $data['lireportes'] = "tab-pane fade";
        $data['kardex'] = "null";
        $data['likardex'] = "tab-pane fade";
        ///////////////////////////////////////////
        $data['buttonAdd'] = '<form action="'. base_url() .'/index.php/testController/createOrder">
        <button type="submit" class="btn btn-default">Nuevo</button></form>';
        $data['form_add_producto'] = '';
        ///////////////////////////////////////////
        $data['buttonAditional'] = '';
        $data['id'] = 0;
        ///////////////////////////////////////////
        $this->load->view('vwHeader',$data);
        $this->load->view('vwInterface');
        
    }
    public function addResources(){
        $resources = $this->input->post('resources');
        $cantidad = $this->input->post('cantidad');
        ////////////////////////////////////////////77
        $this->db->where('nombre', $resources);
        $query = $this->db->get('producto');
        $valores = $query->result();
        if($valores == null){
            $this->db->where('nombre', $resources);
            $query = $this->db->get('material');
            $valores = $query->result();
            foreach ($valores as $valor) {
                $id_producto = $valor->id_material;
                $udm_material = $valor->udm_material;
                $query = $this->db->get_where('udm',array('id_udm' => $udm_material));
                $udm = $query->row();
                $udm_value = $udm->nombre;
                $tipo = "material";
                break;
            }
        }else{
            foreach ($valores as $valor) {
                $id_producto =$valor->id_produc;
                $udm_product = $valor->udm_produc;
                $query = $this->db->get_where('udm',array('id_udm' => $udm_product));
                $udm = $query->row();
                $udm_value = $udm->nombre;
                $tipo = "producto";
            }
        }
        ///////////////////////////////////////777
                $this->db->order_by('id_pedido', 'desc');
                $pedido = $this->db->get('pedido');
                $pedido = $pedido->row();
                $id = $pedido->id_pedido;
                $data['id'] = $id;
        $this->load->model('explosionModel');
        $this->explosionModel->insertValues($id,$id_producto ,$tipo, $cantidad, $udm_value, 100);
        //////////////////////
        if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        $this->load->model('tabla_model');
        $data['tables'] =  $this->tabla_model->mostrar_tabla();
        ////////////////////////////////////////////
        $data['catalogos'] = "null";
        $data['licatalogos'] = "tab-pane fade";
        $data['explosion'] = "active";
        $data['liexplosion'] = "tab-pane fade in active";
        $data['reportes'] = "null";
        $data['lireportes'] = "tab-pane fade";
        $data['kardex'] = "null";
        $data['likardex'] = "tab-pane fade";
        
        ///////////////////////////////////////////
        $data['buttonAdd'] = '';
        $data['form_add_producto'] = '<form class="navbar-form navbar-left" role="search" action="'.base_url().'index.php/admin/addResources" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Producto/Material" name="resources" id="resources">
                        <input type="text" class="form-control" placeholder="Cantidad" name="cantidad" id="cantidad">
                    </div>
                    
                    <button type="submit" class="btn btn-success" onClick="AgregarValores()">Agregar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </form>';
        ///////////////////////////////////////////
        $data['buttonAditional'] = '<a class="btn btn-default" href="'.base_url().'index.php/vistaGlobal/index/'.$id.'">Vista Global</a>
                <a class="btn btn-default" href="'.base_url().'index.php/detailedList/showList/'.$id.'">Vista Detallada</a>';
        //////////////////////////
                
       $this->load->view('vwHeader', $data);
       $this->load->view('vwInterface');
    }
}