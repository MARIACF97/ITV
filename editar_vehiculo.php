<?php
require 'conexion.php';

$id = $_GET['id'];
$sql = "SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo WHERE id_vehiculo = $id";
$resultado = $mysqli->query($sql);
$vehiculo = $resultado->fetch_assoc();
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Editar Vehículo</title>
</head>

<body>
    <div class="container">
        <h1>Editar Vehículo</h1>
        <form action="editar2.php" method="post">
            <input type="hidden" name="id" value="<?php echo $vehiculo['id_vehiculo']; ?>">
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" class="form-control" name="matricula" value="<?php echo $vehiculo['matricula']; ?>">
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?php echo $vehiculo['modelo']; ?>">
            </div>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <input type="text" class="form-control" name="combustible" value="<?php echo $vehiculo['combustible']; ?>">
            </div>
            <div class="form-group">
                <label for="año_fab">Año Fabricación</label>
                <input type="text" class="form-control" name="año_fab" value="<?php echo $vehiculo['año_fab']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>