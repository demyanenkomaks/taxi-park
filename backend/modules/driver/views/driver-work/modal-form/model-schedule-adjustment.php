<?php

use kartik\widgets\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

Modal::begin([
    'id' => 'modal-schedule-adjustment',
    'header' => '<h2>Назначить выходной день</h2>',
    'toggleButton' => [
        'label' => 'Выходной',
        'tag' => 'button',
        'class' => 'btn btn-success',
    ],
]);
?>
    <div class="row">
        <div class="col-md-12">
            <p>* Уберерутся в этот день все заполненное рабочее время.</p>
        </div>

        <?php Pjax::begin() ?>
        <?php $form_adjustment = ActiveForm::begin([
            'id' => 'schedule-adjustment-form',
            'options' => [
                'data-pjax' => true,
            ],
        ]); ?>

        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form_adjustment->field($model_schedule_adjustment, 'date_output')->widget(DatePicker::class, [
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true
                    ]
                ]) ?>
            </div>
            <div class="col-md-6 pad-md-top-25"><?= Html::submitButton('Сделать выходным', ['class' => 'btn btn-success']) ?></div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>


<?php Modal::end(); ?>