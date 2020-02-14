<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MainItems */

if ($model->identifier == 1) {
    $title = 'Слайдер';
} elseif($model->identifier == 2) {
    $title = 'О нас и наших услугах';
} elseif($model->identifier == 3) {
    $title = 'Условия работы';
} elseif($model->identifier == 4) {
    $title = 'О финансах';
} elseif($model->identifier == 5) {
    $title = 'Причины отключения';
} else {
    $title = '';
}

$this->title = 'Добавить пункт ' . $title;
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index?identifier=' . $model->identifier]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
