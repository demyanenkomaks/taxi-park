<?php

use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Modal::begin([
    'id' => 'modal-form-event',
    'header' => '<h2>Рабочее время</h2>',
    'toggleButton' => [
        'label' => 'Добавить рабочее время',
        'tag' => 'button',
        'class' => 'btn btn-success hide',
    ],
]);

$form = ActiveForm::begin(['id' => 'form-event']);
 ?>

<div id="message-error"></div>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<div class="col-md-12">
    <div class="col-md-6">
        <?= $form->field($model, 'start_d')->widget(DatePicker::class, [
            'options' => [
                'placeholder' => '',
                'value' => !empty($model->start_d) ? Yii::$app->formatter->asDate($model->start_d, 'php:d.m.Y') : null,
            ],
            'pluginOptions' => [
                'autoclose'=>true
            ]
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'start_t')->widget(TimePicker::class, [
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'minuteStep' => 30,
            ]
        ]) ?>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-6">
        <?= $form->field($model, 'stop_d')->widget(DatePicker::class, [
            'options' => [
                'placeholder' => '',
                'value' => !empty($model->stop_d) ? Yii::$app->formatter->asDate($model->stop_d, 'php:d.m.Y') : null,
            ],
            'pluginOptions' => [
                'autoclose'=>true
            ]
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'stop_t')->widget(TimePicker::class, [
            'pluginOptions' => [
                'showSeconds' => false,
                'showMeridian' => false,
                'minuteStep' => 30,
            ]
        ]) ?>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-6">
        <?= $form->field($model, 'price')->textInput() ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<div class="form-group" style="padding: 0 30px">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id' => 'save-event-button']) ?>

    <?= Html::submitButton('Удалить', ['class' => 'btn btn-danger pull-right', 'id' => 'delete-event-button', 'disabled' => 'true']) ?>
</div>

<?php Modal::end(); ?>