<?php
  
    // Conectar con la base de datos 
    include("Funciones/db.php");
  
    // Comprueba si el id está establecido o no, si es cierto,
    // cambia, si no, simplemente vuelve a la página
    if (isset($_GET['id'])){
  
        // Almacenar el valor de get a 
        // una variable local "id"
        $hora_id=$_GET['id'];
  
        // Consulta SQL que establece el estado a
        // 0 para indicar la desactivación.
        $sql="UPDATE horas SET disponible = 'no' WHERE idHORAS='$hora_id'";
  
        // Ejecutar la consulta
        mysqli_query($conexion,$sql);
    }
  
    // Volver a la pagina de ModificarHoras.php
    header('location: ModificarHoras.php');
?>
