<div class="container">
    <h1>Editar Perfil</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src='<?php echo base_url() . "/uploads/" . $this->session->userdata('imagen'); ?>' width="150" heigth="200" class="avatar img-circle" alt="avatar">
          <h5>Upload a different photo...</h5>
          <input class="form-control" type="file">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Usuario:</label>
            <div class="col-lg-8">
              <h5><?php echo $this->session->userdata('nombreusuario');?></h5>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre:</label>
            <div class="col-lg-8">
              <h5><?php echo $this->session->userdata('nombrecomp');?></h5>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <h5><?php echo $this->session->userdata('correo');?></h5>
            </div>	
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Puesto:</label>
            <div class="col-lg-8">
              <h5>
                <?php
                  $depto = $this->db->get("puesto");
                            $valor = $depto->result();
                            foreach ($valor as $v) {
                                if($v->id_puesto == $this->session->userdata('puesto')){
                                    echo $v->nombre;
                                    break;
                                }
                            }
                ?>
              </h5>
            </div>
          </div>
            <div class="form-group">
            <label class="col-lg-3 control-label">Departamento:</label>
            <div class="col-lg-8">
              <h5>
                <?php
                  $depto = $this->db->get("departamento");
                            $valor = $depto->result();
                            foreach ($valor as $v) {
                                if($v->id_depto == $this->session->userdata('depto')){
                                    echo $v->nombre;
                                    break;
                                }
                            }
                ?>
              </h5>
            </div>	
          </div>
          <!--<div class="alert alert-info alert-dismissable">
          	<a class="panel-close close" data-dismiss="alert">×</a> 
          	<i class="fa fa-coffee"></i>
          	This is an <strong>.alert</strong>. Use this to show important messages to the user.
          </div>-->
          </div>
        </form>
      </div>
  </div>
</div>