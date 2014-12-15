<?php
if (!defined('BASEPATH')) 
		exit('No direct script access allowed');

class List_model extends  CI_Model {

	public function getPedido($id_pedido){
		$this->db->where('no_pedido',$id_pedido);
		$variable = $this->db->get("explosion");
		return $variable->result();
	}

	public function getNombreProducto($id_producto){
		$this->db->where('id_produc',$id_producto);
		$variable = $this->db->get('producto');
		return $variable->result();
	}

	public function getElementos($id_producto){
		$this->db->where('id_producto',$id_producto);
		$variable = $this->db->get('producto_material');
		return $variable->result();
	}

	public function getMaterial($id_material){
		$this->db->where('id_material',$id_material);
		$variable = $this->db->get('material');
		return $variable->result();
	}

	public function getUdm($id_udm){
		$this->db->where('id_udm',$id_udm);
		$variable = $this->db->get('udm');
		return $variable->result();
	}
}