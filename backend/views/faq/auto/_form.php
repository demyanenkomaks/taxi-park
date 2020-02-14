<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqAuto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-auto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'auto')->textInput() ?>

    <?= $form->field($model, 'economy')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'comfort')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'comfort_plus')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'business')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'premium')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'minivan')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <?= $form->field($model, 'child')->widget(MaskedInput::class, [
        'mask' => '9999',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
