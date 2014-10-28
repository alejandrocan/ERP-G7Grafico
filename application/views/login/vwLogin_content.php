
<div id="content" class="jumbotron loginbox">
        
    <?php $attributes = array('id' => 'form_login'); 

        $username = array('name'=>'username', 'id'=>'username','class'=>'input',
                          'value'=>set_value('username'),);
        $password = array('name'=>'password', 'id'=>'password','class'=>'input',
                          'type'=>'password',);

    if(validation_errors()):       
     ?> 
    <div id="error"><?=validation_errors();?></div>
    <?php endif ?>

    <?php echo form_open('login', $attributes);?>
    <div class="lblLogin"><?=form_label('Usuariso');?></div>
    <div id='msg_username' class="padding"></div> 
    <div class="padding"><?=form_input($username);?></div>
    <div class="lblLogin"><?=form_label('Contraseña')?></div>
    <div id='msg_password' class="padding"></div> 
    <div class="padding"><?=form_input($password)?></div>

    <?php echo form_submit(array('name' => 'submit','class'=>'btn btn-success', 'value' => 'Acceder'))?>
    <?php echo form_close();?>

</div><!-- End Content --></body>
</html>