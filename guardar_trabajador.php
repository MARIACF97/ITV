<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Verificar que no hay campos vacíos
    if (empty($nombre) || empty($apellidos) || empty($dni) || empty($email) || empty($contraseña)) {
        die("Por favor, rellena todos los campos.");
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO trabajadores (nombre, apellidos, dni, email, contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    // Comprobar que la preparación es exitosa
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Asociar parámetros
    $stmt->bind_param("sssss", $nombre, $apellidos, $dni, $email, $contraseña);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: login_trabajador.php");
        exit();
    } else {
        // Mostrar error de ejecución
        echo "<div class='alert alert-danger'>Error al registrar el trabajador: " . $stmt->error . "</div>";
    }
   

}
