<?php
require 'conexion.php';

// Consulta para obtener todos los vehículos
$vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo");

// Consulta para obtener todas las sedes
$sedes = $mysqli->query("SELECT id_sede, localidad, provincia, direccion FROM sede");

// Consulta para obtener todas las inspecciones
$inspecciones = $mysqli->query("
    SELECT inspeccion.id_inspeccion, vehiculo.matricula, sede.localidad, inspeccion.fecha_insp, inspeccion.hora_insp, inspeccion.resultado, inspeccion.observaciones
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
        <a href="index.php" class="btn btn-primary mb-3">Registrar Inspección</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula Vehículo</th>
                    <th>Localidad Sede</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Resultado</th>
                    <th>Observaciones</th>
                    <th colspan="2" style="text-align: center; vertical-align: bottom; height: 60px;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($inspeccion = $inspecciones->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$inspeccion['id_inspeccion']}</td>";
                    echo "<td>{$inspeccion['matricula']}</td>";
                    echo "<td>{$inspeccion['localidad']}</td>";
                    echo "<td>{$inspeccion['fecha_insp']}</td>";
                    echo "<td>{$inspeccion['hora_insp']}</td>";
                    echo "<td>{$inspeccion['resultado']}</td>";
                    echo "<td>{$inspeccion['observaciones']}</td>";
                ?>
                    <td><a href="editar_inspecciones.php?id=<?php echo $inspeccion['id_inspeccion']; ?>" class='btn btn-warning btn-sm'>Editar</a></td>
                    <td><a href="eliminar_inspeccion.php?id=<?php echo $inspeccion['id_inspeccion']; ?>" class='btn btn-danger btn-sm'>Eliminar</a></td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-link">Volver al inicio</a>
    </div>
</body>

</html>