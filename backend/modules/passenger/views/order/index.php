<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\passenger\models\UserOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Сделать заказ такси', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'start',
                'contentOptions' => ['class' => 'normal']
            ],
            [
                'attribute' => 'stop',
                'contentOptions' => ['class' => 'normal']
            ],
            'date:date',
            'time:time',
            [
                'attribute' => 'cost',
                'value' => function($data) {
                    return !empty($data->cost) ? $data->cost . ' рублей' : '';
                },
                'contentOptions' => ['class' => 'normal']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
