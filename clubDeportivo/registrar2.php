<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<title>Club Deportivo La Venta</title>
	</head>
	<body>
		<?php
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];
			$fecha = $_POST['fecha'];
			$categoria = $_POST['categoria'];
			
			//Establezco conexión
			require 'conexion.php';

			//Preparo la sentencia SQL
			$sql = "INSERT INTO clubdeportivo (nombre,telefono,fecha_nacimiento,categoria) VALUES ('$nombre','$telefono','$fecha','$categoria')";

			//Ejecuto la sentencia y guardo el resultado
			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary">REGISTRO AGREGADO</p>
  					

		<?php
			} else {
		?>
				<br>
  				<p class="alert alert-danger">REGISTRO NO AGREGADO</p>
		<?php		
			}
		?>
			<br>
			<p><a href="index.php" class="btn btn-primary">Regresar</a></p>
	</body>
</html>