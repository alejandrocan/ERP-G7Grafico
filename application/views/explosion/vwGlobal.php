<div class="container">
        <h1>Vista Global</h1>
</div>
<div "table-responsive">
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
				for($i=0;$i<$cuenta;$i++)
				{
					echo '			<tr>';
					echo '				<td>'.$this->LISTAMATERIALES[$i][0].'</td>';
					echo '				<td>'.$this->LISTAMATERIALES[$i][1].'</td>';
					echo '				<td>'.$this->LISTAMATERIALES[$i][2].'</td>';
					echo '				<td>'.$this->LISTAMATERIALES[$i][3].'</td>';
					echo '				<td>'.$this->LISTAMATERIALES[$i][4].'</td>';
					echo '			</tr>';
				}
			?>
		</tbody>

	</table>
</div>