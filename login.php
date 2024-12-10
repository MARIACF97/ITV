<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario o trabajador y su contraseña hash
    $sql = "SELECT id_usuario, nombre, password FROM usuario WHERE email = '$email' 
            UNION
            SELECT id_trabajador, nombre, password FROM trabajador WHERE email = '$email'";

    // Si es igual a 1 significa que se ha encontrado un registro
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Iniciar sesión
            if (isset($user['id_usuario'])) {
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nombre_usuario'] = $user['nombre'];
                header("Location: registrar_vehiculo.php");
            } else {
                $_SESSION['id_trabajador'] = $user['id_trabajador'];
                $_SESSION['nombre_trabajador'] = $user['nombre'];
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Correo electrónico o contraseña incorrectos.";
        }
    } else {
        $error = "Correo electrónico o contraseña incorrectos.";
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Inicio de Sesión</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
