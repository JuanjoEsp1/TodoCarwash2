<?php
include("Funciones/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script language="JavaScript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/detalleEmpresa.css" type="text/css" />
    <title>Datos de empresa</title>
</head>

<body>
    <section class="container">
        <article class="content">
            <h2>Datos de la empresa &raquo; Perfil</h2>
            <hr />

            <?php
            $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));

            $sql = mysqli_query($conexion, "SELECT * FROM empresa WHERE idEmpresa='$nik'");
            if (mysqli_num_rows($sql) == 0) {
                header("Location: MostrarEmpresas.php");
            } else {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>

            <table class="table table-striped table-condensed" aria-describedby="detalleEmpresas">
                <tr>
                    <th>Nombre de la Empresa</th>
                    <td><?php echo $row['nombre_empresa']; ?></td>
                </tr>
                <tr>
                    <th>Direccion</th>
                    <td><?php echo $row['calle'] . ' ' . $row['numeracion']; ?></td>
                </tr>
                <tr>
                    <th>Comuna</th>
                    <td><?php echo $row['comuna']; ?></td>
                </tr>
                <tr>
                    <th>Telefono</th>
                    <td><?php echo $row['telefono_empresa']; ?></td>
                </tr>
                <tr>
                    <th>Descripcion</th>
                    <td><?php echo $row['descripcion']; ?></td>
                </tr>
            </table>

            <a href="MostrarEmpresas2.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-" aria-hidden="true"></span> Regresar</a>
            <a href="#" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Agendar</a>

        </article>
    </section>


    <!---------------------------------------------------------------->

    <?php

    $sql2 = mysqli_query($conexion, "SELECT idSERVICIO, nombre_servicio,precio_servicio FROM servicio WHERE EMPRESA_idEmpresa='$nik'");

    $sql3 = mysqli_query($conexion, "SELECT idHORAS, fecha, hora FROM horas WHERE EMPRESA_idEmpresa='$nik' AND disponible = 'si' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

    ?>
    <div id="id02" class="modal">

        <form class="modal-content animate" action="Funciones/Agendar.php" method="post">


            <div class="container">
                <label for="nomCLIENTE"><b>Nombres</b></label>
                <input type="text" placeholder="Ingrese su nombre" name="nomCLIENTE" required>

                <label for="apellCLIENTE"><b>Apellidos</b></label>
                <input type="text" placeholder="Ingrese su apellido" name="apellCLIENTE" required>

                <label for="rutCLIENTE"><b>Rut</b></label>
                <input type="text" placeholder="Ingrese su Rut" name="rutCLIENTE" required>

                <label for="dirCLIENTE"><b>direccion</b></label>
                <input type="text" placeholder="Ingrese su Direccion" name="dirCLIENTE" required>

                <label for="numCLIENTE"><b>Numero Celular</b></label>
                <input type="tel" name="numCLIENTE" placeholder="12345678" maxlength="8" required>

                <label for="emailCLIENTE"><b>Correo electronico</b></label>
                <input type="email" name="emailCLIENTE" placeholder="correo@gmail.com" required>

                <div>
                    Seleccion servicio: <br>
                    <select name="cbx_servicios" id="cbx_servicios">
                        <option value="0">seleccionar un servicio</option>
                        <?php while ($row = $sql2->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['idSERVICIO']; ?>"><?php echo $row['nombre_servicio']; ?><?php echo ' - ' ?><?php echo '$' ?><?php echo $row['precio_servicio']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <br>

                <div>
                    Seleccion Hora: <br>
                    <select name="cbx_horas" id="cbx_horas">
                        <option value="0">seleccionar Hora</option>
                        <?php while ($row = $sql3->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['idHORAS']; ?>"><?php echo date("d-m-Y", strtotime($row['fecha'])); ?><?php echo ' - ' ?><?php echo date('H:s', strtotime($row['hora'])); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
                <div>
                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
        </form>

    </div>


</body>

<script>
    // Get the modal
    var modal = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>