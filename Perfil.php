<?php
// Zona horaria de santiago
date_default_timezone_set("America/Santiago");
//Conexion base de datos
include("Funciones/db.php");
//Validar inicio de sesion
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
$fecha2 = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="Css/Perfil.css" type="text/css" />
    <title>Perfil</title>
</head>

<body>
    <!-- barra de navegacion perfil -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li><a href="ModificarPerfil.php">Modificar Perfil</a></li>
            <li><a href="ModificarDescripcion.php">Modificar Descripcion</a></li>
            <li><a href="ModificarHoras.php">Modificar Horas</a></li>
            <li><a href="ModificarServicios.php">Modificar Servicios</a></li>
            <li><a href="subirimagen2.php">Subir Imagenes</a></li>
            <li><a href="RegistrarHoras.php">Registrar Horas por Fecha</a></li>
            <li><a href="RegistrarServicios.php">Registrar Servicios</a></li>
            <li><a href="Historial.php">Historial</a></li>
            <li><a href="Cerrar_session.php">Cerrar sesion</a></li>
        </ul>
    </nav>
    <?php
    //Consulta para obtener la fecha de las horas agendadas
    $sql2 = mysqli_query($conexion, "SELECT DISTINCT fecha FROM horas
    INNER JOIN agendamiento ON agendamiento.HORAS_idHORAS = horas.idHORAS
    WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha");

    $fecha1 = mysqli_query($conexion, "SELECT fecha FROM empresa WHERE idEmpresa = '$idEmpresa'");
    $resfecha = $fecha1->fetch_assoc();
    $sumfecha = date('Y-m-d', strtotime($resfecha['fecha'] . "+ 7 days"));

    if ($sumfecha <= $fecha2) {
        echo "<div class='alert alert-success'>Pagar suscripcion</div>";
    }
    ?>
    <!--<h1><?php //echo $resfecha['fecha'];
            ?></h1>
    <h1><?php //echo $sumfecha;
        ?></h1> -->

    <?php
    if ($_GET['success']) {
        if ($_GET['success'] == 'registrado') {
    ?>
            <small class="alert alert-success">Registrado correctamente!</small>
            <hr>
        <?php
        }
    }
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'error') {
        ?>
            <small class="alert alert-danger">Servicios no ingresados!</small>
            <hr>
    <?php
        }
    }
    ?>



    <div class="pago">
        <button type="button" class="btnpago" onclick="location.href='https://www.flow.cl/btn.php?token=i90ype2'">Suscripcion</button>
    </div>
    <div class="container">
        <?php
        $visitas = mysqli_query($conexion, "SELECT SUM(visitas) as sumaVisitas FROM visitas WHERE idEmpresa = '$idEmpresa'");
        $rowvisitas = mysqli_fetch_assoc($visitas);

        $valoracion = mysqli_query($conexion, "SELECT ROUND(AVG(valoracion),1) as promedio FROM valoracion WHERE idEmpresa = '$idEmpresa'");
        $rowvalo = mysqli_fetch_assoc($valoracion);

        $valoracionCount = mysqli_query($conexion, "SELECT COUNT(valoracion) as cantidad FROM valoracion WHERE idEmpresa = '$idEmpresa'");
        $rowCount = mysqli_fetch_assoc($valoracionCount);
        ?>

        <h1>Bienvenido: <a href="DetalleEmpresa2.php?nik=<?php echo $idEmpresa ?>" target="_blank"><?php echo utf8_encode($row['nombre_empresa']); ?></a></h1>
        <i class="fas fa-eye"><?php echo ' ' ?><?php echo $rowvisitas["sumaVisitas"]; ?></i>
        <p></p>
        <div class="calificaciones">
        <p>Calificacion General</p>
        <p><?php echo $rowvalo["promedio"] ?> / 5</p>
        <p><?php echo $rowCount["cantidad"] ?> Calificaciones </p>
        </div>
        <hr>
        <h1>Horas Agendadas</h1>
        <hr>
        <article class="table-responsive">
            <form name="BuscarFecha" action="Perfil.php" method="POST">
                Fecha:
                <select name="search">
                    <?php while ($row = $sql2->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['fecha']; ?>"><?php echo date('d-m-Y', strtotime($row['fecha'])); ?></option>
                    <?php } ?>
                </select>

                <input type="submit" name="buscar" class="btn btn-primary" value="Buscar Fecha">
                <input type=submit value="Reset" class="btn btn-warning" name="btnReset">
            </form>
            <br>
            <!-- tabla donde se muestran los datos de las horas agendadas -->
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
                // Consulta para obtener los datos de las horas agendadas
                $sql = mysqli_query($conexion, "SELECT * FROM agendamiento 
                INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

                if (isset($_POST['buscar'])) {
                    // Consulta para buscar por fecha
                    $buscarFecha = strval($_POST['search']);
                    $sql = mysqli_query($conexion, "SELECT * FROM agendamiento
                    RIGHT JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                    INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                    WHERE fecha = '$buscarFecha' AND agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");
                }
                if (mysqli_num_rows($sql) == 0) {
                    echo '<tr><td colspan="8">No hay datos.</td></tr>';
                } else {
                    // Recorrido para mostrar los datos
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '
						<tr>
                            <td>' . $row['idAGENDAMIENTO'] . '</td>
                            <td>' . $row['estado'] . '</td>
                            <td>' . $row['nomCLIENTE'] . ' ' . $row['apellCLIENTE'] . '</td>
                            <td>' . $row['numCLIENTE'] . '</td>
							<td>' . $row['nombre_servicio'] . '</td>
                            <td>' . date('H:s', strtotime($row['hora'])) . '</td>
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