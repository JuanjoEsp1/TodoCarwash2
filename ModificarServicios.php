<?php 
// Conexion base de datos
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">    <link href="css/bootstrap.min.css" rel="stylesheet">
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
			//Condicion para borrar un servicio
                    if (isset($_GET['aksi']) == 'delete') {
			//Obtener id del servicio
                        $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));
			//Obtener datos del servicio
                        $cek = mysqli_query($conexion, "SELECT * FROM servicio WHERE EMPRESA_idEmpresa ='$idEmpresa'");
			//Condicion por si no hay datos
                        if (mysqli_num_rows($cek) == 0) {
                            echo '<nav class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</nav>';
                       	//Eliminar servicio
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
		<!-- tabla donde se muestran los servicios -->
                    <table class="table table-striped table-hover" aria-describedby="servicios">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>Descripcion</th>
                            <th>ACCIONES</th>
                        </tr>
                        <?php
	                // Consulta para obtener datos de los servicios
                        $sql = mysqli_query($conexion, "SELECT * FROM servicio WHERE EMPRESA_idEmpresa ='$idEmpresa'");
			//Condicion por si no hay datos
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        } else {
			    // Recorrido de los datos
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo '
						<tr>
                            <td>' . $row['idSERVICIO'] . '</td>
                            <td>' . $row['nombre_servicio'] . '</td>
                            <td>' . $row['precio_servicio'] . '</td>
                            <td>' . $row['descripcion'] . '</td>
                            <td>

								<a href="EditarServicios.php?nik=' . $row['idSERVICIO'] . '" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="ModificarServicios.php?aksi=delete&nik=' . $row['idSERVICIO'] . '" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos ' . $row['nombre_servicio'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
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
