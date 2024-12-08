<!-- Registrar y guardar inspección -->
<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario para registrar inspección
    $id_vehiculo = $_POST['id_vehiculo'];
    $id_sede = $_POST['id_sede'];
    $fecha_insp = $_POST['fecha_insp'];
    $hora_insp = $_POST['hora_insp'];
    $resultado = $_POST['resultado'];
    $observaciones = $_POST['observaciones'];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Actualización de inspección existente
        $sql = "UPDATE inspeccion SET id_vehiculo='$id_vehiculo', id_sede='$id_sede', fecha_insp='$fecha_insp', hora_insp='$hora_insp', resultado='$resultado', observaciones='$observaciones' WHERE id_inspeccion=$id";
    } else {
        // Consulta para insertar la inspección
        $sql = "INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
                VALUES ('$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')";
    }
    if ($mysqli->query($sql)) {
        echo "<p class='alert alert-success'>Inspección registrada correctamente</p>";
        header("Location: inspecciones.php");
    } else {
        echo "<p class='alert alert-danger'>Error al registrar la inspección</p>";
    }
    // Verificar si el ID de inspección existe
    $inspeccion_exists = $mysqli->query("SELECT 1 FROM inspeccion WHERE id_inspeccion = '$id_inspeccion'")->num_rows > 0;

    if (!$inspeccion_exists) {
        echo "<p class='alert alert-danger'>Error: El ID de inspección no existe.</p>";
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
    <title>Registrar Inspección</title>
</head>

<body>
    <div class="container">
        <h1>Registrar Inspección</h1>

        <!-- Formulario para registrar inspección -->
        <form method="post">
            <div class="form-group">
                <label for="vehiculo">Vehículo: </label>
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
            <br>
            <div class="form-group">
                <label for="sede">Sede: </label>
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
            <br>
            <div class="form-group">
                <label for="fecha">Fecha: </label>
                <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="hora">Hora: </label>
                <input type="time" name="hora_insp" id="hora" class="form-control" required>
            </div>
            <br>
            <input type="hidden" name="resultado" value="PENDIENTE">
            <div class="form-group">
                <label for="observaciones">Observaciones: </label>
                <br>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
        </form>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Consulta para obtener la inspección específica para la actualización
            $result = $mysqli->query("SELECT id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones FROM inspeccion WHERE id_inspeccion=$id");

            if ($result->num_rows > 0) {
                $inspeccion = $result->fetch_assoc();
                $id_vehiculo = $inspeccion['id_vehiculo'];
                $id_sede = $inspeccion['id_sede'];
                $fecha_insp = $inspeccion['fecha_insp'];
                $hora_insp = $inspeccion['hora_insp'];
                $resultado = $inspeccion['resultado'];
                $observaciones = $inspeccion['observaciones'];
        ?>
                <h2>Actualizar Inspección</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="vehiculo">Vehículo: </label>
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
                        <label for="sede">Sede: </label>
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
                        <label for="fecha">Fecha: </label>
                        <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="hora">Hora: </label>
                        <input type="time" name="hora_insp" id="hora" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Resultado: </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="resultado" id="resultado_favorable" value="FAVORABLE" required>
                            <label class="form-check-label" for="resultado_favorable">Favorable</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="resultado" id="resultado_desfavorable" value="DESFAVORABLE" required>
                            <label class="form-check-label" for="resultado_desfavorable">Desfavorable</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="observaciones">Observaciones: </label>
                        <br>
                        <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
        <?php
            } else {
                echo "<p class='alert alert-warning'>Inspección no encontrada</p>";
            }
        }
        ?>

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