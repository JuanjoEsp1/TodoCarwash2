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
    <title>Modificar Servicios</title>
</head>

<body>


    <div align="center">
        <hr>
        <h3>Actualizacion de Servicios</h3>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-3">
                <hr>
                <article class="table-responsive">

                    <?php
                    if (isset($_GET['aksi']) == 'delete') {

                        $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));
                        $cek = mysqli_query($conexion, "SELECT * FROM servicio WHERE EMPRESA_idEmpresa ='$idEmpresa'");
                        if (mysqli_num_rows($cek) == 0) {
                            echo '<nav class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</nav>';
                        } else {
                            $delete = mysqli_query($conexion, "DELETE FROM servicio WHERE idSERVICIO ='$nik'");
                            if ($delete) {
                                echo '<nav class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</nav>';
                            } else {
                                echo '<nav class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</nav>';
                            }
                        }
                    }
                    ?>
                    <table class="table table-striped table-hover" aria-describedby="servicios">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>ACCIONES</th>
                        </tr>
                        <?php
                        $sql = mysqli_query($conexion, "SELECT * FROM servicio WHERE EMPRESA_idEmpresa ='$idEmpresa'");
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        } else {
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo '
						<tr>
                            <td>' . $row['idSERVICIO'] . '</td>
                            <td>' . $row['nombre_servicio'] . '</td>
                            <td>' . $row['precio_servicio'] . '</td>
                            <td>

								<a href="EditarServicios.php?nik=' . $row['idSERVICIO'] . '" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="ModificarHoras.php?aksi=delete&nik=' . $row['idSERVICIO'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos ' . $row['nombre_servicio'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>			
						</tr>
						';
                            }
                        }
                        ?>
                    </table>
                </article>

                <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>


                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

            </div>
        </div>
    </div>
</body>

</html>