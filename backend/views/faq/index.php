<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModelFaq backend\models\FaqSearch */
/* @var $dataProviderFaq yii\data\ActiveDataProvider */

/* @var $searchModelAuto backend\models\FaqAutoSearch */
/* @var $dataProviderAuto yii\data\ActiveDataProvider */

/* @var $searchModelPhone backend\models\FaqPhoneSearch */
/* @var $dataProviderPhone yii\data\ActiveDataProvider */

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <div class="col-md-12">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 pad-top-25">
            <?= $this->render('modal-form/ask-question', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    <?php $items = [
        [
            'label' => '<i class="fa fa-exclamation-triangle"></i> Часто задаваемые вопросы',
            'content' => $this->render('faq/index', [
                'searchModel' => $searchModelFaq,
                'dataProvider' => $dataProviderFaq,
            ]),
//            'active' => true,
        ],
        [
            'label' => '<i class="fa fa-car"></i> Автомобили',
            'content' => $this->render('auto/index',[
                'searchModel' => $searchModelAuto,
                'dataProvider' => $dataProviderAuto,
            ]),
        ],
        [
            'label' => '<i class="fa fa-mobile"></i> Смартфон',
            'content' => $this->render('phone/index',[
                'searchModel' => $searchModelPhone,
                'dataProvider' => $dataProviderPhone,
            ]),
        ],
    ];

    echo TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false,
    ]);

    ?>


</div>
