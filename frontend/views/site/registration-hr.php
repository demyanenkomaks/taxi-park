<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = $model_page->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model_page->description,
], 'description');

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model_page->keywords,
], 'keywords');
?>
    <div class="site-login row  text-center">
        <div class="col-lg-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="col-lg-12">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
                <?= $model_page->kod?>
            </div>
            <div class="col-lg-3 newsletter-block">
                <div class="newsletter-form">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'p_f')->textInput(['autofocus' => true, 'class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'p_i')->textInput(['class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'p_o')->textInput(['class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'username')
                        ->widget(MaskedInput::class, [
                            'mask' => '+9 (999) 999-99-99',
                            'options' => [
                                'class' => 'form-control lg-round',
                            ]
                        ])
                    ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'city')->textInput(['class' => 'form-control lg-round']) ?>

                    <?= $form->field($model, 'cart_num')->widget(MaskedInput::class, [
                        'mask' => '9999 9999 9999 9999',
                        'options' => [
                            'class' => 'form-control lg-round',
                        ]
                    ]) ?>

                    <?= $form->field($model, 'checkPolicy')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary lg-round', 'style' => 'font-size: 14px;']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
<?php
