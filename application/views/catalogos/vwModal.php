<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
    <script scr="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script scr="<?php echo base_url(); ?>js/bootstrap.js"></script>  
</head>
<body>
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensaje de Alerta</h4>
      </div>
      <div class="modal-body">
        Usted ha seleccionado la opción de deshabilitar por lo que el registro se eliminará
        <?php
          echo $catalogo_actualizar;
        ?>
        <center>¿Desea continuar?</center>
      </div>
      <div class="modal-footer">
        <center>
            <a href="#" class="btn btn-primary" data-dismiss="modal">Si</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </center>
      </div>
    </div>
  </div>
</div>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
</body>
</html>