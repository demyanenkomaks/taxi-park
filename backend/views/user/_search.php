<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search row">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-md-12">
        <div class="col-md-2"><?= $form->field($model, 'login') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'username')->widget(MaskedInput::class, [
                'mask' => '+9 (999) 999-99-99',
            ])?></div>
        <div class="col-md-2"><?= $form->field($model, 'p_f') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'p_i') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'p_o') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'city') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'identifier')->widget(Select2::class,[
                'data' => [
                    2 => 'Пассажиры',
                    1 => 'Подтвржденные',
                    0 => 'Не подтвржденные',
                    3 => 'Нужна помощь',
                    4 => 'Проверенные',
                    5 => 'Модератор HR',
                    6 => 'Модератор HR не подтвержденный',
                ],
                'options' => [
                    'placeholder' => '',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-2"><?= $form->field($model, 'mod_ident')->widget(Select2::class,[
                'data' => [
                    1 => 'Готов сотрудничать',
                    2 => 'Отказался',
                    3 => 'Перезвонить'
                ],
                'options' => [
                    'placeholder' => '',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group col-md-12">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
