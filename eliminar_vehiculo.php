<?php
require 'conexion.php';

$id_vehiculo = $_GET['id_vehiculo'];
$sql = "DELETE FROM vehiculo WHERE id_vehiculo=$id_vehiculo";

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Vehículo eliminado correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al eliminar el vehículo</p>";
}
?>
<a href="vehiculos.php" class="btn btn-primary">Regresar</a>