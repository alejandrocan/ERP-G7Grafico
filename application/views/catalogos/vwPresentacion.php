
<div class="container">
        <h1>Presentación</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar nueva presentación</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertPresentacion/<?php echo $catalogo?>" method="post">
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
                <td><input class="form-control" value="" type="text" name="nombre"></td>    
                <td><select class="form-control" name ="udm_pres">
                    <?php 
                        $query = $this->db->get("udm");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                        <option><?php echo $valor->nombre; ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                <td><input class="form-control" value="" type="text" name="contenido_pres"></td>
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-xs">
                    <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
    </div>

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
                        <td>
                            <a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $valor_id . '" role="button">Editar</a>
                            <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>
                            <a class="btn btn-danger btn-xs" href="'. base_url(). 'index.php/catalogos/index/'. $catalogo .'/' . $registro->$id .'" role="button">DesHabilitar</a>
                        </td>
                    </tr>
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