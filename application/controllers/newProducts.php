<?php
class NewProducts extends CI_Controller {
	public $udm;
	public $material = "";
	public function addMateriales($nombre) {
		$data['estado'] = 0;
		$this->db->where('id_produc',$nombre);
		$this->db->update('producto', $data);
		if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        ///////////////////////////////////////////
        $idproduct = $nombre;
		$data['id_producto'] = $idproduct;
        $productName = $this->db->get_where('producto', array('id_produc' =>$nombre));
        $productName = $productName->result();
        foreach ($productName as $producto) {
        	$nombre = $producto->nombre;
        }
        $data['udm'] = $this->udm;
        $data['material'] = $this->material;
		$data['producto'] = $nombre;
		
		$this->load->view('vwHeader', $data);
		$this->load->view('/catalogos/vwAddMaterial');
	}
	public function genProduct() {
		$this->load->model('getIds');

		$productName = $this->input->post('nombre');
		$productUdm = $this->input->post('udm');
		$productfamilia = $this->input->post('familia');
		$productDepto = $this->input->post('departamento');
		$data['nombre'] = $productName;
		$data['udm_produc'] = $this->getIds->getUdmId($productUdm);
		$data['familia_produc'] = $this->getIds->getFamiliaId($productfamilia);
		$data['depto_produc'] = $this->getIds->getDeptoId($productDepto);
		$data['estado'] = 0;
		$this->db->insert('producto', $data);
		$idproduct = $this->db->get_where('producto', array('nombre' => $productName));
		$idproduct = $idproduct->result();
		foreach ($idproduct as $reg) {
			$id_produc = $reg->id_produc;
		}
		
		
		header('Refresh:1;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$id_produc);
	}
	
	public function loadMaterial() {
		$material = $this->input->post('material');
		$id_produc = $this->input->post('idProducto');
		 
		$query = $this->db->get_where('material', array('nombre' => $material));
		
		if($query->num_rows() > 0){
			$query = $query->result();
			foreach ($query as $mat) {
				$this->material = $mat->nombre;
				
				$this->udm = $mat->udm_material;
				
			}
			$query = $this->db->get_where('udm', array('id_udm' => $this->udm));
			$query = $query->row();
			$this->udm = $query->nombre;
			$this->addMateriales($id_produc);
		}else {
			$query = $this->db->get_where('producto', array('nombre' => $material));
			$query = $query->result();
			foreach ($query as $mat) {
				$this->material = $mat->nombre;
				
				$this->udm = $mat->udm_produc;
				
			}
			$query = $this->db->get_where('udm', array('id_udm' => $this->udm));
			$query = $query->row();
			$this->udm = $query->nombre;
			$this->addMateriales($id_produc);
		}
		
		
		#header('Refresh:2;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$id_produc);
	}
	public function deleteMaterial($idm, $idp) {
		$this->db->delete('producto_material', array('id_elemento' => $idm, 'id_producto' => $idp));
		$this->addMateriales($idp);
	}
	public function editItem(){
        $datos["idproduct_mat"] = $this->input->post('id');
        $id_produc = $this->input->post('id_producto');
        $id = $this->input->post('idProducto');
        $datos["cantidadusada"] = $this->input->post('cantidad');

        $query = $this->db->get_where('producto_material', array('idproduct_mat' => $datos['idproduct_mat']));
        $query = $query->row();
        $id_elemento = $query->id_elemento;
        $tipo = $query->tipo_elemento;
        if($tipo == 'material'){
        	$query = $this->db->get_where('material', array('id_material' => $id_elemento));
        	$query = $query->row();
        	$datos['costo'] = $query->ultimo_costo * $query->factor_redimiento * $datos['cantidadusada'];
        }
        if($tipo == 'producto'){
        	$query = $this->db->get_where('producto', array('id_produc' => $id_elemento));
        	$query = $query->row();
        	$datos['costo'] = $query->costo_produc * $datos['cantidadusada'];
        }


        $this->load->model("productos_Model");
        if($this->productos_Model->editQuantity($datos)){
             $this->addMateriales($id);
        }
    }
}