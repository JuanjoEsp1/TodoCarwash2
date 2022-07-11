<?php
  
    // Connect to database 
    include("Funciones/db.php");
  
    // Check if id is set or not, if true,
    // toggle else simply go back to the page
    if (isset($_GET['id'])){
  
        // Store the value from get to 
        // a local variable "course_id"
        $hora_id=$_GET['id'];
  
        // SQL query that sets the status to
        // 0 to indicate deactivation.
        $sql="UPDATE horas SET disponible = 'no' WHERE idHORAS='$hora_id'";
  
        // Execute the query
        mysqli_query($conexion,$sql);
    }
  
    // Go back to course-page.php
    header('location: ModificarHoras.php');
?>