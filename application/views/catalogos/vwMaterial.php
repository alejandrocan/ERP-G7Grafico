<div class="container table-responsive">
        <h1>Material</h1>
</div>
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
    <div class="container table-responsive">
        <h3>Agregar nuevo Material</h3>
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Unidad_de_medida</th>
                <th>Proveedor</th>
                <th>Presentación</th>
                <th>Clave</th>
                <th>Stock_Maxima</th>
                <th>Stock_Minima</th>
                <th>Factor_de_rendimiento</th>
                <th>Cantidad</th>
                <th>Ultimo_costo</th>
                <th>Tiempo_de_elaboracion</th>
                <th>Orden_de_elaboracion</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <?php echo form_open_multipart(base_url()."index.php/catalogos/insertMaterial/material")?>
                <td><input class="form-control" value="<?php if(@$nombre){echo $nombre;}else{echo set_value('Nombre','');}?>" type="text" name="Nombre"></td>    
                <td><select class="form-control" name ="UDM">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("udm");
                        $valores = $query->result();            
                        if(@$udm_material){
                            foreach ($valores as $valor):
                                if($valor->id_udm == $udm_material){
                                    echo "<option value=".$valor->id_udm." selected>".$valor->nombre." </option>"; 
                                }else{
                                    echo "<option value=".$valor->id_udm.">".$valor->nombre." </option>"; 
                                }
                            endforeach;
                        }
                        else{
                                foreach ($valores as $valor)
                                echo '<option value="' . $valor->id_udm . '" ' . set_select('UDM',$valor->id_udm,'TRUE') . '>' . $valor->nombre . '</option>';               
                        }                                        
                    ?>
                </select></td>
                <td><select class="form-control" name ="Proveedor">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("proveedor");
                        $valores = $query->result(); ?>
                        <?php                     
                    if(@$proveedor_material){
                        foreach ($valores as $valor):
                            if($valor->id_proveedor == $proveedor_material){
                                echo "<option value=".$valor->id_proveedor." selected>".$valor->nombre." </option>"; 
                            }else{
                                echo "<option value=".$valor->id_proveedor.">".$valor->nombre." </option>"; 
                            }
                        endforeach;
                    }
                    else{
                        foreach ($valores as $valor)
                            echo '<option value="' . $valor->id_proveedor . '" ' . set_select('Proveedor',$valor->id_proveedor,'TRUE') . '>' . $valor->nombre . '</option>';                             
                    }                    
                                            
                    ?>                    
                </select></td>
                <td><select class="form-control" name ="Presentacion">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("presentacion");
                        $valores = $query->result();
                        if(@$presentacion_m){
                            foreach ($valores as $valor):
                                if($valor->id_pres == $presentacion_m){
                                    echo "<option value=".$valor->id_pres." selected>".$valor->nombre." </option>"; 
                                }else{
                                    echo "<option value=".$valor->id_pres.">".$valor->nombre." </option>"; 
                                }                            
                            endforeach;

                        }
                        else{
                            foreach ($valores as $valor)
                                echo '<option value="' . $valor->id_pres . '" ' . set_select('Presentacion',$valor->id_pres,'TRUE') . '>' . $valor->nombre . '</option>';                                          
                        }                    
                                            
                    ?>                 
                </select></td>
                <td><input class="form-control" value="<?php if(@$clave){echo $clave;}else{echo set_value('Clave','');}?>" type="text" name="clave"></td>
                <td><input class="form-control" value="<?php if(@$smax){echo $smax;}else{echo set_value('Stock_Maxima','');}?>" type="text" name="smax"></td>
                <td><input class="form-control" value="<?php if(@$smin){echo $smin;}else{echo set_value('Stock_Minima','');}?>" type="text" name="smin"></td>
                <td><input class="form-control" value="<?php if(@$factor){echo $factor;}else{echo set_value('Factor_Rendimiento','');}?>" type="text" name="factor_redimiento"></td>
                <td><input class="form-control" value="<?php if(@$cantidad){echo $cantidad;}else{echo set_value('Cantidad','');}?>" type="text" name="cantidad"></td>
                <td><input class="form-control" value="<?php if(@$costo){echo $costo;}else{echo set_value('Ultimo_Costo','');}?>" type="text" name="ultimo_costo"></td>
                <td><input class="form-control" value="<?php if(@$tiempo){echo $tiempo;}else{echo set_value('Tiempo_Elaboracion','');}?>" type="text" name="tiempo_elaboracion"></td>
                <td><input class="form-control" value="<?php if(@$orden_cronologico){echo $orden_cronologico;}else{echo set_value('Orden_Elaboracion','');}?>" type="text" name="orden_cronologico"></td>
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-xs">
                    <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                </td>
                <?php echo form_close();?>
            </tr>
        </table>
    </div>
<?php if(@$error2){?>
    <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
<?php }?>

<div class="container table-responsive">
    <h3>Materiales disponibles</h3>
    <table class="table table-bordered table-hover table-responsive">
        <thead>
            <tr>
            	<th>ID</th>
	            <th>Nombre</th>
                <th>Unidad_de_medida</th>
                <th>Proveedor</th>
                <th>Presentación</th>
                <th>Clave</th>
                <th>Stock_Maxima</th>
                <th>Stock_Minima</th>
                <th>Factor_de_rendimiento</th>
                <th>Cantidad</th>
                <th>Ultimo_costo</th>
                <th>Fecha_cotizacion</th>
                <th>Fecha_ultima_edicion</th>
                <th>Usuario_que_editó</th>
                <th>Tiempo_de_elaboracion</th>
                <th>Orden_de_elaboracion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($registros) > 0): ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                    <?php $columnas = $this->db->list_fields($catalogo); ?>
                    <form action="<?php echo base_url();?>index.php/catalogos/duplicar_material/<?php echo $catalogo?>" method="post">
                        <?php if($registro->estado=='1')
                        {
                            echo '<tr>';
                            $estado = '<a class="btn btn-danger btn-sm" href='. base_url() . 'index.php/catalogos/disabled/' . $catalogo . '/' . $registro->id_material . ' role="button">Deshabilitar</a>';                        
                        }
                        else
                        {
                            echo '<tr class="danger">';
                            $estado = '<a class="btn btn-success btn-sm" href='. base_url() . 'index.php/catalogos/enabled/' . $catalogo . '/' . $registro->id_material . ' role="button">Habilitar</a>';                            
                        }?>
                        <td id="id<?php echo $registro->id_material;?>"><?php echo $registro->id_material; ?></td>
                        <td id="nombre<?php echo $registro->id_material;?>"><?php echo $registro->nombre; ?></td>
                        <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">                                            
                        <?php 
                            $udm = $this->db->get("udm");
                            $valor = $udm->result();
                            foreach ($valor as $v) {
                                if($v->id_udm == $registro->udm_material){
                                    break;
                                }
                            }
                        ?>
                        <td id="udm<?php echo $registro->id_material;?>"><?php echo $v->nombre; ?></td>
                        <input  class="hidden" name="udm" value="<?php echo $v->nombre;?>">
                         <?php 
                            $proveedor = $this->db->get("proveedor");
                            $valor = $proveedor->result();
                            foreach ($valor as $v) {
                                if($v->id_proveedor == $registro->proveedor_material){
                                    break;
                                }
                            }
                        ?>
                        <td id="proveedor<?php echo $registro->id_material;?>"><?php echo $v->nombre; ?></td>
                        <input  class="hidden" name="proveedor" value="<?php echo $v->nombre;?>">
                         <?php 
                            $presentacion = $this->db->get("presentacion");
                            $valor = $presentacion->result();
                            foreach ($valor as $v) {
                                if($v->id_pres == $registro->presentacion){
                                    break;
                                }
                            }
                        ?>
                        <td id="pres<?php echo $registro->id_material;?>"><?php echo $v->nombre; ?></td>
                        <input  class="hidden" name="presentacion" value="<?php echo $v->nombre;?>">

                        <td id="clave<?php echo $registro->id_material;?>"><?php echo $registro->clave; ?></td>
                        <td id="smax<?php echo $registro->id_material;?>"><?php echo $registro->smax; ?></td>
                        <td id="smin<?php echo $registro->id_material;?>"><?php echo $registro->smin; ?></td>
                        <td id="fdr<?php echo $registro->id_material;?>"><?php echo $registro->factor_redimiento; ?></td>
                        <td id="cant<?php echo $registro->id_material;?>"><?php echo $registro->cantidad; ?></td>
                        <td id="costo<?php echo $registro->id_material;?>"><?php echo $registro->ultimo_costo; ?></td>
                        <td id="fcotiza<?php echo $registro->id_material;?>"><?php echo $registro->fecha_cotiza; ?></td>
                        <td id="edicion<?php echo $registro->id_material;?>"><?php echo $registro->ultima_edicion; ?></td>
                         <?php 
                            $presentacion = $this->db->get("usuario");
                            $valor = $presentacion->result();
                            foreach ($valor as $v) {
                                if($v->id_usr == $registro->usr_edicion){
                                    break;
                                }
                            }
                        ?>
                        <td id="user_edit<?php echo $registro->id_material;?>"><?php echo $v->nombre; ?></td>
                        <td id="tiempo<?php echo $registro->id_material;?>"><?php echo $registro->tiempo_elaboracion; ?></td>
                        <td id="<?php echo $registro->id_material;?>"><?php echo $registro->orden_cronologico; ?></td>                           
                        <input  class="hidden" name="orden" value="<?php echo $registro->orden_cronologico;?>">
                        
                        <input  class="hidden" name="clave" value="<?php echo $registro->clave;?>">                            
                        <input  class="hidden" name="smax" value="<?php echo $registro->smax;?>">
                        <input  class="hidden" name="smin" value="<?php echo $registro->smin;?>">
                        <input  class="hidden" name="factor" value="<?php echo $registro->factor_redimiento;?>">
                        <input  class="hidden" name="cantidad" value="<?php echo $registro->cantidad;?>">
                        <input  class="hidden" name="costo" value="<?php echo $registro->ultimo_costo;?>">                                                                    
                        <input  class="hidden" name="tiempo" value="<?php echo $registro->tiempo_elaboracion;?>">                        

                        <td>
                            <?php echo '<a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#' . $registro->id_material . '" role="button">Editar</a>';?>
                            <input type="submit" value="Duplicar" class="btn btn-primary btn-sm" method="post" name="enviar"> 
                            <?php echo $estado;?>
                        </td>
                    </tr>
                </form>
                    <?php echo '<div class="modal fade" id="'.$registro->id_material.'" tabindex="-1" aria-hidden="true">';?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_material;?></h2>
                                </div>
                                
                                <?php echo form_open_multipart(base_url()."index.php/catalogos/updateMaterial/material")?>
                                <div class="modal-body">
                                        <label>ID <?php echo $registro->id_material;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_material;?>" type="text" name="id_material">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>
                                        <label>Unidad de medida<select class="form-control" name ="udm_material">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("udm");
                                                $valores = $query->result(); 
                                                foreach ($valores as $valor){
                                                    if($valor->id_udm == $registro->udm_material){
                                                        echo "<option value=".$valor->id_udm." selected='selected'>".$valor->nombre." </option>"; 
                                                    }else{
                                                        echo "<option value=".$valor->id_udm.">".$valor->nombre." </option>"; 
                                                    }
                                                }
                                            ?>
                                        </select></label></br>
                                        <label>Proveedor<select class="form-control" name ="proveedor_material">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("proveedor");
                                                $valores = $query->result();
                                                 foreach ($valores as $valor){
                                                    if($valor->id_proveedor == $registro->proveedor_material){
                                                        echo "<option value=".$valor->id_proveedor." selected='selected'>".$valor->nombre." </option>"; 
                                                    }else{
                                                        echo "<option value=".$valor->id_proveedor.">".$valor->nombre." </option>"; 
                                                    }
                                                }
                                            ?>
                                        </select></label></br>
                                        <label>Presentación<select class="form-control" name ="presentacion">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("presentacion");
                                                $valores = $query->result();
                                                foreach ($valores as $valor){
                                                    if($valor->id_pres == $registro->presentacion){
                                                        echo "<option value=".$valor->id_pres." selected='selected'>".$valor->nombre." </option>"; 
                                                    }else{
                                                        echo "<option value=".$valor->id_pres.">".$valor->nombre." </option>"; 
                                                    }
                                                }
                                            ?>
                                        </select></label></br>
                                        <label>Clave<input class="form-control" value="<?php echo $registro->clave;?>" type="text" name="clave"></label></br>
                                        <label>Stock maximo<input class="form-control" value="<?php echo $registro->smax;?>" type="text" name="smax"></label></br>
                                        <label>Stock minimo<input class="form-control" value="<?php echo $registro->smin;?>" type="text" name="smin"></label></br>
                                        <label>Factor de rendimiento<input class="form-control" value="<?php echo $registro->factor_redimiento;?>" type="text" name="factor_redimiento"></label></br>
                                        <label>Cantidad<input class="form-control" value="<?php echo $registro->cantidad;?>" type="text" name="cantidad"></label></br>
                                        <label>Ultimo costo<input class="form-control" value="<?php echo $registro->ultimo_costo;?>" type="text" name="ultimo_costo"></label></br>
                                        <label>Tiempo de elaboracion<input class="form-control" value="<?php echo $registro->tiempo_elaboracion;?>" type="text" name="tiempo_elaboracion"></label></br>
                                        <label>Orden cronologico<input class="form-control" value="<?php echo $registro->orden_cronologico;?>" type="text" name="orden_cronologico"></label></br>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Actualizar</button>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>