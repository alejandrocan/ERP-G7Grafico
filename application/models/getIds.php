<?php
class GetIds extends CI_Model {

	public function getUdmId($nombre) {
		$query = $this->db->get_where('udm', array('nombre' => $nombre));
		$query = $query->row();
		$query = $query->id_udm;
		return $query;
	}
	public function getFamiliaId($nombre) {
		$query = $this->db->get_where('familia', array('nombre' => $nombre));
		$query = $query->row();
		$query = $query->id_fam;
		return $query;
	}
	public function getDeptoId($nombre) {
		$query = $this->db->get_where('departamento', array('nombre' => $nombre));
		$query = $query->row();
		$query = $query->id_depto;
		return $query;
	}
}