
<div class="container">
        <h1>Departamento</h1>
</div>
    <div class="container table-responsive">
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar nuevo Departamento</h3>    
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <?php echo form_open_multipart(base_url()."index.php/catalogos/insertDepartamento/departamento")?>
                <td><input class="form-control" value="<?php if(@$nombre){echo $nombre;}else {echo set_value('Nombre','');}?>" type="text" name="Nombre"></td>
                <!-- <input class="form-control" value="<?php //echo $registro->nombre;?>" type="text" name="nombre"> -->
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                    <a href="<?php echo base_url(). 'index.php/catalogos/index/departamento/registros'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                </td>
                <?php echo form_close();?>
            </tr>
        </table>
    </div>

<?php if(@$error2){?>
        <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
    <?php }?>



<div class="container table-responsive">
    <h3>Departamentos disponibles</h3>
    <table class="table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($registros) > 0): ?>
                <?php foreach ($registros as $registro): ?>
                    <form action="<?php echo base_url();?>index.php/catalogos/duplicar_departamento/<?php echo $catalogo?>" method="post">
                        <tr>
                        <?php $columnas = $this->db->list_fields($catalogo);?>

                        <?php if($registro->estado=='1')
                            {
                                echo '<tr>';
                                $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_depto . ' role="button">Deshabilitar</a>';                        
                            }
                            else
                            {
                                echo '<tr class="danger">';
                                $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_depto. ' role="button">Habilitar</a>';                            
                            }?>
                            <td id="id_depto<?php echo $registro->id_depto?>"><?php echo $registro->id_depto; ?></td>
                            <td id="nombre<?php echo $registro->id_depto;?>"><?php echo $registro->nombre; ?></td>
                            <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">
                            <td>
                                <?php echo '<a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $registro->id_depto . '" role="button">Editar</a>';?>
                                <!-- <?php // echo '<a class="btn btn-primary btn-xs"  data-target="#'. $registro->id_fam .'" role="button">Duplicar</a>';?> -->
                                <!--<?php //echo '<a class="btn btn-primary btn-xs" href='.base_url().'index.php/catalogos/duplicar/'.$catalogo.'/' .$registro->nombre.' "role="button">Duplicar</a>';?>-->
                                <!--<input type="text" name="prueba">-->
                                <input type="submit" value="Duplicar" class="btn btn-primary btn-xs" method="post" name="enviar"> 
                                <!--<a class="btn btn-danger btn-xs" href="'. base_url(). 'index.php/catalogos/index/'. $catalogo .'/   ' . $registro->$id .'" role="button">DesHabilitar</a>-->                                                             
                                <?php echo $estado;?>
                            </td>
                        </tr>                                    
                    </form>
                    <?php echo '<div class="modal fade" id="'.$registro->id_depto.'" tabindex="-1" aria-hidden="true">';?>
                    
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_depto;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_depto;?>"action="<?php echo base_url();?>index.php/catalogos/updateDepartamento/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">                                
                                        <label>ID <?php echo $registro->id_depto;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_depto;?>" type="text" name="id_depto">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>
                                        <!--<input class="form-control hidden" value="<?php // echo $registro->nombre;?>" type="text" name="nombre"></br>-->
                                        <!-- <input class="form-control" value="<?php //echo $registro->nombre;?>" type="text" name="nombre"> -->
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
