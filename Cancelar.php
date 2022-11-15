<?php
  session_start();
  error_reporting(0);
  $varsesion = $_SESSION['correo_empresa'];
  
  if ($varsesion == null || $varsesion = '') {
      echo 'Usted no tiene autorizacion';
      die();
  }
    // Conexion Base de datos
    include("Funciones/db.php");
  
    // Comprueba si el id está establecido o no, si es verdadero,
    // si no, simplemente vuelve a la página
    if (isset($_GET['id'])){
  
        // Almacenar el valor de get a 
        // una variable local "id"
        $idAgendamiento=$_GET['id'];
  
        // Consulta SQL que establece el estado a
        // 0 para indicar la desactivación.
        $sql="UPDATE agendamiento SET estado = 'cancelada' WHERE idAGENDAMIENTO='$idAgendamiento'";
  
        // Ejecutar la consulta
        mysqli_query($conexion,$sql);
    }
  
    // Vuelve a la página del curso.php
    header('location: Perfil.php');
