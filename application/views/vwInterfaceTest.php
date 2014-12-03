<center>
<h1>Departamento</h1>
<h3>Puesto</h3>
</center>

<div style="margin-top: 60px; margin: auto; width:70%;">
	<ul class="nav nav-tabs">
		<li class="<?php echo $catalogos; ?>"><a href="#catalogos" data-toggle="tab">Catalogos</a></li>
		<li class="<?php echo $explosion; ?>"><a href="#explosion" data-toggle="tab">Explosión de Insumos</a></li>
		<li class="<?php echo $reportes; ?>"><a href="#reportes" data-toggle="tab">Reportes</a></li>
		<li class="<?php echo $kardex; ?>"><a href="#kardex" data-toggle="tab">Kardex</a></li>
	</ul>
	<div class="tab-content">

		<div class="tab-pane fade in active" id="catalogos">
			<h4>Catálogos</h4>
			<?php
				
			

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/puesto/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Puesto';
					$this->db->from("puesto");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/departamento/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Departamento';
					$this->db->from("departamento");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/familia/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Familia';
					$this->db->from("familia");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/proveedor/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Proveedor';
					$this->db->from("proveedor");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/udm/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> UDM';
					$this->db->from("udm");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/presentacion/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Presentación';
					$this->db->from("presentacion");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/material/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Material';
					$this->db->from("material");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/producto/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Producto';
					$this->db->from("producto");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';

				echo '<div class="list-group table">';
				echo '	<a href="' . base_url() . 'index.php/catalogos/index/usuario/registros/" class="list-group-item">';
				echo '		<span class="glyphicon glyphicon-list-alt"> </span> Usuario';
					$this->db->from("usuario");
					$rows = $this->db->count_all_results();
				echo '		<span class="badge">'. $rows .'</span>';
				echo '	</a>';
				echo '</div>';				
			?>
		</div>

		<div class="tab-pane fade" id="explosion">
			<h4>Explosión</h4>
			<!--JavaScript funcion del autocompletado -->
			<script type="text/javascript">
				$(document).ready(function(){

					 var url = '<?php echo base_url();?>index.php/autocompletar/get_data'; 

					$('#resources').autocomplete({
					    source: url+'?item=nombre'
					});

				});  
			</script>	
			<!--JavaScript End-->	
			
				<!--Formulario de busqueda-->
				<form class="navbar-form navbar-left" role="search" action="<?php echo base_url(); ?>/index.php/explosion" method="post">
			    	<div class="form-group">
			        	<input type="text" class="form-control" placeholder="Producto/Material" id="resources">
			        	<input type="text" class="form-control" placeholder="Cantidad" id="cantidad">
			        	<input type="text" class="form-control" placeholder="UDM" id="medida">
			      	</div>
			      	<button type="button"  class="btm btn-default" onClick="newProduct()">Nuevo</button>
			      	<button type="submit" class="btn btn-success" onClick="AgregarValores()">Agregar</button>
			      	<button type="reset" class="btn btn-danger">Cancelar</button>
			    </form>			
			    <!--Formulario End-->
			    <!--Agregar Funcion Script para agregar un producto en la tabla-->
			    <script type="text/javascript">
			    	var valor = document.getElementById("resources");
			    	var cant = document.getElementById("cantidad");
			    	function AgregarValores() {
			    		document.getElementById("AddProduct").innerHTML += "<td> " + valor.value + "</td><td>" + cant.value + "</td><td>" + unidadmedida;
			    	}
			    </script>

			    <!--Tabla de materiales agregados-->
			    <table class="table table-bordered table-hover container">
			    	<thead>
			    		<tr>
			    			<th>Descripcion</th>
			    			<th>Cantidad</th>
			    			<th>UDM</th>
			    		</tr>
			    	</thead>
			    	<tbody id="AddProduct">

			    	</tbody>
			    </table>
			    <!--Table End-->
				<!--Seccion de botones de resumen y global-->
				<button class="btn btn-default">Guardar</button>
				<button class="btn btn-default">Vista Resumida</button>
				<button class="btn btn-default">Vista Global</button>
		</div>

		<div class="tab-pane fade" id="reportes">
			<h4>Reportes</h4>
			<h2>Cooming soon!</h2>
		</div>

		<div class="tab-pane fade" id="kardex">
			<h4>Kardex</h4>
			<h2>Cooming soon!</h2>
		</div>
	</div>
</div>