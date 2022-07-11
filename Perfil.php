<?php
date_default_timezone_set("America/Santiago");
include("Funciones/db.php");
session_start();
error_reporting(0);
$varsesion = $_SESSION['correo_empresa'];

if ($varsesion == null || $varsesion = '') {
    echo 'Usted no tiene autorizacion';
    die();
}

$correo = $_SESSION['correo_empresa'];
$idEmpresa = $_SESSION['idEmpresa'];

$sql = "SELECT * From empresa WHERE correo_empresa = '$correo'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

$idEmpresa = $row['idEmpresa'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Perfil.css" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Perfil</title>
</head>

<body>
    <nav>
        <ul class="ul-1">

            <li><a class="a-2" href="ModificarPerfil.php">Modificar datos del Perfil</a></li>
            <li><a class="a-5" href="ModificarDescripcion.php">Modificar Descripcion</a></li>
            <li><a class="a-3" href="ModificarHoras.php">Modificar Horas</a></li>
            <li><a class="a-4" href="ModificarServicios.php">Modificar Servicios</a></li>
            <li><a class="a-8" href="SubirImagen.php">Subir Imagenes</a></li>
            <li><a class="a-6" href="RegistrarHoras.php">Registrar Horas por Fecha</a></li>
            <li><a class="a-7" href="RegistrarServicios.php">Registrar Servicios</a></li>
            <li><a class="a-7" href="Historial.php">Historial</a></li>
            <li><a class="a-1" href="Cerrar_session.php">Cerrar sesion</a></li>
        </ul>
    </nav>
    <?php

    $sql2 = mysqli_query($conexion, "SELECT DISTINCT fecha FROM horas
    INNER JOIN agendamiento ON agendamiento.HORAS_idHORAS = horas.idHORAS
    WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha");

    ?>

    <div class="container">

        <h1>Bienvenido: <?php echo utf8_encode($row['nombre_empresa']); ?></h1>
        <hr>
        <h1>Horas Agendadas</h1>
        <hr>
        <article class="table-responsive">
            <form name="BuscarFecha" action="Perfil.php" method="POST">
                Fecha:
                <select name="search">
                    <?php while ($row = $sql2->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['fecha']; ?>"><?php echo $row['fecha']; ?></option>
                    <?php } ?>
                </select>

                <input type="submit" name="buscar" class="btn btn-primary" value="Buscar Fecha">
                <input type=submit value="Reset" class="btn btn-warning" name="btnReset">
            </form>
            <br>
            <table class="table table-striped table-hover" aria-describedby="Agenda">
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Id Servicio</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Accion</th>
                </tr>
                <?php

                $sql = mysqli_query($conexion, "SELECT * FROM agendamiento 
                INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

                if (isset($_POST['buscar'])) {

                    $buscarFecha = strval($_POST['search']);
                    $sql = mysqli_query($conexion, "SELECT * FROM agendamiento
                    RIGHT JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                    INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                    WHERE fecha = '$buscarFecha' AND agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");
                }
                if (mysqli_num_rows($sql) == 0) {
                    echo '<tr><td colspan="8">No hay datos.</td></tr>';
                } else {
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '
						<tr>
                            <td>' . $row['idAGENDAMIENTO'] . '</td>
                            <td>' . $row['estado'] . '</td>
                            <td>' . $row['nomCLIENTE'] . ' ' . $row['apellCLIENTE'] . '</td>
                            <td>' . $row['numCLIENTE'] . '</td>
							<td>' . $row['nombre_servicio'] . '</td>
                            <td>' . $row['hora'] . '</td>
                            <td>' . date('d-m-Y', strtotime($row['fecha'])) . '</td>
                            <td>';

                        if ($row['estado'] == "activa")
                            echo
                            '<a href="Cancelar.php?id=' . $row['idAGENDAMIENTO'] . '" title="Cancelar" onclick="return confirm(\'Esta seguro de cancelar la hora agenda ' . date('d-m-Y', strtotime($row['fecha'])) . ' a las ' . $row['hora'] . '?\')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
                        '</td>			
						</tr>
						';
                    }
                }
                ?>
            </table>
        </article>
        <div>
            <hr>

        </div>
    </div>

    </div>
</body>

</html>