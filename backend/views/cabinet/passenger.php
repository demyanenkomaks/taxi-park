<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \dpodium\yii2\widget\upload\crop\UploadCrop;

$this->title = 'Профиль';
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
?>

<div class="user-view row">
    <div class="col-md-12">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <h2>Аватарка</h2>
            <p>Для изменения аватарки нажмите на нее.</p>
            <div class="col-lg-6 col-md-8">
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
                    'heading' => '<i class="glyphicon glyphicon-user"></i> Основные данные ' . Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['/cabinet/update', 'form' => 'passenger'], ['class'=>'pull-right']),
                ],
                'tooltips' => false,
                'hideAlerts' => true,
            ]);
            ?>
        </div>
    </div>
</div>