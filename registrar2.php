<!-- registrar2.php -->

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
        <form action="guardar_inspeccion.php" method="post">
            <div class="form-group">
                <label for="id_vehiculo">Vehículo</label>
                <input type="text" name="id_vehiculo" id="id_vehiculo" class="form-control" placeholder="ID del vehículo" required>
            </div>
            <div class="form-group">
                <label for="id_sede">Sede</label>
                <input type="text" name="id_sede" id="id_sede" class="form-control" placeholder="ID de la sede" required>
            </div>
            <div class="form-group">
                <label for="fecha_insp">Fecha</label>
                <input type="date" name="fecha_insp" id="fecha_insp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora_insp">Hora</label>
                <input type="time" name="hora_insp" id="hora_insp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="resultado">Resultado</label>
                <select name="resultado" id="resultado" class="form-control" required>
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="FAVORABLE">FAVORABLE</option>
                    <option value="DESFAVORABLE">DESFAVORABLE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>