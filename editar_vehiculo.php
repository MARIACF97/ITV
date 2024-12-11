<?php
require 'conexion.php';

$id_vehiculo = $_GET['id_vehiculo'];
$sql = "SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo WHERE id_vehiculo = $id_vehiculo";
$resultado = $mysqli->query($sql);
$id_vehiculo = $resultado->fetch_assoc();
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
            <input type="hidden" name="id" value="<?php echo $id_vehiculo['id_vehiculo']; ?>">
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" class="form-control" name="matricula" value="<?php echo $id_vehiculo['matricula']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?php echo $id_vehiculo['modelo']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <input type="text" class="form-control" name="combustible" value="<?php echo $id_vehiculo['combustible']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="año_fab">Año Fabricación</label>
                <input type="text" class="form-control" name="año_fab" value="<?php echo $id_vehiculo['año_fab']; ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>