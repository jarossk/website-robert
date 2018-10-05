function myMap() {
var mapProp = {
    center: new google.maps.LatLng(51.4562492, -0.97113),
    zoom: 5
    };
var mapOne = new google.maps.Map(document.getElementById('googleMap'),  mapProp);
    
//google.maps.event.addDomListener(window, 'load', myMap);
}

