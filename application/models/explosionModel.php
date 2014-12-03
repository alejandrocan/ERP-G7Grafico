<?php if(!defined("BASEPATH")) exit ("No direct script access allowed");

class ExplosionModel extends CI_Model {

	public function viewInserts($id){
		$this->db->where("no_pedido", $id);
		$query = $this->db->get("explosion");

	}
	public function newOrderGen() {
		$this->db->query("insert into pedido(fecha) values(curdate());");
		$this->db->order_by("id_pedido" . ' desc');
		$query = $this->db->get("pedido");
		$registros = $query->result();
		$newid = "no paso nada aun";
		foreach ($registros as $registro) {
			$newid = $registro->id_pedido;
			break;
		}
		return $newid;
	}
	public function insertvalues($no_pedido, $id_producto, $tipo, $cantidad, $udm, $costo){
		$this->db->query("insert into explosion values(null,".$no_pedido.",".$id_producto.",'".$tipo."',".$cantidad.",'".$udm."', ".$costo.", ".$costo*$cantidad.")");	}
}