<?php
if(!defined("BASEPATH"))
	exit("No direct script access allowed");

Class TestController extends CI_Controller {

	public function explosion() {
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
        $data['buttonAdd'] = '<form>
        <button type="button" class="btn btn-default">Nuevo</button></form>';
        $data['form_add_producto'] = '<form class="navbar-form navbar-left" role="search" action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Producto/Material" id="resources">
                        <input type="text" class="form-control" placeholder="Cantidad" id="cantidad">
                        <input type="text" class="form-control" placeholder="UDM" id="medida">
                    </div>
                    
                    <button type="button" class="btn btn-success" onClick="AgregarValores()">Agregar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </form>';
        ///////////////////////////////////////////
        $data['buttonAditional'] = '<button class="btn btn-default">Guardar</button>
                <button class="btn btn-default">Vista Resumida</button>
                <button class="btn btn-default">Vista Global</button>';
        ///////////////////////////////////////////
        $this->load->view('vwHeader',$data);
        $this->load->view('vwInterface');
	}
    public function createOrder() {
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
        $data['buttonAditional'] = '<button class="btn btn-default">Guardar</button>
                <button class="btn btn-default">Vista Resumida</button>
                <button class="btn btn-default">Vista Global</button>';
        ///////////////////////////////////////////
        
        $this->load->model("ExplosionModel");
        $data['id'] = $this->ExplosionModel->newOrderGen();
        
        $this->load->view('vwHeader',$data);
        $this->load->view('vwInterface');
    }

    public function removeItem($id){
        $this->load->model("tabla_model");
        if($this->tabla_model->removeProduct($id)){
            $this->viewReload();
        }
    }
    public function viewReload() {

                $this->db->order_by('id_pedido', 'desc');
                $pedido = $this->db->get('pedido');
                $pedido = $pedido->row();
                $id = $pedido->id_pedido;
                $data['id'] = $id;
        $this->load->model('explosionModel');
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
        $data['buttonAditional'] = '<a target="_blank" class="btn btn-default" href="'.base_url().'index.php/vistaGlobal/index/'.$id.'">Vista Global</a>
                <a class="btn btn-default" target="_blank" href="'.base_url().'index.php/detailedList/showList/'.$id.'">Vista Detallada</a>';
        //////////////////////////
                
       $this->load->view('vwHeader', $data);
       $this->load->view('vwInterface');
    }

    public function editItem(){
        $datos["id"] = $this->input->post('id');
        $datos["cantidad"] = $this->input->post('cantidad');
        $this->load->model("tabla_model");
        if($this->tabla_model->editQuantity($datos)){
             $this->viewReload();
        }
    }
}