<?php
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h2>Отправить сообщение водителю</h2>',
    'toggleButton' => [
        'label' => '<i class="glyphicon glyphicon-remove"></i> Сообщение водителю',
        'tag' => 'button',
        'class' => 'btn btn-info btn-lg btn-block',
    ],
]);
?>
<?php $form = ActiveForm::begin(['id' => 'message-form']); ?>


<?= $form->field($model, 'message')->textarea(['rows' => 4])->label('Краткое описание недостающих данных предоставленных водителем') ?>

<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>