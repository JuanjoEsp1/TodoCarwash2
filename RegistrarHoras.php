<?php
include("Funciones/db.php");
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
    <link href='https://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="Css/style.css" rel="stylesheet">
    <title>Perfil</title>
</head>

<body>

    <!-- modal nuevo horario -->
    <div class="container">
        <div class="modal-body">
            <h1>Registrar Horario</h1>
            <hr>
            <form id="horariofrm" method="post" action="/Process.php">
                <input type="text" name="idEmpresa" value="<?php echo $row['idEmpresa']; ?>" readonly hidden required>

                <!-- <label>Dias:</label>
                <div id="days-list" class="col-sm-12">
                    <a data-day="1" class="day-option">Lunes</a>
                    <a data-day="2" class="day-option">Martes</a>
                    <a data-day="3" class="day-option">Miercoles</a>
                    <a data-day="4" class="day-option">Jueves</a>
                    <a data-day="5" class="day-option">Viernes</a>
                    <a data-day="6" class="day-option">Sabado</a>
                    <a data-day="7" class="day-option">Domingo</a>
                </div>
                <input id="days-chose" class="form-control" type="text" name="days"> -->

                <label for="">Fecha Inicio</label>
                <input type="date" name="fechaIn" class="form-control" placeholder="Ingrese Fecha" required>
                <label for="">Fecha Fin</label>
                <input type="date" name="fechaFin" class="form-control" placeholder="Ingrese Fecha" required>
                <label>Hora de Inicio:</label>
                <input class="form-control" type="text" id="time1" name="tiempo1" required>
                <label>Hora de Cierre:</label>
                <input class="form-control" type="text" id="time2" name="tiempo2" required>
                <label>Dividir Entre:</label>
                <select class="form-control" name="minutos" required>
                    <option></option>
                    <option value="30">30 Minutos</option>
                    <option value="60">1 Hora</option>
                </select>
                <div class="modal-footer">
                    <button type="submit" value="crear" class="btn btn-success">Crear</button>
                    <a type="button" name="Volver" class="btn btn-danger" href="Perfil.php">Volver al Perfil</a>
                </div>
            </form>

        </div>

    </div>


    <!--jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- datetimepicker -->
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
    <!-- validate -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <!-- script -->
    <script src="js/script.js"></script>

</body>

</html>