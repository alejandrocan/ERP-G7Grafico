
<!DOCTYPE html>
<!-- 
	G7 Gráfico - Púrpura Pi
	Author: Ramon Alejandr Can Tepal
	Fecha: 23/Sep/2014
	Description: Carga el encabezado de la interfaz
-->
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="http://localhost/ERP-G7Grafico//css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://localhost/ERP-G7Grafico//css/jquery-ui.css">
		<script type="text/javascript" src="http://localhost/ERP-G7Grafico/js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="http://localhost/ERP-G7Grafico/js/jquery-ui.js"></script>
		<script src="http://localhost/ERP-G7Grafico/js/bootstrap.min.js"></script>
		

		
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#acolapsar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url();?>index.php/login2" class="navbar-brand">G7 Gráfico</a>
				</div>

				<div class="collapse navbar-collapse" id="acolapsar">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo base_url(); ?>/index.php/userprofile"><span class="glyphicon glyphicon-user"></span><?php echo ' ' . $user; ?></a></li>
						<li><a href="<?php echo base_url(); ?>/index.php/login2/logout_ci"><span class="glyphicon glyphicon-share-alt"></span> Cerrar Sesión</a></li>
						<li class=""></li>
					</ul>
				</div>
		</nav>