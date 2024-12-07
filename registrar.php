<?php
require 'conexion.php';

// Consulta para obtener todos los vehículos
$vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo FROM vehiculo");

// Consulta para obtener todas las sedes
$sedes = $mysqli->query("SELECT id_sede, localidad, provincia FROM sede");
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Inspección</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Inspección</h1>
        <form action="registrar2.php" method="post">
            <div class="form-group">
                <label for="vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="vehiculo" class="form-control" required>
                    <?php while ($vehiculo = $vehiculos->fetch_assoc()): ?>
                        <option value="<?= $vehiculo['id_vehiculo'] ?>"><?= $vehiculo['matricula'] ?> - <?= $vehiculo['modelo'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sede">Sede</label>
                <select name="id_sede" id="sede" class="form-control" required>
                    <?php while ($sede = $sedes->fetch_assoc()): ?>
                        <option value="<?= $sede['id_sede'] ?>"><?= $sede['localidad'] ?> - <?= $sede['provincia'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora_insp" id="hora" class="form-control" required>
            </div>
            <input type="hidden" name="resultado" value="pendiente">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>