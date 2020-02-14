<?php
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h2>Добавление водителей для модерирования</h2>',
    'toggleButton' => [
        'label' => '<i class="fa fa-plus"></i> Добавить водителей',
        'tag' => 'button',
        'class' => 'btn btn-info btn-lg btn-block',
    ],
]);
?>
<?php $form = ActiveForm::begin(['id' => 'count-driver-form']); ?>


<?= $form->field($model_count_driver, 'count_driver')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>