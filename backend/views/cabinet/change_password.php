<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update">

    <div class="col-md-6">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'data-pjax' => true,
            ],
        ]); ?>

        <?= $form->field($model, 'last_password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'verifying_password')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>

    </div>
</div>
