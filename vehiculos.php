<?php
require 'conexion.php';
$vehiculos = $mysqli->query("SELECT * FROM vehiculo");
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Gestión de Vehículos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Vehículos</h1>
        <a href="registrar_vehiculo.php" class="btn btn-primary">Registrar Vehículo</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Combustible</th>
                    <th>Año de Fabricación</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($vehiculo = $vehiculos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$vehiculo['id_vehiculo']}</td>";
                    echo "<td>{$vehiculo['matricula']}</td>";
                    echo "<td>{$vehiculo['modelo']}</td>";
                    echo "<td>{$vehiculo['combustible']}</td>";
                    echo "<td>{$vehiculo['año_fab']}</td>";
                ?>
                    <td><a href="editar_vehiculo.php?id=<?php echo $vehiculo['id_vehiculo']; ?>" class="btn btn-warning">Editar</a></td>
                    <td><a href="eliminar_vehiculo.php?id=<?php echo $vehiculo['id_vehiculo']; ?>" class="btn btn-danger">Eliminar</a></td>
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