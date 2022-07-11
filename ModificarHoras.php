<?php include("Funciones/db.php");
session_start();
error_reporting(0);
$varsesion = $_SESSION['correo_empresa'];

if ($varsesion == null || $varsesion = '') {
    echo 'Usted no tiene autorizacion';
    die();
}
$correo = $_SESSION['correo_empresa'];


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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Modificar Horas y Servicios</title>
</head>

<body>

    <?php

    $sql2 = mysqli_query($conexion, "SELECT DISTINCT fecha FROM horas WHERE EMPRESA_idEmpresa ='$idEmpresa' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");
    $resultado2 = ($sql2);

    ?>
    <div align="center">
        <hr>
        <h3>Actualizacion de Horas y Servicios</h3>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-3">


                <article class="table-responsive">

                    <form name="BuscarFecha" action="ModificarHoras.php" method="POST">
                        Fecha:
                        <select name="search">
                            <?php while ($row = $resultado2->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['fecha']; ?>"><?php echo $row['fecha']; ?></option>
                            <?php } ?>
                        </select>

                        <input type="submit" name="buscar" class="btn btn-primary" value="Buscar Fecha">
                        <input type=submit value="Reset" class="btn btn-warning" name="btnReset">
                    </form>
                    <br>
                    <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>
                    <br>
                    <br>           
                    <table class="table table-striped table-hover" aria-describedby="Horas">
                        <tr>
                            <th>ID</th>
                            <th>DISPONIBLE</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>ANULAR</th>
                        </tr>
                        <?php
                        $FechaActual = date('d-m-Y');
                        $sql = mysqli_query($conexion, "SELECT * FROM horas WHERE EMPRESA_idEmpresa ='$idEmpresa' AND disponible = 'si' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora ");

                        if (isset($_POST['buscar'])) {

                            $buscarFecha = strval($_POST['search']);
                            $sql = mysqli_query($conexion, "SELECT * FROM horas WHERE fecha = '$buscarFecha' AND EMPRESA_idEmpresa ='$idEmpresa' AND disponible = 'si' ORDER BY fecha, hora ");
                        }
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        } else {
                            while ($row = mysqli_fetch_assoc($sql)) {

                                echo '
						<tr>
                            <td>' . $row['idHORAS'] . '</td>
                            <td>' . $row['disponible'] . '</td>
                            <td>' . $row['fecha'] . '</td>
							<td>' . $row['hora'] . '</td>
                            <td>' ;

                            if($row['disponible']=="si")
                                echo 
        '<a href="Desactivar.php?id=' . $row['idHORAS'].'" title="Anular" onclick="return confirm(\'Esta seguro que desea anular la hora ' . date('d-m-Y', strtotime($row['fecha'])) . ' a las ' .$row['hora'].'?\')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>'; 
        
							'</td>			
						</tr> 
						';
                            }
                        }
                        ?>
                    </table>
                </article>
                
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</body>

</html>