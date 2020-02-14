<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_o')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'form-control mask-phone', 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_driver')->widget(MaskedInput::class, [
        'mask' => '+9 (999) 999-99-99',
    ]) ?>

    <div class="form-group col-md-6">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>