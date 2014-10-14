    <div class="container">
        <h1>Catalogo Usuarios</h1>
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
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Asunto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Rocky</td>
                <td>Balboa</td>
                <td>Donec nec justo eget felis facilisis fermentum.
                    Aliquam porttitor mauris sit amet orci. Aenean
                    dignissim pellentesque felis.
                </td>
                <td>
                    <a class="btn btn-info btn-xs" href="#" role="button">Editar</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>
                    <a class="btn btn-danger btn-xs" href="#" role="button">Deshabilitar</a>
                </td>

            </tr>
            <tr>
                <td>2</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>Donec nec justo eget felis facilisis fermentum.
                    Aliquam porttitor mauris sit amet orci.
                    Aenean dignissim pellentesque felis.
                </td>
                <td>
                    <a class="btn btn-info btn-xs" href="#" role="button">Editar</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>
                    <a class="btn btn-danger btn-xs" href="#" role="button">Deshabilitar</a>
                </td>
            </tr>
            <tr class="danger">
                <td>3</td>
                <td>John</td>
                <td>Rambo</td>
                <td>Donec nec justo eget felis facilisis fermentum.
                    Aliquam porttitor mauris sit amet orci.
                    Aenean dignissim pellentesque felis.
                </td>
                <td>
                    <a class="btn btn-info btn-xs" href="#" role="button">Editar</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Duplicar</a>
                    <a class="btn btn-success btn-xs" href="#" role="button">Habilitar</a>
                </td>
            </tr>

        </tbody>
    </table>
</div>