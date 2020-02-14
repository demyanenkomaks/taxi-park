<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Помощь в заполнении Профиля';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="user-update row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Вам необходимо загрузить все скан-копии или фото документов, а помощник заполнит данные Профиля по загруженным Вами документам.</p>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'form-assistant']); ?>

    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_1')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите 1 страницу паспорта') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas1Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_2')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите 2 страницу паспорта') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas2Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_pas_3')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите страницу с пропиской') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePas3Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_prava_1')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите 1 сторону водительского удостоверения') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePrava1Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'files_prava_2')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите 2 сторону водительского удостоверения') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->filePrava2Update?></div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <?= $form->field($model, 'cart_file_lic')->widget(FileInput::class,[
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ])->label('Загрузите Лицевую сторону банковской карты') ?>
        </div>
        <div class="col-md-6 pad-md-top-25"><?= $model->fileCartUpdate?></div>
    </div>

    <div class="col-md-12 pad-sm-top-15">
        <?= $this->render('_forms/assist_cars', ['models_car' => $models_car, 'form' => $form]) ?>
    </div>


    <div class="col-md-12 pad-sm-top-15">
        <div class="form-group col-md-6">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-lg btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>