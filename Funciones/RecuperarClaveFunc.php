<?php
error_reporting(E_ALL);

if (isset($_POST['actualizar'])) {

    include('../Funciones/db.php');

    $NuevaContrasena  =    $_POST['contrasenaEmpresa'];
    $correo  =    $_POST['correo_empresa'];


    if (!empty($NuevaContrasena)) {

        $sql = "UPDATE empresa SET contrasena = '$NuevaContrasena' WHERE correo_empresa = '$correo'";

        $results = mysqli_query($conexion, $sql);
        
        header('Location:/Index.php');
        echo "Clave Actualizada Correctamente!";
        exit;
    }
}
?>