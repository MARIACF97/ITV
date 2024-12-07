<!-- guardar_inspeccion.php -->
<?php
require 'conexion.php';

// Recoger datos del formulario
$id_vehiculo = $_POST['id_vehiculo'];
$id_sede = $_POST['id_sede'];
$fecha_insp = $_POST['fecha_insp'];
$hora_insp = $_POST['hora_insp'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observaciones'];

// Consulta para insertar la inspección
$sql = "INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
        VALUES ('$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')";

if ($mysqli->query($sql)) {
    echo "<p>Inspección registrada con éxito</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
} else {
    echo "<p>Error: " . $mysqli->error . "</p>";
}
?>