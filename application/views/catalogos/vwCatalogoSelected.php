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
                    $columnas = $this->db->list_fields($catalogo);
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
                            foreach ($columnas as $columna ) {

                                echo "<td>" . $registro->$columna . "</td>";
                            }
                            echo "<td>";
                            echo '<a class="btn btn-info btn-xs" href="" role="button">Editar</a>';
                            echo '<a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>';
                            echo '<a class="btn btn-danger btn-xs" href="#" role="button">Deshabilitar</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }

                
                ?>
                
                
                    

            
            

        </tbody>
    </table>
</div>