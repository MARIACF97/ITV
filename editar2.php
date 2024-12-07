<?php
require 'conexion.php';

$id = $_POST['id'];

if (isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $sql = "UPDATE vehiculo SET matricula='$matricula', modelo='$modelo' WHERE id_vehiculo=$id";
} elseif (isset($_POST['id_inspeccion'])) {
    $id_inspeccion = $_POST['id_inspeccion'];
    $fecha_inspeccion = $_POST['fecha_inspeccion'];
    $hora_inspeccion = $_POST['hora_inspeccion'];
    $resultado = $_POST['resultado'];
    $observaciones = $_POST['observaciones'];
    $sql = "UPDATE inspeccion SET fecha_inspeccion='$fecha_inspeccion', hora_inspeccion='$hora_inspeccion', resultado='$resultado', observaciones='$observaciones' WHERE id_inspeccion=$id_inspeccion";
}

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Registro actualizado correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al actualizar el registro</p>";
}
?>
<a href="index.php" class="btn btn-primary">Regresar</a>
