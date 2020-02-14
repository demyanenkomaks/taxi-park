<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqPhone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-phone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mark')->textInput() ?>

    <?= $form->field($model, 'model')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'standard',
            'inline' => false,
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
