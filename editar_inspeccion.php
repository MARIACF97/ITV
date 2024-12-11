<?php
require 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $id_inspeccion = $_POST['id_inspeccion'];
    $id_vehiculo = $_POST['id_vehiculo'];
    $id_sede = $_POST['id_sede'];
    $fecha_insp = $_POST['fecha_insp'];
    $hora_insp = $_POST['hora_insp'];
    $resultado = $_POST['resultado'];
    $observaciones = $_POST['observaciones'];
    $id_trabajador = $_POST['id_trabajador'];

    // Consulta para actualizar la inspección
    $sql = "UPDATE inspeccion SET id_vehiculo = '$id_vehiculo', id_sede = '$id_sede', fecha_insp = '$fecha_insp', hora_insp = '$hora_insp', resultado = '$resultado', observaciones = '$observaciones', id_trabajador = '$observaciones'  WHERE id_inspeccion = $id_inspeccion";

    if ($mysqli->query($sql)) {
        echo "<p class='alert alert-success'>Inspección actualizada con éxito</p>";
        echo '<a href="index.php" class="btn btn-primary">Volver</a>';
    } else {
        echo "<p class='alert alert-danger'>Error: " . $mysqli->error . "</p>";
    }
} else {
    // Obtener el ID de la inspección desde la URL
    $id_inspeccion = $_GET['id_inspeccion'];

    // Consulta para obtener los datos de la inspección
    $result = $mysqli->query("SELECT * FROM inspeccion WHERE id_inspeccion = $id_inspeccion");
    $inspeccion = $result->fetch_assoc();

    // Consulta para obtener todos los vehículos y sedes para los select del formulario
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
    <title>Editar Inspección</title>
</head>

<body>
    <div class="container">
        <h1>Editar Inspección</h1>
        <form action="editar_inspeccion.php" method="post">
            <input type="hidden" name="id_inspeccion" value="<?php echo $inspeccion['id_inspeccion']; ?>">

            <div class="form-group">
                <label for="vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="vehiculo" class="form-control" required>
                    <?php
                    $vehiculos->data_seek(0);  // Resetea el puntero a la primera fila
                    $vehiculo = $vehiculos->fetch_assoc();  // Extrae una sola fila
                    echo "<option value='{$vehiculo['id_vehiculo']}' selected>{$vehiculo['matricula']} - {$vehiculo['modelo']} (Combustible: {$vehiculo['combustible']}, Año: {$vehiculo['año_fab']})</option>";
                    ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="sede">Sede</label>
                <select name="id_sede" id="sede" class="form-control" required>
                    <?php
                    $sedes->data_seek(0);  // Resetea el puntero a la primera fila
                    $sede = $sedes->fetch_assoc();  // Extrae una sola fila
                    echo "<option value='{$sede['id_sede']}' selected>{$sede['localidad']} - {$sede['provincia']} (Dirección: {$sede['direccion']})</option>";
                    ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha_insp" id="fecha" class="form-control" value="<?php echo $inspeccion['fecha_insp']; ?>" required>
            </div>
            <br>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora_insp" id="hora" class="form-control" value="<?php echo $inspeccion['hora_insp']; ?>" required>
            </div>
            <br>
            <input type="hidden" name="resultado" value="<?php echo $inspeccion['resultado']; ?>">

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control" required><?php echo $inspeccion['observaciones']; ?></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</body>

</html>