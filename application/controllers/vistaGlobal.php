<?php
if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class VistaGlobal extends CI_Controller {

	public $LISTAMATERIALES = array();

	function __construct() {
        parent::__construct();
    }


    public function index($folio)
    {
    	$this->db->order_by('tipo','DESC');
    	$this->db->where('no_pedido',$folio);
    	$query = $this->db->get('explosion');
    	$query = $query->result();
    	foreach ($query as $row) {
    		if($row->tipo=='Material')
    		{
    			$this->agregarMateriales($row->cantidad,$row->id_producto);
    		}
    		else
    		{
    			$this->obtenerMateriales($row->id_producto,$row->cantidad);
    		}
    		
    	}
    	$this->load->view('explosion/vwGlobal',$this->LISTAMATERIALES);
	    
    }

    public function obtenerMateriales($id,$cant)
    {
  		$this->db->where('id_producto',$id);
		$queryproducto = $this->db->get('producto_material');
	    $queryproducto = $queryproducto->result();
	    foreach ($queryproducto as $material) {
	    	if($material->tipo_elemento=='Material')
	    		$this->agregarMateriales($cant*$material->cantidadusada,$material->id_elemento);
	    	else
	    		$this->obtenerMateriales($material->id_elemento,$cant);
	    }
	    
    }

    public function agregarMateriales($cant,$id)
    {
    	$verif = 0;
    	$this->db->where('id_material',$id);
    	$querymaterial = $this->db->get('material');
    	$querymaterial = $querymaterial->result();
    	foreach ($querymaterial as $lel) {
	    	$cuenta = count($this->LISTAMATERIALES);
	    	for($i=0;$i<$cuenta;$i++)
	    	{
	    		if($this->LISTAMATERIALES[$i][0]==$id)
	    		{
	    			$verif = 1;
	    			$this->LISTAMATERIALES[$i][2] = $this->LISTAMATERIALES[$i][2]+$cant*$lel->factor_redimiento;
	    			$this->LISTAMATERIALES[$i][4] = ($lel->ultimo_costo*$lel->factor_redimiento*$cant)+$this->LISTAMATERIALES[$i][4];   	
	    		}
	    	}
	    	if($verif == 0)
	    	{
	    		$this->LISTAMATERIALES[$cuenta][0] = $lel->id_material;
	    		$this->LISTAMATERIALES[$cuenta][1] = $lel->nombre;
	    		$this->LISTAMATERIALES[$cuenta][2] = $cant*$lel->factor_redimiento;
	    		$this->LISTAMATERIALES[$cuenta][3] = $lel->ultimo_costo;
	    		$this->LISTAMATERIALES[$cuenta][4] = $lel->ultimo_costo*$lel->factor_redimiento*$cant; 
	    	}
    		# code...
    	}


    }
}