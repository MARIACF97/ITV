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
			$id = $_GET['id'];

			//Establezco conexión
			require 'conexion.php';
			
			//Preparo la sentencia SQL
			$sql = "DELETE FROM clubdeportivo WHERE id=$id";

			//Ejecutamos sentencia y guardamos resultado
			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary">REGISTRO ELIMINADO</p>
		<?php
			} else {
		?>
				<br>
				<p class="alert alert-danger">REGISTRO NO ELIMINADO</p>
		<?php
			}
		?>
			<br>
			<p><a href="index.php" class="btn btn-primary">Regresar</a></p>

	</body>
</html>