<?php
include("Funciones/db.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/detalleEmpresa.css" type="text/css" />
    <title>Datos de empresa</title>
</head>

<body>

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
    <div class="card">
        <div class="image">
            <img src="IMG/logo2.jpg" alt="">
        </div>
        <div class="caption">
            <p class="nombre_empresa"><?php echo $row["nombre_empresa"]; ?></p>
            <p class="Direccion"><?php echo $row["calle"], " ", $row["numeracion"]; ?></p>
            <p class="comuna"><?php echo $row["comuna"]; ?></p>
        </div>
    </div>

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

    <!---------------------------------------------------------------->

    <?php

    $sql2 = mysqli_query($conexion, "SELECT idSERVICIO, nombre_servicio,precio_servicio FROM servicio WHERE EMPRESA_idEmpresa='$nik'");

    $sql3 = mysqli_query($conexion, "SELECT idHORAS, fecha, hora FROM horas WHERE EMPRESA_idEmpresa='$nik' AND disponible = 'si' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

    ?>

    <div id="id02" class="container">
        <div class="title">Agendar</div>
        <div class="content">
            <form class="modal-content animate" action="Funciones/Agendar.php" method="post">

                <div class="user-details">
                    <div class="input-box">
                        <span class="details" for="nomCLIENTE">Nombres</span>
                        <input type="text" placeholder="Ingrese su nombre" name="nomCLIENTE" required>
                    </div>
                    <div class="input-box">
                        <span class="details" for="apellCLIENTE">Apellidos</span>
                        <input type="text" placeholder="Ingrese su apellido" name="apellCLIENTE" required>
                    </div>
                    <div class="input-box">
                        <span class="details" for="rutCLIENTE">Rut</span>
                        <input type="text" placeholder="Ingrese su Rut" name="rutCLIENTE" oninput="checkRut(this)" required>
                    </div>
                    <div class="input-box">
                        <span class="details" for="dirCLIENTE">Direccion</span>
                        <input type="text" placeholder="Ingrese su Direccion" name="dirCLIENTE" required>
                    </div>
                    <div class="input-box">
                        <span class="details" for="numCLIENTE">Numero Celular</span>
                        <input class="code" type="text" placeholder="+56" readonly>
                        <input type="tel" class="tel" name="numCLIENTE" placeholder="12345678" maxlength="8" required>
                    </div>
                    <div class="input-box">
                        <span class="details" for="emailCLIENTE">Correo electronico</span>
                        <input type="email" name="emailCLIENTE" placeholder="correo@gmail.com" required>
                    </div>
                    <div class="select-box">
                        <span class="details">servicio:</span>
                        <select name="cbx_servicios" id="cbx_servicios">
                            <option value="0">seleccionar un servicio</option>
                            <?php while ($row = $sql2->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['idSERVICIO']; ?>"><?php echo $row['nombre_servicio']; ?><?php echo ' - ' ?><?php echo '$' ?><?php echo $row['precio_servicio']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="select-box">
                        <span class="details">Seleccion Hora:</span>
                        <select name="cbx_horas" id="cbx_horas">
                            <option value="0">seleccionar Hora</option>
                            <?php while ($row = $sql3->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['idHORAS']; ?>"><?php echo date("d-m-Y", strtotime($row['fecha'])); ?><?php echo ' - ' ?><?php echo date('H:s', strtotime($row['hora'])); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="container2" style="background-color:#f1f1f1">
                    <button type="submit" value="agendar" class="agendarbtn">Agendar</button>
                    <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </form>
        </div>
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
<script src="/js/validarRUT.js"></script>

</html>