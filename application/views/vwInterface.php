<center>
<h1>Departamento</h1>
<h3>Puesto</h3>
</center>

<div style="margin-top: 60px; margin: auto; width:70%;">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#catalogos" data-toggle="tab">Catalogos</a></li>
		<li><a href="#explosion" data-toggle="tab">Explosión de Insumos</a></li>
		<li><a href="#reportes" data-toggle="tab">Reportes</a></li>
		<li><a href="#kardex" data-toggle="tab">Kardex</a></li>
	</ul>
	<div class="table">
		<div class="table tab-pane fade in active" id="catalogos">
			<h4>Catálogos</h4>



			<?php
				
				#echo '<div class="list-group table">';
				#foreach ($tables as $table) {
				#	echo '<a href="' . base_url() . 'index.php/catalogos/index/'. $table .'/" class="list-group-item">';
				#	echo '<span class="glyphicon glyphicon-list-alt"> </span>';
				#	echo " " . $table;
				#	$this->db->from($table);
				#	$rows = $this->db->count_all_results();
				#	echo '<span class="badge">'. $rows .'</span>';
				#	echo '</a>';
				#}
				#echo '</div>';


				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/puesto/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Puesto';
					$this->db->from("puesto");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/departamento/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Departamento';
					$this->db->from("departamento");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/familia/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Familia';
					$this->db->from("familia");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/proveedor/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Proveedor';
					$this->db->from("proveedor");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/udm/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> UDM';
					$this->db->from("udm");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/presentacion/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Presentación';
					$this->db->from("presentacion");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/material/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Material';
					$this->db->from("material");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/producto/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Producto';
					$this->db->from("producto");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/usuario/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Usuario';
					$this->db->from("usuario");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div';				
			?>
		</div>
		<div class="tab-pane fade" id="explosion">
			<h4>Explosión</h4>
			<input type="text" placeholder="Buscador" class="form-control">
			<a href="#"><span class="glyphicon glyphicon-plus-sign"></span></a>
			<a href="#"><span class="glyphicon glyphicon-minus-sign"></span></a>
			<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="#"><span class="glyphicon glyphicon-retweet"></span></a>
		</div>
		<div class="tab-pane fade" id="reportes">
			<h4>Reportes</h4>
		</div>
		<div class="tab-pane fade" id="kardex">
			<h4>Kardex</h4>
		</div>
	</div>
</div>