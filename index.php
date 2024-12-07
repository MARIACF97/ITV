<?php
require 'conexion.php';

// Consulta para obtener todas las inspecciones
$resultado = $mysqli->query("SELECT inspeccion.id_inspeccion, vehiculo.matricula, vehiculo.modelo, sede.localidad, sede.provincia, inspeccion.fecha_inspeccion, inspeccion.hora_inspeccion, inspeccion.resultado, inspeccion.observaciones FROM inspeccion 
                             JOIN vehiculo ON inspeccion.id_vehiculo = vehiculo.id_vehiculo 
                             JOIN sede ON inspeccion.id_sede = sede.id_sede");
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
        <table id="tabla_inspecciones" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Inspección</th>
                    <th>Matrícula Vehículo</th>
                    <th>Modelo Vehículo</th>
                    <th>Localidad Sede</th>
                    <th>Provincia Sede</th>
                    <th>Fecha Inspección</th>
                    <th>Hora Inspección</th>
                    <th>Resultado</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($inspeccion = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $inspeccion['id_inspeccion'] ?></td>
                        <td><?= $inspeccion['matricula'] ?></td>
                        <td><?= $inspeccion['modelo'] ?></td>
                        <td><?= $inspeccion['localidad'] ?></td>
                        <td><?= $inspeccion['provincia'] ?></td>
                        <td><?= $inspeccion['fecha_inspeccion'] ?></td>
                        <td><?= $inspeccion['hora_inspeccion'] ?></td>
                        <td><?= $inspeccion['resultado'] ?></td>
                        <td><?= $inspeccion['observaciones'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $inspeccion['id_inspeccion'] ?>" class="btn btn-primary">Editar</a>
                            <a href="eliminar_inspeccion.php?id=<?= $inspeccion['id_inspeccion'] ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="registrar.php" class="btn btn-success">Registrar Nueva Inspección</a>
    </div>

    <!-- jQuery and DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla_inspecciones').DataTable();
        });
    </script>
</body>

</html>