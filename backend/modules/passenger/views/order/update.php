<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserOrder */

$this->title = 'Редактирование заказа: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_driver' => $model_driver,
    ]) ?>

</div>
