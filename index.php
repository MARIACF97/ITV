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
                <label for="vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="vehiculo" class="form-control" required>
                    <?php
                    // Consulta para obtener todos los vehículos
                    $vehiculos = $mysqli->query("SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo");


                    while ($vehiculo = $vehiculos->fetch_assoc()) {
                        echo "<option value='{$vehiculo['id_vehiculo']}'>
                                {$vehiculo['matricula']} - {$vehiculo['modelo']}
                                (Combustible: {$vehiculo['combustible']}, Año: {$vehiculo['año_fab']})
                              </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sede">Sede</label>
                <select name="id_sede" id="sede" class="form-control" required>
                    <?php
                    // Consulta para obtener todas las sedes
                    $sedes = $mysqli->query("SELECT id_sede, localidad, provincia, direccion FROM sede");


                    while ($sede = $sedes->fetch_assoc()) {
                        echo "<option value='{$sede['id_sede']}'>
                                {$sede['localidad']} - {$sede['provincia']}
                                (Dirección: {$sede['direccion']})
                              </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora_insp" id="hora" class="form-control" required>
            </div>
            <br>
            <input type="hidden" name="resultado" value="PENDIENTE">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <br>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
        </form>

        <hr>
        <br>
        <!-- Formulario para registrar nuevo vehículo -->
        <a href="registrar_vehiculo.php" class="btn btn-link">Registrar nuevo vehículo</a>
        <br><br>
        <!-- Formulario para registrar nueva sede -->
        <a href="registrar_sede.php" class="btn btn-link">Registrar nueva sede</a>
        
    </div>
</body>

</html>