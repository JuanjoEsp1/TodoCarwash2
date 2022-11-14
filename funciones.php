<?php
date_default_timezone_set("America/Santiago");

 // Codigo para cambiar estado a reserva pasada
        $sql2 = mysqli_query($conexion, "SELECT * FROM agendamiento 
        INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
        INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO");

        $updateQuery = "UPDATE agendamiento INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS SET estado = 'inactiva' WHERE fecha < (Now() - INTERVAL 1 DAY) AND estado = 'activa'";
        mysqli_query($conexion, $updateQuery);
// Codigo cambio disponibilidad de hora cuando fecha ya expiro
    $updatehoras = "UPDATE horas SET disponible = 'no' WHERE fecha < (Now() - INTERVAL 1 DAY)";
    mysqli_query($conexion, $updatehoras);
?>