<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Editar Vehículo</title>
</head>

<body>
    <div class="container">
        <h1>Editar Vehículo</h1>
        <?php
        require 'conexion.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = $id";
            $resultado = $mysqli->query($sql);
            $vehiculo = $resultado->fetch_assoc();

            if ($vehiculo) {
        ?>
                <form method="post" action="editar2.php">
                    <input type="hidden" name="id" value="<?= $vehiculo['id_vehiculo'] ?>">
                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        <input type="text" name="matricula" id="matricula" class="form-control" value="<?= $vehiculo['matricula'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control" value="<?= $vehiculo['modelo'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_sede">Sede</label>
                        <select name="id_sede" id="id_sede" class="form-control" required>
                            <?php
                            $sedes = $mysqli->query("SELECT id_sede, localidad FROM sede");
                            while ($sede = $sedes->fetch_assoc()) {
                                $selected = ($sede['id_sede'] == $vehiculo['id_sede']) ? 'selected' : '';
                                echo "<option value='{$sede['id_sede']}' $selected>{$sede['localidad']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </form>
        <?php
            } else {
                echo "<p class='alert alert-danger'>Vehículo no encontrado</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>ID de vehículo no especificado</p>";
        }
        ?>
    </div>
</body>

</html>