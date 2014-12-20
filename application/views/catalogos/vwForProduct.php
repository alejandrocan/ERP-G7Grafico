<div class="container table-responsive">
	<h1>Informacion sobre <?php echo $value;?></h1>
	<table class="table table-bordered table-hover">
		<tr>
			<th>Nombre</th>
			<th>Unidad de medida</th>
			<th>Costo</th>
			<th>Familia</th>
			<th>Departamento</th>
			<th>Acciones</th>
		</tr>
		<tr>
			<?php 
				echo '<td>'.$nombre.'</td>';
				echo '<td>'.$udm.'</td>';
				echo '<td>'.$costo.'</td>';
				echo '<td>'.$familia.'</td>';
				echo '<td>'.$depto.'</td>';
			?>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/productos/disableProduct/<?php echo $id;?>" class="btn btn-danger">Deshabilitar</a>
				<a href="<?php echo base_url(); ?>/index.php/NewProducts/AddMateriales/<?php echo $id;?>" class="btn btn-info">Editar Materiales</a>
			</td>
		</tr>
	</table>
	<table class="table table-bordered table-hover">
		<tr>
			<th>Material</th>
			<th>Unidad de medida</th>
			<th>Cantidad</th>
			<th>Costo</th>
		</tr>
		
		<?php 
		$j = 0;
		while ($j < $cantidad) {
			echo '<tr>';
			echo '<td>'. $material[$j] .'</td>';
			echo '<td>'. $udm_material[$j] .'</td>';
			echo '<td>'. $cantidad_material[$j] .'</td>';
			echo '<td>'. $costo_material[$j] .'</td>';
			$idm = $this->db->get_where('material', array('nombre' => $material[$j]));
			if($idm->num_rows() > 0){
				$idm = $idm->row();
				$idm = $idm->id_material;
			}
			else {
				$idm = $this->db->get_where('producto', array('nombre' => $material[$j]));
				$idm = $idm->row();
				$idm = $idm->id_produc;
			}
			

			
			
			echo '</tr>';
			$j++;
		}
			
		?>
			
		
	</table>
</div>