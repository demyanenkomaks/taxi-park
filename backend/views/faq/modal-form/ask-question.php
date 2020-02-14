<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

Modal::begin([
    'id' => 'form-modal-ask-question',
    'header' => '<h2>Задать вопрос</h2>',
    'toggleButton' => [
        'label' => 'Задать вопрос',
        'tag' => 'button',
        'class' => 'btn btn-info pull-right',
    ],
]);
?>
    <div class="row">
        <?php Pjax::begin() ?>
        <?php $form = ActiveForm::begin([
            'id' => 'copy-interval-form',
            'options' => [
                'data-pjax' => true,
            ],
        ]); ?>

        <div class="col-md-12">
            <?= $form->field($model, 'question')->textarea(['rows' => 3]) ?>
        </div>

        <div class="col-md-12"><?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?></div>


        <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>

<?php Modal::end(); ?>