ymaps.ready(init);

var $latitude = document.getElementById('userroutes-latitude').value;
var $longitude = document.getElementById('userroutes-longitude').value;
var $address = document.getElementById('userroutes-address').value;

function init() {
    var myMap = new ymaps.Map('map', {
        center: [$latitude, $longitude],
        zoom: 13,
        controls: []
    });
    

    if ($latitude != '' && $longitude != '') {
        myPlacemark_start = new ymaps.Placemark([$latitude, $longitude], {
            balloonContentHeader: document.getElementById('userroutes-name').value,
            balloonContentBody: $address
        });

        myMap.geoObjects.add(myPlacemark_start);
    }
}