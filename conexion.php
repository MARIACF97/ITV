<?php
// Conexión con MySQL
$mysqli = new mysqli("localhost", "root", "", "itv");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
?>
