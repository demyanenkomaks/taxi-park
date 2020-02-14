<?php

use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h2>Оставить комментарий обзвона</h2>',
    'toggleButton' => [
        'label' => '<i class="fa fa-comment"></i> Комментарий обзвона',
        'tag' => 'button',
        'class' => 'btn btn-warning btn-lg btn-block',
    ],
]);
?>
<?php $form = ActiveForm::begin(['id' => 'coment-form']); ?>

<?= $form->field($model, 'mod_ident')->widget(Select2::class,[
    'data' => [1 => 'Готов сотрудничать', 2 => 'Отказался', 3 => 'Перезвонить'],
    'options' => [
        'placeholder' => '',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>

<?= $form->field($model, 'mod_comment')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'contact-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>