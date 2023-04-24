<!DOCTYPE html>
<html>

<body>

    <h1>My First Google Map</h1>

    <div id="googleMap" style="width:100%;height:400px;"></div>

    <script>
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(17.4151942494563, 103.78811052232832),
            zoom: 9,
            mapTypeId: google.maps.MapTypeId.HYBRID,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var mapMark = {
            position: new google.maps.LatLng(17.4151942494563, 103.78811052232832),
            map: map,

        }
        var marker = new google.maps.Marker(mapMark);
        var infowindow = new google.maps.InfoWindow({
            content: "Hello World!"
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
            var pos = map.getZoom();
            map.setZoom(18);
            map.setCenter(marker.getPosition());
            window.setTimeout(function() {
                map.setZoom(pos);
            }, 3000);
        });
    }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgrspFTB0_6fco5mPwD416MkStMgCXubE&callback=myMap">
    </script>

</body>

</html>