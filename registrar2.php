<?php
require 'conexion.php';

// Capturar los datos del formulario
$id_inspeccion = isset($_POST['id_inspeccion']) ? $_POST['id_inspeccion'] : null;
$id_vehiculo = isset($_POST['id_vehiculo']) ? $_POST['id_vehiculo'] : null;
$id_sede = isset($_POST['id_sede']) ? $_POST['id_sede'] : null;
$fecha_insp = isset($_POST['fecha_insp']) ? $_POST['fecha_insp'] : null;
$hora_insp = isset($_POST['hora_insp']) ? $_POST['hora_insp'] : null;
$resultado = isset($_POST['resultado']) ? $_POST['resultado'] : null;
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

// Verificar que los IDs de vehículo y sede existan antes de insertar
$vehiculo_valido = false;
$sede_valida = false;

$vehiculo_check = $mysqli->query("SELECT id_vehiculo FROM vehiculo WHERE id_vehiculo = '$id_vehiculo'");
$sede_check = $mysqli->query("SELECT id_sede FROM sede WHERE id_sede = '$id_sede'");

if ($vehiculo_check->num_rows > 0) {
    $vehiculo_valido = true;
}

if ($sede_check->num_rows > 0) {
    $sede_valida = true;
}

// Verificar que ambos existan antes de continuar con la inserción
if ($vehiculo_valido && $sede_valida) {
    $sql = "INSERT INTO inspeccion (id_inspeccion, id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
            VALUES ('$id_inspeccion', '$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')";

    if ($mysqli->query($sql)) {
        echo "<p>Inspección registrada con éxito</p>";
        echo '<a href="index.php" class="btn btn-primary">Volver</a>';
    } else {
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
} else {
    echo "<p>Error: Uno o ambos de los identificadores de vehículo o sede no existen.</p>";
    echo '<a href="index.php" class="btn btn-primary">Volver</a>';
}
