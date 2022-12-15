<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar</title>
</head>


<body>
    <?php
    include('../Funciones/db.php');

    mysqli_query($conexion, "insert into agendamiento(rutCLIENTE,nomCLIENTE,apellCLIENTE,dirCLIENTE,numCLIENTE,emailCLIENTE,HORAS_idHORAS,SERVICIO_idSERVICIO,EMPRESA_idEmpresa,estado) values 
        ('$_REQUEST[rutCLIENTE]','$_REQUEST[nomCLIENTE]','$_REQUEST[apellCLIENTE]','$_REQUEST[dirCLIENTE]','$_REQUEST[numCLIENTE]','$_REQUEST[emailCLIENTE]','$_REQUEST[cbx_horas]','$_REQUEST[cbx_servicios]','$_REQUEST[idEmpresa]','activa')")

        or die("Problemas en la consulta" . mysqli_error($conexion));


    mysqli_query($conexion, "UPDATE horas SET disponible='no' WHERE idHoras='$_REQUEST[cbx_horas]'");

    mysqli_close($conexion);

    echo "";
    echo "<script>
    alert('su hora fue agendada exitosamente');
    window.location.href='../DetalleEmpresa2.php?nik=$_REQUEST[idEmpresa]';
    </script>";
    
    
    ?>
    



</body>





</html>
