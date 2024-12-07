<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
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
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="vehiculo" class="form-control" required>
                    <?php
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
    </div>
</body>

</html>