<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
if ($model->identifier == 5) {
    $confirmation = '<span class="label label-info">Модератор HR</span>';
} elseif ($model->identifier == 6) {
    $confirmation = '<span class="label label-danger">Модератор HR не подтвержденный</span>';
}

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
        'attribute' => 'email',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'city',
        'label' => 'Город в котором планируете работать',
        'labelColOptions' => ['class' => 'normal'],
    ],
    [
        'attribute' => 'cart_num',
        'label' => 'Номер карты для зачисления оплаты',
        'format' => 'raw',
        'value' => $model->cart_num ? '<span class="mask-cart-bank">' . $model->cart_num . '</span>' : null,
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
];
?>

<div class="user-view row">
    <div class="col-md-12">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $confirmation?>
        </div>
    </div>

    <?php if ((Yii::$app->user->can('Администратор') || Yii::$app->user->can('разработчик')) && $model->identifier != 5 ):?>
        <div class="col-md-12 pad-top-15">
            <div class="col-md-6">
                <?= Html::a('<i class="glyphicon glyphicon-ok"></i> Подтвердить профиль Модератора HR', ['/user/confirmation-moderator-hr', 'id' => $model->id], ['class'=>'btn btn-success btn-lg active', 'data-confirm' => 'Вы действительно хотите подтвердить Модератора?']);?>
            </div>
        </div>
    <?php endif;?>

    <div class="col-md-12 pad-top-15">
        <div class="col-md-6">
            <?php if (!empty($model->urlUpload)): ?>
                <img src="<?= Url::to(['/avatar/' . $model->id . '/' . $model->urlUpload])?>" alt="avatar">
            <?php else: ?>
                <span class="label label-danger">Аватар пользователя не загружен</span>
            <?php endif;?>
        </div>
        <div class="col-md-6">
            <?php if (Yii::$app->user->can('Администратор') || Yii::$app->user->can('разработчик')):?>
                <div class="col-md-12 pad-bot-25">
                    <?= $this->render('modal-form/count-driver', ['model_count_driver' => $model_count_driver]) ?>
                </div>
            <?php endif;?>

            <div class="col-md-12">
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
                        'heading' => '<i class="glyphicon glyphicon-user"></i> Основные данные ',
                    ],
                    'tooltips' => false,
                    'hideAlerts' => true,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>