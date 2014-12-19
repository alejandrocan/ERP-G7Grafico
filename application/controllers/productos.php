<?php
if( !defined('BASEPATH'))
	exit("No direct script access allowed");
class Productos extends CI_Controller {

	public function __construct(){
		parent:: __construct();
	}

	public function chargeProductos() {

		if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        $this->load->model('tabla_model');

		$data['value'] = $this->input->post('resources');
		$query = $this->db->get_where('producto', array('nombre' => $data['value']));
		$query = $query->row();
		$data['id'] = $query->id_produc;
		$this->idProducto = $data['id'];
		$this->load->model('productos_Model');
		$contenido = $this->productos_Model->loadProduct($data['id']);
		$producto['nombre'] = $contenido['nombre'];
		$producto['udm'] = $contenido['udm'];
		$producto['costo'] = $contenido['costo'];
		$producto['familia'] = $contenido['familia'];
		$producto['depto'] = $contenido['depto'];

		$ingredientes = $this->productos_Model->ingredientes($data['id']);
		$contador = $this->productos_Model->getCantidad();
		$temp = 0;
		while ($temp < $contador) {
			$producto['material'][$temp] = $ingredientes['material'][$temp];
			$producto['udm_material'][$temp] = $ingredientes['udm_material'][$temp];
			$producto['cantidad_material'][$temp] = $ingredientes['cantidad_material'][$temp];
			$producto['costo_material'][$temp] = $ingredientes['costo_material'][$temp];
			$temp++;
		}
		$producto['cantidad'] = $temp;
		$this->load->view('vwHeader', $data);
		$this->load->view("catalogos/vwForProduct", $producto);
	}

	public function disableProduct($id) {

		if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        {
            redirect(base_url().'index.php/login2');
        }
        $data['user']=$this->session->userdata('user');
        $data['title'] = 'Sistema G7 Gráfico';
        $this->load->model('tabla_model');

		$this->load->model('productos_Model');
		if($this->productos_Model->disabled($id)) {
			redirect('/catalogos/index/producto/registro');

		}
	}
}