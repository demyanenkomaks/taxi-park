<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Редактирование доступа пользователю ';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (!empty($model->login) ? $model->login : $model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->widget(Select2::class,[
        'data' => [10 => 'Доступ открыт', 0 => 'Доступ закрыт'],
        'options' => [
            'placeholder' => '',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($authassignment, 'item_name')->widget(Select2::class,[
        'data' => $authassignment->rolList,
        'options' => [
            'placeholder' => '',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Роль') ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
