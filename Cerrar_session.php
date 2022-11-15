<?php
    //Verifica la sesion
    session_start();
    error_reporting(0);
    $varsesion = $_SESSION['correo_empresa'];

if ($varsesion == null || $varsesion = ''){
    echo 'Usted no tiene autorizacion';
    die();
}
    //Cerrar la sesion
    session_destroy();

    //Volver a la pagina principal
    header("Location:index.php");

    
?>
