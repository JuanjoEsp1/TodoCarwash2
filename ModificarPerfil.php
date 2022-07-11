<?php include("Funciones/db.php");
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
</head>

<body>


    <div align="center">
        <hr>
        <h3>Actualizacion de Datos Perfil</h3>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-3">
                <?php
                if ($_GET['success']) {
                    if ($_GET['success'] == 'userUpdated') {
                ?>
                        <small class="alert alert-success"> Perfil Actualizado Correctamente!</small>
                        <hr>
                    <?php
                    }
                }


                if (isset($_GET['error'])) {

                    if ($_GET['error'] == 'emptyNameAndEmail') {
                    ?>
                        <small class="alert alert-danger"> Name and email is required</small>
                        <hr>
                    <?php
                    } else if ($_GET['error'] == 'invalidFileType') {
                    ?>
                        <small class="alert alert-danger"> Invalid file type, Only Images allowed.</small>
                        <hr>
                    <?php
                    } else if ($_GET['error'] == 'invalidFileSize') {
                    ?>
                        <small class="alert alert-danger"> Maximum 5mb Image size allowed.</small>
                        <hr>
                <?php
                    }
                }
                ?>
                <form action="../Funciones/ProfileUpdateFunc.php" method="POST" enctype="multipart/form-data">
                    <?php

                    $sql = "SELECT * FROM empresa WHERE correo_empresa ='$correo'";

                    $gotResuslts = mysqli_query($conexion, $sql);

                    if ($gotResuslts) {
                        if (mysqli_num_rows($gotResuslts) > 0) {
                            while ($row = mysqli_fetch_array($gotResuslts)) {
                                //print_r($row['nombre_empresa']);
                    ?>
                                <div class="form-group">
                                    <input type="text" name="nombreEmpresa" class="form-control" value="<?php echo $row['nombre_empresa']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="email" name="correoEmpresa" class="form-control" value="<?php echo $row['correo_empresa']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="text" name="calleEmpresa" class="form-control" value="<?php echo $row['calle']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="number" name="numeracionEmpresa" class="form-control" value="<?php echo $row['numeracion']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="text" name="comunaEmpresa" class="form-control" value="<?php echo $row['comuna']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="number" name="telefonoEmpresa" class="form-control" value="<?php echo $row['telefono_empresa']; ?>">
                                </div>

                                <!--<div class="form-group">
                                    <input type="password" name="contrasenaEmpresa" class="form-control" value="<?php echo $row['contrasena']; ?>">
                                </div> -->

                                <!--<div class="form-group">
                                    <input type="file" name="userImage" class="form-control">
                                </div> -->
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="actualizar" class="btn btn-info" value="Actualizar Datos">
                                </div>
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