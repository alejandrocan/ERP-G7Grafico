<!--Apartado de insertar-->
<div class="container table-responsive">
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar Nuevo producto</h3>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>	
                <th>Unidad_de_medida</th>
                <th>Familia</th>
                <th>Departamento</th>
                <th>Tiempo de elaboración</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <?php echo form_open_multipart(base_url()."index.php/newProducts/genProduct")?>
                <td><input class="form-control" value="<?php echo set_value('nombre','');?>" type="text" name="nombre"></td>    
                <td>
                    <select class="form-control" name ="udm">
                        <?php
                            $this->db->where('estado','1');                         
                            $query = $this->db->get("udm");
                            $valores = $query->result(); 
                                foreach ($valores as $valor)
                                    echo '<option value="' . $valor->id_udm . '" ' . set_select('udm',$valor->id_udm,'TRUE') . '>' . $valor->nombre . '</option>';                 
                        ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" name ="familia">
                        <?php 
                            $this->db->where('estado','1');                         
                            $query = $this->db->get("familia");
                            $valores = $query->result(); 
                                foreach ($valores as $valor)
                                    echo '<option value="' . $valor->id_fam . '" ' . set_select('familia',$valor->id_fam,'TRUE') . '>' . $valor->nombre . '</option>';                   
                        ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" name ="departamento">
                        <?php
                            $this->db->where('estado','1');                         
                            $query = $this->db->get("departamento");
                            $valores = $query->result(); 
                                foreach ($valores as $valor)
                                    echo '<option value="' . $valor->id_depto . '" ' . set_select('departamento',$valor->id_depto,'TRUE') . '>' . $valor->nombre . '</option>';                 
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="tiempo" class="form-control">
                </td>
                <td>
                    <button type="submit" class="btn btn-info btn-sm">Agregar</button>
                    <input type="reset" value="Cancelar" class="btn btn-danger btn-sm" action="" method="post" >
                </td>
                <?php echo form_close();?>
            </tr>
        </table>
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
