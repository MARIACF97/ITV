<?php
require 'conexion.php';

$id = $_GET['id'];
$sql = "SELECT id_sede, localidad, provincia, direccion FROM sede WHERE id_sede = $id";
$resultado = $mysqli->query($sql);
$sede = $resultado->fetch_assoc();
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Editar Sede</title>
</head>

<body>
    <div class="container">
        <h1>Editar Sede</h1>
        <form action="guardar_sede.php" method="post">
            <input type="hidden" name="id" value="<?php echo $sede['id_sede']; ?>">
            <div class="form-group">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" name="localidad" value="<?php echo $sede['localidad']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?php echo $sede['provincia']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $sede['direccion']; ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="sede.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>