<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaqPhoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="faq-phone-index">

    <?php if (Yii::$app->user->can('/faq/create-phone') || Yii::$app->user->can('/faq/*')): ?>
        <p>
            <?= Html::a('Добавить Смартфон', ['create-phone'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'mark',
                'format' => 'ntext',
                'contentOptions' => ['class' => 'normal']
            ],
            [
                'attribute' => 'model',
                'format' => 'html',
                'contentOptions' => ['class' => 'normal']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => function () {
                        return (Yii::$app->user->can('/faq/update-phone') || Yii::$app->user->can('/faq/*')) ? true : false;
                    },
                    'delete' => function () {
                        return (Yii::$app->user->can('/faq/delete-phone') || Yii::$app->user->can('/faq/*')) ? true : false;
                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('', ['/faq/update-phone', 'id' => $model->id], ['class' => 'glyphicon glyphicon-pencil']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', ['/faq/delete-phone', 'id' => $model->id], [
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
