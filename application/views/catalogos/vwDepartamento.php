
<div class="container">
        <h1>Departamento</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar nuevo Departamento</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertDepartamento/<?php echo $catalogo?>" method="post">
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
                    <input type="button" value="Cancelar" class="btn btn-danger btn-sm">
                </td>
            </tr>
        </table>
    </form>
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