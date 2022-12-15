<?php
date_default_timezone_set("America/Santiago");
include("Funciones/db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/detalleEmpresa2.css" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwPrp3BT2yJmxJQxIpIGNHn_p0hXxiTU8&sensor=false"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Detalle de empresa</title>
</head>

<body>
    <?php
    include("Navbar.php");
    ?>
    <div>
        <?php
        // Consulta para obtener el id de la empresa
        $nik = mysqli_real_escape_string($conexion, (strip_tags($_GET["nik"], ENT_QUOTES)));


        $date = date("Y-m-d");
        $userIP = $_SERVER['REMOTE_ADDR'];

        //insertar visitas
        $insertQuery = "INSERT INTO visitas (idEmpresa, visitas, ip, fecha) VALUES ('$nik', '1', '$userIP', '$date') ";

        // Ejecutar la consulta
        mysqli_query($conexion, $insertQuery);

        // Consulta de toda la informacion de la empresa con su "id"
        $sql = mysqli_query($conexion, "SELECT * FROM empresa WHERE idEmpresa='$nik'");

        if (mysqli_num_rows($sql) == 0) {
            header("Location: MostrarEmpresas2.php");
        } else {
            $row = mysqli_fetch_assoc($sql);
        ?>
            <section>
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
                <?php }
            }
                ?>
                    </div>
            </section>
            <?php
            $consultamap = mysqli_query($conexion, "SELECT latitude, longitude FROM empresa WHERE idEmpresa='$nik'");
            $rowlat = mysqli_fetch_assoc($consultamap);
            ?>
            <div class="dmap">
                <div id="map" class="map"></div>
                <a class="linkMap" href="https://www.google.com/maps/search/?api=1&query=<?php echo $rowlat["latitude"]; ?>,<?php echo $rowlat["longitude"]; ?>" target="_blank">
                    <i class="far fa-map" style='font-size:24px'></i><span> Ver mapa</span></a>
            </div>

            <div class="detail-content">
                <div class="detail">
                    <p class="Direccion"><label>Direccion: </label><?php echo $row["direccion"]; ?></p>
                    <p class="comuna"><label>Comuna: </label><?php echo $row["comuna"]; ?></p>
                    <p class="telefono"><label>Telefono: </label><?php echo $row["telefono_empresa"]; ?></p>
                    <p class="descripcion"><?php echo $row["descripcion"]; ?></p>
                    <div class="a-button">
                        <button type="button" class="btnagendar" onclick="document.getElementById('id02').style.display='block'">Agendar</button>
                        <button type="button" class="btnregresar" onclick="location.href='MostrarEmpresas2.php'">Regresar</button>
                    </div>
                </div>
            </div>
           


            <?php
            $valoracion = mysqli_query($conexion, "SELECT ROUND(AVG(valoracion),1) as promedio FROM valoracion WHERE idEmpresa = '$nik'");
            $rowvalo = mysqli_fetch_assoc($valoracion);

            $valoracionCount = mysqli_query($conexion, "SELECT COUNT(valoracion) as cantidad FROM valoracion WHERE idEmpresa = '$nik'");
            $rowCount = mysqli_fetch_assoc($valoracionCount);
            ?>
            <div class="valoracion">
                <p>Calificacion General</p>
                <p><?php echo $rowvalo["promedio"] ?> / 5</p>
                <p><?php echo $rowCount["cantidad"] ?> Calificaciones </p>
                <form action="./valoracion.php" method="POST">
                    <input type="hidden" name="idEmpresa" value="<?php echo $nik ?>" readonly>
                    <p class="clasificacion">
                        <input id="radio1" type="radio" name="estrellas" value="5">
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4">
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3">
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2">
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1">
                        <label for="radio5">★</label>
                    </p>
                    <div class="mail">
                        <input class="inputmail" type="email" name="emailCliente" placeholder="correo@gmail.com" required>
                        <button type="submit" value="valorar" class="btnvalorar">Valorar</button>
                    </div>
                </form>
            </div>



            <!-- Comentario section-->

            <div class="comentarios">
                <form method="POST" action="./enviarcomentario.php">
                    <input type="hidden" name="idEmpresa" value="<?php echo $nik ?>" readonly>
                    <section id="contact">
                        <div class="container px-4">
                            <div class="row gx-4 justify-content-center">
                                <div class="col-lg-8">
                                    <h2>Comentarios</h2>
                                    <br>

                                    <div class="col-xs-12">
                                        <h3>¡Haz un Comentario!</h3>

                                        <br>
                                        <div class="form-group">
                                            <label for="nombre" class="form-label">Nombre</label>
                                            <input class="form-control" name="nombre" type="text" id="nombre" placeholder="Escribe tu nombre" required>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label for="comentario" class="form-label">Comentario:</label>
                                            <textarea class="textComentario" name="comentario" cols="30" rows="5" type="text" id="comentario" placeholder="Escribe tu comentario......"></textarea>
                                        </div>
                                        <br>
                                        <input class="btnComentar" type="submit" value="Enviar Comentario">
                                        <br>
                                        <br>
                                        <br>
                                        <?php

                                        $resultado = mysqli_query($conexion, "SELECT * FROM comentarios WHERE idEmpresa = '$nik'");

                                        while ($comentario = mysqli_fetch_object($resultado)) {

                                        ?>

                                            <b><?php echo ($comentario->nombre);  ?></b>(<?php echo ($comentario->fecha); ?>) dijo:
                                            <br />
                                            <br>
                                            <?php echo ($comentario->comentario); ?>
                                            <br />
                                            <br>
                                            <hr />
                                            <br>
                                        <?php
                                        }

                                        ?>

                </form>

            </div>

            </section>
            <div>
                <!---------------------------------------------------------------->

                <?php

                $sql2 = mysqli_query($conexion, "SELECT idSERVICIO, nombre_servicio,precio_servicio FROM servicio WHERE EMPRESA_idEmpresa='$nik'");

                $sql3 = mysqli_query($conexion, "SELECT idHORAS, fecha, hora FROM horas WHERE EMPRESA_idEmpresa='$nik' AND disponible = 'si' AND fecha > (Now() - INTERVAL 1 DAY) ORDER BY fecha, hora");

                ?>

                <div id="id02" class="modalAgendar">
                    <div class="title">Agendar</div>
                    <div class="content">
                        <form class="container-content animate" action="./Funciones/Agendar.php" method="post">
                            <input type="hidden" name="idEmpresa" value="<?php echo $nik ?>" hidden readonly>

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
                                    <input type="text" placeholder="Ingrese su Rut" id="rutCLIENTE" name="rutCLIENTE" oninput="checkRut(this)" required>
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
                                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</body>

<?php

// Select all the rows in the markers table
$query = "SELECT * FROM empresa WHERE idEmpresa = '$nik'";
$resultmap = mysqli_query($conexion, $query);
if (!$resultmap) {
    die('Invalid query: ');
}
while ($rowmap = @mysqli_fetch_assoc($resultmap)) {

?>

    <script type="text/javascript">
        var markers = [];
        var icon_ = "https://cdn2.iconfinder.com/data/icons/font-awesome/1792/map-marker-32.png";

        // con código PHP lo puedes agregar directamente 
        // en él codigo los estilos y etiquetas 
        // que vayas a necesitar
        //puedes agregar todo el contenido que necesites
        var locations = [
            [
                '<a href="https://www.google.com/maps/search/?api=1&query=<?php echo $rowlat["latitude"]; ?>,<?php echo $rowlat["longitude"]; ?>" target="_blank"><p><?php echo $rowmap["nombre_empresa"]; ?></p></a>',
                <?php echo $rowmap["latitude"]; ?>, //lat
                <?php echo $rowmap["longitude"]; ?>, //lon
                icon_,
                '<?php echo $rowmap["direccion"]; ?>',
            ],

        ];


        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: new google.maps.LatLng(<?php echo $rowmap["latitude"]; ?>, <?php echo $rowmap["longitude"]; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        <?php } ?>

        var infowindow = new google.maps.InfoWindow();

        for (i = 0; i < locations.length; i++) {

            //access to global - var #markers
            markers[i] = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]), //lat,lon
                map: map, //mapa
                icon: locations[i][3] //custom icon
            });

            google.maps.event.addListener(markers[i], 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0] + "<br>" + locations[i][4]); //puede ser contenido HTML
                    infowindow.open(map, marker);
                }
            })(markers[i], i));
        }
    </script>

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

    <script>
        let readMore_btn = document.getElementById('readMore_btn');
        let hideText = document.getElementById('hideText');

        readMore_btn.addEventListener('click', toggleText);

        function toggleText() {
            hideText.classList.toggle('showText');

            if (hideText.classList.contains('showText')) {
                readMore_btn.innerHTML = 'Read Less'
            } else {
                readMore_btn.innerHTML = 'Read More'
            }
        }
    </script>

</html>
