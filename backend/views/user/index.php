<?php


use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

//    [
//        'attribute' => 'login',
//        'contentOptions' => ['class' => 'normal']
//    ],
    [
        'attribute' => 'username',
        'format' => 'raw',
        'value' => 'usernameIndex',
        'contentOptions' => ['class' => 'normal']
    ],
    [
        'attribute' => 'fio',
        'contentOptions' => ['class' => 'normal']
    ],
    [
        'attribute' => 'city',
        'contentOptions' => ['class' => 'normal']
    ],
];
if (!Yii::$app->user->can('Модератор HR')) {
    $gridColumns[] = [
        'attribute' => 'updated_at',
        'contentOptions' => ['class' => 'normal'],
        'format' => 'date'
    ];
    $gridColumns[] = [
        'attribute' => 'update_user',
        'value' => 'updateUserName',
        'contentOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ];
    $gridColumns[] = [
        'attribute' => 'hr_id',
        'format' => 'raw',
        'value' => 'hrUserName',
        'contentOptions' => ['class' => 'normal'],
    ];
}

if (Yii::$app->user->can('Модератор HR')) {
    $gridColumns[] = [
        'attribute' => 't_paid',
        'format' => 'raw',
        'value' => 'paidIndex',
        'contentOptions' => ['class' => 'normal'],
    ];
    $gridColumns[] = [
        'attribute' => 'hr_id',
        'value' => function ($model) {
            return !empty($model->hr_id) ? '<span class="badge">Я</span>' : '';
        },
        'label' => 'Модерирую',
        'format' => 'raw',
        'contentOptions' => ['class' => 'normal'],
    ];
}

$gridColumns[] = [
    'attribute' => 'mod_ident',
    'value' => function ($model) {
        if ($model->mod_ident === 1) {
            return '<span class="label label-success">Готов сотрудничать</span>';
        } elseif ($model->mod_ident === 2) {
            return '<span class="label label-danger">Отказался</span>';
        } elseif ($model->mod_ident === 3) {
            return '<span class="label label-info">Перезвонить</span>';
        } else {
            return '';
        }
    },
    'format' => 'raw',
    'contentOptions' => ['class' => 'normal'],
];
$gridColumns[] = [
    'attribute' => 'mod_comment',
    'value' => function ($model) {
        return !empty($model->mod_comment) ? $model->mod_comment : '';
    },
    'contentOptions' => ['class' => 'normal']
];
$gridColumns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view} {delete}',
    'visibleButtons' => [
        'delete' => function ($model, $key, $index) {
            return ($model->id != 1 && (Yii::$app->user->can('/user/delete') || Yii::$app->user->can('/user/*'))) ? true : false;
        }
    ]
];

?>
<div class="user-index row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="col-md-12">
        <?= Html::a('Добавить водителя', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-md-12 pad-top-15">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="col-md-12">
        <?= GridView::widget([
            'id' => 'kv-grid-demo',
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'containerOptions' => ['style' => 'overflow: auto'],
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'toolbar' =>  false,
//            'toolbar' =>  [
//                '{export}',
//                '{toggleData}',
//            ],
//            'export' => [
//                'fontAwesome' => true
//            ],
            'bordered' => true,
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading' => '
                    <i class="fa fa-users"></i>
                    <span class="label bg-success col-black mar-5">Подтвержденный</span>
                    <span class="label bg-danger col-black mar-5">Не подтвержденный</span>
                    <span class="label bg-warning col-black mar-5">Нужна помощь</span>
                    <span class="label bg-white col-black mar-5">Пассажир</span>
                    <span class="label bg-secondary col-black mar-5">Проверенный</span>
                    <span class="label bg-info-user col-black mar-5">Модератор HR</span>
                    <span class="label bg-primary-user col-black mar-5">Модератор HR не подтвержденный</span>
                    ',
            ],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
//            'exportConfig' => [
//                GridView::EXCEL => [
//                    'iconOptions' => ['class' => 'text-success'],
//                    'filename' => 'Выгрузка пользователей EXCEL',
//                    'alertMsg' => 'Файл экспорта EXCEL будет создан для загрузки.',
//                    'config' => [
//                        'worksheet' => 'Пользователи',
//                    ]
//                ],
//            ],
            'itemLabelSingle' => 'Пользователь',
            'itemLabelPlural' => 'Пользователя',
            'rowOptions' => function ($model, $key, $index, $grid) {
                if ($model->identifier == 1) {
                    return ['class' => 'bg-success'];
                } elseif ($model->identifier == 0) {
                    return ['class' => 'bg-danger'];
                } elseif ($model->identifier == 3) {
                    return ['class' => 'bg-warning'];
                } elseif ($model->identifier == 4) {
                    return ['class' => 'bg-secondary'];
                } elseif ($model->identifier == 5) {
                    return ['class' => 'bg-info-user'];
                } elseif ($model->identifier == 6) {
                    return ['class' => 'bg-primary-user'];
                }
        }
        ]); ?>
    </div>
</div>
