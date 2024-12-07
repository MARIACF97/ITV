<?php
require 'conexion.php';
$sedes = $mysqli->query("SELECT * FROM sede");
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Gestión de Sedes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Sedes</h1>
        <a href="registrar_sede.php" class="btn btn-primary mb-3">Registrar Sede</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($sede = $sedes->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $sede['id_sede'] ?></td>
                        <td><?= $sede['localidad'] ?></td>
                        <td><?= $sede['provincia'] ?></td>
                        <td><?= $sede['direccion'] ?></td>
                        <td>
                            <a href="editar_sede.php?id=<?= $sede['id_sede'] ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?= $sede['id_sede'] ?>&tabla=sede" class="btn btn-danger"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>