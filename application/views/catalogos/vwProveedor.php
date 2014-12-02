<div class="container">
        <h1>Proveedor</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar Proveedor</h3>    
            
        <form action=" <?php echo base_url();?>index.php/catalogos/insertProveedor/<?php echo $catalogo?>" method"post">
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
            <tr>
                <td><input class="form-control" value="<?php if(@$nombre){echo $nombre;}?>" type="text" name="nombre"></td>
                <td><input class="form-control" value="<?php if(@$direccion){echo $direccion;}?>" type="text" name="direccion"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $telefono;}?>" type="text" name="telefono"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $correo;}?>" type="text" name="correo"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $contacto;}?>" type="text" name="contacto"></td>

                <!-- <input class="form-control" value="<?php //echo $registro->nombre;?>" type="text" name="nombre"> -->
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-xs">                    
                    <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
    </div>

<?php if(@$error2){?>
    <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
<?php }?>

<div class="container table-responsive">
    <h3>Proveedores disponibles</h3>
    <table class="table table-bordered table-hover table-responsive">
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
            <?php if(count($registros) > 0): ?>
                <?php foreach ($registros as $registro): ?>

                    <form action="<?php echo base_url();?>index.php/catalogos/duplicar_proveedor/<?php echo $catalogo?>" method="post">
                        <tr>
                        <?php $columnas = $this->db->list_fields($catalogo);?>
                            <?php if($registro->estado=='1')
                            {
                                echo '<tr>';
                                $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_proveedor . ' role="button">Deshabilitar</a>';                        
                            }
                            else
                            {
                                echo '<tr class="danger">';
                                $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_proveedor . ' role="button">Habilitar</a>';                            
                            }?>
                            <td id="id<?php echo $registro->id_proveedor;?>"><?php echo $registro->id_proveedor; ?></td>
                            <td id="nombre<?php echo $registro->id_proveedor;?>"><?php echo $registro->nombre; ?></td>
                            <td id="direccion<?php echo $registro->id_proveedor;?>"><?php echo $registro->dir_prove; ?></td>
                            <td id="telefono<?php echo $registro->id_proveedor;?>"><?php echo $registro->tel_prove; ?></td>
                            <td id="correo<?php echo $registro->id_proveedor;?>"><?php echo $registro->correo_prove; ?></td>
                            <td id="contacto<?php echo $registro->id_proveedor;?>"><?php echo $registro->contacto; ?></td>

                            <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">
                            <input  class="hidden" name="direccion" value="<?php echo $registro->dir_prove;?>">
                            <input  class="hidden" name="telefono" value="<?php echo $registro->tel_prove;?>">
                            <input  class="hidden" name="correo" value="<?php echo $registro->correo_prove;?>">
                            <input  class="hidden" name="contacto" value="<?php echo $registro->contacto;?>">                            
                            <td>
                                <?php echo '<a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $registro->id_proveedor . '" role="button">Editar</a>';?>
                                <!-- <?php // echo '<a class="btn btn-primary btn-xs"  data-target="#'. $registro->id_fam .'" role="button">Duplicar</a>';?> -->
                                <!--<?php //echo '<a class="btn btn-primary btn-xs" href='.base_url().'index.php/catalogos/duplicar/'.$catalogo.'/' .$registro->nombre.' "role="button">Duplicar</a>';?>-->
                                <!--<input type="text" name="prueba">-->
                                <input type="submit" value="Duplicar" class="btn btn-primary btn-xs" method="post" name="enviar"> 
                                <?php echo $estado;?>                                
                            </td>
                        </tr>                                    
                    </form>
                    <?php echo '<div class="modal fade" id="'.$registro->id_proveedor.'" tabindex="-1" aria-hidden="true">';?>                
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_proveedor;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_proveedor;?>"action="<?php echo base_url();?>index.php/catalogos/updateProveedor/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">                                
                                        <label>ID <?php echo $registro->id_proveedor;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_proveedor;?>" type="text" name="id_proveedor">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>
                                        <label>Direccion<input class="form-control" value="<?php echo $registro->dir_prove;?>" type="text" name="direccion"></label></br>
                                        <label>Telefono<input class="form-control" value="<?php echo $registro->tel_prove;?>" type="text" name="telefono"></label></br>
                                        <label>Correo<input class="form-control" value="<?php echo $registro->correo_prove;?>" type="text" name="correo"></label></br>
                                        <label>Contacto<input class="form-control" value="<?php echo $registro->contacto;?>" type="text" name="contacto"></label></br>                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Actualizar</button>
                                </div>
                                </form>
                            </div>
                        </div>    
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
