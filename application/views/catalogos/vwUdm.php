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
                            <td><input  class="form-control" value="<?php if(@$nombre){echo $nombre;}else{echo set_value('Nombre','');}?>" type="text" name="Nombre"></td> 
                            <td>
                                <select class="form-control" name ="Tipo">
                                    <?php 
                                    $tipo_unidad = array('Longitud','Área','Volúmen','Cuantitativo','Distancia','Fuerza','Energia','Peso','Tiempo','Velocidad');
                                    //$tipo_unidad = array('');
                                    if(@$tipo_udm){
                                        foreach ($tipo_unidad as $tipo):
                                            if($tipo == $tipo_udm){
                                                echo "<option value=".$tipo_udm." selected>".$tipo." </option>"; 
                                            }else{
                                                echo "<option value=".$tipo.">".$tipo." </option>"; 
                                            }
                                        endforeach;
                                    }else{
                                        foreach ($tipo_unidad as $tipo): ?>
                                            <option><?php echo $tipo; ?></option>
                                        <?php endforeach;                
                                    }                                
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
                        foreach ($registros as $registro) {?>
                            <form action="<?php echo base_url();?>index.php/catalogos/duplicar_UDM/<?php echo $catalogo?>" method="post">
                                <tr>
                                <?php
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
                                echo    $estado;
                                ?>                                
                                <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">
                                <input  class="hidden" name="tipo_udm" value="<?php echo $registro->tipo_udm;?>">
                                <?php                            
                                echo '      <a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#'.$registro->id_udm.'"role="button">Editar</a>';
                                echo '      <input type="submit" value="Duplicar" class="btn btn-primary btn-sm" method="post" name="enviar"> ';

                                echo '  </td>';
                                echo '</tr>';
                     //   }
                    //}
                ?>
                </tr>
                </form>                    
                    <?php echo '<div class="modal fade" id="'.$registro->id_udm.'" tabindex="-1" aria-hidden="true">';?>                    
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_udm;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_udm;?>"action="<?php echo base_url();?>index.php/catalogos/updateUdm/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">                                
                                        <label>ID <?php echo $registro->id_udm;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_udm;?>" type="text" name="id_udm">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>                                        
                                        <label>Tipo<select class="form-control" name ="tipo_udm">
                                            <?php 
                                                foreach ($tipo_unidad as $tipo2):
                                                    if($tipo2 == $registro->tipo_udm){
                                                        echo "<option value=".$registro->tipo_udm." selected>".$tipo2." </option>"; 
                                                    }else{
                                                        echo "<option value=".$tipo2.">".$tipo2." </option>"; 
                                                    }
                                                endforeach;                                                
                                            ?>
                                        </select></label></br>                                    
                                        <!--<input class="form-control hidden" value="<?php // echo $registro->nombre;?>" type="text" name="nombre"></br>-->
                                        <!-- <input class="form-control" value="<?php //echo $registro->nombre;?>" type="text" name="nombre"> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Actualizar</button>
                                </div>
                                </form>
                        </div>
                    </div>
            <?php 
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