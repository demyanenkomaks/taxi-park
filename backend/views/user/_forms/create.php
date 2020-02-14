<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form row">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <div class="col-md-3">
            <?= $form->field($model, 'username')
                ->widget(MaskedInput::class, [
                    'mask' => '+9 (999) 999-99-99',
                    'options' => [
                        'class' => 'form-control lg-round',
                    ]
                ]) ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-3"><?= $form->field($model, 'password_hash')->passwordInput() ?></div>
    </div>


    <div class="form-group col-md-12 pad-top-15">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
