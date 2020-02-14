<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;

Modal::begin([
    'header'=>'<h4>Авторизация</h4>',
    'id'=>'login-modal',
]);
?>

    <p>Для входа в систему вам необходимо авторизироваться</p>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-login'],
]);
echo $form->field($model, 'username')->widget(MaskedInput::class, [
        'mask' => '+9 (999) 999-99-99',
        'options' => [
            'class' => 'form-control',
            'required' => true,
        ]
    ])->label('Телефон');
echo $form->field($model, 'password')->passwordInput()->label('Пароль');
echo $form->field($model, 'rememberMe')->checkbox()->label('Запомнить');
?>

    <div class="form-group">
        <div class="text-right">

            <?= Html::submitButton('Войти', ['class' => 'btn btn-warning', 'name' => 'login-button']);?>

        </div>
    </div>

<?php
ActiveForm::end();
Modal::end();