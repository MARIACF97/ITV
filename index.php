<?php
session_start();
require 'conexion.php';

// Verificar que el trabajador ha iniciado sesión
if (!isset($_SESSION['id_trabajador'])) {
    header("Location: login_trabajador.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_inspeccion']) || empty($_POST['id_inspeccion'])) {
        die("<div class='alert alert-danger'>Error: ID de inspección no proporcionado.</div>");
    }

    $id_inspeccion = (int)$_POST['id_inspeccion'];
    $id_trabajador = $_SESSION['id_trabajador'];
    // Recoger y sanitizar los demás datos
    $id_vehiculo = mysqli_real_escape_string($mysqli, $_POST['id_vehiculo']);
    $id_sede = mysqli_real_escape_string($mysqli, $_POST['id_sede']);
    $fecha_insp = mysqli_real_escape_string($mysqli, $_POST['fecha_insp']);
    $hora_insp = mysqli_real_escape_string($mysqli, $_POST['hora_insp']);
    $resultado = mysqli_real_escape_string($mysqli, $_POST['resultado']);
    $observaciones = mysqli_real_escape_string($mysqli, $_POST['observaciones']);

    // Actualización de inspección
    $sql = "UPDATE inspeccion SET 
            id_vehiculo='$id_vehiculo', 
            id_sede='$id_sede', 
            fecha_insp='$fecha_insp', 
            hora_insp='$hora_insp', 
            resultado='$resultado', 
            observaciones='$observaciones' 
            WHERE id_inspeccion=$id_inspeccion";

    if ($mysqli->query($sql)) {
        echo "<div class='alert alert-success mt-3'>Inspección actualizada correctamente.</div>";
        header("Location: inspecciones.php");
        exit();
    } else {
        echo "<div class='alert alert-danger mt-3'>Error al actualizar la inspección: " . $mysqli->error . "</div>";
    }
}

    if (isset($_POST['id_inspeccion'])) {
        // Verificar si el ID de inspección existe
        $id_inspeccion = (int)$_POST['id'];
        $sql = "SELECT 1 FROM inspeccion WHERE id_inspeccion = $id_inspeccion";
        $result = $mysqli->query($sql);

        if ($result->num_rows === 0) {
            echo "<p class='alert alert-danger'>Error: El ID de inspección no existe.</p>";
            echo '<a href="index.php" class="btn btn-primary">Volver</a>';
        }
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Inspección Técnica de Vehículos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">ITV System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="registrar_vehiculo.php">Registrar Vehículo</a></li>
                    <li class="nav-item"><a class="nav-link" href="inspecciones.php">Inspecciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="reportes.php">Reportes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Registrar Inspección</h1>

        <!-- Formulario para registrar inspección -->
        <form method="post" class="shadow p-4 rounded bg-light">
            <div class="mb-3">
                <label for="vehiculo" class="form-label">Vehículo: </label>
                <select name="id_vehiculo" id="vehiculo" class="form-select" required>
                    <?php
                    $result = $mysqli->query("SELECT id_vehiculo, matricula, modelo, combustible, año_fab FROM vehiculo");
                    while ($vehiculo = $result->fetch_assoc()) {
                        echo "<option value='{$vehiculo['id_vehiculo']}'>{$vehiculo['matricula']} - {$vehiculo['modelo']} (Combustible: {$vehiculo['combustible']}, Año: {$vehiculo['año_fab']})</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="sede" class="form-label">Sede: </label>
                <select name="id_sede" id="sede" class="form-select" required>
                    <?php
                    $result = $mysqli->query("SELECT id_sede, localidad, provincia, direccion FROM sede");
                    while ($sede = $result->fetch_assoc()) {
                        echo "<option value='{$sede['id_sede']}'>{$sede['localidad']} - {$sede['provincia']} (Dirección: {$sede['direccion']})</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha: </label>
                <input type="date" name="fecha_insp" id="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora: </label>
                <input type="time" name="hora_insp" id="hora" class="form-control" required>
            </div>

            <input type="hidden" name="resultado" value="PENDIENTE">

            <div class="mb-3">
                <label class="form-label">Resultado: </label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="resultado" id="resultado_favorable" value="FAVORABLE" required>
                    <label class="form-check-label" for="resultado_favorable">Favorable</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="resultado" id="resultado_desfavorable" value="DESFAVORABLE" required>
                    <label class="form-check-label" for="resultado_desfavorable">Desfavorable</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <?php
        if (isset($_POST['id'])) {
            $id_inspeccion = (int)$_POST['id_inspeccion'];
            // Verificar si el ID de inspección existe
            $sql = "SELECT 1 FROM inspeccion WHERE id_inspeccion = $id_inspeccion";
            $result = $mysqli->query($sql);

            if ($result->num_rows === 0) {
                echo "<p class='alert alert-danger'>Error: El ID de inspección no existe.</p>";
                echo '<a href="index.php" class="btn btn-primary">Volver</a>';
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

    <!-- Footer -->
    <footer class="footer bg-primary text-white text-center py-3 mt-4">
        <p class="mb-0">&copy; 2024 ITV System. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
