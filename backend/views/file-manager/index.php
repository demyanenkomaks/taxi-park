<?php
use mihaildev\elfinder\ElFinder;
use yii\helpers\Html;

$this->title = 'Загрузка картинок';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Разместить картинку на сайте, ссылка начинается "/uploads/" + добавляете название картинки, получается</p>
    </div>

    <?= ElFinder::widget([
        'language'         => 'ru',
        'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
//        'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории
        'filter'           => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'frameOptions' => ['style' => 'width: 100%; min-height: 600px; border: 0;']
    ])?>
</div>
