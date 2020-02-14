<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\passenger\models\UserRoutes */

$this->title = 'Просмотр адреса: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

//$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=6184a83f-ef22-4395-aa37-dd9e94c60deb',['position' => yii\web\View::POS_END]);
$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU',['position' => yii\web\View::POS_END]);
$this->registerJsFile('/personal/js/routes/view.js',['position' => yii\web\View::POS_END]);
?>

<div class="user-routes-view row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Добавить еще', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <input type="hidden" id="userroutes-latitude" value="<?= $model->latitude ?>">
    <input type="hidden" id="userroutes-longitude" value="<?= $model->longitude ?>">
    <input type="hidden" id="userroutes-address" value="<?= $model->address ?>">
    <input type="hidden" id="userroutes-name" value="<?= $model->name ?>">
    <div id="map" class="col-md-12" style="height: 400px;"></div>

</div>
