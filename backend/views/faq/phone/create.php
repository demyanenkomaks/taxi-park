<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqPhone */

$this->title = 'Добавление смартфона';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-phone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
