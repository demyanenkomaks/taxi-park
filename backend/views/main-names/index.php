<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MainNamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пункты на главной';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-names-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'contentOptions' => ['class' => 'normal'],
                'format' => 'raw',
                'value' => function($model) {
                    return nl2br($model->name);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
