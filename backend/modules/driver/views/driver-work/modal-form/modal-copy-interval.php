<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

Modal::begin([
    'id' => 'modal-copy-interval',
    'header' => '<h2>Скопировать заполненное рабочее время</h2>',
    'toggleButton' => [
        'label' => 'Продлить',
        'tag' => 'button',
        'class' => 'btn btn-success',
    ],
]);
?>
    <div class="row">
    <div class="col-md-12">
        <p>* Последяя заполненная неделя будет скопирована выбранное количество недель.</p>
    </div>

    <?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
        'id' => 'copy-interval-form',
        'options' => [
            'data-pjax' => true,
        ],
    ]); ?>

    <div class="col-md-12">
        <div class="col-md-6"><?= $form->field($model_copy_week, 'count_week')->textInput(['type' => 'number', 'value' => 1]) ?></div>
        <div class="col-md-6 pad-md-top-25"><?= Html::submitButton('Скопировать неделю', ['class' => 'btn btn-success']) ?></div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>
    </div>


<?php Modal::end(); ?>