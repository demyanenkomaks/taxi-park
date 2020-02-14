<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserRoutes */

$this->title = 'Добавление адреса';
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-routes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
