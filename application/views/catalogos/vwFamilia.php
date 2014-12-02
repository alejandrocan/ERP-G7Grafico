
<div class="container">
        <h1>Familia</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar nueva Familia</h3>    
            
        <form action=" <?php echo base_url();?>index.php/catalogos/insertFamilia/<?php echo $catalogo?>" method"post">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>                
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <td><input class="form-control" value="<?php if(@$nombre){echo $nombre;}?>" type="text" name="nombre"></td>
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
    <h3>Familias disponibles</h3>
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

                    <form action="<?php echo base_url();?>index.php/catalogos/duplicar_familia/<?php echo $catalogo?>" method="post">
                        <tr>
                        <?php $columnas = $this->db->list_fields($catalogo);?>
                            <?php if($registro->estado=='1')
                            {
                                echo '<tr>';
                                $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_fam . ' role="button">Deshabilitar</a>';                        
                            }
                            else
                            {
                                echo '<tr class="danger">';
                                $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_fam . ' role="button">Habilitar</a>';
                                //<input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                            }?>
                            <td id="id<?php echo $registro->id_fam;?>"><?php echo $registro->id_fam; ?></td>
                            <td id="nombre<?php echo $registro->id_fam;?>"><?php echo $registro->nombre; ?></td>
                            <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">
                            <td>
                                <?php echo '<a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $registro->id_fam . '" role="button">Editar</a>';?>
                                <!-- <?php // echo '<a class="btn btn-primary btn-xs"  data-target="#'. $registro->id_fam .'" role="button">Duplicar</a>';?> -->
                                <!--<?php //echo '<a class="btn btn-primary btn-xs" href='.base_url().'index.php/catalogos/duplicar/'.$catalogo.'/' .$registro->nombre.' "role="button">Duplicar</a>';?>-->
                                <!--<input type="text" name="prueba">-->
                                <input type="submit" value="Duplicar" class="btn btn-primary btn-xs" method="post" name="enviar"> 
                                <?php echo $estado;?>                                
                            </td>
                        </tr>                                    
                    </form>
                    <?php echo '<div class="modal fade" id="'.$registro->id_fam.'" tabindex="-1" aria-hidden="true">';?>
                    
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_fam;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_fam;?>"action="<?php echo base_url();?>index.php/catalogos/updateFamilia/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">                                
                                        <label>ID <?php echo $registro->id_fam;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_fam;?>" type="text" name="id_fam">
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
