<div class="container table-responsive">
        <h1>Material</h1>
</div>
    <div class="container table-responsive">
        <h3>Agregar nuevo Material</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertMaterial/<?php echo $catalogo?>" method="post">
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
                <td><input class="form-control" value="" type="text" name="nombre"></td>    
                <td><select class="form-control" name ="udm_material">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("udm");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                        <option><?php echo $valor->nombre; ?></option>
                    <?php endforeach; ?>
                </select></td>
                <td><select class="form-control" name ="proveedor_material">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("proveedor");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                        <option><?php echo $valor->nombre; ?></option>
                    <?php endforeach; ?>
                </select></td>
                <td><select class="form-control" name ="presentacion">
                    <?php 
                        $this->db->where('estado','1');
                        $query = $this->db->get("presentacion");
                        $valores = $query->result(); ?>
                    <?php foreach ($valores as $valor): ?>
                        <option><?php echo $valor->nombre; ?></option>
                    <?php endforeach; ?>
                </select></td>
                <td><input class="form-control" value="" type="text" name="clave"></td>
                <td><input class="form-control" value="" type="text" name="smax"></td>
                <td><input class="form-control" value="" type="text" name="smin"></td>
                <td><input class="form-control" value="" type="text" name="factor_redimiento"></td>
                <td><input class="form-control" value="" type="text" name="cantidad"></td>
                <td><input class="form-control" value="" type="text" name="ultimo_costo"></td>
                <td><input class="form-control" value="" type="text" name="tiempo_elaboracion"></td>
                <td><input class="form-control" value="" type="text" name="orden_cronologico"></td>
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-xs">
                    <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
    </div>

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
                        <td>
                            <?php echo '<a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $registro->id_material . '" role="button">Editar</a>';?>
                            <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>
                            <?php echo $estado;?>
                        </td>
                    </tr>
                    <?php echo '<div class="modal fade" id="'.$registro->id_material.'" tabindex="-1" aria-hidden="true">';?>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Editar <?php echo $registro->id_material;?></h2>
                                </div>
                                <form id="form<?php echo $registro->id_material;?>"action="<?php echo base_url();?>index.php/catalogos/updateMaterial/<?php echo $catalogo?>" method="post">
                                <div class="modal-body">
                                        <label>ID <?php echo $registro->id_material;?></label></br>
                                        <input class="form-control hidden" value="<?php echo $registro->id_material;?>" type="text" name="id_material">
                                        <label>Nombre<input class="form-control" value="<?php echo $registro->nombre;?>" type="text" name="nombre"></label></br>
                                        <label>Unidad de medida<select class="form-control" name ="udm_material">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("udm");
                                                $valores = $query->result(); ?>
                                            <?php foreach ($valores as $valor): ?>
                                                <option><?php echo $valor->nombre; ?></option>
                                            <?php endforeach; ?>
                                        </select></label></br>
                                        <label>Proveedor<select class="form-control" name ="proveedor_material">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("proveedor");
                                                $valores = $query->result(); ?>
                                            <?php foreach ($valores as $valor): ?>
                                                <option><?php echo $valor->nombre; ?></option>
                                            <?php endforeach; ?>
                                        </select></label></br>
                                        <label>Presentación<select class="form-control" name ="presentacion">
                                            <?php 
                                                $this->db->where('estado','1');
                                                $query = $this->db->get("presentacion");
                                                $valores = $query->result(); ?>
                                            <?php foreach ($valores as $valor): ?>
                                                <option><?php echo $valor->nombre; ?></option>
                                            <?php endforeach; ?>
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