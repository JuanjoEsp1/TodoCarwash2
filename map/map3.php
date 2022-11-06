<!DOCTYPE html>
<html>
<meta charset="utf-8">

<head>
    <title>mapa markers</title>
    <style type="text/css">
        #map {
            position: relative;
            height: 400px;
            width: 600px;
        }

        .strong {
            color: blue;
            font-size: 16px;
            margin: 0;
            padding: 0px 4px;
            font-weight: 600;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwPrp3BT2yJmxJQxIpIGNHn_p0hXxiTU8&sensor=false"></script>
</head>

<body>
    <div id="map">
    <?php
    require("../Funciones/db.php");
    // Select all the rows in the markers table
    $query = "SELECT * FROM empresa WHERE idEmpresa = '18'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Invalid query: ');
    }
    while ($row = @mysqli_fetch_assoc($result)) {
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
                    '<p class="strong"><?php echo $row["nombre_empresa"]; ?></p>',
                    <?php echo $row["latitude"]; ?>, //lat
                    <?php echo $row["longitude"]; ?>, //lon
                    icon_,
                    '<?php echo $row["direccion"]; ?>',
                ],

            ];
            

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(-33.37021, -70.7390999),
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
</div>
</body>

</html>