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

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true])->label('Город в котором планируете работать') ?>

    <?= $form->field($model, 'cart_num')->widget(MaskedInput::class, [
        'mask' => '9999 9999 9999 9999',
    ])->label('Номер карты для зачисления оплаты') ?>

    <div class="form-group col-md-6">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>