<?php
require 'conexion.php';

// Recoger datos del formulario
$id_vehiculo = $_POST['id_vehiculo'];
$id_sede = $_POST['id_sede'];
$fecha_insp = $_POST['fecha_insp'];
$hora_insp = $_POST['hora_insp'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observaciones'];

// Verificar si el ID de vehículo existe
$vehiculo_exists = $mysqli->query("SELECT 1 FROM vehiculo WHERE id_vehiculo = '$id_vehiculo'")->num_rows > 0;

if (!$vehiculo_exists) {
    echo "<p>Error: El ID de vehículo no existe.</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
    exit;
}

// Verificar si el ID de sede existe
$sede_exists = $mysqli->query("SELECT 1 FROM sede WHERE id_sede = '$id_sede'")->num_rows > 0;

if (!$sede_exists) {
    echo "<p>Error: El ID de sede no existe.</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
    exit;
}

// Consulta para insertar la inspección
$sql = "INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
        VALUES ('$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')";

if ($mysqli->query($sql)) {
    echo "<p>Inspección registrada con éxito</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
} else {
    echo "<p>Error: " . $mysqli->error . "</p>";
}
