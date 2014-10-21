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
		<title>testing</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
		<script src="<?php echo base_url(); ?>/js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>/js/bootstrap.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#acolapsar">
						<span class="sr-only">G7 Gráfico</span>
					</button>
					<a href="#" class="navbar-brand">G7 Gráfico</a>
				</div>

				<div class="collapse navbar-collapse" id="acolapsar">
					<ul class="nav navbar-nav">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>Usuario</a></li>
						<li><a href="<?php echo base_url(); ?>/index.php/login/logout"><span class="glyphicon glyphicon-share-alt"></span> Cerrar Sesión</a></li>
						<li class=""></li>
					</ul>
				</div>

			</div>
		</nav>