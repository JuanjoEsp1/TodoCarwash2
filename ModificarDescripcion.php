<?php 
// Conexion base de datos
include("Funciones/db.php");
//Validar que la sesion ha sido iniciada
session_start();
error_reporting(0);
$varsesion = $_SESSION['correo_empresa'];

if ($varsesion == null || $varsesion = '') {
    echo 'Usted no tiene autorizacion';
    die();
}
$correo = $_SESSION['correo_empresa'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Modificar Perfil</title>
    <style type="text/css">
        @media (max-width: 768px) {
            .form{
                position: absolute;
            }
        }
        body{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Descripcion</h1>
        <hr>
        <div class="row">

            <div class="col-md-6 offset-3">
                <?php
                if ($_GET['success']) {
                    if ($_GET['success'] == 'userUpdated') {
                ?>
                        <small class="alert alert-success">Descripcion Actualizada Correctamente!</small>
                        <hr>
                <?php
                    }
                }
                ?>
                <!-- Formulario para modificar la descripcion -->
                
                <form action="../Funciones/DescripcionFunc.php" method="POST" enctype="multipart/form-data" class="form">
                    <?php
                    // Consulta para obtener datos de la empresa
                    $sql = "SELECT * FROM empresa WHERE correo_empresa ='$correo'";

                    $gotResuslts = mysqli_query($conexion, $sql);

                    if ($gotResuslts) {
                        if (mysqli_num_rows($gotResuslts) > 0) {
                            while ($row = mysqli_fetch_array($gotResuslts)) {
                    ?>
                                <div class="form-group">
                                    <textarea name="descripcion" class="form-control" rows="5"><?php echo $row['descripcion']; ?></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="actualizar" class="btn btn-success" value="Actualizar Datos">

                        <?php
                            }
                        }
                    }
                        ?>
                </form>
                <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>
            </div>


        </div>
    </div>
</body>

</html>
