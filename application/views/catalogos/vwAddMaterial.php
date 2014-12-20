<script type="text/javascript">
$(document).ready(function(){

 $('tr:odd').css('background', '#e3e3e3');
 var url = '<?php echo base_url();?>index.php/autocompletar/get_data'; 

 $('#buscar').autocomplete({
    source: url+'?item=nombre'
  });

});    
</script>

<div class="container">
	<h1>Materiales para <?php echo $producto;?></h1>
	<?php 
		$query = $this->db->get_where('producto', array('nombre' => $producto));
		$query = $query->result();
		foreach ($query as $valor) {			
			$id_producto = $valor->id_produc;
		}
	?>
	<form class="navbar-form navbar-left" role="search" action="<?php echo base_url();?>/index.php/newProducts/loadMaterial" method="post">
    	<div class="form-group">
        	<input type="text" class="form-control" placeholder="Producto/Material" id="buscar" name="material">
      	</div>
      	<button type="submit" class="btn btn-default">Agregar</button>
    </form>

<form method="post" action="<?php echo base_url(); ?>/index.php/catalogos/addNewMaterial/">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>		
			<th>Material</th>
			<th>Cantidad usada</th>
			<th>UDM</th>
			<th>Acciones</th>
		</tr>
		</thead>
		<tr>		
			<td><input class="form-control" value="<?php echo $material?>" type="text" name="elemento" readonly></td>
			<td><input class="form-control" value="" type="text" name="cant_usada"></td>
			<input class="hidden" value= "<?php echo $producto;?>" type="text" name="nombreProducto">
			<input class="hidden" value= "<?php echo $id_producto;?>" type="text" name="idProducto">
			<td><input type="text" class="form-control" name="udm" value="<?php echo $udm; ?>" readOnly></td>
			<td>
                    <button type="submit" class="btn btn-info btn-sm">Agregar</button>
                    <input type="reset" value="Cancelar" class="btn btn-danger btn-sm" />
                    <a class="btn btn-success btn-sm" href="<?php echo base_url();?>/index.php/catalogos/upProducto/<?php echo $producto. "/". $id_producto; ?>">Terminar</a>
            </td>
		</tr>
	</table>
</form>
	<table class="table table-bordered table-hover">
		<tr>
			<td>Material</td>
			<td>Cantidad Usada</td>
			<td>UDM</td>
			<td>Costo</td>
			<td>Acciones</td>
		</tr>
			<?php
				$query = $this->db->get_where('producto_material', array('id_producto' => $id_producto));
				$query = $query->result();
				foreach ($query as $valor) {
					echo '<tr>';
					//////////////
					$query2 = $this->db->get_where('material', array('id_material' => $valor->id_elemento));
					$query2 = $query2->result();
					if($query2 != null){
						foreach ($query2 as $registro) {
							if($registro->id_material == $valor->id_elemento){ 
								$nombre = $registro->nombre;
								$idm = $valor->id_elemento;
							}
						}
					}else{
						$query2 = $this->db->get('producto');
						$query2 = $query2->result();
						foreach ($query2 as $registro) {
							if($registro->id_produc == $valor->id_elemento){
								$nombre = $registro->nombre;
								$idm = $valor->id_elemento;
							}
						}
					}
					$query = $this->db->get_where('udm', array('id_udm' => $valor->udmid));
					$query = $query->row();
					$unidadmediad = $query->nombre;
					//////////////
					echo '<td>'. $nombre . '</td>';
					echo '<td>'. $valor->cantidadusada .'</td>';
					echo '<td>'. $unidadmediad.'</td>';
					echo '<td>'. $valor->costo.'</td>';
					echo '<td><a class="btn btn-danger btn-sm" href="'.base_url().'/index.php/newProducts/deleteMaterial/'.$idm.'/'.$id_producto.'">Remove</a><a class="btn btn-info btn-sm" href="#">Modificar</a></td>';
					echo '</tr>';
				}
			?>
	</table>
</div>
</body>
</html>

