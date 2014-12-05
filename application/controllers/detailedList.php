<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class DetailedList extends CI_Controller
{

    public $variableGlobal = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('list_model');
    }

    public function showList($id_pedido){
	
			$variable = $this->list_model->getPedido($id_pedido);
			$this->variableGlobal .= '<table class="table table-bordered table-hover"><tr><td class="danger">Nombre</td><td class="danger">udm</td><td class="danger">Cantidad</td><td class="danger">Costo</td></tr><tr>';
			foreach ($variable as $var) {
				$this->variableGlobal .= '<tr>';
				if($var->tipo == 'producto'){
					$this->variableGlobal .= '<td>';
					$this->showProducto($var->id_producto,$var->cantidad,0);
				}
				else {
					$this->variableGlobal .= '<td>';
					$this->showMaterial($var->id_producto,$var->cantidad);
				}
				#$this->variableGlobal .= '</li>';
			}
			$this->variableGlobal .= '</tr></table>';
			$this->load->view('vwDetailedList',$this->variableGlobal);
    }

    public function showProducto($id,$cantidad,$veces){
    	$variable = $this->list_model->getNombreProducto($id);
    	foreach ($variable as $var) {
			$this->variableGlobal .= $var->nombre;
			$this->variableGlobal .= '</td><td>';
			$this->variableGlobal .= $var->udm_produc;
			$this->variableGlobal .= '</td><td>';
			$this->variableGlobal .= $cantidad;
			$this->variableGlobal .= '</td></tr>';
    		#$this->variableGlobal .= '<ul style="list-style-type:none">';
			$variable2 = $this->list_model->getElementos($id);
			$this->variableGlobal .= '<tr>';
			for($i = 0; $i <= $veces; $i++)
					$this->variableGlobal .= '<td style="border: inset 0pt"></td>';
			$this->variableGlobal .='<td class="danger">Nombre</td><td class="danger">udm</td><td class="danger">Cantidad</td><td class="danger">Costo</td></tr><tr>';
			foreach ($variable2 as $var2) {
				for($i = 0; $i <= $veces; $i++)
					$this->variableGlobal .= '<td style="border: inset 0pt"></td>';
				$this->variableGlobal .= '<td>';
				if($var2->tipo_elemento == 'Producto'){
					$this->showProducto($var2->id_elemento,$var2->cantidadusada,$veces+1);
				}
				else{
					$this->showMaterial($var2->id_elemento,$var2->cantidadusada);
				}
				$this->variableGlobal .= '</tr>';
			}
		}
		#$this->variableGlobal .= '</ul>';
		return true;
	}

	public function showMaterial($id,$cantidad){
		$variable = $this->list_model->getMaterial($id);
		foreach ($variable as $var) {
			#$this->variableGlobal .= '<td>';
			$this->variableGlobal .= $var->nombre;
			$this->variableGlobal .= '</td><td>';
			$this->variableGlobal .= $var->udm_material;
			$this->variableGlobal .= '</td><td>';
			$this->variableGlobal .= $cantidad;
			$this->variableGlobal .= '</td><td>';
			$this->variableGlobal .= $var->ultimo_costo;
			$this->variableGlobal .= '</td>';
		}
		return true;
	}
}