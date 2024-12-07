<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>ITV</title>
</head>

<body>
    <?php
    $id = $_GET['id'];

    //Establezco conexión
    require 'conexion.php';

    //Preparo la sentencia SQL
    $sql = "DELETE FROM inspecciones WHERE id=$id";

    //Ejecutamos sentencia y guardamos resultado
    $resultado = $mysqli->query($sql);

    if ($resultado > 0) {
        echo "<p class='alert alert-success'>Inspección eliminada con éxito.</p>";
    } else {
        echo "<p class='alert alert-danger'>Error al eliminar inspección.</p>";
    }
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    ?>

</body>

</html>