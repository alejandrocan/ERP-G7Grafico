<div class="container">
        <h1>Presentación</h1>
</div>
    <div class="container table-responsive">
        <?=@$mensaje?>
        <span><?php echo validation_errors(); ?></span>
        <h3>Agregar nueva presentación</h3>
        
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Unidad_de_medida</th>
                <th>Contenido</th>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <?php echo form_open_multipart(base_url()."index.php/catalogos/insertPresentacion/presentacion")?>
                    <td><input  class="form-control" value="<?php if(@$nombre){echo $nombre;}else{echo set_value('Nombre','');}?>" type="text" name="Nombre"></td> 
                    <td><select class="form-control" name ="UDM">
                        <?php                         
                        $query = $this->db->get("udm");
                        $valores = $query->result(); ?>
                    <?php                     
                    if(@$udm){
                        foreach ($valores as $valor):
                            if($valor->nombre == $udm){
                                echo "<option value=".$udm." selected>".$valor->nombre." </option>"; 
                            }else{
                                echo "<option value=".$valor->nombre.">".$valor->nombre." </option>"; 
                            }
                        endforeach;
                    }
                    else{
                        foreach ($valores as $valor): ?>
                            <option><?php echo $valor->nombre; ?></option>
                        <?php endforeach;                
                        }                    
                                            
                    ?>

                        </select>
                    </td>
                    <td><input class="form-control" value="<?php if(@$contenido){echo $contenido;}else{ echo set_value('Contenido','');} ?>" type="text" name="Contenido"></td>
                    <td>
                        <input type="submit" value="Guardar" class="btn btn-info btn-sm">
                        <a href="<?php echo base_url(). 'index.php/catalogos/index/presentacion/registros'; ?>" class="btn btn-danger btn-sm" >Cancelar</a>
                    </td>
                <?php echo form_close();?>
            </tr>
        </table>
    </form>
    </div>
<?php if(@$error2){?>
        <div class="container alert alert-danger alert-dimissable"><button type="button" class="close" data-dismiss="alert">&times; </button><?php echo @$error2;?></div>
    <?php }?>


<div class="container table-responsive">
    <h3>Material</h3>
    <table class="table table-bordered table-hover table-responsive">
        <thead>
            <tr>
            	<th>ID</th>
	            <th>Nombre</th>
                <th>UDM</th>
                <th>Contenido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($registros) > 0): ?>
                <?php foreach ($registros as $registro): ?>
                <form action="<?php echo base_url();?>index.php/catalogos/duplicar_presentacion/<?php echo $catalogo?>" method="post">
                    <tr>
                    <?php $columnas = $this->db->list_fields($catalogo); ?>
                        <td><?php echo $registro->id_pres; ?></td>

                        <td><?php echo $registro->nombre; ?></td>

                        <?php 
                            $udm = $this->db->get("udm");
                            $valor = $udm->result();
                            foreach ($valor as $v) {
                                if($v->id_udm == $registro->udm_pres){
                                    break;
                                }
                                
                            }
                        ?>

                        <td><?php echo $v->nombre; ?></td>
                        <td><?php echo $registro->contenido_pres; ?></td>                        
                        <input  class="hidden" name="nombre" value="<?php echo $registro->nombre;?>">  
                        <input  class="hidden" name="udm" value="<?php echo $v->nombre;?>">                     
                        <input  class="hidden" name="contenido" value="<?php echo $registro->contenido_pres;?>">
                        <td>
                            <?php echo '<a class="btn btn-info btn-sm" data-toggle= "modal" data-target="#' . $registro->id_pres . '" role="button">Editar</a>';?>
                            <input type="submit" value="Duplicar" class="btn btn-primary btn-sm" method="post" name="enviar"> 
                            <a class="btn btn-danger btn-sm" href="'. base_url(). 'index.php/catalogos/index/'. $catalogo .'/' . $registro->$id .'" role="button">DesHabilitar</a>
                        </td>
                    </tr>
                    </form>
                        <?php echo '<div class="modal fade" id="'.$registro->id_pres.'" tabindex="-1" aria-hidden="true">';?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_pres;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_pres;?>"action="<?php echo base_url();?>index.php/catalogos/updatePresentacion/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">
                                        <label>ID <?php echo $registro->id_pres;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_pres;?>" type="text" name="id_pres">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>                                        
                                        <label>Unidad de medida<select class="form-control" name ="udm_pres">
                                        <?php                         
                                            $this->db->where('estado','1');
                                            $query = $this->db->get("udm");
                                            $valores = $query->result();                                                                                                     
                                                foreach ($valores as $valor):
                                                    if($valor->nombre == $v->nombre){
                                                        echo "<option value=".$v->nombre." selected>".$valor->nombre." </option>"; 
                                                    }else{
                                                        echo "<option value=".$valor->nombre.">".$valor->nombre." </option>"; 
                                                    }
                                                endforeach;                                                                                                                                            
                                            ?>
                                            </select></label></br>
                                        <label>Contenido<input class="form-control" value="<?php echo $registro->contenido_pres;?>" type="text" name="contenido"></label></br>                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >Actualizar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <tr>
            	
                            </tr>
                            <div class="modal fade" id="'.$valor_id.'" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h2>Editar</h2>
                            </div>
                            <div class="modal-body"> 
                            <label></label>
                                    <p></p></br>
           					<label>'.$columna;
                            <OPTION VALUE="link pagina 4">'.$options->$columna_referencial.'</OPTION>
							</SELECT>
                            <input type="text" value="'.$registro->$columna.'"></input></label></br>
                            </div>
                            <div class="modal-footer">
                            <a class="btn btn-primary" data-dismiss="modal">Guardar</a>
                            </div>
                            </div>
                            </div>
                            </div>         
        </tbody>
    </table>
</div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

</body>
</html>