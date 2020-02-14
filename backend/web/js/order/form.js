$(document).ready(function(){
    $(document).on('click', '#button-calculation', function () {

        var $duration = $('#userorder-duration').val();

        if ($duration != '00:00'){
            $('#overlay-expectation').show();
            var $data = $("form#form").serializeArray();

            $.ajax({
                method: 'POST',
                url: '/personal/passenger/order/calculation-ajax',
                data: $data
            }).done(function ($data) {
                $('#overlay-expectation').hide();

                if ($data.sum != false) {
                    $('span#order-cost').html($data.sum + ' рублей');
                    $('#cost-display').show();
                } else {
                    $('#cost-display').hide();
                    $('#form-modal-calculation').modal('show');
                }

            }).fail(function (err) {
                $('#overlay-expectation').hide();
            })
        } else {
            $('form#form').yiiActiveForm('updateAttribute', 'userorder-duration', ["Продолжительность поездки не может равнятся 00:00."]);
        }
    });

});