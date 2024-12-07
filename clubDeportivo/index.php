<?php
	//Establezco conexión
	require 'conexion.php';
	
	//Preparo la sentencia SQL
    $sql = "SELECT * FROM clubdeportivo";

	//Ejecuto la sentencia y guardo el resultado
    $resultado = $mysqli->query($sql);
?>

<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery.dataTables.min.css">
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery-3.4.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/jquery.dataTables.min.js" ></script>
		
		<title>Club Deportivo La Venta</title>
		
		<script>
			$(document).ready( function () {
				$('#tabla').DataTable();
			} );
		</script>
		
		
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Socios</h1>
			</div>
			<br>
			
			<div class="row">
				<a href="registrar.php" class="btn btn-primary">Registrar</a>
			</div>
			<br>
			<br>
			
			<table id="tabla" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Telefono</th>
						<th>Fecha de nacimiento</th>
						<th>Categoría</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($fila = $resultado->fetch_assoc()){
							echo "<tr>";
							echo "<td>$fila[nombre]</td>";
							echo "<td>$fila[telefono]</td>";
							echo "<td>$fila[fecha_nacimiento]</td>";
							echo "<td>$fila[categoria]</td>";
					?>
							<td><a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning">Editar</a></td>
							<td><a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger">Eliminar</a></td>
					<?php							
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
			
		</div>
	</div>
	
	
</body>
</html>						