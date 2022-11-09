<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwPrp3BT2yJmxJQxIpIGNHn_p0hXxiTU8"></script>
    <style>
        #mapCanvas {
            width: 650px;
            height: 650px;
        }
    </style>
</head>

<body>
    <div id="mapCanvas"></div>
    <?php

    require("../Funciones/db.php");
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
</body>

</html>