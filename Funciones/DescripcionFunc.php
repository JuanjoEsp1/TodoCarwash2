<?php
session_start();
// Report all PHP errors
error_reporting(E_ALL);

if (isset($_POST['actualizar'])) {

    include('../Funciones/db.php');

    $Nuevadescripcion = $_POST['descripcion'];

    if (!empty($Nuevadescripcion)) {


        $loggedInUser = $_SESSION['correo_empresa'];

        $sql = "UPDATE empresa SET descripcion = '$Nuevadescripcion' WHERE correo_empresa = '$loggedInUser'";

        $results = mysqli_query($conexion, $sql);

        header('Location:../ModificarDescripcion.php?success=userUpdated');
        exit;

    } else {
        header('Location:/todocarwash/ModificarDescripcion.php?error=emptyNameAndEmail');
        exit;
    }
}
?>