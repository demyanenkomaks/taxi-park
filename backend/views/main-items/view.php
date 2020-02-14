<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MainItems */
if ($model->identifier == 1) {
    $title = 'Слайдер';

    $attributes = [
        [
            'attribute' => 'img',
            'value' => !empty($model->img) ? '<a href="/images/slide/' . $model->img . '" target="_blank"><span class="label label-success">Просмотреть</span></a>' : null,
            'format' => 'raw',
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => nl2br($model->name)
        ],
        [
            'attribute' => 'text',
            'format' => 'raw',
            'value' => nl2br($model->text)
        ]
    ];
} elseif($model->identifier == 2) {
    $title = 'О нас и наших услугах';

    $attributes = [
        [
            'attribute' => 'icon',
            'format' => 'raw',
            'value' => !empty($model->icon) ? '<span class="icon icon-' . $model->icon . '"></span>' : null
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => nl2br($model->name)
        ],
        [
            'attribute' => 'text',
            'format' => 'raw',
            'value' => nl2br($model->text)
        ],
        [
            'attribute' => 'url',
            'format' => 'raw',
            'value' => !empty($model->url) ? Html::a('Ссылка на страницу', '/site/static?url=' . $model->url, ['target' => '_blank']) : null
        ]
    ];
} elseif($model->identifier == 3) {
    $title = 'Условия работы';

    $attributes = [
        [
            'attribute' => 'icon',
            'format' => 'raw',
            'value' => !empty($model->icon) ? '<span class="icon icon-' . $model->icon . '"></span>' : null
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => nl2br($model->name)
        ],
    ];
} elseif($model->identifier == 4) {
    $title = 'О финансах';

    $attributes = [
        [
            'attribute' => 'icon',
            'format' => 'raw',
            'value' => !empty($model->icon) ? '<span class="icon icon-' . $model->icon . '"></span>' : null
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => nl2br($model->name)
        ],
    ];
} elseif($model->identifier == 5) {
    $title = 'Причины отключения';

    $attributes = [
        [
            'attribute' => 'icon',
            'format' => 'raw',
            'value' => !empty($model->icon) ? '<span class="icon icon-' . $model->icon . '"></span>' : null
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => nl2br($model->name)
        ],
    ];
} else {
    $title = '';

    $attributes = [];
}


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index?identifier=' . $model->identifier]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);



?>
<div class="main-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        'attributes' => $attributes,
    ]) ?>

</div>
