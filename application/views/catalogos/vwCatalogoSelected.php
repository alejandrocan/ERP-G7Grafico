    <div class="container">
        <h1>Catalogo <?php echo $catalogo; ?></h1>
    </div>
    <div class="container">
        <h3>Editar/Agregar registro</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Asunto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tr>
                <td><input class="form-control" value="X" type="text"></td>
                <td><input class="form-control" value="Marco Antonio" type="text"></td>
                <td><input class="form-control" value="Maciel Tuz" type="text"></td>
                <td><input class="form-control" value="Nada que comentar." type="text"></td>
                <td>
                    <a class="btn btn-info btn-xs" href="#" role="button">Guardar</a>
                    <a class="btn btn-danger btn-xs" href="#" role="button">Cancelar</a>
                </td>
            </tr>
        </table>
    </div>
<div class="container">
    <h3><?php echo $catalogo; ?></h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                
                <?php
                    $cont = 0;
                    $columnas = $this->db->list_fields($catalogo);
                    foreach ($columnas as $columna ) {
                        if($columna != 'estado'){
                            echo "<th>" . $columna . "</th>";    
                        }
                        
                        if($cont == 0){
                            $cont = $cont + 1;
                            $id = $columna;
                        }
                    }
                ?>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
                <?php
                
                
                    if(count($registros) > 0 ){
                        foreach ($registros as $registro) {
                            echo "<tr>";

                            $columnas = $this->db->list_fields($catalogo);
                            foreach ($columnas as $columna ) {

                                if($columna == 'estado'){

                                }
                                else{
                                    echo "<td>" . $registro->$columna . "</td>";
                                }
                               
                            }
                            if($registro->estado != 0){
                                echo "<td>";
                                echo '<a class="btn btn-info btn-xs" href="" role="button">Editar</a>';
                                echo '<a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>';
                                echo '<a class="btn btn-danger btn-xs" href="'. base_url(). 'index.php/catalogos/index/'. $catalogo .'/' . $registro->$id .'" role="button">DesHabilitar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }else{
                                echo "<td>";
                                echo '<a class="btn btn-info btn-xs" href="" role="button">Editar</a>';
                                echo '<a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>';
                                echo '<a class="btn btn-success btn-xs" href="'. base_url(). 'index.php/catalogos/enabled/'. $catalogo .'/' . $registro->$id .'" role="button">Habilitar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    }

                ?>
        </tbody>
    </table>
</div>
    <?php if( isset($catalogo_actualizar) ): ?>
    <h4>Actualizar</h4>
    <?php $columnas = $this->db->list_fields($catalogo); ?>

        <?php foreach ($columnas as $columna): ?>
        <label><?php echo $columna; ?></label><li><?php echo $catalogo_actualizar->$columna; ?></li>
        <?php endforeach; ?>

    <?php endif; ?>    
    
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</body>
</html>