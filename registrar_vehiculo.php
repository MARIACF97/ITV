<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $combustible = $_POST['combustible'];
    $año_fab = $_POST['año_fab'];
    $id_sede = $_POST['id_sede'];

    // Consulta para insertar el nuevo vehículo
    $sql = "INSERT INTO vehiculo (matricula, modelo, combustible, año_fab, id_sede)
            VALUES ('$matricula', '$modelo', '$combustible', '$año_fab', '$id_sede')";

    if ($mysqli->query($sql)) {
        echo "<p>Vehículo registrado con éxito</p>";
        echo '<a href="index.php" class="btn btn-primary">Regresar</a>';
    } else {
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Vehículo</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Vehículo</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" id="matricula" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <input type="text" name="combustible" id="combustible" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="año_fab">Año de fabricación</label>
                <input type="number" name="año_fab" id="año_fab" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_sede">ID de sede</label>
                <input type="text" name="id_sede" id="id_sede" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>