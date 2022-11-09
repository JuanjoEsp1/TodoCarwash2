<?php
include("Funciones/db.php");

$date = date("Y-m-d");

$userIP = $_SERVER['REMOTE_ADDR'];

$updateQuery = "UPDATE `visitas` SET `ip`='$userIP', `visitas`=`visitas` +1 ,`date` ='$date'";

mysqli_query($conexion, $updateQuery);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="Image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="Image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="Image/favicon-16x16.png">
  <link rel="manifest" href="Image/site.webmanifest">
  <link rel="stylesheet" href="Css/Index.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwPrp3BT2yJmxJQxIpIGNHn_p0hXxiTU8"></script>
  <title>Home</title>
</head>

<body>
  <?php
  error_reporting(0);
  include("Navbar.php");
  ?>

  
  <?php
  if ($_GET['success']) {
    if ($_GET['success'] == 'agendado') {
  ?>
      <small class="alert alert-success">Agendado correctamente!</small>
      <hr>
  <?php
    }
  }
  ?>
  <div id="slider">
    <figure>
      <img src="/IMG/wp001.jpg">
      <img src="/IMG/wp002.jpg">
      <img src="/IMG/wp003.jpg">
      <img src="/IMG/wp004.jpg">
      <img src="/IMG/wp005.jpg">
    </figure>
  </div>

   <!-- Mapa general -->
   <div id="mapCanvas"></div>
  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Sobre Nosotros</h2>
    <p class="w3-opacity"><i></i></p>
    <p class="w3-justify">TodoCarwash nació en el año 2021 medio de la pandemia, su principal objetivo es ofrecer una plataforma a todo pymes o Empresas de lavado de autos que necesitan publicar su servicio de agendamiento de horas.</p>


    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <p>Guillermo</p>
        <img src="/IMG/bandmember.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Given</p>
        <img src="/IMG/bandmember.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Juan</p>
        <img src="/IMG/bandmember.jpg" class="w3-round" alt="Random Name" style="width:60%">
      </div>
    </div>


  </div>

  <section class="wrapper style1 container special">
    <div class="row">
      <div class="col-4 col-12-narrower">

        <section class="section-block">
          <iconify-icon icon="mdi:bullseye-arrow" class="icono"></iconify-icon>

          <header>
            <h3>Mision</h3>
          </header>
          <p class="p-def">Nuestro proyecto busca liderar el mercado de la búsqueda de lavados de vehículos en Chile, otorgando el mayor grado de satisfacción a los clientes.</p>
        </section>

      </div>
      <div class="col-4 col-12-narrower">

        <section class="section-block">
          <iconify-icon icon="emojione:eye" class="icono"></iconify-icon>
          <header>
            <h3>Vision</h3>
          </header>
          <p class="p-def">Ser el principal referente de búsqueda de lavados de vehículos a través de internet en Chile.</p>
        </section>

      </div>
      <div class="col-4 col-12-narrower">

        <section class="section-block">
          <iconify-icon icon="bi:gem" class="icono"></iconify-icon>
          <header>
            <h3>Valores</h3>
          </header>
          <p class="p-def">Todocarwash se respalda de un equipo que busca facilitar la búsqueda y generar confianza entre los centros de lavado automotriz y sus clientes.</p>
        </section>

      </div>
    </div>
    
  </section>
  <div>
    
  </div>

  <?php include("footer.php"); ?>
</body>
<?php

   
    // Fetch the marker info from the database 
    $result = $conexion->query("SELECT * FROM empresa");

    // Fetch the info-window data from the database 
    $result2 = $conexion->query("SELECT * FROM empresa");
    ?>
    <script>
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap'
            };

            // Display a map on the web page
            map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
            map.setTilt(100);

            // Multiple markers location, latitude, and longitude
            var icon_ = "https://cdn2.iconfinder.com/data/icons/font-awesome/1792/map-marker-32.png";

            var markers = [
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>[
                            '<p class="strong"><?php echo $row["nombre_empresa"]; ?></p>',
                            <?php echo $row["latitude"]; ?>, //lat
                            <?php echo $row["longitude"]; ?>, //lon
                            icon_,
                            '<?php echo $row["direccion"]; ?>'
                        ],
                <?php
                    }
                }
                ?>
            ];

            // Info window content
            var infoWindowContent = [
                <?php if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) { ?>

                        ['<div class="info_content">' +
                            '<a href="../DetalleEmpresa.php?nik=<?php echo $row['idEmpresa']; ?>"> <h3><?php echo $row['nombre_empresa']; ?></h3> </a>'+
                            '<p><?php echo $row['direccion']; ?></p>' + '</div>'
                        ],
                <?php }
                }
                ?>
            ];

            // Add multiple markers to map
            var infoWindow = new google.maps.InfoWindow(),
                marker, i;

            // Place each marker on the map  
            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: markers[i][3],
                    title: markers[i][0]
                });

                // Add info window to marker    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent[i][0]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                // Center the map to fit all markers on the screen
                map.fitBounds(bounds);
            }

            // Set zoom level
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(10);
                google.maps.event.removeListener(boundsListener);
            });
        }

        // Load initialize function
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</html>