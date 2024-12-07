<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Guardar Cambios de Vehículo</title>
</head>

<body>
    <div class="container">
        <?php
        require 'conexion.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $matricula = $_POST['matricula'];
            $modelo = $_POST['modelo'];
            $id_sede = $_POST['id_sede'];

            $sql = "UPDATE vehiculo SET matricula='$matricula', modelo='$modelo', id_sede='$id_sede' WHERE id_vehiculo=$id";

            $resultado = $mysqli->query($sql);

            if ($resultado) {
                echo "<p class='alert alert-success'>Vehículo modificado exitosamente</p>";
            } else {
                echo "<p class='alert alert-danger'>Error al modificar el vehículo</p>";
            }

            echo "<a href='index.php' class='btn btn-primary'>Regresar</a>";
        } else {
            echo "<p class='alert alert-danger'>Solicitud no válida</p>";
        }
        ?>
    </div>
</body>

</html>