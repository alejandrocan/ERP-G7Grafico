<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Simple Login with CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/loginBootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/login.css">
    <script src="//oss.maxcdn.com/bootbox/4.2.0/bootbox.min.js"></script>
 </head>
 <body>
    <nav id="header" class="navbar navbar-default">
      <div class="container" >
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><img src="<?php echo base_url();?>/img/G7-V3.png"></a>
        </div>
        <div>
          <ul class="nav navbar-nav">
            <li>
              <a href="#"><?php echo $title ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php $attributes = array('id' => 'loginForm');?>
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin',$attributes); ?>
      <div class="jumbotron loginbox">
      <label class= "lblLogin" for="username">Usuario</label>
      <input class="form-control" type="text" size="20" id="username" name="username"/>
      <label class= "lblLogin" for="password">Contraseña</label>
      <input type="password" size="20" id="passowrd" name="password"/>
      <input id="loginButton" class='btn btn-success' type="submit" value="Acceder"/>
   </div>
   </form>
 </body>
</html>