<?php
require 'conexion.php';

// Consulta para obtener todos los vehículos
$vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo");

// Consulta para obtener todas las sedes
$sedes = $mysqli->query("SELECT id_sede, localidad, provincia, direccion FROM sede");

// Consulta para obtener todas las inspecciones
$inspecciones = $mysqli->query("
    SELECT inspeccion.id_inspeccion, vehiculo.matricula, sede.localidad, inspeccion.fecha_insp, inspeccion.hora_insp, inspeccion.resultado
    FROM inspeccion
    JOIN vehiculo ON inspeccion.id_vehiculo = vehiculo.id_vehiculo
    JOIN sede ON inspeccion.id_sede = sede.id_sede
");
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Gestión de Inspecciones</title>
</head>

<body>
    <div class="container">
        <h1>Gestión de Inspecciones</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Registrar Inspección</h2>
                <form action="registrar2.php" method="post">
                    <div class="form-group">
                        <label for="vehiculo">Vehículo</label>
                        <select name="id_vehiculo" id="vehiculo" class="form-control" required>
                            <?php while ($vehiculo = $vehiculos->fetch_assoc()): ?>
                                <option value="<?= $vehiculo['id_vehiculo'] ?>">
                                    <?= "{$vehiculo['matricula']} - {$vehiculo['modelo']} (Combustible: {$vehiculo['combustible']}, Año: {$vehiculo['año_fab']})" ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sede">Sede</label>
                        <select name="id_sede" id="sede" class="form-control" required>
                            <?php while ($sede = $sedes->fetch_assoc()): ?>
                                <option value="<?= $sede['id_sede'] ?>">
                                    <?= "{$sede['localidad']} - {$sede['provincia']} (Dirección: {$sede['direccion']})" ?>
                                </option>
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
                    <input type="hidden" name="resultado" value="PENDIENTE">
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Lista de Inspecciones</h2>
                <a href="registrar_inspeccion.php" class="btn btn-primary mb-3">Registrar Inspección</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matrícula Vehículo</th>
                            <th>Localidad Sede</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($inspeccion = $inspecciones->fetch_assoc()): ?>
                            <tr>
                                <td><?= $inspeccion['id_inspeccion'] ?></td>
                                <td><?= $inspeccion['matricula'] ?></td>
                                <td><?= $inspeccion['localidad'] ?></td>
                                <td><?= $inspeccion['fecha_insp'] ?></td>
                                <td><?= $inspeccion['hora_insp'] ?></td>
                                <td><?= $inspeccion['resultado'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>