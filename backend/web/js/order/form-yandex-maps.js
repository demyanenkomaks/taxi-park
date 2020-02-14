var $latitudeStart = $('#userorder-latitude_start').val();
var $longitudeStart = $('#userorder-longitude_start').val();
var $latitudeStop = $('#userorder-latitude_stop').val();
var $longitudeStop = $('#userorder-longitude_stop').val();

ymaps.ready(function () {

    var myMap = new ymaps.Map('map', {
        center: [59.939095, 30.315868],
        zoom: 10,
        controls: ['routePanelControl']
    });

    var control = myMap.controls.get('routePanelControl');

    // Зададим опции панели для построения машрутов.
    control.routePanel.options.set({
        allowSwitch: false,
        reverseGeocoding: true,
        types: {auto: true}
    });

    if ($latitudeStart != '' && $longitudeStart != '' && $latitudeStop != '' && $longitudeStop != '') {
        control.routePanel.state.set({
            from: $latitudeStart + ',' + $longitudeStart,
            to: $latitudeStop + ',' + $longitudeStop
        });
    }

    $('#userorder-startselect').change(function () {
        var $start = $('#userorder-startselect').val();

        if ($start != '') {
            control.routePanel.state.set({
                from: $start
            });
        }
    });

    $('#userorder-stopselect').change(function () {
        var $stop = $('#userorder-stopselect').val();

        if ($stop != '') {
            control.routePanel.state.set({
                to: $stop
            });
        }
    });

    // Получим ссылку на маршрут.
    control.routePanel.getRouteAsync().then(function (route) {

        // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
        route.model.setParams({results: 1}, true);

        // Повесим обработчик на событие построения маршрута.
        route.model.events.add('requestsuccess', function () {
            // Получение координат
            var $coordsStart = route.getWayPoints().get(1).geometry.getCoordinates();
            var $coordsStop = route.getWayPoints().get(0).geometry.getCoordinates();

            // Проверка выбраных моих адресов с координатами
            var $start = $('#userorder-startselect').val();


            if ($start.length > 0 && $coordsStart != null && $start != ($coordsStart[0] + ',' + $coordsStart[1])) {
                $('#userorder-startselect').val(null).trigger("change");
            }
            var $stop = $('#userorder-stopselect').val();
            if ($stop.length > 0 && $coordsStop != null  && $stop != ($coordsStop[0] + ',' + $coordsStop[1])) {
                $('#userorder-stopselect').val(null).trigger("change");
            }

            if ($coordsStart != null) {
                $('#userorder-latitude_start').val($coordsStart[0]);
                $('#userorder-longitude_start').val($coordsStart[1]);

                // Получить адрес
                ymaps.geocode($coordsStart).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);

                    $('#userorder-start').val(firstGeoObject.properties.get('text'));
                });
            }
            if ($coordsStop != null) {
                $('#userorder-latitude_stop').val($coordsStop[0]);
                $('#userorder-longitude_stop').val($coordsStop[1]);

                // Получить адрес
                ymaps.geocode($coordsStop).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);

                    $('#userorder-stop').val(firstGeoObject.properties.get('text'));
                });
            }
        });

    });
});