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
				<a href="#" class="btn btn-success">Agregar Materiales</a>
			</td>
		</tr>
	</table>
	<table class="table table-bordered table-hover">
		<tr>
			<th>Material</th>
			<th>Unidad de medida</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>Acciones</th>
		</tr>
		
		<?php 
		$j = 0;
		while ($j < $cantidad) {
			echo '<tr>';
			echo '<td>'. $material[$j] .'</td>';
			echo '<td>'. $udm_material[$j] .'</td>';
			echo '<td>'. $cantidad_material[$j] .'</td>';
			echo '<td>'. $costo_material[$j] .'</td>';
			echo '<td><input class ="btn btn-danger" type="button" value="Remover"></td>';
			echo '</tr>';
			$j++;
		}
			
		?>
			
		
	</table>
</div>