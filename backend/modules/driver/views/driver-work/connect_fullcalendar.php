<?php
$this->registerCssFile('/personal/fullcalendar/packages/core/main.css');
$this->registerCssFile('/personal/fullcalendar/packages/daygrid/main.css');
$this->registerCssFile('/personal/fullcalendar/packages/timegrid/main.css');
$this->registerCssFile('/personal/fullcalendar/packages/list/main.css');

$this->registerJsFile('/personal/fullcalendar/packages/core/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/interaction/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/daygrid/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/timegrid/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/list/main.js',['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/personal/fullcalendar/packages/core/locales-all.js',['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerJsFile('/personal/js/driver-work/fullcalendar.js',['depends' => [\yii\web\JqueryAsset::class]]);
