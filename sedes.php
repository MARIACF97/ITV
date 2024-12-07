<?php
require 'conexion.php';

$sql = "SELECT id_sede, localidad, provincia, direccion FROM sede";
$resultado = $mysqli->query($sql);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Gestionar Sedes</title>
</head>

<body>
    <div class="container">
        <h1>Sedes</h1>
        <a href="registrar_sede.php" class="btn btn-primary">Registrar Sede</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th>Dirección</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$fila['id_sede']}</td>";
                    echo "<td>{$fila['localidad']}</td>";
                    echo "<td>{$fila['provincia']}</td>";
                    echo "<td>{$fila['direccion']}</td>";
                ?>
                    <td><a href="editar_sede.php?id=<?php echo $fila['id_sede']; ?>" class="btn btn-warning">Editar</a></td>
                    <td><a href="eliminar_sede.php?id=<?php echo $fila['id_sede']; ?>" class="btn btn-danger">Eliminar</a></td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>