<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MainItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->identifier == 1):?>
        <?= (!$model->isNewRecord && !empty($model->img)) ? '<a href="/images/slide/' . $model->img . '" target="_blank"><span class="label label-success">Просмотреть</span></a>' : ''?>
        <?= $form->field($model, 'file')->fileInput() ?>
    <?php endif;?>

    <?php if (in_array($model->identifier, [2, 3, 4, 5])):?>
        <p>Название иконок можно посмтреть <a href="http://docteur-abrar.com/wp-content/themes/thunder/admin/stroke-gap-icons/" target="_blank">Stroke Gap Icons</a></p>
        <?= $form->field($model, 'icon')->textInput() ?>
    <?php endif;?>

    <?= $form->field($model, 'name')->textarea(['rows' => 2]) ?>

    <?php if (in_array($model->identifier, [1, 2])):?>
        <?= $form->field($model, 'text')->textarea(['rows' => 4]) ?>
    <?php endif;?>

    <?php if (in_array($model->identifier, [2])):?>
        <?= $form->field($model, 'url')->textInput() ?>
    <?php endif;?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
