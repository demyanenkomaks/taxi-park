<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = !empty($model->login) ? $model->login : $model->username;
if ($model->identifier == 0) {
    $confirmation = '<span class="label label-danger">Водитель не подтвержден</span>';
} elseif ($model->identifier == 1) {
    $confirmation = '<span class="label label-success">Водитель подтвержден</span>';
} elseif ($model->identifier == 3) {
    $confirmation = '<span class="label label-warning">Водителю нужна помощь в заполнении</span>';
} elseif ($model->identifier == 4) {
    $confirmation = '<span class="label label-default">Водитель проверенный</span>';
}

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes_data = [
    [
        'attribute' => 'login',
        'labelColOptions' => ['class' => 'normal'],
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
        'attribute' => 'skill_taxi',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'hitched',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
        'value' => $model->hitched ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
    ],
    [
        'attribute' => 'children',
        'format' => 'raw',
        'value' => $model->childrenName,
        'labelColOptions' => ['class'=>'normal'],
    ],
    [
        'attribute' => 'citizenship',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'park_name',
        'labelColOptions' => ['class' => 'normal'],
    ],
];
$attributes_passport = [
    [
        'attribute' => 'p_num',
        'format' => 'raw',
        'value' => $model->p_num ? '<span class="mask-prava-num">' . $model->p_num . '</span>' : null,
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'fio',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_sex',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
        'value' => isset($model->p_sex) ? $model->p_sex  ? '<span class="label label-warning">Женский</span>' : '<span class="label label-primary">Мужской</span>' : '',
    ],
    [
        'attribute' => 'p_date_birth',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'date',
    ],
    [
        'attribute' => 'p_date_vydachi',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'date',
    ],
    [
        'attribute' => 'p_code_unit',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'group' => true,
        'label' => 'Прописка',
        'rowOptions' => ['class' => 'bg-info']
    ],
    [
        'attribute' => 'p_p_date',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'date',
    ],
    [
        'attribute' => 'p_p_region',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_point',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_yl',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_dom',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_korp',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_kvart',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'p_p_registered',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'files_pas_1',
        'value' => $model->filePas1View,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'files_pas_2',
        'value' => $model->filePas2View,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'files_pas_3',
        'value' => $model->filePas3View,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
];
$attributes_prava = [
    [
        'attribute' => 'prava_num',
        'format' => 'raw',
        'value' => $model->prava_num ? '<span class="mask-prava-num">' . $model->prava_num . '</span>' : null,
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'prava_date',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'date',
    ],
    [
        'attribute' => 'prava_cat',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'files_prava_1',
        'value' => $model->filePrava1View,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'files_prava_2',
        'value' => $model->filePrava2View,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],

];
$attributes_car = [
    [
        'attribute' => 'carTc',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'mark',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'model',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'color',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'year',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'state_number',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'brendName',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'lajtboksName',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'licTaxi',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'file1View',
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'file2View',
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'rentName',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'owner',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'dopView',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'group' => true,
        'label' => 'Осаго',
        'rowOptions' => ['class' => 'bg-info']
    ],
    [
        'attribute' => 'os_num',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'os_date',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'date'
    ],
    [
        'attribute' => 'fileOsView',
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
];
$attributes_ya_taxi = [
    [
        'attribute' => 'workDate',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'name_park',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'city',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'phoneName',
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'rating',
        'labelColOptions' => ['class'=>'normal'],
    ],
    [
        'attribute' => 'yaRatingStabilityName',
        'format' => 'raw',
        'labelColOptions' => ['class'=>'normal'],
    ],
    [
        'attribute' => 'ratingYouName',
        'labelColOptions' => ['class'=>'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'note',
        'labelColOptions' => ['class'=>'normal'],
    ],
];
$attributes_cart = [
    [
        'attribute' => 'cart_bank',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'cart_num',
        'format' => 'raw',
        'value' => $model->cart_num ? '<span class="mask-cart-bank">' . $model->cart_num . '</span>' : null,
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'cart_file_lic',
        'value' => $model->fileCartView,
        'format' => 'raw',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'cart_other',
        'labelColOptions' => ['class' => 'normal'],
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
    [
        'attribute' => 'hr_id',
        'value' => $model->hrUserName,
        'format' => 'raw',
        'contentOptions' => ['class' => 'normal'],
    ]
];
?>
<div class="user-view row">

    <div class="col-md-12">
        <div class="col-md-12">
            <h1 class="<?= empty($model->login) ? 'mask-phone' : '' ?>"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <?php if ((Yii::$app->user->can('Администратор') || Yii::$app->user->can('разработчик')) && $model->identifier != 1):?>
                    <?= Html::a('<i class="glyphicon glyphicon-ok"></i> Подтвердить профиль водителя', ['/user/confirmation', 'id' => $model->id], ['class'=>'btn btn-success btn-lg active', 'data-confirm' => 'Вы действительно хотите подтвердить водителя?']);?>
                <?php endif;?>

                <h3 class="mask-phone"><?= $model->username ?></h3>
                <?= $confirmation?>
            </div>
        </div>
    </div>
    <div class="col-md-12 pad-top-15">
        <div class="col-md-6">
            <?php if (!empty($model->urlUpload)): ?>
                <img src="<?= Url::to(['/avatar/' . $model->id . '/' . $model->urlUpload])?>" alt="avatar">
            <?php else: ?>
                <span class="label label-danger">Аватар пользователя не загружен</span>
            <?php endif;?>
        </div>
        <div class="col-md-6 pad-sm-top-15">
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
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Основные данные ' . ($model->id != 1 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/update', 'id' => $model->id, 'form' => 'data'], ['class'=>'pull-right']) : ''),
                ],
                'tooltips' => false,
                'hideAlerts' => true,
            ]);
            ?>
        </div>
    </div>

    <div class="col-md-12">

        <div class="col-md-6">
            <?php
            echo DetailView::widget([
                'model' => $model,
                'attributes' => $attributes_passport,
                'enableEditMode' => false,
                'mode' => 'view',
                'bordered' => true,
                'striped' => false,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Паспортные данные ' . ($model->id != 1 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/update', 'id' => $model->id, 'form' => 'passport'], ['class'=>'pull-right']) : ''),
                    'footer' => $model->checkPassportFile == false ? '<span class="label label-danger">Не загружены фото или скан копии паспорта</span>' : '',
                ],
                'tooltips' => false,
                'hideAlerts' => true,
            ]);

            echo DetailView::widget([
                'model' => $model,
                'attributes' => $attributes_cart,
                'enableEditMode' => false,
                'mode' => 'view',
                'bordered' => true,
                'striped' => false,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'panel' => [
                    'type' => 'primary',
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Банковские данные ' . ($model->id != 1 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/update', 'id' => $model->id, 'form' => 'cart'], ['class'=>'pull-right']) : ''),
                ],
                'tooltips' => false,
                'hideAlerts' => true,
            ]);
            ?>
        </div>

        <div class="col-md-6">
            <div class="col-md-12">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => $attributes_prava,
                    'enableEditMode' => false,
                    'mode' => 'view',
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => true,
                    'responsive' => true,
                    'hover' => true,
                    'hAlign' => 'left',
                    'vAlign' => 'middle',
                    'panel' => [
                        'type' => 'primary',
                        'heading' => '<i class="glyphicon glyphicon-user"></i> Водительское удостоверение ' . ($model->id != 1 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/update', 'id' => $model->id, 'form' => 'prava'], ['class'=>'pull-right']) : ''),
                        'footer' => $model->checkPravaFile == false ? '<span class="label label-danger">Не загружены фото или скан копии водителького удостоверения</span>' : '',
                    ],
                    'tooltips' => false,
                    'hideAlerts' => true,
                ]);
                ?>
            </div>
            <div class="col-md-12">
                <?php
                if (!empty($model->cars0)) {
                    foreach ($model->cars0 as $car) {
                        echo DetailView::widget([
                            'model' => $car,
                            'attributes' => $attributes_car,
                            'enableEditMode' => false,
                            'mode' => 'view',
                            'bordered' => true,
                            'striped' => false,
                            'condensed' => true,
                            'responsive' => true,
                            'hover' => true,
                            'hAlign' => 'left',
                            'vAlign' => 'middle',
                            'panel' => [
                                'type' => 'primary',
                                'heading' => '<i class="glyphicon glyphicon-user"></i> Автомобиль ' . ($model->id != 1 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/user/cars', 'id' => $model->id], ['class'=>'pull-right']) : ''),
                                'footer' => $car->checkCarsFile == false ? '<span class="label label-danger">Не загружены фото или скан копии СТС</span>' : ''
                            ],
                            'tooltips' => false,
                            'hideAlerts' => true,
                        ]);
                    }
                } else {
                    if (Yii::$app->user->can('Модератор HR')) {
                        echo Html::a('Добавить автомобиль',['/user/cars', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    } else {
                        echo '<span class="label label-danger normal">Пользователь не добавил данные об автомобиле</span>';
                    }
                }
                ?>
            </div>
            <div class="col-md-12">
                <?php
                if (!empty($model->ya0)) {
                    foreach ($model->ya0 as $ya) {
                        echo DetailView::widget([
                            'model' => $ya,
                            'attributes' => $attributes_ya_taxi,
                            'enableEditMode' => false,
                            'mode' => 'view',
                            'bordered' => true,
                            'striped' => false,
                            'condensed' => true,
                            'responsive' => true,
                            'hover' => true,
                            'hAlign' => 'left',
                            'vAlign' => 'middle',
                            'panel' => [
                                'type' => 'primary',
                                'heading' => '<i class="glyphicon glyphicon-user"></i> Опыт работы в таксопарке Яндекс такси',
                            ],
                            'tooltips' => false,
                            'hideAlerts' => true,
                        ]);
                    }
                } else {
                    echo '<span class="label label-danger normal">Пользователь не добавил данные об опыте работы в таксопарке Яндекс такси</span>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 pad-top-15">
        <?php if (!in_array($model->identifier, [1, 4])):?>
            <div class="col-md-4">
                <?= $this->render('modal-form/message-driver', ['model' => $model]) ?>
            </div>
            <div class="col-md-4">
                <?= $this->render('modal-form/comment', ['model' => $model]) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('<i class="glyphicon glyphicon-ok"></i> Проверенный профиль водителя',['/user/tested', 'id' => $model->id], ['class' => 'btn btn-primary btn-lg btn-block active', 'data-confirm' => 'Вы действительно проверили водителя?']);?>
            </div>
        <?php endif;?>
    </div>

</div>
