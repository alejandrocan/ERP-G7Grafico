    <div class="container">
        <h1>UDM</h1>
    </div>
    <div class="container">
        <?=@$mensaje?>
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
                            <td><input class="form-control" value="<?php echo set_value('Nombre',''); ?>" type="text" name="Nombre"></td>
                            <td>
                                <select class="form-control" name ="Tipo">
                                    <?php 
                                    echo '<option value="Longitud" ' . set_select('Tipo','Longitud','TRUE') . '>' . 'Longitud</option>';
                                    echo '<option value="Área" ' . set_select('Tipo','Área') . '>' . 'Área</option>';
                                    echo '<option value="Volúmen" ' . set_select('Tipo','Volúmen') . '>' . 'Volúmen</option>';
                                    echo '<option value="Cuantitativo" ' . set_select('Tipo','Cuantitativo') . '>' . 'Cuantitativo</option>';
                                    echo '<option value="Distancia" ' . set_select('Tipo','Distancia') . '>' . 'Distancia</option>';
                                    echo '<option value="Fuerza" ' . set_select('Tipo','Fuerza') . '>' . 'Fuerza</option>';
                                    echo '<option value="Energía" ' . set_select('Tipo','Energía') . '>' . 'Energía</option>';
                                    echo '<option value="Peso" ' . set_select('Tipo','Peso') . '>' . 'Peso</option>';
                                    echo '<option value="Tiempo" ' . set_select('Tipo','Tiempo') . '>' . 'Tiempo</option>';
                                    echo '<option value="Velocidad" ' . set_select('Tipo','Velocidad') . '>' . 'Velocidad</option>';
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                                <a href="<?php echo base_url(). 'index.php/catalogos/index/udm/registros'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                            </td>
                        <?php echo form_close();?>
                    </tr>
                </tbody>
            </table>
    </div>
    <?php if(@$error2){?>
        <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
    <?php }?>


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