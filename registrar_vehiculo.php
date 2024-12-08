<!-- Registrar y guardar vehículo -->
<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $combustible = $_POST['combustible'];
    $año_fab = $_POST['año_fab'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Actualización de vehículo existente
        $sql = "UPDATE vehiculo SET matricula='$matricula', modelo='$modelo', combustible='$combustible', año_fab='$año_fab' WHERE id_vehiculo=$id";
    } else {
        // Consulta para insertar el nuevo vehículo
        $sql = "INSERT INTO vehiculo (matricula, modelo, combustible, año_fab)
            VALUES ('$matricula', '$modelo', '$combustible', '$año_fab')";
    }

    if ($mysqli->query($sql)) {
        echo "<p class='alert alert-success'>Vehículo registrado correctamente</p>";
        header("Location: vehiculos.php");
    } else {
        echo "<p class='alert alert-danger'>Error al registrar el vehículo</p>";
    }

    // Verificar si el ID de vehículo existe
    $vehiculo_exists = $mysqli->query("SELECT 1 FROM vehiculo WHERE id_vehiculo = '$id_vehiculo'")->num_rows > 0;

    if (!$vehiculo_exists) {
        echo "<p class='alert alert-danger'>Error: El ID de vehículo no existe.</p>";
        echo '<a href="index.php" class="btn btn-primary">Volver</a>';
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Vehículo</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Vehículo</h1>
        <form method="post">
            <div class="form-group">
                <label for="matricula">Matrícula: </label>
                <input type="text" name="matricula" id="matricula" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="modelo">Modelo: </label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="combustible">Combustible: </label>
                <select name="combustible" id="combustible" class="form-control" required>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diésel">Diésel</option>
                    <option value="Eléctrico">Eléctrico</option>
                    <option value="Híbrido">Híbrido</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="año_fab">Año de fabricación: </label>
                <input type="number" name="año_fab" id="año_fab" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
        </form>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Consulta para obtener el vehículo específico para la actualización
            $result = $mysqli->query("SELECT matricula, modelo, combustible, año_fab FROM vehiculo WHERE id_vehiculo=$id");

            if ($result->num_rows > 0) {
                $vehiculo = $result->fetch_assoc();
                $matricula = $vehiculo['matricula'];
                $provincia = $vehiculo['modelo'];
                $combustible = $vehiculo['combustible'];
                $año_fab = $vehiculo['año_fab'];
        ?>
                <h2>Actualizar Vehículo</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="matricula">Matrícula: </label>
                        <input type="text" name="matricula" id="matricula" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="modelo">Modelo: </label>
                        <input type="text" name="modelo" id="modelo" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="combustible">Combustible: </label>
                        <select name="combustible" id="combustible" class="form-control" required>
                            <option value="Gasolina">Gasolina</option>
                            <option value="Diésel">Diésel</option>
                            <option value="Eléctrico">Eléctrico</option>
                            <option value="Híbrido">Híbrido</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="año_fab">Año de fabricación: </label>
                        <input type="number" name="año_fab" id="año_fab" class="form-control" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
        <?php
            } else {
                echo "<p class='alert alert-warning'>Vehículo no encontrado</p>";
            }
        }
        ?>
    </div>
</body>

</html>