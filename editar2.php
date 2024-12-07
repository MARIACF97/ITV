<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <title>Editar Inspección</title>
</head>
<body>
    <?php
        // Verificar si el ID está en la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener los datos actuales de la inspección a editar
            require 'conexion.php';
            $query = "SELECT * FROM inspeccion WHERE id_inspeccion = $id";
            $resultado = $mysqli->query($query);

            if ($resultado->num_rows > 0) {
                $inspeccion = $resultado->fetch_assoc();
            } else {
                echo "<p class='alert alert-danger'>Inspección no encontrada.</p>";
                exit();
            }
        } else {
            echo "<p class='alert alert-danger'>No se proporcionó un ID válido para editar.</p>";
            exit();
        }

        // Procesar el formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_vehiculo = $_POST['id_vehiculo'];
            $id_sede = $_POST['id_sede'];
            $fecha_inspeccion = $_POST['fecha_inspeccion'];
            $hora_inspeccion = $_POST['hora_inspeccion'];
            $resultado = $_POST['resultado'];
            $observaciones = $_POST['observaciones'];

            if (!empty($id_vehiculo) && !empty($id_sede) && !empty($fecha_inspeccion) && !empty($hora_inspeccion)) {
                // Actualizar la inspección en la base de datos
                $sql = "UPDATE inspeccion SET 
                            id_vehiculo = '$id_vehiculo',
                            id_sede = '$id_sede',
                            fecha_inspeccion = '$fecha_inspeccion',
                            hora_inspeccion = '$hora_inspeccion',
                            resultado = '$resultado',
                            observaciones = '$observaciones'
                        WHERE id_inspeccion = $id";

                if ($mysqli->query($sql)) {
                    echo "<p class='alert alert-success'>Inspección actualizada correctamente.</p>";
                } else {
                    echo "<p class='alert alert-danger'>Error al actualizar la inspección.</p>";
                }
            } else {
                echo "<p class='alert alert-warning'>Por favor, complete todos los campos.</p>";
            }
        }
    ?>

    <div class="container">
        <h1>Editar Inspección</h1>

        <form method="post">
            <div class="form-group">
                <label for="id_vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="id_vehiculo" class="form-control" required>
                    <?php
                    // Obtener los vehículos disponibles
                    require 'conexion.php';
                    $vehiculos = $mysqli->query("SELECT id_vehiculo, matricula FROM vehiculo");
                    while ($vehiculo = $vehiculos->fetch_assoc()) {
                        $selected = $vehiculo['id_vehiculo'] == $inspeccion['id_vehiculo'] ? 'selected' : '';
                        echo "<option value='{$vehiculo['id_vehiculo']}' $selected>{$vehiculo['matricula']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_sede">Sede</label>
                <select name="id_sede" id="id_sede" class="form-control" required>
                    <?php
                    // Obtener las sedes disponibles
                    $sedes = $mysqli->query("SELECT id_sede, localidad FROM sede");
                    while ($sede = $sedes->fetch_assoc()) {
                        $selected = $sede['id_sede'] == $inspeccion['id_sede'] ? 'selected' : '';
                        echo "<option value='{$sede['id_sede']}' $selected>{$sede['localidad']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_inspeccion">Fecha</label>
                <input type="date" name="fecha_inspeccion" id="fecha_inspeccion" class="form-control" value="<?= $inspeccion['fecha_inspeccion'] ?>" required>
            </div>
            <div class="form-group">
                <label for="hora_inspeccion">Hora</label>
                <input type="time" name="hora_inspeccion" id="hora_inspeccion" class="form-control" value="<?= $inspeccion['hora_inspeccion'] ?>" required>
            </div>
            <div class="form-group">
                <label for="resultado">Resultado</label>
                <select name="resultado" id="resultado" class="form-control">
                    <option value="PENDIENTE" <?= $inspeccion['resultado'] == 'PENDIENTE' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="FAVORABLE" <?= $inspeccion['resultado'] == 'FAVORABLE' ? 'selected' : '' ?>>Favorable</option>
                    <option value="DESFAVORABLE" <?= $inspeccion['resultado'] == 'DESFAVORABLE' ? 'selected' : '' ?>>Desfavorable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"><?= $inspeccion['observaciones'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Actualizar Inspección</button>
        </form>

        <a href="inspecciones.php" class="btn btn-primary mt-3">Volver</a>
    </div>
</body>
</html>
