<?php
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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Perfil</title>

    <style type="text/css">
        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 auto;
                width: 25%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>

            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Ingresar Servicio</h4>
                <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">Agregar mas Servicios</a>
            </div>
            <div class="card-body">
                <!-- Formulario de registro de servicios -->
                <form action="IngresarServicios.php" method="POST">

                    <input type="text" name="idEmpresa" value="<?php echo $row['idEmpresa']; ?>" readonly hidden required>

                    <div class="main-form mt-3 border-bottom">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Servicio</label>
                                    <input type="text" name="servicio[]" class="form-control" required placeholder="Nombre del servicio">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Precio</label>
                                    <input type="number" name="precio[]" class="form-control" required placeholder="Ingrese precio">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="">Descripcion servicio</label>
                                    <textarea class="form-control" rows="5" placeholder="Descripcion del servicio" name="descripcion[]" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="paste-new-forms"></div>
                    <br>
                    <button type="submit" name="guardar_servicio" class="btn btn-success">Guardar Servicio</button>
                    <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
<!-- Ingresar multiples Servicios -->
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.main-form').remove();
            });

            $(document).on('click', '.add-more-form', function() {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <label for="">Servicio</label>\
                                            <input type="text" name="servicio[]" class="form-control" required placeholder="Nombre del servicio">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <label for="">Precio</label>\
                                            <input type="number" name="precio[]" class="form-control" required placeholder="Ingrese precio">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-4">\
                                <div class="form-group mb-2">\
                                    <label for="">Descripcion servicio</label>\
                                    <textarea class="form-control" rows="5" placeholder="Descripcion del servicio" name="descripcion[]" required></textarea>\
                                </div>\
                            </div>\
                                    <div class="col-md-4">\
                                        <div class="form-group mb-2">\
                                            <br>\
                                            <button type="button" class="remove-btn btn btn-danger">Eliminar</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>
    </div>
</body>

</html>
