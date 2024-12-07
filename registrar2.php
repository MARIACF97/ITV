<?php
require 'conexion.php';

$id_vehiculo = $_POST['id_vehiculo'];
$id_sede = $_POST['id_sede'];
$fecha_inspeccion = $_POST['fecha_inspeccion'];
$hora_inspeccion = $_POST['hora_inspeccion'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observaciones'];

$sql = "INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_inspeccion, hora_inspeccion, resultado, observaciones)
        VALUES ('$id_vehiculo', '$id_sede', '$fecha_inspeccion', '$hora_inspeccion', '$resultado', '$observaciones')";

if ($mysqli->query($sql)) {
    echo "<p>Inspección registrada con éxito</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
} else {
    echo "<p>Error: " . $mysqli->error . "</p>";
}
