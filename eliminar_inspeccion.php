<?php
require 'conexion.php';

$id_inspeccion = $_GET['id_inspeccion'];
$sql = "DELETE FROM inspeccion WHERE id_inspeccion=$id_inspeccion";

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Inspección eliminada correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al eliminar la inspección</p>";
}
?>
<a href="inspecciones.php" class="btn btn-primary">Regresar</a>