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
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[50]|trim|callback_isUniqueNPr');
		$this->form_validation->set_rules('udm', 'Unidad_de_Medida', 'required');
		$this->form_validation->set_rules('familia', 'Familia', 'required');
		$this->form_validation->set_rules('departamento', 'Departamento', 'required');
		$this->form_validation->set_rules('tiempo', 'Tiempo de Elaboración', 'required|trim|exact_length[8]|callback_FormatoTiempo');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no puede estar vacío</div>');
		$this->form_validation->set_message('max_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s no debe no puede contener más de %d caracteres</div>');
		$this->form_validation->set_message('isUniqueNPr', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El valor del campo %s, ya se ha utilizado por otro Producto. Ingrese uno diferente.</div>');
		$this->form_validation->set_message('FormatoTiempo', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe tener el formato 24:59:59 -> Horas:Minutos:Segundos (HH:MM:SS) Valores máximos y mínimos posibles: 99:59:59, 00:00:00</div>');
		$this->form_validation->set_message('exact_length', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>Problemas al Agregar. El campo %s debe tener el formato 24:59:59 -> Horas:Minutos:Segundos (HH:MM:SS) Valores máximos y mínimos posibles: 99:59:59, 00:00:00</div>');

		if ($this->form_validation->run() == TRUE) 
        {
			$this->load->model('getIds');
			$data['nombre'] = $this->input->post('nombre');
			$data['udm_produc'] = $this->input->post('udm');
			$data['familia_produc'] = $this->input->post('familia');
			$data['depto_produc'] = $this->input->post('departamento');
			$data['tiempo_elaboracion'] = $this->input->post('tiempo');
			$data['estado'] = 0;
			$this->db->insert('producto', $data);
			$idproduct = $this->db->get_where('producto', array('nombre' => $data['nombre']));
			$idproduct = $idproduct->result();
			foreach ($idproduct as $reg) {
				$id_produc = $reg->id_produc;
			}
			header('Refresh:1;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$id_produc);
		}
		else
		{
			if($this->session->userdata('tipo_usr') == FALSE || $this->session->userdata('tipo_usr') != 'Administrador')
        	{
            	redirect(base_url().'index.php/login2');
        	}
        	$data['user']=$this->session->userdata('user');
        	$data['title'] = 'Sistema G7 Gráfico';
			$this->load->view("vwHeader", $data);
			$this->load->view('catalogos/vwProductos',null);
			//header('Refresh:1;url="' . base_url() . '/index.php/catalogos/index/producto/registros/');
		}
	}

	public function FormatoTiempo()
	{
		$tiempo = $this->input->post('tiempo');
		for($i=0;$i<strlen($tiempo);$i++)
		{
			if($i==2||$i==5)
			{
				if(!$tiempo[$i]==":")
					return FALSE;
			}
			else
			{
				if(!is_numeric($tiempo[$i]))
					return FALSE;
				else
				{
					if($i==4||$i==7)
					{
						$numero = substr($tiempo, $i-1,$i);
						if($numero>59)
							return FALSE;
					}
				}

			}
		}
		return TRUE;
	}

	public function isUniqueNPr()
	{
		$nombre = $this->input->post("nombre");
        $query = $this->db->get_where('producto', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
			return TRUE;
        else
        	return FALSE;
	}
	
	public function loadMaterial() {
		$this->form_validation->set_rules('material', 'Material/Producto', 'required|trim|callback_ifexist');

		$this->form_validation->set_message('required', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>No ha ingresado ningún Producto/Material</div>');
		$this->form_validation->set_message('ifexist', '<div class="container alert alert-warning alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button>El Producto/Material ingresado no existe</div>');

		$material = $this->input->post('material');
		$id_produc = $this->input->post('idProducto');

		if ($this->form_validation->run() == TRUE) 
        {
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
		}
		else
		{
			header('Refresh:1;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$id_produc);
		}
		
		
		#header('Refresh:2;url="' . base_url() . '/index.php/NewProducts/addMateriales/'.$id_produc);
	}

	public function ifexist()
	{
		$nombre = $this->input->post("material");
        $query = $this->db->get_where('producto', array(//making selection
            'nombre' => $nombre
        ));
        $count = $query->num_rows(); //counting result from query
        if ($count === 0)
		{
	        $query = $this->db->get_where('material', array(//making selection
	            'nombre' => $nombre
	        ));
	        $count = $query->num_rows(); //counting result from query
	        if ($count === 0)
				return FALSE;
	        else
	        	return TRUE;
		}
        else
        	return TRUE;
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