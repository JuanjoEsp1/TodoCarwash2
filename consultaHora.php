<?php
date_default_timezone_set("America/Santiago");
include("Funciones/db.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="Css/consultahora.css" type="text/css" />
    <title>Consulta Hora</title>
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="title">Consultar Reserva</div>
            <div class="field-wrap">
                <label>Correo</label>
                <input type="email" name="correo" required autocomplete="off" />
            </div>
            <input type="submit" class="btnConsulta" name="consultar" value="Consultar" />
            <a href="Index.php" id="volver" class="mt-3 mb-4" title="Volver">Volver</a>
            <br><br>
        </form>
    </div>


    <table class="table table-striped table-hover" aria-describedby="Agenda">
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Id Servicio</th>
            <th>Hora</th>
            <th>Fecha</th>
            <th>Accion</th>
        </tr>

        <?php
       
        $correo = $_POST["correo"];
        $sql = mysqli_query($conexion, "SELECT * FROM agendamiento 
        INNER JOIN horas ON agendamiento.HORAS_idHORAS = horas.idHORAS 
        INNER JOIN servicio ON agendamiento.SERVICIO_idSERVICIO = servicio.idSERVICIO 
        WHERE agendamiento.emailCLIENTE = '$correo'");

        //AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora


        while ($row = mysqli_fetch_assoc($sql)) {
            echo '
                <tr>
                    <td>' . $row['idAGENDAMIENTO'] . '</td>
                    <td>' . $row['estado'] . '</td>
                    <td>' . $row['nomCLIENTE'] . ' ' . $row['apellCLIENTE'] . '</td>
                    <td>' . $row['numCLIENTE'] . '</td>
                    <td>' . $row['nombre_servicio'] . '</td>
                    <td>' . date('H:s', strtotime($row['hora'])) . '</td>
                    <td>' . date('d-m-Y', strtotime($row['fecha'])) . '</td>
                    <td>';

            if ($row['estado'] == "activa")
                echo
                '<a href="cancelarhora.php?id=' . $row['idAGENDAMIENTO'] . '" title="Cancelar" onclick="return confirm(\'Esta seguro de cancelar la hora agenda ' . date('d-m-Y', strtotime($row['fecha'])) . ' a las ' . $row['hora'] . '?\')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
            '</td>			
                </tr>
                ';
        }

        ?>
</body>

</html>