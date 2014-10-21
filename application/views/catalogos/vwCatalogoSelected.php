    <div class="container">
        <h1>Catalogo <?php echo $catalogo; ?></h1>
    </div>
    <div class="container">
        <h3>Editar/Agregar registro</h3>
        <form action="<?php echo base_url();?>index.php/catalogos/insertarRegistro/<?php echo $catalogo?>" method="post">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                
                <?php
                    $columnas = $this->db->list_fields($catalogo);
                    $cont = 1;
                    foreach ($columnas as $columna ) {
                        if($cont!=1)
                        {
                            echo "<th>" .$columna . "</th>";    
                        }
                        $cont += 1;
                    }
                ?>
                <th>Acciones</th>
            </tr>
        </thead>
            <tr>
                <?php
                    $columnas = $this->db->list_fields($catalogo);
                    $cont = 1;
                    foreach ($columnas as $columna ) {
                        if($cont!=1)
                        {
                            echo '<td><input class="form-control" value="" type="text" name="' . $columna . '"></td>';    
                        }
                        $cont += 1;
                    }
                ?>
                <td>
                    <input type="submit" value="Guardar" class="btn btn-info btn-xs" >
                    <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                </td>
            </tr>
        </table>
    </form>
    </div>
<div class="container">
    <h3><?php echo $catalogo; ?></h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                
                <?php                    
                    foreach ($columnas as $columna ) {
                        echo "<th>" .$columna . "</th>";    
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
                            $id = 1;
                            $valor_id;
                            foreach ($columnas as $columna ) {

                                if($id == 2){
                                    $valor_id=$registro->$columna;
                                }
                                $id++;
                                echo "<td>" . $registro->$columna . "</td>";
                            }
                            echo "<td>";
                            echo '  <a class="btn btn-info btn-xs" data-toggle= "modal" data-target="#' . $valor_id . '" role="button">Editar</a>';
                            echo '  <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>';
                            echo '  <a class="btn btn-danger btn-xs" href="#" role="button">Deshabilitar</a>';
                            echo '  </td>';
                            echo '</tr>';
                            echo '<div class="modal fade" id="'.$valor_id.'" tabindex="-1" aria-hidden="true">';
                            echo '       <div class="modal-dialog">';
                            echo '           <div class="modal-content">';
                            echo '               <div class="modal-header">';
                            echo '                   <h2>Editar '.$valor_id.'</h2>';
                            echo '              </div>';
                            echo '              <div class="modal-body">';
                            $id_mod = 1; 
                            foreach ($columnas as $columna) {
                                if($id_mod == 1){
                                    echo '                  <label>'.$columna.'</label>';
                                    echo '                  <p>'.$registro->$columna.'</p></br>';
                                    $id_mod++;
                                }
                                else{
                                    $numFilas = count($foraneas);
                                    $total=1;
                                    echo '                  <label>'.$columna;
                                    foreach ($foraneas as $foreign) {
                                        if($foreign->column_name == $columna){
                                            echo '<SELECT NAME="selCombo" SIZE=1>';
                                            echo $foreign->referenced_column_name;
                                            echo $foreign->referenced_table_name;
                                            $columna_referencial=$foreign->referenced_column_name;
                                            $consultarOpciones = $this->db->query('select '.$foreign->referenced_column_name.' from '.$foreign->referenced_table_name.';');
                                            $consultarOpciones = $consultarOpciones->result();
                                            foreach ($consultarOpciones as $options) {
                                                echo '   <OPTION VALUE="link pagina 4">'.$options->$columna_referencial.'</OPTION> ';
                                            }                                            
                                            echo '</SELECT>'; 
                                            break;
                                        }
                                        elseif ($total == $numFilas){
                                            echo '                  <input type="text" value="'.$registro->$columna.'"></input></label></br>';
                                        }
                                        $total++;
                                    }
                                }
                            }
                            echo '              </div>';
                            echo '              <div class="modal-footer">';
                            echo '                  <a class="btn btn-primary" data-dismiss="modal">Guardar</a>';
                            echo '              </div>';
                            echo '          </div>';
                            echo '      </div>';
                            echo '</div>';
                        }
                    }

                
                ?>
                
                
                    

            
            

        </tbody>
    </table>
</div>
</body>
</html>