<html>
<head>
	<title>Vista Global - G7 Gráfico</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
        <h1>Compras <small> Folio <?php  echo $this->LISTAMATERIALES[0][0];?></small></h1>
	</div>
	<div class="container table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				 <th>ID</th>
				 <th>Nombre</th>
				 <th>Cantidad</th>
				 <th>Precio</th>
				 <th>Total</th>
			</thead>
			<tbody>
				<?php
					$cuenta = count($this->LISTAMATERIALES);
					if($cuenta>1)
					{
						for($i=1;$i<$cuenta;$i++)
						{
							echo '			<tr>';
							echo '				<td>'.$this->LISTAMATERIALES[$i][0].'</td>';
							echo '				<td>'.$this->LISTAMATERIALES[$i][1].'</td>';
							echo '				<td>'.$this->LISTAMATERIALES[$i][2].' '.$this->LISTAMATERIALES[$i][5].'</td>';
							echo '				<td>'.$this->LISTAMATERIALES[$i][3].'</td>';
							echo '				<td>'.$this->LISTAMATERIALES[$i][4].'</td>';
							echo '			</tr>';
						}
					}
					else
					{
						echo '<tr><td colspam="4">No hay ninguna explosión con el Folio ingresado.</td></tr>';
					}
				?>
			</tbody>

		</table>
	</div>
</body>
</html>
