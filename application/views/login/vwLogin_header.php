<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">   
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo $title ?></title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/loginBootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/login.css">
    <script type="text/javascript" src="<?=base_url();?>js/loginvalidation.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $('#username').focus();
    $('#username').blur(function(){         
         var user = $(this).val();
           
          if(user==''){
                
            $('#msg_username').html('El Usuario es requerido').css('color','red');
                
            }else{
                            
            var info = { username: user }; 
            
                $.ajax({                
                    url: '<?php echo base_url();?>application/login_model/valid_user_ajax',
                    type: 'POST',              
                    data: info,
                    success: function(msg){  // alert(msg);        
                              if(msg!=1){
                                  
                                  $('#msg_username').html('El Usuario es Incorrecto').css('color','red');
                              }else {                      
                              $('#msg_username').html('El Usuario es correcto').css('color','green');                              
                                  
                              }                          
                    }
                                  
                });                   
            }

          });      
    });    

    $(document).ready(function(){
    $('#password').blur(function(){        
         var user = $(this).val();
            
          if(user==''){
                
            $('#msg_password').html('La Contraseña es requerida').css('color','red');
                
            }else{
                            
               $('#msg_password').empty();
            }

        });      
    });    
    </script>
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
    </nav><!-- End Header -->