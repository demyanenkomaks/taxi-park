<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MainNames */

$this->title = 'Create Main Names';
$this->params['breadcrumbs'][] = ['label' => 'Main Names', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-names-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
