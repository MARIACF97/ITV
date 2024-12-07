<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $combustible = $_POST['combustible'];
    $año_fab = $_POST['año_fab'];

    // Consulta para insertar el nuevo vehículo
    $sql = "INSERT INTO vehiculo (matricula, modelo, combustible, año_fab)
            VALUES ('$matricula', '$modelo', '$combustible', '$año_fab')";

    if ($mysqli->query($sql)) {
        echo "<p class='alert alert-success'>Vehículo registrado correctamente</p>";
        header("Location: vehiculos.php");
    } else {
        echo "<p class='alert alert-danger'>Error al registrar la sede</p>";
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
                <label for="matricula">Matrícula:</label>
                <input type="text" name="matricula" id="matricula" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <select name="combustible" id="combustible" class="form-control" required>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diésel">Diésel</option>
                    <option value="Eléctrico">Eléctrico</option>
                    <option value="Híbrido">Híbrido</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="año_fab">Año de fabricación</label>
                <input type="number" name="año_fab" id="año_fab" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
        </form>
    </div>
</body>

</html>