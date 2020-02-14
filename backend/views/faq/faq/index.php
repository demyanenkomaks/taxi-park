<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="faq-index">

    <?php if (Yii::$app->user->can('/faq/create') || Yii::$app->user->can('/faq/*')): ?>
    <p>
        <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'question',
                'format' => 'ntext',
                'contentOptions' => ['class' => 'normal'],
                'headerOptions' => ['style' => 'width: 20%']
            ],
            [
                'attribute' => 'answer',
                'format' => 'html',
                'contentOptions' => ['class' => 'normal']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => function () {
                        return (Yii::$app->user->can('/faq/update') || Yii::$app->user->can('/faq/*')) ? true : false;
                    },
                    'delete' => function () {
                        return (Yii::$app->user->can('/faq/delete') || Yii::$app->user->can('/faq/*')) ? true : false;
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
