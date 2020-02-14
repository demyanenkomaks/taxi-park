<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserOrder */

$this->title = 'Просмотр заказа: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'start',
            'stop',
            'date:date',
            'time:time',
            'duration:time',
            [
                'attribute' => 'cost',
                'value' => function($data) {
                    return !empty($data->cost) ? $data->cost . ' рублей' : '';
                },
            ],
        ],
    ]) ?>

</div>
