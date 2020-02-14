<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;

DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody'      => '.container-items', // required: css class selector
    'widgetItem'      => '.item', // required: css class
    'limit'           => 10, // the maximum times, an element can be cloned (default 999)
    'min'             => 1, // 0 or 1 (default 1)
    'insertButton'    => '.add-item' , // css class
    'deleteButton'    => '.remove-item', // css class
    'model'           => $models_ya[0],
    'formId'          => 'ya-id',
    'formFields'      => [
        'work_ot_date',
        'work_do_date',
        'name_park',
        'city',
        'phone',
        'rating',
        'rating_stability',
        'rating_you',
        'note',
    ],
]);
?>
    <div class="panel panel-default">
        <div class="panel-heading control-label"><b>Опыт работы в таксопарке Яндекс такси</b>
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>
                Добавить
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($models_ya as $index => $model): ?>
                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        if (!$model->isNewRecord) {
                            echo Html::activeHiddenInput($model, "[{$index}]id");
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]work_ot_date")->widget(DatePicker::class, [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                    'options' => [
                                        'value' => !empty($model->work_ot_date) ? \Yii::$app->formatter->asDate($model->work_ot_date, 'php:d.m.Y') : null,
                                    ]
                                ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]work_do_date")->widget(DatePicker::class, [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                    'options' => [
                                        'value' => !empty($model->work_do_date) ? \Yii::$app->formatter->asDate($model->work_do_date, 'php:d.m.Y') : null,
                                    ]
                                ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]name_park")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]city")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]phone")->widget(MaskedInput::class, [
                                    'mask' => '+9 (999) 999-99-99',
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]rating")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]rating_stability")->widget(Select2::class,[
                                    'data' => [1 => 'Растет', 2 => 'Не меняется', 3 => 'Падает'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]rating_you")->widget(Select2::class,[
                                    'data' => [1 => '1 звезда', 2 => '2 звезды', 3 => '3 звезды', 4 => '4 звезды', 5 => '5 звезд'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, "[{$index}]note")->textarea() ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="button" class="remove-item btn btn-danger btn-xs" style="margin-top:30px"><i class="fa fa-minus"></i> Удалить</button>
                        </div>



                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php DynamicFormWidget::end(); ?>