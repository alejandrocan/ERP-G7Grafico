<?php
class Productos_Model extends CI_Model {

	private $j;
	public function __construct() {
		parent:: __construct();
		$this->j = 0;
	}

	public function loadProduct($id) {
		$query = $this->db->get_where('producto', array('id_produc' => $id));
		$query = $query->result();
		foreach ($query as $registro) {
			$contenido['nombre'] = $registro->nombre;
			$udm = $this->db->get_where('udm', array('id_udm' => $registro->udm_produc));
			$udm = $udm->row();
			$udm = $udm->nombre;
			$contenido['udm'] = $udm;
			$familia = $this->db->get_where('familia', array('id_fam' => $registro->familia_produc));
			$familia = $familia->row();
			$familia = $familia->nombre;
			$contenido['familia'] = $familia;
			$depto = $this->db->get_where('departamento', array('id_depto' => $registro->depto_produc));
			$depto = $depto->row();
			$depto = $depto->nombre;
			$contenido['depto'] = $depto;
			$contenido['costo'] = $registro->costo_produc;
		}
		return $contenido;
	}

	public function ingredientes($id) {
		$this->idProduct = $id;
		$query = $this->db->get_where('producto_material', array('id_producto' => $id));
		$query = $query->result();
		foreach ($query as $registro) {
			if($registro->tipo_elemento == 'material') {
				$material = $this->db->get_where('material', array('id_material' => $registro->id_elemento));
				$material = $material->row();
				$material = $material->nombre;
			}
			if($registro->tipo_elemento == 'producto'){
				$material = $this->db->get_where('producto', array('id_produc' => $registro->id_elemento));
				$material = $material->row();
				$material = $material->nombre;
			}
			$ingredientes['material'][$this->j] = $material;
			$udm = $this->db->get_where('udm', array('id_udm' => $registro->udmid));
			$udm = $udm->row();
			$udm = $udm->nombre;
			$ingredientes['udm_material'][$this->j] = $udm;
			$ingredientes['cantidad_material'][$this->j] = $registro->cantidadusada;
			$ingredientes['costo_material'][$this->j] = $registro->costo;
			$this->j++;
		}
		return $ingredientes;
	}
	public function getCantidad() {
		return $this->j;
	}

	public function disabled($id){
		$data['estado'] = 0;
		$this->db->where('id_produc', $id);
		return $this->db->update('producto', $data);
	}
}