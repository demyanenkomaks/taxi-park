<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */

$this->title = 'Добавить вопрос';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
