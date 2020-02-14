<?php

use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserOrder */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU',['position' => yii\web\View::POS_END]);
$this->registerJsFile(Url::to(['/js/order/form-yandex-maps.js']),['depends' => [yii\web\JqueryAsset::class]]);
$this->registerJsFile(Url::to(['/js/order/form.js']),['depends' => [yii\web\JqueryAsset::class]]);

?>

<div class="user-order-form row overlay-wrapper">
    <?php if (!empty($model->driver)): ?>
    <div class="col-md-12">
        <?= $this->render('modal-form/model-view-work-driver') ?>
    </div>

    <div class="col-md-12">
        <p class="text-size-20">Сделать заказ водителю такси <span class="mask-phone"><?= $model_driver->username?></span> <b>(<?= $model_driver->p_f?> <?= $model_driver->p_i?> <?= $model_driver->p_o?>)</b></p>
    </div>
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
            'id' => 'form',
            'options' => [
                'data-pjax' => true,
            ],
        ]);?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'driver')->hiddenInput(['disabled' => true])->label(false) ?>

    <div class="col-md-12">
        <div class="col-md-3">
            <?= $form->field($model, 'date')->widget(DatePicker::class, [
                'options' => [
                    'placeholder' => '',
                    'value' => !empty($model->date) ? Yii::$app->formatter->asDate($model->date, 'php:d.m.Y') : null,
                ],
                'pluginOptions' => [
                    'autoclose'=>true
                ]
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'time')->widget(TimePicker::class, [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 10,
                ]
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'duration')->widget(TimePicker::class, [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 10,
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'latitude_start')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'longitude_start')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'latitude_stop')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'longitude_stop')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'start')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'stop')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="col-md-12">
                <label class="control-label">Откуда из моих адресов</label>
            </div>
            <div class="col-md-12">
                <?= Select2::widget([
                    'model' => $model,
                    'attribute' => 'startSelect',
                    'data' => $model->routeArray,
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <label class="control-label">Куда из моих адресов</label>
            </div>
            <div class="col-md-12">
                <?= Select2::widget([
                    'model' => $model,
                    'attribute' => 'stopSelect',
                    'data' => $model->routeArray,
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 pad-top-15">
        <div class="col-md-3">
            <?= Html::submitButton('Расчитать стоимость', ['class' => 'btn btn-primary', 'id' => 'button-calculation']) ?>
        </div>
        <div class="col-md-6">
            <p class="text-size-24" id="cost-display" style="<?= empty($model->cost) ? 'display: none' : ''?>">
                <b>Стоимость заказа: </b>
                <span class="label label-success" id="order-cost"><?= !empty($model->cost) ? $model->cost . ' рублей' : ''?></span>
            </p>
        </div>
        <div class="col-md-3">
            <?= Html::submitButton('Заказать', ['class' => 'btn btn-success pull-right', 'form' => 'form']) ?>
        </div>
    </div>
    <div id="map" class="col-md-12 pad-top-15" style="height: 400px;"></div>

    <?php endif;?>

    <div id="overlay-expectation" class="overlay" style="display: none">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>
