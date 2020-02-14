<?php

use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'prava_num')->textInput(['maxlength' => true, 'class' => 'form-control mask-prava-num']) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'prava_date')->widget(DatePicker::class, [
                'language' => 'ru',
                'options' => [
                    'value' => !empty($model->prava_date) ? Yii::$app->formatter->asDate($model->prava_date, 'php:d.m.Y') : null,
                    'placeholder' => ''
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy',
                ]
            ]); ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'prava_cat')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_prava_1')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePrava1Update?></div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_prava_2')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePrava2Update ?></div>
    </div>


    <div class="col-md-12 pad-sm-top-15">
        <div class="form-group col-md-6">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>