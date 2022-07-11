<?php
include("Funciones/db.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Datos de empleados</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            .content {
                margin-top: 80px;
            }
        </style>

    </head>
    <body>
        <section class="container">
            <article class="content">
                <h2>Datos del Servicio &raquo; Editar datos</h2>
                <hr />

                <?php
                
                $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));
                $sql = mysqli_query($conexion, "SELECT * FROM servicio WHERE idSERVICIO='$nik'");
                if (mysqli_num_rows($sql) == 0) {
                    header("Location: perfil.php");
                } else {
                    $row = mysqli_fetch_assoc($sql);
                }
                if (isset($_POST['save'])) {
                    $codigo = mysqli_real_escape_string($conexion, (strip_tags($_POST["codigo"], ENT_QUOTES))); 
                    $nombre = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES))); 
                    $precio = mysqli_real_escape_string($conexion, (strip_tags($_POST["precio"], ENT_QUOTES))); 

                    $update = mysqli_query($conexion, "UPDATE servicio SET nombre_servicio='$nombre', precio_servicio='$precio' WHERE idSERVICIO='$nik'") 

                    or die('error');

                    if ($update) {
                        header("Location: EditarServicios.php?nik=" . $nik . "&pesan=sukses");
                    } else {
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
                    }
                }

                if (isset($_GET['pesan']) == 'sukses') {
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
                }
                ?>
                <form class="form-horizontal" action="" method="post">
                    <article class="form-group">
                        <label class="col-sm-3 control-label">Código</label>
                        <article class="col-sm-2">
                            <input type="text" name="codigo" value="<?php echo $row ['idSERVICIO']; ?>" class="form-control" placeholder="NIK" required readonly>
                        </article>
                    </article>
                    <article class="form-group">
                        <label class="col-sm-3 control-label">Fecha</label>
                        <article class="col-sm-4">
                            <input type="text" name="nombre" value="<?php echo $row ['nombre_servicio']; ?>" class="form-control" required>
                        </article>
                    </article>
                    <article class="form-group">
                        <label class="col-sm-3 control-label">Hora</label>
                        <article class="col-sm-4">
                            <input type="number" name="precio" value="<?php echo $row ['precio_servicio']; ?>" class="form-control" required>
                        </article>
                    </article>
                  
                    <article class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <article class="col-sm-6">
                            <input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
                            <a href="ModificarServicios.php" class="btn btn-sm btn-danger">Volver</a>
                        </article>
                    </article>
                </form>
                
            </article>



        </section>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </body>
</html>