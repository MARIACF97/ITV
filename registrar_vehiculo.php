<?php
require 'conexion.php';

$matricula = $_POST['matricula'];
$modelo = $_POST['modelo'];
$combustible = $_POST['combustible'];
$anio_fab = $_POST['anio_fab'];
$id_sede = $_POST['id_sede'];

$sql = "INSERT INTO vehiculo (matricula, modelo, combustible, anio_fab, id_sede) VALUES ('$matricula', '$modelo', '$combustible', $anio_fab, $id_sede)";
if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Vehículo registrado correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al registrar el vehículo</p>";
}
?>
<a href="index.php" class="btn btn-primary">Regresar</a>
