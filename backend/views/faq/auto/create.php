<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqAuto */

$this->title = 'Добавить автомобиль';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-auto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
