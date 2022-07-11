<?php
include('Funciones/db.php');
$usuario=$_POST['correo_empresa'];
$contrasena=$_POST['contrasena'];
session_start();
$_SESSION['correo_empresa'] = $usuario;

$consulta="SELECT*FROM empresa where correo_empresa='$usuario' and contrasena='$contrasena'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:Perfil.php");

}else{
    ?>
    <?php
    include("Login.php");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);