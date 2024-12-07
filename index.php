<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <title>Gestión de Vehículos e Inspecciones</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabla-inspecciones').DataTable();
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Vehículos y Sedes</h1>
        </div>
        <br>
        <div class="row">
            <a href="registrar.php" class="btn btn-primary">Registrar Vehículo</a>
            <a href="sede.php" class="btn btn-primary">Gestionar Sedes</a>
        </div>
        <br>
        <br>
        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Sede</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'conexion.php';

                $sql = "SELECT vehiculo.matricula, vehiculo.modelo, sede.localidad, sede.provincia 
                        FROM vehiculo
                        JOIN sede ON vehiculo.id_sede = sede.id_sede";
                $resultado = $mysqli->query($sql);

                while($fila = $resultado->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>{$fila['matricula']}</td>";
                    echo "<td>{$fila['modelo']}</td>";
                    echo "<td>{$fila['localidad']}</td>";
                    echo "<td>{$fila['provincia']}</td>";
                ?>
                    <td><a href="editar.php?id=<?php echo $fila['id_vehiculo']; ?>" class="btn btn-warning">Editar</a></td>
                    <td><a href="eliminar.php?id=<?php echo $fila['id_vehiculo']; ?>" class="btn btn-danger">Eliminar</a></td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="row">
            <h1>Inspecciones Totales</h1>
        </div>
        <br>
        <table id="tabla-inspecciones" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Sede</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT inspeccion.id_inspeccion, vehiculo.matricula, vehiculo.modelo, sede.localidad, sede.provincia, 
                        inspeccion.fecha_inspeccion, inspeccion.hora_inspeccion, inspeccion.resultado 
                        FROM inspeccion
                        JOIN vehiculo ON inspeccion.id_vehiculo = vehiculo.id_vehiculo
                        JOIN sede ON inspeccion.id_sede = sede.id_sede";
                $resultado = $mysqli->query($sql);

                while($fila = $resultado->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>{$fila['matricula']} ({$fila['modelo']})</td>";
                    echo "<td>{$fila['localidad']}, {$fila['provincia']}</td>";
                    echo "<td>{$fila['fecha_inspeccion']}</td>";
                    echo "<td>{$fila['hora_inspeccion']}</td>";
                    echo "<td>{$fila['resultado']}</td>";
                ?>
                    <td><a href="editar2.php?id=<?php echo $fila['id_inspeccion']; ?>" class="btn btn-warning">Editar</a></td>
                    <td><a href="eliminar_inspeccion.php?id=<?php echo $fila['id_inspeccion']; ?>" class="btn btn-danger">Eliminar</a></td>
                <?php
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
