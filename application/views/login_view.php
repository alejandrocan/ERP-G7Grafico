    
    <?php
    $username = array('name' => 'username', 'class'=>'form-control', 'placeholder'=>'Usuario');
    $password = array('name' => 'password', 'class'=>'form-control', 'placeholder'=>'Contraseña');
    $submit = array('name' => 'submit', 'class'=>'btn btn-success', 'value' => 'Acceder', 'title' => 'Iniciar sesión');

    ?>
        <div id="loginbox" class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Inicio de sesión</div>
                </div>     
                <div style="padding-top:30px" class="panel-body" >
                    <?php echo form_open(base_url().'index.php/login2/new_user')?>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <?php echo form_input($username)?><?php echo form_error('username')?>                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <?php echo form_password($password)?><?php echo form_error('password')?>
                    </div> 
                    <?php echo form_hidden('token',$token)?>
                    <?php echo form_submit($submit)?>
                    <?php echo form_close()?>   
                </div>                     
            </div>  
        </div>
    </body>
</html>