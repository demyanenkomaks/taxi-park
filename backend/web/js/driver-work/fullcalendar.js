document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'ru',
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
        },
        themeSystem: 'bootstrap',
        defaultDate: new Date().getTime(),
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        eventLimit: true,
        events: '/personal/driver/driver-work/calendar-event',
        select: function($data) {
            if ($data.allDay == false) {
                $('#driverwork-start_d').val($data.start.toLocaleDateString());
                $('#driverwork-start_t').val($data.start.toLocaleTimeString());

                $('#driverwork-stop_d').val($data.end.toLocaleDateString());
                $('#driverwork-stop_t').val($data.end.toLocaleTimeString());

                $('#modal-form-event').modal('show');
            }
        },
        eventClick: function($data) {
            searchModalForUpdate($data.event);
        },
        selectOverlap: false
    });
    calendar.render();

    /**
     * Сохранение интервала
     */
    $(document).on('click', '#save-event-button', function () {
        $('#overlay-expectation').show();

        $.ajax({
            method: 'POST',
            url: '/personal/driver/driver-work/save-form-event',
            data: {
                id : $('#driverwork-id').val(),
                start_d : $('#driverwork-start_d').val(),
                start_t : $('#driverwork-start_t').val(),
                stop_d : $('#driverwork-stop_d').val(),
                stop_t : $('#driverwork-stop_t').val(),
                price : $('#driverwork-price').val()
            }
        }).done(function ($data) {
            if ($data.model != undefined) {
                var $id_delete = calendar.getEventById($data.model.id);
                if ($id_delete != null) {
                    $id_delete.remove();
                }

                calendar.addEvent({
                    id: $data.model.id,
                    title: $data.model.price + ' руб./час',
                    start: $data.model.start_d + ' ' + $data.model.start_t,
                    end: $data.model.stop_d + ' ' + $data.model.stop_t,
                    overlap: false,
                    editable: false
                });
                calendar.unselect();

                $('#modal-form-event').modal('hide');
            }

            if ($data.error != undefined) {
                messageError('danger', $data.error);
            }

            $('#overlay-expectation').hide();
        }).fail(function (err) {
            $('#overlay-expectation').hide();
        })
    });

    /**
     * Удаление интервала
     */
    $(document).on('click', '#delete-event-button', function () {
        $('#overlay-expectation').show();

        $.ajax({
            method: 'POST',
            url: '/personal/driver/driver-work/delete-form-event',
            data: {
                id : $('#driverwork-id').val()
            }
        }).done(function ($data) {
            if ($data.id != undefined) {
                calendar.getEventById($data.id).remove();

                $('#modal-form-event').modal('hide');
            }

            if ($data.error != undefined) {
                messageError('danger', $data.error);
            }

            $('#overlay-expectation').hide();
        }).fail(function (err) {
            // console.error(err);
            $('#overlay-expectation').hide();
        })
    });

    /**
     * Закрытия окна
     */
    $('#modal-form-event').on('hidden.bs.modal', function (e) {
        $('div#message-error').html('');
        $('#driverwork-id').val(null);
        $('#driverwork-start_d').val(null);
        $('#driverwork-start_t').val(null);
        $('#driverwork-stop_d').val(null);
        $('#driverwork-stop_t').val(null);
        $('#driverwork-price').val(null);
        $('#delete-event-button').attr("disabled", true);
    });

    /**
     * Поиск интервала
     */
    function searchModalForUpdate($dataEvent) {
        $('#modal-form-event').modal('show');
        $.ajax({
            method: 'POST',
            url: '/personal/driver/driver-work/search-modal',
            data: {
                id : $dataEvent.id
            }
        }).done(function ($data) {
            if ($data.model != undefined) {
                $('#driverwork-id').val($data.model.id);
                $('#driverwork-start_d').val($data.model.start_d);
                $('#driverwork-start_t').val($data.model.start_t);
                $('#driverwork-stop_d').val($data.model.stop_d);
                $('#driverwork-stop_t').val($data.model.stop_t);
                $('#driverwork-price').val($data.model.price);
                $('#delete-event-button').removeAttr("disabled");
            }

            if ($data.error != undefined) {
                messageError('danger', $data.error);
            }

            $('#overlay-expectation').hide();
        }).fail(function (err) {
            $('#overlay-expectation').hide();
        })
    }

    function messageError($class, $message) {
        $('div#message-error').html('' +
            '<div class="alert alert-' + $class + ' alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<strong>Внимание!</strong> ' + $message +
            '</div>' +
            '');
    }
});

