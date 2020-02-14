<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Редактирование личных данных ';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (!empty($model->login) ? $model->login : $model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_forms/' . $form, [
        'model' => $model,
    ]) ?>

</div>
