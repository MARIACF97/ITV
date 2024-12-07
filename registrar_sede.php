<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $direccion = $_POST['direccion'];

    $mysqli->query("INSERT INTO sede (localidad, provincia, direccion) VALUES ('$localidad', '$provincia', '$direccion')");
    header("Location: sedes.php");
    exit();
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registrar Sede</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Registrar Sede</h1>
        <form method="post">
            <div class="form-group">
                <label for="localidad">Localidad</label>
                <input type="text" name="localidad" id="localidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" id="provincia" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
    </div>
</body>

</html>