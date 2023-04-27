<?php
include "../include/connection.php";
include "../include/function.php";
?>

<div id="googleTitle">
    <h1>My First Google Map</h1>
</div>

<div id="googleMap" style="width:100%;">dddd</div>

<script>
var map;
$(function() {
    $("#googleMap").height($(window).height() - ($("#mainTopbar").height() + $(
        "#googleTitle").height() + 16));
    var mapProp = {
        center: new google.maps.LatLng(17.4151942494563, 103.78811052232832),
        zoom: 9,
        mapTypeId: google.maps.MapTypeId.HYBRID,
    };
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    google.maps.event.addListener(map, 'click', function(e) {
        var latlng = e.latLng.toJSON();
        addNewMarker(latlng);
        loadPopup("../map/map_input_insert.php");
        // $("#modal-map").modal('show');
    });
});

function addNewMarker(latlng) {
    var mapMark = {
        position: new google.maps.LatLng(latlng.lat, latlng.lng),
        map: map,
    }
    var marker = new google.maps.Marker(mapMark);
    var infowindow = new google.maps.InfoWindow({
        content: "Hello World!"
    });
    google.maps.event.addListener(marker, 'click', function(e) {
        infowindow.open(map, marker);
    });
}
</script>
