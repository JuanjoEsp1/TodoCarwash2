<?php
error_reporting(0);
include("Funciones/db.php");
date_default_timezone_set("America/Santiago");
// Dias
$dias = explode(',', $_POST['days']);
// Contar dias
$countdays = count($dias);

//for($i=0; $i <= $countdays;$i++){}

// Hora Inicio 24 Horas
$HoraInicio = date('H:i:s', strtotime($_POST['tiempo1']));
$HoraFin = date('H:i:s', strtotime($_POST['tiempo2']));
$entreHora = $_POST['minutos'];
$entreHora2 = $entreHora * 60;
$diferencia = ($HoraFin - $HoraInicio);

//Obtenemos las fechas ingresadas
$FechaIn = $_POST['fechaIn'];
$FechaFin = $_POST['fechaFin'];

/*Aplicamos formato a las fechas (2022-06-01)
$FechaIn2 = date('Y-m-d', strtotime($FechaIn));
$FechaFin2 = date('Y-m-d', strtotime($FechaFin)); 
*/

//Aplicamos otro formato para obtner la diferencia de dias (01-06-2022)
$FechaIn3 = date('d-m-Y', strtotime($FechaIn));
$FechaFin3 = date('d-m-Y', strtotime($FechaFin));

//nos entrega la fecha actual
$FechaActual = date('Y-m-d');

//Cantidad de segundos por dia
$entrefecha = 86400;

//Obtenemos la cantidad de dias
$diferenciaDias = $FechaFin3 - $FechaIn3;

//$inicio =  date ( 'G:i' ,  strtotime ($data["params"]["tiempo1"]) ) ;             //fecha de inicio en formato 2022-07-12 09:30:00
//$fin = date ( 'Y-m-j H:i:s' ,strtotime ( $entreHora , strtotime ($data["params"]["tiempo1"]))) ;  //fecha de fin en formato 2022-07-12 10:15:00

// Hora Final 24 Horas
///////////////////////////////////////////////////////
//$horaTotal=strtotime ( $entreHora , strtotime ($inicio24) ) ; 



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
    <h1><?php echo 'Hora de Inicio: ' . $HoraInicio ?></h1>
    <h1><?php echo 'Hora de Cierre: ' . $HoraFin ?></h1>
    <h1><?php echo 'Fecha de inicio: ' . $FechaIn3; ?></h1>
    <h1><?php echo 'Fecha de fin: ' . $FechaFin3; ?></h1>
    <?php

    /**
     * Fecha inicial del rango de fechas
     */
    $fecha1 = strtotime($FechaIn);

    /**
     * Fecha final del rango de fechas
     */
    $fecha2 = strtotime($FechaFin);

    /**
     * Recorremos el rango de fechas. El valor de 86400 son los segundos
     * que tiene un dia (24 horas * 60 minutos * 60 segundos)
     */
    for ($i = $fecha1; $i <= $fecha2; $i += 86400) {
        //echo 'Fechas: ' . date("d-m-Y", $i) . "<br>";
    }
    ?>
    <br>


    <?php

    for ($y = $fecha1; $y <= $fecha2; $y += 86400) {

        /**
         * Array de fecha y hora
         */
        for ($j = 0; $j < $diferencia; $j++) {

            $nuevaFecha = date("Y-m-d", $y);

            if ($j == 0) {

                //echo '<br>' . $nuevaFecha . ' ' . $HoraInicio;

                mysqli_query($conexion, "INSERT INTO horas (EMPRESA_idEmpresa,disponible,fecha,hora) VALUES ('$_REQUEST[idEmpresa]','si','$nuevaFecha', '$HoraInicio')")

                    or die("Problemas en la consulta" . mysqli_error($conexion));
            }
            if ($j >= 1) {

                $ResEntreHora = $entreHora2 * $j;
                $nuevaHora = date("H:i:s", strtotime($HoraInicio) + $ResEntreHora);

                //echo '<br>' . $nuevaFecha . ' ', $nuevaHora;

                mysqli_query($conexion, "INSERT INTO horas (EMPRESA_idEmpresa,disponible,fecha,hora) VALUES ('$_REQUEST[idEmpresa]','si','$nuevaFecha', '$nuevaHora')")

                    or die("Problemas en la consulta" . mysqli_error($conexion));
            }
        }
       
    }
    echo "<br>Las horas se ingresaron exitosamente";
    header('location: Perfil.php');








    /**
     * Array luneas a viernes con las horas
     */
    /*for ($i = 0; $i < $countdays; $i++) {
        if ($dias[$i] == 1) {

            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo 'Lunes: ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Lunes: ' . $nuevaHora;
                }
            }
        }

        if ($dias[$i] == 2) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Martes: ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Martes: ' . $nuevaHora;
                }
                //Insert into Horas (dia, Horas) values('Martes',$hora1);             
            }
        }

        if ($dias[$i] == 3) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Miercoles ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Miercoles ' . $nuevaHora;
                }
            }
        }
        if ($dias[$i] == 4) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Jueves ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Jueves ' . $nuevaHora;
                }
            }
        }
        if ($dias[$i] == 5) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Viernes ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Viernes ' . $nuevaHora;
                }
            }
        }
        if ($dias[$i] == 6) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Sabado ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Sabado ' . $nuevaHora;
                }
            }
        }
        if ($dias[$i] == 7) {
            for ($j = 0; $j < $diferencia; $j++) {

                if ($j == 0) {
                    echo '<br>Domingo ' . $HoraInicio;
                }
                if ($j >= 1) {
                    $ResEntreHora = $entreHora2 * $j;
                    $nuevaHora = date("H:i", strtotime($HoraInicio) + $ResEntreHora);
                    echo '<br>Domingo ' . $nuevaHora;
                }
            }
        }
    } */

    ?>


</body>

</html>