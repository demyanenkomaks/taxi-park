document.addEventListener('DOMContentLoaded', function () {
    var $driver = $('#userorder-driver').val();
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'ru',
        plugins: ['list'],
        header: {
            left: '',
            center: 'title',
            right: ''
        },
        defaultView: 'list',
        events: '/personal/passenger/order/calendar-event?driver=' + $driver,
        noEventsMessage: 'У водителя выходной.',
        listDayFormat: false
    });

    calendar.render();

    $('#form-modal-calculation').on('shown.bs.modal', function () {
        var $date = $('#userorder-date').val().split('.');
        calendar.gotoDate($date[2] + '-' + $date[1] + '-' + $date[0]);
        $('#form-modal-calculation').modal('show');
    });


    $('#form-modal-calculation').on('hidden.bs.modal', function (e) {
        calendar.unselect();
    });
});