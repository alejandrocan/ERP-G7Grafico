    <div class="container">
        <h1>UMD</h1>
    </div>
    <div class="container">
        <h3>Agregar registro <small>UMD</small></h3>
        <form action="<?php echo base_url();?>index.php/udm/insertarRegistro" method="post">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-control" value="" type="text" name="Nombre"></td>
                        <td>
                            <select class="form-control" name ="Tipo">
                                <option>Seleccione una opción</option>
                                <option>Longitud</option>
                                <option>Área</option>
                                <option>Volúmen</option>
                                <option>Cuantitativo</option>
                                <option>Distancia</option>
                                <option>Fuerza</option>
                                <option>Energía</option>
                                <option>Peso</option>
                                <option>Tiempo</option>
                                <option>Velocidad</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" value="Guardar" class="btn btn-info btn-sm" >
                            <input type="submit" value="Cancelar" class="btn btn-danger btn-sm">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    if(count($registros) > 0 ){
                        foreach ($registros as $registro) {
                            $columnas = $this->db->list_fields('udm');
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
                            
                            echo '  <td>' . $registro->id_udm . '</td>';
                            echo '  <td>' . $registro->nombre . '</td>';
                            echo '  <td>' . $registro->tipo_udm . '</td>';
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