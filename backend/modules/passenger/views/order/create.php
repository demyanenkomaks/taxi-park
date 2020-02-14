<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserOrder */

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_driver' => $model_driver,
    ]) ?>

</div>
