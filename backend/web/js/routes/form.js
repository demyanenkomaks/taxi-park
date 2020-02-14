ymaps.ready(init);
var $latitude = document.getElementById('userroutes-latitude').value;
var $longitude = document.getElementById('userroutes-longitude').value;

var $latitudeCenter = null;
var $longitudeCenter = null;

if ($latitude != '' && $longitude != '') {
    $latitudeCenter = $latitude;
    $longitudeCenter = $longitude;
} else {
    $latitudeCenter = 59.939095;
    $longitudeCenter = 30.315868;
}

function init() {
    var myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [$latitudeCenter, $longitudeCenter],
            zoom: 13,
            controls: ['zoomControl',  'fullscreenControl']
        });

    // Создадим элемент управления поиск
    var searchControl = new ymaps.control.SearchControl({
        options: {
            provider: 'yandex#search'
        }
    });
    // Добавим поиск на карту
    myMap.controls.add(searchControl);


    if ($latitude != '' && $longitude != '') {
        myPlacemark = createPlacemark([$latitude, $longitude]);
        myMap.geoObjects.add(myPlacemark);
        // Слушаем событие окончания перетаскивания на метке.
        myPlacemark.events.add('dragend', function () {
            getAddress(myPlacemark.geometry.getCoordinates());
        });

        getAddress([$latitude, $longitude]);
    }

    searchControl.events.add('resultselect', function(e) {
        var index = e.get('index');
        searchControl.getResult(index).then(function(res) {
            myMap.geoObjects.removeAll(); // Удаляет все обьекты на карте

            var $coor = res.geometry.getCoordinates(); // получаем координаты найденной точки

            myPlacemark = createPlacemark($coor);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
            getAddress(myPlacemark.geometry.getCoordinates());

        });
    });

    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            // preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        // Записываем координаты в форму
        document.getElementById('userroutes-latitude').value = coords[0];
        document.getElementById('userroutes-longitude').value = coords[1];

        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);

            document.getElementById('userroutes-address').value = firstGeoObject.properties.get('text');

            myPlacemark.properties
                .set({
                    // Формируем строку с данными об объекте.
                    iconCaption: [
                        // Название населенного пункта или вышестоящее административно-территориальное образование.
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    balloonContentHeader: document.getElementById('userroutes-name').value,
                    // В качестве контента балуна задаем строку с адресом объекта.
                    balloonContent: firstGeoObject.getAddressLine()
                });
        });
    }

}