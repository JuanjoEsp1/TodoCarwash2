<?php
error_reporting(0);
//Conexion base de datos
include("Funciones/db.php");
//zona horaria de santiago
date_default_timezone_set("America/Santiago");

// Dias
$dias = explode(',', $_POST['days']);
// Contar dias
$countdays = count($dias);

// Hora Inicio 24 Horas
$HoraInicio = date('H:i:s', strtotime($_POST['tiempo1']));
$HoraFin = date('H:i:s', strtotime($_POST['tiempo2']));
$entreHora = $_POST['minutos'];
$entreHora2 = $entreHora * 60;
$diferencia = ($HoraFin - $HoraInicio);

//Obtenemos las fechas ingresadas
$FechaIn = $_POST['fechaIn'];
$FechaFin = $_POST['fechaFin'];

//Aplicamos otro formato para obtner la diferencia de dias (01-06-2022)
$FechaIn3 = date('d-m-Y', strtotime($FechaIn));
$FechaFin3 = date('d-m-Y', strtotime($FechaFin));

//nos entrega la fecha actual
$FechaActual = date('Y-m-d');

//Cantidad de segundos por dia
$entrefecha = 86400;

//Obtenemos la cantidad de dias
$diferenciaDias = $FechaFin3 - $FechaIn3;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    /**
     * Fecha inicial del rango de fechas
     */
    $fecha1 = strtotime($FechaIn);

    /**
     * Fecha final del rango de fechas
     */
    $fecha2 = strtotime($FechaFin);

    
    ?>
    <br>


    <?php
    /**
     * Recorremos el rango de fechas. El valor de 86400 son los segundos
     * que tiene un dia (24 horas * 60 minutos * 60 segundos)
     */
    for ($y = $fecha1; $y <= $fecha2; $y += 86400) {

        /**
         * Array de fecha y hora
         */
        for ($j = 0; $j < $diferencia; $j++) {

            $nuevaFecha = date("Y-m-d", $y);

            if ($j == 0) {

                // Se insertan los datos en la base de datos
                mysqli_query($conexion, "INSERT INTO horas (EMPRESA_idEmpresa,disponible,fecha,hora) VALUES ('$_REQUEST[idEmpresa]','si','$nuevaFecha', '$HoraInicio')")

                    or die("Problemas en la consulta" . mysqli_error($conexion));
            }
            if ($j >= 1) {
                
                // se va auto incrementando la diferencia de hora
                $ResEntreHora = $entreHora2 * $j;
                // Resultado de la hora que se guardara
                $nuevaHora = date("H:i:s", strtotime($HoraInicio) + $ResEntreHora);

                // Se insertan los datos en la base de datos
                mysqli_query($conexion, "INSERT INTO horas (EMPRESA_idEmpresa,disponible,fecha,hora) VALUES ('$_REQUEST[idEmpresa]','si','$nuevaFecha', '$nuevaHora')")

                    or die("Problemas en la consulta" . mysqli_error($conexion));
            }
        }
       
    }
    header("Location: Perfil.php?success=registrado");
    exit;
    ?>


</body>

</html>
