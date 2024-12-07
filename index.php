<?php
require 'conexion.php';

// Consulta SQL para obtener todos los registros de la tabla inspección junto con sus datos de vehículo y sede
$sql = "SELECT inspeccion.id_inspeccion, vehiculo.matricula, sede.localidad, inspeccion.fecha_insp, inspeccion.hora_insp, inspeccion.resultado, inspeccion.observaciones
        FROM inspeccion
        JOIN vehiculo ON inspeccion.id_vehiculo = vehiculo.id_vehiculo
        JOIN sede ON inspeccion.id_sede = sede.id_sede
        ORDER BY inspeccion.id_inspeccion DESC"; // ordenamos por id_inspección en orden descendente

$resultado = $mysqli->query($sql);

if ($resultado->num_rows > 0) {
    // Hay registros para mostrar
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID Inspección</th>';
    echo '<th>Matrícula</th>';
    echo '<th>Localidad</th>';
    echo '<th>Fecha</th>';
    echo '<th>Hora</th>';
    echo '<th>Resultado</th>';
    echo '<th>Observaciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Iterar sobre los registros
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id_inspeccion'] . '</td>';
        echo '<td>' . $row['matricula'] . '</td>';
        echo '<td>' . $row['localidad'] . '</td>';
        echo '<td>' . $row['fecha_insp'] . '</td>';
        echo '<td>' . $row['hora_insp'] . '</td>';
        echo '<td>' . $row['resultado'] . '</td>';
        echo '<td>' . $row['observaciones'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    // No hay registros para mostrar
    echo '<p>No data available in table</p>';
}
