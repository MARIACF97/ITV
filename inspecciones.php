<?php
require 'conexion.php';
$inspecciones = $mysqli->query("
    SELECT inspeccion.id_inspeccion, vehiculo.matricula, sede.localidad, inspeccion.fecha_inspeccion, inspeccion.hora_inspeccion, inspeccion.resultado
    FROM inspeccion
    JOIN vehiculo ON inspeccion.id_vehiculo = vehiculo.id_vehiculo
    JOIN sede ON inspeccion.id_sede = sede.id_sede
");
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Gestión de Inspecciones</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Inspecciones</h1>
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
                <?php while ($inspeccion = $inspecciones->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $inspeccion['id_inspeccion'] ?></td>
                        <td><?= $inspeccion['matricula'] ?></td>
                        <td><?= $inspeccion['localidad'] ?></td>
                        <td><?= $inspeccion['fecha_inspeccion'] ?></td>
                        <td><?= $inspeccion['hora_inspeccion'] ?></td>
                        <td><?= $inspeccion['resultado'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>