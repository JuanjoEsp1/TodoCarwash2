<?php
// Zona horaria de Santiago de chile
date_default_timezone_set("America/Santiago");
// Conexion base de datos
include("Funciones/db.php");
//Validador de inicio de sesion
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Historial</title>
</head>

<body>
    <?php
	// Consulta para obtener fecha de las horas agendadas
    $sql2 = mysqli_query($conexion, "SELECT DISTINCT fecha FROM horas
            INNER JOIN agendamiento ON agendamiento.HORAS_idHORAS = horas.idHORAS
            WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha < (Now() - INTERVAL 1 DAY) ORDER BY fecha");

    ?>



    <div class="container">
        <h1>Historial de Agenda</h1>
        <hr>
        <article class="table-responsive">
		<!--Buscador por fecha -->
            <form name="BuscarFecha" action="Historial.php" method="POST">
                Fecha:
                <select name="search">
                    <?php while ($row = $sql2->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['fecha']; ?>"><?php echo date('d-m-Y', strtotime($row['fecha'])); ?></option>
                    <?php } ?>
                </select>

                <input type="submit" name="buscar" class="btn btn-success" value="Buscar Fecha">
                <input type=submit value="Reset" class="btn btn-warning" name="btnReset">
                <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>
            </form>
            
            <br><br>
		<!--Tabla con resultados de las horas agendadas -->
            <table class="table table-striped table-hover" aria-describedby="Agenda">
                <tr>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo cliente</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
                <?php
		// Consulta para obtener datos de las horas agendadas
                $sql = mysqli_query($conexion, "SELECT * FROM agendamiento 
                INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                WHERE agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha < (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

                if (isset($_POST['buscar'])) {
		// Consulta para obtener las horas agendadas segun fecha seleccionada
                    $buscarFecha = strval($_POST['search']);
                    $sql = mysqli_query($conexion, "SELECT * FROM agendamiento
                    RIGHT JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
                    INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
                    WHERE fecha = '$buscarFecha' AND agendamiento.EMPRESA_idEmpresa = '$idEmpresa' AND fecha < (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");
                }
                if (mysqli_num_rows($sql) == 0) {
                    echo '<tr><td colspan="8">No hay datos.</td></tr>';
                } else {
			//Condicion para mostrar los datos de las horas agendadas
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo '
						<tr>
                            <td>' . $row['nomCLIENTE'] . ' ' . $row['apellCLIENTE'] . '</td>
                            <td>' . $row['numCLIENTE'] . '</td>
                            <td>' . $row['emailCLIENTE'] . '</td>
							<td>' . $row['nombre_servicio'] . '</td>
                            <td>' . '$'.$row['precio_servicio'] . '</td>
                            <td>' . date('d-m-Y', strtotime($row['fecha'])) . '</td>
                            <td>' . date('H:s', strtotime($row['hora'])) . '</td>	
						</tr>
						';
                    }
                }
                ?>
            </table>
        </article>


    </div>
</body>

</html>
