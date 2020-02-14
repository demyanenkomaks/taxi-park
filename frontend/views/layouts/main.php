<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use frontend\widgets\LoginFormWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="shortcut icon" href="/favicon.ico" title="Favicon"/>
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700%7CRoboto:400,500,700,900" rel="stylesheet">
    <script>(function(){var script = document.createElement('script');script.type = 'text/javascript';script.async = true;script.charset = 'utf-8';script.src = 'https://152фз.рф/widget/f393b33b271ec24ccbb4043a996cb45b';document.getElementsByTagName('head')[0].appendChild(script);})();</script><div id="fz_wrap"></div>
    <?php if (!YII_ENV_DEV) {
        echo $this->render('_metrika');
    } ?>
</head>
<body>
<!-- main container of all the page elements -->
<div id="wrapper">
    <header id="header">
        <div class="header-holder container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo col-lg-7 col-md-6 hidden-sm hidden-xs">
                        <span class="logo">My Way - сервис для водителей и пассажиров Яндекс такси</span>
                    </div>

                    <ul class="list-unstyled info-box col-lg-5 col-md-6 col-xs-12">
                        <li class="col-xs-6">
                            <span class="icon icon-Pointer pull-left"></span>
                            <address class="pull-left"><b class="text-uppercase text-left">г. Санкт-Петербург</b></address>
                        </li>
                        <li class="col-xs-6">
                            <span class="icon icon-Phone2 pull-left"></span>
                            <div class="pull-left">
                                <span class="tel"><b class="text-uppercase">+7 (964) 741-17-66</b></span>
                                <span class="mail">mail@mw.spb.ru</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only logo">My Way - сервис для водителей и пассажиров Яндекс такси</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="#"><span class="logo">My Way</span></a>
                </div>
                <div class="navbar-header">
                    <a href="/" class="icon icon-Crown home-link text-center hidden-xs"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav scroll">
                        <li><a href="/#main">Главная</a></li>
                        <li><a href="/#about">О нас</a></li>
                        <li><a href="/#goal">Наша Цель</a></li>
                        <li><a href="/#conditions">Условия работы</a></li>
                        <? if(Yii::$app->user->isGuest): ?>
                            <li><a href="/#registration-driver">Регистрация</a></li>
                        <?php endif;?>
                        <li><a href="/#recall">Отзывы</a></li>
                        <? if(Yii::$app->user->isGuest): ?>
                        <li><a href="/registration-hr">HR</a></li>
                        <?php endif;?>
                        <li><a href="/page/investoram">Инвесторам</a></li>
                        <li><a href="https://news.mw.spb.ru/">Новости</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (Yii::$app->user->isGuest):?>
                            <li><a href="" data-toggle="modal" data-target="#login-modal"><i class="icon icon-Users"></i> Вход</a></li>
                        <?php else:?>
                            <li>
                                <?= Html::beginForm(['/site/logout'], 'post', ['class' => '']); ?>
                                <?= Html::submitButton('<i class="icon icon-Exit"></i> Выйти',['class' => 'btn btn-link logout']); ?>
                                <?= Html::endForm(); ?>
                            </li>
                            <li><a href="/personal/cabinet/" class="btn"><i class="icon icon-Users"></i> Профиль</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php if (Yii::$app->user->isGuest):?>
        <?= LoginFormWidget::widget([]); ?>
    <?php endif;?>
    <?php $this->beginBody() ?>
    <main id="main">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

    </main>

    <div class="scroll">
        <a id="scrollUp" href="#main"><span class="glyphicon glyphicon-chevron-up"></span></a>
    </div>
    <div id="loader" class="loader-holder">
        <div class="block"><img src="/images/svg/bars.svg" width="60" alt="loader"></div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
