<?php
require 'conexion.php';

$localidad = $_POST['localidad'];
$provincia = $_POST['provincia'];
$direccion = $_POST['direccion'];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Actualización de sede existente
    $sql = "UPDATE sede SET localidad='$localidad', provincia='$provincia', direccion='$direccion' WHERE id_sede=$id";
} else {
    // Inserción de nueva sede
    $sql = "INSERT INTO sede (localidad, provincia, direccion) VALUES ('$localidad', '$provincia', '$direccion')";
}

if ($mysqli->query($sql)) {
    echo "<p class='alert alert-success'>Sede registrada correctamente</p>";
} else {
    echo "<p class='alert alert-danger'>Error al registrar la sede</p>";
}
?>
<a href="sede.php" class="btn btn-primary">Regresar</a>