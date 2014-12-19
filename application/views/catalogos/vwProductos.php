<!--Apartado de insertar-->
<div class="container table-responsive">
        <h3>Agregar Nuevo producto</h3>
        <form action="<?php echo base_url();?>index.php/newProducts/genProduct" method="post">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>	
                <th>Unidad_de_medida</th>
                <th>Familia</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <td><input class="form-control" value="" type="text" name="nombre"></td>    
                
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
                        	<option><?php echo $valor->nombre; ?></option>
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
    <form class="navbar-form navbar-left" role="search" action="<?php echo base_url();?>/index.php/productos/chargeProductos" method="post">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Producto" name="resources" id="resources">
        </div>
        
        <button type="submit" class="btn btn-success">Buscar</button>
    </form>
    </div>
    <script type="text/javascript">
		$(document).ready(function(){
			 var url = '<?php echo base_url();?>index.php/autocompletar/get_data_producto';
			$('#resources').autocomplete({
			    source: url+'?item=nombre'
			});
		});
	</script>
	

</body>
</html>
