<!DOCTYPE html>
<html>
<head>
    <title>Get latitude and longitude from address google map api javascript</title>
</head>
<body>
 
<div>
     <h3> Enter an adress and press the button</h3>
 
    <input id="direccion" type="text" placeholder="Enter address here" />
    <div>
        <p>Latitude:
            <input type="text" id="latitude" readonly />
        </p>
        <p>Longitude:
            <input type="text" id="longitude" readonly />
        </p>
    </div>
</div>
 
<!-- Add the this google map apis to webpage -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyAwPrp3BT2yJmxJQxIpIGNHn_p0hXxiTU8&libraries=places"></script>
 
<script>
var direccion = 'direccion';
google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {

var autocomplete;
autocomplete = new google.maps.places.Autocomplete((document.getElementById(direccion)), {
    componentRestrictions: {
        country: "CL"
    }
});
autocomplete.addListener('place_changed', function () {
var place = autocomplete.getPlace();
// place variable will have all the information you are looking for.
 
  document.getElementById("latitude").value = place.geometry['location'].lat();
  document.getElementById("longitude").value = place.geometry['location'].lng();

});
}
</script>
</body>
</html>