<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StaticPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="static-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'kod')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
