<?php
class NewProducts extends CI_Controller {

	public function addMateriales($nombre) {
		if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        ///////////////////////////////////////////
        $productName = $this->db->get_where('producto', array('id_produc' =>$nombre));
        $productName = $productName->row();
        $productName = $productName->nombre;
		$data['producto'] = $productName;
		$idproduct = $nombre;
		$data['id_producto'] = $idproduct;
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
		
		header('Refresh:1;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$productName);
	}
	
}