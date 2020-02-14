<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'latitude_start') ?>

    <?= $form->field($model, 'longitude_start') ?>

    <?= $form->field($model, 'latitude_stop') ?>

    <?php // echo $form->field($model, 'longitude_stop') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
