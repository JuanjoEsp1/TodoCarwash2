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
        header("Location: MostrarEmpresas2.php");
    } else {
        $row = mysqli_fetch_assoc($sql);



    ?>

        <section class="section-content">
            <div class="slideshow-container">
                <?php
                $query = "SELECT * FROM images WHERE EMPRESA_idEmpresa ='$nik' ORDER BY id_imagen ASC";
                $run = $conexion->query($query);
                while ($row2 = mysqli_fetch_array($run)) {
                    $image = $row2['image'];

                ?>
                    <div class="slideshow-container">
                        <div class="mySlides fade">
                            <div class="logo_slider">

                                <img src="./uploads/<?php echo $image ?>">

                            </div>

                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                            <a class="next" onclick="plusSlides(1)">❯</a>
                        </div>

                    </div>
            </div>

    <?php }
            } ?>

    <article class="detail-content">
        <div class="detail">
            <h1 class="nombre_empresa"><?php echo $row["nombre_empresa"]; ?></h1>
            <p class="Direccion"><label>Direccion: </label><?php echo $row["calle"], " ", $row["numeracion"]; ?></p>
            <p class="comuna"><label>Comuna: </label><?php echo $row["comuna"]; ?></p>
            <p class="telefono"><label>Telefono: </label><?php echo $row["telefono_empresa"]; ?></p>
            <p class="descripcion"><span><?php echo $row["descripcion"]; ?></span></p>
            <div class="a-button">
                <button type="button" class="btnregresar" onclick="location.href='MostrarEmpresas2.php'">Regresar</button>
                <button type="button" class="btnagendar" onclick="document.getElementById('id02').style.display='block'">Agendar</button>
            </div>
        </div>
    </article>
        </section>







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
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>

</html>