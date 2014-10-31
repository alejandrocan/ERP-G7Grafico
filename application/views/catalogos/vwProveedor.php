<div class="container">
        <h1><?php echo $catalogo ?></h1>
    </div>
    <div class="container">
        <h3>Agregar registro <small><?php echo $catalogo ?></small></h3>
        <form action="<?php echo base_url();?>index.php/udm/insertarRegistro" method="post">
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
                        <td><input class="form-control" value="" type="text" name="Nombre"></td>
                        <td><input class="form-control" value="" type="text" name="Tipo"></td>
                        <td>
                            <input type="submit" value="Guardar" class="btn btn-info btn-xs" >
                            <input type="button" value="Cancelar" class="btn btn-danger btn-xs" action="" method="post" >
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    if(count($registros) > 0 ){
                        foreach ($registros as $registro) {
                            echo "<tr>";

                            $columnas = $this->db->list_fields($catalogo);
                            $cont = 1;
                            $valor_id;
                            foreach ($columnas as $columna ) {

                                if($columna == 'estado'){

                                }
                                else{
                                    echo "<td>" . $registro->$columna . "</td>";
                                }
                               
                                if($cont == 2){
                                    $valor_id=$registro->$columna;
                                }
                                $cont++;
                            }
                            echo "<td>";
                            
                        }
                    }
                ?>
            </tbody>

        </table>
    </div>
</body>
</html>