<?php

use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="user-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_1')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas1Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_2')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas2Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_3')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas3Update?></div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_num')->textInput(['maxlength' => true, 'class' => 'form-control mask-prava-num']) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_f')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_i')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_o')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model,'p_sex')->radioList(['1' => 'Женский', '0' => 'Мужской']);?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_date_birth')->widget(DatePicker::class, [
                'language' => 'ru',
                'options' => [
                    'value' => !empty($model->p_date_birth) ? Yii::$app->formatter->asDate($model->p_date_birth, 'php:d.m.Y') : null,
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
            <?= $form->field($model, 'p_date_vydachi')->widget(DatePicker::class, [
                'language' => 'ru',
                'options' => [
                    'value' => !empty($model->p_date_vydachi) ? Yii::$app->formatter->asDate($model->p_date_vydachi, 'php:d.m.Y') : null,
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
            <?= $form->field($model, 'p_code_unit')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <h3>Прописка</h3>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_date')->widget(DatePicker::class, [
                'language' => 'ru',
                'options' => [
                    'value' => !empty($model->p_p_date) ? Yii::$app->formatter->asDate($model->p_p_date, 'php:d.m.Y') : null,
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
            <?= $form->field($model, 'p_p_region')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_point')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_yl')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_dom')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_korp')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_kvart')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'p_p_registered')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="col-md-12 pad-sm-top-15">
        <div class="form-group col-md-6">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>