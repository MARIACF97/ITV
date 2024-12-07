<?php
require 'conexion.php';

// Consulta para obtener todos los vehículos
$vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo FROM vehiculo");

// Consulta para obtener todas las sedes
$sedes = $mysqli->query("SELECT id_sede, localidad, provincia FROM sede");
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Inspección</title>
</head>
<body>
<div class="container">
    <h1>Registrar Inspección</h1>
    <form action="registrar2.php" method="post">
        <div class="form-group">
            <label for="vehiculo">Vehículo</label>
            <input type="text" name="matricula" id="vehiculo" class="form-control" placeholder="Ingrese la matrícula y modelo del vehículo" required>
        </div>
        <div class="form-group">
            <label for="sede">Sede</label>
            <input type="text" name="localidad" id="sede" class="form-control" placeholder="Ingrese la localidad y provincia de la sede" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha_inspeccion" id="fecha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" name="hora_inspeccion" id="hora" class="form-control" required>
        </div>
        <input type="hidden" name="resultado" value="pendiente">
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
</body>
</html>
