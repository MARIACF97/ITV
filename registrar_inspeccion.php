<?php
require 'conexion.php';

$vehiculos = $mysqli->query("SELECT id_vehiculo, matricula FROM vehiculo");
$sedes = $mysqli->query("SELECT id_sede, localidad FROM sede");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_vehiculo = $_POST['id_vehiculo'];
    $id_sede = $_POST['id_sede'];
    $fecha_insp = $_POST['fecha_insp'];
    $hora_insp = $_POST['hora_insp'];
    $resultado = $_POST['resultado'];
    $observaciones = $_POST['observaciones'];

    $mysqli->query("
        INSERT INTO inspeccion (id_vehiculo, id_sede, fecha_insp, hora_insp, resultado, observaciones)
        VALUES ('$id_vehiculo', '$id_sede', '$fecha_insp', '$hora_insp', '$resultado', '$observaciones')
    ");
    header("Location: inspecciones.php");
    exit();
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registrar Inspección</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Registrar Inspección</h1>
        <form method="post">
            <div class="form-group">
                <label for="id_vehiculo">Vehículo</label>
                <select name="id_vehiculo" id="id_vehiculo" class="form-control" required>
                    <?php while ($vehiculo = $vehiculos->fetch_assoc()) { ?>
                        <option value="<?= $vehiculo['id_vehiculo'] ?>"><?= $vehiculo['matricula'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_sede">Sede</label>
                <select name="id_sede" id="id_sede" class="form-control" required>
                    <?php while ($sede = $sedes->fetch_assoc()) { ?>
                        <option value="<?= $sede['id_sede'] ?>"><?= $sede['localidad'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_insp">Fecha</label>
                <input type="date" name="fecha_ins" id="fecha_insp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora_insp">Hora</label>
                <input type="time" name="hora_insp" id="hora_insp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="resultado">Resultado</label>
                <select name="resultado" id="resultado" class="form-control">
                    <option value="PENDIENTE">Pendiente</option>
                    <option value="FAVORABLE">Favorable</option>
                    <option value="DESFAVORABLE">Desfavorable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
    </div>
</body>

</html>