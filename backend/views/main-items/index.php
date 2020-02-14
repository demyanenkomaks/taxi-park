<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MainItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if ($identifier == 1) {
    $this->title = 'Слайдер';
} elseif($identifier == 2) {
    $this->title = 'О нас и наших услугах';
} elseif($identifier == 3) {
    $this->title = 'Условия работы';
} elseif($identifier == 4) {
    $this->title = 'О финансах';
} elseif($identifier == 5) {
    $this->title = 'Причины отключения';
} else {
    $this->title = '';
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create?identifier=' . $identifier], ['class' => 'btn btn-success']) ?>
    </p>

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

            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
