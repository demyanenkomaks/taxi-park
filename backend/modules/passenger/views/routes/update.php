<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserRoutes */

$this->title = 'Редактирование адреса: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Адрес', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-routes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
