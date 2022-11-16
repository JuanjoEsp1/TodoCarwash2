<?php 
//Conexion base de datos
include("Funciones/db.php");
//Validad inicio de sesion
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
    </style>
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
                <form action="../Funciones/ProfileUpdateFunc.php" method="POST" enctype="multipart/form-data" class="form">
                    <?php
                    // Consulta obtener datos de la empresa
                    $sql = "SELECT * FROM empresa WHERE correo_empresa ='$correo'";
                    // Ejecutar consulta
                    $gotResuslts = mysqli_query($conexion, $sql);

                    if ($gotResuslts) {
                        if (mysqli_num_rows($gotResuslts) > 0) {
                            // llamar y recorrer los datos encontrados
                            while ($row = mysqli_fetch_array($gotResuslts)) {
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
                                    <input type="text" name="direccion" class="form-control" value="<?php echo $row['direccion']; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <select name="comunaEmpresa" class="form-control">
                                        <option value="<?php echo $row['comuna']; ?>"><?php echo $row['comuna']; ?></option>
                                        <option value="Buin">Buin</option>
                                        <option value="Calera de Tango">Calera de Tango</option>
                                        <option value="Cerrillos">Cerrillos</option>
                                        <option value="Cerro Navia">Cerro Navia</option>
                                        <option value="Colina">Colina</option>
                                        <option value="Conchali">Conchalí</option>
                                        <option value="El Bosque">El Bosque</option>
                                        <option value="Estación Central">Estación Central</option>
                                        <option value="Huechuraba">Huechuraba</option>
                                        <option value="Independencia">Independencia</option>
                                        <option value="La Cisterna">La Cisterna</option>
                                        <option value="La Florida">La Florida</option>
                                        <option value="La Granja">La Granja</option>
                                        <option value="La Pintana">La Pintana</option>
                                        <option value="La Reina">La Reina</option>
                                        <option value="Lampa">Lampa</option>
                                        <option value="Las Condes">Las Condes</option>
                                        <option value="Lo Barnechea">Lo Barnechea</option>
                                        <option value="Lo Espejo">Lo Espejo</option>
                                        <option value="Lo Prado">Lo Prado</option>
                                        <option value="Macul">Macul</option>
                                        <option value="Maipu">Maipú</option>
                                        <option value="Ñuñoa">Ñuñoa</option>
                                        <option value="Paine">Paine</option>
                                        <option value="Pedro Aguirre Cerda">Pedro Aguirre Cerda</option>
                                        <option value="Peñalolen">Peñalolén</option>
                                        <option value="Pirque">Pirque</option>
                                        <option value="Providencia">Providencia</option>
                                        <option value="Pudahuel">Pudahuel</option>
                                        <option value="Puente Alto">Puente Alto</option>
                                        <option value="Quilicura">Quilicura</option>
                                        <option value="Quinta Normal">Quinta Normal</option>
                                        <option value="Recoleta">Recoleta</option>
                                        <option value="Renca">Renca</option>
                                        <option value="San Bernardo">San Bernardo</option>
                                        <option value="San Joaquin">San Joaquín</option>
                                        <option value="San Jose de Maipo">San José de Maipo</option>
                                        <option value="San Miguel">San Miguel</option>
                                        <option value="San Ramon">San Ramón</option>
                                        <option value="Santiago">Santiago</option>
                                        <option value="Til Til">Til Til</option>
                                        <option value="Vitacura">Vitacura</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="number" name="telefonoEmpresa" class="form-control" value="<?php echo $row['telefono_empresa']; ?>">
                                </div>

                                <!--<div class="form-group">
                                    <input type="password" name="contrasenaEmpresa" class="form-control" value="<?php echo $row['contrasena']; ?>">
                                </div> -->
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="actualizar" class="btn btn-success" value="Actualizar Datos">
                                    <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php"><i class="bi bi-arrow-left-circle"></i>Volver al Perfil</a>
                                </div>
                    <?php
                            }
                        }
                    }


                    ?>

                </form>

            </div>

        </div>


    </div>
</body>

</html>
