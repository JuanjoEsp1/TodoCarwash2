<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
</head>


<body>

    <?php
    // Conexion Base de datos
    include("Funciones/db.php");
    // Condicion para verificar si se recibieron los datos
    if (isset($_POST['guardar_servicio'])) {
        $servicio = $_POST['servicio'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        foreach ($servicio as $index => $servicios) {
            $s_servicio = $servicios;
            $s_precio = $precio[$index];
            $s_descripcion = $descripcion[$index];
            // Consulta para insertar los datos del servicio a la base de datos
            $query = "INSERT INTO servicio (nombre_servicio,precio_servicio,descripcion,EMPRESA_idEmpresa) VALUES ('$s_servicio','$s_precio','$s_descripcion','$_REQUEST[idEmpresa]')";
            // Ejecutar la consulta
            $query_run = mysqli_query($conexion, $query);
        }

        if ($query_run) {
            $_SESSION['status'] = "Datos insertados correctamente!";
            header("Location: Perfil.php?success=registrado");
            exit(5);
        } else {
            $_SESSION['status'] = "Datos no agregados!";
            header("Location: Perfil.php?error=error");
            exit(5);
        }
    }
    ?>


</body>





</html>
