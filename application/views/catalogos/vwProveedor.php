<div class="container">
        <h1>PROVEEDOR</h1>
    </div>
    <div class="">
        <h3>Agregar registro </h3>
        <form action="<?php echo base_url();?>index.php/proveedor/insertarRegistro" method="post">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Contacto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-control" value="" type="text" name="Nombre"></td>
                        <td><input class="form-control" value="" type="text" name="Direccion"></td>
                        <td><input class="form-control" value="" type="text" name="Telefono"></td>
                        <td><input class="form-control" value="" type="text" name="Correo"></td>
                        <td><input class="form-control" value="" type="text" name="Contacto"></td>
                        <td>
                            <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                            <input type="submit" value="Cancelar" class="btn btn-danger btn-sm">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="">
        <h3>Registros</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($registros) > 0 )
                    {
                        foreach ($registros as $registro) {
                            $columnas = $this->db->list_fields('proveedor');
                            if($registro->estado==1)
                            {
                                echo '<tr>';
                                $estado = '<a class="btn btn-success btn-sm" href="" role="button">Habilitar</a>';
                            }
                            else
                            {
                                echo '<tr class="danger">';
                                $estado = '<a class="btn btn-danger btn-sm" href="" role="button">Deshabilitar</a>';
                            }
                            
                            echo '  <td>' . $registro->id_proveedor . '</td>';
                            echo '  <td>' . $registro->nombre . '</td>';
                            echo '  <td>' . $registro->dir_prove . '</td>';
                            echo '  <td>' . $registro->tel_prove . '</td>';
                            echo '  <td>' . $registro->correo_prove . '</td>';
                            echo '  <td>' . $registro->contacto . '</td>';
                            echo '  <td>';
                            echo $estado;
                            echo '      <a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#" role="button">Editar</a>';
                            echo '      <a class="btn btn-primary btn-sm" href="#" role="button">Duplicar</a>';
                            echo '  </td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>