<div class="container">
        <h1>USUARIO</h1>
    </div>
    <div class="container table-responsive" id="formulario_usuario">
        <?=@$error?>
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar registro </h3>
        <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Primer Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Departamento</th>
                        <th>Puesto</th>
                        <th>Imagen de Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php echo form_open_multipart(base_url()."index.php/catalogos/insertUsuario/")?>
                        <td><input class="form-control" value="<?php echo set_value('Nombre',''); ?>" type="text" name="Nombre"></td>
                        <td><input class="form-control" type="password" name="Contrasena" ></td>
                        <td><input class="form-control" value="<?php echo set_value('Nombre1',''); ?>" type="text" name="Nombre1"></td>
                        <td><input class="form-control" value="<?php echo set_value('Nombre2',''); ?>" type="text" name="Nombre2"></td>
                        <td><input class="form-control" value="<?php echo set_value('Apellido1',''); ?>" type="text" name="Apellido1"></td>
                        <td><input class="form-control" value="<?php echo set_value('Apellido2',''); ?>" type="text" name="Apellido2"></td>
                        <td><input class="form-control" value="<?php echo set_value('Correo',''); ?>" type="text" name="Correo"></td>
                        <td>
                            <select class="form-control" name ="Tipo">
                                <?php 
                                    echo '<option value="Administrador" ' . set_select('Tipo','Administrador','TRUE') . '>' . 'Administrador</option>';
                                    echo '<option value="Usuario" ' . set_select('Tipo','Usuario') . '>' . 'Usuario</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name ="Departamento">
                                <?php 
                                    $query = $this->db->get("departamento");
                                    $valores = $query->result(); 
                                    foreach ($valores as $valor)
                                        echo '<option value="' . $valor->id_depto . '" ' . set_select('Departamento',$valor->id_depto,'TRUE') . '>' . $valor->nombre . '</option>';
                                ?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name ="Puesto">
                                <?php 
                                    $query = $this->db->get("puesto");
                                    $valores = $query->result(); 
                                    foreach ($valores as $valor)
                                        echo '<option value="' . $valor->id_puesto . '" ' . set_select('Puesto',$valor->id_puesto,'TRUE') . '>' . $valor->nombre . '</option>';
                                ?>
                            </select>
                        </td>
                        <td><input class="form-control" type="file" name="Imagen"></td>
                        <td>
                            <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                            <a href="<?php echo base_url(). 'index.php/catalogos/index/usuario/registros'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
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
        <h3>Registros</h3>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Tipo</th> 
                    <th>Departamento</th>
                    <th>Puesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($registros) > 0 )
                    {
                        foreach ($registros as $registro) {
                            $columnas = $this->db->list_fields('usuario');
                           if($registro->estado==1)
                        {
                            echo '<tr>';
                            $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_usr . ' role="button">Deshabilitar</a>';                        
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_usr . ' role="button">Habilitar</a>';                            
                        }
                            
                            echo '  <td>' . $registro->id_usr . '</td>';
                            echo '  <td>' . $registro->nombre . '</td>';
                            echo '  <td>' . $registro->contra_usr . '</td>';
                            echo '  <td>' . $registro->nombre_usr . '</td>';
                            echo '  <td>' . $registro->nombre2_usr . '</td>';
                            echo '  <td>' . $registro->apellidop_usr . '</td>';
                            echo '  <td>' . $registro->apellidom_usr . '</td>';
                            echo '  <td>' . $registro->correo_usr . '</td>';
                            echo '  <td>' . $registro->tipo_usr . '</td>';

                            $depto = $this->db->get("departamento");
                            $valor = $depto->result();
                            foreach ($valor as $v) {
                                if($v->id_depto == $registro->depto_usr){
                                    echo '<td>' . $v->nombre . '</td>';
                                    break;
                                }
                            }

                            $puesto = $this->db->get("puesto");
                            $valor = $puesto->result();
                            foreach ($valor as $v) {
                                if($v->id_puesto == $registro->id_puesto){
                                    echo '<td>' . $v->nombre . '</td>';
                                    break;
                                }
                            }
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