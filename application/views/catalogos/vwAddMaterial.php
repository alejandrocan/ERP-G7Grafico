<script type="text/javascript">
$(document).ready(function(){

 $('tr:odd').css('background', '#e3e3e3');
 var url = '<?php echo base_url();?>index.php/autocompletar/get_data'; 

 $('#buscar').autocomplete({
    source: url+'?item=nombre'
  });

});    
</script>

<div class="container">
	<form class="navbar-form navbar-left" role="search">
    	<div class="form-group">
        	<input type="text" class="form-control" placeholder="Producto/Material" id="buscar">
      	</div>
      	<button type="submit" class="btn btn-default">Agregar</button>
    </form>


	<table class="table table-bordered table-hover">
		<thead>
		<tr>		
			<th>Material</th>
			<th>Cantidad usada</th>
			<th>UDM</th>
			<th>Acciones</th>
		</tr>
		</thead>
		<tr>		
			<td><input class="form-control" value="" type="text" name="producto"></td>
			<td><input class="form-control" value="" type="text" name="cant_usada"></td>
			<td>
				<select class="form-control" name="udm">
					<?php $query = $this->db->get("udm");
	                        $valores = $query->result(); 
	                ?>
                    <?php foreach ($valores as $valor): ?>
                    	<?php if($valor->estado == 1): ?>
                        	<option><?php echo $valor->nombre; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>					
				</select>
			</td>
			<td>
                    <button type="submit" class="btn btn-info btn-sm">Agregar</button>
                    <input type="reset" value="Cancelar" class="btn btn-danger btn-sm" action="" method="post" />
                    <input type="reset" value="Terminar" class="btn btn-success btn-sm" action="" method="post" />
            </td>
		</tr>
	</table>
</div>
</body>
</html>

