<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">TAXI</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="menu">
            <span class="sr-only">Toggle navigation</span>
        </a>

<!--        --><?php //if(!Yii::$app->user->isGuest): ?>
<!--        <div class="navbar-custom-menu">-->
<!--            <div class="pull-right" style="margin: 7px;">-->
<!--                --><?//= Html::a(
//                    '('.\Yii::$app->user->identity->username.') Выйти',
//                    ['/site/logout'],
//                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
//                ) ?>
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //endif; ?>
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= !empty(Yii::$app->user->identity->urlUpload) ? '/personal/avatar/' . Yii::$app->user->identity->id . '/' . Yii::$app->user->identity->urlUpload : $directoryAsset . '/img/user2-160x160.jpg'?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs <?= !empty(Yii::$app->user->identity->login) ? '' : 'mask-phone'?>"><?= !empty(Yii::$app->user->identity->login) ? Yii::$app->user->identity->login : Yii::$app->user->identity->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= !empty(Yii::$app->user->identity->urlUpload) ? '/personal/avatar/' . Yii::$app->user->identity->id . '/' . Yii::$app->user->identity->urlUpload : $directoryAsset . '/img/user2-160x160.jpg'?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <span class="<?= !empty(\Yii::$app->user->identity->login) ? '' : 'mask-phone'?>"><?= !empty(Yii::$app->user->identity->login) ? Yii::$app->user->identity->login : Yii::$app->user->identity->username?></span>
                                <small class="mask-phone"><?= Yii::$app->user->identity->username?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/personal/cabinet/" class="btn btn-default btn-flat">Профиль</a>
                            </div>
                            <div class="pull-left pad-l-5">
                                <a href="/" class="btn btn-default btn-flat">Сайт</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
