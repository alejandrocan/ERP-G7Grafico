
<div class="container">
        <h1>Departamento</h1>
</div>
    <div class="container table-responsive">
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar nuevo Departamento</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>                
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php echo form_open_multipart(base_url()."index.php/catalogos/insertDepartamento/departamento")?>
                    <td><input class="form-control" value="" type="text" name="Nombre"></td>                    
                    <td>
                        <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                        <a href="<?php echo base_url(). 'index.php/catalogos/index/departamento'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                    </td>
                    <?php echo form_close();?>
                </tr>
            </tbody>
        </table>
    </div>

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
                        $columnas = $this->db->list_fields('departamento');
                        if($registro->estado==1)
                        {
                            echo '<tr>';
                            $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_depto . ' role="button">Deshabilitar</a>';                        
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_depto . ' role="button">Habilitar</a>';                            
                        }              
                        echo '  <td>' . $registro->id_depto . '</td>';
                        echo '  <td>' . $registro->nombre . '</td>';
                        echo '<td>';
                        echo '      <a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#" role="button">Editar</a>';
                        echo '      <a class="btn btn-primary btn-sm" href="#" role="button">Duplicar</a>';
                        echo $estado;
                        echo '  </td>';
                        echo '</tr>';
                        echo '<div class="modal fade" id="'.$registro->id_depto.'" tabindex="-1" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '        <div class="modal-header">';
                        echo '            <h2>Editar <?php echo $registro->id_depto;?></h2>';
                        echo '        </div>';
                        echo '        <form id="form<?php echo $registro->id_depto;?>"action="<?php echo base_url();?>index.php/catalogos/updateDepartamento/<?php echo $catalogo?>" method="post">';
                        echo '        <div class="modal-body">';                                    
                        echo '                <label>ID <?php echo $registro->id_depto;?></label></br>';
                        echo '                <input class="form-control hidden" value="<?php echo $registro->id_depto;?>" type="text" name="id_depto">';
                        echo '                <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>';                                                                                
                        echo '        </div>';
                        echo '        <div class="modal-footer">';
                        echo '            <button type="submit" class="btn btn-primary" >Actualizar</button>';
                        echo '        </div>';
                        echo '        </form>';
                        echo '    </div>';
                        echo '</div>';
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