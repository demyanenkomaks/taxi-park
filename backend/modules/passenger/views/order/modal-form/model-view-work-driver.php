<?php

use yii\bootstrap\Modal;

$this->registerCssFile('/personal/fullcalendar/packages/core/main.css');
$this->registerCssFile('/personal/fullcalendar/packages/list/main.css');

$this->registerJsFile('/personal/fullcalendar/packages/core/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/list/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/core/locales-all.js',['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerJsFile('/personal/js/order/view-work-driver.js',['depends' => [\yii\web\JqueryAsset::class]]);

Modal::begin([
    'id' => 'form-modal-calculation',
    'header' => '<h2>Водитель работает</h2>',
    'toggleButton' => [
        'label' => 'Посмотреть работает водитель',
        'tag' => 'button',
        'class' => 'btn btn-info',
    ],
]);
?>
    <div class="row">
        <div class="col-md-12">
            <p>* Просмотр время работы водителя такси в выбранный день.</p>
        </div>
        <div class="col-md-12 pad-bot-25">
            <div id='calendar' style="max-width: 100%; margin: 0 auto;"></div>
        </div>
    </div>

<?php Modal::end(); ?>