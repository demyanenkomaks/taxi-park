<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование данных о работе в Яндекс такси';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'ya-id']); ?>

        <?= $this->render('_forms/ya', ['models_ya' => $models_ya, 'form' => $form]) ?>

        <div class="form-group col-md-6">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>