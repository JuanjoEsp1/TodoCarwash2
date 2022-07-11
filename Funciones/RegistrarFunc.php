<!DOCTYPE html>

<html lang="es">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar</title>
</head>


<body>
        <?php
        include('../Funciones/db.php');
        
        mysqli_query($conexion, "insert into empresa(rut_empresa,nombre_empresa,calle,numeracion,comuna,telefono_empresa,correo_empresa,contrasena) values ('$_REQUEST[rut_empresa]','$_REQUEST[nombre_empresa]','$_REQUEST[calle]','$_REQUEST[numeracion]','$_REQUEST[comuna]','$_REQUEST[telefono_empresa]','$_REQUEST[correo_empresa]','$_REQUEST[contrasena]')")

                or die("Problemas en la consulta" . mysqli_error($conexion));

        mysqli_close($conexion);

        echo "La Empresa fue registrada exitosamente";

        header("location:/Index.php");

        ?>


</body>





</html>