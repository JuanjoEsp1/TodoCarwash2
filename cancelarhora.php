<?php
  error_reporting(0);
    // Connect to database 
    include("Funciones/db.php");
  
    // Check if id is set or not, if true,
    // toggle else simply go back to the page
    if (isset($_GET['id'])){
  
        // Store the value from get to 
        // a local variable "course_id"
        $idAgendamiento=$_GET['id'];
  
        // SQL query that sets the status to
        // 0 to indicate deactivation.
        $sql="UPDATE agendamiento SET estado = 'cancelada' WHERE idAGENDAMIENTO='$idAgendamiento'";
  
        // Execute the query
        mysqli_query($conexion,$sql);
    }
  
    // Go back to course-page.php
    header('location: consultaHora.php');
