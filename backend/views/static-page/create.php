<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StaticPage */

$this->title = 'Добавление статической страницы';
$this->params['breadcrumbs'][] = ['label' => 'Статические страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
