<?php
require 'conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM sede WHERE id_sede=$id";

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Sede eliminada correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al eliminar la sede</p>";
}
?>
<a href="sede.php" class="btn btn-primary">Regresar</a>