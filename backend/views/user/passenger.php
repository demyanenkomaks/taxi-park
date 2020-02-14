<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = !empty($model->login) ? $model->login : $model->username;

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes_data = [
    [
        'attribute' => 'login',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'fio',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'username',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'mask-phone'],
    ],
    [
        'attribute' => 'city',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'phone_driver',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'mask-phone'],
    ],
];
$attributes_info_user = [
    [
        'attribute' => 'created_at',
        'format' => 'datetime',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'updated_at',
        'format' => 'datetime',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'update_user',
        'value' => $model->updateUserName,
        'format' => 'raw',
        'contentOptions' => ['class' => 'normal'],

    ],
];
?>
<div class="user-view row">
    <div class="col-md-12">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="label bg-white col-black">Пассажир</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?php if (!empty($model->urlUpload)): ?>
                <img src="<?= Url::to(['/avatar/' . $model->id . '/' . $model->urlUpload])?>" alt="avatar">
            <?php else: ?>
                <span class="label label-danger">Аватар пользователя не загружен</span>
            <?php endif;?>
        </div>
        <div class="col-md-6">
            <?php if (Yii::$app->user->can('Администратор') || Yii::$app->user->can('разработчик')):?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => $attributes_info_user,
                    'enableEditMode' => false,
                    'mode' => 'view',
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => true,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => 'primary',
                        'align' => 'right',
                        'heading' => '<i class="glyphicon glyphicon-user"></i> Информация модерирования',
                    ],
                    'tooltips' => false,
                    'hideAlerts' => true,
                ]);
                ?>
            <?php endif;?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => $attributes_data,
                'enableEditMode' => false,
                'mode' => 'view',
                'bordered' => true,
                'striped' => false,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                'panel' => [
                    'type' => 'primary',
                    'align' => 'right',
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Основные данные',
                ],
                'tooltips' => false,
                'hideAlerts' => true,
            ]);
            ?>
        </div>
    </div>
</div>
