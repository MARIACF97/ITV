<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $combustible = $_POST['combustible'];
    $anio_fab = $_POST['anio_fab'];

    $mysqli->query("INSERT INTO vehiculo (matricula, modelo, combustible, anio_fab) VALUES ('$matricula', '$modelo', '$combustible', '$anio_fab')");
    header("Location: vehiculos.php");
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrar Vehículo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Registrar Vehículo</h1>
    <form method="post">
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
            <select name="combustible" id="combustible" class="form-control">
                <option value="GASOLINA">Gasolina</option>
                <option value="DIESEL">Diésel</option>
                <option value="ELECTRICO">Eléctrico</option>
                <option value="HIBRIDO">Híbrido</option>
                <option value="OTRO">Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="anio_fab">Año de Fabricación</label>
            <input type="number" name="anio_fab" id="anio_fab" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
</body>
</html>
