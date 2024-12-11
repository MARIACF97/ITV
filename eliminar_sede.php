<?php
require 'conexion.php';

$id_sede = $_GET['id_sede'];
$sql = "DELETE FROM sede WHERE id_sede=$id_sede";

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Sede eliminada correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al eliminar la sede</p>";
}
?>
<a href="sedes.php" class="btn btn-primary">Regresar</a>