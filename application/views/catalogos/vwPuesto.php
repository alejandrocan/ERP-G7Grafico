
<div class="container">
        <h1>Puesto</h1>
</div>
    <div class="container table-responsive">
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar nuevo Puesto</h3>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php echo form_open_multipart(base_url()."index.php/catalogos/insertPuesto/puesto")?>
                <td><input class="form-control" value="" type="text" name="Nombre"></td>                    
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                    <a href="<?php echo base_url(). 'index.php/catalogos/index/proveedor'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                </td>
                <?php echo form_close();?>
            </tr>
        </tbody>
        </table>
    </div>
    <?php if(@$error2){?>
        <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
    <?php }?>

<div class="container table-responsive">
    <h3>Descripcion</h3>
    <table class="table table-bordered table-hover table-responsive">
        <thead>
            <tr>
            	<th>ID</th>
	            <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(count($registros) > 0 )
                {
                    foreach ($registros as $registro) {
                        $columnas = $this->db->list_fields('puesto');
                        if($registro->estado==1)
                        {
                            echo '<tr>';
                            $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_puesto . ' role="button">Deshabilitar</a>';                        
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_puesto . ' role="button">Habilitar</a>';                            
                        }                 
                        echo '  <td>' . $registro->id_puesto . '</td>';
                        echo '  <td>' . $registro->nombre . '</td>';
                        echo '<td>';
                        echo '      <a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#" role="button">Editar</a>';
                        echo '      <a class="btn btn-primary btn-sm" href="#" role="button">Duplicar</a>';
                        echo $estado;
                        echo '  </td>';
                        echo '</tr>';
                    }
                }
            ?>    
        </tbody>
    </table>
</div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

</body>
</html>