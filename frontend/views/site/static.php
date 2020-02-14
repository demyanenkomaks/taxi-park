<?php

/* @var $model backend\models\StaticPage */


$this->title = $model->title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description,
], 'description');

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->keywords,
], 'keywords');

echo $model->kod;

?>

<?php if (!in_array($model->url, ['hr', 'investoram'])):?>
<div class="row">
    <div class="col-md-12 text-center pad-25">
        <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
        <script src="https://yastatic.net/share2/share.js"></script>
        <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,viber,skype,telegram" data-limit="10"></div>
    </div>
</div>
<?php endif;?>