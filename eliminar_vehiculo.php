<?php
require 'conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM vehiculo WHERE id_vehiculo=$id";

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Vehículo eliminado correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al eliminar el vehículo</p>";
}
?>
<a href="index.php" class="btn btn-primary">Regresar</a>