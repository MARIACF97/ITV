<!-- Registrar y guardar sede -->
<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $direccion = $_POST['direccion'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Actualización de sede existente
        $sql = "UPDATE sede SET localidad='$localidad', provincia='$provincia', direccion='$direccion' WHERE id_sede=$id";
    } else {
        // Inserción de nueva sede
        $sql = "INSERT INTO sede (localidad, provincia, direccion) VALUES ('$localidad', '$provincia', '$direccion')";
    }

    if ($mysqli->query($sql)) {
        echo "<p class='alert alert-success'>Sede registrada correctamente</p>";
        header("Location: sedes.php");
    } else {
        echo "<p class='alert alert-danger'>Error al registrar la sede</p>";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registrar Sede</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Registrar Sede</h1>
        <form method="post">
            <div class="form-group">
                <label for="localidad">Localidad: </label>
                <input type="text" name="localidad" id="localidad" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="provincia">Provincia: </label>
                <input type="text" name="provincia" id="provincia" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="direccion">Dirección: </label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
        </form>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Consulta para obtener la sede específica para actualización
            $result = $mysqli->query("SELECT localidad, provincia, direccion FROM sede WHERE id_sede=$id");

            if ($result->num_rows > 0) {
                $sede = $result->fetch_assoc();
                $localidad = $sede['localidad'];
                $provincia = $sede['provincia'];
                $direccion = $sede['direccion'];
        ?>
                <h2>Actualizar Sede</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="localidad">Localidad: </label>
                        <input type="text" name="localidad" id="localidad" class="form-control" value="<?= $localidad ?>" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="provincia">Provincia: </label>
                        <input type="text" name="provincia" id="provincia" class="form-control" value="<?= $provincia ?>" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="direccion">Dirección: </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="<?= $direccion ?>" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
        <?php
            } else {
                echo "<p class='alert alert-warning'>Sede no encontrada</p>";
            }
        }
        ?>
    </div>
</body>

</html>