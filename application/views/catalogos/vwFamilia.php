
<div class="container">
        <h1>Familia</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar nueva Familia</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertFamilia/<?php echo $catalogo?>" method="post">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <td><input class="form-control" value="" type="text" name="nombre"></td>                    
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                    <input type="button" value="Cancelar" class="btn btn-danger btn-sm" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
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
                        $columnas = $this->db->list_fields('familia');
                        if($registro->estado==1)
                        {
                            echo '<tr>';
                            $estado = '         <a class="btn btn-success btn-sm" href="" role="button">Habilitar</a>';
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '         <a class="btn btn-danger btn-sm" href="" role="button">Deshabilitar</a>';
                        }                        
                        echo '  <td>' . $registro->id_fam . '</td>';
                        echo '  <td>' . $registro->nombre . '</td>';
                        echo '<td>';
                        echo '      <a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#" role="button">Editar</a>';
                        echo '      <a class="btn btn-primary btn-sm" href="#" role="button">Duplicar</a>';
                        echo $estado;
                        echo '  </td>';
                        echo '</tr>';
                        echo '<div class="modal fade" id="'.$registro->id_fam.'" tabindex="-1" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-dialog">';
                        echo '    <div class="modal-content">';
                        echo '        <div class="modal-header">';
                        echo '            <h2>Editar <?php echo $registro->id_fam;?></h2>';
                        echo '        </div>';
                        echo '        <form id="form<?php echo $registro->id_fam;?>"action="<?php echo base_url();?>index.php/catalogos/updateFamilia/<?php echo $catalogo?>" method="post">';
                        echo '        <div class="modal-body">';
                        echo '                <label>ID <?php echo $registro->id_fam;?></label></br>';
                        echo '                <input class="form-control hidden" value="<?php echo $registro->id_fam;?>" type="text" name="id_fam">';                        
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