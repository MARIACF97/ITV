<?php
require 'conexion.php';

// Verificar si el ID del vehículo está en la URL
if (isset($_GET['id'])) {
    $id_vehiculo = $_GET['id'];

    // Consulta para obtener la información del vehículo
    $query = "SELECT * FROM vehiculo WHERE id_vehiculo = $id_vehiculo";
    $resultado = $mysqli->query($query);

    if ($resultado->num_rows > 0) {
        $vehiculo = $resultado->fetch_assoc();
    } else {
        // No se encontró el vehículo
        echo "<p class='alert alert-danger'>Vehículo no encontrado.</p>";
        exit();
    }
} else {
    echo "<p class='alert alert-danger'>No se proporcionó un ID válido para editar.</p>";
    exit();
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $_POST['matricula'];
    $modelo = $_POST['modelo'];
    $combustible = $_POST['combustible'];
    $año_fab = $_POST['año_fab'];

    // Validaciones aquí
    if (!empty($matricula) && !empty($modelo) && !empty($combustible) && !empty($año_fab)) {
        // Actualizar el vehículo en la base de datos
        $sql = "UPDATE vehiculo SET 
                    matricula = '$matricula',
                    modelo = '$modelo',
                    combustible = '$combustible',
                    año_fab = '$año_fab'
                WHERE id_vehiculo = $id_vehiculo";

        if ($mysqli->query($sql)) {
            echo "<p class='alert alert-success'>Vehículo actualizado correctamente.</p>";
        } else {
            echo "<p class='alert alert-danger'>Error al actualizar el vehículo.</p>";
        }
    } else {
        echo "<p class='alert alert-warning'>Por favor, complete todos los campos.</p>";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Vehículo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Editar Vehículo</h1>

    <form method="post">
        <div class="form-group">
            <label for="matricula">Matrícula</label>
            <input type="text" name="matricula" id="matricula" class="form-control" value="<?= $vehiculo['matricula'] ?>" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" value="<?= $vehiculo['modelo'] ?>" required>
        </div>
        <div class="form-group">
            <label for="combustible">Combustible</label>
            <select name="combustible" id="combustible" class="form-control" required>
                <option value="GASOLINA" <?= $vehiculo['combustible'] === 'GASOLINA' ? 'selected' : '' ?>>Gasolina</option>
                <option value="DIESEL" <?= $vehiculo['combustible'] === 'DIESEL' ? 'selected' : '' ?>>Diésel</option>
                <option value="ELECTRICO" <?= $vehiculo['combustible'] === 'ELECTRICO' ? 'selected' : '' ?>>Eléctrico</option>
                <option value="HIBRIDO" <?= $vehiculo['combustible'] === 'HIBRIDO' ? 'selected' : '' ?>>Híbrido</option>
                <option value="OTRO" <?= $vehiculo['combustible'] === 'OTRO' ? 'selected' : '' ?>>Otro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="año_fab">Año de Fabricación</label>
            <input type="number" name="año_fab" id="año_fab" class="form-control" value="<?= $vehiculo['año_fab'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar Vehículo</button>
    </form>

    <a href="index.php" class="btn btn-primary mt-3">Volver</a>
</div>
</body>
</html>
