<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $password = $_POST['contraseña'];

    // Consulta para verificar trabajador
    $sql = "SELECT id_trabajador, nombre, apellidos, dni, email, contraseña FROM trabajadores WHERE dni = '$dni'";
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $trabajador = $result->fetch_assoc();
        if ($trabajador['contraseña'] === $password) {
            $_SESSION['id_trabajador'] = $trabajador['id_trabajador'];
            $_SESSION['nombre'] = $trabajador['nombre'];
            $_SESSION['apellidos'] = $trabajador['apellidos'];
            header("Location: index.php");
            exit();
        } else {
            $error = "DNI o contraseña incorrectos.";
        }
    } else {
        $error = "DNI o contraseña incorrectos.";
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Trabajador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Login Trabajador</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="post" class="shadow p-4 rounded bg-light">
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" name="contraseña" id="contraseña" class="form-control" required>
            </div>
            <li class="nav-item"><a class="nav-link" href="registrar_trabajador.php">Registrar Trabajador</a></li>

            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
</body>

</html>