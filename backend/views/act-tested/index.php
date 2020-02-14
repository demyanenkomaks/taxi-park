<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActTestedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обработка профилей';
$this->params['breadcrumbs'][] = $this->title;

$layout_dp ='
              <span class="input-group-addon">C</span>
             {input1}
             <span class="input-group-addon">по</span>
             {input2}
             <span class="input-group-addon kv-date-remove">
              <i class="glyphicon glyphicon-remove"></i>
             </span>';

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'attribute' => 'username',
        'format' => 'raw',
        'value' => 'usernameIndex',
        'contentOptions' => ['class' => 'normal']
    ],
    [
        'attribute' => 't_moderator',
        'format' => 'raw',
        'value' => 'moderName',
        'contentOptions' => ['class' => 'normal']
    ],
    [
        'attribute' => 't_d_t_mod',
        'format' => 'datetime',
        'filter' => DatePicker::widget([
            'model' => $searchModel,
            'layout' => $layout_dp,
            'attribute' => 't_d_t_mod[1]',
            'attribute2' => 't_d_t_mod[2]',
            'name'=>'t_d_t_mod[1]',
            'value' => 't_d_t_mod[1]',
            'separator' => 'по',
            'value2' => 't_d_t_mod[2]',
            'name2'=>'t_d_t_mod[2]',
            'type' => DatePicker::TYPE_RANGE,
            'pluginOptions' => ['autoclose'=>true,'format' => 'dd.mm.yyyy']
        ]),
        'headerOptions' => ['style' => 'width: 290px;'],
    ],
    [
        'attribute' => 't_admin',
        'format' => 'raw',
        'value' => 'adminName',
        'contentOptions' => ['class' => 'normal']
    ],
    [
        'attribute' => 't_d_t_adm',
        'format' => 'datetime',
        'filter' => DatePicker::widget([
            'model' => $searchModel,
            'layout' => $layout_dp,
            'attribute' => 't_d_t_adm[1]',
            'attribute2' => 't_d_t_adm[2]',
            'name'=>'t_d_t_adm[1]',
            'value' => 't_d_t_adm[1]',
            'separator' => 'по',
            'value2' => 't_d_t_adm[2]',
            'name2'=>'t_d_t_adm[2]',
            'type' => DatePicker::TYPE_RANGE,
            'pluginOptions' => ['autoclose'=>true,'format' => 'dd.mm.yyyy']
        ]),
        'headerOptions' => ['style' => 'width: 290px;'],
    ],
    [
        'attribute' => 't_paid',
        'format' => 'raw',
        'value' => 'paidIndex',
        'contentOptions' => ['class' => 'normal'],
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 't_paid',
            'data' => [0 => 'Не оплачено', 1 => 'Оплачено'],
            'options' => [
                'placeholder' => '',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]),
        'headerOptions' => ['style' => 'width: 150px;'],
    ],

    [
        'class' => 'yii\grid\CheckboxColumn',
        'checkboxOptions' => function($model) {
            return !empty($model->t_paid) ? ['value' => $model->id, 'disabled' => 'disabled'] : ['value' => $model->id];
        },
    ],
];

?>
<div class="act-tested-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::beginForm(['paid'],'post');?>

    <?= GridView::widget([
        'id' => 'kv-grid-demo',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="fa fa-users"></i> Обработка профилей',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'exportConfig' => [
            GridView::EXCEL => [
                'iconOptions' => ['class' => 'text-success'],
                'filename' => 'Отчет обработки профилей EXCEL',
                'alertMsg' => 'Файл экспорта EXCEL будет создан для загрузки.',
                'config' => [
                    'worksheet' => 'Пользователи',
                ]
            ],
        ],
        'itemLabelSingle' => 'Пользователь',
        'itemLabelPlural' => 'Пользователя',
    ]); ?>

    <?= Html::submitButton('Оплачено', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    <?= Html::endForm();?>

</div>
