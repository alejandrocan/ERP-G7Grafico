<div class="container">
        <h1>Proveedor</h1>
</div>
    <div class="container table-responsive">
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar Proveedor</h3>
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
                 <?php echo form_open_multipart(base_url()."index.php/catalogos/insertProveedor/proveedor")?>
                <td><input class="form-control" value="<?php if(@$nombre){echo $nombre;}else {echo set_value('Nombre','');}?>" type="text" name="Nombre"></td>
                <td><input class="form-control" value="<?php if(@$direccion){echo $direccion;}else {echo set_value('Direccion','');}?>" type="text" name="Direccion"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $telefono;}else {echo set_value('Telefono','');}?>" type="text" name="Telefono"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $correo;}else {echo set_value('Correo','');}?>" type="text" name="Correo"></td>
                <td><input class="form-control" value="<?php if(@$nombre){echo $contacto;}else {echo set_value('Contacto','');}?>" type="text" name="Contacto"></td>
                <!-- <input class="form-control" value="<?php //echo $registro->nombre;?>" type="text" name="nombre"> -->
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                    <a href="<?php echo base_url(). 'index.php/catalogos/index/proveedor/registros'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                </td>
                 <?php echo form_close();?>
            </tr>
        </table>
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
                                <?php echo '<a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#' . $registro->id_proveedor . '" role="button">Editar</a>';?>
                                <!-- <?php // echo '<a class="btn btn-primary btn-xs"  data-target="#'. $registro->id_fam .'" role="button">Duplicar</a>';?> -->
                                <!--<?php //echo '<a class="btn btn-primary btn-xs" href='.base_url().'index.php/catalogos/duplicar/'.$catalogo.'/' .$registro->nombre.' "role="button">Duplicar</a>';?>-->
                                <!--<input type="text" name="prueba">-->
                                <input type="submit" value="Duplicar" class="btn btn-primary btn-sm" method="post" name="enviar"> 
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
                                        <label>Direccion<input class="form-control" value="<?php echo $registro->dir_prove;?>" type="text" name="dir_prove"></label></br>
                                        <label>Telefono<input class="form-control" value="<?php echo $registro->tel_prove;?>" type="text" name="tel_prove"></label></br>
                                        <label>Correo<input class="form-control" value="<?php echo $registro->correo_prove;?>" type="text" name="correo_prove"></label></br>
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
