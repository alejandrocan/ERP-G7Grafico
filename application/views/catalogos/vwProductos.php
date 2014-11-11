<!--Apartado de insertar-->
<div class="container table-responsive">
        <h3>Agregar Nuevo producto</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertProducto/<?php echo $catalogo?>" method="post">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Unidad_de_medida</th>
                <th>Familia</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <td><input class="form-control" value="" type="text" name="nombre"></td>    
                <td><input class="form-control" value="" type="text" name="cantidad"></td>  
                <td><select class="form-control" name ="udm">
                    <?php 
                        $query = $this->db->get("udm");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                    	<?php if($valor->estado == 1): ?>
                        	<option><?php echo $valor->nombre; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </td>

                <td><select class="form-control" name ="familia">
                    <?php 
                        $query = $this->db->get("familia");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                    	<?php if($valor->estado == 1): ?>
                        	<option><?php echo $valor->nombre; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </td>


                <td><select class="form-control" name ="departamento">
                    <?php
                        $query = $this->db->get("departamento");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                    	<?php if ($valor->estado == 1): ?>
                        	<option><?php echo $valor->nombre_depto; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </td>
                
                <td>
                    
                    <button type="submit" class="btn btn-info btn-sm">
  						Agregar
					</button>
                    <input type="reset" value="Cancelar" class="btn btn-danger btn-sm" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
    </div>

<?php if(count($registros) > 0): ?>
	<!--Muestra los regitros en caso de existir-->
	<div class="panelgroup container" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($registros as $registro): ?>
		<div class="panel panel-default">
			<div class="panel-heading" role="tab">
				<h4 class="panel-title">
					<a href="#<?php echo $registro->id_produc; ?>" data-toggle="collapse" data-parents="#accordion">

						<?php echo $registro->nombre; ?>
					</a>
				</h4>
			</div>
			<!--Contenido-->
			<div id="<?php echo $registro->id_produc;?>" class="panel-collapse collapse">
				<div class="panel-body">
					<!--Muestra el contenido de la tabla principal-->
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Cantidad</th>
								<th>UDM</th>
								<th>Costo</th>
								<th>Familia</th>
								<th>Departamento</th>
							</tr>

							<tr>
								<td><?php echo $registro->id_produc; ?></td>
								<td><?php echo $registro->nombre; ?></td>
								<td><?php echo $registro->cantidad_produc; ?></td>
								<!--unida de medida-->
								<?php 
		                            $udm = $this->db->get("udm");
		                            $valor = $udm->result();
		                            foreach ($valor as $v) {
		                                if($v->id_udm == $registro->familia_produc){
		                                    break;
		                                }
		                                
		                            }
		                        ?>
								<td><?php echo $v->nombre; ?></td>

								<td><?php echo $registro->costo_produc; ?></td>

								<!--Familia-->
								<?php 
		                            $fam = $this->db->get("familia");
		                            $valor = $fam->result();
		                            foreach ($valor as $v) {
		                                if($v->id_fam == $registro->familia_produc){
		                                    break;
		                                }
		                                
		                            }
		                        ?>
								<td><?php echo $v->nombre; ?></td>
								<!--Depto-->
								<?php 
		                            $dpt = $this->db->get("departamento");
		                            $valor = $dpt->result();
		                            foreach ($valor as $v) {
		                                if($v->id_depto == $registro->depto_produc){
		                                    break;
		                                }
		                                
		                            }
		                        ?>
								<td><?php echo $v->nombre_depto; ?></td>
							</tr>

						</thead>
					</table>
					<!--Muestra el contenido del material del producto-->
					<h4>Material</h4>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad usada</th>
								<th>UDM</th>
								<th>Costo</th>
							</tr>

							<tr>
								<?php $query = $this->db->get("producto_material");
									$materiales = $query->result();
								?>
								<!--Validacion si es un material o un producto-->
								<?php foreach ($materiales as $material): ?>
									<?php if($material != 0): ?>
									<!--En case de ser material-->
										<td><?php $material->materialid ?></td>
									<?php else: ?>
									<!--En case de ser producto-->
									<?php endif; ?>
										<td><?php $material->productoid ?></td>
								<?php endforeach; ?>

							</tr>

						</thead>
					</table>
				</div>

			</div>
		</div>
		<?php endforeach; ?>
	</div>

<?php else: ?>
	<h4>No hay registros</h4>
<?php endif; ?>

<script src="<?php echo base_url();?>js/jquery.js"></script>
</body>
</html>
