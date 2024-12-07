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
        <a href="registrar_vehiculo.php" class="btn btn-primary mb-3">Registrar Vehículo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Combustible</th>
                    <th>Año de Fabricación</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($vehiculo = $vehiculos->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $vehiculo['id_vehiculo'] ?></td>
                        <td><?= $vehiculo['matricula'] ?></td>
                        <td><?= $vehiculo['modelo'] ?></td>
                        <td><?= $vehiculo['combustible'] ?></td>
                        <td><?= $vehiculo['año_fab'] ?></td>
                        <td>
                            <a href="editar_vehiculo.php?id=<?= $vehiculo['id_vehiculo'] ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar_vehiculo.php?id=<?= $vehiculo['id_vehiculo'] ?>&tabla=vehiculo" class="btn btn-danger"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>