<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Главная страница';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="col-md-12">
        <?= Html::a('Профиль','cabinet', ['class' => 'btn btn-primary'])?>

    </div>
</div>
