<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrar_vehiculo'])) {
        // Recoger datos para registrar un nuevo vehículo
        $matricula = $_POST['matricula'];
        $modelo = $_POST['modelo'];
        $combustible = $_POST['combustible'];
        $año_fab = $_POST['año_fab'];

        // Consulta para insertar el nuevo vehículo
        $sql = "INSERT INTO vehiculo (matricula, modelo, combustible, año_fab) VALUES ('$matricula', '$modelo', '$combustible', '$año_fab')";

        if ($mysqli->query($sql)) {
            echo "<p class='alert alert-success'>Vehículo registrado con éxito</p>";
        } else {
            echo "<p class='alert alert-danger'>Error: " . $mysqli->error . "</p>";
        }
    } elseif (isset($_POST['registrar_sede'])) {
        // Recoger datos para registrar una nueva sede
        $localidad = $_POST['localidad'];
        $provincia = $_POST['provincia'];
        $direccion = $_POST['direccion'];

        // Consulta para insertar la nueva sede
        $sql = "INSERT INTO sede (localidad, provincia, direccion) VALUES ('$localidad', '$provincia', '$direccion')";

        if ($mysqli->query($sql)) {
            echo "<p class='alert alert-success'>Sede registrada con éxito</p>";
        } else {
            echo "<p class='alert alert-danger'>Error: " . $mysqli->error . "</p>";
        }
    } else {
        // Recoger datos del formulario para registrar inspección
        $id_vehiculo = $_POST['id_vehiculo'];
        $id_sede = $_POST['id_sede'];
        $fecha_insp = $_POST['fecha_insp'];
        $hora_insp = $_POST['hora_insp'];
        $resultado = $_POST['resultado'];
        $observaciones = $_POST['observaciones'];

        // Verificar si el ID de vehículo existe
        $vehiculo_exists = $mysqli->query("SELECT 1 FROM vehiculo WHERE id_vehiculo = '$id_vehiculo'")->num_rows > 0;

        if (!$vehiculo_exists) {
            echo "<p class='alert alert-danger'>Error: El ID de vehículo no existe.</p>";
            echo '<a href="index.php" class="btn btn-primary">Volver</a>';
            exit;
        }

        // Verificar si el ID de sede existe
        $sede_exists = $mysqli->query("SELECT 1 FROM sede WHERE id_sede = '$id_sede'")->num_rows > 0;

        if (!$sede_exists) {
            echo "<p class='alert alert-danger'>Error: El ID de sede no existe.</p>";
            echo '<a href="index.php" class="btn btn-primary">Volver</a>';
            exit;
        }

        // Consulta para insertar la inspección
        $sql = "INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
                VALUES ('$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')";

        if ($mysqli->query($sql)) {
            echo "<p class='alert alert-success'>Inspección registrada con éxito</p>";
            echo '<a href="index.php" class="btn btn-primary">Volver</a>';
        } else {
            echo "<p class='alert alert-danger'>Error: " . $mysqli->error . "</p>";
        }
    }
} else {
    // Consulta para obtener todos los vehículos y sedes
    $vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo");
    $sedes = $mysqli->query("SELECT id_sede, localidad, provincia, direccion FROM sede");
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Registrar Inspección</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Inspección</h1>

        <!-- Formulario para registrar inspección -->
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora_insp" id="hora" class="form-control" required>
            </div>
            <input type="hidden" name="resultado" value="PENDIENTE">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <hr>

        <!-- Formulario para registrar nuevo vehículo -->
        <form action="index.php" method="post">
            <h2>Registrar Nuevo Vehículo</h2>
            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" id="matricula" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="combustible">Combustible</label>
                <input type="text" name="combustible" id="combustible" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="año_fab">Año de Fabricación</label>
                <input type="number" name="año_fab" id="año_fab" class="form-control" required>
            </div>
            <button type="submit" name="registrar_vehiculo" class="btn btn-primary">Registrar Vehículo</button>
        </form>

        <hr>

        <!-- Formulario para registrar nueva sede -->
        <form action="index.php" method="post">
            <h2>Registrar Nueva Sede</h2>
            <div class="form-group">
                <label for="localidad">Localidad</label>
                <input type="text" name="localidad" id="localidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" id="provincia" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
            <button type="submit" name="registrar_sede" class="btn btn-primary">Registrar Sede</button>
        </form>
    </div>
</body>

</html>