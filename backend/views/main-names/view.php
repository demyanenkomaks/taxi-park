<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MainNames */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пункты на главной', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="main-names-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
