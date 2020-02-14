<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование данных об автомобилях';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (!empty($model->login) ? $model->login : $model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'cars-id']); ?>

            <?= $this->render('_forms/cars', ['models_car' => $models_car, 'form' => $form]) ?>

            <div class="form-group col-md-6">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>