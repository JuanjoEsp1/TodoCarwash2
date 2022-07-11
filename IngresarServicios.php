<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
</head>


<body>

    <?php

    include("Funciones/db.php");

    if (isset($_POST['guardar_servicio'])) {
        $servicio = $_POST['servicio'];
        $precio = $_POST['precio'];

        foreach ($servicio as $index => $servicios) {
            $s_servicio = $servicios;
            $s_precio = $precio[$index];

            $query = "INSERT INTO servicio (nombre_servicio,precio_servicio,EMPRESA_idEmpresa) VALUES ('$s_servicio','$s_precio','$_REQUEST[idEmpresa]')";
            $query_run = mysqli_query($conexion, $query);
        }

        if ($query_run) {
            $_SESSION['status'] = "Datos insertados correctamente!";
            header("Location: Perfil.php");
            exit(5);
        } else {
            $_SESSION['status'] = "Datos no agregados!";
            header("Location: Perfil.php");
            exit(5);
        }
    }
    ?>


</body>





</html>