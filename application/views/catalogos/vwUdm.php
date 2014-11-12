    <div class="container">
        <h1>UDM</h1>
    </div>
    <div class="container">
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar registro</h3>
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
                        <?php echo form_open_multipart(base_url()."index.php/catalogos/insertUdm/udm")?>
                            <td><input class="form-control" value="" type="text" name="Nombre"></td>
                            <td>
                                <select class="form-control" name ="Tipo">
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
                                <a href="<?php echo base_url(). 'index.php/catalogos/index/udm'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                            </td>
                        <?php echo form_close();?>
                    </tr>
                </tbody>
            </table>
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
                            $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_udm . ' role="button">Deshabilitar</a>';                        
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_udm . ' role="button">Habilitar</a>';                            
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
        <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</body>
</html>