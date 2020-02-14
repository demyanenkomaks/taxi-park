<?php

use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<div class="user-form row">

    <div class="col-md-12">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-12">
            <?= $form->field($model, 'cart_bank')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'cart_num')->widget(MaskedInput::class, [
                'mask' => '9999 9999 9999 9999',
            ]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'cart_fio')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <?= $form->field($model, 'cart_month')->widget(Select2::class,[
                    'data' => $model->monthArray,
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'cart_year')->widget(MaskedInput::class, [
                    'mask' => '9999',
                ]) ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'cart_file_lic')->widget(FileInput::class,[
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ]
                ]) ?>
            </div>
            <div class="col-md-6 pad-md-top-25"><?= $model->fileCartUpdate?></div>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'cart_other')->textarea(['rows' => 2]) ?>
        </div>

        <div class="form-group col-md-6">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>