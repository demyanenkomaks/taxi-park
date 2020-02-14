<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserRoutes */
/* @var $form yii\widgets\ActiveForm */

//$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=6184a83f-ef22-4395-aa37-dd9e94c60deb',['position' => yii\web\View::POS_END]);
$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU',['position' => yii\web\View::POS_END]);
$this->registerJsFile('/personal/js/routes/form.js',['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="user-routes-form row">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <div class="col-md-12">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'latitude')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'longitude')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'address')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'search')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>


    <div id="map" class="col-md-12" style="height: 400px;"></div>



    <div class="form-group col-md-12 pad-top-15">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'form' => 'form']) ?>
    </div>

</div>
