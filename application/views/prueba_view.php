<html>
<head>
	<title></title>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
</head>
<body>
	<script type="text/javascript">
				$(document).ready(function(){

					 var url = '<?php echo base_url();?>index.php/autocompletar/get_data'; 

					$('#resources').autocomplete({
					    source: url+'?item=nombre'
					});

				});  
			</script>
			<input type="text" class="form-control" placeholder="Producto/Material" id="resources">
</body>
</html>