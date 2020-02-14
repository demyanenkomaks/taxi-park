<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;

DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody'      => '.container-items', // required: css class selector
    'widgetItem'      => '.item', // required: css class
    'limit'           => 10, // the maximum times, an element can be cloned (default 999)
    'min'             => 1, // 0 or 1 (default 1)
    'insertButton'    => '.add-item' , // css class
    'deleteButton'    => '.remove-item', // css class
    'model'           => $models_car[0],
    'formId'          => 'form-assistant',
    'formFields'      => [
        'files_1',
        'files_2',
    ],
]);
?>
    <div class="panel panel-default">
        <div class="panel-heading control-label"><b>Документы об авто</b>
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>
                Добавить
            </button>
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

                        <div class="col-md-12 pad-0">
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]files_1")->widget(FileInput::class,[
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-md-3 pad-md-top-25">
                                <?= $model->file1Update ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, "[{$index}]files_2")->widget(FileInput::class,[
                                    'pluginOptions' => [
                                        'showPreview' => false,
                                        'showCaption' => true,
                                        'showRemove' => true,
                                        'showUpload' => false
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-md-3 pad-md-top-25">
                                <?= $model->file2Update ?>
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