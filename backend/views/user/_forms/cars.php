<?php

use kartik\widgets\FileInput;
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
    'model'           => $models_car[0],
    'formId'          => 'cars-id',
    'formFields'      => [
        'tc_ser',
        'tc_number',
        'tc_date',
        'mark',
        'model',
        'color',
        'year',
        'state_number',
        'brend',
        'lajtboks',
        'lic_number',
        'lic_date',
        'files_1',
        'files_2',
        'rent',
        'owner',
    ],
]);
?>
    <div class="panel panel-default">
        <div class="panel-heading control-label"><b>Автомобили</b>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($models_car as $index => $model): ?>
                <div class="item panel panel-default"><!-- widgetBody -->

                    <div class="panel-body">
                        <?php
                        if (!$model->isNewRecord) {
                            echo Html::activeHiddenInput($model, "[{$index}]id");
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= $form->field($model, "[{$index}]files_1")->widget(FileInput::class,[
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-md-6 pad-md-top-25"><?= $model->file1Update?></div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= $form->field($model, "[{$index}]files_2")->widget(FileInput::class,[
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-md-6 pad-md-top-25"><?= $model->file2Update?></div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= $form->field($model, "[{$index}]os_file")->widget(FileInput::class,[
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false
                                    ]
                                ])->label('Осаго фото') ?>
                            </div>
                            <div class="col-md-6 pad-md-top-25"><?= $model->fileOsUpdate?></div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]tc_ser")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]tc_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]tc_date")->widget(DatePicker::class, [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                    'options' => [
                                        'value' => !empty($model->tc_date) ? \Yii::$app->formatter->asDate($model->tc_date, 'php:d.m.Y') : null,
                                    ]
                                ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]state_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]year")->textInput(['maxlength' => true, 'class' => 'form-control mask-year']) ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]mark")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]model")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]color")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]lajtboks")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]rent")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]owner")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]brend")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]lic_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]lic_date")->widget(DatePicker::class, [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                    'options' => [
                                        'value' => !empty($model->lic_date) ? \Yii::$app->formatter->asDate($model->lic_date, 'php:d.m.Y') : null,
                                    ]
                                ]); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]charging")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]baby_chair")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]booster")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]conditioner")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]delivery")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]smoke")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]wi_fi")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]checks")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]shipping_bicycle")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, "[{$index}]shipping_ski")->widget(Select2::class,[
                                    'data' => [0 => 'Нет', 1 => 'Да'],
                                    'options' => [
                                        'placeholder' => '',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]os_num")->widget(MaskedInput::class, [
                                    'mask' => 'aaa 9999999999',
                                ])->label('Осаго серия номер') ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]os_date")->widget(DatePicker::class, [
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                    ],
                                    'options' => [
                                        'value' => !empty($model->os_date) ? Yii::$app->formatter->asDate($model->os_date, 'php:d.m.Y') : null,
                                    ]
                                ])->label('Осаго действителен до'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php DynamicFormWidget::end(); ?>