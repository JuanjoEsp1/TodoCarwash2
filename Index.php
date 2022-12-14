<?php
// Conexion Base de datos
include("Funciones/db.php");

include("funciones.php")
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
// Llamar a la barra de navegacion
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
  <!--Banner -->
  <div id="slider">
    <figure>
      <img src="/IMG/wp001.jpg">
      <img src="/IMG/wp002.jpg">
      <img src="/IMG/wp003.jpg">
      <img src="/IMG/wp004.jpg">
      <img src="/IMG/wp005.jpg">
    </figure>
  </div>

    <!-- Sobre nosotros -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <p class="textbienvenida">Bienvenidos a TodoCarwash, el sitio web ideal para encontrar tu centro de lavado automotriz más cercano! 
¿Eres empresa? Estás en el lugar indicado, donde podrás publicitar tu empresa, con un mes GRATIS!</p>
  </div>

   <!-- Mapa -->
   <h1 class="w3-wide">Centros de lavados</h1>
   <div id="mapCanvas"></div>
  


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
  <!-- Llamar al pie de pagina -->
  
  <?php include("footer.php"); ?>
</body>
<?php
    // Codigo para el mapa
   
    // Obtener la información del marcador de la base de datos 
    $result = $conexion->query("SELECT * FROM empresa");

    // Obtener los datos de la ventana de información de la base de datos 
    $result2 = $conexion->query("SELECT * FROM empresa");
    ?>
    <script>
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap'
            };

            // Mostrar el mapa en la pagina
            map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
            map.setTilt(100);

            // Multiples marcadores de ubicacion, latitud, longitud
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

            // Ventana de informacion
            var infoWindowContent = [
                <?php if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) { ?>

                        ['<div class="info_content">' +
                            '<a href="../DetalleEmpresa2.php?nik=<?php echo $row['idEmpresa']; ?>"> <h3><?php echo $row['nombre_empresa']; ?></h3> </a>'+
                            '<p><?php echo $row['direccion']; ?></p>' + '</div>'
                        ],
                <?php }
                }
                ?>
            ];

            // Añadir varios marcadores al mapa
            var infoWindow = new google.maps.InfoWindow(),
                marker, i;

            // Coloca cada marcador en el mapa  
            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: markers[i][3],
                    title: markers[i][0]
                });

                // Añadir ventana de información al marcador    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent[i][0]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));

                // Centrar el mapa para que quepan todos los marcadores en la pantalla
                map.fitBounds(bounds);
            }

            // Establecer el nivel de zoom
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(10);
                google.maps.event.removeListener(boundsListener);
            });
        }

        // Cargar la función de inicialización
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</html>
