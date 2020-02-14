<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\driver\models\DriverWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рабочее время';
$this->params['breadcrumbs'][] = $this->title;

$this->render('connect_fullcalendar');

?>
<div class="driver-work-index overlay-wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('modal-form/modal-copy-interval', [
        'model_copy_week' => $model_copy_week,
    ]) ?>

    <?= $this->render('modal-form/model-schedule-adjustment', [
        'model_schedule_adjustment' => $model_schedule_adjustment,
    ]) ?>

    <?= $this->render('modal-form/modal-interval', [
        'model' => $model,
    ]) ?>

    <div id='calendar' style="max-width: 100%; margin: 0 auto;"></div>


    <div id="overlay-expectation" class="overlay" style="display: none">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>
