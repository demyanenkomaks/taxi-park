<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaqAutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="faq-auto-index">

    <?php if (Yii::$app->user->can('/faq/create-auto') || Yii::$app->user->can('/faq/*')): ?>
        <p>
            <?= Html::a('Добавить Автомобиль', ['create-auto'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'auto',
                'format' => 'ntext',
                'contentOptions' => ['class' => 'normal']
            ],
            [
                'attribute' => 'economy',
                'filter' => false
            ],
            [
                'attribute' => 'comfort',
                'filter' => false
            ],
            [
                'attribute' => 'comfort_plus',
                'filter' => false
            ],
            [
                'attribute' => 'business',
                'filter' => false
            ],
            [
                'attribute' => 'premium',
                'filter' => false
            ],
            [
                'attribute' => 'minivan',
                'filter' => false
            ],
            [
                'attribute' => 'child',
                'filter' => false
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => function () {
                        return (Yii::$app->user->can('/faq/update-auto') || Yii::$app->user->can('/faq/*')) ? true : false;
                    },
                    'delete' => function () {
                        return (Yii::$app->user->can('/faq/delete-auto') || Yii::$app->user->can('/faq/*')) ? true : false;
                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('', ['/faq/update-auto', 'id' => $model->id], ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', ['/faq/delete-auto', 'id' => $model->id], [
                                'class'        => 'glyphicon glyphicon-trash',
                                'title'        => 'delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method'  => 'post',
                            ]);
                    }
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
