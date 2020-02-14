<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \dpodium\yii2\widget\upload\crop\UploadCrop;

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;

$confirmation = $model->identifier === 1
    ? '<span class="label label-success normal">Вы подтверждены в программе</span>'
    : '<span class="label label-danger normal">Вы не подтверждены в программе (ваши данные еще проверяются)</span>';

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
    [
        'attribute' => 'phone_driver',
        'labelColOptions' => ['class' => 'normal'],
        'valueColOptions' => ['class' => 'mask-phone'],
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
        'value' => $model->filePas3View,
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
        'attribute' => 'lajtboksName',
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
        'attribute' => 'brendName',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'licTaxi',
        'labelColOptions' => ['class' => 'normal'],
        'format' => 'raw',
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
        'attribute' => 'cart_fio',
        'labelColOptions' => ['class'=>'normal'],
        'format' => 'raw',
    ],
    [
        'attribute' => 'cartDate',
        'labelColOptions' => ['class'=>'normal'],
        'format' => 'raw',
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

?>
<div class="user-view row">
    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $confirmation?>
    </div>
    <?php if (!empty($model->message)):?>
        <div class="col-md-15 pad-top-15">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <?= $model->message; ?>
            </div>
        </div>
    <?php endif;?>
    <div class="col-md-12 pad-top-15">
        <div class="col-md-6">
            <p class="text-size-12">Заполняя эти формы я передаю сведения о себе, автомобиле, данные для перевода денег из таксометра, мой опыт работы в таксопарках и пр. Этим заявляю о желании работать через сервис Яндекс такси My Way Санкт-Петербург. Принимаю условия перечисленные на главной странице сервиса My Way.</p>
            <p class="text-size-12"><?= Html::a('Мой выход на линию в парке My Way означает принятие оферты парка и действует до прекращения моей регистрации учетной записи в таксометре с парком My Way', ['/documents/offer.pdf'], ['target'=>'_blank']);?></p>
        </div>
        <div class="col-md-6">
            <?= Html::a('<i class="fa fa-check-square-o"></i> Сменить пароль', ['/cabinet/change-password'], ['class'=>'btn btn-primary btn-lg normal']);?>
        </div>
    </div>
    <?php if ($model->getAssistantCheckButton() == false):?>
    <div class="col-md-12">
        <div class="col-md-6 margin-t-b-25">
            <div class="col-md-6">
                <?= Html::a('Помощь в заполнении Профиля', ['/cabinet/assistant'], ['class'=>'btn btn-warning btn-lg btn-animation btn-block normal']);?>
            </div>
            <div class="col-md-6 pad-top-15">
                <p>Если вы не можете сами заполнить Профиль воспользуйтесь помощью</p>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="col-md-12">
        <div class="col-md-6">
            <h2>Аватарка</h2>
            <p>Для изменения аватарки нажмите на нее.</p>
            <div class="col-md-4">
                <?php $form = ActiveForm::begin(); ?>
                <?php echo UploadCrop::widget(
                    [
                        'form' => $form,
                        'model' => $model,
                        'attribute' => 'urlUpload',
                        'maxSize' => 300,
                        'imageSrc' => !empty($model->urlUpload) ? Url::to(['/avatar/' . Yii::$app->user->identity->id . '/' . $model->urlUpload]) :  '',
                        'title' => 'Выберите область для персональной картинки',
                        'changePhotoTitle' => 'Изменить картинку',
                        'jcropOptions' => [
                            'dragMode' => 'move',
                            'viewMode' => 1,
                            'autoCropArea' => '0.1',
                            'restore' => false,
                            'guides' => false,
                            'center' => false,
                            'movable' => true,
                            'highlight' => false,
                            'cropBoxMovable' => false,
                            'cropBoxResizable' => false,
                            'background' => false,
                            'minContainerHeight' => 500,
                            'minCanvasHeight' => 400,
                            'minCropBoxWidth' => 200,
                            'minCropBoxHeight' => 200,
                            'responsive' => true,
                            'toggleDragModeOnDblclick' => false
                        ],
                    ]
                ); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-md-6">
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
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Основные данные ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/update', 'form' => 'data'], ['class'=>'pull-right']),
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
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Паспортные данные ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/update', 'form' => 'passport'], ['class'=>'pull-right']),
                    'footer' => $model->checkPassportFile == false ? '<span class="label label-danger normal">Загрузите фото или скан копии паспорта</span>' : '',
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
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Банковские данные ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/update', 'form' => 'cart'], ['class'=>'pull-right']),
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
                        'heading' => '<i class="glyphicon glyphicon-user"></i> Водительское удостоверение ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/update', 'form' => 'prava'], ['class'=>'pull-right']),
                        'footer' => $model->checkPravaFile == false ? '<span class="label label-danger normal">Загрузите фото или скан копии водителького удостоверения обеих сторон</span>' : '',
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
                                'heading' => '<i class="glyphicon glyphicon-user"></i> Автомобиль ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/cars'], ['class'=>'pull-right']),
                                'footer' => $car->checkCarsFile == false ? '<span class="label label-danger normal">Загрузите фото или скан копии СТС обеих сторон</span>' : ''
                            ],
                            'tooltips' => false,
                            'hideAlerts' => true,
                        ]);
                    }
                } else {
                    echo Html::a('Добавить автомобиль',['/cabinet/cars'], ['class' => 'btn btn-primary']);
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
                                'heading' => '<i class="glyphicon glyphicon-user"></i> Опыт работы в таксопарке Яндекс такси ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/ya'], ['class'=>'pull-right']),
                            ],
                            'tooltips' => false,
                            'hideAlerts' => true,
                        ]);
                    }
                } else {
                    echo Html::a('Добавить опыт работы в<br>таксопарке Яндекс такси',['/cabinet/ya'], ['class' => 'btn btn-primary']);
                }
                ?>
            </div>
        </div>
    </div>
</div>
