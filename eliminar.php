<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Eliminar Inspección</title>
</head>

<body>
    <div class="container">
        <?php
        // Verificar si el ID está en la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Validar que el ID sea numérico
            if (is_numeric($id)) {
                // Conexión a la base de datos
                require 'conexion.php';

                // Crear la consulta de eliminación
                $sql = "DELETE FROM inspección WHERE id = $id";

                // Ejecutar la consulta
                $resultado = $mysqli->query($sql);

                // Comprobar si se eliminó alguna fila
                if ($resultado) {
                    echo "<p class='alert alert-success'>La inspección con ID $id fue eliminada con éxito.</p>";
                } else {
                    echo "<p class='alert alert-warning'>No se encontró una inspección con el ID $id.</p>";
                }
            } else {
                echo "<p class='alert alert-danger'>El ID proporcionado no es válido.</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>No se proporcionó un ID.</p>";
        }

        // Botón para volver al inicio
        echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
        ?>
    </div>
</body>

</html>
