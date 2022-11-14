<?php
include('./Funciones/db.php');

$sql = "SELECT * FROM valoracion WHERE emailCliente ='$_REQUEST[emailCliente]' AND idEmpresa = '$_REQUEST[idEmpresa]'";
$result = mysqli_query($conexion, $sql);

if ($result) {
    if (mysqli_num_rows($result) == 0) {
        $valorar = "INSERT INTO valoracion (idEmpresa,valoracion,emailCliente) VALUES ('$_REQUEST[idEmpresa]','$_REQUEST[estrellas]','$_REQUEST[emailCliente]')";
        mysqli_query($conexion, $valorar);
    } else {

        $updateQuery = "UPDATE valoracion SET valoracion = '$_REQUEST[estrellas]' WHERE emailCliente ='$_REQUEST[emailCliente]' AND idEmpresa = '$_REQUEST[idEmpresa]' ";
        mysqli_query($conexion, $updateQuery);
    }

}

header("Location:./DetalleEmpresa.php?nik=$_REQUEST[idEmpresa]");
