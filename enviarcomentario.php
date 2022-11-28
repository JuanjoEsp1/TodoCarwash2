<?php  

include('./Funciones/db.php');

// Llamando a los campos
$nombre = $_POST['nombre'];
$comentario= $_POST['comentario'];
$idEmpresa = $_POST['idEmpresa'];

$nombre= mysqli_real_escape_string($conexion,$nombre);
$comentario= mysqli_real_escape_string($conexion,$comentario);
$resultado=mysqli_query($conexion,'INSERT INTO comentarios (idEmpresa, nombre, comentario) VALUES ("'.$idEmpresa.'","'.$nombre.'", "'.$comentario.'")');
header("Location:./DetalleEmpresa2.php?nik=$_REQUEST[idEmpresa]");

?>